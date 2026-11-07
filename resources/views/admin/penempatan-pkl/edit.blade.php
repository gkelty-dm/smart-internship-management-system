@extends('layouts.skydash-admin')

@section('title', 'Edit Penempatan PKL')

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
    }

    .form-control-custom:focus,
    .form-select-custom:focus {
        border-color: #4b49ac;
        box-shadow: none;
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

                                <i class="mdi mdi-pencil-outline"></i>

                            </div>

                            <div>

                                <h4 class="page-title">
                                    Edit Penempatan PKL
                                </h4>

                                <p class="page-subtitle">
                                    Perbarui informasi penempatan siswa PKL.
                                </p>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="d-flex justify-content-md-end page-header-actions">

                            <a
                                href="{{ route('admin.penempatan-pkl.index') }}"
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
                        Gagal Memperbarui Data
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
     SESSION ERROR
========================================================= --}}

@if(session('error'))

<div class="row">

    <div class="col-12 grid-margin">

        <div
            class="alert alert-danger alert-dismissible fade show"
            role="alert">

            <div class="d-flex align-items-center">

                <i
                    class="mdi mdi-alert-circle-outline me-2"
                    style="font-size:18px;">
                </i>

                <div class="flex-grow-1">

                    <div class="alert-title">
                        Gagal Memperbarui Data
                    </div>

                    <div class="mt-1">
                        {{ session('error') }}
                    </div>

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
     FORM EDIT
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card form-card">

            <div class="form-card-body">

                {{-- HEADER FORM --}}

                <div class="section-header">

                    <div class="section-icon">

                        <i class="mdi mdi-briefcase-edit-outline"></i>

                    </div>

                    <div>

                        <h5 class="section-title">
                            Informasi Penempatan PKL
                        </h5>

                        <p class="section-subtitle">
                            Perbarui informasi penempatan siswa yang sudah terdaftar.
                        </p>

                    </div>

                </div>


                <form
                    action="{{ route('admin.penempatan-pkl.update', $penempatan->id) }}"
                    method="POST"
                    id="form-penempatan"
                    autocomplete="off">

                    @csrf

                    @method('PUT')


                    {{-- =================================================
                         SISWA
                    ================================================== --}}

                    <div class="form-group-custom">

                        <label
                            for="siswa_id"
                            class="form-label-custom">

                            Siswa

                            <span class="required">
                                *
                            </span>

                        </label>

                        <div class="input-wrapper">

                            <i
                                class="mdi mdi-account-school-outline input-icon">
                            </i>

                            <select
                                name="siswa_id"
                                id="siswa_id"
                                class="form-select-custom @error('siswa_id') is-invalid @enderror"
                                required>

                                <option value="">
                                    -- Pilih Siswa --
                                </option>

                                @foreach($siswas as $siswa)

                                <option
                                    value="{{ $siswa->id }}"
                                    {{ old('siswa_id', $penempatan->siswa_id) == $siswa->id ? 'selected' : '' }}>

                                    {{ $siswa->user->name ?? '-' }}

                                    @if($siswa->kelas)

                                    - {{ $siswa->kelas->nama_kelas }}

                                    @endif

                                </option>

                                @endforeach

                            </select>

                        </div>

                        @error('siswa_id')

                        <div class="invalid-message">

                            <i class="mdi mdi-alert-circle-outline me-1"></i>

                            {{ $message }}

                        </div>

                        @enderror

                    </div>


                    {{-- =================================================
                         PERUSAHAAN
                    ================================================== --}}

                    <div class="form-group-custom">

                        <label
                            for="perusahaan_id"
                            class="form-label-custom">

                            Perusahaan / DUDI

                            <span class="required">
                                *
                            </span>

                        </label>

                        <div class="input-wrapper">

                            <i
                                class="mdi mdi-office-building-outline input-icon">
                            </i>

                            <select
                                name="perusahaan_id"
                                id="perusahaan_id"
                                class="form-select-custom @error('perusahaan_id') is-invalid @enderror"
                                required>

                                <option value="">
                                    -- Pilih Perusahaan / DUDI --
                                </option>

                                @foreach($perusahaans as $perusahaan)

                                <option
                                    value="{{ $perusahaan->id }}"
                                    {{ old('perusahaan_id', $penempatan->perusahaan_id) == $perusahaan->id ? 'selected' : '' }}>

                                    {{ $perusahaan->nama_perusahaan }}

                                </option>

                                @endforeach

                            </select>

                        </div>

                        @error('perusahaan_id')

                        <div class="invalid-message">

                            <i class="mdi mdi-alert-circle-outline me-1"></i>

                            {{ $message }}

                        </div>

                        @enderror

                    </div>


                    {{-- =================================================
                         PEMBIMBING INDUSTRI
                    ================================================== --}}

                    <div class="form-group-custom">

                        <label
                            for="industri_id"
                            class="form-label-custom">

                            Pembimbing Industri

                            <span class="required">
                                *
                            </span>

                        </label>

                        <div class="input-wrapper">

                            <i
                                class="mdi mdi-account-tie-outline input-icon">
                            </i>

                            <select
                                name="industri_id"
                                id="industri_id"
                                class="form-select-custom @error('industri_id') is-invalid @enderror"
                                required>

                                <option value="">
                                    -- Pilih Pembimbing Industri --
                                </option>

                                @foreach($industris as $industri)

                                <option
                                    value="{{ $industri->id }}"
                                    data-perusahaan="{{ $industri->perusahaan_id }}"
                                    {{ old('industri_id', $penempatan->industri_id) == $industri->id ? 'selected' : '' }}>

                                    {{ $industri->user->name ?? '-' }}

                                    @if($industri->jabatan)

                                    - {{ $industri->jabatan }}

                                    @endif

                                </option>

                                @endforeach

                            </select>

                        </div>

                        @error('industri_id')

                        <div class="invalid-message">

                            <i class="mdi mdi-alert-circle-outline me-1"></i>

                            {{ $message }}

                        </div>

                        @else

                        <div class="form-help">

                            Pembimbing industri akan ditampilkan berdasarkan perusahaan yang dipilih.

                        </div>

                        @enderror

                    </div>


                    {{-- =================================================
                         GURU PEMBIMBING
                    ================================================== --}}

                    <div class="form-group-custom">

                        <label
                            for="guru_id"
                            class="form-label-custom">

                            Guru Pembimbing

                            <span class="required">
                                *
                            </span>

                        </label>

                        <div class="input-wrapper">

                            <i
                                class="mdi mdi-account-tie input-icon">
                            </i>

                            <select
                                name="guru_id"
                                id="guru_id"
                                class="form-select-custom @error('guru_id') is-invalid @enderror"
                                required>

                                <option value="">
                                    -- Pilih Guru Pembimbing --
                                </option>

                                @foreach($gurus as $guru)

                                <option
                                    value="{{ $guru->id }}"
                                    {{ old('guru_id', $penempatan->guru_id) == $guru->id ? 'selected' : '' }}>

                                    {{ $guru->user->name ?? '-' }}

                                </option>

                                @endforeach

                            </select>

                        </div>

                        @error('guru_id')

                        <div class="invalid-message">

                            <i class="mdi mdi-alert-circle-outline me-1"></i>

                            {{ $message }}

                        </div>

                        @enderror

                    </div>


                    {{-- =================================================
                         PERIODE PKL
                    ================================================== --}}

                    <div class="form-group-custom">

                        <label class="form-label-custom">

                            Periode PKL

                        </label>

                        <div class="row">

                            {{-- TANGGAL MULAI --}}

                            <div class="col-md-6">

                                <div class="form-group-custom">

                                    <label
                                        for="tanggal_mulai"
                                        class="form-label-custom">

                                        Tanggal Mulai

                                        <span class="required">
                                            *
                                        </span>

                                    </label>

                                    <div class="input-wrapper">

                                        <i
                                            class="mdi mdi-calendar-start input-icon">
                                        </i>

                                        <input
                                            type="date"
                                            name="tanggal_mulai"
                                            id="tanggal_mulai"
                                            class="form-control-custom @error('tanggal_mulai') is-invalid @enderror"
                                            value="{{ old('tanggal_mulai', $penempatan->tanggal_mulai) }}"
                                            required>

                                    </div>

                                    @error('tanggal_mulai')

                                    <div class="invalid-message">

                                        <i class="mdi mdi-alert-circle-outline me-1"></i>

                                        {{ $message }}

                                    </div>

                                    @enderror

                                </div>

                            </div>


                            {{-- TANGGAL SELESAI --}}

                            <div class="col-md-6">

                                <div class="form-group-custom">

                                    <label
                                        for="tanggal_selesai"
                                        class="form-label-custom">

                                        Tanggal Selesai

                                        <span class="required">
                                            *
                                        </span>

                                    </label>

                                    <div class="input-wrapper">

                                        <i
                                            class="mdi mdi-calendar-end input-icon">
                                        </i>

                                        <input
                                            type="date"
                                            name="tanggal_selesai"
                                            id="tanggal_selesai"
                                            class="form-control-custom @error('tanggal_selesai') is-invalid @enderror"
                                            value="{{ old('tanggal_selesai', $penempatan->tanggal_selesai) }}"
                                            required>

                                    </div>

                                    @error('tanggal_selesai')

                                    <div class="invalid-message">

                                        <i class="mdi mdi-alert-circle-outline me-1"></i>

                                        {{ $message }}

                                    </div>

                                    @enderror

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         STATUS
                    ================================================== --}}

                    <div class="form-group-custom">

                        <label
                            for="status_pkl"
                            class="form-label-custom">

                            Status PKL

                            <span class="required">
                                *
                            </span>

                        </label>

                        <div class="input-wrapper">

                            <i
                                class="mdi mdi-clipboard-check-outline input-icon">
                            </i>

                            <select
                                name="status_pkl"
                                id="status_pkl"
                                class="form-select-custom @error('status_pkl') is-invalid @enderror"
                                required>

                                <option value="">
                                    -- Pilih Status PKL --
                                </option>

                                <option
                                    value="aktif"
                                    {{ old('status_pkl', $penempatan->status_pkl) == 'aktif' ? 'selected' : '' }}>

                                    Aktif

                                </option>

                                <option
                                    value="selesai"
                                    {{ old('status_pkl', $penempatan->status_pkl) == 'selesai' ? 'selected' : '' }}>

                                    Selesai

                                </option>

                                <option
                                    value="pending"
                                    {{ old('status_pkl', $penempatan->status_pkl) == 'pending' ? 'selected' : '' }}>

                                    Pending

                                </option>

                            </select>

                        </div>

                        @error('status_pkl')

                        <div class="invalid-message">

                            <i class="mdi mdi-alert-circle-outline me-1"></i>

                            {{ $message }}

                        </div>

                        @enderror

                    </div>


                    {{-- =================================================
                         BUTTON
                    ================================================== --}}

                    <div class="form-footer">

                        <div class="d-flex justify-content-end flex-wrap">

                            <a
                                href="{{ route('admin.penempatan-pkl.index') }}"
                                class="btn btn-light me-2">

                                <i class="mdi mdi-close me-1"></i>

                                Batal

                            </a>

                            <button
                                type="submit"
                                class="btn btn-primary"
                                id="btn-submit">

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


@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const form =
            document.getElementById('form-penempatan');

        const btnSubmit =
            document.getElementById('btn-submit');

        const perusahaanSelect =
            document.getElementById('perusahaan_id');

        const industriSelect =
            document.getElementById('industri_id');

        const tanggalMulai =
            document.getElementById('tanggal_mulai');

        const tanggalSelesai =
            document.getElementById('tanggal_selesai');


        /*
        |--------------------------------------------------------------------------
        | FILTER PEMBIMBING INDUSTRI
        |--------------------------------------------------------------------------
        */

        function filterIndustri() {

            const perusahaanId =
                perusahaanSelect.value;

            const currentIndustri =
                "{{ old('industri_id', $penempatan->industri_id) }}";


            Array.from(
                industriSelect.options
            ).forEach(function(option) {

                if (!option.dataset.perusahaan) {

                    return;

                }

                option.hidden =
                    option.dataset.perusahaan !== perusahaanId;

            });


            if (!perusahaanId) {

                industriSelect.value = '';

                return;

            }


            const selectedOption =
                industriSelect.options[
                    industriSelect.selectedIndex
                ];


            if (
                selectedOption &&
                selectedOption.dataset.perusahaan &&
                selectedOption.dataset.perusahaan !== perusahaanId
            ) {

                if (selectedOption.value !== currentIndustri) {

                    industriSelect.value = '';

                }

            }

        }


        /*
        |--------------------------------------------------------------------------
        | PERUSAHAAN BERUBAH
        |--------------------------------------------------------------------------
        */

        perusahaanSelect.addEventListener(
            'change',
            function() {

                /*
                 * Jika perusahaan diganti,
                 * pembimbing industri lama tidak dipertahankan.
                 */
                const selected =
                    industriSelect.options[
                        industriSelect.selectedIndex
                    ];

                if (
                    selected &&
                    selected.dataset.perusahaan !== perusahaanSelect.value
                ) {

                    industriSelect.value = '';

                }

                filterIndustri();

            }
        );


        /*
        |--------------------------------------------------------------------------
        | TANGGAL
        |--------------------------------------------------------------------------
        */

        function validateTanggal() {

            if (
                tanggalMulai.value &&
                tanggalSelesai.value
            ) {

                if (
                    tanggalSelesai.value <
                    tanggalMulai.value
                ) {

                    tanggalSelesai.setCustomValidity(
                        'Tanggal selesai tidak boleh lebih awal dari tanggal mulai.'
                    );

                } else {

                    tanggalSelesai.setCustomValidity('');

                }

            }

        }


        tanggalMulai.addEventListener(
            'change',
            function() {

                tanggalSelesai.min =
                    tanggalMulai.value;

                validateTanggal();

            }
        );


        tanggalSelesai.addEventListener(
            'change',
            validateTanggal
        );


        /*
        |--------------------------------------------------------------------------
        | SUBMIT
        |--------------------------------------------------------------------------
        */

        form.addEventListener(
            'submit',
            function() {

                validateTanggal();

                if (!form.checkValidity()) {

                    return;

                }

                btnSubmit.disabled = true;

                btnSubmit.innerHTML =
                    '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>' +
                    'Menyimpan...';

            }
        );


        /*
        |--------------------------------------------------------------------------
        | INITIAL
        |--------------------------------------------------------------------------
        */

        if (tanggalMulai.value) {

            tanggalSelesai.min =
                tanggalMulai.value;

        }

        filterIndustri();

    });
</script>

@endpush

@endsection