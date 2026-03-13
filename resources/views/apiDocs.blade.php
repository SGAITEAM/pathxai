<!doctype html>

<html lang="tr" class="layout-navbar-fixed layout-wide" dir="ltr" data-skin="default" data-assets-path="../../assets/" data-template="front-pages" data-bs-theme="light">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Path-XAI - Histopatoloji Görüntülerinden Yapay Zeka İle Kanser Tespiti</title>
    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="img/favicon.ico" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../../assets/vendor/fonts/iconify-icons.css" />
    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->
    <link rel="stylesheet" href="../../assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/pickr/pickr-themes.css" />
    <link rel="stylesheet" href="../../assets/vendor/css/core.css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />
    <link rel="stylesheet" href="../../assets/vendor/css/pages/front-page.css" />
    <!-- Vendors CSS -->
    <!-- endbuild -->
    <link rel="stylesheet" href="../../assets/vendor/libs/nouislider/nouislider.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/swiper/swiper.css" />
    <!-- Page CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/pages/front-page-landing.css" />
    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>
    <link rel="stylesheet" href="../../assets/vendor/libs/spinkit/spinkit.css">
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    {{-- <script src="../../assets/vendor/js/template-customizer.js"></script> --}}
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../assets/js/front-config.js"></script>
  </head>
  <body>
    <script src="../../assets/vendor/js/dropdown-hover.js"></script>
    <script src="../../assets/vendor/js/mega-dropdown.js"></script>
    <!-- Navbar: Start -->
    <nav class="layout-navbar shadow-none py-0">
      <div class="container">
        <div class="navbar navbar-expand-lg landing-navbar px-3 px-md-8 py-0">
          <!-- Menu logo wrapper: Start -->
          <div class="navbar-brand app-brand demo d-flex py-0 me-4 me-xl-8 ms-0">
            <!-- Mobile menu toggle: Start-->
            <button class="navbar-toggler border-0 px-0 me-4" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <i class="icon-base ti tabler-menu-2 icon-lg align-middle text-heading fw-medium"></i>
            </button>
            <!-- Mobile menu toggle: End-->
            <a href="/" class="app-brand-link">
              <span class="app-brand-logo demo">
                <span class="text-primary">
                  <img src="img/logo.png" alt="" width="64" height="64" />
                </span>
              </span>
              <span class="app-brand-text demo menu-text fw-bold ms-2 ps-1">PathXAI</span>
            </a>
          </div>
          <!-- Menu logo wrapper: End -->
          <!-- Menu wrapper: Start -->
          <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
            <button class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl p-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <i class="icon-base ti tabler-x icon-lg"></i>
            </button>
            <ul class="navbar-nav me-auto">
              {{-- <li class="nav-item">
                <a class="nav-link fw-medium" aria-current="page" href="landing-page.html#landingHero">Ana Sayfa</a>
              </li> --}}
              <li class="nav-item">
                <a class="nav-link fw-medium" href="/predict">YZ Teşhis Asistanı</a>
              </li>
              {{-- <li class="nav-item">
                <a class="nav-link fw-medium" href="/project-presentation">Proje Sunumu</a>
              </li> --}}
              <li class="nav-item">
                <a class="nav-link fw-medium" href="/abstract">Özet</a>
              </li>
              <li class="nav-item">
                <a class="nav-link fw-medium" href="/#landingTeam">Takım</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link fw-medium" href="/api-docs">API</a>
              </li>
              
              {{-- <li class="nav-item">
                <a class="nav-link fw-medium" href="landing-page.html#landingContact">İletişim</a>
              </li> --}}

            </ul>
          </div>
          <div class="landing-menu-overlay d-lg-none"></div>
          <!-- Menu wrapper: End -->
          <!-- Toolbar: Start -->
          <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Style Switcher -->
            <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-1">
              <a
                class="nav-link dropdown-toggle hide-arrow"
                id="nav-theme"
                href="javascript:void(0);"
                data-bs-toggle="dropdown">
                <i class="icon-base ti tabler-sun icon-lg theme-icon-active"></i>
                <span class="d-none ms-2" id="nav-theme-text">Toggle theme</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="nav-theme-text">
                <li>
                  <button
                    type="button"
                    class="dropdown-item align-items-center active"
                    data-bs-theme-value="light"
                    aria-pressed="false">
                    <span><i class="icon-base ti tabler-sun icon-md me-3" data-icon="sun"></i>Light</span>
                  </button>
                </li>
                <li>
                  <button
                    type="button"
                    class="dropdown-item align-items-center"
                    data-bs-theme-value="dark"
                    aria-pressed="true">
                    <span><i class="icon-base ti tabler-moon-stars icon-md me-3" data-icon="moon-stars"></i>Dark</span>
                  </button>
                </li>
                <li>
                  <button
                    type="button"
                    class="dropdown-item align-items-center"
                    data-bs-theme-value="system"
                    aria-pressed="false">
                    <span
                      ><i
                        class="icon-base ti tabler-device-desktop-analytics icon-md me-3"
                        data-icon="device-desktop-analytics"></i
                      >System</span
                    >
                  </button>
                </li>
              </ul>
            </li>
            <!-- / Style Switcher-->

            <!-- navbar button: Start -->
            <li>
              <a href="{{ route('dashboard') }}" class="btn btn-primary" target="_self"
                ><span class="tf-icons icon-base ti tabler-login scaleX-n1-rtl me-md-1"></span
                ><span class="d-none d-md-block">Giriş/Kayıt</span></a
              >
            </li>
            <!-- navbar button: End -->
          </ul>
          <!-- Toolbar: End -->
        </div>
      </div>
    </nav>
    <!-- Navbar: End -->
    <!-- Sections:Start -->
    <div data-bs-spy="scroll" class="scrollspy-example">
      <!-- Prediction Form: Start -->
      <section id="landing-predict-app" class="section-py first-section-pt">
        <div class="container mt-6">
          <div class="row g-6">
            <div class="col-lg-8">
              {{-- File --}}
              <div id="upload-file" class="card mb-4 shadow-sm anchor-target">
                <div class="card-header">
                    <h3 class="card-title mb-0 anchor-target">Predict — File Upload</h3>
                </div>
                <div class="card-body">
                  <p class="text-muted mb-2">
                      Göğüs / Akciğer / Kolon / HCD modelleri için gönderilen resim dosyasına dair yüzdesel çıkarım sonucu döndürür.
                  </p>
                  <div class="border rounded p-3 bg-light">
                    <code class="text-dark" style="font-size: 1.3em; font-weight: 700">
                      <span class="badge badge-danger">POST</span> /api/predict
                    </code>
                  </div>
                  <h6 class="mt-3 fw-bold">Body (multipart/form-data):</h6>
                  <pre class="bg-dark text-white p-3 rounded">
  {
    "model": "breast",
    "image": (binary file)
  }
                  </pre>
                  <h6 class="fw-bold mt-3">Örnek Response:</h6>
                  <pre class="bg-dark text-white p-3 rounded">
  {
    "success": true,
    "image_url": "/img/preds/breast/api_....jpg",
    "model": "breast",
    "prediction": {
      "positive": 82.5,
      "negative": 17.4
    }
  }
                  </pre>
                </div>
              </div>
              {{-- Base64 --}}
              <div id="upload-base64" class="card mb-4 shadow-sm anchor-target">
                <div class="card-header">
                    <h3 class="card-title mb-0">Predict — Base64</h3>
                </div>
                <div class="card-body">
                  <p class="text-muted">
                      Base64 ile encode edilmiş görsel dosyalarına dair yüzdesel çıkarım sonucu döner.
                  </p>
                  
                  <div class="border rounded p-3 bg-light">
                    <code class="text-dark" style="font-size: 1.3em; font-weight: 700">
                      <span class="badge badge-danger">POST</span> /api/predict-base64
                    </code>
                  </div>
                  <h6 class="mt-3 fw-bold">Body (JSON):</h6>
                  <pre class="bg-dark text-white p-3 rounded">
  {
    "model": "lung",
    "image_base64": "data:image/jpeg;base64,/9j/4AAQSkZJRgABAQ..."
  }
                  </pre>
                  <h6 class="fw-bold mt-3">Response:</h6>
                  <pre class="bg-dark text-white p-3 rounded">
  {
    "success": true,
    "image_url": "/img/preds/lung/api_123.jpg",
    "model": "lung",
    "prediction": {
      "positive": 87.00,
      "negative": 13.00
    }
  }
                  </pre>
                </div>
              </div>
              {{-- Login --}}
              <div id="login" class="card mb-4 shadow-sm  anchor-target">
                <div class="card-header">
                    <h3 class="card-title mb-0">Login (Get Bearer Token)</h3>
                </div>
                <div class="card-body">
                  <p class="text-muted">
                      E-posta adresiniz ve parolanız ile API isteklerinde kullanabileceğiniz yetkilendirme tokenı döner.
                  </p>
                  
                  <div class="border rounded p-3 bg-light">
                    <code class="text-dark" style="font-size: 1.3em; font-weight: 700">
                      <span class="badge badge-danger">POST</span> /api/login
                    </code>
                  </div>
                  <h6 class="mt-3 fw-bold">Body (JSON):</h6>
                  <pre class="bg-dark text-white p-3 rounded">
  {
    "email": "user@test.com",
    "password": "abcd1234"
  }
                  </pre>
                  <h6 class="fw-bold mt-3">Response:</h6>
                  <pre class="bg-dark text-white p-3 rounded">
  {
    "success": true,
    "token": "3|kRXMd9Up........."
  }
                  </pre>
                </div>
              </div>
              {{-- Model Parametreleri --}}
              <div id="models" class="card mb-4 shadow-sm anchor-target">
                  <div class="card-header">
                      <h3 class="card-title mb-0">Desteklenen Model Parametreleri (model)</h3>
                  </div>
                  <div class="card-body">
                      <ul class="list-group">
                          <li class="list-group-item"><strong>breast</strong> — BreakHis + BACH + IDC Birleşik Göğüs Kanseri Modeli</li>
                          <li class="list-group-item"><strong>hcd</strong> — Göğüs Kanseri Lenf Nodu Metastazı</li>
                          <li class="list-group-item"><strong>lung</strong> — Akciğer Kanseri Modeli</li>
                          <li class="list-group-item"><strong>colon</strong> — Kolon Kanseri Modeli</li>
                      </ul>
                  </div>
              </div>
              {{-- Response lar --}}
              <div id="errors" class="card mb-5 shadow-sm anchor-target">
                <div class="card-header">
                    <h3 class="card-title mb-0">Hata Açıklamaları</h3>
                </div>
                <div class="card-body">
                  <h6 class="fw-bold">Authantication Hatası</h6>
                  <pre class="bg-dark text-white p-3 rounded">
  {
    "success": false,
    "errors": {
      "authantication": ["Bearer Token is Required"]
    }
  }
                  </pre>
                  <h6 class="fw-bold">Parametre Hatası (model) (422)</h6>
                  <pre class="bg-dark text-white p-3 rounded">
  {
    "success": false,
    "errors": {
        "image": [
            "image alanı gereklidir."
        ]
    }
  }
                  </pre>
                  <h6 class="fw-bold mt-3">Model Error (500)</h6>
                  <pre class="bg-dark text-white p-3 rounded">
  {
    "success": false,
    "message": "Unknown model type"
  }
                  </pre>
                </div>
              </div>
            </div>
            {{-- Menü  --}}
            <div class="col-lg-4 api-sidebar">
              <div class="bg-lighter py-2 px-4 rounded">
                <h5 class="mb-0">EndPoint Listesi</h5>
              </div>
              <ul class="list-unstyled mt-4 mb-0">
                <li class="mb-4">
                  <a href="#upload-file" class="text-heading d-flex justify-content-between nav-link">
                    <span class="text-truncate me-2">Görsel Dosyası ile Tahmin</span>
                    <i class="icon-base ti tabler-chevron-right scaleX-n1-rtl text-body-secondary"></i>
                  </a>
                </li>
                <li class="mb-4">
                  <a href="#upload-base64" class="text-heading d-flex justify-content-between nav-link">
                    <span class="text-truncate me-2">Base64 ile Tahmin</span>
                    <i class="icon-base ti tabler-chevron-right scaleX-n1-rtl text-body-secondary"></i>
                  </a>
                </li>
                <li class="mb-4">
                  <a href="#login" class="text-heading d-flex justify-content-between nav-link">
                    <span class="text-truncate me-2">Authantication</span>
                    <i class="icon-base ti tabler-chevron-right scaleX-n1-rtl text-body-secondary"></i>
                  </a>
                </li>
                <li class="mb-4">
                  <a href="#models" class="text-heading d-flex justify-content-between nav-link">
                    <span class="text-truncate me-2">Desteklenen Parametreler</span>
                    <i class="icon-base ti tabler-chevron-right scaleX-n1-rtl text-body-secondary"></i>
                  </a>
                </li>
                <li class="mb-4">
                  <a href="#errors" class="text-heading d-flex justify-content-between nav-link">
                    <span class="text-truncate me-2">Hata Açıklamaları</span>
                    <i class="icon-base ti tabler-chevron-right scaleX-n1-rtl text-body-secondary"></i>
                  </a>
                </li>
              </ul>
            </div>
      </section>
      <!-- Prediction Form: End -->
    </div>
    <!-- / Sections:End -->
    <!-- Footer: Start -->
    <footer class="landing-footer bg-body footer-text">
      <div class="footer-top position-relative overflow-hidden z-1">
        <img
          src="../../assets/img/front-pages/backgrounds/footer-bg.png"
          alt="footer bg"
          class="footer-bg banner-bg-img z-n1" />
        <div class="container">
          <div class="row gx-0 gy-6 g-lg-10">
            <div class="col-lg-5">
              <a href="/" class="app-brand-link mb-1">
                <span class="app-brand-logo demo">
                  <img src="img/logo.png" alt="" width="40" height="40">
                  
                </span>
                <span class="app-brand-text demo footer-link fw-bold ms-2 ps-1">SG AI TEAM</span>
              </a>
              <p class="footer-text footer-logo-description mb-6">
                Histopatolojik Görüntülerde Kanser Tespiti ve Açıklanabilir Yapay Zekâ (XAI) Destekli Karar Sistemi
              </p>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom py-3 py-md-2">
        <div
          class="container d-flex flex-wrap justify-content-between flex-md-row flex-column text-center text-md-start">
          <div class="mb-2 mb-md-0 text-white">
            <span class="footer-bottom-text">©
              <script>
                document.write(new Date().getFullYear());
              </script>
            </span>
           Bu proje Eskişehir Sabiha Gökçen MTAL öğrencileri tarafından  <a href="https://tubitak.gov.tr/tr/yarismalar/2204-lise-ogrencileri-arastirma-projeleri-yarismasi" target="_blank" class="fw-medium text-success">TÜBİTAK 2204-A</a> Yarışması için geliştirilmiştir.
          </div>
          <div>
            <a href="https://github.com/SGAITEAM/pathxai " class="me-1 text-white" target="_blank">
              <svg width="32" height="32" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M10.7184 2.19556C6.12757 2.19556 2.40674 5.91639 2.40674 10.5072C2.40674 14.1789 4.78757 17.2947 8.0909 18.3947C8.50674 18.4697 8.65674 18.2139 8.65674 17.9939C8.65674 17.7964 8.65007 17.2731 8.64757 16.5806C6.33507 17.0822 5.84674 15.4656 5.84674 15.4656C5.47007 14.5056 4.92424 14.2497 4.92424 14.2497C4.17007 13.7339 4.98174 13.7456 4.98174 13.7456C5.81674 13.8039 6.25424 14.6022 6.25424 14.6022C6.9959 15.8722 8.2009 15.5056 8.67257 15.2931C8.7484 14.7556 8.96507 14.3889 9.20174 14.1814C7.35674 13.9722 5.41674 13.2589 5.41674 10.0731C5.41674 9.16722 5.74091 8.42389 6.27007 7.84389C6.1859 7.63306 5.89841 6.78722 6.35257 5.64389C6.35257 5.64389 7.05007 5.41972 8.63757 6.49472C9.31557 6.31028 10.0149 6.21614 10.7176 6.21472C11.4202 6.21586 12.1196 6.31001 12.7976 6.49472C14.3859 5.41889 15.0826 5.64389 15.0826 5.64389C15.5367 6.78722 15.2517 7.63306 15.1651 7.84389C15.6984 8.42389 16.0184 9.16639 16.0184 10.0731C16.0184 13.2672 14.0767 13.9689 12.2251 14.1747C12.5209 14.4314 12.7876 14.9381 12.7876 15.7131C12.7876 16.8247 12.7776 17.7214 12.7776 17.9939C12.7776 18.2164 12.9259 18.4747 13.3501 18.3931C16.6517 17.2914 19.0301 14.1781 19.0301 10.5072C19.0301 5.91639 15.3092 2.19556 10.7184 2.19556Z"
                  fill="currentColor" />
              </svg>
            </a>        
          </div>
        </div>
      </div>
    </footer>
    <!-- Footer: End -->
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/theme.js -->
    <script src="../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/node-waves/node-waves.js"></script>
    {{-- <script src="../../assets/vendor/libs/@algolia/autocomplete-js.js"></script> --}}
    <script src="../../assets/vendor/libs/pickr/pickr.js"></script>
    <!-- endbuild -->
    <!-- Vendors JS -->
    <script src="../../assets/vendor/libs/nouislider/nouislider.js"></script>
    <script src="../../assets/vendor/libs/swiper/swiper.js"></script>
    <!-- Main JS -->
    <script src="../../assets/js/front-main.js"></script>
    <!-- Page JS -->
    {{-- <script src="../../assets/js/front-page-landing.js"></script> --}}
  </body>

  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    .anchor-target {
      scroll-margin-top: 90px; /* navbar yüksekliğine göre */
    }
    .api-sidebar {
      position: sticky;
      top: 50px;
      max-height: calc(100vh - 100px);
      overflow-y: auto;
    }
    .nav-link.active {
      font-weight: 600;
      color: var(--bs-primary) !important;
    }
    
  </style>

<script>



  $(document).ready(function () {

      let selectedImage = null;
      let imgMsg = $("#imgMsg");

      // Görsel yükle butonu → gizli inputu tetikle
      // $("#uploadBtn").on("click", function () {
      //     $("#imageInput").click();
      // });

      // Kullanıcı bir görsel seçti
      $("#imageInput").on("change", function (e) {
          const file = e.target.files[0];
          if (file) {
              selectedImage = file;
              Swal.fire({
                  icon: "success",
                  title: "Görsel Seçildi",
                  text: file.name,
                  timer: 1000,
                  showConfirmButton: false
              });
              imgMsg.removeClass("d-none").html(`Seçilen Görsel: <strong>${file.name}</strong>`);
          }
      });

      // İncele butonu
      $("#predictBtn").on("click", function () {
          const model = $("#aiModel").val();
          if (model === "0") {
              Swal.fire({
                  icon: "warning",
                  title: "Model Seçilmedi",
                  text: "Lütfen bir model seçiniz."
              });
              return;
          }
          if (!selectedImage) {
              Swal.fire({
                  icon: "warning",
                  title: "Görsel Eksik",
                  text: "Lütfen bir görsel yükleyiniz."
              });
              return;
          }
          let formData = new FormData();
          formData.append("_token", $("input[name='_token']").val());
          formData.append("image", selectedImage);
          // formData.append("aiModel", $("#aiModel").val());
          formData.append("aiModel", $("input[name='aiModel']:checked").val());
          console.log(formData.get('aiModel'));
          let url;
          if(formData.get("aiModel") == 'breast') {
              url = "{{ route('predictBreast') }}";
          }
          else if(formData.get("aiModel") == 'lung') {
              url = "{{ route('predictLung') }}";
          }
          else if(formData.get("aiModel") == 'colon') {
              url = "{{ route('predictColon') }}";
          }
          else if(formData.get("aiModel") == 'hcd') {
              url = "{{ route('predictHCD') }}";
          }
          
          $.ajax({
              url: url,
              method: "POST",
              data: formData,
              contentType: false,
              processData: false,

              beforeSend: function () {
                  $("#predictBtn").prop("disabled", true);
                  startSwalTimer(); // Swal + timer başlat
              },

              success: function (res) {
                stopSwalTimer(); // Swal kapat + timer durdur
                  Swal.fire({
                    icon: "success",
                    title: "İnceleme Tamamlandı",
                    confirmButtonText: "Tamam"
                  });
                  console.log(res);
                  // Görsel göster
                  if (res.image_url) {
                      $("#imgRes").attr("src", res.image_url.replace("..", "")); 
                  }

                  // 🔥 LUNG MODEL İÇİN ÖZEL HESAPLAMA
                  if (res.probabilities) {

                      let aca = res.probabilities.ACA || 0;
                      let scc = res.probabilities.SCC || 0;
                      let normal = res.probabilities.NORMAL || 0;

                      let positive = aca + scc; // ACA + SCC
                      let negative = normal;    // NORMAL

                      // Card 1 — Pozitif
                      $("#pozitif").text(positive.toFixed(2) + "% Pozitif");
                      $("#pozitifSub").text(`ACA: ${aca.toFixed(2)}% — SCC: ${scc.toFixed(2)}%`);

                      // Card 2 — Negatif
                      $("#negatif").text(negative.toFixed(2) + "% Negatif");
                      $("#negatifSub").text(`Normal Doku: ${normal.toFixed(2)}%`);
                  }
                  else{
                    // Pozitif (%)
                    if (res.positive !== undefined) {
                        $("#pozitif").text(res.positive + "% Pozitif");
                        $("#pozitifSub").text(`(Kanser Dokusu İçerir)`);

                    }
                    // Negatif (%)
                    if (res.negative !== undefined) {
                        $("#negatif").text(res.negative + "% Negatif");
                        $("#negatifSub").text(`(Kanser Dokusu İçermez)`);

                    }
                  }
                  // Sonuç bölümünü göster
                  $("#resultSection").removeClass("d-none");
              },

              error: function () {
                  stopSwalTimer(); // Swal kapat + timer durdur
                  // $("#predictBtn").text("Hata oluştu");
              },

              complete: function () {
                  // Eğer işlem bitince tekrar enable etmek istersen:
                  $("#predictBtn").prop("disabled", false);
              }
          });
      });

  });

let timerInterval;
let startTime;

function startSwalTimer() {

    Swal.fire({
        title: "🧬 İnceleme Yapılıyor",
        html: `
            <div style="font-size:22px; font-weight:600; margin-top:10px;">
                <span id="swal-timer" style="font-family: 'Courier New', monospace; font-size: 18px; display: inline-block; width: 110px; text-align: center;">00:00.000</span>
                <img src="/img/loading.gif" tyle="width:100%; margin-top:10px;" autoplay loop />
            </div>
        `,
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        didOpen: () => {

            startTime = Date.now();

            timerInterval = setInterval(() => {
                const elapsed = Date.now() - startTime;

                const minutes = String(Math.floor(elapsed / 60000)).padStart(2, '0');
                const seconds = String(Math.floor((elapsed % 60000) / 1000)).padStart(2, '0');
                const ms = String(elapsed % 1000).padStart(3, '0');

                document.getElementById("swal-timer").textContent = `${minutes}:${seconds}.${ms}`;
            }, 30);

        }
    });
}

function stopSwalTimer() {
    clearInterval(timerInterval);
    Swal.close();
}
</script>



</html>
