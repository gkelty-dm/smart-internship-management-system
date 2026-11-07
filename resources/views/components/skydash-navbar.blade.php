<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">

  {{-- BRAND --}}
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">

    {{-- Logo + Nama Website --}}
    <a
      class="navbar-brand brand-logo"
      href="{{ url('/') }}">

      <img
        src="{{ asset('images/logo.png') }}"
        class="me-2"
        alt="logo">

      <span class="font-weight-bold">
        SIMPKL
      </span>

    </a>


    {{-- Logo Mini --}}
    <a
      class="navbar-brand brand-logo-mini"
      href="{{ url('/') }}">

      <img
        src="{{ asset('images/logo.png') }}"
        alt="logo">

    </a>

  </div>


  {{-- NAVBAR MENU --}}
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">

    {{-- Toggle Sidebar --}}
    <button
      class="navbar-toggler navbar-toggler align-self-center"
      type="button"
      data-toggle="minimize">

      <span class="icon-menu"></span>

    </button>


    {{-- Menu Kanan --}}
    <ul class="navbar-nav navbar-nav-right ms-auto">

      {{-- Notifikasi --}}
      <li class="nav-item dropdown">

        <a
          class="nav-link count-indicator dropdown-toggle"
          id="notificationDropdown"
          href="#"
          data-bs-toggle="dropdown">

          <i class="icon-bell mx-0"></i>

          <span class="count"></span>

        </a>

        <div
          class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
          aria-labelledby="notificationDropdown">

          <p class="mb-0 font-weight-normal float-left dropdown-header">
            Notifikasi
          </p>

          <a class="dropdown-item preview-item">

            <div class="preview-thumbnail">

              <div class="preview-icon bg-info">

                <i class="ti-user mx-0"></i>

              </div>

            </div>

            <div class="preview-item-content">

              <h6 class="preview-subject font-weight-normal">
                Sistem siap digunakan
              </h6>

            </div>

          </a>

        </div>

      </li>


      {{-- Profil --}}
      <li class="nav-item nav-profile dropdown">

        <a
          class="nav-link dropdown-toggle d-flex align-items-center"
          href="#"
          data-bs-toggle="dropdown"
          id="profileDropdown">

          <div
            class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center font-weight-bold"
            style="width:34px;height:34px;font-size:.85rem;">

            {{ auth()->check()
                            ? strtoupper(substr(auth()->user()->name, 0, 1))
                            : 'A'
                        }}

          </div>

        </a>

        <div
          class="dropdown-menu dropdown-menu-right navbar-dropdown"
          aria-labelledby="profileDropdown">

          <a
            class="dropdown-item"
            href="{{ route('admin.profile') }}">

            <i class="ti-settings text-primary"></i>

            Pengaturan Profil

          </a>


          <a
            class="dropdown-item"
            href="#"
            onclick="event.preventDefault(); document.getElementById('navbar-logout-form').submit();">

            <i class="ti-power-off text-primary"></i>

            Keluar

          </a>

        </div>

      </li>

    </ul>


    {{-- Mobile --}}
    <button
      class="navbar-toggler navbar-toggler-right d-lg-none align-self-center"
      type="button"
      data-toggle="offcanvas">

      <span class="icon-menu"></span>

    </button>

  </div>

</nav>


{{-- Logout --}}
<form
  id="navbar-logout-form"
  action="{{ route('logout') }}"
  method="POST"
  style="display:none;">

  @csrf

</form>