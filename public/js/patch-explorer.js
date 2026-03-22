/**
 * PathXAI — WSI Patch Explorer v2
 * Optimized: fast Canvas patching, white-region filter, smooth threshold
 */
(function () {
  'use strict';

  // ── State ──
  let originalImage   = null;
  let originalFile    = null;
  let patchSize       = 64;
  let threshold       = 0.50;
  let patches         = [];     // { id, row, col, dataUrl, blob?, result }
  let isAnalyzing     = false;
  let whiteThreshold  = 85;     // % of white pixels to skip (0 = disabled)

  // ── DOM refs ──
  const $fileInput      = $('#peFileInput');
  const $fileText       = $('#peFileText');
  const $imgPreview     = $('#imgPreview');
  const $gridCanvas     = $('#gridOverlayCanvas');
  const $gallery        = $('#patchGallery');
  const $galleryEmpty   = $('#patchGalleryEmpty');
  const $stats          = $('#patchStats');
  const $btnGenerate    = $('#btnGeneratePatches');
  const $btnAnalyze     = $('#btnAnalyzeAll');
  const $btnClear       = $('#btnClearAll');
  const $btnSaveDB      = $('#btnSaveDB');
  const $btnLoadDB      = $('#btnLoadDB');
  const $thresholdInput = $('#thresholdInput');

  // ── IndexedDB store ──
  const patchStore = localforage.createInstance({ name: 'pathxai-patches' });

  // ══════════════════════════════════════════════
  //  INIT
  // ══════════════════════════════════════════════
  $(document).ready(function () {
    initThresholdSlider();
    initPatchSizeButtons();
    initFileInput();
    initActionButtons();
  });

  // ── Threshold Slider (noUiSlider) + Text Input ──
  function initThresholdSlider() {
    const slider = document.getElementById('thresholdSlider');
    if (!slider) return;

    noUiSlider.create(slider, {
      start: [0.50],
      connect: [true, false],
      range: { min: 0, max: 1 },
      step: 0.01,
      tooltips: false,
      format: {
        to: v => v.toFixed(2),
        from: v => parseFloat(v)
      }
    });

    // Slider → Input sync (no lag, instant)
    slider.noUiSlider.on('update', function (values) {
      threshold = parseFloat(values[0]);
      $thresholdInput.val(threshold.toFixed(2));
    });

    // Input → Slider sync (smooth animation ONLY when typing)
    $thresholdInput.on('change', function () {
      let val = parseFloat($(this).val());
      if (isNaN(val)) val = 0.50;
      val = Math.max(0, Math.min(1, val));
      $(this).val(val.toFixed(2));

      // Add smooth transition class just for this programmatic set
      const handle = slider.querySelector('.noUi-origin');
      const connect = slider.querySelector('.noUi-connect');
      if (handle) handle.style.transition = 'transform 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
      if (connect) connect.style.transition = 'transform 0.4s cubic-bezier(0.4, 0, 0.2, 1)';

      slider.noUiSlider.set(val);

      // Remove transition after animation finishes so dragging is instant
      setTimeout(() => {
        if (handle) handle.style.transition = '';
        if (connect) connect.style.transition = '';
      }, 450);
    });
  }

  // ── Patch Size Buttons ──
  function initPatchSizeButtons() {
    $('#patchSizeGroup').on('click', '.patch-size-btn', function () {
      $('#patchSizeGroup .patch-size-btn').removeClass('active btn-primary').addClass('btn-outline-primary');
      $(this).removeClass('btn-outline-primary').addClass('active btn-primary');
      patchSize = parseInt($(this).data('size'));

      if (originalImage) {
        drawGridOverlay();
      }
    });
  }

  // ── File Input ──
  function initFileInput() {
    $fileInput.on('change', function (e) {
      const file = e.target.files[0];
      if (!file) return;

      originalFile = file;
      $fileText.val(file.name);

      const reader = new FileReader();
      reader.onload = function (ev) {
        const img = new Image();
        img.onload = function () {
          originalImage = img;
          $imgPreview.attr('src', ev.target.result);
          $btnGenerate.prop('disabled', false);
          drawGridOverlay();

          Swal.fire({
            icon: 'success',
            title: __t.swal_image_selected,
            html: `<p class="mb-1"><strong>${file.name}</strong></p><p class="text-muted mb-0">${img.width} × ${img.height} piksel</p>`,
            timer: 1500,
            showConfirmButton: false
          });
        };
        img.src = ev.target.result;
      };
      reader.readAsDataURL(file);
    });
  }

  // ── Action Buttons ──
  function initActionButtons() {
    $btnGenerate.on('click', generatePatches);
    $btnAnalyze.on('click', analyzeAll);
    $btnClear.on('click', clearAll);
    $btnSaveDB.on('click', saveToDB);
    $btnLoadDB.on('click', loadFromDB);
  }

  // ══════════════════════════════════════════════
  //  GRID OVERLAY
  // ══════════════════════════════════════════════
  function drawGridOverlay() {
    if (!originalImage) return;

    const canvas = $gridCanvas[0];
    const container = canvas.parentElement;
    const displayW = container.clientWidth;
    const displayH = container.clientHeight;

    canvas.width  = displayW;
    canvas.height = displayH;

    const ctx = canvas.getContext('2d');
    ctx.clearRect(0, 0, displayW, displayH);

    const scaleX = displayW / originalImage.width;
    const scaleY = displayH / originalImage.height;

    ctx.strokeStyle = 'rgba(115, 103, 240, 0.5)';
    ctx.lineWidth = 0.5;

    for (let x = patchSize; x < originalImage.width; x += patchSize) {
      const sx = x * scaleX;
      ctx.beginPath();
      ctx.moveTo(sx, 0);
      ctx.lineTo(sx, displayH);
      ctx.stroke();
    }
    for (let y = patchSize; y < originalImage.height; y += patchSize) {
      const sy = y * scaleY;
      ctx.beginPath();
      ctx.moveTo(0, sy);
      ctx.lineTo(displayW, sy);
      ctx.stroke();
    }
  }

  // ══════════════════════════════════════════════
  //  WHITE REGION DETECTION
  // ══════════════════════════════════════════════
  function getWhitePixelPercentage(ctx, size) {
    const imageData = ctx.getImageData(0, 0, size, size);
    const data = imageData.data;
    const totalPixels = size * size;
    let whiteCount = 0;

    // Sample every 4th pixel for speed on large patches
    const step = size >= 128 ? 4 : (size >= 64 ? 2 : 1);

    for (let i = 0; i < data.length; i += 4 * step) {
      const r = data[i];
      const g = data[i + 1];
      const b = data[i + 2];
      // Pixel is "white-ish" if R>220, G>220, B>220
      if (r > 220 && g > 220 && b > 220) {
        whiteCount += step;
      }
    }

    return (whiteCount / totalPixels) * 100;
  }

  // ══════════════════════════════════════════════
  //  PATCH GENERATION (Optimized)
  // ══════════════════════════════════════════════
  async function generatePatches() {
    if (!originalImage) return;

    const w = originalImage.width;
    const h = originalImage.height;
    const cols = Math.floor(w / patchSize);
    const rows = Math.floor(h / patchSize);

    patches = [];
    $gallery.empty().removeClass('d-none');
    $galleryEmpty.addClass('d-none');

    const tempCanvas = document.createElement('canvas');
    tempCanvas.width  = patchSize;
    tempCanvas.height = patchSize;
    const ctx = tempCanvas.getContext('2d', { willReadFrequently: true });

    const totalPatches = rows * cols;
    let accepted = 0;
    let skipped  = 0;

    // Use DocumentFragment for batch DOM insertion
    const fragment = document.createDocumentFragment();
    const batchSize = 100; // Flush to DOM every N patches

    for (let r = 0; r < rows; r++) {
      for (let c = 0; c < cols; c++) {
        ctx.clearRect(0, 0, patchSize, patchSize);
        ctx.drawImage(
          originalImage,
          c * patchSize, r * patchSize,
          patchSize, patchSize,
          0, 0,
          patchSize, patchSize
        );

        // White region filter
        if (whiteThreshold > 0) {
          const whitePct = getWhitePixelPercentage(ctx, patchSize);
          if (whitePct >= whiteThreshold) {
            skipped++;
            continue;
          }
        }

        // Use toDataURL only (no toBlob — it's async & slow)
        const dataUrl = tempCanvas.toDataURL('image/png');

        const patch = {
          id: `R${r}_C${c}`,
          row: r,
          col: c,
          dataUrl: dataUrl,
          blob: null,   // Created lazily during analysis
          result: null
        };
        patches.push(patch);

        // Build DOM element directly (no jQuery overhead)
        const card = document.createElement('div');
        card.className = 'patch-card';
        card.dataset.id = patch.id;
        card.title = patch.id;
        card.innerHTML = `<div class="patch-result-badge pending"></div><img src="${dataUrl}" alt="${patch.id}"><div class="patch-label">${patch.id}</div>`;
        card.addEventListener('click', () => openPatchModal(patch));
        fragment.appendChild(card);

        accepted++;

        // Flush fragment to DOM periodically
        if (accepted % batchSize === 0) {
          $gallery[0].appendChild(fragment);
          await sleep(0); // yield to repaint
        }
      }
    }

    // Flush remaining
    $gallery[0].appendChild(fragment);

    updateStats();
    $btnAnalyze.prop('disabled', false);
    $btnClear.prop('disabled', false);
    $btnSaveDB.prop('disabled', false);

    let genHtml = __t.swal_gen_text
      .replace('{count}', accepted)
      .replace('{grid}', `${rows}×${cols}`)
      .replace('{size}', `${patchSize}×${patchSize}`);
    if (skipped > 0) {
      genHtml += '<br><small class="text-muted">' + __t.swal_gen_skipped.replace('{skipped}', skipped) + '</small>';
    }
    Swal.fire({
      icon: 'success',
      title: __t.swal_gen_title,
      html: genHtml,
      confirmButtonText: __t.swal_ok
    });
  }

  // Convert dataUrl to Blob (lazy, used only at analysis time)
  function dataUrlToBlob(dataUrl) {
    const arr = dataUrl.split(',');
    const mime = arr[0].match(/:(.*?);/)[1];
    const bstr = atob(arr[1]);
    let n = bstr.length;
    const u8arr = new Uint8Array(n);
    while (n--) u8arr[n] = bstr.charCodeAt(n);
    return new Blob([u8arr], { type: mime });
  }

  // ══════════════════════════════════════════════
  //  GALLERY
  // ══════════════════════════════════════════════
  function renderPatchCard(patch) {
    const statusClass = patch.result === null ? 'pending'
      : (patch.result && patch.result.positive > threshold * 100) ? 'positive' : 'negative';

    const $card = $(`
      <div class="patch-card" data-id="${patch.id}" title="${patch.id}">
        <div class="patch-result-badge ${statusClass}"></div>
        <img src="${patch.dataUrl}" alt="${patch.id}">
        <div class="patch-label">${patch.id}</div>
      </div>
    `);

    $card.on('click', function () {
      openPatchModal(patch);
    });

    $gallery.append($card);
  }

  function openPatchModal(patch) {
    $('#patchModalImg').attr('src', patch.dataUrl);
    let info = `<strong>${patch.id}</strong> — ${patchSize}×${patchSize}px`;
    if (patch.result) {
      const pos = patch.result.positive !== undefined ? patch.result.positive : '—';
      const neg = patch.result.negative !== undefined ? patch.result.negative : '—';
      info += `<br><span class="text-danger fw-semibold">${__t.result_positive}: ${pos}%</span>`;
      info += ` · <span class="text-success fw-semibold">${__t.result_negative}: ${neg}%</span>`;
    }
    $('#patchModalInfo').html(info);
    $('#patchModalTitle').text(`${__t.patch_inspect} — ${patch.id}`);
    new bootstrap.Modal(document.getElementById('patchModal')).show();
  }

  function updateStats() {
    const total     = patches.length;
    const analyzed  = patches.filter(p => p.result !== null).length;
    const positive  = patches.filter(p => p.result && p.result.positive > threshold * 100).length;
    const negative  = analyzed - positive;

    $stats.html(`
      <span class="stat-item"><span class="stat-dot" style="background:#7367f0"></span> ${total} patch</span>
      ${analyzed > 0 ? `
        <span class="stat-item"><span class="stat-dot" style="background:#ff4d4f"></span> ${positive} ${__t.result_positive}</span>
        <span class="stat-item"><span class="stat-dot" style="background:#52c41a"></span> ${negative} ${__t.result_negative}</span>
      ` : ''}
    `);
  }

  // ══════════════════════════════════════════════
  //  BATCH ANALYSIS
  // ══════════════════════════════════════════════
  async function analyzeAll() {
    if (isAnalyzing || patches.length === 0) return;
    isAnalyzing = true;

    const model = $('input[name="peModel"]:checked').val();
    const routeMap = {
      breast: '/predict/breast',
      hcd:    '/predict/hcd',
      lung:   '/predict/lung',
      colon:  '/predict/colon'
    };
    const url = routeMap[model];
    if (!url) return;

    // Set all cards to loading state
    $('.patch-card').addClass('loading');

    let completed = 0;

    for (let i = 0; i < patches.length; i++) {
      const patch = patches[i];

      // Lazy-create blob from dataUrl
      if (!patch.blob) {
        patch.blob = dataUrlToBlob(patch.dataUrl);
      }

      try {
        const formData = new FormData();
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
        formData.append('image', patch.blob, `${patch.id}.png`);
        formData.append('threshold', threshold);

        const response = await $.ajax({
          url: url,
          method: 'POST',
          data: formData,
          contentType: false,
          processData: false,
        });

        patch.result = {
          positive: response.positive ?? (response.probabilities ?
            Object.values(response.probabilities).reduce((a,b) => a+b, 0) - (response.probabilities.NORMAL || 0) : 0),
          negative: response.negative ?? (response.probabilities ? (response.probabilities.NORMAL || 0) : 0),
          raw: response
        };
      } catch (err) {
        patch.result = { positive: 0, negative: 0, error: true };
      }

      const $card = $(`.patch-card[data-id="${patch.id}"]`);
      $card.removeClass('loading');
      const badge = patch.result.positive > threshold * 100 ? 'positive' : 'negative';
      $card.find('.patch-result-badge').removeClass('pending positive negative').addClass(badge);

      completed++;
      updateStats();

      if (completed % 5 === 0) {
        await sleep(50);
      }
    }

    isAnalyzing = false;

    Swal.fire({
      icon: 'success',
      title: __t.swal_batch_title,
      text: __t.swal_batch_text,
      confirmButtonText: __t.swal_ok
    });
  }

  // ══════════════════════════════════════════════
  //  INDEXEDDB (localforage)
  // ══════════════════════════════════════════════
  async function saveToDB() {
    try {
      const saveData = patches.map(p => ({
        id: p.id,
        row: p.row,
        col: p.col,
        dataUrl: p.dataUrl,
        result: p.result,
        patchSize: patchSize,
        threshold: threshold,
        model: $('input[name="peModel"]:checked').val()
      }));

      await patchStore.setItem('patches', saveData);
      await patchStore.setItem('meta', {
        savedAt: new Date().toISOString(),
        count: patches.length,
        patchSize: patchSize,
        originalFileName: originalFile ? originalFile.name : 'unknown'
      });

      Swal.fire({
        icon: 'success',
        title: __t.swal_save_title,
        text: __t.swal_save_text.replace('{count}', patches.length),
        timer: 2000,
        showConfirmButton: false
      });
    } catch (err) {
      console.error('Save error:', err);
    }
  }

  async function loadFromDB() {
    try {
      const savedPatches = await patchStore.getItem('patches');
      const meta = await patchStore.getItem('meta');

      if (!savedPatches || savedPatches.length === 0) {
        Swal.fire({
          icon: 'info',
          title: __t.swal_load_empty,
          text: __t.swal_load_empty_text,
          confirmButtonText: __t.swal_ok
        });
        return;
      }

      patches = savedPatches.map(p => ({
        ...p,
        blob: null
      }));

      if (savedPatches[0].patchSize) patchSize = savedPatches[0].patchSize;
      if (savedPatches[0].threshold) threshold = savedPatches[0].threshold;

      $(`#patchSizeGroup .patch-size-btn`).removeClass('active btn-primary').addClass('btn-outline-primary');
      $(`#patchSizeGroup .patch-size-btn[data-size="${patchSize}"]`).removeClass('btn-outline-primary').addClass('active btn-primary');

      const slider = document.getElementById('thresholdSlider');
      if (slider && slider.noUiSlider) {
        slider.noUiSlider.set(threshold);
      }

      $gallery.empty().removeClass('d-none');
      $galleryEmpty.addClass('d-none');

      patches.forEach(p => renderPatchCard(p));
      updateStats();

      $btnClear.prop('disabled', false);
      $btnSaveDB.prop('disabled', false);

      Swal.fire({
        icon: 'success',
        title: __t.swal_load_title,
        html: __t.swal_load_text.replace('{count}', patches.length)
          + (meta && meta.originalFileName ? `<br><small class="text-muted">${meta.originalFileName}</small>` : ''),
        timer: 2000,
        showConfirmButton: false
      });
    } catch (err) {
      console.error('Load error:', err);
    }
  }

  // ══════════════════════════════════════════════
  //  CLEAR
  // ══════════════════════════════════════════════
  function clearAll() {
    Swal.fire({
      title: __t.swal_clear_title,
      text: __t.swal_clear_text,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#7367f0',
      cancelButtonColor: '#82868b',
      confirmButtonText: __t.swal_clear_confirm,
      cancelButtonText: __t.swal_clear_cancel,
      reverseButtons: true
    }).then(result => {
      if (!result.isConfirmed) return;

      patches = [];
      $gallery.empty().addClass('d-none');
      $galleryEmpty.removeClass('d-none');
      $stats.empty();
      $btnAnalyze.prop('disabled', true);
      $btnClear.prop('disabled', true);
      $btnSaveDB.prop('disabled', true);

      const canvas = $gridCanvas[0];
      if (canvas) {
        const ctx = canvas.getContext('2d');
        ctx.clearRect(0, 0, canvas.width, canvas.height);
      }
    });
  }

  // ── Helpers ──
  function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
  }

})();
