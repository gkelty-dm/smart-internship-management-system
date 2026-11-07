@extends('layouts.skydash-admin')

@section('title', 'Tambah Kelas')

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

    .page-header .btn {
        font-size: 10px;
        border-radius: 6px;
        padding: 8px 13px;
    }

    .form-card {
        border: 0;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .035);
    }

    .form-card-body {
        padding: 24px;
    }

    .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 24px;
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

    .form-group-custom {
        margin-bottom: 21px;
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

    .input-wrapper {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        color: #9999a5;
        font-size: 17px;
        z-index: 2;
        pointer-events: none;
    }

    .form-control-custom,
    .form-select-custom {
        width: 100%;
        min-height: 44px;
        border: 1px solid #e2e2e8;
        border-radius: 7px;
        font-size: 11px;
        color: #495057;
        outline: none;
        box-shadow: none;
        transition: border-color .15s ease;
        background-color: #fff;
    }

    .form-control-custom {
        padding: 9px 12px 9px 40px;
    }

    .form-select-custom {
        padding: 9px 35px 9px 40px;
        appearance: auto;
    }

    .form-control-custom:focus,
    .form-select-custom:focus {
        border-color: #4b49ac;
        box-shadow: none;
    }

    .form-control-custom::placeholder {
        color: #b5b5be;
    }

    .form-control-custom.is-invalid,
    .form-select-custom.is-invalid {
        border-color: #dc3545;
    }

    .form-help {
        font-size: 9px;
        color: #9a9aa5;
        margin-top: 7px;
        line-height: 1.5;
    }

    .invalid-message {
        color: #dc3545;
        font-size: 9px;
        margin-top: 6px;
    }

    .form-footer {
        margin-top: 26px;
        padding-top: 18px;
        border-top: 1px solid #eeeeee;
    }

    .form-footer .btn {
        min-height: 40px;
        border-radius: 7px;
        font-size: 10px;
        padding: 8px 16px;
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

    .alert-danger {
        border: 0;
        border-radius: 8px;
        font-size: 10px;
        box-shadow: 0 2px 10px rgba(220, 53, 69, .05);
    }

    .alert-title {
        font-size: 11px;
        font-weight: 600;
    }

    .alert-danger ul {
        font-size: 9px;
    }

    @media (max-width: 767.98px) {

        .page-header {
            padding: 17px;
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


{{-- =========================================================
     HEADER
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card page-card">

            <div class="page-header">

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <div class="d-flex align-items-center">

                            <div class="page-header-icon me-3">

                                <i class="mdi mdi-google-classroom"></i>

                            </div>

                            <div>

                                <h4 class="page-title">
                                    Tambah Kelas
                                </h4>

                                <p class="page-subtitle">
                                    Tambahkan data kelas baru berdasarkan jurusan.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="d-flex justify-content-md-end page-header-actions">

                            <a
                                href="{{ route('admin.kelas.index') }}"
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
     VALIDATION ERROR
========================================================= --}}

@if($errors->any())

<div class="row">

    <div class="col-12 grid-margin">

        <div
            class="alert alert-danger alert-dismissible fade show"
            role="alert">

            <div class="d-flex align-items-start">

                <i
                    class="mdi mdi-alert-circle-outline me-2"
                    style="font-size:20px;">
                </i>

                <div class="flex-grow-1">

                    <div class="alert-title mb-1">
                        Gagal Menyimpan Data
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
                    data-bs-dismiss="alert"
                    aria-label="Close">
                </button>

            </div>

        </div>

    </div>

</div>

@endif


{{-- =========================================================
     FORM KELAS
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card form-card">

            <div class="form-card-body">

                {{-- HEADER FORM --}}

                <div class="section-header">

                    <div class="section-icon">

                        <i class="mdi mdi-google-classroom"></i>

                    </div>

                    <div>

                        <h5 class="section-title">
                            Informasi Kelas
                        </h5>

                        <p class="section-subtitle">
                            Lengkapi informasi kelas yang akan ditambahkan.
                        </p>

                    </div>

                </div>


                {{-- FORM --}}

                <form
                    action="{{ route('admin.kelas.store') }}"
                    method="POST"
                    id="form-kelas"
                    autocomplete="off">

                    @csrf


                    {{-- JURUSAN --}}

                    <div class="form-group-custom">

                        <label
                            for="jurusan_id"
                            class="form-label-custom">

                            Jurusan

                            <span class="required">
                                *
                            </span>

                        </label>


                        <div class="input-wrapper">

                            <i class="mdi mdi-school-outline input-icon"></i>

                            <select
                                name="jurusan_id"
                                id="jurusan_id"
                                class="form-select-custom @error('jurusan_id') is-invalid @enderror"
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

                        <div class="invalid-message">

                            <i class="mdi mdi-alert-circle-outline me-1"></i>

                            {{ $message }}

                        </div>

                        @else

                        <div class="form-help">

                            Pilih jurusan yang sesuai dengan kelas yang akan ditambahkan.

                        </div>

                        @enderror

                    </div>


                    {{-- NAMA KELAS --}}

                    <div class="form-group-custom">

                        <label
                            for="nama_kelas"
                            class="form-label-custom">

                            Nama Kelas

                            <span class="required">
                                *
                            </span>

                        </label>


                        <div class="input-wrapper">

                            <i class="mdi mdi-google-classroom input-icon"></i>

                            <input
                                type="text"
                                name="nama_kelas"
                                id="nama_kelas"
                                class="form-control-custom @error('nama_kelas') is-invalid @enderror"
                                value="{{ old('nama_kelas') }}"
                                placeholder="Contoh: XII RPL 1"
                                maxlength="50"
                                required>

                        </div>


                        @error('nama_kelas')

                        <div class="invalid-message">

                            <i class="mdi mdi-alert-circle-outline me-1"></i>

                            {{ $message }}

                        </div>

                        @else

                        <div class="form-help">

                            Gunakan nama kelas sesuai dengan data resmi sekolah. Maksimal 50 karakter.

                        </div>

                        @enderror

                    </div>


                    {{-- FOOTER FORM --}}

                    <div class="form-footer">

                        <div class="d-flex justify-content-end flex-wrap">

                            <a
                                href="{{ route('admin.kelas.index') }}"
                                class="btn btn-light me-2">

                                <i class="mdi mdi-close me-1"></i>

                                Batal

                            </a>


                            <button
                                type="submit"
                                class="btn btn-primary"
                                id="btn-submit">

                                <i class="mdi mdi-content-save-outline me-1"></i>

                                Simpan Kelas

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

        const form =
            document.getElementById('form-kelas');

        const btnSubmit =
            document.getElementById('btn-submit');


        if (!form || !btnSubmit) {
            return;
        }


        form.addEventListener('submit', function() {

            if (!form.checkValidity()) {
                return;
            }

            btnSubmit.disabled = true;

            btnSubmit.innerHTML =
                '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Menyimpan...';

        });

    });
</script>

@endpush