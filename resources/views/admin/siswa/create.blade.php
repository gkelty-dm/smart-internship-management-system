@extends('layouts.skydash-admin')

@section('title', 'Tambah Siswa')

@section('content')

<style>
    /* =========================================================
       CREATE SISWA
    ========================================================= */

    .siswa-create-card {
        border: 0;
        border-radius: 14px;
        overflow: hidden;
    }

    .siswa-page-header {
        padding: 24px;
        border-bottom: 1px solid #eeeeee;
        background: #ffffff;
    }

    .siswa-page-icon {
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

    .siswa-page-icon i {
        font-size: 27px;
    }

    .siswa-page-title {
        font-size: 20px;
        font-weight: 700;
        color: #343a40;
        margin-bottom: 3px;
    }

    .siswa-page-subtitle {
        font-size: 13px;
        color: #6c757d;
        margin-bottom: 0;
    }

    .siswa-section {
        border: 1px solid #eeeeee;
        border-radius: 12px;
        margin-bottom: 20px;
        overflow: hidden;
        background: #ffffff;
    }

    .siswa-section-header {
        padding: 15px 18px;
        background: #fafaff;
        border-bottom: 1px solid #eeeeee;
        display: flex;
        align-items: center;
    }

    .siswa-section-icon {
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

    .siswa-section-icon i {
        font-size: 20px;
    }

    .siswa-section-title {
        font-size: 14px;
        font-weight: 700;
        color: #343a40;
        margin: 0;
    }

    .siswa-section-description {
        font-size: 11px;
        color: #6c757d;
        margin: 2px 0 0;
    }

    .siswa-section-body {
        padding: 20px;
    }

    .siswa-form .form-group {
        margin-bottom: 18px;
    }

    .siswa-form .form-label {
        font-size: 13px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 7px;
    }

    .siswa-form .form-control,
    .siswa-form .form-select {
        min-height: 44px;
        height: 44px;
        padding: 9px 13px;
        font-size: 13px;
        border-radius: 8px;
        border-color: #e1e1e8;
        background-color: #fff;
    }

    .siswa-form .form-control:focus,
    .siswa-form .form-select:focus {
        border-color: #4b49ac;
        box-shadow: 0 0 0 .15rem rgba(75, 73, 172, .10);
    }

    .siswa-form textarea.form-control {
        height: 105px;
        min-height: 105px;
        resize: vertical;
        line-height: 1.6;
    }

    .siswa-input-group .input-group-text {
        min-width: 42px;
        justify-content: center;
        background: #f8f8fb;
        border-color: #e1e1e8;
        color: #6c757d;
    }

    .siswa-input-group .form-control {
        border-left: 0;
    }

    .siswa-input-group .form-control:focus {
        border-left: 0;
    }

    .siswa-input-group:focus-within .input-group-text {
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

    .academic-help {
        padding: 11px 13px;
        border-radius: 9px;
        background: #f8f8ff;
        border: 1px solid #e8e7fb;
        color: #62627a;
        font-size: 11px;
        line-height: 1.6;
        margin-top: 4px;
    }

    .academic-help i {
        color: #4b49ac;
        font-size: 16px;
        margin-right: 5px;
    }

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

    @media (max-width: 767.98px) {

        .siswa-page-header {
            padding: 18px;
        }

        .siswa-page-icon {
            width: 45px;
            height: 45px;
        }

        .siswa-page-icon i {
            font-size: 23px;
        }

        .siswa-page-title {
            font-size: 17px;
        }

        .siswa-page-subtitle {
            font-size: 11px;
        }

        .siswa-page-header .back-button {
            margin-top: 15px;
            width: 100%;
        }

        .siswa-section-header {
            padding: 13px 15px;
        }

        .siswa-section-body {
            padding: 15px;
        }

        .siswa-section-icon {
            width: 34px;
            height: 34px;
        }

        .siswa-section-icon i {
            font-size: 17px;
        }

        .siswa-section-title {
            font-size: 13px;
        }

        .siswa-section-description {
            font-size: 10px;
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


<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card shadow-sm siswa-create-card">

            {{-- =================================================
                 HEADER
            ================================================== --}}
            <div class="siswa-page-header">

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <div class="d-flex align-items-center">

                            <div class="siswa-page-icon me-3">

                                <i class="mdi mdi-account-plus-outline"></i>

                            </div>

                            <div>

                                <h3 class="siswa-page-title">
                                    Tambah Siswa
                                </h3>

                                <p class="siswa-page-subtitle">
                                    Tambahkan data siswa baru ke dalam sistem
                                    SIMPKL.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-4 text-md-end">

                        <a
                            href="{{ route('admin.siswa.index') }}"
                            class="btn btn-light back-button shadow-sm">

                            <i class="mdi mdi-arrow-left me-1"></i>

                            Kembali ke Data Siswa

                        </a>

                    </div>

                </div>

            </div>


            <div class="card-body p-4 siswa-form">


                {{-- =================================================
                     ERROR VALIDATION
                ================================================== --}}
                @if($errors->any())

                <div class="error-card mb-4">

                    <div class="d-flex align-items-start">

                        <div class="error-card-icon me-3">

                            <i class="mdi mdi-alert-outline"></i>

                        </div>


                        <div>

                            <div class="error-card-title">

                                Terdapat kesalahan pada data

                            </div>


                            <div class="text-muted mb-2" style="font-size: 11px;">

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

                @endif


                <form
                    action="{{ route('admin.siswa.store') }}"
                    method="POST"
                    autocomplete="off">

                    @csrf


                    {{-- =================================================
                         INFORMASI AKUN
                    ================================================== --}}
                    <div class="siswa-section">

                        <div class="siswa-section-header">

                            <div class="siswa-section-icon">

                                <i class="mdi mdi-account-circle-outline"></i>

                            </div>

                            <div>

                                <h5 class="siswa-section-title">
                                    Informasi Akun
                                </h5>

                                <p class="siswa-section-description">
                                    Informasi akun yang digunakan siswa untuk
                                    masuk ke sistem.
                                </p>

                            </div>

                        </div>


                        <div class="siswa-section-body">

                            <div class="row">

                                {{-- NAMA --}}
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label
                                            for="name"
                                            class="form-label">

                                            Nama Lengkap
                                            <span class="required-mark">*</span>

                                        </label>


                                        <div class="input-group siswa-input-group">

                                            <span class="input-group-text">

                                                <i class="mdi mdi-account-outline"></i>

                                            </span>


                                            <input
                                                type="text"
                                                name="name"
                                                id="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name') }}"
                                                placeholder="Masukkan nama lengkap"
                                                autocomplete="off"
                                                required>

                                        </div>


                                        @error('name')

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
                                            <span class="required-mark">*</span>

                                        </label>


                                        <div class="input-group siswa-input-group">

                                            <span class="input-group-text">

                                                <i class="mdi mdi-email-outline"></i>

                                            </span>


                                            <input
                                                type="email"
                                                name="email"
                                                id="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email') }}"
                                                placeholder="contoh@email.com"
                                                autocomplete="new-password"
                                                required>

                                        </div>


                                        @error('email')

                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>

                                        @enderror

                                    </div>

                                </div>


                                {{-- PASSWORD --}}
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label
                                            for="password"
                                            class="form-label">

                                            Password
                                            <span class="required-mark">*</span>

                                        </label>


                                        <div class="input-group siswa-input-group">

                                            <span class="input-group-text">

                                                <i class="mdi mdi-lock-outline"></i>

                                            </span>


                                            <input
                                                type="password"
                                                name="password"
                                                id="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Masukkan password"
                                                autocomplete="new-password"
                                                required>

                                        </div>


                                        @error('password')

                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>

                                        @enderror

                                    </div>

                                </div>


                                {{-- KONFIRMASI --}}
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label
                                            for="password_confirmation"
                                            class="form-label">

                                            Konfirmasi Password
                                            <span class="required-mark">*</span>

                                        </label>


                                        <div class="input-group siswa-input-group">

                                            <span class="input-group-text">

                                                <i class="mdi mdi-lock-check-outline"></i>

                                            </span>


                                            <input
                                                type="password"
                                                name="password_confirmation"
                                                id="password_confirmation"
                                                class="form-control"
                                                placeholder="Ulangi password"
                                                autocomplete="new-password"
                                                required>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         IDENTITAS SISWA
                    ================================================== --}}
                    <div class="siswa-section">

                        <div class="siswa-section-header">

                            <div class="siswa-section-icon">

                                <i class="mdi mdi-card-account-details-outline"></i>

                            </div>

                            <div>

                                <h5 class="siswa-section-title">
                                    Identitas Siswa
                                </h5>

                                <p class="siswa-section-description">
                                    Informasi identitas utama siswa.
                                </p>

                            </div>

                        </div>


                        <div class="siswa-section-body">

                            <div class="row">

                                {{-- NISN --}}
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label
                                            for="nisn"
                                            class="form-label">

                                            NISN
                                            <span class="required-mark">*</span>

                                        </label>


                                        <div class="input-group siswa-input-group">

                                            <span class="input-group-text">

                                                <i class="mdi mdi-card-account-details-outline"></i>

                                            </span>


                                            <input
                                                type="text"
                                                name="nisn"
                                                id="nisn"
                                                class="form-control @error('nisn') is-invalid @enderror"
                                                value="{{ old('nisn') }}"
                                                placeholder="Masukkan NISN"
                                                autocomplete="off"
                                                required>

                                        </div>


                                        @error('nisn')

                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>

                                        @enderror

                                    </div>

                                </div>


                                {{-- JENIS KELAMIN --}}
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label
                                            for="jenis_kelamin"
                                            class="form-label">

                                            Jenis Kelamin
                                            <span class="required-mark">*</span>

                                        </label>


                                        <div class="input-group siswa-input-group">

                                            <span class="input-group-text">

                                                <i class="mdi mdi-gender-male-female"></i>

                                            </span>


                                            <select
                                                name="jenis_kelamin"
                                                id="jenis_kelamin"
                                                class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                                required>

                                                <option value="">
                                                    -- Pilih Jenis Kelamin --
                                                </option>

                                                <option
                                                    value="L"
                                                    {{ old('jenis_kelamin') === 'L' ? 'selected' : '' }}>

                                                    Laki-laki

                                                </option>

                                                <option
                                                    value="P"
                                                    {{ old('jenis_kelamin') === 'P' ? 'selected' : '' }}>

                                                    Perempuan

                                                </option>

                                            </select>

                                        </div>


                                        @error('jenis_kelamin')

                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>

                                        @enderror

                                    </div>

                                </div>


                                {{-- NO HP --}}
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label
                                            for="no_hp"
                                            class="form-label">

                                            No. HP

                                        </label>


                                        <div class="input-group siswa-input-group">

                                            <span class="input-group-text">

                                                <i class="mdi mdi-phone-outline"></i>

                                            </span>


                                            <input
                                                type="text"
                                                name="no_hp"
                                                id="no_hp"
                                                class="form-control @error('no_hp') is-invalid @enderror"
                                                value="{{ old('no_hp') }}"
                                                placeholder="08xxxxxxxxxx"
                                                autocomplete="off">

                                        </div>


                                        @error('no_hp')

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
                         DATA KELAHIRAN
                    ================================================== --}}
                    <div class="siswa-section">

                        <div class="siswa-section-header">

                            <div class="siswa-section-icon">

                                <i class="mdi mdi-calendar-account-outline"></i>

                            </div>

                            <div>

                                <h5 class="siswa-section-title">
                                    Data Kelahiran
                                </h5>

                                <p class="siswa-section-description">
                                    Informasi tempat dan tanggal lahir siswa.
                                </p>

                            </div>

                        </div>


                        <div class="siswa-section-body">

                            <div class="row">

                                {{-- TEMPAT LAHIR --}}
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label
                                            for="tempat_lahir"
                                            class="form-label">

                                            Tempat Lahir

                                        </label>


                                        <div class="input-group siswa-input-group">

                                            <span class="input-group-text">

                                                <i class="mdi mdi-map-marker-outline"></i>

                                            </span>


                                            <input
                                                type="text"
                                                name="tempat_lahir"
                                                id="tempat_lahir"
                                                class="form-control @error('tempat_lahir') is-invalid @enderror"
                                                value="{{ old('tempat_lahir') }}"
                                                placeholder="Masukkan tempat lahir"
                                                autocomplete="off">

                                        </div>


                                        @error('tempat_lahir')

                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>

                                        @enderror

                                    </div>

                                </div>


                                {{-- TANGGAL LAHIR --}}
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label
                                            for="tanggal_lahir"
                                            class="form-label">

                                            Tanggal Lahir

                                        </label>


                                        <div class="input-group siswa-input-group">

                                            <span class="input-group-text">

                                                <i class="mdi mdi-calendar-outline"></i>

                                            </span>


                                            <input
                                                type="date"
                                                name="tanggal_lahir"
                                                id="tanggal_lahir"
                                                class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                value="{{ old('tanggal_lahir') }}"
                                                autocomplete="off">

                                        </div>


                                        @error('tanggal_lahir')

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
                         DATA AKADEMIK
                    ================================================== --}}
                    <div class="siswa-section">

                        <div class="siswa-section-header">

                            <div class="siswa-section-icon">

                                <i class="mdi mdi-school-outline"></i>

                            </div>

                            <div>

                                <h5 class="siswa-section-title">
                                    Data Akademik
                                </h5>

                                <p class="siswa-section-description">
                                    Tentukan jurusan dan kelas siswa.
                                </p>

                            </div>

                        </div>


                        <div class="siswa-section-body">

                            <div class="row">

                                {{-- JURUSAN --}}
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label
                                            for="jurusan_id"
                                            class="form-label">

                                            Jurusan
                                            <span class="required-mark">*</span>

                                        </label>


                                        <div class="input-group siswa-input-group">

                                            <span class="input-group-text">

                                                <i class="mdi mdi-school-outline"></i>

                                            </span>


                                            <select
                                                name="jurusan_id"
                                                id="jurusan_id"
                                                class="form-select @error('jurusan_id') is-invalid @enderror"
                                                data-kelas-url="{{ url('/admin/siswa/kelas') }}"
                                                data-old-jurusan="{{ old('jurusan_id') }}"
                                                required>

                                                <option value="">
                                                    -- Pilih Jurusan --
                                                </option>


                                                @foreach($jurusans as $jurusan)

                                                <option
                                                    value="{{ $jurusan->id }}"
                                                    {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>

                                                    {{ $jurusan->nama_jurusan }}

                                                </option>

                                                @endforeach

                                            </select>

                                        </div>


                                        @error('jurusan_id')

                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>

                                        @enderror

                                    </div>

                                </div>


                                {{-- KELAS --}}
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label
                                            for="kelas_id"
                                            class="form-label">

                                            Kelas
                                            <span class="required-mark">*</span>

                                        </label>


                                        <div class="input-group siswa-input-group">

                                            <span class="input-group-text">

                                                <i class="mdi mdi-google-classroom"></i>

                                            </span>


                                            <select
                                                name="kelas_id"
                                                id="kelas_id"
                                                class="form-select @error('kelas_id') is-invalid @enderror"
                                                required
                                                disabled>

                                                <option value="">
                                                    -- Pilih Jurusan Terlebih Dahulu --
                                                </option>

                                            </select>

                                        </div>


                                        @error('kelas_id')

                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>

                                        @enderror

                                    </div>

                                </div>

                            </div>


                            <div class="academic-help">

                                <i class="mdi mdi-information-outline"></i>

                                Pilih <strong>Jurusan</strong> terlebih dahulu.
                                Sistem akan menampilkan kelas yang sesuai
                                secara otomatis.

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         ALAMAT
                    ================================================== --}}
                    <div class="siswa-section">

                        <div class="siswa-section-header">

                            <div class="siswa-section-icon">

                                <i class="mdi mdi-map-marker-outline"></i>

                            </div>

                            <div>

                                <h5 class="siswa-section-title">
                                    Alamat
                                </h5>

                                <p class="siswa-section-description">
                                    Masukkan alamat lengkap tempat tinggal siswa.
                                </p>

                            </div>

                        </div>


                        <div class="siswa-section-body">

                            <div class="form-group mb-0">

                                <label
                                    for="alamat"
                                    class="form-label">

                                    Alamat Lengkap

                                </label>


                                <textarea
                                    name="alamat"
                                    id="alamat"
                                    class="form-control @error('alamat') is-invalid @enderror"
                                    placeholder="Masukkan alamat lengkap siswa"
                                    autocomplete="off">{{ old('alamat') }}</textarea>


                                @error('alamat')

                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>

                                @enderror


                                <small class="field-hint">

                                    <i class="mdi mdi-information-outline me-1"></i>

                                    Isi alamat secara lengkap untuk memudahkan
                                    identifikasi data siswa.

                                </small>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         FOOTER ACTION
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
                                href="{{ route('admin.siswa.index') }}"
                                class="btn btn-light">

                                <i class="mdi mdi-close me-1"></i>

                                Batal

                            </a>


                            <button
                                type="submit"
                                class="btn btn-primary">

                                <i class="mdi mdi-content-save-outline me-1"></i>

                                Simpan Siswa

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection


@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const jurusanSelect =
            document.getElementById('jurusan_id');

        const kelasSelect =
            document.getElementById('kelas_id');

        const kelasUrl =
            jurusanSelect.dataset.kelasUrl;


        function loadKelas(jurusanId, selectedKelas = null) {

            kelasSelect.innerHTML = '';

            if (!jurusanId) {

                kelasSelect.disabled = true;

                kelasSelect.innerHTML =
                    '<option value="">-- Pilih Jurusan Terlebih Dahulu --</option>';

                return;
            }


            kelasSelect.disabled = true;

            kelasSelect.innerHTML =
                '<option value="">Memuat kelas...</option>';


            fetch(kelasUrl + '/' + jurusanId)

                .then(function(response) {

                    if (!response.ok) {

                        throw new Error(
                            'Gagal mengambil data kelas.'
                        );

                    }

                    return response.json();

                })

                .then(function(data) {

                    kelasSelect.innerHTML = '';


                    if (!Array.isArray(data) || data.length === 0) {

                        kelasSelect.disabled = true;

                        kelasSelect.innerHTML =
                            '<option value="">-- Belum Ada Kelas --</option>';

                        return;
                    }


                    kelasSelect.disabled = false;

                    kelasSelect.innerHTML =
                        '<option value="">-- Pilih Kelas --</option>';


                    data.forEach(function(kelas) {

                        const option =
                            document.createElement('option');

                        option.value =
                            kelas.id;

                        option.textContent =
                            kelas.nama_kelas;


                        if (
                            selectedKelas &&
                            String(selectedKelas) === String(kelas.id)
                        ) {

                            option.selected = true;

                        }


                        kelasSelect.appendChild(option);

                    });

                })

                .catch(function(error) {

                    console.error(error);

                    kelasSelect.disabled = true;

                    kelasSelect.innerHTML =
                        '<option value="">-- Gagal Memuat Kelas --</option>';

                });

        }


        jurusanSelect.addEventListener(
            'change',
            function() {

                loadKelas(this.value);

            }
        );


        const oldJurusan =
            jurusanSelect.dataset.oldJurusan;

        const oldKelas =
            "{{ old('kelas_id') }}";


        if (oldJurusan) {

            loadKelas(
                oldJurusan,
                oldKelas
            );

        }

    });
</script>

@endpush