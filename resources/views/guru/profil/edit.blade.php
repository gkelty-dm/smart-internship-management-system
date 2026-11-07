@extends('layouts.skydash-guru')

@section('title', 'Edit Profil')

@section('content')

{{-- =========================================================
     HEADER
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body py-3">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                    <div class="d-flex align-items-center">

                        <div
                            class="bg-primary rounded-3 d-flex align-items-center justify-content-center me-3"
                            style="width:46px;height:46px;">

                            <i
                                class="mdi mdi-account-edit-outline text-white"
                                style="font-size:24px;">
                            </i>

                        </div>

                        <div>

                            <h4 class="fw-bold mb-1">
                                Edit Profil
                            </h4>

                            <p class="text-muted small mb-0">
                                Perbarui informasi akun dan data pribadi Anda.
                            </p>

                        </div>

                    </div>


                    <a
                        href="{{ route('guru.profil.index') }}"
                        class="btn btn-light btn-sm">

                        <i class="mdi mdi-arrow-left me-1"></i>

                        Kembali

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     FORM
========================================================= --}}

<div class="row">


    {{-- FOTO --}}

    <div class="col-lg-4 grid-margin stretch-card">

        <div class="card h-100">

            <div class="card-body text-center">

                <h5 class="card-title mb-1">
                    Foto Profil
                </h5>

                <p class="text-muted small mb-4">
                    Gunakan foto yang jelas dan sesuai.
                </p>


                {{-- PREVIEW --}}

                <div id="preview-container" class="mb-4">

                    @if($user->foto_profil)

                    <img
                        src="{{ asset(ltrim($user->foto_profil, '/')) }}"
                        id="foto-preview"
                        width="150"
                        height="150"
                        class="rounded-circle border"
                        style="width:150px;height:150px;object-fit:cover;"
                        alt="Foto Profil">

                    @else

                    <div
                        id="foto-placeholder"
                        class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto border"
                        style="width:150px;height:150px;">

                        <i
                            class="mdi mdi-account-outline text-muted"
                            style="font-size:70px;">
                        </i>

                    </div>

                    @endif

                </div>


                <label
                    for="foto_profil"
                    class="btn btn-outline-primary btn-sm">

                    <i class="mdi mdi-camera-outline me-1"></i>

                    Pilih Foto

                </label>


                <p class="text-muted small mt-3 mb-0">

                    JPG, JPEG, PNG atau WEBP
                    <br>
                    Maksimal 2 MB

                </p>

            </div>

        </div>

    </div>


    {{-- FORM DATA --}}

    <div class="col-lg-8 grid-margin stretch-card">

        <div class="card h-100">

            <div class="card-body">


                <div class="d-flex align-items-center mb-4">

                    <div
                        class="bg-light rounded-3 d-flex align-items-center justify-content-center me-3"
                        style="width:40px;height:40px;">

                        <i
                            class="mdi mdi-account-details-outline text-primary"
                            style="font-size:21px;">
                        </i>

                    </div>

                    <div>

                        <h5 class="card-title mb-1">
                            Informasi Profil
                        </h5>

                        <p class="text-muted small mb-0">
                            Perbarui data pribadi Anda.
                        </p>

                    </div>

                </div>


                <form
                    action="{{ route('guru.profil.update') }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf

                    @method('PUT')


                    {{-- INPUT FOTO --}}

                    <input
                        type="file"
                        name="foto_profil"
                        id="foto_profil"
                        class="d-none"
                        accept=".jpg,.jpeg,.png,.webp">


                    {{-- NAMA + EMAIL --}}

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label
                                for="name"
                                class="form-label fw-semibold">

                                Nama Lengkap

                            </label>

                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $user->name) }}"
                                required>

                            @error('name')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>


                        <div class="col-md-6 mb-3">

                            <label
                                for="email"
                                class="form-label fw-semibold">

                                Email

                            </label>

                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $user->email) }}"
                                required>

                            @error('email')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>

                    </div>


                    {{-- NIP + HP --}}

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label
                                for="nip"
                                class="form-label fw-semibold">

                                NIP

                            </label>

                            <input
                                type="text"
                                name="nip"
                                id="nip"
                                class="form-control @error('nip') is-invalid @enderror"
                                value="{{ old('nip', $guru->nip) }}"
                                required>

                            @error('nip')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>


                        <div class="col-md-6 mb-3">

                            <label
                                for="no_hp"
                                class="form-label fw-semibold">

                                Nomor HP

                            </label>

                            <input
                                type="text"
                                name="no_hp"
                                id="no_hp"
                                class="form-control @error('no_hp') is-invalid @enderror"
                                value="{{ old('no_hp', $guru->no_hp) }}">

                            @error('no_hp')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>

                    </div>


                    {{-- ALAMAT --}}

                    <div class="mb-4">

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
                            placeholder="Masukkan alamat lengkap">{{ old('alamat', $guru->alamat) }}</textarea>

                        @error('alamat')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                        @enderror

                    </div>


                    {{-- BUTTON --}}

                    <div class="border-top pt-3">

                        <div class="d-flex justify-content-end gap-2 flex-wrap">

                            <a
                                href="{{ route('guru.profil.index') }}"
                                class="btn btn-light btn-sm">

                                Batal

                            </a>


                            <button
                                type="submit"
                                class="btn btn-primary btn-sm">

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
     PREVIEW FOTO
========================================================= --}}

@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const input =
            document.getElementById('foto_profil');

        const container =
            document.getElementById('preview-container');


        if (!input || !container) {
            return;
        }


        input.addEventListener('change', function(event) {

            const file =
                event.target.files[0];


            if (!file) {
                return;
            }


            const allowedTypes = [
                'image/jpeg',
                'image/png',
                'image/webp'
            ];


            if (!allowedTypes.includes(file.type)) {

                alert(
                    'Format foto harus JPG, JPEG, PNG atau WEBP.'
                );

                input.value = '';

                return;
            }


            if (file.size > 2 * 1024 * 1024) {

                alert(
                    'Ukuran foto maksimal 2 MB.'
                );

                input.value = '';

                return;
            }


            const reader =
                new FileReader();


            reader.onload = function(e) {

                container.innerHTML = `

                <img
                    src="${e.target.result}"
                    id="foto-preview"
                    width="150"
                    height="150"
                    class="rounded-circle border"
                    style="width:150px;height:150px;object-fit:cover;"
                    alt="Preview Foto Profil">

            `;

            };


            reader.readAsDataURL(file);

        });

    });
</script>

@endpush

@endsection