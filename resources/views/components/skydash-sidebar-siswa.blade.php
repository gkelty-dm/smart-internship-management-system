<nav class="sidebar sidebar-offcanvas" id="sidebar">

    <ul class="nav">

        {{-- =====================================================
             DASHBOARD
        ====================================================== --}}

        <li class="nav-item
            {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">

            <a
                class="nav-link"
                href="{{ route('siswa.dashboard') }}">

                <i class="mdi mdi-view-dashboard-outline menu-icon"></i>

                <span class="menu-title">
                    Dashboard
                </span>

            </a>

        </li>


        {{-- =====================================================
             ABSEN MASUK
        ====================================================== --}}

        <li class="nav-item
            {{ request()->routeIs('siswa.absensi.masuk*') ? 'active' : '' }}">

            <a
                class="nav-link"
                href="{{ route('siswa.absensi.masuk') }}">

                <i class="mdi mdi-login-variant menu-icon"></i>

                <span class="menu-title">
                    Absen Masuk
                </span>

            </a>

        </li>


        {{-- =====================================================
             ABSEN PULANG
        ====================================================== --}}

        <li class="nav-item
            {{ request()->routeIs('siswa.absensi.pulang*') ? 'active' : '' }}">

            <a
                class="nav-link"
                href="{{ route('siswa.absensi.pulang') }}">

                <i class="mdi mdi-logout-variant menu-icon"></i>

                <span class="menu-title">
                    Absen Pulang
                </span>

            </a>

        </li>


        {{-- =====================================================
             RIWAYAT ABSENSI
        ====================================================== --}}

        <li class="nav-item
            {{ request()->routeIs('siswa.absensi.riwayat') ? 'active' : '' }}">

            <a
                class="nav-link"
                href="{{ route('siswa.absensi.riwayat') }}">

                <i class="mdi mdi-calendar-clock-outline menu-icon"></i>

                <span class="menu-title">
                    Riwayat Absensi
                </span>

            </a>

        </li>


        {{-- =====================================================
             LOGBOOK
        ====================================================== --}}

        <li class="nav-item
            {{ request()->routeIs('siswa.logbook.*') ? 'active' : '' }}">

            <a
                class="nav-link"
                href="{{ route('siswa.logbook.index') }}">

                <i class="mdi mdi-notebook-outline menu-icon"></i>

                <span class="menu-title">
                    Logbook
                </span>

            </a>

        </li>


        {{-- =====================================================
             PROFIL PKL
        ====================================================== --}}

        <li class="nav-item
            {{ request()->routeIs('siswa.pkl.*') ? 'active' : '' }}">

            <a
                class="nav-link"
                href="{{ route('siswa.pkl.index') }}">

                <i class="mdi mdi-briefcase-outline menu-icon"></i>

                <span class="menu-title">
                    Profil PKL
                </span>

            </a>

        </li>


        {{-- =====================================================
             NILAI PKL
        ====================================================== --}}

        <li class="nav-item
            {{ request()->routeIs('siswa.nilai.*') ? 'active' : '' }}">

            <a
                class="nav-link"
                href="{{ route('siswa.nilai.index') }}">

                <i class="mdi mdi-school-outline menu-icon"></i>

                <span class="menu-title">
                    Nilai PKL
                </span>

            </a>

        </li>


        {{-- =====================================================
             REGISTRASI WAJAH
        ====================================================== --}}

        <li class="nav-item
            {{ request()->routeIs('siswa.face.*') ? 'active' : '' }}">

            <a
                class="nav-link"
                href="{{ route('siswa.face.register') }}">

                <i class="mdi mdi-face-recognition menu-icon"></i>

                <span class="menu-title">
                    Registrasi Wajah
                </span>

            </a>

        </li>


        {{-- =====================================================
             PROFIL SAYA
        ====================================================== --}}

        <li class="nav-item
            {{ request()->routeIs('siswa.profil.*') ? 'active' : '' }}">

            <a
                class="nav-link"
                href="{{ route('siswa.profil.index') }}">

                <i class="mdi mdi-account-circle-outline menu-icon"></i>

                <span class="menu-title">
                    Profil Saya
                </span>

            </a>

        </li>


        {{-- =====================================================
             UBAH PASSWORD
        ====================================================== --}}

        <li class="nav-item
            {{ request()->routeIs('siswa.password.*') ? 'active' : '' }}">

            <a
                class="nav-link"
                href="{{ route('siswa.password.index') }}">

                <i class="mdi mdi-lock-outline menu-icon"></i>

                <span class="menu-title">
                    Ubah Password
                </span>

            </a>

        </li>


        {{-- =====================================================
             LOGOUT
        ====================================================== --}}

        <li class="nav-item">

            <a
                class="nav-link"
                href="#"
                onclick="
                    event.preventDefault();
                    document.getElementById('siswa-logout-form').submit();
                ">

                <i class="mdi mdi-logout menu-icon text-danger"></i>

                <span class="menu-title text-danger">
                    Logout
                </span>

            </a>


            <form
                id="siswa-logout-form"
                action="{{ route('logout') }}"
                method="POST"
                style="display:none;">

                @csrf

            </form>

        </li>

    </ul>

</nav>