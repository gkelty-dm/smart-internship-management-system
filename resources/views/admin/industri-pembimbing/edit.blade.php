@extends('layouts.skydash-admin')

@section('title', 'Edit Pembimbing Industri')

@section('content')

<style>
    .page-card {
        border: 0;
        border-radius: 12px;
        box-shadow: 0 3px 15px rgba(0, 0, 0, 0.04);
    }

    .page-header {
        padding: 22px 24px;
        border-bottom: 1px solid #eeeeee;
    }

    .page-header-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        background: rgba(75, 73, 172, 0.10);
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .page-header-icon i {
        font-size: 24px;
    }

    .page-title {
        font-size: 18px;
        font-weight: 700;
        color: #343a40;
        margin-bottom: 3px;
    }

    .page-subtitle {
        font-size: 11px;
        color: #8a8a95;
        margin: 0;
    }

    .page-header .btn {
        font-size: 11px;
        border-radius: 7px;
        padding: 8px 14px;
    }

    .form-card {
        border: 0;
        border-radius: 12px;
        box-shadow: 0 3px 15px rgba(0, 0, 0, 0.04);
    }

    .form-card-body {
        padding: 24px;
    }

    .section-title-wrapper {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .section-icon {
        width: 38px;
        height: 38px;
        border-radius: 9px;
        background: rgba(75, 73, 172, 0.10);
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
        margin: 0 0 2px;
    }

    .section-subtitle {
        font-size: 10px;
        color: #8a8a95;
        margin: 0;
    }

    .form-section {
        padding-bottom: 22px;
        margin-bottom: 22px;
        border-bottom: 1px solid #eeeeee;
    }

    .form-section:last-child {
        border-bottom: 0;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .form-label-custom {
        display: block;
        font-size: 11px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 7px;
    }

    .required {
        color: #dc3545;
    }

    .form-control,
    .form-select {
        min-height: 42px;
        border: 1px solid #e2e2e8;
        border-radius: 7px;
        font-size: 11px;
        color: #495057;
        padding: 9px 12px;
        box-shadow: none !important;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #4b49ac;
    }

    .form-control::placeholder {
        color: #b5b5be;
    }

    .invalid-feedback {
        font-size: 10px;
    }

    .form-control.is-invalid,
    .form-select.is-invalid {
        border-color: #dc3545;
    }

    .alert-danger {
        border: 0;
        border-radius: 9px;
        font-size: 11px;
    }

    .alert-danger .alert-title {
        font-weight: 700;
        font-size: 12px;
    }

    .alert-danger ul {
        font-size: 10px;
    }

    .form-footer {
        padding-top: 20px;
        margin-top: 22px;
        border-top: 1px solid #eeeeee;
    }

    .form-footer .btn {
        min-height: 40px;
        border-radius: 7px;
        font-size: 11px;
        padding: 8px 17px;
    }

    .btn-primary {
        background-color: #4b49ac;
        border-color: #4b49ac;
    }

    .btn-primary:hover,
    .btn-primary:focus {
        background-color: #3f3d91;
        border-color: #3f3d91;
    }

    .company-select-wrapper {
        position: relative;
    }

    .company-select-wrapper .form-select {
        padding-right: 35px;
    }

    @media (max-width: 767.98px) {

        .page-header {
            padding: 18px;
        }

        .page-header-actions {
            width: 100%;
            margin-top: 15px;
        }

        .page-header-actions .btn {
            width: 100%;
        }

        .form-card-body {
            padding: 18px;
        }

        .form-footer .btn {
            width: 100%;
            margin: 0 0 8px !important;
        }

        .form-footer .btn:last-child {
            margin-bottom: 0 !important;
        }
    }
</style>


<div class="row">

    {{-- =========================================================
         HEADER
    ========================================================= --}}

    <div class="col-12 grid-margin">

        <div class="card page-card">

            <div class="page-header">

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <div class="d-flex align-items-center">

                            <div class="page-header-icon me-3">

                                <i class="mdi mdi-account-edit-outline"></i>

                            </div>

                            <div>

                                <h4 class="page-title">
                                    Edit Pembimbing Industri
                                </h4>

                                <p class="page-subtitle">
                                    Perbarui informasi akun dan data pembimbing industri.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="d-flex justify-content-md-end page-header-actions">

                            <a
                                href="{{ route('admin.industri-pembimbing.index') }}"
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


    {{-- =========================================================
         VALIDATION ERROR
    ========================================================= --}}

    @if($errors->any())

    <div class="col-12">

        <div class="alert alert-danger alert-dismissible fade show">

            <div class="d-flex">

                <i
                    class="mdi mdi-alert-circle-outline me-2"
                    style="font-size:20px;">
                </i>

                <div class="flex-grow-1">

                    <div class="alert-title mb-1">
                        Terdapat kesalahan pada data
                    </div>

                    <ul class="mb-0 ps-3">

                        @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                        @endforeach

                    </ul>

                </div>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
                </button>

            </div>

        </div>

    </div>

    @endif


    {{-- =========================================================
         FORM
    ========================================================= --}}

    <div class="col-12 grid-margin">

        <div class="card form-card">

            <div class="form-card-body">

                <form
                    action="{{ route('admin.industri-pembimbing.update', $industri->id) }}"
                    method="POST">

                    @csrf

                    @method('PUT')


                    {{-- =================================================
                         INFORMASI AKUN
                    ================================================== --}}

                    <div class="form-section">

                        <div class="section-title-wrapper">

                            <div class="section-icon">

                                <i class="mdi mdi-account-circle-outline"></i>

                            </div>

                            <div>

                                <h5 class="section-title">
                                    Informasi Akun
                                </h5>

                                <p class="section-subtitle">
                                    Perbarui data akun pembimbing industri.
                                </p>

                            </div>

                        </div>


                        <div class="row">

                            {{-- NAMA --}}

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label
                                        for="name"
                                        class="form-label-custom">

                                        Nama Lengkap

                                        <span class="required">
                                            *
                                        </span>

                                    </label>


                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $industri->user->name ?? '') }}"
                                        placeholder="Masukkan nama lengkap"
                                        maxlength="255"
                                        required>


                                    @error('name')

                                    <div class="invalid-feedback">
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
                                        class="form-label-custom">

                                        Email

                                        <span class="required">
                                            *
                                        </span>

                                    </label>


                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $industri->user->email ?? '') }}"
                                        placeholder="Masukkan alamat email"
                                        maxlength="255"
                                        required>


                                    @error('email')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                    @enderror

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         DATA PEMBIMBING INDUSTRI
                    ================================================== --}}

                    <div class="form-section">

                        <div class="section-title-wrapper">

                            <div class="section-icon">

                                <i class="mdi mdi-office-building-outline"></i>

                            </div>

                            <div>

                                <h5 class="section-title">
                                    Data Pembimbing Industri
                                </h5>

                                <p class="section-subtitle">
                                    Perbarui perusahaan dan informasi pekerjaan pembimbing.
                                </p>

                            </div>

                        </div>


                        {{-- PERUSAHAAN --}}

                        <div class="form-group">

                            <label
                                for="perusahaan_id"
                                class="form-label-custom">

                                Perusahaan / DUDI

                                <span class="required">
                                    *
                                </span>

                            </label>


                            <div class="company-select-wrapper">

                                <select
                                    name="perusahaan_id"
                                    id="perusahaan_id"
                                    class="form-select @error('perusahaan_id') is-invalid @enderror"
                                    required>

                                    <option value="">
                                        -- Pilih Perusahaan / DUDI --
                                    </option>

                                    @foreach($perusahaans as $perusahaan)

                                    <option
                                        value="{{ $perusahaan->id }}"
                                        {{ old('perusahaan_id', $industri->perusahaan_id) == $perusahaan->id ? 'selected' : '' }}>

                                        {{ $perusahaan->nama_perusahaan }}

                                    </option>

                                    @endforeach

                                </select>

                            </div>


                            @error('perusahaan_id')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>


                        <div class="row">

                            {{-- JABATAN --}}

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label
                                        for="jabatan"
                                        class="form-label-custom">

                                        Jabatan

                                        <span class="required">
                                            *
                                        </span>

                                    </label>


                                    <input
                                        type="text"
                                        name="jabatan"
                                        id="jabatan"
                                        class="form-control @error('jabatan') is-invalid @enderror"
                                        value="{{ old('jabatan', $industri->jabatan) }}"
                                        placeholder="Contoh: Supervisor"
                                        maxlength="255"
                                        required>


                                    @error('jabatan')

                                    <div class="invalid-feedback">
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
                                        class="form-label-custom">

                                        No. HP

                                    </label>


                                    <input
                                        type="text"
                                        name="no_hp"
                                        id="no_hp"
                                        class="form-control @error('no_hp') is-invalid @enderror"
                                        value="{{ old('no_hp', $industri->no_hp) }}"
                                        placeholder="Contoh: 081234567890"
                                        maxlength="30">


                                    @error('no_hp')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                    @enderror

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         BUTTON
                    ================================================== --}}

                    <div class="form-footer">

                        <div class="d-flex justify-content-end flex-wrap">

                            <a
                                href="{{ route('admin.industri-pembimbing.index') }}"
                                class="btn btn-light me-2">

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

@endsection