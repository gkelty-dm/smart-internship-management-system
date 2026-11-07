@extends('layouts.skydash-guru')

@section('title', 'Siswa Bimbingan')

@section('content')

{{-- =========================================================
     HEADER
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center flex-wrap">

                    <div>

                        <div class="d-flex align-items-center">

                            <div
                                class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3"
                                style="width:46px;height:46px;">

                                <i
                                    class="mdi mdi-account-group-outline text-white"
                                    style="font-size:22px;">
                                </i>

                            </div>

                            <div>

                                <h4 class="font-weight-bold mb-1">
                                    Siswa Bimbingan
                                </h4>

                                <p class="text-muted mb-0 small">
                                    Daftar siswa yang menjadi tanggung jawab bimbingan Anda.
                                </p>

                            </div>

                        </div>

                    </div>

                    <div class="mt-3 mt-md-0">

                        <span class="badge bg-light text-primary border px-3 py-2">

                            <i class="mdi mdi-account-group-outline me-1"></i>

                            {{ $penempatans->count() }} Siswa

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     STATISTIK
========================================================= --}}

<div class="row">

    {{-- TOTAL SISWA --}}

    <div class="col-xl-4 col-md-6 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <p class="text-muted mb-2 small">
                            Total Siswa
                        </p>

                        <h2 class="font-weight-bold mb-0">
                            {{ $penempatans->count() }}
                        </h2>

                    </div>

                    <div
                        class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                        style="width:52px;height:52px;">

                        <i
                            class="mdi mdi-account-group-outline text-white"
                            style="font-size:25px;">
                        </i>

                    </div>

                </div>

                <div class="border-top mt-3 pt-3">

                    <span class="text-muted small">
                        Seluruh siswa bimbingan
                    </span>

                </div>

            </div>

        </div>

    </div>


    {{-- PKL AKTIF --}}

    <div class="col-xl-4 col-md-6 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <p class="text-muted mb-2 small">
                            PKL Aktif
                        </p>

                        <h2 class="font-weight-bold mb-0">
                            {{ $penempatans->where('status_pkl', 'aktif')->count() }}
                        </h2>

                    </div>

                    <div
                        class="bg-success rounded-circle d-flex align-items-center justify-content-center"
                        style="width:52px;height:52px;">

                        <i
                            class="mdi mdi-briefcase-check-outline text-white"
                            style="font-size:25px;">
                        </i>

                    </div>

                </div>

                <div class="border-top mt-3 pt-3">

                    <span class="text-muted small">
                        Siswa yang sedang menjalani PKL
                    </span>

                </div>

            </div>

        </div>

    </div>


    {{-- PKL SELESAI --}}

    <div class="col-xl-4 col-md-6 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <p class="text-muted mb-2 small">
                            PKL Selesai
                        </p>

                        <h2 class="font-weight-bold mb-0">
                            {{ $penempatans->where('status_pkl', 'selesai')->count() }}
                        </h2>

                    </div>

                    <div
                        class="bg-info rounded-circle d-flex align-items-center justify-content-center"
                        style="width:52px;height:52px;">

                        <i
                            class="mdi mdi-check-circle-outline text-white"
                            style="font-size:25px;">
                        </i>

                    </div>

                </div>

                <div class="border-top mt-3 pt-3">

                    <span class="text-muted small">
                        Siswa yang telah menyelesaikan PKL
                    </span>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     DATA SISWA
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                {{-- HEADER TABLE --}}

                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">

                    <div>

                        <h5 class="card-title mb-1">
                            Daftar Siswa Bimbingan
                        </h5>

                        <p class="card-description mb-0">
                            Kelola dan pantau data siswa PKL yang menjadi tanggung jawab Anda.
                        </p>

                    </div>

                </div>


                {{-- =====================================================
                     FILTER COMPACT
                ====================================================== --}}

                <div class="border rounded p-2 mb-4">

                    <div class="row align-items-center g-2">

                        {{-- SEARCH --}}

                        <div class="col-xl-5 col-lg-5 col-md-6">

                            <div class="input-group input-group-sm">

                                <span class="input-group-text bg-white border-end-0">

                                    <i class="mdi mdi-magnify text-primary"></i>

                                </span>

                                <input
                                    type="text"
                                    id="searchSiswa"
                                    class="form-control border-start-0"
                                    placeholder="Cari nama siswa / NISN...">

                            </div>

                        </div>


                        {{-- FILTER KELAS --}}

                        <div class="col-xl-2 col-lg-2 col-md-6">

                            <select
                                id="filterKelas"
                                class="form-select form-select-sm">

                                <option value="">
                                    Semua Kelas
                                </option>

                                @foreach(
                                $penempatans
                                ->map(fn($item) => $item->siswa?->kelas?->nama_kelas)
                                ->filter()
                                ->unique()
                                ->sort()
                                as $kelas
                                )

                                <option value="{{ strtolower($kelas) }}">

                                    {{ $kelas }}

                                </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- FILTER STATUS --}}

                        <div class="col-xl-2 col-lg-2 col-md-6">

                            <select
                                id="filterStatus"
                                class="form-select form-select-sm">

                                <option value="">
                                    Semua Status
                                </option>

                                <option value="aktif">
                                    Aktif
                                </option>

                                <option value="selesai">
                                    Selesai
                                </option>

                                <option value="pending">
                                    Pending
                                </option>

                            </select>

                        </div>


                        {{-- JUMLAH DATA --}}

                        <div class="col-xl-2 col-lg-2 col-md-6">

                            <div class="text-muted small text-center">

                                <i class="mdi mdi-account-group-outline me-1"></i>

                                <strong
                                    id="jumlahHasil"
                                    class="text-dark">

                                    {{ $penempatans->count() }}

                                </strong>

                                siswa

                            </div>

                        </div>


                        {{-- RESET --}}

                        <div class="col-xl-1 col-lg-1 col-md-12">

                            <button
                                type="button"
                                id="resetFilter"
                                class="btn btn-sm btn-light border w-100"
                                title="Reset Filter">

                                <i class="mdi mdi-refresh"></i>

                            </button>

                        </div>

                    </div>

                </div>


                {{-- =====================================================
                     TABLE
                ====================================================== --}}

                @if($penempatans->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead>

                            <tr>

                                <th width="55">
                                    #
                                </th>

                                <th>
                                    Siswa
                                </th>

                                <th>
                                    NISN
                                </th>

                                <th>
                                    Kelas
                                </th>

                                <th>
                                    Perusahaan
                                </th>

                                <th>
                                    Status
                                </th>

                                <th
                                    width="90"
                                    class="text-center">

                                    Aksi

                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($penempatans as $index => $penempatan)

                            @php

                            $siswa = $penempatan->siswa;

                            $namaSiswa = $siswa && $siswa->user
                            ? $siswa->user->name
                            : '';

                            $nisnSiswa = $siswa
                            ? $siswa->nisn
                            : '';

                            $namaKelas = $siswa && $siswa->kelas
                            ? $siswa->kelas->nama_kelas
                            : '';

                            $statusPKL = $penempatan->status_pkl ?? '';

                            @endphp

                            <tr
                                class="data-siswa"
                                data-nama="{{ strtolower($namaSiswa) }}"
                                data-nisn="{{ strtolower($nisnSiswa) }}"
                                data-kelas="{{ strtolower($namaKelas) }}"
                                data-status="{{ strtolower($statusPKL) }}">

                                {{-- NOMOR --}}

                                <td>

                                    <span class="text-muted">
                                        {{ $index + 1 }}
                                    </span>

                                </td>


                                {{-- SISWA --}}

                                <td>

                                    <div class="d-flex align-items-center">

                                        @if(
                                        $siswa &&
                                        $siswa->user &&
                                        $siswa->user->foto_profil
                                        )

                                        <img
                                            src="{{ $siswa->user->foto_profil }}"
                                            width="42"
                                            height="42"
                                            class="rounded-circle me-3"
                                            alt="Foto Profil">

                                        @else

                                        <div
                                            class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3"
                                            style="width:42px;height:42px;">

                                            <i
                                                class="mdi mdi-account-outline text-muted"
                                                style="font-size:22px;">
                                            </i>

                                        </div>

                                        @endif

                                        <div>

                                            <h6 class="font-weight-bold mb-1">

                                                {{ $namaSiswa ?: '-' }}

                                            </h6>

                                            <small class="text-muted">

                                                {{ $siswa && $siswa->jurusan
                                                            ? $siswa->jurusan->nama_jurusan
                                                            : 'Jurusan belum tersedia' }}

                                            </small>

                                        </div>

                                    </div>

                                </td>


                                {{-- NISN --}}

                                <td>

                                    <span class="text-muted">

                                        {{ $nisnSiswa ?: '-' }}

                                    </span>

                                </td>


                                {{-- KELAS --}}

                                <td>

                                    @if($namaKelas)

                                    <span class="badge bg-light text-dark border">

                                        <i class="mdi mdi-google-classroom me-1 text-primary"></i>

                                        {{ $namaKelas }}

                                    </span>

                                    @else

                                    <span class="text-muted">
                                        -
                                    </span>

                                    @endif

                                </td>


                                {{-- PERUSAHAAN --}}

                                <td>

                                    @if($penempatan->perusahaan)

                                    <div class="d-flex align-items-center">

                                        <div
                                            class="bg-light rounded d-flex align-items-center justify-content-center me-2"
                                            style="width:34px;height:34px;">

                                            <i class="mdi mdi-domain text-primary"></i>

                                        </div>

                                        <span class="font-weight-medium">

                                            {{ $penempatan->perusahaan->nama_perusahaan }}

                                        </span>

                                    </div>

                                    @else

                                    <span class="text-muted">
                                        -
                                    </span>

                                    @endif

                                </td>


                                {{-- STATUS --}}

                                <td>

                                    @if($statusPKL === 'aktif')

                                    <span class="badge bg-success">

                                        <i class="mdi mdi-check-circle-outline me-1"></i>

                                        Aktif

                                    </span>

                                    @elseif($statusPKL === 'selesai')

                                    <span class="badge bg-primary">

                                        <i class="mdi mdi-check-all me-1"></i>

                                        Selesai

                                    </span>

                                    @elseif($statusPKL === 'pending')

                                    <span class="badge bg-warning text-dark">

                                        <i class="mdi mdi-clock-outline me-1"></i>

                                        Pending

                                    </span>

                                    @else

                                    <span class="badge bg-secondary">

                                        {{ ucfirst($statusPKL ?: '-') }}

                                    </span>

                                    @endif

                                </td>


                                {{-- AKSI --}}

                                <td class="text-center">

                                    @if($siswa)

                                    <div class="dropdown">

                                        <button
                                            type="button"
                                            class="btn btn-outline-primary btn-sm"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false"
                                            title="Menu Siswa">

                                            <i class="mdi mdi-dots-horizontal"></i>

                                        </button>

                                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">

                                            <li>

                                                <a
                                                    class="dropdown-item"
                                                    href="{{ route(
                                                                    'guru.siswa.show',
                                                                    ['siswa' => $siswa->id]
                                                                ) }}">

                                                    <i class="mdi mdi-account-card-outline me-2 text-primary"></i>

                                                    Detail Siswa

                                                </a>

                                            </li>

                                            <li>

                                                <a
                                                    class="dropdown-item"
                                                    href="{{ route(
                                                                    'guru.siswa.absensi',
                                                                    ['siswa' => $siswa->id]
                                                                ) }}">

                                                    <i class="mdi mdi-calendar-check-outline me-2 text-success"></i>

                                                    Absensi

                                                </a>

                                            </li>

                                            <li>

                                                <a
                                                    class="dropdown-item"
                                                    href="{{ route(
                                                                    'guru.siswa.logbook',
                                                                    ['siswa' => $siswa->id]
                                                                ) }}">

                                                    <i class="mdi mdi-book-open-page-variant me-2 text-warning"></i>

                                                    Logbook

                                                </a>

                                            </li>

                                            <li>

                                                <a
                                                    class="dropdown-item"
                                                    href="{{ route(
                                                                    'guru.siswa.penilaian',
                                                                    ['siswa' => $siswa->id]
                                                                ) }}">

                                                    <i class="mdi mdi-star-outline me-2 text-info"></i>

                                                    Penilaian

                                                </a>

                                            </li>

                                            <li>

                                                <hr class="dropdown-divider">

                                            </li>

                                            <li>

                                                <a
                                                    class="dropdown-item"
                                                    href="{{ route(
                                                                    'guru.siswa.laporan',
                                                                    ['siswa' => $siswa->id]
                                                                ) }}">

                                                    <i class="mdi mdi-file-pdf-box me-2 text-danger"></i>

                                                    Cetak Laporan

                                                </a>

                                            </li>

                                        </ul>

                                    </div>

                                    @else

                                    <span class="text-muted">
                                        -
                                    </span>

                                    @endif

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                {{-- FILTER TIDAK DITEMUKAN --}}

                <div
                    id="emptyFilter"
                    class="text-center py-5 d-none">

                    <div
                        class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                        style="width:75px;height:75px;">

                        <i
                            class="mdi mdi-account-search-outline text-muted"
                            style="font-size:35px;">
                        </i>

                    </div>

                    <h6 class="font-weight-bold mb-2">
                        Data Tidak Ditemukan
                    </h6>

                    <p class="text-muted small mb-0">
                        Tidak ada siswa yang sesuai dengan pencarian atau filter.
                    </p>

                </div>

                @else

                {{-- DATA KOSONG --}}

                <div class="text-center py-5">

                    <div
                        class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                        style="width:85px;height:85px;">

                        <i
                            class="mdi mdi-account-search-outline text-muted"
                            style="font-size:42px;">
                        </i>

                    </div>

                    <h5 class="font-weight-bold mb-2">
                        Belum Ada Siswa Bimbingan
                    </h5>

                    <p class="text-muted small mb-0">
                        Belum terdapat siswa yang ditempatkan
                        pada bimbingan Anda.
                    </p>

                </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection


{{-- =========================================================
     SCRIPT FILTER
========================================================= --}}

@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const searchInput =
            document.getElementById('searchSiswa');

        const filterKelas =
            document.getElementById('filterKelas');

        const filterStatus =
            document.getElementById('filterStatus');

        const resetButton =
            document.getElementById('resetFilter');

        const jumlahHasil =
            document.getElementById('jumlahHasil');

        const emptyFilter =
            document.getElementById('emptyFilter');

        const rows =
            document.querySelectorAll('.data-siswa');


        if (
            !searchInput ||
            !filterKelas ||
            !filterStatus ||
            !resetButton
        ) {
            return;
        }


        function filterData() {

            const search =
                searchInput.value
                .toLowerCase()
                .trim();

            const kelas =
                filterKelas.value
                .toLowerCase();

            const status =
                filterStatus.value
                .toLowerCase();


            let jumlah = 0;


            rows.forEach(function(row) {

                const nama =
                    row.dataset.nama || '';

                const nisn =
                    row.dataset.nisn || '';

                const rowKelas =
                    row.dataset.kelas || '';

                const rowStatus =
                    row.dataset.status || '';


                const cocokSearch =
                    nama.includes(search) ||
                    nisn.includes(search);


                const cocokKelas = !kelas ||
                    rowKelas === kelas;


                const cocokStatus = !status ||
                    rowStatus === status;


                if (
                    cocokSearch &&
                    cocokKelas &&
                    cocokStatus
                ) {

                    row.style.display = '';

                    jumlah++;

                } else {

                    row.style.display = 'none';

                }

            });


            jumlahHasil.textContent = jumlah;


            if (emptyFilter) {

                if (jumlah === 0) {

                    emptyFilter.classList.remove('d-none');

                } else {

                    emptyFilter.classList.add('d-none');

                }

            }

        }


        searchInput.addEventListener(
            'input',
            filterData
        );


        filterKelas.addEventListener(
            'change',
            filterData
        );


        filterStatus.addEventListener(
            'change',
            filterData
        );


        resetButton.addEventListener(
            'click',
            function() {

                searchInput.value = '';

                filterKelas.value = '';

                filterStatus.value = '';


                rows.forEach(function(row) {

                    row.style.display = '';

                });


                jumlahHasil.textContent =
                    rows.length;


                if (emptyFilter) {

                    emptyFilter.classList.add('d-none');

                }

            }
        );


        filterData();

    });
</script>

@endpush