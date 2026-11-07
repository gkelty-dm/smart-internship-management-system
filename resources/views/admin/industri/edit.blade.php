@extends('layouts.skydash-admin')

@section('title', 'Edit Industri')

@section('content')

<style>
    /* =========================================================
       EDIT INDUSTRI
    ========================================================= */

    .industri-create-card {
        border: 0;
        border-radius: 14px;
        overflow: hidden;
    }

    .industri-page-header {
        padding: 24px;
        border-bottom: 1px solid #eeeeee;
        background: #ffffff;
    }

    .industri-page-icon {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        background: rgba(75, 73, 172, .10);
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .industri-page-icon i {
        font-size: 27px;
    }

    .industri-page-title {
        font-size: 20px;
        font-weight: 700;
        color: #343a40;
        margin-bottom: 3px;
    }

    .industri-page-subtitle {
        font-size: 13px;
        color: #6c757d;
        margin-bottom: 0;
    }

    .industri-section {
        border: 1px solid #eeeeee;
        border-radius: 12px;
        margin-bottom: 20px;
        overflow: hidden;
        background: #ffffff;
    }

    .industri-section-header {
        padding: 15px 18px;
        background: #fafaff;
        border-bottom: 1px solid #eeeeee;
        display: flex;
        align-items: center;
    }

    .industri-section-icon {
        width: 38px;
        height: 38px;
        border-radius: 9px;
        background: rgba(75, 73, 172, .10);
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        flex-shrink: 0;
    }

    .industri-section-icon i {
        font-size: 20px;
    }

    .industri-section-title {
        font-size: 14px;
        font-weight: 700;
        color: #343a40;
        margin: 0;
    }

    .industri-section-description {
        font-size: 11px;
        color: #6c757d;
        margin: 2px 0 0;
    }

    .industri-section-body {
        padding: 20px;
    }

    .industri-form .form-group {
        margin-bottom: 18px;
    }

    .industri-form .form-label {
        font-size: 13px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 7px;
    }

    .industri-form .form-control {
        min-height: 44px;
        height: 44px;
        padding: 9px 13px;
        font-size: 13px;
        border-radius: 8px;
        border-color: #e1e1e8;
        background-color: #fff;
    }

    .industri-form .form-control:focus {
        border-color: #4b49ac;
        box-shadow: 0 0 0 .15rem rgba(75, 73, 172, .10);
    }

    .industri-form textarea.form-control {
        height: 105px;
        min-height: 105px;
        resize: vertical;
        line-height: 1.6;
    }

    .industri-input-group .input-group-text {
        min-width: 42px;
        justify-content: center;
        background: #f8f8fb;
        border-color: #e1e1e8;
        color: #6c757d;
    }

    .industri-input-group .form-control {
        border-left: 0;
    }

    .industri-input-group:focus-within .input-group-text {
        border-color: #4b49ac;
        color: #4b49ac;
    }

    .required-mark {
        color: #dc3545;
        margin-left: 2px;
    }

    .field-hint {
        display: block;
        font-size: 11px;
        color: #8a8a95;
        margin-top: 5px;
    }

    /* =========================================================
       ERROR
    ========================================================= */

    .error-card {
        border: 0;
        border-radius: 10px;
        background: #fff5f5;
        color: #842029;
        padding: 15px 17px;
    }

    .error-card-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: rgba(220, 53, 69, .10);
        color: #dc3545;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .error-card-icon i {
        font-size: 19px;
    }

    .error-card-title {
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .error-card ul {
        font-size: 12px;
        line-height: 1.7;
    }

    /* =========================================================
       GPS INFO
    ========================================================= */

    .gps-info {
        padding: 12px 14px;
        border-radius: 10px;
        background: #f3f7ff;
        border: 1px solid #dfe8ff;
        color: #626b82;
        font-size: 11px;
        line-height: 1.6;
        margin-bottom: 18px;
    }

    .gps-info i {
        color: #4b49ac;
        font-size: 18px;
        flex-shrink: 0;
    }

    /* =========================================================
       MAP
    ========================================================= */

    .map-wrapper {
        border: 1px solid #e1e1e8;
        border-radius: 12px;
        overflow: visible;
        background: #f8f8fb;
        margin-bottom: 20px;
        position: relative;
    }

    .map-search-wrapper {
        position: relative;
        padding: 12px;
        background: #fafaff;
        border-bottom: 1px solid #e1e1e8;
        z-index: 1000;
    }

    .map-search-box {
        position: relative;
    }

    .map-search-box .input-group {
        background: #ffffff;
        border: 1px solid #e1e1e8;
        border-radius: 9px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .04);
    }

    .map-search-box .input-group-text {
        background: #ffffff;
        border: 0;
        color: #4b49ac;
        min-width: 42px;
        justify-content: center;
    }

    .map-search-box .form-control {
        border: 0 !important;
        box-shadow: none !important;
        height: 44px;
        min-height: 44px;
        padding-left: 0;
    }

    .map-search-button {
        border: 0;
        background: #4b49ac;
        color: #ffffff;
        padding: 0 16px;
        font-size: 12px;
        font-weight: 500;
    }

    .map-search-button:hover {
        background: #3f3d91;
        color: #ffffff;
    }

    .map-search-results {
        position: absolute;
        top: 50px;
        left: 0;
        right: 0;
        z-index: 2000;
        background: #ffffff;
        border: 1px solid #e1e1e8;
        border-radius: 9px;
        box-shadow: 0 5px 18px rgba(0, 0, 0, .12);
        overflow: hidden;
        display: none;
    }

    .map-search-results.show {
        display: block;
    }

    .map-search-result {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 11px 13px;
        border-bottom: 1px solid #f0f0f3;
        cursor: pointer;
        transition: .15s ease;
    }

    .map-search-result:last-child {
        border-bottom: 0;
    }

    .map-search-result:hover {
        background: #f7f7ff;
    }

    .map-search-result-icon {
        width: 30px;
        height: 30px;
        min-width: 30px;
        border-radius: 7px;
        background: rgba(75, 73, 172, .10);
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .map-search-result-icon i {
        font-size: 16px;
    }

    .map-search-result-title {
        font-size: 12px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 2px;
    }

    .map-search-result-address {
        font-size: 10px;
        line-height: 1.5;
        color: #8a8a95;
    }

    .map-search-loading {
        padding: 13px;
        text-align: center;
        font-size: 11px;
        color: #8a8a95;
    }

    .map-search-empty {
        padding: 15px;
        text-align: center;
        font-size: 11px;
        color: #8a8a95;
    }

    .map-search-empty i {
        display: block;
        font-size: 24px;
        margin-bottom: 5px;
        color: #b5b5c3;
    }

    .map-header {
        padding: 12px 15px;
        background: #fafaff;
        border-bottom: 1px solid #e1e1e8;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .map-header-title {
        font-size: 13px;
        font-weight: 700;
        color: #343a40;
    }

    .map-header-title i {
        color: #4b49ac;
        margin-right: 5px;
    }

    .map-header-help {
        font-size: 10px;
        color: #8a8a95;
    }

    #industri-map {
        width: 100%;
        height: 350px;
        z-index: 1;
    }

    .map-footer {
        padding: 10px 14px;
        background: #ffffff;
        border-top: 1px solid #e1e1e8;
        font-size: 11px;
        color: #6c757d;
    }

    .map-footer strong {
        color: #343a40;
    }

    .map-location-btn {
        border-radius: 7px;
        font-size: 11px;
        padding: 6px 10px;
    }

    /* =========================================================
       RADIUS
    ========================================================= */

    .radius-preview {
        padding: 12px 14px;
        background: #f8f8ff;
        border: 1px solid #e7e6fa;
        border-radius: 10px;
        margin-top: 4px;
    }

    .radius-preview-title {
        font-size: 12px;
        font-weight: 700;
        color: #343a40;
        margin-bottom: 3px;
    }

    .radius-preview-text {
        font-size: 11px;
        color: #6c757d;
        margin-bottom: 0;
    }

    /* =========================================================
       FOOTER
    ========================================================= */

    .form-footer {
        border-top: 1px solid #eeeeee;
        padding-top: 20px;
        margin-top: 5px;
    }

    .form-footer .btn {
        min-height: 42px;
        border-radius: 8px;
        padding-left: 18px;
        padding-right: 18px;
        font-size: 13px;
        font-weight: 500;
    }

    .back-button {
        border-radius: 8px;
        font-size: 13px;
        min-height: 40px;
    }

    .required-info {
        font-size: 11px;
        color: #8a8a95;
    }

    .required-info span {
        color: #dc3545;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 767.98px) {

        .industri-page-header {
            padding: 18px;
        }

        .industri-page-icon {
            width: 45px;
            height: 45px;
        }

        .industri-page-icon i {
            font-size: 23px;
        }

        .industri-page-title {
            font-size: 17px;
        }

        .industri-page-subtitle {
            font-size: 11px;
        }

        .industri-page-header .back-button {
            margin-top: 15px;
            width: 100%;
        }

        .industri-section-header {
            padding: 13px 15px;
        }

        .industri-section-body {
            padding: 15px;
        }

        .industri-section-icon {
            width: 34px;
            height: 34px;
        }

        .industri-section-icon i {
            font-size: 17px;
        }

        .industri-section-title {
            font-size: 13px;
        }

        .industri-section-description {
            font-size: 10px;
        }

        #industri-map {
            height: 300px;
        }

        .map-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .map-search-button {
            padding: 0 12px;
        }

        .map-search-button span {
            display: none;
        }

        .form-footer {
            display: flex;
            flex-direction: column-reverse;
            gap: 8px;
        }

        .form-footer .btn {
            width: 100%;
            margin: 0 !important;
        }
    }
</style>


{{-- =========================================================
     HEADER
========================================================== --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card shadow-sm industri-create-card">

            <div class="industri-page-header">

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <div class="d-flex align-items-center">

                            <div class="industri-page-icon me-3">

                                <i class="mdi mdi-office-building-outline"></i>

                            </div>

                            <div>

                                <h3 class="industri-page-title">
                                    Edit Industri
                                </h3>

                                <p class="industri-page-subtitle">
                                    Perbarui informasi industri dan lokasi
                                    GPS untuk kebutuhan PKL.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-4 text-md-end">

                        <a
                            href="{{ route('admin.industri.index') }}"
                            class="btn btn-light back-button shadow-sm">

                            <i class="mdi mdi-arrow-left me-1"></i>

                            Kembali ke Data Industri

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     VALIDATION ERROR
========================================================== --}}

@if($errors->any())

<div class="row">

    <div class="col-12">

        <div class="error-card shadow-sm mb-4">

            <div class="d-flex align-items-start">

                <div class="error-card-icon me-3">

                    <i class="mdi mdi-alert-outline"></i>

                </div>


                <div>

                    <div class="error-card-title">
                        Terdapat kesalahan pada data
                    </div>


                    <div
                        class="text-muted mb-2"
                        style="font-size:11px;">

                        Silakan periksa kembali isian berikut:

                    </div>


                    <ul class="mb-0 ps-3">

                        @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    </div>

</div>

@endif


{{-- =========================================================
     FORM
========================================================== --}}

<div class="row">

    <div class="col-12">

        <div class="card shadow-sm industri-create-card">

            <div class="card-body p-4 industri-form">

                <form
                    action="{{ route('admin.industri.update', $perusahaan->id) }}"
                    method="POST"
                    autocomplete="off">

                    @csrf

                    @method('PUT')


                    {{-- =================================================
                         INFORMASI INDUSTRI
                    ================================================== --}}

                    <div class="industri-section">

                        <div class="industri-section-header">

                            <div class="industri-section-icon">

                                <i class="mdi mdi-office-building-outline"></i>

                            </div>


                            <div>

                                <h5 class="industri-section-title">
                                    Informasi Industri
                                </h5>

                                <p class="industri-section-description">
                                    Perbarui informasi dasar industri atau DUDI.
                                </p>

                            </div>

                        </div>


                        <div class="industri-section-body">

                            <div class="row">

                                {{-- NAMA --}}
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label
                                            for="nama_perusahaan"
                                            class="form-label">

                                            Nama Industri

                                            <span class="required-mark">*</span>

                                        </label>


                                        <div class="input-group industri-input-group">

                                            <span class="input-group-text">

                                                <i class="mdi mdi-office-building-outline"></i>

                                            </span>


                                            <input
                                                type="text"
                                                name="nama_perusahaan"
                                                id="nama_perusahaan"
                                                class="form-control @error('nama_perusahaan') is-invalid @enderror"
                                                value="{{ old('nama_perusahaan', $perusahaan->nama_perusahaan) }}"
                                                maxlength="255"
                                                required>

                                        </div>


                                        @error('nama_perusahaan')

                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>

                                        @enderror

                                    </div>

                                </div>


                                {{-- TELEPON --}}
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label
                                            for="telepon"
                                            class="form-label">

                                            Telepon

                                        </label>


                                        <div class="input-group industri-input-group">

                                            <span class="input-group-text">

                                                <i class="mdi mdi-phone-outline"></i>

                                            </span>


                                            <input
                                                type="text"
                                                name="telepon"
                                                id="telepon"
                                                class="form-control @error('telepon') is-invalid @enderror"
                                                value="{{ old('telepon', $perusahaan->telepon) }}"
                                                placeholder="08xxxxxxxxxx"
                                                maxlength="30">

                                        </div>


                                        @error('telepon')

                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>

                                        @enderror

                                    </div>

                                </div>


                                {{-- EMAIL --}}
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label
                                            for="email"
                                            class="form-label">

                                            Email

                                        </label>


                                        <div class="input-group industri-input-group">

                                            <span class="input-group-text">

                                                <i class="mdi mdi-email-outline"></i>

                                            </span>


                                            <input
                                                type="email"
                                                name="email"
                                                id="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email', $perusahaan->email) }}"
                                                placeholder="industri@email.com"
                                                maxlength="255">

                                        </div>


                                        @error('email')

                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>

                                        @enderror

                                    </div>

                                </div>


                                {{-- ALAMAT --}}
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label
                                            for="alamat"
                                            class="form-label">

                                            Alamat Industri

                                            <span class="required-mark">*</span>

                                        </label>


                                        <div class="input-group industri-input-group">

                                            <span
                                                class="input-group-text align-items-start pt-3">

                                                <i class="mdi mdi-map-marker-outline"></i>

                                            </span>


                                            <textarea
                                                name="alamat"
                                                id="alamat"
                                                class="form-control @error('alamat') is-invalid @enderror"
                                                required>{{ old('alamat', $perusahaan->alamat) }}</textarea>

                                        </div>


                                        @error('alamat')

                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>

                                        @enderror

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         LOKASI GPS
                    ================================================== --}}

                    <div class="industri-section">

                        <div class="industri-section-header">

                            <div class="industri-section-icon">

                                <i class="mdi mdi-map-marker-radius-outline"></i>

                            </div>


                            <div>

                                <h5 class="industri-section-title">
                                    Lokasi GPS
                                </h5>

                                <p class="industri-section-description">
                                    Perbarui titik lokasi industri untuk
                                    validasi absensi GPS siswa.
                                </p>

                            </div>

                        </div>


                        <div class="industri-section-body">

                            <div class="gps-info">

                                <div class="d-flex align-items-start">

                                    <i class="mdi mdi-information-outline me-2"></i>

                                    <div>

                                        Cari lokasi menggunakan kolom
                                        pencarian, klik langsung pada peta,
                                        geser marker, atau gunakan tombol
                                        <strong>Lokasi Saya</strong>.
                                        Koordinat akan diperbarui otomatis.

                                    </div>

                                </div>

                            </div>


                            {{-- =================================================
                                 MAP
                            ================================================== --}}

                            <div class="map-wrapper">

                                {{-- SEARCH --}}
                                <div class="map-search-wrapper">

                                    <div class="map-search-box">

                                        <div class="input-group">

                                            <span class="input-group-text">

                                                <i class="mdi mdi-magnify"></i>

                                            </span>


                                            <input
                                                type="text"
                                                id="map-search"
                                                class="form-control"
                                                placeholder="Cari alamat, nama tempat, atau lokasi..."
                                                autocomplete="off">


                                            <button
                                                type="button"
                                                id="btn-search-location"
                                                class="map-search-button">

                                                <i class="mdi mdi-magnify me-1"></i>

                                                <span>Cari</span>

                                            </button>

                                        </div>


                                        <div
                                            id="map-search-results"
                                            class="map-search-results">
                                        </div>

                                    </div>

                                </div>


                                <div class="map-header">

                                    <div>

                                        <div class="map-header-title">

                                            <i class="mdi mdi-map-outline"></i>

                                            Pilih Lokasi Industri

                                        </div>

                                        <div class="map-header-help">

                                            Klik peta atau geser marker untuk
                                            memperbarui titik

                                        </div>

                                    </div>


                                    <button
                                        type="button"
                                        id="btn-current-location"
                                        class="btn btn-sm btn-outline-primary map-location-btn">

                                        <i class="mdi mdi-crosshairs-gps me-1"></i>

                                        Lokasi Saya

                                    </button>

                                </div>


                                <div id="industri-map"></div>


                                <div class="map-footer">

                                    <i class="mdi mdi-map-marker text-primary me-1"></i>

                                    Posisi:

                                    <strong id="map-position-text">

                                        {{ $perusahaan->latitude && $perusahaan->longitude
                                            ? $perusahaan->latitude . ', ' . $perusahaan->longitude
                                            : 'Belum dipilih' }}

                                    </strong>

                                </div>

                            </div>


                            {{-- =================================================
                                 LATITUDE & LONGITUDE
                            ================================================== --}}

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label
                                            for="latitude"
                                            class="form-label">

                                            Latitude

                                        </label>


                                        <div class="input-group industri-input-group">

                                            <span class="input-group-text">

                                                <i class="mdi mdi-map-marker-outline"></i>

                                            </span>


                                            <input
                                                type="number"
                                                name="latitude"
                                                id="latitude"
                                                class="form-control @error('latitude') is-invalid @enderror"
                                                value="{{ old('latitude', $perusahaan->latitude) }}"
                                                step="any"
                                                placeholder="Contoh: -3.795000">

                                        </div>


                                        @error('latitude')

                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>

                                        @enderror


                                        <small class="field-hint">
                                            Nilai antara -90 sampai 90.
                                        </small>

                                    </div>

                                </div>


                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label
                                            for="longitude"
                                            class="form-label">

                                            Longitude

                                        </label>


                                        <div class="input-group industri-input-group">

                                            <span class="input-group-text">

                                                <i class="mdi mdi-map-marker-outline"></i>

                                            </span>


                                            <input
                                                type="number"
                                                name="longitude"
                                                id="longitude"
                                                class="form-control @error('longitude') is-invalid @enderror"
                                                value="{{ old('longitude', $perusahaan->longitude) }}"
                                                step="any"
                                                placeholder="Contoh: 102.260000">

                                        </div>


                                        @error('longitude')

                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>

                                        @enderror


                                        <small class="field-hint">
                                            Nilai antara -180 sampai 180.
                                        </small>

                                    </div>

                                </div>

                            </div>


                            {{-- =================================================
                                 RADIUS
                            ================================================== --}}

                            <div class="form-group mb-0">

                                <label
                                    for="radius_absensi"
                                    class="form-label">

                                    Radius Absensi

                                    <span class="required-mark">*</span>

                                </label>


                                <div class="input-group industri-input-group">

                                    <span class="input-group-text">

                                        <i class="mdi mdi-radar"></i>

                                    </span>


                                    <input
                                        type="number"
                                        name="radius_absensi"
                                        id="radius_absensi"
                                        class="form-control @error('radius_absensi') is-invalid @enderror"
                                        value="{{ old('radius_absensi', $perusahaan->radius_absensi ?? 100) }}"
                                        min="10"
                                        required>


                                    <span class="input-group-text">
                                        meter
                                    </span>

                                </div>


                                @error('radius_absensi')

                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>

                                @enderror


                                <small class="field-hint">

                                    Siswa hanya dapat melakukan absensi
                                    dalam radius yang telah ditentukan.

                                </small>


                                <div class="radius-preview mt-3">

                                    <div class="d-flex align-items-start">

                                        <i
                                            class="mdi mdi-map-marker-radius text-primary me-2"
                                            style="font-size:18px;">
                                        </i>

                                        <div>

                                            <div class="radius-preview-title">
                                                Radius Validasi GPS
                                            </div>

                                            <p
                                                class="radius-preview-text"
                                                id="radius-preview-text">

                                                Radius absensi:
                                                {{ old('radius_absensi', $perusahaan->radius_absensi ?? 100) }}
                                                meter.

                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         FOOTER
                    ================================================== --}}

                    <div class="form-footer">

                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <div class="required-info">

                                <span>*</span>
                                Menandakan kolom wajib diisi.

                            </div>

                        </div>


                        <div class="d-flex justify-content-end gap-2">

                            <a
                                href="{{ route('admin.industri.index') }}"
                                class="btn btn-light">

                                <i class="mdi mdi-close me-1"></i>

                                Batal

                            </a>


                            <button
                                type="submit"
                                class="btn btn-primary">

                                <i class="mdi mdi-content-save-outline me-1"></i>

                                Simpan Perubahan

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     LEAFLET MAP + SEARCH
========================================================= --}}

@push('scripts')

<link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    crossorigin="" />


<script
    src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    crossorigin="">
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        const latitudeInput =
            document.getElementById('latitude');

        const longitudeInput =
            document.getElementById('longitude');

        const radiusInput =
            document.getElementById('radius_absensi');

        const positionText =
            document.getElementById('map-position-text');

        const radiusText =
            document.getElementById('radius-preview-text');

        const currentLocationButton =
            document.getElementById('btn-current-location');

        const searchInput =
            document.getElementById('map-search');

        const searchButton =
            document.getElementById('btn-search-location');

        const searchResults =
            document.getElementById('map-search-results');


        /* =========================================================
           DATA LOKASI AWAL
        ========================================================= */

        const oldLatitude =
            parseFloat(latitudeInput.value);

        const oldLongitude =
            parseFloat(longitudeInput.value);


        const hasOldLocation = !isNaN(oldLatitude) &&
            !isNaN(oldLongitude);


        const defaultLatitude =
            hasOldLocation ?
            oldLatitude :
            -2.5489;


        const defaultLongitude =
            hasOldLocation ?
            oldLongitude :
            118.0149;


        const defaultZoom =
            hasOldLocation ?
            16 :
            5;


        /* =========================================================
           MAP
        ========================================================= */

        const map =
            L.map('industri-map', {

                center: [
                    defaultLatitude,
                    defaultLongitude
                ],

                zoom: defaultZoom

            });


        L.tileLayer(
            'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {

                maxZoom: 19,

                attribution: '&copy; OpenStreetMap contributors'

            }
        ).addTo(map);


        let marker = null;

        let radiusCircle = null;


        /* =========================================================
           UPDATE LOCATION
        ========================================================= */

        function updateLocation(
            latitude,
            longitude,
            moveMap = true
        ) {

            latitudeInput.value =
                Number(latitude).toFixed(7);


            longitudeInput.value =
                Number(longitude).toFixed(7);


            if (marker) {

                marker.setLatLng([
                    latitude,
                    longitude
                ]);

            } else {

                marker =
                    L.marker(
                        [
                            latitude,
                            longitude
                        ], {
                            draggable: true
                        }
                    ).addTo(map);


                marker.on(
                    'dragend',
                    function(event) {

                        const position =
                            event.target.getLatLng();


                        updateLocation(
                            position.lat,
                            position.lng,
                            false
                        );

                    }
                );

            }


            updateRadiusCircle(
                latitude,
                longitude
            );


            positionText.textContent =
                Number(latitude).toFixed(7) +
                ', ' +
                Number(longitude).toFixed(7);


            if (moveMap) {

                map.setView(
                    [
                        latitude,
                        longitude
                    ],
                    17
                );

            }

        }


        /* =========================================================
           RADIUS
        ========================================================= */

        function updateRadiusCircle(
            latitude,
            longitude
        ) {

            const radius =
                parseFloat(
                    radiusInput.value
                ) || 100;


            if (radiusCircle) {

                radiusCircle.setLatLng([
                    latitude,
                    longitude
                ]);

                radiusCircle.setRadius(
                    radius
                );

            } else {

                radiusCircle =
                    L.circle(
                        [
                            latitude,
                            longitude
                        ], {

                            radius: radius,

                            color: '#4b49ac',

                            fillColor: '#4b49ac',

                            fillOpacity: 0.12,

                            weight: 2

                        }
                    ).addTo(map);

            }

        }


        /* =========================================================
           RADIUS TEXT
        ========================================================= */

        function updateRadiusText() {

            const radius =
                parseFloat(
                    radiusInput.value
                ) || 100;


            radiusText.textContent =
                'Radius absensi: ' +
                radius +
                ' meter.';


            if (
                marker &&
                radiusCircle
            ) {

                radiusCircle.setRadius(
                    radius
                );

            }

        }


        /* =========================================================
           CLICK MAP
        ========================================================= */

        map.on(
            'click',
            function(event) {

                updateLocation(
                    event.latlng.lat,
                    event.latlng.lng
                );

            }
        );


        /* =========================================================
           CURRENT LOCATION
        ========================================================= */

        currentLocationButton.addEventListener(
            'click',
            function() {

                if (!navigator.geolocation) {

                    alert(
                        'Browser tidak mendukung lokasi perangkat.'
                    );

                    return;

                }


                currentLocationButton.disabled =
                    true;


                currentLocationButton.innerHTML =
                    '<i class="mdi mdi-loading mdi-spin me-1"></i> Mencari...';


                navigator.geolocation.getCurrentPosition(

                    function(position) {

                        updateLocation(
                            position.coords.latitude,
                            position.coords.longitude
                        );


                        currentLocationButton.disabled =
                            false;


                        currentLocationButton.innerHTML =
                            '<i class="mdi mdi-crosshairs-gps me-1"></i> Lokasi Saya';

                    },


                    function() {

                        alert(
                            'Lokasi perangkat tidak dapat diperoleh. Pastikan izin lokasi telah diberikan.'
                        );


                        currentLocationButton.disabled =
                            false;


                        currentLocationButton.innerHTML =
                            '<i class="mdi mdi-crosshairs-gps me-1"></i> Lokasi Saya';

                    },

                    {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    }

                );

            }
        );


        /* =========================================================
           RADIUS CHANGE
        ========================================================= */

        radiusInput.addEventListener(
            'input',
            function() {

                updateRadiusText();

            }
        );


        /* =========================================================
           SEARCH LOCATION
        ========================================================= */

        async function searchLocation() {

            const query =
                searchInput.value.trim();


            if (!query) {

                searchResults.innerHTML = '';

                searchResults.classList.remove(
                    'show'
                );

                return;

            }


            searchResults.innerHTML = `

                <div class="map-search-loading">

                    <i class="mdi mdi-loading mdi-spin me-1"></i>

                    Mencari lokasi...

                </div>

            `;


            searchResults.classList.add(
                'show'
            );


            try {

                const url =
                    'https://nominatim.openstreetmap.org/search?' +
                    new URLSearchParams({

                        q: query,

                        format: 'jsonv2',

                        addressdetails: '1',

                        limit: '5',

                        countrycodes: 'id'

                    });


                const response =
                    await fetch(
                        url, {
                            headers: {
                                'Accept': 'application/json'
                            }
                        }
                    );


                if (!response.ok) {

                    throw new Error(
                        'Gagal mengambil data lokasi.'
                    );

                }


                const results =
                    await response.json();


                if (!results.length) {

                    searchResults.innerHTML = `

                        <div class="map-search-empty">

                            <i class="mdi mdi-map-marker-off-outline"></i>

                            Lokasi tidak ditemukan.

                        </div>

                    `;

                    return;

                }


                searchResults.innerHTML = '';


                results.forEach(
                    function(result) {

                        const item =
                            document.createElement('div');


                        item.className =
                            'map-search-result';


                        item.innerHTML = `

                            <div class="map-search-result-icon">

                                <i class="mdi mdi-map-marker-outline"></i>

                            </div>


                            <div>

                                <div class="map-search-result-title">

                                    ${escapeHtml(
                                        result.name ||
                                        'Lokasi ditemukan'
                                    )}

                                </div>


                                <div class="map-search-result-address">

                                    ${escapeHtml(
                                        result.display_name
                                    )}

                                </div>

                            </div>

                        `;


                        item.addEventListener(
                            'click',
                            function() {

                                const latitude =
                                    parseFloat(
                                        result.lat
                                    );


                                const longitude =
                                    parseFloat(
                                        result.lon
                                    );


                                updateLocation(
                                    latitude,
                                    longitude,
                                    true
                                );


                                const alamatInput =
                                    document.getElementById(
                                        'alamat'
                                    );


                                if (
                                    alamatInput &&
                                    !alamatInput.value.trim()
                                ) {

                                    alamatInput.value =
                                        result.display_name;

                                }


                                searchInput.value =
                                    result.display_name;


                                searchResults.classList.remove(
                                    'show'
                                );

                            }
                        );


                        searchResults.appendChild(
                            item
                        );

                    }
                );

            } catch (error) {

                console.error(error);


                searchResults.innerHTML = `

                    <div class="map-search-empty">

                        <i class="mdi mdi-alert-outline"></i>

                        Gagal mencari lokasi.
                        Silakan coba lagi.

                    </div>

                `;

            }

        }


        /* =========================================================
           ESCAPE HTML
        ========================================================= */

        function escapeHtml(value) {

            const div =
                document.createElement('div');


            div.textContent =
                value || '';


            return div.innerHTML;

        }


        /* =========================================================
           SEARCH BUTTON
        ========================================================= */

        searchButton.addEventListener(
            'click',
            searchLocation
        );


        /* =========================================================
           ENTER
        ========================================================= */

        searchInput.addEventListener(
            'keydown',
            function(event) {

                if (
                    event.key === 'Enter'
                ) {

                    event.preventDefault();

                    searchLocation();

                }

            }
        );


        /* =========================================================
           CLOSE RESULT
        ========================================================= */

        document.addEventListener(
            'click',
            function(event) {

                if (
                    !event.target.closest(
                        '.map-search-box'
                    )
                ) {

                    searchResults.classList.remove(
                        'show'
                    );

                }

            }
        );


        /* =========================================================
           INITIAL LOCATION
        ========================================================= */

        if (hasOldLocation) {

            updateLocation(
                oldLatitude,
                oldLongitude,
                false
            );

        }


        updateRadiusText();


        /* =========================================================
           FIX MAP SIZE
        ========================================================= */

        setTimeout(
            function() {

                map.invalidateSize();

            },
            300
        );

    });
</script>

@endpush

@endsection