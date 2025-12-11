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
              <li class="nav-item">
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
      <!-- Hero: Start -->
      <section id="hero-animation">
        <div id="landingHero" class="section-py landing-hero position-relative overflow-hidden ">
          <img src="../../assets/img/front-pages/backgrounds/hero-bg.png" alt="hero background" class="position-absolute top-0 start-50 translate-middle-x object-fit-cover w-100 h-100" data-speed="1" />
          <div class="container pt-12 pb-12">
            <div class="row align-items-center text-center text-lg-start">
              <div class="col-lg-7">
                  <div class="hero-text-box text-center position-relative" style="max-inline-size: 90%;">
                    <h1 class="text-primary hero-title display-6 fw-extrabold">
                      Histopatolojik Görüntülerde Kanser Tespiti ve Açıklanabilir Yapay Zekâ (XAI) Destekli Karar Sistemi
                    </h1>
                    <h2 class="hero-sub-title h6 mb-6">
                      Bu proje, kanserli hücrelerin histopatolojik görüntüler üzerinden tespit ve sınıflandırılmasını sağlayarak, 
                      klinik karar sürecini desteklemeyi amaçlamaktadır.
                      <br class="d-none d-lg-block mb-3" />
                      <span class="position-relative fw-extrabold z-1">
                        TÜBİTAK 2204-A 
                        <img src="../../assets/img/front-pages/icons/section-title-icon.png" alt="laptop charging" class="section-title-img position-absolute object-fit-contain bottom-0 z-n1" />
                      </span>
                        kapsamında 
                        <br>Eskişehir Sabiha Gökçen M.T.A.L öğrencileri tarfından geliştirilmiştir.
                      
                    </h2>
                    <div class="landing-hero-btn d-inline-block position-relative">
                      <a href="/predict" class="btn btn-primary btn-lg">
                        <span class="tf-icons icon-base ti tabler-microscope scaleX-n1-rtl me-md-3"></span>
                        Teşhis Asistanı
                      </a>
                    </div>
                  </div>
              </div>
              <div class="col-lg-5">
                <div class="card landing-hero-card shadow-lg border-3">
                  <img src="img/dataset-cover.png" class="d-block w-100" alt="" >
                </div>
              </div>
            </div>
            
          </div>
        </div>
        
      </section>
      <!-- Hero: End -->
      <!-- Useful features: Start -->
      <section id="landingFeatures" class="section-py landing-features"  style="padding-block: 3.3em">
        <div class="container">
          <h2 class="text-center mb-3">
            Projede Kullanılan  
            <span class="position-relative fw-extrabold z-1">
              Teknikler
              <img
                src="../../assets/img/front-pages/icons/section-title-icon.png"
                alt="laptop charging"
                class="section-title-img position-absolute object-fit-contain bottom-0 z-n1" />
            </span>
            <p class="text-center pb-6">
            
            </p>
          </h2>
          <div class="features-icon-wrapper row gx-0 gy-6 g-sm-12">
            <div class="col-lg-4 col-sm-6 text-center features-icon-box">
              <div class="mb-4 text-primary text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-viewfinder">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                  <path d="M12 3l0 4" /><path d="M12 21l0 -3" /><path d="M3 12l4 0" /><path d="M21 12l-3 0" /><path d="M12 12l0 .01" />
                </svg>
                
              </div>
              <h5 class="mb-2">XAI</h5>
              <p class="features-icon-description">
                Yapay zekânın verdiği kararları görselleştirerek kara kutu olmasını engeller
              </p>
            </div>
            <div class="col-lg-4 col-sm-6 text-center features-icon-box">
              <div class="mb-4 text-primary text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-photo-ai"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 8h.01" /><path d="M10 21h-4a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v5" /><path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l1 1" /><path d="M14 21v-4a2 2 0 1 1 4 0v4" /><path d="M14 19h4" /><path d="M21 15v6" /></svg>
                
              </div>
              <h5 class="mb-2">Grad-CAM</h5>
              <p class="features-icon-description">
                Modelin hangi dokulardan çıkarım yaptığını renkli ısı haritalarıyla gösterir
              </p>
            </div>
            <div class="col-lg-4 col-sm-6 text-center features-icon-box">
              <div class="text-center mb-4 text-primary">
                <svg width="64" height="64" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M34 8H14C10.6863 8 8 10.6863 8 14V34C8 37.3137 10.6863 40 14 40H34C37.3137 40 40 37.3137 40 34V14C40 10.6863 37.3137 8 34 8ZM14 6C9.58172 6 6 9.58172 6 14V34C6 38.4183 9.58172 42 14 42H34C38.4183 42 42 38.4183 42 34V14C42 9.58172 38.4183 6 34 6H14Z" fill="currentColor"/>
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M29.9 16.1H18.1C16.9954 16.1 16.1 16.9954 16.1 18.1V29.9C16.1 31.0046 16.9954 31.9 18.1 31.9H29.9C31.0046 31.9 31.9 31.0046 31.9 29.9V18.1C31.9 16.9954 31.0046 16.1 29.9 16.1ZM18.1 14.1C15.8909 14.1 14.1 15.8909 14.1 18.1V29.9C14.1 32.1091 15.8909 33.9 18.1 33.9H29.9C32.1091 33.9 33.9 32.1091 33.9 29.9V18.1C33.9 15.8909 32.1091 14.1 29.9 14.1H18.1Z" fill="currentColor"/>
                  <path d="M21.3 18.6C21.3 19.0971 20.8971 19.5 20.4 19.5C19.9029 19.5 19.5 19.0971 19.5 18.6C19.5 18.1029 19.9029 17.7 20.4 17.7C20.8971 17.7 21.3 18.1029 21.3 18.6Z" fill="currentColor"/>
                  <path d="M23.1 21.3C23.1 21.7971 22.6971 22.2 22.2 22.2C21.7029 22.2 21.3 21.7971 21.3 21.3C21.3 20.8029 21.7029 20.4 22.2 20.4C22.6971 20.4 23.1 20.8029 23.1 21.3Z" fill="currentColor"/>
                  <path d="M19.5 21.3C19.5 21.7971 19.0971 22.2 18.6 22.2C18.1029 22.2 17.7 21.7971 17.7 21.3C17.7 20.8029 18.1029 20.4 18.6 20.4C19.0971 20.4 19.5 20.8029 19.5 21.3Z" fill="currentColor"/>
                  <path d="M21.3 24C21.3 24.4971 20.8971 24.9 20.4 24.9C19.9029 24.9 19.5 24.4971 19.5 24C19.5 23.5029 19.9029 23.1 20.4 23.1C20.8971 23.1 21.3 23.5029 21.3 24Z" fill="currentColor"/>
                  <path d="M23.1 26.7C23.1 27.1971 22.6971 27.6 22.2 27.6C21.7029 27.6 21.3 27.1971 21.3 26.7C21.3 26.2029 21.7029 25.8 22.2 25.8C22.6971 25.8 23.1 26.2029 23.1 26.7Z" fill="currentColor"/>
                  <path d="M19.5 26.7C19.5 27.1971 19.0971 27.6 18.6 27.6C18.1029 27.6 17.7 27.1971 17.7 26.7C17.7 26.2029 18.1029 25.8 18.6 25.8C19.0971 25.8 19.5 26.2029 19.5 26.7Z" fill="currentColor"/>
                  <path d="M21.3 29.4C21.3 29.8971 20.8971 30.3 20.4 30.3C19.9029 30.3 19.5 29.8971 19.5 29.4C19.5 28.9029 19.9029 28.5 20.4 28.5C20.8971 28.5 21.3 28.9029 21.3 29.4Z" fill="currentColor"/>
                  <path d="M24.9 18.6C24.9 19.0971 24.4971 19.5 24 19.5C23.5029 19.5 23.1 19.0971 23.1 18.6C23.1 18.1029 23.5029 17.7 24 17.7C24.4971 17.7 24.9 18.1029 24.9 18.6Z" fill="currentColor"/>
                  <path d="M26.7 21.3C26.7 21.7971 26.2971 22.2 25.8 22.2C25.3029 22.2 24.9 21.7971 24.9 21.3C24.9 20.8029 25.3029 20.4 25.8 20.4C26.2971 20.4 26.7 20.8029 26.7 21.3Z" fill="currentColor"/>
                  <path d="M24.9 24C24.9 24.4971 24.4971 24.9 24 24.9C23.5029 24.9 23.1 24.4971 23.1 24C23.1 23.5029 23.5029 23.1 24 23.1C24.4971 23.1 24.9 23.5029 24.9 24Z" fill="currentColor"/>
                  <path d="M26.7 26.7C26.7 27.1971 26.2971 27.6 25.8 27.6C25.3029 27.6 24.9 27.1971 24.9 26.7C24.9 26.2029 25.3029 25.8 25.8 25.8C26.2971 25.8 26.7 26.2029 26.7 26.7Z" fill="currentColor"/>
                  <path d="M24.9 29.4C24.9 29.8971 24.4971 30.3 24 30.3C23.5029 30.3 23.1 29.8971 23.1 29.4C23.1 28.9029 23.5029 28.5 24 28.5C24.4971 28.5 24.9 28.9029 24.9 29.4Z" fill="currentColor"/>
                  <path d="M28.5 18.6C28.5 19.0971 28.0971 19.5 27.6 19.5C27.1029 19.5 26.7 19.0971 26.7 18.6C26.7 18.1029 27.1029 17.7 27.6 17.7C28.0971 17.7 28.5 18.1029 28.5 18.6Z" fill="currentColor"/>
                  <path d="M30.3 21.3C30.3 21.7971 29.8971 22.2 29.4 22.2C28.9029 22.2 28.5 21.7971 28.5 21.3C28.5 20.8029 28.9029 20.4 29.4 20.4C29.8971 20.4 30.3 20.8029 30.3 21.3Z" fill="currentColor"/>
                  <path d="M28.5 24C28.5 24.4971 28.0971 24.9 27.6 24.9C27.1029 24.9 26.7 24.4971 26.7 24C26.7 23.5029 27.1029 23.1 27.6 23.1C28.0971 23.1 28.5 23.5029 28.5 24Z" fill="currentColor"/>
                  <path d="M30.3 26.7C30.3 27.1971 29.8971 27.6 29.4 27.6C28.9029 27.6 28.5 27.1971 28.5 26.7C28.5 26.2029 28.9029 25.8 29.4 25.8C29.8971 25.8 30.3 26.2029 30.3 26.7Z" fill="currentColor"/>
                  <path d="M28.5 29.4C28.5 29.8971 28.0971 30.3 27.6 30.3C27.1029 30.3 26.7 29.8971 26.7 29.4C26.7 28.9029 27.1029 28.5 27.6 28.5C28.0971 28.5 28.5 28.9029 28.5 29.4Z" fill="currentColor"/>
                  </svg>

              </div>
              <h5 class="mb-2">Patch & WSI</h5>
              <p class="features-icon-description">
                Doku örnekleri dijital olarak incelenir ve çıkarım yapılır
              </p>
            </div>
            <div class="col-lg-4 col-sm-6 text-center features-icon-box">
              <div class="text-center mb-4 text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-chart-covariate"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 11h.009" /><path d="M14 15h.009" /><path d="M12 6h.009" /><path d="M8 10h.009" /><path d="M3 21l17 -17" /><path d="M3 3v18h18" /></svg>
              </div>
              <h5 class="mb-2">ROC-AUC & Accuracy</h5>
              <p class="features-icon-description">
                Modelin doğruluk ve performansını gösteren metrikler
              </p>
            </div>
            <div class="col-lg-4 col-sm-6 text-center features-icon-box">
              <div class="text-center mb-4 text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-stack-pop"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 9.5l-3 1.5l8 4l8 -4l-3 -1.5" /><path d="M4 15l8 4l8 -4" /><path d="M12 11v-7" /><path d="M9 7l3 -3l3 3" /></svg>
              </div>
              <h5 class="mb-2">Transfer Öğrenme</h5>
              <p class="features-icon-description">Ağırlık aktarımı ile daha önce eğitilmiş modellerden faydalanmayı sağlayan derin öğrenme tekniği</p>
            </div>
            <div class="col-lg-4 col-sm-6 text-center features-icon-box">
              <div class="text-center mb-4 text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-stack-front"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 4l-8 4l8 4l8 -4l-8 -4" fill="currentColor" /><path d="M8 14l-4 2l8 4l8 -4l-4 -2" /><path d="M8 10l-4 2l8 4l8 -4l-4 -2" /></svg>
              </div>
              <h5 class="mb-2">Data Augmentation</h5>
              <p class="features-icon-description">Modelin daha dayanıklı olması için görüntüleri döndürme, kırpma gibi işlemlerle çeşitlendirme tekniğidir</p>
            </div>
          </div>
        </div>
      </section>
      <!-- Useful features: End -->

      <!-- Fun facts: Start -->
      <section id="landingFacts" class="section-py landing-fun-facts" style="padding-block: 3.3em; background-color: #f8f7fa; ">
        <div class="container">
          <h2 class="text-center mb-6">
            <span class="position-relative fw-extrabold z-1">Projenin Katkıları
              <img src="../../assets/img/front-pages/icons/section-title-icon.png" alt="laptop charging" class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
            </span>
          </h2>
          <p class="text-center pb-3">
            
          </p>
          <div class="row gy-6">
            <div class="col-sm-6 col-lg-3">
              <div class="card border border-primary shadow-none">
                <div class="card-body text-center">
                  <div class="mb-4 text-primary">
                    <svg width="64" height="64" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M19.3135 8.17L19.4027 8.11918C20.1725 7.6806 21.1583 7.94311 21.6044 8.70551C21.6661 8.81095 21.7142 8.92042 21.7494 9.03197C23.0834 8.57855 24.601 9.10806 25.3353 10.3631L29.858 18.0923C30.6909 19.5158 30.2008 21.3336 28.7634 22.1525L27.9149 22.6358L28.592 23.9364L25.9181 25.2904L25.309 24.1203L24.6418 24.5004C23.2044 25.3192 21.3638 24.8291 20.5309 23.4056L17.745 18.6445C15.085 20.1354 13.2573 21.8036 12.2874 23.7177C11.4894 25.2923 11.2272 27.1228 11.6687 29.3206C13.1008 28.5337 14.7478 28.0858 16.5 28.0858C20.5373 28.0858 24.0157 30.4636 25.5949 33.887L37.8366 30.6641L38.3608 32.5823L26.2423 35.7728C26.4109 36.4963 26.5 37.2501 26.5 38.0245C26.5 38.7052 26.4311 39.37 26.3 40.0123H39.5C40.0523 40.0123 40.5 40.4572 40.5 41.0061C40.5 41.555 40.0523 42 39.5 42L7.33212 42.0001C6.79691 40.7826 6.5 39.438 6.5 38.0245C6.5 35.0475 7.81695 32.3762 9.90342 30.5547C9.14192 27.6451 9.35822 25.0789 10.5011 22.8236C11.712 20.434 13.899 18.5219 16.7395 16.926L16.0082 15.6764C15.3542 14.5587 15.5159 13.198 16.3113 12.2685C16.1946 12.162 16.0919 12.0366 16.0082 11.8935C15.5621 11.1311 15.8245 10.1575 16.5944 9.71895L16.7103 9.65296L15.4668 7.43513L18.0968 6L19.3135 8.17ZM28.1228 19.0808L23.6001 11.3516C23.3225 10.8771 22.709 10.7137 22.2298 10.9866L18.1083 13.3345C17.6291 13.6075 17.4658 14.2134 17.7434 14.6879L22.2661 22.4171C22.5437 22.8916 23.1572 23.055 23.6364 22.7821L27.7579 20.4342C28.2371 20.1612 28.4004 19.5553 28.1228 19.0808ZM24.5 38.0245C24.5 38.7081 24.4134 39.3697 24.2508 40.0001H8.74918C8.58661 39.3697 8.5 38.7081 8.5 38.0245C8.5 33.6516 12.0701 30.0858 16.5 30.0858C19.6111 30.0858 22.2981 31.8445 23.6223 34.4064L17.2047 36.096L17.7289 38.0142L24.3065 36.2824C24.4332 36.8433 24.5 37.4264 24.5 38.0245Z" fill="currentColor"/>
                      <path d="M32.2625 19.6969C32.2457 20.3979 32.0792 21.088 31.7757 21.7192L33.0047 22.4502C33.4786 22.732 34.0807 22.5718 34.3495 22.0923C34.6182 21.6127 34.4519 20.9955 33.978 20.7137L32.3312 19.7343C32.3086 19.7208 32.2856 19.7083 32.2625 19.6969Z" fill="currentColor"/>
                      <path d="M31.6341 24.1097C31.3918 24.1066 31.1505 24.092 30.9109 24.066L31.2928 24.7995L29.33 25.7934C30.071 25.9845 30.8356 26.0875 31.6086 26.0973C33.5465 26.1218 35.446 25.5595 37.0665 24.4845C38.6868 23.4096 39.9542 21.8716 40.7126 20.0679C41.4708 18.2643 41.6873 16.2735 41.3358 14.346C40.9842 12.4185 40.0796 10.6372 38.7325 9.22863C37.3852 7.81979 35.6554 6.847 33.7602 6.43747C31.8648 6.02791 29.8931 6.20105 28.0956 6.93396C27.3526 7.23693 26.6535 7.6297 26.0121 8.10074C26.4201 8.45165 26.7775 8.87446 27.0639 9.36385L27.2424 9.66897C27.7412 9.30778 28.282 9.00646 28.8547 8.77297C30.2782 8.19255 31.8371 8.0561 33.3353 8.37984C34.8337 8.70363 36.208 9.47411 37.2829 10.5981C38.358 11.7223 39.0849 13.1496 39.3678 14.7006C39.6507 16.2517 39.4761 17.8532 38.8672 19.3015C38.2584 20.7496 37.244 21.9769 35.9562 22.8312C34.6688 23.6852 33.1648 24.1291 31.6341 24.1097Z" fill="currentColor"/>
                      <path d="M35.1503 14.7401C34.7668 15.1351 34.7668 15.7755 35.1503 16.1705C35.5337 16.5656 36.1555 16.5656 36.5389 16.1705L37.8835 14.7855C38.267 14.3904 38.267 13.75 37.8835 13.355C37.5 12.96 36.8783 12.96 36.4948 13.355L35.1503 14.7401Z" fill="currentColor"/>
                      <path d="M30.6503 13.3668C31.0337 13.7618 31.6555 13.7618 32.0389 13.3668C32.4224 12.9718 32.4224 12.3313 32.0389 11.9363L30.6943 10.5512C30.3109 10.1562 29.6891 10.1562 29.3057 10.5512C28.9222 10.9462 28.9222 11.5867 29.3057 11.9817L30.6503 13.3668Z" fill="currentColor"/>
                      <path d="M33.6515 16.5215C33.6515 15.9806 33.2258 15.5421 32.7008 15.5421C32.1757 15.5421 31.75 15.9806 31.75 16.5215C31.75 17.0624 32.1757 17.5009 32.7008 17.5009C33.2258 17.5009 33.6515 17.0624 33.6515 16.5215Z" fill="currentColor"/>
                      <path d="M35.4999 11.6724C35.4999 11.1315 35.0742 10.693 34.5491 10.693C34.024 10.693 33.5984 11.1315 33.5984 11.6724C33.5984 12.2133 34.024 12.6518 34.5491 12.6518C35.0742 12.6518 35.4999 12.2133 35.4999 11.6724Z" fill="currentColor"/>
                      <path d="M36.4961 19.1262C36.4961 18.5853 36.0705 18.1468 35.5454 18.1468C35.0203 18.1468 34.5946 18.5853 34.5946 19.1262C34.5946 19.6671 35.0203 20.1056 35.5454 20.1056C36.0705 20.1056 36.4961 19.6671 36.4961 19.1262Z" fill="currentColor"/>
                    </svg>
                  </div>
                  <h3 class="mb-0">530 K+</h3>
                  <p class="fw-medium mb-0">
                    ’den fazla histopatolojik görüntü<br />
                    ile eğitilmiş modeller
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card border border-success shadow-none">
                <div class="card-body text-center">
                  <div class="mb-4 text-success">
                    <svg width="65" height="65" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16.1524 12.3281C13.1878 14.405 11.2457 17.8434 11.2358 21.7382C11.2344 22.2905 10.7855 22.7371 10.2333 22.7357C9.68097 22.7343 9.2344 22.2854 9.23581 21.7331C9.25484 14.2677 15.3222 8.23112 22.7877 8.25015C23.34 8.25156 23.7866 8.70041 23.7851 9.2527C23.7837 9.80498 23.3349 10.2516 22.7826 10.2501C21.0371 10.2457 19.3813 10.6298 17.8971 11.3209L19.0762 12.893C21.1914 11.9034 23.6638 11.656 26.0779 12.3756C26.6071 12.5334 26.9083 13.0903 26.7505 13.6196C26.5927 14.1489 26.0358 14.45 25.5065 14.2923C21.3393 13.0501 16.954 15.4213 15.7118 19.5885C15.554 20.1178 14.9971 20.4189 14.4678 20.2612C13.9386 20.1034 13.6374 19.5465 13.7952 19.0172C14.4264 16.8994 15.705 15.1516 17.3503 13.9253L16.1524 12.3281Z" fill="currentColor"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M32.75 28.375C32.75 30.7912 30.7912 32.75 28.375 32.75C25.9588 32.75 24 30.7912 24 28.375C24 25.9588 25.9588 24 28.375 24C30.7912 24 32.75 25.9588 32.75 28.375ZM30.75 28.375C30.75 29.6867 29.6867 30.75 28.375 30.75C27.0633 30.75 26 29.6867 26 28.375C26 27.0633 27.0633 26 28.375 26C29.6867 26 30.75 27.0633 30.75 28.375Z" fill="currentColor"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M29.7058 37.531C29.3918 39.7733 27.4419 41.5 25.0833 41.5C22.506 41.5 20.4166 39.4382 20.4166 36.8947C20.4166 35.6178 20.9433 34.4623 21.7939 33.6281C20.9223 32.294 20.4166 30.7053 20.4166 29.0001C20.4166 28.6376 20.4395 28.2803 20.4838 27.9297C18.8711 27.2045 17.75 25.5999 17.75 23.7368C17.75 21.1934 19.8393 19.1315 22.4167 19.1315C24.5517 19.1315 25.437 18.4858 26.3305 17.8341C27.2407 17.1701 28.1595 16.5 30.4167 16.5C32.994 16.5 35.0834 18.5618 35.0834 21.1053C35.0834 21.6284 34.995 22.1311 34.8322 22.5998C36.622 24.1665 37.75 26.4533 37.75 29.0001C37.75 33.517 34.2017 37.2161 29.7058 37.531ZM32.5005 23.2167L32.943 21.9433C33.0335 21.6827 33.0834 21.4016 33.0834 21.1053C33.0834 19.6913 31.9145 18.5 30.4167 18.5C29.5027 18.5 28.97 18.6329 28.6222 18.7707C28.2598 18.9142 27.985 19.1028 27.534 19.4317L27.4752 19.4747C27.0449 19.789 26.434 20.2354 25.6138 20.5712C24.7315 20.9324 23.7082 21.1315 22.4167 21.1315C20.9188 21.1315 19.75 22.3228 19.75 23.7368C19.75 24.7728 20.3722 25.6866 21.304 26.1056L22.6538 26.7125L22.468 28.1807C22.4342 28.4483 22.4166 28.7217 22.4166 29.0001C22.4166 30.3037 22.8019 31.5143 23.4682 32.5342L24.3654 33.9075L23.1942 35.056C22.7084 35.5324 22.4166 36.1807 22.4166 36.8947C22.4166 38.3087 23.5855 39.5 25.0833 39.5C26.4508 39.5 27.5503 38.502 27.7251 37.2536L27.9498 35.6491L29.5661 35.5359C33.0442 35.2923 35.75 32.4369 35.75 29.0001C35.75 27.0588 34.8931 25.3111 33.5148 24.1046L32.5005 23.2167Z" fill="currentColor"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.25 31.5V27.75C17.25 25.9551 15.7949 24.5 14 24.5C12.2051 24.5 10.75 25.9551 10.75 27.75V31.5C10.75 33.2949 12.2051 34.75 14 34.75C15.7949 34.75 17.25 33.2949 17.25 31.5ZM12.75 27.75C12.75 27.0596 13.3096 26.5 14 26.5C14.6904 26.5 15.25 27.0596 15.25 27.75V31.5C15.25 32.1904 14.6904 32.75 14 32.75C13.3096 32.75 12.75 32.1904 12.75 31.5V27.75Z" fill="currentColor"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M24 44C35.0457 44 44 35.0457 44 24C44 12.9543 35.0457 4 24 4C12.9543 4 4 12.9543 4 24C4 35.0457 12.9543 44 24 44ZM24 42C33.9411 42 42 33.9411 42 24C42 14.0589 33.9411 6 24 6C14.0589 6 6 14.0589 6 24C6 33.9411 14.0589 42 24 42Z" fill="currentColor"/>
                    </svg>

                  </div>
                  <h3 class="mb-0">4 </h3>
                  <p class="fw-medium mb-0">
                    Farklı Kanser Türü<br />
                    ve 1 Metastaz Kanser Türü
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card border border-info shadow-none">
                <div class="card-body text-center">
                  <div class="mb-4 text-info">
                    <svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-viewfinder"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 3l0 4" /><path d="M12 21l0 -3" /><path d="M3 12l4 0" /><path d="M21 12l-3 0" /><path d="M12 12l0 .01" /></svg>
                  </div>
                  <h3 class="mb-0">%87-100</h3>
                  <p class="fw-medium mb-0">
                    Çıkarım Doğrulu<br />
                    (Accuracy)
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card border border-warning shadow-none">
                <div class="card-body text-center">
                  <div class="mb-4 text-warning">
                    <svg width="64" height="64" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M39 8H9C8.44771 8 8 8.44772 8 9V39C8 39.5523 8.44772 40 9 40H39C39.5523 40 40 39.5523 40 39V9C40 8.44771 39.5523 8 39 8ZM9 6C7.34315 6 6 7.34315 6 9V39C6 40.6569 7.34315 42 9 42H39C40.6569 42 42 40.6569 42 39V9C42 7.34315 40.6569 6 39 6H9Z" fill="currentColor"/>
                    <path d="M19.2792 27.1331L23.2996 32.3287L19.2792 37.4624L14.2073 33.5657L19.2792 27.1331Z" fill="currentColor"/>
                    <path d="M16.9288 14.4534L19.0936 11.6082C19.8977 10.6185 21.0729 10 22.3099 10H25.8974C26.5159 10 27.1344 10.1237 27.6911 10.433C28.2477 10.6804 28.7426 11.1133 29.1137 11.6082L31.3404 14.5152C33.0722 16.8037 33.0722 19.9582 31.3404 22.1849L28.99 25.1538L24.9696 19.9582L27.4437 17.8037C27.4437 17.8037 27.3818 17.8037 27.3818 17.7419C26.9488 17.4945 26.454 17.3708 25.9592 17.3708H22.3099C21.8151 17.3708 21.3203 17.5563 20.8873 17.8037L23.3614 19.9582L29.1755 27.3805L34 33.5657L28.99 37.4624L16.9288 22.123C15.1969 19.8964 15.1969 16.7419 16.9288 14.4534ZM19.9595 15.6286C20.0214 15.6904 20.0214 15.7523 20.0833 15.8141C20.207 15.6904 20.3925 15.6286 20.5781 15.5667C21.1347 15.3193 21.7533 15.1337 22.3718 15.1337H25.9592C26.5777 15.1337 27.1963 15.2574 27.7529 15.5667C27.8766 15.6286 28.0622 15.7523 28.1859 15.8141C28.6189 15.1956 28.8663 15.3297 28.6807 14.5874C28.6189 14.1545 28.4333 13.7215 28.124 13.3504C27.8766 13.0411 27.5055 12.7319 27.1344 12.5463C26.7633 12.3607 26.3303 12.237 25.8974 12.237H22.3099C21.444 12.237 20.6399 12.67 20.0833 13.3504C19.4029 14.2782 19.2792 14.6389 19.9595 15.6286Z" fill="currentColor"/>
                    </svg>
                  </div>
                  <h3 class="mb-0">%95-100</h3>
                  <p class="fw-medium mb-0">
                    Kanserli Hücre Yakalama Başarısı<br />
                    (Recall)
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Fun facts: End -->

      <!-- Our great team: Start -->
      <section id="landingTeam" class="section-py landing-team" style="padding-block: 3.3em">
        <div class="container">
          <h3 class="text-center mb-1">
            <span class="position-relative fw-extrabold z-1">Takım
              <img src="../../assets/img/front-pages/icons/section-title-icon.png" alt="laptop charging" class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
            </span>
          </h3>
          <p class="text-center pb-3">
            Model Geliştirme, Yazılım Geliştirme, Tasarım ve Akademik süreçlere katkı sunan ekip üyeleri.
          </p>
          <div class="row gy-4 mt-2">
            <!-- Üye 1 -->
            <div class="col-lg-4 col-sm-6">
              <div class="card border border-label-primary text-center p-6" style="border-radius: 0;">
                <h5 class="fw-bold mb-1">Esila Tuğba GİDERBAŞ</h5>
                {{-- <p class="text-body-secondary mb-0">Proje Yürütücüsü • AI Mimarisi</p> --}}
              </div>
            </div>

            <!-- Üye 2 -->
            <div class="col-lg-4 col-sm-6">
              <div class="card shadow border border-label-info text-center p-6" style="border-radius: 0;">
                <h5 class="fw-bold mb-1">Sude TEKİNKOCA</h5>
                {{-- <p class="text-body-secondary mb-0">Model Eğitimi • Veri İşleme</p> --}}
              </div>
            </div>

            <!-- Üye 3 -->
            <div class="col-lg-4 col-sm-6">
              <div class="card shadow border border-label-danger text-center p-6" style="border-radius: 0;">
                <h5 class="fw-bold mb-1">Berkay KARAMAN</h5>
                {{-- <p class="text-body-secondary mb-0">Web Arayüzü • API Entegrasyonu</p> --}}
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Our great team: End -->

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
              <a href="landing-page.html" class="app-brand-link mb-1">
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
           Bu Proje Eskişehir Sabiha Gökçen MTAL öğrencileri tarafından  <a href="https://tubitak.gov.tr/tr/yarismalar/2204-lise-ogrencileri-arastirma-projeleri-yarismasi" target="_blank" class="fw-medium text-success">TÜBİTAK 2204-A</a> Yarışması için geliştirilmiştir.
          </div>
          <div>
            <a href="https://github.com/SGAITEAM/pathxai" class="me-1 text-white" target="_blank">
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
    <script src="../../assets/vendor/libs/@algolia/autocomplete-js.js"></script>
    <script src="../../assets/vendor/libs/pickr/pickr.js"></script>
    <!-- endbuild -->
    <!-- Vendors JS -->
    <script src="../../assets/vendor/libs/nouislider/nouislider.js"></script>
    <script src="../../assets/vendor/libs/swiper/swiper.js"></script>
    <!-- Main JS -->
    <script src="../../assets/js/front-main.js"></script>
    <!-- Page JS -->
    <script src="../../assets/js/front-page-landing.js"></script>
  </body>
</html>
