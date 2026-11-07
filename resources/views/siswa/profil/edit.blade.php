@extends('layouts.skydash-siswa')

@section('title', 'Edit Profil')

@section('content')

{{-- =========================================================
     HEADER
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card border-0 shadow-sm">

            <div class="card-body py-4">

                <div class="d-flex align-items-center">

                    <div
                        class="d-flex align-items-center justify-content-center
                        bg-primary bg-opacity-10 text-primary rounded-3 me-3"
                        style="width:52px;height:52px;">

                        <i
                            class="mdi mdi-account-edit-outline"
                            style="font-size:25px;">
                        </i>

                    </div>

                    <div>

                        <h4 class="fw-bold mb-1">
                            Edit Profil
                        </h4>

                        <p class="text-muted mb-0">
                            Perbarui informasi akun dan data pribadi Anda.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     ERROR
========================================================= --}}

@if($errors->any())

<div class="row">

    <div class="col-12 grid-margin">

        <div class="alert alert-danger border-0 shadow-sm">

            <div class="d-flex">

                <i
                    class="mdi mdi-alert-circle-outline me-2"
                    style="font-size:22px;">
                </i>

                <div>

                    <strong>
                        Data belum dapat disimpan.
                    </strong>

                    <ul class="mb-0 mt-2">

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
========================================================= --}}

<div class="row">

    <div class="col-12">

        <form
            action="{{ route('siswa.profil.update') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            @method('PUT')


            {{-- =================================================
                 FOTO PROFIL
            ================================================== --}}

            <div class="card border-0 shadow-sm grid-margin">

                <div class="card-body">

                    <div class="d-flex align-items-center mb-4">

                        <div
                            class="d-flex align-items-center justify-content-center
                            bg-primary bg-opacity-10 text-primary rounded-3 me-3"
                            style="width:42px;height:42px;">

                            <i
                                class="mdi mdi-camera-outline"
                                style="font-size:21px;">
                            </i>

                        </div>

                        <div>

                            <h5 class="fw-bold mb-1">
                                Foto Profil
                            </h5>

                            <p class="text-muted small mb-0">
                                Foto digunakan sebagai identitas akun Anda.
                            </p>

                        </div>

                    </div>


                    <div
                        class="rounded-3 p-4"
                        style="
                            background:#f8f9fc;
                            border:1px solid #ebedf2;
                        ">

                        <div class="d-flex align-items-center flex-wrap">


                            {{-- FOTO --}}

                            <div
                                class="me-4 mb-3 mb-md-0"
                                style="
                                    width:120px;
                                    height:120px;
                                    min-width:120px;
                                    position:relative;
                                ">

                                @if($user->foto_profil)

                                <img
                                    src="{{ url($user->foto_profil) }}"
                                    id="previewFoto"
                                    alt="Foto Profil"
                                    style="
                                        display:block !important;
                                        width:120px !important;
                                        height:120px !important;
                                        min-width:120px !important;
                                        max-width:120px !important;
                                        min-height:120px !important;
                                        max-height:120px !important;
                                        padding:0 !important;
                                        margin:0 !important;
                                        border:4px solid #ffffff !important;
                                        border-radius:50% !important;
                                        object-fit:cover !important;
                                        object-position:center !important;
                                        overflow:hidden !important;
                                        box-shadow:0 3px 10px rgba(0,0,0,.12) !important;
                                    ">

                                @else

                                <div
                                    id="previewFoto"
                                    style="
                                        display:flex !important;
                                        align-items:center !important;
                                        justify-content:center !important;
                                        width:120px !important;
                                        height:120px !important;
                                        min-width:120px !important;
                                        max-width:120px !important;
                                        min-height:120px !important;
                                        max-height:120px !important;
                                        padding:0 !important;
                                        margin:0 !important;
                                        border:4px solid #ffffff !important;
                                        border-radius:50% !important;
                                        background:#4B49AC !important;
                                        color:#ffffff !important;
                                        font-size:42px !important;
                                        font-weight:600 !important;
                                        box-shadow:0 3px 10px rgba(0,0,0,.12) !important;
                                    ">

                                    {{ strtoupper(
                                        substr(
                                            $user->name,
                                            0,
                                            1
                                        )
                                    ) }}

                                </div>

                                @endif

                            </div>


                            {{-- UPLOAD --}}

                            <div
                                class="flex-grow-1"
                                style="min-width:250px;">

                                <label
                                    for="foto_profil"
                                    class="form-label fw-semibold">

                                    Ganti Foto Profil

                                </label>

                                <input
                                    type="file"
                                    name="foto_profil"
                                    id="foto_profil"
                                    class="form-control @error('foto_profil') is-invalid @enderror"
                                    accept=".jpg,.jpeg,.png,.webp">

                                @error('foto_profil')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                                @enderror

                                <small class="text-muted d-block mt-2">

                                    <i
                                        class="mdi mdi-information-outline me-1">
                                    </i>

                                    JPG, JPEG, PNG atau WEBP.
                                    Maksimal 2 MB.

                                </small>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 INFORMASI AKUN
            ================================================== --}}

            <div class="card border-0 shadow-sm grid-margin">

                <div class="card-body">

                    <div class="d-flex align-items-center mb-4">

                        <div
                            class="d-flex align-items-center justify-content-center
                            bg-primary bg-opacity-10 text-primary rounded-3 me-3"
                            style="width:42px;height:42px;">

                            <i
                                class="mdi mdi-account-outline"
                                style="font-size:21px;">
                            </i>

                        </div>

                        <div>

                            <h5 class="fw-bold mb-1">
                                Informasi Akun
                            </h5>

                            <p class="text-muted small mb-0">
                                Informasi dasar akun siswa.
                            </p>

                        </div>

                    </div>


                    <div class="row">


                        {{-- NAMA --}}

                        <div class="col-md-6 mb-4">

                            <label
                                for="name"
                                class="form-label fw-semibold">

                                Nama Lengkap

                                <span class="text-danger">*</span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-text bg-light">

                                    <i class="mdi mdi-account-outline"></i>

                                </span>

                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $user->name) }}"
                                    placeholder="Masukkan nama lengkap"
                                    required>

                            </div>

                            @error('name')

                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>


                        {{-- EMAIL --}}

                        <div class="col-md-6 mb-4">

                            <label
                                for="email"
                                class="form-label fw-semibold">

                                Email

                                <span class="text-danger">*</span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-text bg-light">

                                    <i class="mdi mdi-email-outline"></i>

                                </span>

                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $user->email) }}"
                                    placeholder="Masukkan alamat email"
                                    required>

                            </div>

                            @error('email')

                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>


                        {{-- NISN --}}

                        <div class="col-md-6 mb-4">

                            <label
                                for="nisn"
                                class="form-label fw-semibold">

                                NISN

                                <span class="text-danger">*</span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-text bg-light">

                                    <i class="mdi mdi-card-account-details-outline"></i>

                                </span>

                                <input
                                    type="text"
                                    name="nisn"
                                    id="nisn"
                                    class="form-control @error('nisn') is-invalid @enderror"
                                    value="{{ old('nisn', $siswa->nisn) }}"
                                    placeholder="Masukkan NISN"
                                    required>

                            </div>

                            @error('nisn')

                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>


                        {{-- JENIS KELAMIN --}}

                        <div class="col-md-6 mb-4">

                            <label
                                for="jenis_kelamin"
                                class="form-label fw-semibold">

                                Jenis Kelamin

                                <span class="text-danger">*</span>

                            </label>

                            <div class="position-relative">

                                <select
                                    name="jenis_kelamin"
                                    id="jenis_kelamin"
                                    class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                    style="
                                        height:46px;
                                        padding-left:42px;
                                    "
                                    required>

                                    <option value="">
                                        Pilih Jenis Kelamin
                                    </option>

                                    <option
                                        value="L"
                                        {{ old(
                                            'jenis_kelamin',
                                            $siswa->jenis_kelamin
                                        ) == 'L' ? 'selected' : '' }}>

                                        Laki-laki

                                    </option>

                                    <option
                                        value="P"
                                        {{ old(
                                            'jenis_kelamin',
                                            $siswa->jenis_kelamin
                                        ) == 'P' ? 'selected' : '' }}>

                                        Perempuan

                                    </option>

                                </select>

                                <i
                                    class="mdi mdi-gender-male-female
                                    text-muted"
                                    style="
                                        position:absolute;
                                        left:14px;
                                        top:50%;
                                        transform:translateY(-50%);
                                        pointer-events:none;
                                        z-index:2;
                                    ">
                                </i>

                            </div>

                            @error('jenis_kelamin')

                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 DATA PRIBADI
            ================================================== --}}

            <div class="card border-0 shadow-sm grid-margin">

                <div class="card-body">

                    <div class="d-flex align-items-center mb-4">

                        <div
                            class="d-flex align-items-center justify-content-center
                            bg-primary bg-opacity-10 text-primary rounded-3 me-3"
                            style="width:42px;height:42px;">

                            <i
                                class="mdi mdi-card-account-details-outline"
                                style="font-size:21px;">
                            </i>

                        </div>

                        <div>

                            <h5 class="fw-bold mb-1">
                                Data Pribadi
                            </h5>

                            <p class="text-muted small mb-0">
                                Lengkapi informasi pribadi Anda.
                            </p>

                        </div>

                    </div>


                    <div class="row">


                        {{-- TEMPAT LAHIR --}}

                        <div class="col-md-6 mb-4">

                            <label
                                for="tempat_lahir"
                                class="form-label fw-semibold">

                                Tempat Lahir

                            </label>

                            <div class="input-group">

                                <span class="input-group-text bg-light">

                                    <i class="mdi mdi-map-marker-outline"></i>

                                </span>

                                <input
                                    type="text"
                                    name="tempat_lahir"
                                    id="tempat_lahir"
                                    class="form-control @error('tempat_lahir') is-invalid @enderror"
                                    value="{{ old(
                                        'tempat_lahir',
                                        $siswa->tempat_lahir
                                    ) }}"
                                    placeholder="Contoh: Bengkulu">

                            </div>

                            @error('tempat_lahir')

                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>


                        {{-- TANGGAL LAHIR --}}

                        <div class="col-md-6 mb-4">

                            <label
                                for="tanggal_lahir"
                                class="form-label fw-semibold">

                                Tanggal Lahir

                            </label>

                            <div class="input-group">

                                <span class="input-group-text bg-light">

                                    <i class="mdi mdi-calendar-outline"></i>

                                </span>

                                <input
                                    type="date"
                                    name="tanggal_lahir"
                                    id="tanggal_lahir"
                                    class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                    value="{{ old(
                                        'tanggal_lahir',
                                        $siswa->tanggal_lahir
                                    ) }}">

                            </div>

                            @error('tanggal_lahir')

                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>


                        {{-- NOMOR HP --}}

                        <div class="col-md-6 mb-4">

                            <label
                                for="no_hp"
                                class="form-label fw-semibold">

                                Nomor HP

                            </label>

                            <div class="input-group">

                                <span class="input-group-text bg-light">

                                    <i class="mdi mdi-phone-outline"></i>

                                </span>

                                <input
                                    type="text"
                                    name="no_hp"
                                    id="no_hp"
                                    class="form-control @error('no_hp') is-invalid @enderror"
                                    value="{{ old(
                                        'no_hp',
                                        $siswa->no_hp
                                    ) }}"
                                    placeholder="Contoh: 08xxxxxxxxxx">

                            </div>

                            @error('no_hp')

                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>


                        {{-- ALAMAT --}}

                        <div class="col-12">

                            <label
                                for="alamat"
                                class="form-label fw-semibold">

                                Alamat

                            </label>

                            <textarea
                                name="alamat"
                                id="alamat"
                                rows="4"
                                class="form-control @error('alamat') is-invalid @enderror"
                                placeholder="Masukkan alamat lengkap">{{ old(
                                    'alamat',
                                    $siswa->alamat
                                ) }}</textarea>

                            @error('alamat')

                            <div class="text-danger small mt-1">
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

            <div class="card border-0 shadow-sm grid-margin">

                <div class="card-body">

                    <div class="d-flex align-items-center mb-4">

                        <div
                            class="d-flex align-items-center justify-content-center
                            bg-primary bg-opacity-10 text-primary rounded-3 me-3"
                            style="width:42px;height:42px;">

                            <i
                                class="mdi mdi-school-outline"
                                style="font-size:21px;">
                            </i>

                        </div>

                        <div>

                            <h5 class="fw-bold mb-1">
                                Data Akademik
                            </h5>

                            <p class="text-muted small mb-0">
                                Data berikut dikelola oleh pihak sekolah.
                            </p>

                        </div>

                    </div>


                    <div class="row">


                        {{-- JURUSAN --}}

                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-semibold">
                                Jurusan
                            </label>

                            <div
                                class="d-flex align-items-center
                                rounded-3 p-3"
                                style="
                                    min-height:72px;
                                    background:#f8f9fc;
                                    border:1px solid #ebedf2;
                                ">

                                <div
                                    class="d-flex align-items-center
                                    justify-content-center
                                    bg-primary bg-opacity-10
                                    text-primary rounded-3 me-3"
                                    style="
                                        width:42px;
                                        height:42px;
                                        min-width:42px;
                                    ">

                                    <i
                                        class="mdi mdi-book-education-outline"
                                        style="font-size:21px;">
                                    </i>

                                </div>

                                <div>

                                    <small class="text-muted d-block mb-1">
                                        Jurusan
                                    </small>

                                    <strong>
                                        {{ $siswa->jurusan->nama_jurusan ?? '-' }}
                                    </strong>

                                </div>

                            </div>

                        </div>


                        {{-- KELAS --}}

                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-semibold">
                                Kelas
                            </label>

                            <div
                                class="d-flex align-items-center
                                rounded-3 p-3"
                                style="
                                    min-height:72px;
                                    background:#f8f9fc;
                                    border:1px solid #ebedf2;
                                ">

                                <div
                                    class="d-flex align-items-center
                                    justify-content-center
                                    bg-primary bg-opacity-10
                                    text-primary rounded-3 me-3"
                                    style="
                                        width:42px;
                                        height:42px;
                                        min-width:42px;
                                    ">

                                    <i
                                        class="mdi mdi-google-classroom"
                                        style="font-size:21px;">
                                    </i>

                                </div>

                                <div>

                                    <small class="text-muted d-block mb-1">
                                        Kelas
                                    </small>

                                    <strong>
                                        {{ $siswa->kelas->nama_kelas ?? '-' }}
                                    </strong>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 TOMBOL
            ================================================== --}}

            <div class="card border-0 shadow-sm grid-margin">

                <div class="card-body">

                    <div
                        class="d-flex justify-content-between
                        align-items-center flex-wrap">

                        <div>

                            <h6 class="fw-bold mb-1">
                                Periksa Data Anda
                            </h6>

                            <small class="text-muted">
                                Pastikan seluruh informasi sudah benar.
                            </small>

                        </div>

                        <div
                            class="d-flex gap-2 mt-3 mt-md-0">

                            <a
                                href="{{ route('siswa.profil.index') }}"
                                class="btn btn-light">

                                <i class="mdi mdi-arrow-left me-1"></i>

                                Batal

                            </a>

                            <button
                                type="submit"
                                class="btn btn-primary px-4">

                                <i
                                    class="mdi mdi-content-save-outline me-1">
                                </i>

                                Simpan Perubahan

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>


{{-- =========================================================
     PREVIEW FOTO
========================================================= --}}

<script>
    document.addEventListener(
        'DOMContentLoaded',
        function() {

            const input =
                document.getElementById(
                    'foto_profil'
                );

            const preview =
                document.getElementById(
                    'previewFoto'
                );


            if (!input || !preview) {

                return;

            }


            input.addEventListener(
                'change',
                function() {

                    const file =
                        this.files[0];


                    if (!file) {
                        return;
                    }


                    if (
                        !file.type.startsWith(
                            'image/'
                        )
                    ) {
                        return;
                    }


                    const reader =
                        new FileReader();


                    reader.onload =
                        function(event) {

                            if (
                                preview
                                .tagName
                                .toLowerCase() !==
                                'img'
                            ) {

                                const image =
                                    document.createElement(
                                        'img'
                                    );

                                image.id =
                                    'previewFoto';

                                image.alt =
                                    'Foto Profil';

                                image.src =
                                    event.target.result;

                                image.setAttribute(
                                    'style',
                                    `
                                display:block !important;
                                width:120px !important;
                                height:120px !important;
                                min-width:120px !important;
                                max-width:120px !important;
                                min-height:120px !important;
                                max-height:120px !important;
                                padding:0 !important;
                                margin:0 !important;
                                border:4px solid #ffffff !important;
                                border-radius:50% !important;
                                object-fit:cover !important;
                                object-position:center !important;
                                overflow:hidden !important;
                                box-shadow:0 3px 10px rgba(0,0,0,.12) !important;
                                `
                                );

                                preview.replaceWith(
                                    image
                                );

                            } else {

                                preview.src =
                                    event.target.result;

                            }

                        };


                    reader.readAsDataURL(
                        file
                    );

                }
            );

        }
    );
</script>

@endsection