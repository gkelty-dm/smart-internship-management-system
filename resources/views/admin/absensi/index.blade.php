@extends('layouts.skydash-admin')

@section('title', 'Riwayat Absensi')

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

    .stat-success {
        background: rgba(40, 167, 69, .10);
        color: #28a745;
    }

    .stat-warning {
        background: rgba(255, 193, 7, .12);
        color: #d39e00;
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

    .attendance-table {
        margin-bottom: 0;
    }

    .attendance-table thead th {
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

    .attendance-table tbody td {
        border-top: 1px solid #f0f0f2;
        color: #555;
        font-size: 10px;
        padding: 12px 10px;
        vertical-align: middle;
    }

    .attendance-table tbody tr:hover {
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

    .time-badge,
    .status-badge,
    .method-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 52px;
        padding: 5px 8px;
        border-radius: 5px;
        font-size: 8px;
        font-weight: 600;
        white-space: nowrap;
    }

    .time-masuk {
        background: rgba(40, 167, 69, .10);
        color: #28a745;
    }

    .time-pulang {
        background: rgba(23, 162, 184, .10);
        color: #138496;
    }

    .status-hadir {
        background: rgba(40, 167, 69, .10);
        color: #28a745;
    }

    .status-izin {
        background: rgba(255, 193, 7, .13);
        color: #b38600;
    }

    .status-sakit {
        background: rgba(220, 53, 69, .10);
        color: #dc3545;
    }

    .status-alpha {
        background: rgba(108, 117, 125, .10);
        color: #6c757d;
    }

    .status-default {
        background: #f1f1f4;
        color: #777;
    }

    .method-primary {
        background: rgba(75, 73, 172, .10);
        color: #4b49ac;
    }

    .method-light {
        background: #f4f4f7;
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

    .result-badge {
        background: rgba(75, 73, 172, .10);
        color: #4b49ac;
        border-radius: 5px;
        font-size: 9px;
        font-weight: 600;
        padding: 6px 9px;
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

                        <i class="mdi mdi-calendar-check-outline"></i>

                    </div>

                    <div>

                        <h4 class="page-title">
                            Riwayat Absensi Siswa
                        </h4>

                        <p class="page-subtitle">
                            Melihat seluruh riwayat absensi siswa secara keseluruhan.
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
                            Total Absensi
                        </div>

                        <h3 class="stat-value">
                            {{ $totalAbsensi }}
                        </h3>

                    </div>

                    <div class="stat-icon stat-primary">

                        <i class="mdi mdi-calendar-check-outline"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- HADIR --}}

    <div class="col-md-6 col-lg-3 grid-margin stretch-card">

        <div class="card stat-card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="stat-label">
                            Hadir
                        </div>

                        <h3 class="stat-value">
                            {{ $hadir }}
                        </h3>

                    </div>

                    <div class="stat-icon stat-success">

                        <i class="mdi mdi-account-check-outline"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- IZIN --}}

    <div class="col-md-6 col-lg-3 grid-margin stretch-card">

        <div class="card stat-card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="stat-label">
                            Izin
                        </div>

                        <h3 class="stat-value">
                            {{ $izin }}
                        </h3>

                    </div>

                    <div class="stat-icon stat-warning">

                        <i class="mdi mdi-account-alert-outline"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- SAKIT --}}

    <div class="col-md-6 col-lg-3 grid-margin stretch-card">

        <div class="card stat-card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="stat-label">
                            Sakit
                        </div>

                        <h3 class="stat-value">
                            {{ $sakit }}
                        </h3>

                    </div>

                    <div class="stat-icon stat-danger">

                        <i class="mdi mdi-hospital-box-outline"></i>

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
                            Filter Riwayat Absensi
                        </h5>

                        <p class="section-subtitle">
                            Gunakan filter untuk menemukan data absensi tertentu.
                        </p>

                    </div>

                </div>


                <form
                    action="{{ route('admin.absensi') }}"
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
                                        value="hadir"
                                        {{ request('status') === 'hadir' ? 'selected' : '' }}>

                                        Hadir

                                    </option>

                                    <option
                                        value="izin"
                                        {{ request('status') === 'izin' ? 'selected' : '' }}>

                                        Izin

                                    </option>

                                    <option
                                        value="sakit"
                                        {{ request('status') === 'sakit' ? 'selected' : '' }}>

                                        Sakit

                                    </option>

                                    <option
                                        value="alpha"
                                        {{ request('status') === 'alpha' ? 'selected' : '' }}>

                                        Alpha

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
                            href="{{ route('admin.absensi') }}"
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
     DATA ABSENSI
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
                                Data Riwayat Absensi
                            </h5>

                            <p class="section-subtitle">
                                Seluruh aktivitas absensi siswa.
                            </p>

                        </div>

                    </div>

                    <span class="result-badge">

                        {{ $absensis->total() }} Data

                    </span>

                </div>


                <div class="table-wrapper">

                    <div class="table-responsive">

                        <table class="table attendance-table">

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
                                        Masuk
                                    </th>

                                    <th>
                                        Pulang
                                    </th>

                                    <th>
                                        Status
                                    </th>

                                    <th>
                                        Metode
                                    </th>

                                    <th class="text-center">
                                        Aksi
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($absensis as $absensi)

                                <tr>

                                    {{-- NO --}}

                                    <td>

                                        <span class="number-cell">

                                            {{ $loop->iteration + ($absensis->firstItem() - 1) }}

                                        </span>

                                    </td>


                                    {{-- TANGGAL --}}

                                    <td>

                                        <span class="date-cell">

                                            {{
                                                \Carbon\Carbon::parse(
                                                    $absensi->tanggal
                                                )->format('d-m-Y')
                                            }}

                                        </span>

                                    </td>


                                    {{-- SISWA --}}

                                    <td>

                                        <div class="student-name">

                                            {{ $absensi->siswa->user->name ?? '-' }}

                                        </div>

                                        <div class="student-email">

                                            {{ $absensi->siswa->user->email ?? '-' }}

                                        </div>

                                    </td>


                                    {{-- JURUSAN --}}

                                    <td>

                                        {{
                                            $absensi->siswa->jurusan->nama_jurusan
                                            ?? '-'
                                        }}

                                    </td>


                                    {{-- KELAS --}}

                                    <td>

                                        {{
                                            $absensi->siswa->kelas->nama_kelas
                                            ?? '-'
                                        }}

                                    </td>


                                    {{-- MASUK --}}

                                    <td>

                                        @if($absensi->jam_masuk)

                                        <span class="time-badge time-masuk">

                                            <i class="mdi mdi-login-variant me-1"></i>

                                            {{ $absensi->jam_masuk }}

                                        </span>

                                        @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                        @endif

                                    </td>


                                    {{-- PULANG --}}

                                    <td>

                                        @if($absensi->jam_pulang)

                                        <span class="time-badge time-pulang">

                                            <i class="mdi mdi-logout-variant me-1"></i>

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

                                        @switch($absensi->status)

                                        @case('hadir')

                                        <span class="status-badge status-hadir">

                                            <i class="mdi mdi-check-circle-outline me-1"></i>

                                            Hadir

                                        </span>

                                        @break

                                        @case('izin')

                                        <span class="status-badge status-izin">

                                            <i class="mdi mdi-alert-circle-outline me-1"></i>

                                            Izin

                                        </span>

                                        @break

                                        @case('sakit')

                                        <span class="status-badge status-sakit">

                                            <i class="mdi mdi-hospital-box-outline me-1"></i>

                                            Sakit

                                        </span>

                                        @break

                                        @case('alpha')

                                        <span class="status-badge status-alpha">

                                            <i class="mdi mdi-close-circle-outline me-1"></i>

                                            Alpha

                                        </span>

                                        @break

                                        @default

                                        <span class="status-badge status-default">

                                            {{ ucfirst($absensi->status ?? '-') }}

                                        </span>

                                        @endswitch

                                    </td>


                                    {{-- METODE --}}

                                    <td>

                                        @if($absensi->metode_verifikasi === 'gps_face')

                                        <span class="method-badge method-primary">

                                            <i class="mdi mdi-map-marker-radius-outline me-1"></i>

                                            GPS + Face

                                        </span>

                                        @elseif($absensi->metode_verifikasi)

                                        <span class="method-badge method-light">

                                            {{ $absensi->metode_verifikasi }}

                                        </span>

                                        @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                        @endif

                                    </td>


                                    {{-- AKSI --}}

                                    <td class="text-center">

                                        <a
                                            href="{{ route(
                                                'admin.absensi.show',
                                                $absensi->id
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

                                        <i class="mdi mdi-calendar-remove-outline"></i>

                                        <h6>
                                            Belum ada data absensi
                                        </h6>

                                        <p>
                                            Data absensi siswa akan tampil di sini.
                                        </p>

                                    </td>

                                </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>


                {{-- PAGINATION --}}

                @if($absensis->hasPages())

                <div class="table-footer">

                    {{ $absensis->withQueryString()->links('pagination::bootstrap-5') }}

                </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection