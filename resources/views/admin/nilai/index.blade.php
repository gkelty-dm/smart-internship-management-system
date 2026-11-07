@extends('layouts.skydash-admin')

@section('title', 'Nilai PKL')

@section('content')

<style>
    .page-card {
        border: 0;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .035);
    }

    .page-header {
        padding: 20px 22px;
    }

    .page-header-icon {
        width: 46px;
        height: 46px;
        border-radius: 8px;
        background: rgba(75, 73, 172, .10);
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .page-header-icon i {
        font-size: 23px;
    }

    .page-title {
        font-size: 18px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 3px;
    }

    .page-subtitle {
        font-size: 11px;
        color: #9a9aa5;
        margin: 0;
    }

    .stat-card {
        border: 0;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .035);
    }

    .stat-card .card-body {
        padding: 18px 20px;
    }

    .stat-label {
        font-size: 10px;
        color: #9a9aa5;
        margin-bottom: 4px;
    }

    .stat-value {
        font-size: 21px;
        font-weight: 600;
        color: #343a40;
        margin: 0;
    }

    .stat-icon {
        width: 43px;
        height: 43px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stat-icon i {
        font-size: 21px;
    }

    .stat-primary {
        background: rgba(75, 73, 172, .10);
        color: #4b49ac;
    }

    .stat-info {
        background: rgba(23, 162, 184, .10);
        color: #138496;
    }

    .stat-success {
        background: rgba(40, 167, 69, .10);
        color: #28a745;
    }

    .stat-warning {
        background: rgba(255, 193, 7, .13);
        color: #b38600;
    }

    .content-card {
        border: 0;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .035);
    }

    .content-card .card-body {
        padding: 22px;
    }

    .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .section-icon {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        background: rgba(75, 73, 172, .10);
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
        flex-shrink: 0;
    }

    .section-icon i {
        font-size: 19px;
    }

    .section-title {
        font-size: 14px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 2px;
    }

    .section-subtitle {
        font-size: 10px;
        color: #9a9aa5;
        margin: 0;
    }

    .filter-label {
        display: block;
        font-size: 10px;
        font-weight: 600;
        color: #555;
        margin-bottom: 6px;
    }

    .filter-control {
        height: 40px;
        border: 1px solid #e2e2e8;
        border-radius: 7px;
        font-size: 10px;
        color: #495057;
        box-shadow: none !important;
    }

    .filter-control:focus {
        border-color: #4b49ac;
    }

    .filter-btn {
        height: 40px;
        border-radius: 7px;
        font-size: 10px;
        padding: 8px 15px;
    }

    .table-wrapper {
        border: 1px solid #eeeeee;
        border-radius: 8px;
        overflow: hidden;
    }

    .nilai-table {
        margin-bottom: 0;
    }

    .nilai-table thead th {
        background: #f8f8fb;
        border-bottom: 1px solid #eeeeee;
        border-top: 0;
        color: #777783;
        font-size: 9px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .2px;
        padding: 12px 10px;
        white-space: nowrap;
    }

    .nilai-table tbody td {
        border-top: 1px solid #f0f0f2;
        color: #555;
        font-size: 10px;
        padding: 12px 10px;
        vertical-align: middle;
    }

    .nilai-table tbody tr:hover {
        background: #fafaff;
    }

    .number-cell {
        color: #999;
        font-size: 9px;
    }

    .student-name {
        font-size: 10px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 2px;
        white-space: nowrap;
    }

    .student-nis {
        font-size: 8px;
        color: #a0a0aa;
    }

    .company-name {
        font-size: 10px;
        font-weight: 600;
        color: #343a40;
    }

    .score-badge {
        min-width: 48px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 9px;
        border-radius: 5px;
        font-size: 9px;
        font-weight: 600;
    }

    .score-guru {
        background: rgba(75, 73, 172, .10);
        color: #4b49ac;
    }

    .score-industri {
        background: rgba(40, 167, 69, .10);
        color: #28a745;
    }

    .score-empty {
        background: #f1f1f4;
        color: #888;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 70px;
        padding: 6px 9px;
        border-radius: 5px;
        font-size: 8px;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-lengkap {
        background: rgba(40, 167, 69, .10);
        color: #28a745;
    }

    .status-sebagian {
        background: rgba(255, 193, 7, .13);
        color: #b38600;
    }

    .status-belum {
        background: #f1f1f4;
        color: #777;
    }

    .action-btn {
        width: 31px;
        height: 31px;
        border-radius: 6px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
    }

    .result-badge {
        background: rgba(75, 73, 172, .10);
        color: #4b49ac;
        border-radius: 5px;
        font-size: 9px;
        font-weight: 600;
        padding: 6px 9px;
    }

    .empty-state {
        padding: 55px 20px !important;
        text-align: center;
    }

    .empty-state i {
        font-size: 46px;
        color: #c8c8d0;
    }

    .empty-state h6 {
        font-size: 12px;
        margin-top: 12px;
        margin-bottom: 5px;
        color: #555;
    }

    .empty-state p {
        font-size: 9px;
        color: #9a9aa5;
        margin: 0;
    }

    .pagination-wrapper {
        margin-top: 20px;
    }

    .pagination-wrapper .pagination {
        margin-bottom: 0;
    }

    .pagination-wrapper .page-link {
        font-size: 9px;
        border-radius: 5px !important;
        margin: 0 2px;
        border-color: #eeeeee;
        color: #666;
    }

    .pagination-wrapper .page-item.active .page-link {
        background-color: #4b49ac;
        border-color: #4b49ac;
    }

    @media (max-width: 767.98px) {

        .page-header {
            padding: 17px;
        }

        .content-card .card-body {
            padding: 17px;
        }

        .stat-card .card-body {
            padding: 15px;
        }

        .filter-btn {
            width: 100%;
        }
    }
</style>


{{-- =========================================================
     HEADER
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card page-card">

            <div class="page-header">

                <div class="d-flex align-items-center">

                    <div class="page-header-icon me-3">

                        <i class="mdi mdi-star-check-outline"></i>

                    </div>

                    <div>

                        <h4 class="page-title">
                            Nilai PKL Siswa
                        </h4>

                        <p class="page-subtitle">
                            Melihat seluruh hasil penilaian siswa dari Guru Pembimbing dan Pembimbing Industri.
                        </p>

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

    <div class="col-md-6 col-lg-3 grid-margin stretch-card">

        <div class="card stat-card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="stat-label">
                            Total Siswa PKL
                        </div>

                        <h3 class="stat-value">
                            {{ $totalSiswa }}
                        </h3>

                    </div>

                    <div class="stat-icon stat-primary">

                        <i class="mdi mdi-account-group-outline"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- DINILAI GURU --}}

    <div class="col-md-6 col-lg-3 grid-margin stretch-card">

        <div class="card stat-card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="stat-label">
                            Dinilai Guru
                        </div>

                        <h3 class="stat-value">
                            {{ $sudahDinilaiGuru }}
                        </h3>

                    </div>

                    <div class="stat-icon stat-info">

                        <i class="mdi mdi-account-tie-outline"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- DINILAI INDUSTRI --}}

    <div class="col-md-6 col-lg-3 grid-margin stretch-card">

        <div class="card stat-card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="stat-label">
                            Dinilai Industri
                        </div>

                        <h3 class="stat-value">
                            {{ $sudahDinilaiIndustri }}
                        </h3>

                    </div>

                    <div class="stat-icon stat-success">

                        <i class="mdi mdi-domain"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- NILAI LENGKAP --}}

    <div class="col-md-6 col-lg-3 grid-margin stretch-card">

        <div class="card stat-card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="stat-label">
                            Nilai Lengkap
                        </div>

                        <h3 class="stat-value">
                            {{ $sudahLengkap }}
                        </h3>

                    </div>

                    <div class="stat-icon stat-warning">

                        <i class="mdi mdi-check-decagram-outline"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     FILTER
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card content-card">

            <div class="card-body">

                <div class="section-header">

                    <div class="section-icon">

                        <i class="mdi mdi-filter-variant"></i>

                    </div>

                    <div>

                        <h5 class="section-title">
                            Filter Nilai
                        </h5>

                        <p class="section-subtitle">
                            Gunakan filter untuk menemukan data penilaian siswa.
                        </p>

                    </div>

                </div>


                <form
                    action="{{ route('admin.nilai.index') }}"
                    method="GET">

                    <div class="row">

                        {{-- SEARCH --}}

                        <div class="col-md-6 col-lg-5">

                            <div class="form-group">

                                <label
                                    for="search"
                                    class="filter-label">

                                    Cari Siswa

                                </label>

                                <input
                                    type="text"
                                    name="search"
                                    id="search"
                                    class="form-control filter-control"
                                    value="{{ request('search') }}"
                                    placeholder="Nama siswa, guru, atau perusahaan">

                            </div>

                        </div>


                        {{-- STATUS --}}

                        <div class="col-md-6 col-lg-3">

                            <div class="form-group">

                                <label
                                    for="status"
                                    class="filter-label">

                                    Status Penilaian

                                </label>

                                <select
                                    name="status"
                                    id="status"
                                    class="form-control filter-control">

                                    <option value="">
                                        Semua Status
                                    </option>

                                    <option
                                        value="lengkap"
                                        {{ request('status') === 'lengkap' ? 'selected' : '' }}>

                                        Nilai Lengkap

                                    </option>

                                    <option
                                        value="sebagian"
                                        {{ request('status') === 'sebagian' ? 'selected' : '' }}>

                                        Sebagian

                                    </option>

                                    <option
                                        value="belum"
                                        {{ request('status') === 'belum' ? 'selected' : '' }}>

                                        Belum Dinilai

                                    </option>

                                </select>

                            </div>

                        </div>


                        {{-- PENILAI --}}

                        <div class="col-md-6 col-lg-2">

                            <div class="form-group">

                                <label
                                    for="penilai"
                                    class="filter-label">

                                    Penilai

                                </label>

                                <select
                                    name="penilai"
                                    id="penilai"
                                    class="form-control filter-control">

                                    <option value="">
                                        Semua
                                    </option>

                                    <option
                                        value="guru"
                                        {{ request('penilai') === 'guru' ? 'selected' : '' }}>

                                        Guru

                                    </option>

                                    <option
                                        value="industri"
                                        {{ request('penilai') === 'industri' ? 'selected' : '' }}>

                                        Industri

                                    </option>

                                </select>

                            </div>

                        </div>


                        {{-- BUTTON --}}

                        <div class="col-md-6 col-lg-2 d-flex align-items-end">

                            <div class="form-group w-100">

                                <button
                                    type="submit"
                                    class="btn btn-primary filter-btn w-100">

                                    <i class="mdi mdi-magnify me-1"></i>

                                    Cari

                                </button>

                            </div>

                        </div>

                    </div>


                    <a
                        href="{{ route('admin.nilai.index') }}"
                        class="btn btn-light filter-btn">

                        <i class="mdi mdi-refresh me-1"></i>

                        Reset

                    </a>

                </form>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     DATA NILAI
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card content-card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div class="section-header mb-0">

                        <div class="section-icon">

                            <i class="mdi mdi-format-list-bulleted"></i>

                        </div>

                        <div>

                            <h5 class="section-title">
                                Rekapitulasi Nilai Siswa
                            </h5>

                            <p class="section-subtitle">
                                Nilai dari Guru Pembimbing dan Pembimbing Industri.
                            </p>

                        </div>

                    </div>


                    <span class="result-badge">

                        {{ $penempatans->total() }} Data

                    </span>

                </div>


                <div class="table-wrapper">

                    <div class="table-responsive">

                        <table class="table nilai-table">

                            <thead>

                                <tr>

                                    <th>
                                        No
                                    </th>

                                    <th>
                                        Siswa
                                    </th>

                                    <th>
                                        Jurusan
                                    </th>

                                    <th>
                                        Kelas
                                    </th>

                                    <th>
                                        Perusahaan
                                    </th>

                                    <th>
                                        Guru Pembimbing
                                    </th>

                                    <th class="text-center">
                                        Nilai Guru
                                    </th>

                                    <th class="text-center">
                                        Nilai Industri
                                    </th>

                                    <th class="text-center">
                                        Status
                                    </th>

                                    <th class="text-center">
                                        Aksi
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @forelse($penempatans as $penempatan)

                                @php

                                $nilaiGuru =
                                $penempatan->penilaianGuru;

                                $nilaiIndustri =
                                $penempatan->penilaianIndustri;

                                @endphp


                                <tr>

                                    {{-- NO --}}

                                    <td>

                                        <span class="number-cell">

                                            {{
                                                $loop->iteration
                                                + ($penempatans->firstItem() - 1)
                                            }}

                                        </span>

                                    </td>


                                    {{-- SISWA --}}

                                    <td>

                                        <div class="student-name">

                                            {{
                                                $penempatan->siswa->user->name
                                                ?? '-'
                                            }}

                                        </div>

                                        <div class="student-nis">

                                            NIS:
                                            {{
                                                $penempatan->siswa->nis
                                                ?? '-'
                                            }}

                                        </div>

                                    </td>


                                    {{-- JURUSAN --}}

                                    <td>

                                        {{
                                            $penempatan->siswa->jurusan->nama_jurusan
                                            ?? '-'
                                        }}

                                    </td>


                                    {{-- KELAS --}}

                                    <td>

                                        {{
                                            $penempatan->siswa->kelas->nama_kelas
                                            ?? '-'
                                        }}

                                    </td>


                                    {{-- PERUSAHAAN --}}

                                    <td>

                                        <div class="company-name">

                                            {{
                                                $penempatan->perusahaan->nama_perusahaan
                                                ?? '-'
                                            }}

                                        </div>

                                    </td>


                                    {{-- GURU --}}

                                    <td>

                                        {{
                                            $penempatan->guru->user->name
                                            ?? '-'
                                        }}

                                    </td>


                                    {{-- NILAI GURU --}}

                                    <td class="text-center">

                                        @if($nilaiGuru)

                                        <span class="score-badge score-guru">

                                            {{
                                                    number_format(
                                                        $nilaiGuru->nilai_akhir,
                                                        2
                                                    )
                                                }}

                                        </span>

                                        @else

                                        <span class="score-badge score-empty">

                                            Belum

                                        </span>

                                        @endif

                                    </td>


                                    {{-- NILAI INDUSTRI --}}

                                    <td class="text-center">

                                        @if($nilaiIndustri)

                                        <span class="score-badge score-industri">

                                            {{
                                                    number_format(
                                                        $nilaiIndustri->nilai_akhir,
                                                        2
                                                    )
                                                }}

                                        </span>

                                        @else

                                        <span class="score-badge score-empty">

                                            Belum

                                        </span>

                                        @endif

                                    </td>


                                    {{-- STATUS --}}

                                    <td class="text-center">

                                        @if(
                                        $nilaiGuru &&
                                        $nilaiIndustri
                                        )

                                        <span class="status-badge status-lengkap">

                                            <i class="mdi mdi-check-circle-outline me-1"></i>

                                            Lengkap

                                        </span>

                                        @elseif(
                                        $nilaiGuru ||
                                        $nilaiIndustri
                                        )

                                        <span class="status-badge status-sebagian">

                                            <i class="mdi mdi-progress-clock me-1"></i>

                                            Sebagian

                                        </span>

                                        @else

                                        <span class="status-badge status-belum">

                                            Belum Dinilai

                                        </span>

                                        @endif

                                    </td>


                                    {{-- AKSI --}}

                                    <td class="text-center">

                                        <a
                                            href="{{ route(
                                                'admin.nilai.show',
                                                $penempatan->id
                                            ) }}"
                                            class="btn btn-outline-primary action-btn"
                                            title="Lihat Detail">

                                            <i class="mdi mdi-eye-outline"></i>

                                        </a>

                                    </td>

                                </tr>


                                @empty

                                <tr>

                                    <td
                                        colspan="10"
                                        class="empty-state">

                                        <i class="mdi mdi-star-off-outline"></i>

                                        <h6>
                                            Belum ada data nilai
                                        </h6>

                                        <p>
                                            Nilai siswa akan tampil setelah Guru Pembimbing
                                            atau Pembimbing Industri memberikan penilaian.
                                        </p>

                                    </td>

                                </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>


                {{-- PAGINATION --}}

                @if($penempatans->hasPages())

                <div class="pagination-wrapper">

                    {{ $penempatans
                            ->withQueryString()
                            ->links('pagination::bootstrap-5')
                        }}

                </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection