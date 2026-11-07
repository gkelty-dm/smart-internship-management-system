@extends('layouts.skydash-industri')

@section('title', 'Penilaian Siswa')

@section('content')

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
                                class="mdi mdi-clipboard-check-outline text-white"
                                style="font-size:23px;">
                            </i>

                        </div>

                        <div>

                            <h4 class="fw-bold mb-1">
                                Penilaian Siswa
                            </h4>

                            <p class="text-muted small mb-0">
                                Kelola penilaian siswa PKL yang menjadi bimbingan Anda.
                            </p>

                        </div>

                    </div>


                    <span class="badge bg-light text-primary border px-3 py-2">

                        <i class="mdi mdi-account-group-outline me-1"></i>

                        <span id="jumlahHeader">
                            {{ $penempatans->total() }}
                        </span>

                        Siswa

                    </span>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     STATISTIK
========================================================= --}}

<div class="row">

    <div class="col-lg-4 col-md-6 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <p class="text-muted mb-1 small">
                            Total Siswa
                        </p>

                        <h3 class="fw-bold mb-0" id="statTotal">

                            {{ $penempatans->total() }}

                        </h3>

                    </div>


                    <div
                        class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                        style="width:50px;height:50px;">

                        <i
                            class="mdi mdi-account-group text-white"
                            style="font-size:25px;">
                        </i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-lg-4 col-md-6 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <p class="text-muted mb-1 small">
                            Sudah Dinilai
                        </p>

                        <h3 class="fw-bold mb-0" id="statSudah">

                            {{ $penempatans->getCollection()->whereNotNull('penilaianIndustri')->count() }}

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


    <div class="col-lg-4 col-md-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <p class="text-muted mb-1 small">
                            Belum Dinilai
                        </p>

                        <h3 class="fw-bold mb-0" id="statBelum">

                            {{ $penempatans->getCollection()->whereNull('penilaianIndustri')->count() }}

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

</div>


{{-- =========================================================
     DAFTAR SISWA
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">

                    <div>

                        <h5 class="card-title mb-1">
                            Daftar Siswa
                        </h5>

                        <p class="text-muted small mb-0">
                            Pilih siswa untuk melihat atau memberikan penilaian.
                        </p>

                    </div>


                    <span class="text-muted small">

                        <i class="mdi mdi-account-group-outline me-1"></i>

                        <span id="jumlahData">
                            {{ $penempatans->count() }}
                        </span>

                        siswa

                    </span>

                </div>


                {{-- =================================================
                     FILTER
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
                                    id="searchPenilaian"
                                    class="form-control border-start-0"
                                    placeholder="Cari nama siswa / NISN..."
                                    autocomplete="off">

                            </div>

                        </div>


                        {{-- KELAS --}}

                        <div class="col-xl-2 col-lg-2 col-md-6">

                            <select
                                id="filterKelas"
                                class="form-select form-select-sm">

                                <option value="">
                                    Semua Kelas
                                </option>

                                @foreach(
                                $penempatans
                                ->getCollection()
                                ->pluck('siswa.kelas.nama_kelas')
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


                        {{-- PERUSAHAAN --}}

                        <div class="col-xl-2 col-lg-2 col-md-6">

                            <select
                                id="filterPerusahaan"
                                class="form-select form-select-sm">

                                <option value="">
                                    Semua Industri
                                </option>

                                @foreach(
                                $penempatans
                                ->getCollection()
                                ->pluck('perusahaan.nama_perusahaan')
                                ->filter()
                                ->unique()
                                ->sort()
                                as $perusahaan
                                )

                                <option value="{{ strtolower($perusahaan) }}">
                                    {{ $perusahaan }}
                                </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- STATUS --}}

                        <div class="col-xl-2 col-lg-2 col-md-6">

                            <select
                                id="filterStatus"
                                class="form-select form-select-sm">

                                <option value="">
                                    Semua Status
                                </option>

                                <option value="sudah">
                                    Sudah Dinilai
                                </option>

                                <option value="belum">
                                    Belum Dinilai
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

                                    {{ $penempatans->count() }}

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

                @if($penempatans->count())

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
                                    Kelas
                                </th>

                                <th>
                                    Perusahaan
                                </th>

                                <th>
                                    Nilai Akhir
                                </th>

                                <th>
                                    Status
                                </th>

                                <th width="150" class="text-center">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($penempatans as $index => $penempatan)

                            @php

                            $siswa = $penempatan->siswa;

                            $namaSiswa =
                            $siswa &&
                            $siswa->user
                            ? $siswa->user->name
                            : '';

                            $nisnSiswa =
                            $siswa
                            ? $siswa->nisn
                            : '';

                            $kelasSiswa =
                            $siswa &&
                            $siswa->kelas
                            ? $siswa->kelas->nama_kelas
                            : '';

                            $namaPerusahaan =
                            $penempatan->perusahaan
                            ? $penempatan->perusahaan->nama_perusahaan
                            : '';

                            $sudahDinilai =
                            $penempatan->penilaianIndustri
                            ? 'sudah'
                            : 'belum';

                            $nilai =
                            $penempatan->penilaianIndustri
                            ? $penempatan->penilaianIndustri->nilai_akhir
                            : null;

                            @endphp


                            <tr
                                class="data-penilaian"

                                data-nama="{{ strtolower($namaSiswa) }}"

                                data-nisn="{{ strtolower($nisnSiswa) }}"

                                data-kelas="{{ strtolower($kelasSiswa) }}"

                                data-perusahaan="{{ strtolower($namaPerusahaan) }}"

                                data-status="{{ $sudahDinilai }}">


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


                                {{-- KELAS --}}

                                <td>

                                    <span class="text-muted">

                                        {{ $kelasSiswa ?: '-' }}

                                    </span>

                                </td>


                                {{-- PERUSAHAAN --}}

                                <td>

                                    <span class="text-muted">

                                        {{ $namaPerusahaan ?: '-' }}

                                    </span>

                                </td>


                                {{-- NILAI --}}

                                <td>

                                    @if($penempatan->penilaianIndustri)

                                    <strong class="text-primary">

                                        {{ number_format($nilai, 2) }}

                                    </strong>

                                    @else

                                    <span class="text-muted">
                                        -
                                    </span>

                                    @endif

                                </td>


                                {{-- STATUS --}}

                                <td>

                                    @if($penempatan->penilaianIndustri)

                                    @if($nilai >= 90)

                                    <span class="badge bg-success">
                                        Sangat Baik
                                    </span>

                                    @elseif($nilai >= 80)

                                    <span class="badge bg-primary">
                                        Baik
                                    </span>

                                    @elseif($nilai >= 70)

                                    <span class="badge bg-warning text-dark">
                                        Cukup
                                    </span>

                                    @else

                                    <span class="badge bg-danger">
                                        Kurang
                                    </span>

                                    @endif

                                    @else

                                    <span class="badge bg-secondary">
                                        Belum Dinilai
                                    </span>

                                    @endif

                                </td>


                                {{-- AKSI --}}

                                <td>

                                    <div class="d-flex gap-1 justify-content-center">

                                        @if($penempatan->penilaianIndustri)

                                        <a
                                            href="{{ route(
                                                'industri.penilaian.show',
                                                $penempatan->penilaianIndustri->id
                                            ) }}"
                                            class="btn btn-primary btn-sm"
                                            title="Detail">

                                            <i class="mdi mdi-eye-outline"></i>

                                        </a>


                                        <a
                                            href="{{ route(
                                                'industri.penilaian.edit',
                                                $penempatan->penilaianIndustri->id
                                            ) }}"
                                            class="btn btn-warning btn-sm"
                                            title="Edit">

                                            <i class="mdi mdi-pencil-outline"></i>

                                        </a>

                                        @else

                                        <a
                                            href="{{ route(
                                                'industri.penilaian.create',
                                                $penempatan->id
                                            ) }}"
                                            class="btn btn-success btn-sm"
                                            title="Berikan Penilaian">

                                            <i class="mdi mdi-plus me-1"></i>

                                            Nilai

                                        </a>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                {{-- EMPTY FILTER --}}

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


                    <h6 class="fw-semibold mb-2">
                        Data Tidak Ditemukan
                    </h6>


                    <p class="text-muted small mb-0">
                        Tidak ada siswa yang sesuai dengan filter.
                    </p>

                </div>


                {{-- PAGINATION --}}

                @if($penempatans->hasPages())

                <div
                    id="paginationPenilaian"
                    class="d-flex justify-content-between align-items-center flex-wrap mt-4 pt-3 border-top">

                    <small class="text-muted mb-2 mb-md-0">

                        Menampilkan

                        <strong>
                            {{ $penempatans->firstItem() }}
                        </strong>

                        sampai

                        <strong>
                            {{ $penempatans->lastItem() }}
                        </strong>

                        dari

                        <strong>
                            {{ $penempatans->total() }}
                        </strong>

                        siswa

                    </small>


                    <div>

                        {{ $penempatans->onEachSide(1)->links('pagination::bootstrap-5') }}

                    </div>

                </div>

                @endif

                @else

                {{-- EMPTY DATABASE --}}

                <div class="text-center py-5">

                    <div
                        class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                        style="width:80px;height:80px;">

                        <i
                            class="mdi mdi-clipboard-text-outline text-muted"
                            style="font-size:42px;">
                        </i>

                    </div>


                    <h5 class="fw-semibold mt-3 mb-2">
                        Belum Ada Siswa
                    </h5>


                    <p class="text-muted small mb-0">
                        Belum ada siswa PKL yang dibimbing oleh Anda.
                    </p>

                </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection


@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const searchInput =
            document.getElementById('searchPenilaian');

        const filterKelas =
            document.getElementById('filterKelas');

        const filterPerusahaan =
            document.getElementById('filterPerusahaan');

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

        const statTotal =
            document.getElementById('statTotal');

        const statSudah =
            document.getElementById('statSudah');

        const statBelum =
            document.getElementById('statBelum');

        const emptyFilter =
            document.getElementById('emptyFilter');

        const pagination =
            document.getElementById('paginationPenilaian');

        const rows =
            document.querySelectorAll('.data-penilaian');


        if (
            !searchInput ||
            !filterKelas ||
            !filterPerusahaan ||
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

            const perusahaan =
                filterPerusahaan.value
                .toLowerCase();

            const status =
                filterStatus.value
                .toLowerCase();


            let jumlah = 0;

            let jumlahSudah = 0;

            let jumlahBelum = 0;


            rows.forEach(function(row) {

                const nama =
                    row.dataset.nama || '';

                const nisn =
                    row.dataset.nisn || '';

                const rowKelas =
                    row.dataset.kelas || '';

                const rowPerusahaan =
                    row.dataset.perusahaan || '';

                const rowStatus =
                    row.dataset.status || '';


                const cocokSearch =
                    nama.includes(search) ||
                    nisn.includes(search);


                const cocokKelas = !kelas ||
                    rowKelas === kelas;


                const cocokPerusahaan = !perusahaan ||
                    rowPerusahaan === perusahaan;


                const cocokStatus = !status ||
                    rowStatus === status;


                if (
                    cocokSearch &&
                    cocokKelas &&
                    cocokPerusahaan &&
                    cocokStatus
                ) {

                    row.style.display = '';

                    jumlah++;


                    if (rowStatus === 'sudah') {

                        jumlahSudah++;

                    } else {

                        jumlahBelum++;

                    }

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


            if (statTotal) {

                statTotal.textContent =
                    jumlah;

            }


            if (statSudah) {

                statSudah.textContent =
                    jumlahSudah;

            }


            if (statBelum) {

                statBelum.textContent =
                    jumlahBelum;

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
                kelas !== '' ||
                perusahaan !== '' ||
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


        filterKelas.addEventListener(
            'change',
            filterData
        );


        filterPerusahaan.addEventListener(
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

                filterPerusahaan.value = '';

                filterStatus.value = '';


                rows.forEach(function(row) {

                    row.style.display = '';

                });


                const jumlah =
                    rows.length;


                let jumlahSudah = 0;

                let jumlahBelum = 0;


                rows.forEach(function(row) {

                    if (
                        row.dataset.status === 'sudah'
                    ) {

                        jumlahSudah++;

                    } else {

                        jumlahBelum++;

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


                if (statTotal) {

                    statTotal.textContent =
                        jumlah;

                }


                if (statSudah) {

                    statSudah.textContent =
                        jumlahSudah;

                }


                if (statBelum) {

                    statBelum.textContent =
                        jumlahBelum;

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