<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">

        {{-- Dashboard --}}
        <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="mdi mdi-view-dashboard menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        {{-- Manajemen User --}}
        <li class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.users.index') }}">
                <i class="mdi mdi-account-group menu-icon"></i>
                <span class="menu-title">Manajemen User</span>
            </a>
        </li>

        {{-- Group Master Data --}}
        @php
        $isMasterActive = request()->routeIs([
        'admin.jurusan.*',
        'admin.kelas.*',
        'admin.siswa.*',
        'admin.guru-pembimbing.*',
        'admin.industri.*',
        'admin.industri-pembimbing.*'
        ]);
        @endphp
        <li class="nav-item {{ $isMasterActive ? 'active' : '' }}">
            <a class="nav-link"
                data-bs-toggle="collapse"
                href="#master-data"
                aria-expanded="{{ $isMasterActive ? 'true' : 'false' }}"
                aria-controls="master-data">
                <i class="mdi mdi-database menu-icon"></i>
                <span class="menu-title">Master Data</span>
                <i class="menu-arrow"></i>
            </a>

            <div class="collapse {{ $isMasterActive ? 'show' : '' }}" id="master-data">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.jurusan.*') ? 'active' : '' }}"
                            href="{{ route('admin.jurusan.index') }}">
                            <i class="mdi mdi-school me-2"></i> Jurusan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.kelas.*') ? 'active' : '' }}"
                            href="{{ route('admin.kelas.index') }}">
                            <i class="mdi mdi-google-classroom me-2"></i> Kelas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}"
                            href="{{ route('admin.siswa.index') }}">
                            <i class="mdi mdi-account-multiple me-2"></i> Siswa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.guru-pembimbing.*') ? 'active' : '' }}"
                            href="{{ route('admin.guru-pembimbing.index') }}">
                            <i class="mdi mdi-human-male-board me-2"></i> Guru Pembimbing
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.industri.*') ? 'active' : '' }}"
                            href="{{ route('admin.industri.index') }}">
                            <i class="mdi mdi-factory me-2"></i> Industri / DUDI
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.industri-pembimbing.*') ? 'active' : '' }}"
                            href="{{ route('admin.industri-pembimbing.index') }}">
                            <i class="mdi mdi-account-tie me-2"></i> Pembimbing Industri
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        {{-- Group Manajemen PKL --}}
        @php
        $isPklActive = request()->routeIs([
        'admin.penempatan-pkl.*',
        'admin.absensi*',
        'admin.logbook*',
        'admin.nilai.*'
        ]);
        @endphp
        <li class="nav-item {{ $isPklActive ? 'active' : '' }}">
            <a class="nav-link"
                data-bs-toggle="collapse"
                href="#menu-pkl"
                aria-expanded="{{ $isPklActive ? 'true' : 'false' }}"
                aria-controls="menu-pkl">
                <i class="mdi mdi-briefcase menu-icon"></i>
                <span class="menu-title">Manajemen PKL</span>
                <i class="menu-arrow"></i>
            </a>

            <div class="collapse {{ $isPklActive ? 'show' : '' }}" id="menu-pkl">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.penempatan-pkl.*') ? 'active' : '' }}"
                            href="{{ route('admin.penempatan-pkl.index') }}">
                            <i class="mdi mdi-map-marker-radius me-2"></i> Penempatan PKL
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.absensi*') ? 'active' : '' }}"
                            href="{{ route('admin.absensi') }}">
                            <i class="mdi mdi-calendar-check me-2"></i> Absensi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.logbook*') ? 'active' : '' }}"
                            href="{{ route('admin.logbook') }}">
                            <i class="mdi mdi-book-open-page-variant me-2"></i> Logbook
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.nilai.*') ? 'active' : '' }}"
                            href="{{ route('admin.nilai.index') }}">
                            <i class="mdi mdi-file-document-box me-2"></i> Nilai
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        {{-- Profil --}}
        <li class="nav-item {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.profile') }}">
                <i class="mdi mdi-account-circle menu-icon"></i>
                <span class="menu-title">Profil Saya</span>
            </a>
        </li>

    </ul>
</nav>