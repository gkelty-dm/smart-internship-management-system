@extends('layouts.skydash-admin')

@section('title', 'Tambah Guru Pembimbing')

@section('content')

<style>
    /* =========================================================
       CREATE GURU PEMBIMBING
       STYLE DISESUAIKAN DENGAN CREATE SISWA
    ========================================================= */

    .guru-create-card {
        border: 0;
        border-radius: 14px;
        overflow: hidden;
    }

    .guru-page-header {
        padding: 24px;
        border-bottom: 1px solid #eeeeee;
        background: #ffffff;
    }

    .guru-page-icon {
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

    .guru-page-icon i {
        font-size: 27px;
    }

    .guru-page-title {
        font-size: 20px;
        font-weight: 700;
        color: #343a40;
        margin-bottom: 3px;
    }

    .guru-page-subtitle {
        font-size: 13px;
        color: #6c757d;
        margin-bottom: 0;
    }

    .guru-section {
        border: 1px solid #eeeeee;
        border-radius: 12px;
        margin-bottom: 20px;
        overflow: hidden;
        background: #ffffff;
    }

    .guru-section-header {
        padding: 15px 18px;
        background: #fafaff;
        border-bottom: 1px solid #eeeeee;
        display: flex;
        align-items: center;
    }

    .guru-section-icon {
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

    .guru-section-icon i {
        font-size: 20px;
    }

    .guru-section-title {
        font-size: 14px;
        font-weight: 700;
        color: #343a40;
        margin: 0;
    }

    .guru-section-description {
        font-size: 11px;
        color: #6c757d;
        margin: 2px 0 0;
    }

    .guru-section-body {
        padding: 20px;
    }

    .guru-form .form-group {
        margin-bottom: 18px;
    }

    .guru-form .form-label {
        font-size: 13px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 7px;
    }

    .guru-form .form-control {
        min-height: 44px;
        height: 44px;
        padding: 9px 13px;
        font-size: 13px;
        border-radius: 8px;
        border-color: #e1e1e8;
        background-color: #fff;
    }

    .guru-form .form-control:focus {
        border-color: #4b49ac;
        box-shadow: 0 0 0 .15rem rgba(75, 73, 172, .10);
    }

    .guru-form textarea.form-control {
        height: 105px;
        min-height: 105px;
        resize: vertical;
        line-height: 1.6;
    }

    .guru-input-group .input-group-text {
        min-width: 42px;
        justify-content: center;
        background: #f8f8fb;
        border-color: #e1e1e8;
        color: #6c757d;
    }

    .guru-input-group .form-control {
        border-left: 0;
    }

    .guru-input-group:focus-within .input-group-text {
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

    .role-info {
        padding: 13px 15px;
        border-radius: 10px;
        background: #f8f8ff;
        border: 1px solid #e8e7fb;
        color: #62627a;
        font-size: 11px;
        line-height: 1.6;
    }

    .role-info i {
        color: #4b49ac;
        font-size: 18px;
        flex-shrink: 0;
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

        .guru-page-header {
            padding: 18px;
        }

        .guru-page-icon {
            width: 45px;
            height: 45px;
        }

        .guru-page-icon i {
            font-size: 23px;
        }

        .guru-page-title {
            font-size: 17px;
        }

        .guru-page-subtitle {
            font-size: 11px;
        }

        .guru-page-header .back-button {
            margin-top: 15px;
            width: 100%;
        }

        .guru-section-header {
            padding: 13px 15px;
        }

        .guru-section-body {
            padding: 15px;
        }

        .guru-section-icon {
            width: 34px;
            height: 34px;
        }

        .guru-section-icon i {
            font-size: 17px;
        }

        .guru-section-title {
            font-size: 13px;
        }

        .guru-section-description {
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

    {{-- =========================================================
         HEADER
    ========================================================== --}}
    <div class="col-12 grid-margin">

        <div class="card shadow-sm guru-create-card">

            <div class="guru-page-header">

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <div class="d-flex align-items-center">

                            <div class="guru-page-icon me-3">

                                <i class="mdi mdi-account-tie-outline"></i>

                            </div>


                            <div>

                                <h3 class="guru-page-title">
                                    Tambah Guru Pembimbing
                                </h3>

                                <p class="guru-page-subtitle">
                                    Tambahkan akun dan data guru pembimbing
                                    baru ke dalam sistem SIMPKL.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-4 text-md-end">

                        <a
                            href="{{ route('admin.guru-pembimbing.index') }}"
                            class="btn btn-light back-button shadow-sm">

                            <i class="mdi mdi-arrow-left me-1"></i>

                            Kembali ke Data Guru

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         VALIDATION ERROR
    ========================================================== --}}
    @if($errors->any())

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
                        style="font-size: 11px;">

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

    @endif


    {{-- =========================================================
         FORM
    ========================================================== --}}
    <div class="col-12 grid-margin stretch-card">

        <div class="card shadow-sm guru-create-card">

            <div class="card-body p-4 guru-form">

                <form
                    action="{{ route('admin.guru-pembimbing.store') }}"
                    method="POST"
                    autocomplete="off">

                    @csrf


                    {{-- =================================================
                         INFORMASI AKUN
                    ================================================== --}}
                    <div class="guru-section">

                        <div class="guru-section-header">

                            <div class="guru-section-icon">

                                <i class="mdi mdi-account-circle-outline"></i>

                            </div>


                            <div>

                                <h5 class="guru-section-title">
                                    Informasi Akun
                                </h5>

                                <p class="guru-section-description">
                                    Data yang digunakan guru untuk masuk
                                    ke sistem.
                                </p>

                            </div>

                        </div>


                        <div class="guru-section-body">

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


                                        <div class="input-group guru-input-group">

                                            <span class="input-group-text">

                                                <i class="mdi mdi-account-outline"></i>

                                            </span>


                                            <input
                                                type="text"
                                                name="name"
                                                id="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name') }}"
                                                placeholder="Contoh: Budi Santoso"
                                                maxlength="255"
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


                                        <div class="input-group guru-input-group">

                                            <span class="input-group-text">

                                                <i class="mdi mdi-email-outline"></i>

                                            </span>


                                            <input
                                                type="email"
                                                name="email"
                                                id="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email') }}"
                                                placeholder="guru@sekolah.com"
                                                maxlength="255"
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


                                        <div class="input-group guru-input-group">

                                            <span class="input-group-text">

                                                <i class="mdi mdi-lock-outline"></i>

                                            </span>


                                            <input
                                                type="password"
                                                name="password"
                                                id="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Minimal 6 karakter"
                                                minlength="6"
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


                                        <div class="input-group guru-input-group">

                                            <span class="input-group-text">

                                                <i class="mdi mdi-lock-check-outline"></i>

                                            </span>


                                            <input
                                                type="password"
                                                name="password_confirmation"
                                                id="password_confirmation"
                                                class="form-control"
                                                placeholder="Ulangi password"
                                                minlength="6"
                                                required>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         DATA GURU
                    ================================================== --}}
                    <div class="guru-section">

                        <div class="guru-section-header">

                            <div class="guru-section-icon">

                                <i class="mdi mdi-teach"></i>

                            </div>


                            <div>

                                <h5 class="guru-section-title">
                                    Data Guru Pembimbing
                                </h5>

                                <p class="guru-section-description">
                                    Informasi identitas dan kontak guru.
                                </p>

                            </div>

                        </div>


                        <div class="guru-section-body">

                            <div class="row">

                                {{-- NIP --}}
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label
                                            for="nip"
                                            class="form-label">

                                            NIP
                                            <span class="required-mark">*</span>

                                        </label>


                                        <div class="input-group guru-input-group">

                                            <span class="input-group-text">

                                                <i class="mdi mdi-card-account-details-outline"></i>

                                            </span>


                                            <input
                                                type="text"
                                                name="nip"
                                                id="nip"
                                                class="form-control @error('nip') is-invalid @enderror"
                                                value="{{ old('nip') }}"
                                                placeholder="Masukkan NIP"
                                                maxlength="50"
                                                required>

                                        </div>


                                        @error('nip')

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


                                        <div class="input-group guru-input-group">

                                            <span class="input-group-text">

                                                <i class="mdi mdi-phone-outline"></i>

                                            </span>


                                            <input
                                                type="text"
                                                name="no_hp"
                                                id="no_hp"
                                                class="form-control @error('no_hp') is-invalid @enderror"
                                                value="{{ old('no_hp') }}"
                                                placeholder="Contoh: 081234567890"
                                                maxlength="20">

                                        </div>


                                        @error('no_hp')

                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>

                                        @enderror

                                    </div>

                                </div>


                                {{-- ALAMAT --}}
                                <div class="col-12">

                                    <div class="form-group mb-0">

                                        <label
                                            for="alamat"
                                            class="form-label">

                                            Alamat

                                        </label>


                                        <div class="input-group guru-input-group">

                                            <span
                                                class="input-group-text align-items-start pt-3">

                                                <i class="mdi mdi-map-marker-outline"></i>

                                            </span>


                                            <textarea
                                                name="alamat"
                                                id="alamat"
                                                rows="4"
                                                class="form-control @error('alamat') is-invalid @enderror"
                                                placeholder="Masukkan alamat lengkap guru">{{ old('alamat') }}</textarea>

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
                         INFORMASI ROLE
                    ================================================== --}}
                    <div class="role-info mb-4">

                        <div class="d-flex align-items-start">

                            <i class="mdi mdi-information-outline me-2"></i>


                            <div>

                                <strong class="text-dark">
                                    Informasi Akun
                                </strong>

                                <div>

                                    Akun yang dibuat akan otomatis memiliki
                                    role <strong>Guru</strong> dan dapat
                                    digunakan untuk masuk sebagai guru
                                    pembimbing.

                                </div>

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
                                href="{{ route('admin.guru-pembimbing.index') }}"
                                class="btn btn-light">

                                <i class="mdi mdi-close me-1"></i>

                                Batal

                            </a>


                            <button
                                type="submit"
                                class="btn btn-primary">

                                <i class="mdi mdi-content-save-outline me-1"></i>

                                Simpan Guru

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection