@extends('layouts.skydash-admin')

@section('title', 'Riwayat Logbook')

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

    .stat-warning {
        background: rgba(255, 193, 7, .12);
        color: #c28c00;
    }

    .stat-success {
        background: rgba(40, 167, 69, .10);
        color: #28a745;
    }

    .stat-danger {
        background: rgba(220, 53, 69, .10);
        color: #dc3545;
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

    .filter-actions {
        margin-top: 19px;
    }

    .filter-actions .btn {
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

    .logbook-table {
        margin-bottom: 0;
    }

    .logbook-table thead th {
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

    .logbook-table tbody td {
        border-top: 1px solid #f0f0f2;
        color: #555;
        font-size: 10px;
        padding: 12px 10px;
        vertical-align: middle;
    }

    .logbook-table tbody tr:hover {
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
    }

    .student-email {
        font-size: 8px;
        color: #a0a0aa;
    }

    .date-cell {
        font-weight: 600;
        color: #555;
        white-space: nowrap;
    }

    .activity-cell {
        max-width: 320px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: #555;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 65px;
        padding: 5px 9px;
        border-radius: 5px;
        font-size: 8px;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-pending {
        background: rgba(255, 193, 7, .13);
        color: #b38600;
    }

    .status-disetujui {
        background: rgba(40, 167, 69, .10);
        color: #28a745;
    }

    .status-ditolak {
        background: rgba(220, 53, 69, .10);
        color: #dc3545;
    }

    .status-default {
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

    .table-footer {
        margin-top: 20px;
    }

    .table-footer .pagination {
        margin-bottom: 0;
    }

    .table-footer .page-link {
        font-size: 9px;
        border-radius: 5px !important;
        margin: 0 2px;
        border-color: #eeeeee;
        color: #666;
    }

    .table-footer .page-item.active .page-link {
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

        .filter-actions {
            margin-top: 0;
        }

        .filter-actions .btn {
            width: 100%;
            margin-bottom: 8px;
        }

        .table-wrapper {
            border-radius: 6px;
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

                        <i class="mdi mdi-notebook-outline"></i>

                    </div>

                    <div>

                        <h4 class="page-title">
                            Riwayat Logbook Siswa
                        </h4>

                        <p class="page-subtitle">
                            Melihat seluruh aktivitas logbook siswa.
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

    {{-- TOTAL --}}

    <div class="col-md-6 col-lg-3 grid-margin stretch-card">

        <div class="card stat-card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="stat-label">
                            Total Logbook
                        </div>

                        <h3 class="stat-value">
                            {{ $totalLogbook }}
                        </h3>

                    </div>

                    <div class="stat-icon stat-primary">

                        <i class="mdi mdi-notebook-check-outline"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- PENDING --}}

    <div class="col-md-6 col-lg-3 grid-margin stretch-card">

        <div class="card stat-card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="stat-label">
                            Menunggu Validasi
                        </div>

                        <h3 class="stat-value">
                            {{ $pending }}
                        </h3>

                    </div>

                    <div class="stat-icon stat-warning">

                        <i class="mdi mdi-clock-alert-outline"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- DISETUJUI --}}

    <div class="col-md-6 col-lg-3 grid-margin stretch-card">

        <div class="card stat-card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="stat-label">
                            Disetujui
                        </div>

                        <h3 class="stat-value">
                            {{ $disetujui }}
                        </h3>

                    </div>

                    <div class="stat-icon stat-success">

                        <i class="mdi mdi-check-circle-outline"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- DITOLAK --}}

    <div class="col-md-6 col-lg-3 grid-margin stretch-card">

        <div class="card stat-card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="stat-label">
                            Ditolak
                        </div>

                        <h3 class="stat-value">
                            {{ $ditolak }}
                        </h3>

                    </div>

                    <div class="stat-icon stat-danger">

                        <i class="mdi mdi-close-circle-outline"></i>

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
                            Filter Logbook
                        </h5>

                        <p class="section-subtitle">
                            Gunakan filter untuk menemukan data logbook tertentu.
                        </p>

                    </div>

                </div>


                <form
                    action="{{ route('admin.logbook') }}"
                    method="GET">

                    <div class="row">

                        {{-- SEARCH --}}

                        <div class="col-md-6 col-lg-3">

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
                                    placeholder="Nama atau email siswa">

                            </div>

                        </div>


                        {{-- JURUSAN --}}

                        <div class="col-md-6 col-lg-2">

                            <div class="form-group">

                                <label
                                    for="jurusan"
                                    class="filter-label">

                                    Jurusan

                                </label>

                                <select
                                    name="jurusan"
                                    id="jurusan"
                                    class="form-control filter-control">

                                    <option value="">
                                        Semua Jurusan
                                    </option>

                                    @foreach($jurusans as $jurusan)

                                    <option
                                        value="{{ $jurusan->id }}"
                                        {{ request('jurusan') == $jurusan->id ? 'selected' : '' }}>

                                        {{ $jurusan->nama_jurusan }}

                                    </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>


                        {{-- KELAS --}}

                        <div class="col-md-6 col-lg-2">

                            <div class="form-group">

                                <label
                                    for="kelas"
                                    class="filter-label">

                                    Kelas

                                </label>

                                <select
                                    name="kelas"
                                    id="kelas"
                                    class="form-control filter-control">

                                    <option value="">
                                        Semua Kelas
                                    </option>

                                    @foreach($kelas as $item)

                                    <option
                                        value="{{ $item->id }}"
                                        {{ request('kelas') == $item->id ? 'selected' : '' }}>

                                        {{ $item->nama_kelas }}

                                    </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>


                        {{-- STATUS --}}

                        <div class="col-md-6 col-lg-2">

                            <div class="form-group">

                                <label
                                    for="status"
                                    class="filter-label">

                                    Status

                                </label>

                                <select
                                    name="status"
                                    id="status"
                                    class="form-control filter-control">

                                    <option value="">
                                        Semua Status
                                    </option>

                                    <option
                                        value="pending"
                                        {{ request('status') === 'pending' ? 'selected' : '' }}>

                                        Pending

                                    </option>

                                    <option
                                        value="disetujui"
                                        {{ request('status') === 'disetujui' ? 'selected' : '' }}>

                                        Disetujui

                                    </option>

                                    <option
                                        value="ditolak"
                                        {{ request('status') === 'ditolak' ? 'selected' : '' }}>

                                        Ditolak

                                    </option>

                                </select>

                            </div>

                        </div>


                        {{-- TANGGAL --}}

                        <div class="col-md-6 col-lg-3">

                            <div class="form-group">

                                <label
                                    for="tanggal"
                                    class="filter-label">

                                    Tanggal

                                </label>

                                <input
                                    type="date"
                                    name="tanggal"
                                    id="tanggal"
                                    class="form-control filter-control"
                                    value="{{ request('tanggal') }}">

                            </div>

                        </div>

                    </div>


                    {{-- ACTION --}}

                    <div class="filter-actions d-flex gap-2">

                        <button
                            type="submit"
                            class="btn btn-primary">

                            <i class="mdi mdi-magnify me-1"></i>

                            Terapkan Filter

                        </button>

                        <a
                            href="{{ route('admin.logbook') }}"
                            class="btn btn-light">

                            <i class="mdi mdi-refresh me-1"></i>

                            Reset

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     DATA LOGBOOK
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
                                Data Logbook
                            </h5>

                            <p class="section-subtitle">
                                Seluruh laporan kegiatan siswa.
                            </p>

                        </div>

                    </div>

                    <span class="result-badge">

                        {{ $logbooks->total() }} Data

                    </span>

                </div>


                <div class="table-wrapper">

                    <div class="table-responsive">

                        <table class="table logbook-table">

                            <thead>

                                <tr>

                                    <th>
                                        No
                                    </th>

                                    <th>
                                        Tanggal
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
                                        Kegiatan
                                    </th>

                                    <th>
                                        Status
                                    </th>

                                    <th class="text-center">
                                        Aksi
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($logbooks as $logbook)

                                <tr>

                                    {{-- NO --}}

                                    <td>

                                        <span class="number-cell">

                                            {{ $loop->iteration + ($logbooks->firstItem() - 1) }}

                                        </span>

                                    </td>


                                    {{-- TANGGAL --}}

                                    <td>

                                        <span class="date-cell">

                                            {{
                                                \Carbon\Carbon::parse(
                                                    $logbook->tanggal
                                                )->format('d-m-Y')
                                            }}

                                        </span>

                                    </td>


                                    {{-- SISWA --}}

                                    <td>

                                        <div class="student-name">

                                            {{
                                                $logbook->siswa->user->name
                                                ?? '-'
                                            }}

                                        </div>

                                        <div class="student-email">

                                            {{
                                                $logbook->siswa->user->email
                                                ?? '-'
                                            }}

                                        </div>

                                    </td>


                                    {{-- JURUSAN --}}

                                    <td>

                                        {{
                                            $logbook->siswa->jurusan->nama_jurusan
                                            ?? '-'
                                        }}

                                    </td>


                                    {{-- KELAS --}}

                                    <td>

                                        {{
                                            $logbook->siswa->kelas->nama_kelas
                                            ?? '-'
                                        }}

                                    </td>


                                    {{-- KEGIATAN --}}

                                    <td>

                                        <div
                                            class="activity-cell"
                                            title="{{ $logbook->kegiatan }}">

                                            {{ $logbook->kegiatan }}

                                        </div>

                                    </td>


                                    {{-- STATUS --}}

                                    <td>

                                        @if(
                                        $logbook->status_validasi === 'pending'
                                        )

                                        <span class="status-badge status-pending">

                                            <i class="mdi mdi-clock-outline me-1"></i>

                                            Pending

                                        </span>

                                        @elseif(
                                        $logbook->status_validasi === 'disetujui'
                                        )

                                        <span class="status-badge status-disetujui">

                                            <i class="mdi mdi-check-circle-outline me-1"></i>

                                            Disetujui

                                        </span>

                                        @elseif(
                                        $logbook->status_validasi === 'ditolak'
                                        )

                                        <span class="status-badge status-ditolak">

                                            <i class="mdi mdi-close-circle-outline me-1"></i>

                                            Ditolak

                                        </span>

                                        @else

                                        <span class="status-badge status-default">

                                            -

                                        </span>

                                        @endif

                                    </td>


                                    {{-- AKSI --}}

                                    <td class="text-center">

                                        <a
                                            href="{{ route(
                                                'admin.logbook.show',
                                                $logbook->id
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
                                        colspan="8"
                                        class="empty-state">

                                        <i class="mdi mdi-notebook-remove-outline"></i>

                                        <h6>
                                            Belum ada logbook
                                        </h6>

                                        <p>
                                            Data logbook siswa akan tampil di sini.
                                        </p>

                                    </td>

                                </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>


                {{-- PAGINATION --}}

                @if($logbooks->hasPages())

                <div class="table-footer">

                    {{ $logbooks->withQueryString()->links('pagination::bootstrap-5') }}

                </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection