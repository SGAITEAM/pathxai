<!-- Navbar -->
<nav class="layout-navbar container-xxl navbar-detached navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
      <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
        <i class="icon-base ti tabler-menu-2 icon-md"></i>
      </a>
    </div>
    <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">
      <!-- Brand Top -->
      <div class="navbar-nav align-items-center">
        <div class="nav-item navbar-search-wrapper px-md-0 px-2 mb-0">
          
          <h4 class="mb-0">
            <i class="icon-base ti tabler-building-store icon-22px text-heading"></i>
            {{-- <i class="icon-base icon-22px text-heading">{{ $userData->name }}</i> --}}
            <i class="icon-base icon-22px text-heading">PathAI Uzman Hekim ve Klinisyen Paneli</i>
          </h4>
        </div>
      </div> 
      <!-- /Brand Top -->

      <!-- Language -->
      <ul class="navbar-nav flex-row align-items-center ms-md-auto">
        {{-- <li class="nav-item d-none d-md-block me-3">
          <button type="button" class="aa-DetachedSearchButton" title="Search" id="autocomplete-0-label">
            <div class="aa-DetachedSearchButtonIcon">
              <svg class="aa-SubmitIcon" viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                <path d="M16.041 15.856c-0.034 0.026-0.067 0.055-0.099 0.087s-0.060 0.064-0.087 0.099c-1.258 1.213-2.969 1.958-4.855 1.958-1.933 0-3.682-0.782-4.95-2.050s-2.050-3.017-2.050-4.95 0.782-3.682 2.050-4.95 3.017-2.050 4.95-2.050 3.682 0.782 4.95 2.050 2.050 3.017 2.050 4.95c0 1.886-0.745 3.597-1.959 4.856zM21.707 20.293l-3.675-3.675c1.231-1.54 1.968-3.493 1.968-5.618 0-2.485-1.008-4.736-2.636-6.364s-3.879-2.636-6.364-2.636-4.736 1.008-6.364 2.636-2.636 3.879-2.636 6.364 1.008 4.736 2.636 6.364 3.879 2.636 6.364 2.636c2.125 0 4.078-0.737 5.618-1.968l3.675 3.675c0.391 0.391 1.024 0.391 1.414 0s0.391-1.024 0-1.414z"></path>
              </svg>
            </div>
            <div class="aa-DetachedSearchButtonQuery"></div>
          </button>
        </li> --}}
        <li class="nav-item dropdown-language dropdown">
          <a
            class="nav-link dropdown-toggle hide-arrow btn btn-icon btn-text-secondary rounded-pill"
            href="javascript:void(0);"
            data-bs-toggle="dropdown">
            <i class="icon-base ti tabler-language icon-22px text-heading"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item" href="javascript:void(0);" data-language="en" data-text-direction="ltr">
                <span>English</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="javascript:void(0);" data-language="fr" data-text-direction="ltr">
                <span>French</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="javascript:void(0);" data-language="ar" data-text-direction="rtl">
                <span>Arabic</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="javascript:void(0);" data-language="de" data-text-direction="ltr">
                <span>German</span>
              </a>
            </li>
          </ul>
        </li>
        <!--/ Language -->

        <!-- Style Switcher -->
        <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle hide-arrow btn btn-icon btn-text-secondary rounded-pill"
            id="nav-theme"
            href="javascript:void(0);"
            data-bs-toggle="dropdown">
            <i class="icon-base ti tabler-sun icon-22px theme-icon-active text-heading"></i>
            <span class="d-none ms-2" id="nav-theme-text">Toggle theme</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="nav-theme-text">
            <li>
              <button
                type="button"
                class="dropdown-item align-items-center active"
                data-bs-theme-value="light"
                aria-pressed="false">
                <span><i class="icon-base ti tabler-sun icon-22px me-3" data-icon="sun"></i>Light</span>
              </button>
            </li>
            <li>
              <button
                type="button"
                class="dropdown-item align-items-center"
                data-bs-theme-value="dark"
                aria-pressed="true">
                <span><i class="icon-base ti tabler-moon-stars icon-22px me-3" data-icon="moon-stars"></i>Dark</span>
              </button>
            </li>
          </ul>
        </li>
        <!-- / Style Switcher-->
        <!-- User -->
        <li class="nav-item navbar-dropdown dropdown-user dropdown">
          <a
            class="nav-link dropdown-toggle hide-arrow p-0"
            href="javascript:void(0);"
            data-bs-toggle="dropdown">
            <div class="avatar avatar-online">
              <img src="../../assets/img/avatars/user-avatar.png" alt class="rounded-circle" />
            </div>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item mt-0" href="pages-account-settings-account.html">
                <div class="d-flex align-items-center">
                  <div class="flex-shrink-0 me-2">
                    <div class="avatar avatar-online">
                      <img src="../../assets/img/avatars/user-avatar.png" alt class="rounded-circle" />
                    </div>
                  </div>
                  <div class="flex-grow-1">
                    <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                    <small class="text-body-secondary">Admin</small>
                  </div>
                </div>
              </a>
            </li>
            <li>
              <div class="dropdown-divider my-1 mx-n2"></div>
            </li>
            <li>
              <a class="dropdown-item" href="pages-profile-user.html">
                <i class="icon-base ti tabler-user me-3 icon-md"></i
                ><span class="align-middle">My Profile</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="pages-account-settings-account.html">
                <i class="icon-base ti tabler-settings me-3 icon-md"></i
                ><span class="align-middle">Settings</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="pages-account-settings-billing.html">
                <span class="d-flex align-items-center align-middle">
                  <i class="flex-shrink-0 icon-base ti tabler-file-dollar me-3 icon-md"></i
                  ><span class="flex-grow-1 align-middle">Billing</span>
                  <span class="flex-shrink-0 badge bg-danger d-flex align-items-center justify-content-center"
                    >4</span
                  >
                </span>
              </a>
            </li>
            <li>
              <div class="dropdown-divider my-1 mx-n2"></div>
            </li>
            <li>
              <a class="dropdown-item" href="pages-pricing.html">
                <i class="icon-base ti tabler-currency-dollar me-3 icon-md"></i
                ><span class="align-middle">Pricing</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="pages-faq.html">
                <i class="icon-base ti tabler-question-mark me-3 icon-md"></i
                ><span class="align-middle">FAQ</span>
              </a>
            </li>
            <li>
              <div class="d-grid px-2 pt-2 pb-1">
                <a class="btn btn-sm btn-danger d-flex" href="{{ route('logout') }}"  target="_blank" 
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <small class="align-middle">Logout</small>
                  <i class="icon-base ti tabler-logout ms-2 icon-14px"></i>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </a>
              </div>
            </li>
          </ul>
        </li>
        <!--/ User -->
      </ul>
    </div>
  </nav>
  <!-- / Navbar -->