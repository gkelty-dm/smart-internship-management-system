@extends('layouts.skydash-siswa')

@section('title', 'Tambah Logbook')

@section('content')

{{-- =========================================================
     HEADER
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center flex-wrap">

                    <div class="d-flex align-items-center">

                        <div
                            class="rounded-3 bg-primary bg-opacity-10
                            d-flex align-items-center justify-content-center me-3"
                            style="width:52px;height:52px;">

                            <i
                                class="mdi mdi-book-plus-outline text-primary"
                                style="font-size:27px;">
                            </i>

                        </div>

                        <div>

                            <h4 class="fw-bold mb-1">
                                Tambah Logbook
                            </h4>

                            <p class="text-muted mb-0">
                                Catat kegiatan PKL Anda secara lengkap dan jelas.
                            </p>

                        </div>

                    </div>


                    <a
                        href="{{ route('siswa.logbook.index') }}"
                        class="btn btn-light mt-3 mt-md-0">

                        <i class="mdi mdi-arrow-left me-1"></i>

                        Kembali

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     FORM LOGBOOK
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card border-0 shadow-sm">

            <div class="card-body">


                {{-- HEADER FORM --}}

                <div class="mb-4">

                    <h5 class="card-title mb-1">
                        Form Logbook
                    </h5>

                    <p class="text-muted small mb-0">
                        Isi informasi kegiatan PKL yang Anda lakukan.
                    </p>

                </div>


                {{-- =================================================
                     ERROR VALIDASI
                ================================================== --}}

                @if($errors->any())

                <div
                    class="alert alert-danger border-0 shadow-sm
                    alert-dismissible fade show"
                    role="alert">

                    <div class="d-flex">

                        <i
                            class="mdi mdi-alert-circle-outline me-2"
                            style="font-size:22px;">
                        </i>

                        <div>

                            <h6 class="fw-bold mb-2">
                                Periksa kembali data Anda
                            </h6>

                            <ul class="mb-0 ps-3">

                                @foreach($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                                @endforeach

                            </ul>

                        </div>

                    </div>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                    </button>

                </div>

                @endif


                {{-- =================================================
                     FORM
                ================================================== --}}

                <form
                    id="formLogbook"
                    action="{{ route('siswa.logbook.store') }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf


                    {{-- =================================================
                         TANGGAL
                    ================================================== --}}

                    <div class="mb-4">

                        <label
                            for="tanggal"
                            class="form-label fw-semibold">

                            Tanggal Kegiatan

                            <span class="text-danger">
                                *
                            </span>

                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-light">

                                <i
                                    class="mdi mdi-calendar-outline text-primary">
                                </i>

                            </span>

                            <input
                                type="date"
                                name="tanggal"
                                id="tanggal"
                                class="form-control @error('tanggal') is-invalid @enderror"
                                value="{{ old('tanggal', date('Y-m-d')) }}"
                                required>

                        </div>

                        @error('tanggal')

                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>

                        @enderror

                    </div>


                    {{-- =================================================
                         KEGIATAN
                    ================================================== --}}

                    <div class="mb-4">

                        <label
                            for="kegiatan"
                            class="form-label fw-semibold">

                            Kegiatan PKL

                            <span class="text-danger">
                                *
                            </span>

                        </label>

                        <textarea
                            name="kegiatan"
                            id="kegiatan"
                            rows="6"
                            class="form-control @error('kegiatan') is-invalid @enderror"
                            placeholder="Tuliskan kegiatan yang Anda lakukan selama PKL..."
                            required>{{ old('kegiatan') }}</textarea>

                        <div
                            class="d-flex justify-content-between
                            align-items-center mt-2">

                            <small class="text-muted">

                                Jelaskan kegiatan yang dilakukan
                                selama PKL.

                            </small>

                            <small
                                class="text-muted"
                                id="kegiatanCounter">

                                0 karakter

                            </small>

                        </div>

                        @error('kegiatan')

                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>

                        @enderror

                    </div>


                    {{-- =================================================
                         KENDALA
                    ================================================== --}}

                    <div class="mb-4">

                        <label
                            for="kendala"
                            class="form-label fw-semibold">

                            Kendala

                            <span class="text-muted fw-normal">
                                (Opsional)
                            </span>

                        </label>

                        <textarea
                            name="kendala"
                            id="kendala"
                            rows="4"
                            class="form-control @error('kendala') is-invalid @enderror"
                            placeholder="Tuliskan kendala yang Anda temui selama melakukan kegiatan PKL...">{{ old('kendala') }}</textarea>

                        @error('kendala')

                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>

                        @enderror

                    </div>


                    {{-- =================================================
                         SOLUSI
                    ================================================== --}}

                    <div class="mb-4">

                        <label
                            for="solusi"
                            class="form-label fw-semibold">

                            Solusi

                            <span class="text-muted fw-normal">
                                (Opsional)
                            </span>

                        </label>

                        <textarea
                            name="solusi"
                            id="solusi"
                            rows="4"
                            class="form-control @error('solusi') is-invalid @enderror"
                            placeholder="Tuliskan solusi atau tindakan yang dilakukan untuk mengatasi kendala...">{{ old('solusi') }}</textarea>

                        @error('solusi')

                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>

                        @enderror

                    </div>


                    {{-- =================================================
                         FOTO DOKUMENTASI
                    ================================================== --}}

                    <div class="mb-4">

                        <label
                            for="foto"
                            class="form-label fw-semibold">

                            Dokumentasi Kegiatan

                            <span class="text-muted fw-normal">
                                (Opsional)
                            </span>

                        </label>


                        <div
                            class="border rounded-3 p-3 bg-light">

                            <div
                                class="d-flex align-items-center mb-3">

                                <div
                                    class="rounded-3 bg-white
                                    d-flex align-items-center
                                    justify-content-center me-3"
                                    style="width:45px;height:45px;">

                                    <i
                                        class="mdi mdi-image-multiple-outline
                                        text-primary"
                                        style="font-size:24px;">
                                    </i>

                                </div>

                                <div>

                                    <h6 class="fw-semibold mb-1">
                                        Upload Foto
                                    </h6>

                                    <small class="text-muted">
                                        Anda dapat memilih lebih dari satu foto.
                                    </small>

                                </div>

                            </div>


                            <input
                                type="file"
                                name="foto[]"
                                id="foto"
                                class="form-control @error('foto.*') is-invalid @enderror"
                                accept="image/jpeg,image/png,image/webp"
                                multiple>


                            <div
                                class="d-flex align-items-center mt-2">

                                <i
                                    class="mdi mdi-information-outline
                                    text-muted me-1">
                                </i>

                                <small class="text-muted">

                                    JPG, JPEG, PNG, atau WEBP.
                                    Maksimal 2 MB per foto.

                                </small>

                            </div>


                            {{-- PREVIEW FOTO --}}

                            <div
                                id="previewContainer"
                                class="row g-3 mt-2"
                                style="display:none;">
                            </div>

                        </div>


                        @error('foto.*')

                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>

                        @enderror

                    </div>


                    {{-- =================================================
                         INFORMASI VALIDASI
                    ================================================== --}}

                    <div
                        class="alert alert-info border-0
                        d-flex align-items-start">

                        <i
                            class="mdi mdi-information-outline me-2"
                            style="font-size:22px;">
                        </i>

                        <div>

                            <h6 class="fw-bold mb-1">
                                Proses Validasi
                            </h6>

                            <p class="mb-0 small">

                                Setelah logbook dikirim,
                                status akan menjadi
                                <strong>Menunggu Validasi</strong>
                                sampai diperiksa oleh guru pembimbing.

                            </p>

                        </div>

                    </div>


                    {{-- =================================================
                         BUTTON
                    ================================================== --}}

                    <div
                        class="border-top pt-4 mt-4">

                        <div
                            class="d-flex justify-content-end
                            gap-2 flex-wrap">

                            <a
                                href="{{ route('siswa.logbook.index') }}"
                                class="btn btn-light">

                                <i
                                    class="mdi mdi-close me-1">
                                </i>

                                Batal

                            </a>


                            <button
                                type="submit"
                                class="btn btn-primary"
                                id="btnSubmit">

                                <i
                                    class="mdi mdi-send-outline me-1">
                                </i>

                                Simpan Logbook

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection


{{-- =========================================================
     JAVASCRIPT
========================================================= --}}

@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {

        /*
        |--------------------------------------------------------------------------
        | COUNTER KEGIATAN
        |--------------------------------------------------------------------------
        */

        const kegiatan =
            document.getElementById('kegiatan');

        const counter =
            document.getElementById('kegiatanCounter');


        if (kegiatan && counter) {

            function updateCounter() {

                counter.textContent =
                    kegiatan.value.length + ' karakter';

            }

            kegiatan.addEventListener(
                'input',
                updateCounter
            );

            updateCounter();

        }


        /*
        |--------------------------------------------------------------------------
        | PREVIEW FOTO
        |--------------------------------------------------------------------------
        */

        const foto =
            document.getElementById('foto');

        const previewContainer =
            document.getElementById('previewContainer');


        if (foto && previewContainer) {

            foto.addEventListener(
                'change',
                function() {

                    previewContainer.innerHTML = '';


                    if (!this.files.length) {

                        previewContainer.style.display =
                            'none';

                        return;

                    }


                    previewContainer.style.display =
                        'flex';


                    Array.from(this.files).forEach(
                        function(file) {

                            if (
                                !file.type.startsWith('image/')
                            ) {

                                return;

                            }


                            const reader =
                                new FileReader();


                            reader.onload =
                                function(event) {

                                    const col =
                                        document.createElement(
                                            'div'
                                        );


                                    col.className =
                                        'col-6 col-md-4';


                                    const wrapper =
                                        document.createElement(
                                            'div'
                                        );


                                    wrapper.className =
                                        'border rounded-3 overflow-hidden bg-white';


                                    const image =
                                        document.createElement(
                                            'img'
                                        );


                                    image.src =
                                        event.target.result;


                                    image.alt =
                                        'Preview Foto';


                                    image.className =
                                        'img-fluid w-100';


                                    image.style.height =
                                        '110px';


                                    image.style.objectFit =
                                        'cover';


                                    wrapper.appendChild(
                                        image
                                    );


                                    col.appendChild(
                                        wrapper
                                    );


                                    previewContainer.appendChild(
                                        col
                                    );

                                };


                            reader.readAsDataURL(
                                file
                            );

                        }
                    );

                }
            );

        }


        /*
        |--------------------------------------------------------------------------
        | PREVENT DOUBLE SUBMIT
        |--------------------------------------------------------------------------
        */

        const form =
            document.getElementById(
                'formLogbook'
            );


        const submitButton =
            document.getElementById(
                'btnSubmit'
            );


        if (form && submitButton) {

            form.addEventListener(
                'submit',
                function() {

                    submitButton.disabled =
                        true;


                    submitButton.innerHTML =
                        '<i class="mdi mdi-loading mdi-spin me-1"></i> Menyimpan...';

                }
            );

        }

    });
</script>

@endpush