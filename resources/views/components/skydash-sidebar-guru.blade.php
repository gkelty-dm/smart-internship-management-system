<nav class="sidebar sidebar-offcanvas" id="sidebar">

    <ul class="nav">

        {{-- =====================================================
             DASHBOARD
        ====================================================== --}}

        <li class="nav-item {{ request()->routeIs('guru.dashboard') ? 'active' : '' }}">

            <a class="nav-link"
                href="{{ route('guru.dashboard') }}">

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
        'guru.siswa.*',
        'guru.logbook.*',
        'guru.absensi.*',
        'guru.penilaian.*'
        ]);

        @endphp


        <li class="nav-item {{ $isMonitoringActive ? 'active' : '' }}">

            <a class="nav-link"
                data-bs-toggle="collapse"
                href="#menu-monitoring-guru"
                aria-expanded="{{ $isMonitoringActive ? 'true' : 'false' }}"
                aria-controls="menu-monitoring-guru">

                <i class="mdi mdi-clipboard-text menu-icon"></i>

                <span class="menu-title">
                    Monitoring PKL
                </span>

                <i class="menu-arrow"></i>

            </a>


            <div class="collapse {{ $isMonitoringActive ? 'show' : '' }}"
                id="menu-monitoring-guru">

                <ul class="nav flex-column sub-menu">


                    {{-- =================================================
                         SISWA BIMBINGAN
                    ================================================== --}}

                    <li class="nav-item">

                        <a class="nav-link {{ request()->routeIs('guru.siswa.*') ? 'active' : '' }}"
                            href="{{ route('guru.siswa.index') }}">

                            <i class="mdi mdi-account-group me-2"></i>

                            Siswa Bimbingan

                        </a>

                    </li>


                    {{-- =================================================
                         LOGBOOK
                    ================================================== --}}

                    <li class="nav-item">

                        <a class="nav-link {{ request()->routeIs('guru.logbook.*') ? 'active' : '' }}"
                            href="{{ route('guru.logbook.index') }}">

                            <i class="mdi mdi-book-open-page-variant me-2"></i>

                            Logbook

                        </a>

                    </li>


                    {{-- =================================================
                         ABSENSI
                    ================================================== --}}

                    <li class="nav-item">

                        <a class="nav-link {{ request()->routeIs('guru.absensi.*') ? 'active' : '' }}"
                            href="{{ route('guru.absensi.index') }}">

                            <i class="mdi mdi-calendar-check me-2"></i>

                            Absensi

                        </a>

                    </li>


                    {{-- =================================================
                         PENILAIAN
                    ================================================== --}}

                    <li class="nav-item">

                        <a class="nav-link {{ request()->routeIs('guru.penilaian.*') ? 'active' : '' }}"
                            href="{{ route('guru.penilaian.index') }}">

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
        'guru.profil.*',
        'guru.password.*'
        ]);

        @endphp


        <li class="nav-item {{ $isAkunActive ? 'active' : '' }}">

            <a class="nav-link"
                data-bs-toggle="collapse"
                href="#menu-akun-guru"
                aria-expanded="{{ $isAkunActive ? 'true' : 'false' }}"
                aria-controls="menu-akun-guru">

                <i class="mdi mdi-account-circle menu-icon"></i>

                <span class="menu-title">
                    Akun
                </span>

                <i class="menu-arrow"></i>

            </a>


            <div class="collapse {{ $isAkunActive ? 'show' : '' }}"
                id="menu-akun-guru">

                <ul class="nav flex-column sub-menu">


                    {{-- Profil --}}

                    <li class="nav-item">

                        <a class="nav-link {{ request()->routeIs('guru.profil.*') ? 'active' : '' }}"
                            href="{{ route('guru.profil.index') }}">

                            <i class="mdi mdi-account me-2"></i>

                            Profil Saya

                        </a>

                    </li>


                    {{-- Password --}}

                    <li class="nav-item">

                        <a class="nav-link {{ request()->routeIs('guru.password.*') ? 'active' : '' }}"
                            href="{{ route('guru.password.index') }}">

                            <i class="mdi mdi-lock-outline me-2"></i>

                            Ubah Password

                        </a>

                    </li>


                </ul>

            </div>

        </li>


    </ul>

</nav>