@extends('layouts.skydash-guru')

@section('title', 'Absensi Siswa')

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
                                    class="mdi mdi-calendar-check text-white"
                                    style="font-size:22px;">
                                </i>

                            </div>

                            <div>

                                <h4 class="font-weight-bold mb-1">
                                    Absensi Siswa
                                </h4>

                                <p class="text-muted mb-0 small">
                                    Riwayat kehadiran siswa yang menjadi tanggung jawab bimbingan Anda.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="mt-3 mt-md-0">

                        <span class="badge bg-light text-primary border px-3 py-2">

                            <i class="mdi mdi-calendar-check-outline me-1"></i>

                            <span id="jumlahHasil">

                                {{ $absensis->count() }}

                            </span>

                            Data

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

    {{-- TOTAL ABSENSI --}}

    <div class="col-xl-6 col-md-6 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <p class="text-muted mb-2 small">
                            Total Absensi
                        </p>

                        <h2 class="font-weight-bold mb-0">

                            {{ $absensis->count() }}

                        </h2>

                    </div>


                    <div
                        class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                        style="width:52px;height:52px;">

                        <i
                            class="mdi mdi-calendar-multiple text-white"
                            style="font-size:25px;">
                        </i>

                    </div>

                </div>


                <div class="border-top mt-3 pt-3">

                    <span class="text-muted small">

                        Seluruh data kehadiran siswa

                    </span>

                </div>

            </div>

        </div>

    </div>


    {{-- TOTAL HADIR --}}

    <div class="col-xl-6 col-md-6 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <p class="text-muted mb-2 small">
                            Hadir
                        </p>

                        <h2 class="font-weight-bold mb-0">

                            {{ $absensis->where('status', 'hadir')->count() }}

                        </h2>

                    </div>


                    <div
                        class="bg-success rounded-circle d-flex align-items-center justify-content-center"
                        style="width:52px;height:52px;">

                        <i
                            class="mdi mdi-check-circle-outline text-white"
                            style="font-size:25px;">
                        </i>

                    </div>

                </div>


                <div class="border-top mt-3 pt-3">

                    <span class="text-muted small">

                        Jumlah kehadiran siswa

                    </span>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     DATA ABSENSI
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">


                {{-- =================================================
                     HEADER TABLE
                ================================================== --}}

                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">

                    <div>

                        <h5 class="card-title mb-1">
                            Riwayat Absensi
                        </h5>

                        <p class="card-description mb-0">
                            Kelola dan pantau kehadiran siswa bimbingan Anda.
                        </p>

                    </div>

                </div>


                {{-- =================================================
                     FILTER COMPACT
                ================================================== --}}

                <div class="border rounded p-2 mb-4">

                    <div class="row align-items-center g-2">


                        {{-- SEARCH --}}

                        <div class="col-xl-4 col-lg-4 col-md-6">

                            <div class="input-group input-group-sm">

                                <span
                                    class="input-group-text bg-white border-end-0">

                                    <i class="mdi mdi-magnify text-primary"></i>

                                </span>


                                <input
                                    type="text"
                                    id="searchAbsensi"
                                    class="form-control border-start-0"
                                    placeholder="Cari nama siswa / NISN..."
                                    autocomplete="off">

                            </div>

                        </div>


                        {{-- TANGGAL MULAI --}}

                        <div class="col-xl-2 col-lg-2 col-md-3">

                            <input
                                type="date"
                                id="filterTanggalMulai"
                                class="form-control form-control-sm"
                                title="Tanggal mulai">

                        </div>


                        {{-- TANGGAL SELESAI --}}

                        <div class="col-xl-2 col-lg-2 col-md-3">

                            <input
                                type="date"
                                id="filterTanggalSelesai"
                                class="form-control form-control-sm"
                                title="Tanggal selesai">

                        </div>


                        {{-- STATUS --}}

                        <div class="col-xl-2 col-lg-2 col-md-6">

                            <select
                                id="filterStatus"
                                class="form-select form-select-sm">

                                <option value="">
                                    Semua Status
                                </option>

                                <option value="hadir">
                                    Hadir
                                </option>

                            </select>

                        </div>


                        {{-- JUMLAH HASIL --}}

                        <div class="col-xl-1 col-lg-1 col-md-6">

                            <div class="text-muted small text-center">

                                <i class="mdi mdi-format-list-numbered me-1"></i>

                                <strong
                                    id="jumlahFilter"
                                    class="text-dark">

                                    {{ $absensis->count() }}

                                </strong>

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


                {{-- =================================================
                     TABLE
                ================================================== --}}

                @if($absensis->count() > 0)

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
                                    Tanggal
                                </th>

                                <th>
                                    Jam Masuk
                                </th>

                                <th>
                                    Jam Pulang
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

                            @foreach($absensis as $index => $absensi)

                            @php

                            $siswa = $absensi->siswa;

                            $namaSiswa =
                            $siswa &&
                            $siswa->user
                            ? $siswa->user->name
                            : '';

                            $nisnSiswa =
                            $siswa
                            ? $siswa->nisn
                            : '';

                            $tanggalAbsensi =
                            $absensi->tanggal
                            ? \Carbon\Carbon::parse(
                            $absensi->tanggal
                            )->format('Y-m-d')
                            : '';

                            $tanggalTampilan =
                            $absensi->tanggal
                            ? \Carbon\Carbon::parse(
                            $absensi->tanggal
                            )->translatedFormat('d M Y')
                            : '-';

                            $statusAbsensi =
                            strtolower(
                            $absensi->status ?? ''
                            );

                            @endphp


                            <tr
                                class="data-absensi"

                                data-nama="{{ strtolower($namaSiswa) }}"

                                data-nisn="{{ strtolower($nisnSiswa) }}"

                                data-tanggal="{{ $tanggalAbsensi }}"

                                data-status="{{ $statusAbsensi }}">


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
                                            style="object-fit:cover;"
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

                                                <i
                                                    class="mdi mdi-card-account-details-outline me-1">
                                                </i>

                                                NISN:

                                                {{ $nisnSiswa ?: '-' }}

                                            </small>

                                        </div>

                                    </div>

                                </td>


                                {{-- TANGGAL --}}

                                <td>

                                    <div class="d-flex align-items-center">

                                        <div
                                            class="bg-light rounded d-flex align-items-center justify-content-center me-2"
                                            style="width:34px;height:34px;">

                                            <i
                                                class="mdi mdi-calendar-outline text-primary">
                                            </i>

                                        </div>


                                        <span>

                                            {{ $tanggalTampilan }}

                                        </span>

                                    </div>

                                </td>


                                {{-- JAM MASUK --}}

                                <td>

                                    @if($absensi->jam_masuk)

                                    <span class="text-success fw-semibold">

                                        <i class="mdi mdi-login me-1"></i>

                                        {{ $absensi->jam_masuk }}

                                    </span>

                                    @else

                                    <span class="text-muted">
                                        -
                                    </span>

                                    @endif

                                </td>


                                {{-- JAM PULANG --}}

                                <td>

                                    @if($absensi->jam_pulang)

                                    <span class="text-danger fw-semibold">

                                        <i class="mdi mdi-logout me-1"></i>

                                        {{ $absensi->jam_pulang }}

                                    </span>

                                    @else

                                    <span class="text-muted">
                                        -
                                    </span>

                                    @endif

                                </td>


                                {{-- STATUS --}}

                                <td>

                                    @if($statusAbsensi === 'hadir')

                                    <span class="badge bg-success">

                                        <i
                                            class="mdi mdi-check-circle-outline me-1">
                                        </i>

                                        Hadir

                                    </span>

                                    @else

                                    <span class="badge bg-secondary">

                                        {{ ucfirst($statusAbsensi ?: '-') }}

                                    </span>

                                    @endif

                                </td>


                                {{-- AKSI --}}

                                <td class="text-center">

                                    <a
                                        href="{{ route(
                                            'guru.absensi.show',
                                            ['absensi' => $absensi->id]
                                        ) }}"
                                        class="btn btn-outline-primary btn-sm"
                                        title="Detail Absensi">

                                        <i
                                            class="mdi mdi-eye-outline">
                                        </i>

                                    </a>

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                {{-- =================================================
                     FILTER TIDAK DITEMUKAN
                ================================================== --}}

                <div
                    id="emptyFilter"
                    class="text-center py-5 d-none">

                    <div
                        class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                        style="width:75px;height:75px;">

                        <i
                            class="mdi mdi-calendar-search-outline text-muted"
                            style="font-size:35px;">
                        </i>

                    </div>


                    <h6 class="font-weight-bold mb-2">

                        Data Tidak Ditemukan

                    </h6>


                    <p class="text-muted small mb-0">

                        Tidak ada data absensi yang sesuai dengan pencarian atau filter.

                    </p>

                </div>

                @else

                {{-- =================================================
                     DATA KOSONG
                ================================================== --}}

                <div class="text-center py-5">

                    <div
                        class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                        style="width:85px;height:85px;">

                        <i
                            class="mdi mdi-calendar-remove-outline text-muted"
                            style="font-size:42px;">
                        </i>

                    </div>


                    <h5 class="font-weight-bold mb-2">

                        Belum Ada Data Absensi

                    </h5>


                    <p class="text-muted small mb-0">

                        Belum terdapat riwayat kehadiran siswa bimbingan Anda.

                    </p>

                </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection


{{-- =========================================================
     SCRIPT FILTER OTOMATIS
========================================================= --}}

@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const searchInput =
            document.getElementById('searchAbsensi');

        const filterTanggalMulai =
            document.getElementById('filterTanggalMulai');

        const filterTanggalSelesai =
            document.getElementById('filterTanggalSelesai');

        const filterStatus =
            document.getElementById('filterStatus');

        const resetButton =
            document.getElementById('resetFilter');

        const jumlahHasil =
            document.getElementById('jumlahHasil');

        const jumlahFilter =
            document.getElementById('jumlahFilter');

        const emptyFilter =
            document.getElementById('emptyFilter');

        const rows =
            document.querySelectorAll('.data-absensi');


        if (
            !searchInput ||
            !filterTanggalMulai ||
            !filterTanggalSelesai ||
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


            const tanggalMulai =
                filterTanggalMulai.value;


            const tanggalSelesai =
                filterTanggalSelesai.value;


            const status =
                filterStatus.value
                .toLowerCase();


            let jumlah = 0;


            rows.forEach(function(row) {

                const nama =
                    row.dataset.nama || '';


                const nisn =
                    row.dataset.nisn || '';


                const tanggal =
                    row.dataset.tanggal || '';


                const rowStatus =
                    row.dataset.status || '';


                /*
                |--------------------------------------------------------------------------
                | SEARCH
                |--------------------------------------------------------------------------
                */

                const cocokSearch =
                    nama.includes(search) ||
                    nisn.includes(search);


                /*
                |--------------------------------------------------------------------------
                | TANGGAL MULAI
                |--------------------------------------------------------------------------
                */

                const cocokTanggalMulai = !tanggalMulai ||
                    tanggal >= tanggalMulai;


                /*
                |--------------------------------------------------------------------------
                | TANGGAL SELESAI
                |--------------------------------------------------------------------------
                */

                const cocokTanggalSelesai = !tanggalSelesai ||
                    tanggal <= tanggalSelesai;


                /*
                |--------------------------------------------------------------------------
                | STATUS
                |--------------------------------------------------------------------------
                */

                const cocokStatus = !status ||
                    rowStatus === status;


                /*
                |--------------------------------------------------------------------------
                | HASIL
                |--------------------------------------------------------------------------
                */

                if (
                    cocokSearch &&
                    cocokTanggalMulai &&
                    cocokTanggalSelesai &&
                    cocokStatus
                ) {

                    row.style.display = '';

                    jumlah++;

                } else {

                    row.style.display = 'none';

                }

            });


            /*
            |--------------------------------------------------------------------------
            | UPDATE JUMLAH
            |--------------------------------------------------------------------------
            */

            if (jumlahHasil) {

                jumlahHasil.textContent =
                    jumlah;

            }


            if (jumlahFilter) {

                jumlahFilter.textContent =
                    jumlah;

            }


            /*
            |--------------------------------------------------------------------------
            | EMPTY STATE
            |--------------------------------------------------------------------------
            */

            if (emptyFilter) {

                if (jumlah === 0) {

                    emptyFilter.classList.remove(
                        'd-none'
                    );

                } else {

                    emptyFilter.classList.add(
                        'd-none'
                    );

                }

            }

        }


        /*
        |--------------------------------------------------------------------------
        | SEARCH REALTIME
        |--------------------------------------------------------------------------
        */

        searchInput.addEventListener(
            'input',
            filterData
        );


        /*
        |--------------------------------------------------------------------------
        | FILTER TANGGAL
        |--------------------------------------------------------------------------
        */

        filterTanggalMulai.addEventListener(
            'change',
            filterData
        );


        filterTanggalSelesai.addEventListener(
            'change',
            filterData
        );


        /*
        |--------------------------------------------------------------------------
        | FILTER STATUS
        |--------------------------------------------------------------------------
        */

        filterStatus.addEventListener(
            'change',
            filterData
        );


        /*
        |--------------------------------------------------------------------------
        | RESET
        |--------------------------------------------------------------------------
        */

        resetButton.addEventListener(
            'click',
            function() {

                searchInput.value = '';

                filterTanggalMulai.value = '';

                filterTanggalSelesai.value = '';

                filterStatus.value = '';


                rows.forEach(function(row) {

                    row.style.display = '';

                });


                const jumlah =
                    rows.length;


                if (jumlahHasil) {

                    jumlahHasil.textContent =
                        jumlah;

                }


                if (jumlahFilter) {

                    jumlahFilter.textContent =
                        jumlah;

                }


                if (emptyFilter) {

                    emptyFilter.classList.add(
                        'd-none'
                    );

                }

            }
        );


        /*
        |--------------------------------------------------------------------------
        | JALANKAN SAAT HALAMAN DIBUKA
        |--------------------------------------------------------------------------
        */

        filterData();

    });
</script>

@endpush