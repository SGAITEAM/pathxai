<!doctype html>

<html lang="{{ app()->getLocale() }}" class="layout-navbar-fixed layout-wide" dir="ltr" data-skin="default" data-assets-path="../../assets/" data-template="front-pages" data-bs-theme="light">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>{{ __('page_title') }} — {{ __('patch_title') }} {{ __('patch_title_suffix') }}</title>
    <meta name="description" content="WSI Patch Explorer for PathXAI" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="img/favicon.ico" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../../assets/vendor/fonts/iconify-icons.css" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/pickr/pickr-themes.css" />
    <link rel="stylesheet" href="../../assets/vendor/css/core.css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />
    <link rel="stylesheet" href="../../assets/vendor/css/pages/front-page.css" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/nouislider/nouislider.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/swiper/swiper.css" />
    <!-- Page CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/pages/front-page-landing.css" />
    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>
    <link rel="stylesheet" href="../../assets/vendor/libs/spinkit/spinkit.css">
    <script src="../../assets/js/front-config.js"></script>

    <style>
      /* ── Patch Explorer Custom Styles ── */
      .patch-size-btn { min-width: 80px; }
      .patch-size-btn.active { box-shadow: 0 0 0 3px rgba(115, 103, 240, 0.4); }

      .patch-gallery {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 10px;
        max-height: 600px;
        overflow-y: auto;
        padding: 8px;
      }

      .patch-card {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        border: 2px solid transparent;
        transition: all 0.25s ease;
        cursor: pointer;
        background: var(--bs-card-bg);
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
      }
      .patch-card:hover {
        transform: scale(1.08);
        z-index: 10;
        border-color: var(--bs-primary);
        box-shadow: 0 8px 25px rgba(115, 103, 240, 0.3);
      }
      .patch-card img {
        width: 100%;
        aspect-ratio: 1;
        object-fit: cover;
        display: block;
        image-rendering: pixelated;
      }
      .patch-card .patch-label {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.7));
        color: #fff;
        font-size: 10px;
        padding: 12px 6px 4px;
        text-align: center;
        font-weight: 600;
      }
      .patch-card .patch-result-badge {
        position: absolute;
        top: 4px;
        right: 4px;
        width: 14px;
        height: 14px;
        border-radius: 50%;
        border: 2px solid #fff;
        box-shadow: 0 1px 3px rgba(0,0,0,0.3);
      }
      .patch-card .patch-result-badge.positive { background: #ff4d4f; }
      .patch-card .patch-result-badge.negative { background: #52c41a; }
      .patch-card .patch-result-badge.pending  { background: #999; }

      /* Skeleton shimmer */
      .patch-card.loading img { visibility: hidden; }
      .patch-card.loading::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, var(--bs-secondary-bg) 25%, var(--bs-tertiary-bg, #e9ecef) 50%, var(--bs-secondary-bg) 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
      }
      @keyframes shimmer {
        0%   { background-position: 200% 0; }
        100% { background-position: -200% 0; }
      }

      /* Threshold slider & input */
      #thresholdSlider { margin-top: 12px; }
      .noUi-connect { background: var(--bs-primary) !important; }
      .threshold-input {
        width: 70px;
        text-align: center;
        font-weight: 600;
        border-color: var(--bs-primary);
        transition: all 0.3s ease;
      }
      .threshold-input:focus {
        box-shadow: 0 0 0 3px rgba(115, 103, 240, 0.25);
        border-color: var(--bs-primary);
      }
      /* Smooth slider handle — animations applied via JS only when needed */

      /* Grid overlay on preview */
      #gridOverlayCanvas {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        opacity: 0.4;
      }

      /* Stats bar */
      .patch-stats {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
        align-items: center;
      }
      .patch-stats .stat-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        font-weight: 600;
      }
      .stat-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
      }

      /* Modal image */
      #patchModalImg {
        max-width: 100%;
        image-rendering: pixelated;
        border-radius: 8px;
      }
    </style>
  </head>
  <body>
    <script src="../../assets/vendor/js/dropdown-hover.js"></script>
    <script src="../../assets/vendor/js/mega-dropdown.js"></script>
    <!-- Navbar: Start -->
    <nav class="layout-navbar shadow-none py-0">
      <div class="container">
        <div class="navbar navbar-expand-lg landing-navbar px-3 px-md-8 py-0">
          <div class="navbar-brand app-brand demo d-flex py-0 me-4 me-xl-8 ms-0">
            <button class="navbar-toggler border-0 px-0 me-4" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <i class="icon-base ti tabler-menu-2 icon-lg align-middle text-heading fw-medium"></i>
            </button>
            <a href="/" class="app-brand-link">
              <span class="app-brand-logo demo">
                <span class="text-primary">
                  <img src="img/logo.png" alt="" width="64" height="64" />
                </span>
              </span>
              <span class="app-brand-text demo menu-text fw-bold ms-2 ps-1">PathXAI</span>
            </a>
          </div>
          <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
            <button class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl p-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <i class="icon-base ti tabler-x icon-lg"></i>
            </button>
            <ul class="navbar-nav me-auto">
              <li class="nav-item">
                <a class="nav-link fw-medium" href="/predict">{{ __('nav_predict') }}</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link fw-medium" href="#">{{ __('nav_patch') }}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link fw-medium" href="/abstract">{{ __('nav_abstract') }}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link fw-medium" href="/#landingTeam">{{ __('nav_team') }}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link fw-medium" href="/api-docs">API</a>
              </li>
            </ul>
          </div>
          <div class="landing-menu-overlay d-lg-none"></div>
          <ul class="navbar-nav flex-row align-items-center ms-auto">
            <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-1">
              <a class="nav-link dropdown-toggle hide-arrow" id="nav-theme" href="javascript:void(0);" data-bs-toggle="dropdown">
                <i class="icon-base ti tabler-sun icon-lg theme-icon-active"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="nav-theme-text">
                <li><button type="button" class="dropdown-item align-items-center active" data-bs-theme-value="light" aria-pressed="false"><span><i class="icon-base ti tabler-sun icon-md me-3" data-icon="sun"></i>Light</span></button></li>
                <li><button type="button" class="dropdown-item align-items-center" data-bs-theme-value="dark" aria-pressed="true"><span><i class="icon-base ti tabler-moon-stars icon-md me-3" data-icon="moon-stars"></i>Dark</span></button></li>
                <li><button type="button" class="dropdown-item align-items-center" data-bs-theme-value="system" aria-pressed="false"><span><i class="icon-base ti tabler-device-desktop-analytics icon-md me-3" data-icon="device-desktop-analytics"></i>System</span></button></li>
              </ul>
            </li>
            @include('partials.lang-dropdown')
            <li>
              <a href="{{ route('dashboard') }}" class="btn btn-primary" target="_self">
                <span class="tf-icons icon-base ti tabler-login scaleX-n1-rtl me-md-1"></span>
                <span class="d-none d-md-block">{{ __('nav_login') }}</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Navbar: End -->

    <!-- Main Content -->
    <div data-bs-spy="scroll" class="scrollspy-example">
      <section id="patch-explorer-section" class="section-py bg-body landing-reviews">
        <div class="container">
          <!-- Title -->
          <h4 class="text-center mb-3 mt-3">
            <span class="position-relative fw-extrabold z-1">{{ __('patch_title') }}
              <img src="../../assets/img/front-pages/icons/section-title-icon.png" alt="section icon" class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
            </span>
            {{ __('patch_title_suffix') }}
          </h4>
          <p class="text-center mb-6 pb-md-4">{{ __('predict_model_instruction') }}</p>

          <div class="row g-6">
            <!-- LEFT: Image Preview -->
            <div class="col-lg-5 col-xl-5 col-md-12">
              <div class="card card-contact h-100">
                <div class="card-body p-3">
                  <div class="contact-img-box position-relative border p-2 h-100" style="border-radius: 0;">
                    <img id="imgPreview" src="/img/placeholder.png" alt="Preview" class="w-100 scaleX-n1-rtl" style="border-radius: 0; max-height: 460px; object-fit: contain;">
                    <canvas id="gridOverlayCanvas"></canvas>
                    <div class="p-4 pb-2">
                      <div class="row g-4">
                        <div class="col-12">
                          <div class="d-flex align-items-center">
                            <div class="badge bg-label-primary rounded p-1_5 me-3">
                              <i class="icon-base ti tabler-upload icon-lg"></i>
                            </div>
                            <div>
                              <p class="mb-0">{{ __('predict_upload_label') }}</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- RIGHT: Controls -->
            <div class="col-lg-7 col-xl-7 col-md-12">
              <div class="card h-100">
                <div class="card-body">
                  <!-- Model Selection (with SVG icons from predict page) -->
                  <p class="mb-4 px-2">
                    {{ __('predict_instruction') }} <strong>{{ __('predict_instruction_bold') }}</strong> {{ __('predict_instruction_suffix') }}
                  </p>
                  <div class="row mb-4">
                    <div class="col-md mb-md-0 mb-5">
                      <div class="form-check custom-option custom-option-icon checked">
                        <label class="form-check-label custom-option-content" for="pe_breast">
                          <span class="custom-option-body">
                            <svg width="64" height="64" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.1515 7.00612C14.6527 5.99368 14.3069 4.96687 14.3069 4H16.3069C16.3069 4.52086 16.503 5.22384 16.9456 6.12221C17.3813 7.00672 18.016 8.00167 18.7993 9.08568C20.146 10.9497 21.8668 12.9899 23.6368 15.0885C23.9306 15.4369 24.226 15.7872 24.5211 16.1383C26.5722 18.5787 28.618 21.0722 30.0366 23.3337C30.7466 24.4657 31.3252 25.5792 31.665 26.6313C31.7046 26.7538 31.7413 26.8768 31.7749 27H32C33.1046 27 34 27.8954 34 29C34 30.1046 33.1046 31 32 31H31.3309C29.9682 33.7892 27.0447 36.3155 23.935 37.7387C22.0625 38.5957 19.9688 39.1147 18 38.9774V44H16V38.5806C14.9992 38.2358 14.0711 37.6638 13.2715 36.8134L14.7285 35.4433C16.6095 37.4438 19.8206 37.4222 23.1027 35.9201C26.3596 34.4295 29.1401 31.7008 29.9161 29.1633C30.0554 28.7078 30.0324 28.0838 29.7618 27.246C29.4931 26.4141 29.0083 25.4582 28.3423 24.3965C27.0088 22.2705 25.0523 19.8788 22.99 17.4251C22.7003 17.0803 22.4084 16.7343 22.1162 16.388C20.3506 14.2948 18.5728 12.1873 17.1781 10.257C16.3633 9.12926 15.6571 8.03241 15.1515 7.00612Z" fill="currentColor"/><path d="M34.2185 38.5541C33.6042 39.4338 33 40.5619 33 41.596C33 42.9237 34.1193 44 35.5 44C36.8807 44 38 42.9237 38 41.596C38 40.5619 37.3958 39.4338 36.7815 38.5541C36.1462 37.6442 35.5 37 35.5 37C35.5 37 34.8538 37.6442 34.2185 38.5541Z" fill="currentColor"/><path d="M32 34.7576C32 34.1371 32.3625 33.4603 32.7311 32.9324C33.1123 32.3865 33.5 32 33.5 32C33.5 32 33.8877 32.3865 34.2689 32.9324C34.6375 33.4603 35 34.1371 35 34.7576C35 35.5542 34.3284 36.2 33.5 36.2C32.6716 36.2 32 35.5542 32 34.7576Z" fill="currentColor"/></svg>
                            <span class="custom-option-title">{!! str_replace(' ', ' <br> ', __('predict_breast')) !!}</span>
                          </span>
                          <input name="peModel" class="form-check-input" type="radio" value="breast" id="pe_breast" checked="">
                        </label>
                      </div>
                    </div>
                    <div class="col-md mb-md-0 mb-5">
                      <div class="form-check custom-option custom-option-icon">
                        <label class="form-check-label custom-option-content" for="pe_hcd">
                          <span class="custom-option-body">
                            <svg width="64" height="64" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M11.3162 6.05134C10.7923 5.8767 10.226 6.15986 10.0513 6.6838C9.87667 7.20774 10.1598 7.77406 10.6838 7.94871C11.1185 8.09363 11.8342 8.42295 12.5717 8.92399C11.7738 9.3913 10.0154 10 7 10C6.44772 10 6 10.4477 6 11C6 11.5523 6.44772 12 7 12C10.7075 12 13.0328 11.1499 14.1174 10.2867C14.2847 10.4839 14.4403 10.6924 14.5793 10.9121C14.0887 12.0376 14.3475 13.5099 15.3393 14.6136C16.1848 15.5546 17.3534 15.9945 18.4055 15.8757C18.4388 15.935 18.4778 16.012 18.5199 16.1092C18.6689 16.4529 18.858 17.0548 18.9586 18.0269C18.8789 18.0784 18.8014 18.1343 18.7264 18.1947C17.8728 18.8819 17.5168 19.9997 17.6525 21.1918L17.6032 21.1971C17.3436 21.2227 17.0274 21.2269 16.6761 21.2133C16.1057 21.1912 15.4973 21.1249 14.9818 21.0569C14.9362 19.5927 13.6562 18.2909 11.9201 18.0407C11.4174 17.9682 10.9265 17.9911 10.4716 18.0941C10.4442 18.0608 10.4082 18.0113 10.3682 17.9414C10.223 17.6873 10 17.1174 10 16C10 15.4477 9.55228 15 9 15C8.44772 15 8 15.4477 8 16C8 17.3827 8.27697 18.3128 8.63176 18.9337L8.71902 19.0779C8.54752 19.2643 8.40209 19.4709 8.2879 19.6942C7.66316 19.5888 6.87723 19.5 6 19.5C5.44772 19.5 5 19.9477 5 20.5C5 21.0523 5.44772 21.5 6 21.5C6.83061 21.5 7.57025 21.5941 8.13091 21.6974C8.50044 22.8427 9.62579 23.772 11.0642 23.9793C12.3253 24.1611 13.5123 23.7425 14.2426 22.9664L14.3586 22.99C14.9521 23.0748 15.7925 23.1806 16.5989 23.2118C17.0018 23.2274 17.4168 23.2252 17.7999 23.1874C17.9567 23.1719 18.1235 23.1491 18.2914 23.1138C18.4426 23.3817 18.6194 23.6434 18.8217 23.8948C20.3146 25.7493 22.6568 26.3658 24.1748 25.349C24.5921 25.6171 25.0921 25.9015 25.6408 26.1567C26.0597 26.3516 26.5224 26.5366 27.0108 26.6835L26.9951 26.7116C26.7532 27.146 26.5741 27.5947 26.4552 28.0434C25.4891 28.1415 24.632 28.3974 23.9193 28.718C23.4227 28.9414 22.9687 29.2093 22.5887 29.4966C21.7499 28.873 20.5398 28.6583 19.3473 29.0226C17.9962 29.4353 17.0417 30.4771 16.8147 31.6265C16.0645 31.6592 15.1583 31.6179 14.2187 31.5294C13.6358 31.4746 13.0597 31.4036 12.528 31.3279C12.4833 30.6415 12.236 29.9324 11.7779 29.3035C11.3298 28.6884 10.7468 28.2417 10.1229 27.9857L10.1667 27.8059C10.2971 27.3133 10.4875 26.9267 10.7071 26.7071C11.0976 26.3166 11.0976 25.6834 10.7071 25.2929C10.3166 24.9024 9.68342 24.9024 9.29289 25.2929C8.71248 25.8733 8.40288 26.6535 8.23329 27.2941L8.11214 27.8411C8.03516 27.8632 7.95913 27.8887 7.88424 27.9178C7.61112 27.4123 7.22216 26.808 6.70711 26.2929C6.31658 25.9024 5.68342 25.9024 5.29289 26.2929C4.90237 26.6834 4.90237 27.3166 5.29289 27.7071C5.68594 28.1002 6.0041 28.6193 6.23057 29.0722L6.39001 29.4123C5.97696 30.4438 6.1427 31.758 6.92829 32.8364C8.06647 34.3988 10.0748 34.8745 11.4139 33.8989C11.6552 33.7231 11.8583 33.5122 12.0225 33.2755C12.6446 33.3676 13.3327 33.4549 14.0313 33.5206C15.0821 33.6195 16.2188 33.6763 17.2062 33.607C17.3362 33.8005 17.4912 33.9758 17.6668 34.131C17.3245 34.5914 16.9319 35.1035 16.5631 35.5548C16.3112 35.8632 16.0818 36.1289 15.8942 36.3265C15.4164 36.021 14.8496 35.8009 14.2261 35.7021C12.2123 35.3832 10.3696 36.4512 10.1105 38.0877C9.85126 39.7241 11.2737 41.3093 13.2875 41.6283C15.3013 41.9472 17.1439 40.8792 17.4031 39.2427C17.4799 38.7577 17.4091 38.2773 17.2189 37.8329L17.2305 37.8212C17.499 37.5503 17.807 37.1933 18.1119 36.8203C18.6174 36.2016 19.1566 35.4865 19.568 34.9217C20.0608 34.968 20.5822 34.919 21.1002 34.7608C22.818 34.236 23.8947 32.6945 23.6502 31.2076C23.8776 31.015 24.2365 30.7683 24.7397 30.542C25.1911 30.3389 25.7263 30.1681 26.3284 30.0752C26.4862 31.1225 27.006 32.0274 27.8492 32.5578L27.6894 33.8126C27.6549 34.3649 27.667 35.01 27.8189 35.6176C27.9125 35.9918 28.0694 36.3899 28.3297 36.7427C27.6392 38.2095 28.5193 40.1194 30.3279 41.043C32.1658 41.9817 34.2666 41.5465 35.0202 40.071L35.2202 39.5298C35.5698 39.5274 36.013 39.5053 36.5145 39.437L36.5307 39.4348C36.8187 39.7003 37.2093 40.0291 37.6527 40.3487C38.2263 40.7622 38.9458 41.2027 39.6838 41.4487C40.2077 41.6234 40.774 41.3402 40.9487 40.8163C41.1233 40.2923 40.8402 39.726 40.3162 39.5513C39.8812 39.4063 39.3854 39.1234 38.9103 38.7891C39.5229 38.5294 40.1469 38.1806 40.7419 37.713C41.1761 37.3717 41.2515 36.7431 40.9102 36.3088C40.5689 35.8746 39.9403 35.7993 39.506 36.1405C38.4477 36.9723 37.2304 37.3212 36.2448 37.4553C35.7559 37.5219 35.3372 37.5337 35.0446 37.5291L34.935 37.5265C34.8885 37.4354 34.8377 37.3453 34.7828 37.2567C34.3979 36.6359 33.8073 36.0829 33.0569 35.6996C31.9698 35.1444 30.7907 35.0698 29.8529 35.4069L29.7592 35.1325C29.6767 34.8026 29.6576 34.3852 29.6855 33.9374L29.7982 33.0187C31.2169 32.9044 32.6801 31.9328 33.5539 30.3636C34.6881 28.3265 34.4431 25.9757 33.0666 24.7886C33.1908 23.731 33.4685 23.0546 33.7236 22.6346C34.556 23.2493 35.6894 23.5549 36.8845 23.3951C39.1069 23.098 40.7008 21.304 40.4447 19.388L40.3017 18.7881C40.7386 18.4459 41.2286 18.0215 41.6904 17.5488C42.4198 16.802 43.2032 15.8102 43.4701 14.7426C43.6041 14.2068 43.2783 13.6638 42.7425 13.5299C42.2067 13.3959 41.6638 13.7217 41.5299 14.2575C41.475 14.477 41.3634 14.7208 41.2042 14.9796C41.0874 14.6952 41 14.3593 41 14C41 13.4477 40.5523 13 40 13C39.4477 13 39 13.4477 39 14C39 15.0717 39.4031 15.982 39.8035 16.5917L39.0898 17.1969C38.2601 16.596 37.1386 16.2989 35.9569 16.4569C34.4354 16.6603 33.2085 17.5653 32.6681 18.7307C32.0384 18.6158 31.4718 18.4009 31.0039 18.1709L30.5649 17.9358C30.7728 17.1663 30.7107 16.279 30.3383 15.4442L31.4415 14.7616C32.2662 14.1946 33.2618 13.3692 33.9472 12.2995L34.2641 12.4832C35.0332 12.8722 36.0011 12.9806 36.968 12.7142C38.8316 12.2007 39.9855 10.4896 39.5454 8.89226C39.1053 7.29492 37.2378 6.41626 35.3743 6.92971C33.5107 7.44316 32.3568 9.15428 32.7969 10.7516L32.9004 11.0539L29.6318 14.3608C29.1189 13.7989 28.4743 13.4225 27.8063 13.2756L27.7301 12.9014C27.681 12.6594 27.6372 12.4355 27.6013 12.2384C28.5628 11.8611 29.3346 10.9841 29.5719 9.84907C29.9354 8.1099 28.9063 6.42332 27.2733 6.08199C25.6403 5.74065 24.0218 6.87382 23.6583 8.61299C23.3237 10.2134 24.1685 11.7693 25.578 12.2734L25.7699 13.2987L25.8263 13.5757C25.6562 13.6771 25.5008 13.7961 25.3608 13.9298C24.3807 14.8662 24.1547 16.5281 24.9039 17.9824C25.7891 19.7008 27.7008 20.4787 29.1737 19.7199L29.4149 19.5788C29.6186 19.7023 29.8555 19.8349 30.1215 19.9657C30.7371 20.2683 31.5296 20.5716 32.4424 20.7214L32.4977 20.934C32.3916 21.0548 32.2842 21.1908 32.1782 21.3437C31.7454 21.968 31.3577 22.8403 31.153 24.0473C30.2537 24.0148 29.3115 24.3439 28.4928 24.9663C27.8367 24.8824 27.1415 24.649 26.4842 24.3433L25.3346 23.7164C25.6973 22.4418 25.3404 20.8295 24.2746 19.5054C23.3499 18.3567 22.0993 17.683 20.9205 17.5782C20.796 16.563 20.5798 15.8326 20.3551 15.314L20.1728 14.9388C21.1276 13.7894 20.9944 11.9302 19.8023 10.6034C18.7654 9.44945 17.2426 9.04907 16.0446 9.50844C14.6262 7.52051 12.3519 6.39656 11.3162 6.05134Z" fill="currentColor"/></svg>
                            <span class="custom-option-title">{{ __('predict_hcd') }}</span>
                          </span>
                          <input name="peModel" class="form-check-input" type="radio" value="hcd" id="pe_hcd">
                        </label>
                      </div>
                    </div>
                    <div class="col-md mb-md-0 mb-5">
                      <div class="form-check custom-option custom-option-icon">
                        <label class="form-check-label custom-option-content" for="pe_lung">
                          <span class="custom-option-body">
                            <svg width="64" height="64" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M23 6.00013C23 6.00004 23 6 24 6H24.1761L24.3868 6C25 6.00001 25 6.00005 25 6.00013V20.5C25 21.8977 25.5641 22.4421 26.0039 22.6987L26.1516 22.777C26.1506 22.6568 26.1493 22.5316 26.1479 22.4019L26.1479 22.4003C26.1101 18.8716 26.0365 11.9997 31.4753 11.9997C38.9259 11.9997 44.2478 38.0062 41.0547 40.6599C37.8615 43.3136 31.4753 41.7214 28.2822 38.5369C25.7042 35.9659 25.9272 29.9583 26.0873 25.6457L26.0874 25.6443C26.0971 25.3819 26.1067 25.1258 26.1153 24.8771C25.79 24.7962 25.3959 24.6595 24.9962 24.4263C24.6398 24.2184 24.2975 23.9442 24 23.5919C23.7026 23.9442 23.3603 24.2184 23.0039 24.4263C22.6041 24.6595 22.2101 24.7962 21.8848 24.8771L21.9127 25.6453C22.0728 29.9579 22.2959 35.9662 19.7179 38.5372C16.5247 41.7217 10.1385 43.3139 6.94536 40.6602C3.75222 38.0065 9.07413 12 16.5247 12C21.9636 12 21.89 18.8717 21.8522 22.4003L21.8516 22.4489C21.8504 22.5619 21.8493 22.6714 21.8484 22.777L21.9962 22.6987C22.436 22.4421 23 21.8977 23 20.5V6.00013Z" fill="currentColor"/></svg>
                            <span class="custom-option-title">{!! str_replace(' ', ' <br> ', __('predict_lung')) !!}</span>
                          </span>
                          <input name="peModel" class="form-check-input" type="radio" value="lung" id="pe_lung">
                        </label>
                      </div>
                    </div>
                    <div class="col-md mb-md-0 mb-5">
                      <div class="form-check custom-option custom-option-icon">
                        <label class="form-check-label custom-option-content" for="pe_colon">
                          <span class="custom-option-body">
                            <svg width="64" height="64" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 12.1944C6 8.77335 8.77335 6 12.1944 6C13.6163 6 14.9271 6.47988 15.9723 7.28507C17.0174 6.47988 18.3282 6 19.7501 6C21.3959 6 22.8916 6.64243 24.0001 7.68804C25.1085 6.64243 26.6042 6 28.2501 6C29.6719 6 30.9827 6.47987 32.0278 7.28502C33.0729 6.47987 34.3837 6 35.8055 6C39.2266 6 42 8.77335 42 12.1944C42 13.6129 41.5223 14.921 40.7206 15.9649C41.5261 17.1052 42 18.498 42 20C42 21.6057 41.4585 23.0861 40.5496 24.2668C41.454 25.3431 42 26.7332 42 28.2501C42 31.6712 39.2267 34.4445 35.8056 34.4445C34.3837 34.4445 33.073 33.9646 32.0278 33.1595L31.2131 33.691L31.1871 33.7542C31.1244 33.9175 31.06 34.1596 31 34.4761V42H29V34.3846L29.0158 34.2078C29.0897 33.7964 29.1865 33.3849 29.32 33.0372L29.5906 32.5038C29.7032 32.3376 29.8827 32.1274 30.156 31.9877C30.5851 31.7683 30.9721 31.4768 31.3007 31.1288C31.4896 30.9287 31.7526 30.8153 32.0278 30.8153C32.303 30.8153 32.566 30.9287 32.7549 31.1288C33.521 31.9402 34.6036 32.4445 35.8056 32.4445C38.1221 32.4445 40 30.5666 40 28.2501C40 26.9746 39.432 25.833 38.5316 25.0621L38.1824 24.3341C38.1736 24.0531 38.2833 23.7814 38.4849 23.5855C39.4206 22.6758 40 21.4064 40 20C40 18.6918 39.4989 17.503 38.6765 16.6112C38.308 16.2117 38.3261 15.5909 38.7173 15.2136C39.5093 14.4495 40 13.3801 40 12.1944C40 9.95267 38.2413 8.12165 36.0284 8.00582V8.03547C35.0773 8.03547 34.0984 8.50674 33.4631 9.27834C32.8483 10.025 32.566 11.0356 32.9487 12.1838C33.1234 12.7078 32.8402 13.2741 32.3162 13.4487C31.7923 13.6234 31.226 13.3402 31.0513 12.8162C30.6133 11.5022 30.7216 10.2536 31.185 9.19783C30.4275 8.45575 29.3927 8 28.2501 8C26.8323 8 25.5785 8.70248 24.8177 9.78286C24.6304 10.0488 24.3254 10.2071 24.0001 10.2071C23.6747 10.2071 23.3697 10.0488 23.1824 9.78286C22.4216 8.70248 21.1678 8 19.7501 8C18.548 8 17.4654 8.50432 16.6994 9.31573C16.5105 9.51584 16.2474 9.62925 15.9722 9.62925C15.6971 9.62925 15.434 9.51584 15.2451 9.31573C14.4791 8.50432 13.3965 8 12.1944 8C9.87792 8 8 9.87792 8 12.1944C8 13.3965 8.50432 14.4791 9.31573 15.2451C9.51585 15.434 9.62926 15.6971 9.62926 15.9723C9.62926 16.2475 9.51585 16.5105 9.31574 16.6994C8.50433 17.4654 8.00001 18.548 8.00001 19.7501C8.00001 21.1678 8.70249 22.4216 9.78287 23.1824C10.0489 23.3697 10.2071 23.6747 10.2071 24.0001C10.2071 24.3254 10.0489 24.6304 9.78287 24.8177C8.70249 25.5785 8.00001 26.8323 8.00001 28.2501C8.00001 30.2334 9.3775 31.8974 11.2291 32.3331C11.6808 32.4394 12 32.8425 12 33.3065V35.3335C12 35.8245 12.398 36.2224 12.8889 36.2224C13.3798 36.2224 13.7778 35.8245 13.7778 35.3336V32.7576C13.7778 32.3995 13.9692 32.0688 14.2797 31.8904C15.5422 31.1653 16.3889 29.806 16.3889 28.2501C16.3889 26.8323 15.6864 25.5785 14.606 24.8177L14.4517 24.6834C13.7663 24.2325 12.9467 23.9999 11.9999 23.9999C11.4476 23.9999 10.9999 23.5522 10.9999 22.9999C10.9999 22.4477 11.4477 21.9999 11.9999 21.9999C13.1309 21.9999 14.1881 22.2486 15.1211 22.7549C15.9043 21.9921 16.3889 20.9276 16.3889 19.7501C16.3889 18.548 15.8846 17.4654 15.0732 16.6994C14.8731 16.5105 14.7596 16.2474 14.7596 15.9722C14.7596 15.697 14.8731 15.434 15.0732 15.2451L15.2451 15.0732C15.434 14.873 15.697 14.7596 15.9722 14.7596C16.2474 14.7596 16.5105 14.873 16.6994 15.0732C17.4654 15.8846 18.548 16.3889 19.7501 16.3889C21.1678 16.3889 22.4216 15.6864 23.1824 14.606C23.3697 14.34 23.6747 14.1818 24.0001 14.1818C24.3254 14.1818 24.6304 14.34 24.8177 14.606C25.5785 15.6864 26.8323 16.3889 28.2501 16.3889L29.422 16.2233C29.808 16.1112 30.2237 16.2412 30.4771 16.5533C30.7305 16.8654 30.7723 17.2989 30.5834 17.6537C30.2113 18.3523 30 19.15 30 20C30 20.9044 30.2393 21.7506 30.6579 22.4812C31.797 23.1214 32.5429 23.7528 32.9825 24.4854C33.5016 25.3507 33.5007 26.2228 33.5 26.9235L33.5 26.9999C33.5 27.5522 33.0523 27.9999 32.5 27.9999C31.9477 27.9999 31.5 27.5522 31.5 26.9999C31.5 26.2131 31.4793 25.8674 31.2675 25.5144L29.9177 24.3637L29.6918 24.3097C29.2435 24.1456 28.7584 24.0556 28.2501 24.0556C25.9335 24.0556 24.0556 25.9335 24.0556 28.2501C24.0556 29.8786 24.9835 31.2922 26.3441 31.9877L26.6294 32.1739C26.8638 32.3637 27 32.6493 27 32.951V42H25V33.5242C23.2347 32.4342 22.0556 30.4806 22.0556 28.2501C22.0556 24.829 24.829 22.0556 28.2501 22.0556L28.307 22.0559C28.1074 21.4054 28 20.7149 28 20C28 19.446 28.0645 18.9063 28.1866 18.3886C26.5658 18.3723 25.0943 17.733 24.0001 16.7008C22.8916 17.7465 21.3959 18.3889 19.7501 18.3889C19.2116 18.3889 18.689 18.3201 18.1908 18.1908C18.3201 18.689 18.3889 19.2116 18.3889 19.7501C18.3889 21.3959 17.7465 22.8916 16.7009 24.0001C17.7465 25.1085 18.3889 26.6042 18.3889 28.2501C18.3889 30.3371 17.3563 32.182 15.7778 33.3033V35.3336C15.7778 36.929 14.4844 38.2224 12.8889 38.2224C11.2934 38.2224 10 36.929 10 35.3335V34.0442C7.66233 33.1583 6.00001 30.8993 6.00001 28.2501C6.00001 26.6042 6.64245 25.1085 7.68805 24.0001C6.64245 22.8916 6.00001 21.3959 6.00001 19.7501C6.00001 18.3282 6.47989 17.0174 7.28508 15.9723C6.47989 14.9271 6 13.6163 6 12.1944Z" fill="currentColor"/></svg>
                            <span class="custom-option-title">{!! str_replace(' ', ' <br> ', __('predict_colon')) !!}</span>
                          </span>
                          <input name="peModel" class="form-check-input" type="radio" value="colon" id="pe_colon">
                        </label>
                      </div>
                    </div>
                  </div>

                  <!-- File Input -->
                  <div class="input-group mb-4">
                    <label class="input-group-text cursor-pointer" for="peFileInput" style="background-color: var(--bs-primary); color: white; border-color: var(--bs-primary);">{{ __('predict_file_select') }}</label>
                    <input type="file" class="form-control d-none" id="peFileInput" accept="image/*">
                    <input type="text" class="form-control" id="peFileText" placeholder="{{ __('predict_no_file') }}" readonly onclick="$('#peFileInput').click()" style="cursor: pointer; background-color: var(--bs-body-bg);">
                  </div>

                  <!-- Patch Size Buttons -->
                  <div class="mb-4">
                    <label class="form-label fw-semibold mb-2">
                      <i class="icon-base ti tabler-grid-dots me-1"></i>{{ __('patch_size_label') }}
                    </label>
                    <div class="btn-group w-100" id="patchSizeGroup" role="group">
                      <button class="btn btn-outline-primary patch-size-btn" data-size="32">32×32</button>
                      <button class="btn btn-outline-primary patch-size-btn active" data-size="64">64×64</button>
                      <button class="btn btn-outline-primary patch-size-btn" data-size="128">128×128</button>
                      <button class="btn btn-outline-primary patch-size-btn" data-size="256">256×256</button>
                    </div>
                  </div>

                  <!-- Threshold Slider + Text Input -->
                  <div class="mb-4">
                    <div class="d-flex align-items-center gap-2 mb-2">
                      <label class="form-label fw-semibold mb-0">
                        <i class="icon-base ti tabler-adjustments-horizontal me-1"></i>{{ __('patch_threshold') }}:
                      </label>
                      <input type="number" class="form-control form-control-sm threshold-input" id="thresholdInput" value="0.50" min="0" max="1" step="0.01">
                    </div>
                    <div id="thresholdSlider"></div>
                  </div>

                  <!-- Action Buttons (full-width, equal) -->
                  <div class="d-flex mt-4 gap-0">
                    <button class="btn btn-outline-primary waves-effect flex-fill" id="btnGeneratePatches" disabled style="border-radius: 0.375rem 0 0 0.375rem;">
                      <i class="icon-base ti tabler-cut me-2"></i>{{ __('patch_generate') }}
                    </button>
                    <button class="btn btn-outline-primary waves-effect flex-fill" id="btnAnalyzeAll" disabled style="border-left: 0; border-radius: 0;">
                      <i class="icon-base ti tabler-microscope me-2"></i>{{ __('patch_analyze_all') }}
                    </button>
                    <button class="btn btn-outline-primary waves-effect flex-fill" id="btnClearAll" disabled style="border-left: 0; border-radius: 0 0.375rem 0.375rem 0;">
                      <i class="icon-base ti tabler-trash me-2"></i>{{ __('patch_clear') }}
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Patch Gallery Section -->
          <div class="row mt-6">
            <div class="col-12">
              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                  <h5 class="card-title mb-0">
                    <i class="icon-base ti tabler-layout-grid me-2"></i>{{ __('patch_gallery_title') }}
                  </h5>
                  <div class="d-flex align-items-center gap-3">
                    <div class="patch-stats" id="patchStats">
                      {{-- filled dynamically --}}
                    </div>
                    <div class="d-flex gap-2">
                      <button class="btn btn-outline-primary btn-sm waves-effect" id="btnSaveDB" disabled title="{{ __('patch_save_db') }}">
                        <i class="icon-base ti tabler-device-floppy me-1"></i>{{ __('patch_save_db') }}
                      </button>
                      <button class="btn btn-outline-primary btn-sm waves-effect" id="btnLoadDB" title="{{ __('patch_load_db') }}">
                        <i class="icon-base ti tabler-database me-1"></i>{{ __('patch_load_db') }}
                      </button>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div id="patchGalleryEmpty" class="text-center text-muted py-6">
                    <i class="icon-base ti tabler-photo-off" style="font-size: 48px;"></i>
                    <p class="mt-3">{{ __('patch_no_patches') }}</p>
                  </div>
                  <div class="patch-gallery d-none" id="patchGallery">
                    {{-- filled dynamically --}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <!-- Patch Inspect Modal -->
    <div class="modal fade" id="patchModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="patchModalTitle">{{ __('patch_inspect') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center">
            <img id="patchModalImg" src="" alt="Patch">
            <div class="mt-3" id="patchModalInfo"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer class="landing-footer bg-body footer-text pt-0">
      <div class="footer-bottom py-3 py-md-2">
        <div class="container d-flex flex-wrap justify-content-between flex-md-row flex-column text-center text-md-start">
          <div class="mb-2 mb-md-0 text-white">
            <span class="footer-bottom-text">©
              <script>document.write(new Date().getFullYear());</script>
            </span>
           {{ __('footer_project') }}  <a href="https://tubitak.gov.tr/tr/yarismalar/2204-lise-ogrencileri-arastirma-projeleri-yarismasi" target="_blank" class="fw-medium text-success">TÜBİTAK 2204-A</a> {{ __('footer_tubitak') }}
          </div>
          <div>
            <a href="https://github.com/SGAITEAM/pathxai" class="me-1 text-white" target="_blank">
              <svg width="32" height="32" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.7184 2.19556C6.12757 2.19556 2.40674 5.91639 2.40674 10.5072C2.40674 14.1789 4.78757 17.2947 8.0909 18.3947C8.50674 18.4697 8.65674 18.2139 8.65674 17.9939C8.65674 17.7964 8.65007 17.2731 8.64757 16.5806C6.33507 17.0822 5.84674 15.4656 5.84674 15.4656C5.47007 14.5056 4.92424 14.2497 4.92424 14.2497C4.17007 13.7339 4.98174 13.7456 4.98174 13.7456C5.81674 13.8039 6.25424 14.6022 6.25424 14.6022C6.9959 15.8722 8.2009 15.5056 8.67257 15.2931C8.7484 14.7556 8.96507 14.3889 9.20174 14.1814C7.35674 13.9722 5.41674 13.2589 5.41674 10.0731C5.41674 9.16722 5.74091 8.42389 6.27007 7.84389C6.1859 7.63306 5.89841 6.78722 6.35257 5.64389C6.35257 5.64389 7.05007 5.41972 8.63757 6.49472C9.31557 6.31028 10.0149 6.21614 10.7176 6.21472C11.4202 6.21586 12.1196 6.31001 12.7976 6.49472C14.3859 5.41889 15.0826 5.64389 15.0826 5.64389C15.5367 6.78722 15.2517 7.63306 15.1651 7.84389C15.6984 8.42389 16.0184 9.16639 16.0184 10.0731C16.0184 13.2672 14.0767 13.9689 12.2251 14.1747C12.5209 14.4314 12.7876 14.9381 12.7876 15.7131C12.7876 16.8247 12.7776 17.7214 12.7776 17.9939C12.7776 18.2164 12.9259 18.4747 13.3501 18.3931C16.6517 17.2914 19.0301 14.1781 19.0301 10.5072C19.0301 5.91639 15.3092 2.19556 10.7184 2.19556Z" fill="currentColor"/></svg>
            </a>
          </div>
        </div>
      </div>
    </footer>

    <!-- Core JS -->
    <script src="../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="../../assets/vendor/libs/pickr/pickr.js"></script>
    <script src="../../assets/vendor/libs/nouislider/nouislider.js"></script>
    <script src="../../assets/vendor/libs/swiper/swiper.js"></script>
    <script src="../../assets/js/front-main.js"></script>

    <!-- External Libs -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/localforage@1.10.0/dist/localforage.min.js"></script>

    <!-- Translations -->
    <script>
    @php
    $peTrans = [
        'swal_analyzing'        => __('swal_analyzing'),
        'swal_analysis_complete' => __('swal_analysis_complete'),
        'swal_ok'               => __('swal_ok'),
        'swal_image_selected'   => __('swal_image_selected'),
        'result_positive'       => __('result_positive'),
        'result_negative'       => __('result_negative'),
        'patch_loading'         => __('patch_loading'),
        'patch_no_patches'      => __('patch_no_patches'),
        'patch_inspect'         => __('patch_inspect'),
        'patch_generate'        => __('patch_generate'),
        'patch_clear'           => __('patch_clear'),
        'swal_clear_title'      => __('swal_clear_title'),
        'swal_clear_text'       => __('swal_clear_text'),
        'swal_clear_confirm'    => __('swal_clear_confirm'),
        'swal_clear_cancel'     => __('swal_clear_cancel'),
        'swal_gen_title'        => __('swal_gen_title'),
        'swal_gen_text'         => __('swal_gen_text'),
        'swal_gen_skipped'      => __('swal_gen_skipped'),
        'swal_save_title'       => __('swal_save_title'),
        'swal_save_text'        => __('swal_save_text'),
        'swal_load_title'       => __('swal_load_title'),
        'swal_load_text'        => __('swal_load_text'),
        'swal_load_empty'       => __('swal_load_empty'),
        'swal_load_empty_text'  => __('swal_load_empty_text'),
        'swal_batch_title'      => __('swal_batch_title'),
        'swal_batch_text'       => __('swal_batch_text'),
    ];
    @endphp
    const __t = @json($peTrans);
    </script>

    <!-- Patch Explorer Logic -->
    <script src="/js/patch-explorer.js"></script>
  </body>
</html>
