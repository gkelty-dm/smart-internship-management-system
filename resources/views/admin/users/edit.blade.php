@extends('layouts.skydash-admin')

@section('title', 'Edit User')

@section('content')

<style>
    .user-header-card {
        border: 0;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 3px 16px rgba(0, 0, 0, .035);
    }

    .user-header {
        padding: 20px 22px;
    }

    .header-icon {
        width: 46px;
        height: 46px;
        border-radius: 9px;
        background: rgba(75, 73, 172, .10);
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .header-icon i {
        font-size: 23px;
    }

    .page-title {
        font-size: 18px;
        font-weight: 600;
        color: #343a40;
        margin: 0 0 3px;
    }

    .page-subtitle {
        font-size: 10px;
        color: #9999a4;
        margin: 0;
    }

    .back-btn {
        height: 38px;
        border-radius: 7px;
        font-size: 9px;
        padding: 8px 14px;
    }

    .form-card {
        border: 0;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 3px 16px rgba(0, 0, 0, .035);
    }

    .form-card .card-body {
        padding: 25px;
    }

    .section-heading {
        display: flex;
        align-items: center;
        margin-bottom: 25px;
    }

    .section-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background: rgba(75, 73, 172, .09);
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
        font-weight: 600;
        color: #343a40;
        margin: 0 0 2px;
    }

    .section-description {
        font-size: 9px;
        color: #9999a4;
        margin: 0;
    }

    .field-group {
        margin-bottom: 19px;
    }

    .field-label {
        display: block;
        font-size: 9px;
        font-weight: 600;
        color: #555;
        margin-bottom: 7px;
    }

    .required {
        color: #dc3545;
    }

    .field-wrapper {
        position: relative;
    }

    .field-icon {
        position: absolute;
        left: 14px;
        top: 13px;
        color: #aaaab4;
        font-size: 15px;
        z-index: 2;
    }

    .field-control {
        height: 43px;
        border: 1px solid #e2e2e8;
        border-radius: 7px;
        font-size: 9px;
        color: #495057;
        background: #fff;
        padding-left: 39px;
        box-shadow: none !important;
    }

    .field-control:focus {
        border-color: #4b49ac;
        background: #fff;
    }

    .field-control.is-invalid {
        border-color: #dc3545;
    }

    .readonly-control {
        background: #f8f8fa !important;
        color: #777 !important;
        cursor: not-allowed;
    }

    .readonly-note {
        display: block;
        font-size: 8px;
        color: #9999a4;
        margin-top: 6px;
    }

    .invalid-feedback {
        font-size: 8px;
        margin-top: 5px;
    }

    .status-box {
        background: #fafaff;
        border: 1px solid #eeeeF2;
        border-radius: 8px;
        padding: 15px;
        height: 43px;
        display: flex;
        align-items: center;
    }

    .status-option {
        display: inline-flex;
        align-items: center;
        margin-right: 25px;
    }

    .status-option input {
        margin-right: 7px;
    }

    .status-option label {
        font-size: 9px;
        color: #666;
        margin: 0;
        cursor: pointer;
    }

    .form-actions {
        border-top: 1px solid #eeeeF2;
        margin-top: 25px;
        padding-top: 19px;
        display: flex;
        justify-content: flex-end;
        gap: 8px;
    }

    .action-btn {
        height: 40px;
        border-radius: 7px;
        font-size: 9px;
        padding: 8px 17px;
    }

    .alert-custom {
        border: 0;
        border-radius: 8px;
        font-size: 9px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .025);
    }

    .alert-custom li {
        font-size: 8px;
        margin-bottom: 2px;
    }

    .user-id {
        display: inline-flex;
        align-items: center;
        padding: 5px 8px;
        background: #f7f7fa;
        border: 1px solid #eeeeF2;
        border-radius: 5px;
        color: #777;
        font-size: 8px;
        margin-left: 8px;
    }

    @media (max-width: 767.98px) {

        .user-header {
            padding: 17px;
        }

        .form-card .card-body {
            padding: 17px;
        }

        .form-actions {
            justify-content: stretch;
        }

        .form-actions .btn {
            flex: 1;
        }

        .back-btn {
            width: 100%;
        }

        .user-id {
            display: none;
        }
    }
</style>


{{-- =========================================================
     HEADER
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card user-header-card">

            <div class="user-header">

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <div class="d-flex align-items-center">

                            <div class="header-icon me-3">

                                <i class="mdi mdi-account-edit-outline"></i>

                            </div>

                            <div>

                                <div class="d-flex align-items-center">

                                    <h4 class="page-title">
                                        Edit User
                                    </h4>

                                    <span class="user-id">
                                        #{{ $user->id }}
                                    </span>

                                </div>

                                <p class="page-subtitle">
                                    Perbarui informasi akun pengguna yang terdaftar dalam sistem SIMPKL.
                                </p>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4 mt-3 mt-md-0">

                        <div class="d-flex justify-content-md-end">

                            <a
                                href="{{ route('admin.users.index') }}"
                                class="btn btn-light back-btn">

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
     VALIDATION ERROR
========================================================= --}}

@if($errors->any())

<div class="row">

    <div class="col-12">

        <div
            class="alert alert-danger alert-dismissible fade show alert-custom"
            role="alert">

            <div class="font-weight-bold mb-2">

                <i class="mdi mdi-alert-circle-outline me-1"></i>

                Data belum dapat diperbarui

            </div>

            <ul class="mb-0 pl-3">

                @foreach($errors->all() as $error)

                <li>
                    {{ $error }}
                </li>

                @endforeach

            </ul>

            <button
                type="button"
                class="close"
                data-dismiss="alert">

                <span>&times;</span>

            </button>

        </div>

    </div>

</div>

@endif


{{-- =========================================================
     FORM FULL WIDTH
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card form-card">

            <div class="card-body">


                {{-- SECTION HEADER --}}

                <div class="section-heading">

                    <div class="section-icon">

                        <i class="mdi mdi-account-edit-outline"></i>

                    </div>

                    <div>

                        <h5 class="section-title">
                            Informasi Akun
                        </h5>

                        <p class="section-description">
                            Perbarui data pengguna sesuai kebutuhan.
                        </p>

                    </div>

                </div>


                <form
                    action="{{ route('admin.users.update', $user->id) }}"
                    method="POST"
                    id="editUserForm">

                    @csrf

                    @method('PUT')


                    {{-- =================================================
                         NAMA & EMAIL
                    ================================================== --}}

                    <div class="row">

                        <div class="col-lg-6">

                            <div class="field-group">

                                <label
                                    for="name"
                                    class="field-label">

                                    Nama Lengkap

                                    <span class="required">*</span>

                                </label>

                                <div class="field-wrapper">

                                    <i class="mdi mdi-account-outline field-icon"></i>

                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        class="form-control field-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $user->name) }}"
                                        placeholder="Masukkan nama lengkap"
                                        autocomplete="name"
                                        required>

                                </div>

                                @error('name')

                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>

                                @enderror

                            </div>

                        </div>


                        <div class="col-lg-6">

                            <div class="field-group">

                                <label
                                    for="email"
                                    class="field-label">

                                    Alamat Email

                                    <span class="required">*</span>

                                </label>

                                <div class="field-wrapper">

                                    <i class="mdi mdi-email-outline field-icon"></i>

                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        class="form-control field-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $user->email) }}"
                                        placeholder="contoh@email.com"
                                        autocomplete="email"
                                        required>

                                </div>

                                @error('email')

                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>

                                @enderror

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         ROLE & STATUS
                    ================================================== --}}

                    <div class="row">

                        <div class="col-lg-6">

                            <div class="field-group">

                                <label
                                    for="role"
                                    class="field-label">

                                    Role Pengguna

                                </label>

                                <div class="field-wrapper">

                                    <i class="mdi mdi-shield-account-outline field-icon"></i>

                                    <input
                                        type="text"
                                        id="role"
                                        class="form-control field-control readonly-control"
                                        value="@if($user->role === 'admin') Admin @elseif($user->role === 'guru') Guru Pembimbing @elseif($user->role === 'siswa') Siswa @elseif($user->role === 'industri') Industri Pembimbing @else {{ ucfirst($user->role) }} @endif"
                                        readonly>

                                </div>

                                <small class="readonly-note">

                                    <i class="mdi mdi-lock-outline me-1"></i>

                                    Role tidak dapat diubah dari halaman ini.

                                </small>

                            </div>

                        </div>


                        <div class="col-lg-6">

                            <div class="field-group">

                                <label class="field-label">

                                    Status Akun

                                    <span class="required">*</span>

                                </label>

                                <div class="status-box">

                                    <div class="status-option">

                                        <input
                                            type="radio"
                                            name="is_active"
                                            id="active"
                                            value="1"
                                            {{ old('is_active', $user->is_active) == 1 ? 'checked' : '' }}
                                            required>

                                        <label for="active">

                                            Aktif

                                        </label>

                                    </div>


                                    <div class="status-option">

                                        <input
                                            type="radio"
                                            name="is_active"
                                            id="inactive"
                                            value="0"
                                            {{ old('is_active', $user->is_active) == 0 ? 'checked' : '' }}>

                                        <label for="inactive">

                                            Nonaktif

                                        </label>

                                    </div>

                                </div>

                                @error('is_active')

                                <div
                                    class="text-danger mt-2"
                                    style="font-size:8px;">

                                    {{ $message }}

                                </div>

                                @enderror

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         BUTTON
                    ================================================== --}}

                    <div class="form-actions">

                        <a
                            href="{{ route('admin.users.index') }}"
                            class="btn btn-light action-btn">

                            <i class="mdi mdi-close me-1"></i>

                            Batal

                        </a>

                        <button
                            type="submit"
                            class="btn btn-primary action-btn"
                            id="submitButton">

                            <i class="mdi mdi-content-save-outline me-1"></i>

                            Simpan Perubahan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     SUBMIT LOADING
========================================================= --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const form = document.getElementById('editUserForm');

        const button = document.getElementById('submitButton');

        if (form && button) {

            form.addEventListener('submit', function() {

                if (!form.checkValidity()) {
                    return;
                }

                button.disabled = true;

                button.innerHTML =
                    '<span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...';

            });

        }

    });
</script>

@endsection