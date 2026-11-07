@extends('layouts.skydash-admin')

@section('title', 'Detail Industri')

@section('content')

<style>
    /* =========================================================
       DETAIL INDUSTRI
    ========================================================= */

    .detail-card {
        border: 0;
        border-radius: 14px;
        overflow: hidden;
    }

    .detail-header {
        padding: 24px;
        background: #ffffff;
        border-bottom: 1px solid #eeeeee;
    }

    .detail-header-icon {
        width: 54px;
        height: 54px;
        border-radius: 13px;
        background: rgba(75, 73, 172, .10);
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .detail-header-icon i {
        font-size: 28px;
    }

    .detail-title {
        font-size: 20px;
        font-weight: 700;
        color: #343a40;
        margin-bottom: 3px;
    }

    .detail-subtitle {
        font-size: 12px;
        color: #8a8a95;
        margin-bottom: 0;
    }

    .detail-header .btn {
        min-height: 40px;
        border-radius: 8px;
        font-size: 12px;
        padding: 8px 16px;
    }

    /* =========================================================
       SECTION
    ========================================================= */

    .section-card {
        border: 1px solid #eeeeee;
        border-radius: 12px;
        background: #ffffff;
        overflow: hidden;
        height: 100%;
    }

    .section-header {
        padding: 15px 18px;
        background: #fafaff;
        border-bottom: 1px solid #eeeeee;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .section-header-left {
        display: flex;
        align-items: center;
    }

    .section-icon {
        width: 38px;
        height: 38px;
        border-radius: 9px;
        background: rgba(75, 73, 172, .10);
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 11px;
        flex-shrink: 0;
    }

    .section-icon i {
        font-size: 19px;
    }

    .section-title {
        font-size: 14px;
        font-weight: 700;
        color: #343a40;
        margin: 0;
    }

    .section-description {
        font-size: 10px;
        color: #8a8a95;
        margin: 2px 0 0;
    }

    .section-body {
        padding: 20px;
    }

    /* =========================================================
       COMPANY PROFILE
    ========================================================= */

    .company-profile {
        display: flex;
        align-items: center;
        padding: 4px 0 20px;
    }

    .company-icon {
        width: 66px;
        height: 66px;
        border-radius: 14px;
        background: rgba(75, 73, 172, .10);
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        flex-shrink: 0;
    }

    .company-icon i {
        font-size: 32px;
    }

    .company-name {
        font-size: 17px;
        font-weight: 700;
        color: #343a40;
        margin-bottom: 4px;
    }

    .company-id {
        font-size: 11px;
        color: #8a8a95;
    }

    .company-status {
        display: inline-flex;
        align-items: center;
        padding: 5px 9px;
        border-radius: 20px;
        background: #eaf8ef;
        color: #198754;
        font-size: 10px;
        font-weight: 600;
        margin-top: 7px;
    }

    .company-status i {
        font-size: 12px;
        margin-right: 4px;
    }

    /* =========================================================
       INFORMATION
    ========================================================= */

    .information-item {
        padding: 13px 0;
        border-top: 1px solid #f0f0f3;
    }

    .information-item:first-child {
        border-top: 0;
        padding-top: 0;
    }

    .information-item:last-child {
        padding-bottom: 0;
    }

    .information-label {
        font-size: 10px;
        color: #8a8a95;
        margin-bottom: 4px;
        text-transform: uppercase;
        letter-spacing: .2px;
    }

    .information-value {
        font-size: 12px;
        font-weight: 500;
        color: #343a40;
        line-height: 1.6;
        word-break: break-word;
    }

    .information-value i {
        color: #4b49ac;
        margin-right: 5px;
    }

    /* =========================================================
       GPS
    ========================================================= */

    .gps-stat {
        border: 1px solid #eeeeee;
        border-radius: 10px;
        padding: 13px;
        height: 100%;
        background: #ffffff;
    }

    .gps-stat-label {
        font-size: 10px;
        color: #8a8a95;
        margin-bottom: 5px;
    }

    .gps-stat-value {
        font-size: 14px;
        font-weight: 700;
        color: #343a40;
        word-break: break-all;
    }

    .gps-radius {
        border: 1px solid #e7e6fa;
        background: #f8f8ff;
        border-radius: 10px;
        padding: 15px;
    }

    .gps-radius-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: rgba(75, 73, 172, .10);
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        flex-shrink: 0;
    }

    .gps-radius-icon i {
        font-size: 21px;
    }

    .gps-radius-label {
        font-size: 10px;
        color: #8a8a95;
        margin-bottom: 2px;
    }

    .gps-radius-value {
        font-size: 18px;
        font-weight: 700;
        color: #343a40;
    }

    .gps-radius-value small {
        font-size: 10px;
        font-weight: 400;
        color: #8a8a95;
    }

    /* =========================================================
       MAP
    ========================================================= */

    .map-container {
        border: 1px solid #e1e1e8;
        border-radius: 12px;
        overflow: hidden;
        background: #f8f8fb;
    }

    .map-topbar {
        padding: 12px 15px;
        background: #fafaff;
        border-bottom: 1px solid #e1e1e8;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
    }

    .map-topbar-title {
        font-size: 12px;
        font-weight: 700;
        color: #343a40;
    }

    .map-topbar-title i {
        color: #4b49ac;
        margin-right: 5px;
    }

    .map-topbar-description {
        font-size: 10px;
        color: #8a8a95;
        margin-top: 2px;
    }

    .map-open-button {
        border-radius: 7px;
        font-size: 10px;
        padding: 6px 10px;
        white-space: nowrap;
    }

    #industri-detail-map {
        width: 100%;
        height: 390px;
        z-index: 1;
    }

    .map-footer {
        padding: 10px 14px;
        background: #ffffff;
        border-top: 1px solid #e1e1e8;
        font-size: 10px;
        color: #8a8a95;
    }

    .map-footer strong {
        color: #343a40;
    }

    .map-empty {
        min-height: 390px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 30px;
        background: #fafaff;
    }

    .map-empty-icon {
        width: 65px;
        height: 65px;
        border-radius: 50%;
        background: #fff4e5;
        color: #f0ad4e;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 12px;
    }

    .map-empty-icon i {
        font-size: 31px;
    }

    .map-empty-title {
        font-size: 14px;
        font-weight: 700;
        color: #343a40;
        margin-bottom: 4px;
    }

    .map-empty-text {
        font-size: 11px;
        color: #8a8a95;
        margin-bottom: 15px;
    }

    /* =========================================================
       TABLE
    ========================================================= */

    .table-card {
        border: 1px solid #eeeeee;
        border-radius: 12px;
        overflow: hidden;
        background: #ffffff;
    }

    .table-card-header {
        padding: 15px 18px;
        background: #fafaff;
        border-bottom: 1px solid #eeeeee;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
    }

    .table-card-title {
        font-size: 14px;
        font-weight: 700;
        color: #343a40;
        margin: 0;
    }

    .table-card-description {
        font-size: 10px;
        color: #8a8a95;
        margin: 2px 0 0;
    }

    .count-badge {
        background: rgba(75, 73, 172, .10);
        color: #4b49ac;
        border-radius: 20px;
        padding: 6px 10px;
        font-size: 10px;
        font-weight: 600;
        white-space: nowrap;
    }

    .detail-table {
        margin-bottom: 0;
        min-width: 850px;
    }

    .detail-table thead th {
        background: #ffffff;
        color: #8a8a95;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .2px;
        border-bottom: 1px solid #eeeeee;
        padding: 12px 15px;
        white-space: nowrap;
    }

    .detail-table tbody td {
        font-size: 11px;
        color: #555b62;
        padding: 13px 15px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f1f4;
    }

    .detail-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .detail-table tbody tr:hover {
        background: #fafaff;
    }

    .table-avatar {
        width: 35px;
        height: 35px;
        min-width: 35px;
        border-radius: 9px;
        background: rgba(75, 73, 172, .10);
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 9px;
    }

    .table-avatar i {
        font-size: 17px;
    }

    .table-name {
        font-size: 11px;
        font-weight: 600;
        color: #343a40;
    }

    .table-secondary {
        font-size: 9px;
        color: #8a8a95;
        margin-top: 2px;
    }

    .empty-state {
        text-align: center;
        padding: 45px 20px !important;
    }

    .empty-state-icon {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        background: #f5f5f8;
        color: #b5b5c3;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
    }

    .empty-state-icon i {
        font-size: 27px;
    }

    .empty-state-title {
        font-size: 12px;
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 3px;
    }

    .empty-state-text {
        font-size: 10px;
        color: #a0a0aa;
    }

    /* =========================================================
       STATUS
    ========================================================= */

    .status-badge {
        display: inline-flex;
        align-items: center;
        border-radius: 20px;
        padding: 5px 9px;
        font-size: 9px;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-success {
        background: #eaf8ef;
        color: #198754;
    }

    .status-primary {
        background: #eef0ff;
        color: #4b49ac;
    }

    .status-warning {
        background: #fff5df;
        color: #b58105;
    }

    .status-danger {
        background: #fff0f0;
        color: #dc3545;
    }

    .status-secondary {
        background: #f1f1f4;
        color: #6c757d;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 767.98px) {

        .detail-header {
            padding: 18px;
        }

        .detail-header-icon {
            width: 45px;
            height: 45px;
        }

        .detail-header-icon i {
            font-size: 23px;
        }

        .detail-title {
            font-size: 17px;
        }

        .detail-subtitle {
            font-size: 10px;
        }

        .detail-header-actions {
            width: 100%;
            margin-top: 15px;
        }

        .detail-header-actions .btn {
            flex: 1;
        }

        .section-body {
            padding: 15px;
        }

        .company-name {
            font-size: 15px;
        }

        #industri-detail-map {
            height: 320px;
        }

        .map-empty {
            min-height: 320px;
        }

        .map-topbar {
            align-items: flex-start;
            flex-direction: column;
        }

        .map-open-button {
            width: 100%;
        }

        .table-card-header {
            align-items: flex-start;
        }
    }
</style>


{{-- =========================================================
     HEADER
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card detail-card shadow-sm">

            <div class="detail-header">

                <div class="row align-items-center">

                    <div class="col-md-7">

                        <div class="d-flex align-items-center">

                            <div class="detail-header-icon me-3">

                                <i class="mdi mdi-office-building-outline"></i>

                            </div>

                            <div>

                                <h3 class="detail-title">
                                    Detail Industri
                                </h3>

                                <p class="detail-subtitle">
                                    Informasi lengkap industri, lokasi GPS,
                                    pembimbing, dan siswa PKL.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-5">

                        <div class="d-flex justify-content-md-end gap-2 detail-header-actions">

                            <a
                                href="{{ route('admin.industri.edit', $perusahaan->id) }}"
                                class="btn btn-primary">

                                <i class="mdi mdi-square-edit-outline me-1"></i>

                                Edit

                            </a>


                            <a
                                href="{{ route('admin.industri.index') }}"
                                class="btn btn-light">

                                <i class="mdi mdi-arrow-left me-1"></i>

                                Kembali

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     INFORMASI INDUSTRI + GPS
========================================================= --}}

<div class="row">

    {{-- =========================================================
         INFORMASI INDUSTRI
    ========================================================= --}}

    <div class="col-lg-5 grid-margin stretch-card">

        <div class="section-card shadow-sm">

            <div class="section-header">

                <div class="section-header-left">

                    <div class="section-icon">

                        <i class="mdi mdi-domain"></i>

                    </div>

                    <div>

                        <h5 class="section-title">
                            Informasi Industri
                        </h5>

                        <p class="section-description">
                            Data utama perusahaan atau DUDI.
                        </p>

                    </div>

                </div>

            </div>


            <div class="section-body">

                <div class="company-profile">

                    <div class="company-icon">

                        <i class="mdi mdi-office-building-outline"></i>

                    </div>


                    <div>

                        <div class="company-name">

                            {{ $perusahaan->nama_perusahaan }}

                        </div>


                        <div class="company-id">

                            ID Industri #{{ $perusahaan->id }}

                        </div>


                        <div class="company-status">

                            <i class="mdi mdi-check-circle"></i>

                            Terdaftar

                        </div>

                    </div>

                </div>


                <div class="information-item">

                    <div class="information-label">
                        Alamat
                    </div>

                    <div class="information-value">

                        <i class="mdi mdi-map-marker-outline"></i>

                        {{ $perusahaan->alamat ?? '-' }}

                    </div>

                </div>


                <div class="row">

                    <div class="col-md-6">

                        <div class="information-item">

                            <div class="information-label">
                                Telepon
                            </div>

                            <div class="information-value">

                                <i class="mdi mdi-phone-outline"></i>

                                {{ $perusahaan->telepon ?? '-' }}

                            </div>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="information-item">

                            <div class="information-label">
                                Email
                            </div>

                            <div class="information-value">

                                <i class="mdi mdi-email-outline"></i>

                                {{ $perusahaan->email ?? '-' }}

                            </div>

                        </div>

                    </div>

                </div>


                <div class="information-item">

                    <div class="information-label">
                        Terdaftar
                    </div>

                    <div class="information-value">

                        <i class="mdi mdi-calendar-outline"></i>

                        {{ $perusahaan->created_at?->format('d M Y H:i') ?? '-' }}

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         LOKASI GPS
    ========================================================= --}}

    <div class="col-lg-7 grid-margin stretch-card">

        <div class="section-card shadow-sm">

            <div class="section-header">

                <div class="section-header-left">

                    <div class="section-icon">

                        <i class="mdi mdi-map-marker-radius-outline"></i>

                    </div>

                    <div>

                        <h5 class="section-title">
                            Lokasi & Absensi GPS
                        </h5>

                        <p class="section-description">
                            Titik lokasi dan area validasi absensi siswa.
                        </p>

                    </div>

                </div>


                @if(
                $perusahaan->latitude !== null &&
                $perusahaan->longitude !== null
                )

                <span class="status-badge status-success">

                    <i class="mdi mdi-check-circle me-1"></i>

                    GPS Aktif

                </span>

                @endif

            </div>


            <div class="section-body">

                @if(
                $perusahaan->latitude !== null &&
                $perusahaan->longitude !== null
                )

                {{-- =================================================
                         MAP
                    ================================================== --}}

                <div class="map-container mb-3">

                    <div class="map-topbar">

                        <div>

                            <div class="map-topbar-title">

                                <i class="mdi mdi-map-outline"></i>

                                Lokasi Industri

                            </div>

                            <div class="map-topbar-description">

                                Marker menunjukkan lokasi industri,
                                lingkaran menunjukkan radius absensi.

                            </div>

                        </div>


                        <a
                            href="https://www.google.com/maps/search/?api=1&query={{ $perusahaan->latitude }},{{ $perusahaan->longitude }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="btn btn-outline-primary map-open-button">

                            <i class="mdi mdi-open-in-new me-1"></i>

                            Google Maps

                        </a>

                    </div>


                    <div id="industri-detail-map"></div>


                    <div class="map-footer">

                        <i class="mdi mdi-map-marker text-primary me-1"></i>

                        Koordinat:

                        <strong>

                            {{ $perusahaan->latitude }},
                            {{ $perusahaan->longitude }}

                        </strong>

                    </div>

                </div>


                {{-- =================================================
                         KOORDINAT
                    ================================================== --}}

                <div class="row">

                    <div class="col-md-6 mb-3 mb-md-0">

                        <div class="gps-stat">

                            <div class="gps-stat-label">
                                LATITUDE
                            </div>

                            <div class="gps-stat-value">

                                {{ $perusahaan->latitude }}

                            </div>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="gps-stat">

                            <div class="gps-stat-label">
                                LONGITUDE
                            </div>

                            <div class="gps-stat-value">

                                {{ $perusahaan->longitude }}

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                         RADIUS
                    ================================================== --}}

                <div class="gps-radius mt-3">

                    <div class="d-flex align-items-center">

                        <div class="gps-radius-icon">

                            <i class="mdi mdi-radar"></i>

                        </div>


                        <div>

                            <div class="gps-radius-label">
                                RADIUS ABSENSI
                            </div>

                            <div class="gps-radius-value">

                                {{ $perusahaan->radius_absensi ?? 0 }}

                                <small>
                                    meter
                                </small>

                            </div>

                        </div>

                    </div>

                </div>

                @else

                {{-- =================================================
                         BELUM ADA LOKASI
                    ================================================== --}}

                <div class="map-empty">

                    <div>

                        <div class="map-empty-icon">

                            <i class="mdi mdi-map-marker-off-outline"></i>

                        </div>


                        <div class="map-empty-title">

                            Lokasi GPS Belum Diatur

                        </div>


                        <p class="map-empty-text">

                            Latitude dan longitude industri
                            belum tersedia.

                        </p>


                        <a
                            href="{{ route('admin.industri.edit', $perusahaan->id) }}"
                            class="btn btn-primary btn-sm">

                            <i class="mdi mdi-map-marker-plus-outline me-1"></i>

                            Atur Lokasi

                        </a>

                    </div>

                </div>

                @endif

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     PEMBIMBING INDUSTRI
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="table-card shadow-sm">

            <div class="table-card-header">

                <div>

                    <h5 class="table-card-title">

                        <i class="mdi mdi-account-tie-outline text-primary me-1"></i>

                        Pembimbing Industri

                    </h5>

                    <p class="table-card-description">

                        Pembimbing industri yang terhubung dengan
                        perusahaan ini.

                    </p>

                </div>


                <span class="count-badge">

                    {{ $perusahaan->industris->count() }}

                    Pembimbing

                </span>

            </div>


            <div class="table-responsive">

                <table class="table detail-table">

                    <thead>

                        <tr>

                            <th width="60">
                                No
                            </th>

                            <th>
                                Pembimbing
                            </th>

                            <th>
                                Email
                            </th>

                            <th>
                                Jabatan
                            </th>

                            <th>
                                No. HP
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse(
                        $perusahaan->industris ?? collect()
                        as $industri
                        )

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>


                            <td>

                                <div class="d-flex align-items-center">

                                    <div class="table-avatar">

                                        <i class="mdi mdi-account-tie-outline"></i>

                                    </div>


                                    <div>

                                        <div class="table-name">

                                            {{ $industri->user->name ?? '-' }}

                                        </div>

                                    </div>

                                </div>

                            </td>


                            <td>

                                {{ $industri->user->email ?? '-' }}

                            </td>


                            <td>

                                {{ $industri->jabatan ?? '-' }}

                            </td>


                            <td>

                                {{ $industri->no_hp ?? '-' }}

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td
                                colspan="5"
                                class="empty-state">

                                <div class="empty-state-icon">

                                    <i class="mdi mdi-account-off-outline"></i>

                                </div>


                                <div class="empty-state-title">

                                    Belum Ada Pembimbing

                                </div>


                                <div class="empty-state-text">

                                    Belum ada pembimbing industri
                                    pada perusahaan ini.

                                </div>

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     DATA PENEMPATAN PKL
========================================================= --}}

@php

$industris = $perusahaan->industris ?? collect();

$penempatans = $industris
->flatMap(function ($industri) {

return $industri->penempatanPKL ?? collect();

})
->unique('id')
->values();

@endphp


{{-- =========================================================
     SISWA PKL
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="table-card shadow-sm">

            <div class="table-card-header">

                <div>

                    <h5 class="table-card-title">

                        <i class="mdi mdi-account-school-outline text-primary me-1"></i>

                        Siswa PKL

                    </h5>

                    <p class="table-card-description">

                        Siswa yang ditempatkan pada perusahaan ini.

                    </p>

                </div>


                <span class="count-badge">

                    {{ $penempatans->count() }}

                    Siswa

                </span>

            </div>


            <div class="table-responsive">

                <table class="table detail-table">

                    <thead>

                        <tr>

                            <th width="60">
                                No
                            </th>

                            <th>
                                Siswa
                            </th>

                            <th>
                                NISN
                            </th>

                            <th>
                                Guru Pembimbing
                            </th>

                            <th>
                                Pembimbing Industri
                            </th>

                            <th>
                                Periode
                            </th>

                            <th>
                                Status
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($penempatans as $penempatan)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>


                            <td>

                                <div class="d-flex align-items-center">

                                    <div class="table-avatar">

                                        <i class="mdi mdi-account-school-outline"></i>

                                    </div>


                                    <div>

                                        <div class="table-name">

                                            {{ $penempatan->siswa->user->name ?? '-' }}

                                        </div>

                                    </div>

                                </div>

                            </td>


                            <td>

                                {{ $penempatan->siswa->nisn ?? '-' }}

                            </td>


                            <td>

                                {{ $penempatan->guru->user->name ?? '-' }}

                            </td>


                            <td>

                                {{ $penempatan->industri->user->name ?? '-' }}

                            </td>


                            <td>

                                <div>

                                    {{
                                            $penempatan->tanggal_mulai
                                                ? \Carbon\Carbon::parse(
                                                    $penempatan->tanggal_mulai
                                                )->format('d/m/Y')
                                                : '-'
                                        }}

                                </div>


                                <div class="table-secondary">

                                    s/d

                                    {{
                                            $penempatan->tanggal_selesai
                                                ? \Carbon\Carbon::parse(
                                                    $penempatan->tanggal_selesai
                                                )->format('d/m/Y')
                                                : '-'
                                        }}

                                </div>

                            </td>


                            <td>

                                @if($penempatan->status_pkl === 'aktif')

                                <span class="status-badge status-success">

                                    <i class="mdi mdi-check-circle me-1"></i>

                                    Aktif

                                </span>

                                @elseif($penempatan->status_pkl === 'selesai')

                                <span class="status-badge status-primary">

                                    Selesai

                                </span>

                                @elseif($penempatan->status_pkl === 'pending')

                                <span class="status-badge status-warning">

                                    Pending

                                </span>

                                @elseif($penempatan->status_pkl === 'dibatalkan')

                                <span class="status-badge status-danger">

                                    Dibatalkan

                                </span>

                                @else

                                <span class="status-badge status-secondary">

                                    {{
                                                ucfirst(
                                                    $penempatan->status_pkl ?? '-'
                                                )
                                            }}

                                </span>

                                @endif

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td
                                colspan="7"
                                class="empty-state">

                                <div class="empty-state-icon">

                                    <i class="mdi mdi-account-school-outline"></i>

                                </div>


                                <div class="empty-state-title">

                                    Belum Ada Siswa PKL

                                </div>


                                <div class="empty-state-text">

                                    Belum ada siswa yang ditempatkan
                                    pada perusahaan ini.

                                </div>

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     DATA MAP
     
     DATA LARAVEL DITARUH DI HTML
     AGAR JAVASCRIPT TETAP JAVASCRIPT MURNI
========================================================= --}}

@if(
$perusahaan->latitude !== null &&
$perusahaan->longitude !== null
)

<div
    id="industri-map-data"
    data-latitude="{{ $perusahaan->latitude }}"
    data-longitude="{{ $perusahaan->longitude }}"
    data-radius="{{ $perusahaan->radius_absensi ?? 100 }}"
    data-nama="{{ $perusahaan->nama_perusahaan }}"
    data-alamat="{{ $perusahaan->alamat ?? '-' }}"
    style="display: none;">
</div>


{{-- =========================================================
         LEAFLET CSS
    ========================================================= --}}

<link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    crossorigin="anonymous">


{{-- =========================================================
         LEAFLET JAVASCRIPT
    ========================================================= --}}

<script
    src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    crossorigin="anonymous">
</script>


<script>
    document.addEventListener(
        'DOMContentLoaded',
        function() {

            /*
            |--------------------------------------------------------------------------
            | ELEMENT DATA
            |--------------------------------------------------------------------------
            */

            const dataElement =
                document.getElementById(
                    'industri-map-data'
                );


            const mapElement =
                document.getElementById(
                    'industri-detail-map'
                );


            if (
                !dataElement ||
                !mapElement
            ) {

                return;

            }


            /*
            |--------------------------------------------------------------------------
            | AMBIL DATA
            |--------------------------------------------------------------------------
            */

            const latitude =
                parseFloat(
                    dataElement.dataset.latitude
                );


            const longitude =
                parseFloat(
                    dataElement.dataset.longitude
                );


            const radius =
                parseFloat(
                    dataElement.dataset.radius
                );


            const namaIndustri =
                dataElement.dataset.nama ||
                'Industri';


            const alamatIndustri =
                dataElement.dataset.alamat ||
                '-';


            /*
            |--------------------------------------------------------------------------
            | VALIDASI KOORDINAT
            |--------------------------------------------------------------------------
            */

            if (
                Number.isNaN(latitude) ||
                Number.isNaN(longitude)
            ) {

                console.error(
                    'Koordinat industri tidak valid.'
                );

                return;

            }


            /*
            |--------------------------------------------------------------------------
            | CEK LEAFLET
            |--------------------------------------------------------------------------
            */

            if (
                typeof L === 'undefined'
            ) {

                console.error(
                    'Leaflet gagal dimuat.'
                );

                return;

            }


            /*
            |--------------------------------------------------------------------------
            | BUAT MAP
            |--------------------------------------------------------------------------
            */

            const map =
                L.map(
                    'industri-detail-map', {

                        center: [
                            latitude,
                            longitude
                        ],

                        zoom: 16,

                        scrollWheelZoom: false

                    }
                );


            /*
            |--------------------------------------------------------------------------
            | OPEN STREET MAP
            |--------------------------------------------------------------------------
            */

            L.tileLayer(
                'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {

                    maxZoom: 19,

                    attribution: '&copy; OpenStreetMap contributors'

                }
            ).addTo(map);


            /*
            |--------------------------------------------------------------------------
            | MARKER
            |--------------------------------------------------------------------------
            */

            const marker =
                L.marker(
                    [
                        latitude,
                        longitude
                    ]
                ).addTo(map);


            /*
            |--------------------------------------------------------------------------
            | POPUP
            |--------------------------------------------------------------------------
            */

            marker.bindPopup(

                '<div style="min-width:220px;">' +

                '<div style="' +
                'font-size:14px;' +
                'font-weight:700;' +
                'color:#343a40;' +
                'margin-bottom:5px;' +
                '">' +

                escapeHtml(
                    namaIndustri
                ) +

                '</div>' +


                '<div style="' +
                'font-size:10px;' +
                'color:#8a8a95;' +
                'margin-bottom:8px;' +
                '">' +

                'Lokasi Industri' +

                '</div>' +


                '<div style="' +
                'border-top:1px solid #eeeeee;' +
                'padding-top:8px;' +
                'font-size:10px;' +
                'line-height:1.7;' +
                '">' +

                '<strong>Alamat:</strong><br>' +

                escapeHtml(
                    alamatIndustri
                ) +

                '<br><br>' +

                '<strong>Latitude:</strong> ' +

                latitude +

                '<br>' +

                '<strong>Longitude:</strong> ' +

                longitude +

                '<br>' +

                '<strong>Radius:</strong> ' +

                radius +

                ' meter' +

                '</div>' +

                '</div>'

            );


            /*
            |--------------------------------------------------------------------------
            | RADIUS ABSENSI
            |--------------------------------------------------------------------------
            */

            let radiusCircle = null;


            if (
                !Number.isNaN(radius) &&
                radius > 0
            ) {

                radiusCircle =
                    L.circle(
                        [
                            latitude,
                            longitude
                        ], {

                            radius: radius,

                            color: '#4b49ac',

                            fillColor: '#4b49ac',

                            fillOpacity: 0.13,

                            weight: 2

                        }
                    ).addTo(map);


                /*
                |--------------------------------------------------------------------------
                | SESUAIKAN ZOOM
                |--------------------------------------------------------------------------
                */

                map.fitBounds(
                    radiusCircle.getBounds(), {

                        padding: [
                            25,
                            25
                        ]

                    }
                );

            }


            /*
            |--------------------------------------------------------------------------
            | BUKA POPUP
            |--------------------------------------------------------------------------
            */

            marker.openPopup();


            /*
            |--------------------------------------------------------------------------
            | PERBAIKI UKURAN MAP
            |--------------------------------------------------------------------------
            */

            setTimeout(
                function() {

                    map.invalidateSize();

                },
                300
            );


            /*
            |--------------------------------------------------------------------------
            | ESCAPE HTML
            |--------------------------------------------------------------------------
            */

            function escapeHtml(
                value
            ) {

                const element =
                    document.createElement(
                        'div'
                    );


                element.textContent =
                    value || '';


                return element.innerHTML;

            }

        }
    );
</script>

@endif

@endsection