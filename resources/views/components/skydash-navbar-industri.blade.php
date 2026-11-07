<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">

  {{-- BRAND --}}
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">

    {{-- Logo + Nama Website --}}
    <a
      class="navbar-brand brand-logo"
      href="{{ route('industri.dashboard') }}">

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
      href="{{ route('industri.dashboard') }}">

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


      {{-- =====================================================
           NOTIFIKASI
      ====================================================== --}}

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


          <a
            class="dropdown-item preview-item"
            href="#">

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


      {{-- =====================================================
           PROFIL INDUSTRI
      ====================================================== --}}

      <li class="nav-item nav-profile dropdown">

        <a
          class="nav-link dropdown-toggle d-flex align-items-center"
          href="#"
          data-bs-toggle="dropdown"
          id="profileDropdown">


          {{-- FOTO PROFIL --}}

          @if(
          auth()->check() &&
          auth()->user()->foto_profil
          )

          <img
            src="{{ url(auth()->user()->foto_profil) }}"
            alt="Foto Profil"
            style="
                width:32px;
                height:32px;
                object-fit:cover;
                border-radius:50%;
              ">

          @else

          {{-- INISIAL NAMA --}}

          <div
            style="
                width:32px;
                height:32px;
                background-color:#4B49AC;
                color:white;
                border-radius:50%;
                display:flex;
                align-items:center;
                justify-content:center;
                font-weight:bold;
              ">

            {{ auth()->check()
                ? strtoupper(
                    substr(
                      auth()->user()->name,
                      0,
                      1
                    )
                  )
                : 'I'
              }}

          </div>

          @endif

        </a>


        {{-- DROPDOWN PROFIL --}}

        <div
          class="dropdown-menu dropdown-menu-right navbar-dropdown"
          aria-labelledby="profileDropdown">


          {{-- Profil Saya --}}

          <a
            class="dropdown-item"
            href="{{ route('industri.profil.index') }}">

            <i class="ti-user text-primary"></i>

            Profil Saya

          </a>


          {{-- Pengaturan Profil --}}

          <a
            class="dropdown-item"
            href="{{ route('industri.profil.edit') }}">

            <i class="ti-settings text-primary"></i>

            Pengaturan Profil

          </a>


          {{-- Logout --}}

          <a
            class="dropdown-item"
            href="#"
            onclick="
              event.preventDefault();
              document
                .getElementById('navbar-logout-form')
                .submit();
            ">

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