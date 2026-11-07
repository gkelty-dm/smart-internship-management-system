@extends('layouts.skydash-industri')

@section('title', 'Logbook Siswa')

@section('content')

{{-- =========================================================
     HEADER
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body py-3">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                    <div class="d-flex align-items-center">

                        <div
                            class="bg-primary rounded-3 d-flex align-items-center justify-content-center me-3"
                            style="width:46px;height:46px;">

                            <i
                                class="mdi mdi-book-open-page-variant text-white"
                                style="font-size:23px;">
                            </i>

                        </div>

                        <div>

                            <h4 class="fw-bold mb-1">
                                Logbook Siswa
                            </h4>

                            <p class="text-muted small mb-0">
                                Seluruh logbook siswa PKL Anda.
                            </p>

                        </div>

                    </div>


                    <div>

                        <span class="badge bg-light text-primary border px-3 py-2">

                            <i class="mdi mdi-book-open-page-variant me-1"></i>

                            <span id="jumlahHeader">
                                {{ $logbooks->total() }}
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

    {{-- TOTAL LOGBOOK --}}

    <div class="col-lg-4 col-md-6 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <p class="text-muted mb-1 small">
                            Total Logbook
                        </p>

                        <h3 class="fw-bold mb-0">
                            {{ $totalLogbook }}
                        </h3>

                    </div>

                    <div
                        class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                        style="width:50px;height:50px;">

                        <i
                            class="mdi mdi-book-open-page-variant text-white"
                            style="font-size:25px;">
                        </i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- MENUNGGU VALIDASI --}}

    <div class="col-lg-4 col-md-6 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <p class="text-muted mb-1 small">
                            Menunggu Validasi
                        </p>

                        <h3 class="fw-bold mb-0">
                            {{ $totalPending }}
                        </h3>

                    </div>

                    <div
                        class="bg-warning rounded-circle d-flex align-items-center justify-content-center"
                        style="width:50px;height:50px;">

                        <i
                            class="mdi mdi-clock-outline text-white"
                            style="font-size:25px;">
                        </i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- DISETUJUI --}}

    <div class="col-lg-4 col-md-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <p class="text-muted mb-1 small">
                            Sudah Disetujui
                        </p>

                        <h3 class="fw-bold mb-0">
                            {{ $totalDisetujui }}
                        </h3>

                    </div>

                    <div
                        class="bg-success rounded-circle d-flex align-items-center justify-content-center"
                        style="width:50px;height:50px;">

                        <i
                            class="mdi mdi-check-circle text-white"
                            style="font-size:25px;">
                        </i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     DATA LOGBOOK
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">


                {{-- =================================================
                     HEADER TABLE
                ================================================== --}}

                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">

                    <div>

                        <h5 class="card-title mb-1">
                            Riwayat Logbook
                        </h5>

                        <p class="card-description mb-0">
                            Logbook dari seluruh siswa PKL Anda.
                        </p>

                    </div>


                    <span class="text-muted small">

                        <i class="mdi mdi-book-open-page-variant me-1"></i>

                        <span id="jumlahData">
                            {{ $logbooks->count() }}
                        </span>

                        data

                    </span>

                </div>


                {{-- =================================================
                     FILTER COMPACT
                ================================================== --}}

                <div class="border rounded p-2 mb-4">

                    <div class="row align-items-center g-2">


                        {{-- SEARCH --}}

                        <div class="col-xl-4 col-lg-4 col-md-6">

                            <div class="input-group input-group-sm">

                                <span class="input-group-text bg-white border-end-0">

                                    <i class="mdi mdi-magnify text-primary"></i>

                                </span>

                                <input
                                    type="text"
                                    id="searchLogbook"
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

                                <option value="pending">
                                    Pending
                                </option>

                                <option value="disetujui">
                                    Disetujui
                                </option>

                                <option value="ditolak">
                                    Ditolak
                                </option>

                            </select>

                        </div>


                        {{-- JUMLAH --}}

                        <div class="col-xl-1 col-lg-1 col-md-6">

                            <div class="text-muted small text-center">

                                <i class="mdi mdi-format-list-numbered me-1"></i>

                                <strong
                                    id="jumlahFilter"
                                    class="text-dark">

                                    {{ $logbooks->count() }}

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

                @if($logbooks->count())

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead>

                            <tr>

                                <th width="5%">
                                    #
                                </th>

                                <th>
                                    Siswa
                                </th>

                                <th>
                                    Tanggal
                                </th>

                                <th>
                                    Kegiatan
                                </th>

                                <th>
                                    Status
                                </th>

                                <th width="90">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($logbooks as $index => $logbook)

                            @php

                            $siswa = $logbook->siswa;

                            $namaSiswa =
                            $siswa &&
                            $siswa->user
                            ? $siswa->user->name
                            : '';

                            $nisnSiswa =
                            $siswa
                            ? $siswa->nisn
                            : '';

                            $tanggalLogbook =
                            $logbook->tanggal
                            ? \Carbon\Carbon::parse(
                            $logbook->tanggal
                            )->format('Y-m-d')
                            : '';

                            $tanggalTampilan =
                            $logbook->tanggal
                            ? \Carbon\Carbon::parse(
                            $logbook->tanggal
                            )->translatedFormat('d M Y')
                            : '-';

                            $statusLogbook =
                            strtolower(
                            $logbook->status_validasi ?? 'pending'
                            );

                            @endphp


                            <tr
                                class="data-logbook"

                                data-nama="{{ strtolower($namaSiswa) }}"

                                data-nisn="{{ strtolower($nisnSiswa) }}"

                                data-tanggal="{{ $tanggalLogbook }}"

                                data-status="{{ $statusLogbook }}">


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
                                            alt="Foto Siswa">

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

                                            <h6 class="mb-1 fw-semibold">

                                                {{ $namaSiswa ?: '-' }}

                                            </h6>

                                            <small class="text-muted">

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


                                {{-- KEGIATAN --}}

                                <td>

                                    <span
                                        title="{{ $logbook->kegiatan ?? '-' }}">

                                        {{ \Illuminate\Support\Str::limit(
                                            $logbook->kegiatan ?? '-',
                                            70
                                        ) }}

                                    </span>

                                </td>


                                {{-- STATUS --}}

                                <td>

                                    @if($statusLogbook === 'disetujui')

                                    <span class="badge bg-success">

                                        <i class="mdi mdi-check-circle-outline me-1"></i>

                                        Disetujui

                                    </span>

                                    @elseif($statusLogbook === 'ditolak')

                                    <span class="badge bg-danger">

                                        <i class="mdi mdi-close-circle-outline me-1"></i>

                                        Ditolak

                                    </span>

                                    @else

                                    <span class="badge bg-warning text-dark">

                                        <i class="mdi mdi-clock-outline me-1"></i>

                                        Pending

                                    </span>

                                    @endif

                                </td>


                                {{-- AKSI --}}

                                <td>

                                    <a
                                        href="{{ route(
                                            'industri.logbook.show',
                                            $logbook->id
                                        ) }}"
                                        class="btn btn-outline-primary btn-sm"
                                        title="Detail dan Update Validasi">

                                        <i class="mdi mdi-eye-outline"></i>

                                    </a>

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                {{-- =================================================
                     EMPTY FILTER
                ================================================== --}}

                <div
                    id="emptyFilter"
                    class="text-center py-5 d-none">

                    <div
                        class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                        style="width:75px;height:75px;">

                        <i
                            class="mdi mdi-book-search-outline text-muted"
                            style="font-size:35px;">
                        </i>

                    </div>


                    <h6 class="fw-semibold mb-2">

                        Data Tidak Ditemukan

                    </h6>


                    <p class="text-muted small mb-0">

                        Tidak ada logbook yang sesuai dengan pencarian atau filter.

                    </p>

                </div>


                {{-- =================================================
                     PAGINATION
                ================================================== --}}

                @if($logbooks->hasPages())

                <div
                    id="paginationLogbook"
                    class="d-flex justify-content-between align-items-center flex-wrap mt-4 pt-3 border-top">

                    <small class="text-muted mb-2 mb-md-0">

                        Menampilkan

                        <strong>
                            {{ $logbooks->firstItem() }}
                        </strong>

                        sampai

                        <strong>
                            {{ $logbooks->lastItem() }}
                        </strong>

                        dari

                        <strong>
                            {{ $logbooks->total() }}
                        </strong>

                        data

                    </small>


                    <div>

                        {{ $logbooks->onEachSide(1)->links('pagination::bootstrap-5') }}

                    </div>

                </div>

                @endif

                @else

                {{-- =================================================
                     EMPTY DATABASE
                ================================================== --}}

                <div class="text-center py-5">

                    <div
                        class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                        style="width:80px;height:80px;">

                        <i
                            class="mdi mdi-book-open-remove-outline text-muted"
                            style="font-size:42px;">
                        </i>

                    </div>


                    <h5 class="fw-semibold mt-3 mb-2">

                        Belum Ada Logbook

                    </h5>


                    <p class="text-muted small mb-0">

                        Belum terdapat logbook dari siswa PKL Anda.

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
            document.getElementById('searchLogbook');

        const filterTanggalMulai =
            document.getElementById('filterTanggalMulai');

        const filterTanggalSelesai =
            document.getElementById('filterTanggalSelesai');

        const filterStatus =
            document.getElementById('filterStatus');

        const resetButton =
            document.getElementById('resetFilter');

        const jumlahHeader =
            document.getElementById('jumlahHeader');

        const jumlahData =
            document.getElementById('jumlahData');

        const jumlahFilter =
            document.getElementById('jumlahFilter');

        const emptyFilter =
            document.getElementById('emptyFilter');

        const pagination =
            document.getElementById('paginationLogbook');

        const rows =
            document.querySelectorAll('.data-logbook');


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


                const cocokSearch =
                    nama.includes(search) ||
                    nisn.includes(search);


                const cocokTanggalMulai = !tanggalMulai ||
                    tanggal >= tanggalMulai;


                const cocokTanggalSelesai = !tanggalSelesai ||
                    tanggal <= tanggalSelesai;


                const cocokStatus = !status ||
                    rowStatus === status;


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


            if (jumlahHeader) {

                jumlahHeader.textContent =
                    jumlah;

            }


            if (jumlahData) {

                jumlahData.textContent =
                    jumlah;

            }


            if (jumlahFilter) {

                jumlahFilter.textContent =
                    jumlah;

            }


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


            const adaFilter =
                search !== '' ||
                tanggalMulai !== '' ||
                tanggalSelesai !== '' ||
                status !== '';


            if (pagination) {

                if (adaFilter) {

                    pagination.classList.add(
                        'd-none'
                    );

                } else {

                    pagination.classList.remove(
                        'd-none'
                    );

                }

            }

        }


        searchInput.addEventListener(
            'input',
            filterData
        );


        filterTanggalMulai.addEventListener(
            'change',
            filterData
        );


        filterTanggalSelesai.addEventListener(
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

                filterTanggalMulai.value = '';

                filterTanggalSelesai.value = '';

                filterStatus.value = '';


                rows.forEach(function(row) {

                    row.style.display = '';

                });


                const jumlah =
                    rows.length;


                if (jumlahHeader) {

                    jumlahHeader.textContent =
                        jumlah;

                }


                if (jumlahData) {

                    jumlahData.textContent =
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


                if (pagination) {

                    pagination.classList.remove(
                        'd-none'
                    );

                }

            }
        );


        filterData();

    });
</script>

@endpush