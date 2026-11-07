<nav class="sidebar sidebar-offcanvas" id="sidebar">

  <ul class="nav">

    {{-- =====================================================
             DASHBOARD
        ====================================================== --}}

    <li class="nav-item {{ request()->routeIs('industri.dashboard') ? 'active' : '' }}">

      <a class="nav-link"
        href="{{ route('industri.dashboard') }}">

        <i class="mdi mdi-view-dashboard menu-icon"></i>

        <span class="menu-title">
          Dashboard
        </span>

      </a>

    </li>


    {{-- =====================================================
             MONITORING PKL
        ====================================================== --}}

    @php

    $isMonitoringActive = request()->routeIs([
    'industri.siswa.*',
    'industri.logbook.*',
    'industri.absensi.*',
    'industri.penilaian.*'
    ]);

    @endphp


    <li class="nav-item {{ $isMonitoringActive ? 'active' : '' }}">

      <a class="nav-link"
        data-bs-toggle="collapse"
        href="#menu-monitoring-industri"
        aria-expanded="{{ $isMonitoringActive ? 'true' : 'false' }}"
        aria-controls="menu-monitoring-industri">

        <i class="mdi mdi-clipboard-text menu-icon"></i>

        <span class="menu-title">
          Monitoring PKL
        </span>

        <i class="menu-arrow"></i>

      </a>


      <div class="collapse {{ $isMonitoringActive ? 'show' : '' }}"
        id="menu-monitoring-industri">

        <ul class="nav flex-column sub-menu">


          {{-- =================================================
                         SISWA BIMBINGAN
                    ================================================== --}}

          <li class="nav-item">

            <a class="nav-link {{ request()->routeIs('industri.siswa.*') ? 'active' : '' }}"
              href="{{ route('industri.siswa.index') }}">

              <i class="mdi mdi-account-group me-2"></i>

              Siswa Bimbingan

            </a>

          </li>


          {{-- =================================================
                         LOGBOOK
                    ================================================== --}}

          <li class="nav-item">

            <a class="nav-link {{ request()->routeIs('industri.logbook.*') ? 'active' : '' }}"
              href="{{ route('industri.logbook.index') }}">

              <i class="mdi mdi-book-open-page-variant me-2"></i>

              Logbook

            </a>

          </li>


          {{-- =================================================
                         ABSENSI
                    ================================================== --}}

          <li class="nav-item">

            <a class="nav-link {{ request()->routeIs('industri.absensi.*') ? 'active' : '' }}"
              href="{{ route('industri.absensi.index') }}">

              <i class="mdi mdi-calendar-check me-2"></i>

              Absensi

            </a>

          </li>


          {{-- =================================================
                         PENILAIAN
                    ================================================== --}}

          <li class="nav-item">

            <a class="nav-link {{ request()->routeIs('industri.penilaian.*') ? 'active' : '' }}"
              href="{{ route('industri.penilaian.index') }}">

              <i class="mdi mdi-star me-2"></i>

              Penilaian

            </a>

          </li>


        </ul>

      </div>

    </li>


    {{-- =====================================================
             AKUN
        ====================================================== --}}

    @php

    $isAkunActive = request()->routeIs([
    'industri.profil.*',
    'industri.password.*'
    ]);

    @endphp


    <li class="nav-item {{ $isAkunActive ? 'active' : '' }}">

      <a class="nav-link"
        data-bs-toggle="collapse"
        href="#menu-akun-industri"
        aria-expanded="{{ $isAkunActive ? 'true' : 'false' }}"
        aria-controls="menu-akun-industri">

        <i class="mdi mdi-account-circle menu-icon"></i>

        <span class="menu-title">
          Akun
        </span>

        <i class="menu-arrow"></i>

      </a>


      <div class="collapse {{ $isAkunActive ? 'show' : '' }}"
        id="menu-akun-industri">

        <ul class="nav flex-column sub-menu">


          {{-- =================================================
                         PROFIL
                    ================================================== --}}

          <li class="nav-item">

            <a class="nav-link {{ request()->routeIs('industri.profil.*') ? 'active' : '' }}"
              href="{{ route('industri.profil.index') }}">

              <i class="mdi mdi-account me-2"></i>

              Profil Saya

            </a>

          </li>


          {{-- =================================================
                         PASSWORD
                    ================================================== --}}

          <li class="nav-item">

            <a class="nav-link {{ request()->routeIs('industri.password.*') ? 'active' : '' }}"
              href="{{ route('industri.password.index') }}">

              <i class="mdi mdi-lock-outline me-2"></i>

              Ubah Password

            </a>

          </li>


        </ul>

      </div>

    </li>


  </ul>

</nav>