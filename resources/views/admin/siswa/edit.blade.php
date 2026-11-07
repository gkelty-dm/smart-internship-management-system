@extends('layouts.skydash-admin')

@section('title', 'Edit Siswa')

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
        box-shadow: none;
    }

    .form-control::placeholder {
        color: #b5b5be;
    }

    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

    .invalid-feedback {
        font-size: 10px;
    }

    .form-control.is-invalid,
    .form-select.is-invalid {
        border-color: #dc3545;
    }

    .alert-danger,
    .alert-success {
        border: 0;
        border-radius: 9px;
        font-size: 11px;
    }

    .alert-title {
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
                                    Edit Siswa
                                </h4>

                                <p class="page-subtitle">
                                    Perbarui informasi akun dan data siswa.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="d-flex justify-content-md-end page-header-actions">

                            <a
                                href="{{ route('admin.siswa.index') }}"
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
         SUCCESS
    ========================================================= --}}

    @if(session('success'))

    <div class="col-12">

        <div class="alert alert-success">

            <i class="mdi mdi-check-circle-outline me-2"></i>

            {{ session('success') }}

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
                    action="{{ route('admin.siswa.update', $siswa->id) }}"
                    method="POST"
                    autocomplete="off">

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
                                    Perbarui informasi akun siswa.
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
                                        value="{{ old('name', $siswa->user->name ?? '') }}"
                                        placeholder="Masukkan nama lengkap"
                                        autocomplete="off"
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
                                        value="{{ old('email', $siswa->user->email ?? '') }}"
                                        placeholder="Masukkan alamat email"
                                        autocomplete="off"
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
                         IDENTITAS SISWA
                    ================================================== --}}

                    <div class="form-section">

                        <div class="section-title-wrapper">

                            <div class="section-icon">

                                <i class="mdi mdi-card-account-details-outline"></i>

                            </div>

                            <div>

                                <h5 class="section-title">
                                    Identitas Siswa
                                </h5>

                                <p class="section-subtitle">
                                    Perbarui informasi identitas siswa.
                                </p>

                            </div>

                        </div>


                        <div class="row">

                            {{-- NISN --}}

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label
                                        for="nisn"
                                        class="form-label-custom">

                                        NISN

                                        <span class="required">
                                            *
                                        </span>

                                    </label>


                                    <input
                                        type="text"
                                        name="nisn"
                                        id="nisn"
                                        class="form-control @error('nisn') is-invalid @enderror"
                                        value="{{ old('nisn', $siswa->nisn ?? '') }}"
                                        placeholder="Masukkan NISN"
                                        autocomplete="off"
                                        required>


                                    @error('nisn')

                                    <div class="invalid-feedback">
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
                                        class="form-label-custom">

                                        Jenis Kelamin

                                        <span class="required">
                                            *
                                        </span>

                                    </label>


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
                                            {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') === 'L' ? 'selected' : '' }}>

                                            Laki-laki

                                        </option>

                                        <option
                                            value="P"
                                            {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') === 'P' ? 'selected' : '' }}>

                                            Perempuan

                                        </option>

                                    </select>


                                    @error('jenis_kelamin')

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
                                        value="{{ old('no_hp', $siswa->no_hp ?? '') }}"
                                        placeholder="08xxxxxxxxxx"
                                        autocomplete="off">


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
                         DATA KELAHIRAN
                    ================================================== --}}

                    <div class="form-section">

                        <div class="section-title-wrapper">

                            <div class="section-icon">

                                <i class="mdi mdi-calendar-account-outline"></i>

                            </div>

                            <div>

                                <h5 class="section-title">
                                    Data Kelahiran
                                </h5>

                                <p class="section-subtitle">
                                    Perbarui tempat dan tanggal lahir siswa.
                                </p>

                            </div>

                        </div>


                        <div class="row">

                            {{-- TEMPAT LAHIR --}}

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label
                                        for="tempat_lahir"
                                        class="form-label-custom">

                                        Tempat Lahir

                                    </label>


                                    <input
                                        type="text"
                                        name="tempat_lahir"
                                        id="tempat_lahir"
                                        class="form-control @error('tempat_lahir') is-invalid @enderror"
                                        value="{{ old('tempat_lahir', $siswa->tempat_lahir ?? '') }}"
                                        placeholder="Masukkan tempat lahir"
                                        autocomplete="off">


                                    @error('tempat_lahir')

                                    <div class="invalid-feedback">
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
                                        class="form-label-custom">

                                        Tanggal Lahir

                                    </label>


                                    <input
                                        type="date"
                                        name="tanggal_lahir"
                                        id="tanggal_lahir"
                                        class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                        value="{{ old('tanggal_lahir', $siswa->tanggal_lahir ?? '') }}"
                                        autocomplete="off">


                                    @error('tanggal_lahir')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                    @enderror

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         DATA AKADEMIK
                    ================================================== --}}

                    <div class="form-section">

                        <div class="section-title-wrapper">

                            <div class="section-icon">

                                <i class="mdi mdi-school-outline"></i>

                            </div>

                            <div>

                                <h5 class="section-title">
                                    Data Akademik
                                </h5>

                                <p class="section-subtitle">
                                    Atur jurusan dan kelas siswa.
                                </p>

                            </div>

                        </div>


                        <div class="row">

                            {{-- JURUSAN --}}

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label
                                        for="jurusan_id"
                                        class="form-label-custom">

                                        Jurusan

                                        <span class="required">
                                            *
                                        </span>

                                    </label>


                                    <select
                                        name="jurusan_id"
                                        id="jurusan_id"
                                        class="form-select @error('jurusan_id') is-invalid @enderror"
                                        data-kelas-url="{{ url('/admin/siswa/kelas') }}"
                                        data-old-jurusan="{{ old('jurusan_id', $siswa->jurusan_id ?? '') }}"
                                        required>

                                        <option value="">
                                            -- Pilih Jurusan --
                                        </option>

                                        @foreach($jurusans as $jurusan)

                                        <option
                                            value="{{ $jurusan->id }}"
                                            {{ old('jurusan_id', $siswa->jurusan_id ?? '') == $jurusan->id ? 'selected' : '' }}>

                                            {{ $jurusan->nama_jurusan }}

                                        </option>

                                        @endforeach

                                    </select>


                                    @error('jurusan_id')

                                    <div class="invalid-feedback">
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
                                        class="form-label-custom">

                                        Kelas

                                        <span class="required">
                                            *
                                        </span>

                                    </label>


                                    <select
                                        name="kelas_id"
                                        id="kelas_id"
                                        class="form-select @error('kelas_id') is-invalid @enderror"
                                        data-old-kelas="{{ old('kelas_id', $siswa->kelas_id ?? '') }}"
                                        required
                                        disabled>

                                        <option value="">
                                            Memuat kelas...
                                        </option>

                                    </select>


                                    @error('kelas_id')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                    @enderror

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         ALAMAT
                    ================================================== --}}

                    <div class="form-section">

                        <div class="section-title-wrapper">

                            <div class="section-icon">

                                <i class="mdi mdi-map-marker-outline"></i>

                            </div>

                            <div>

                                <h5 class="section-title">
                                    Alamat
                                </h5>

                                <p class="section-subtitle">
                                    Perbarui alamat lengkap siswa.
                                </p>

                            </div>

                        </div>


                        <div class="row">

                            <div class="col-12">

                                <div class="form-group">

                                    <label
                                        for="alamat"
                                        class="form-label-custom">

                                        Alamat Lengkap

                                    </label>


                                    <textarea
                                        name="alamat"
                                        id="alamat"
                                        rows="4"
                                        class="form-control @error('alamat') is-invalid @enderror"
                                        placeholder="Masukkan alamat lengkap"
                                        autocomplete="off">{{ old('alamat', $siswa->alamat ?? '') }}</textarea>


                                    @error('alamat')

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
                                href="{{ route('admin.siswa.index') }}"
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


@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const jurusanSelect =
            document.getElementById('jurusan_id');

        const kelasSelect =
            document.getElementById('kelas_id');

        const kelasUrl =
            jurusanSelect.dataset.kelasUrl;

        const oldJurusan =
            jurusanSelect.dataset.oldJurusan;

        const oldKelas =
            kelasSelect.dataset.oldKelas;


        function loadKelas(jurusanId, selectedKelasId) {

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


                    const defaultOption =
                        document.createElement('option');

                    defaultOption.value = '';

                    defaultOption.textContent =
                        '-- Pilih Kelas --';

                    kelasSelect.appendChild(defaultOption);


                    data.forEach(function(kelas) {

                        const option =
                            document.createElement('option');

                        option.value = kelas.id;

                        option.textContent =
                            kelas.nama_kelas;


                        if (
                            selectedKelasId &&
                            String(kelas.id) === String(selectedKelasId)
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

                loadKelas(
                    this.value,
                    ''
                );

            }
        );


        if (oldJurusan) {

            loadKelas(
                oldJurusan,
                oldKelas
            );

        } else {

            kelasSelect.disabled = true;

            kelasSelect.innerHTML =
                '<option value="">-- Pilih Jurusan Terlebih Dahulu --</option>';

        }

    });
</script>

@endpush