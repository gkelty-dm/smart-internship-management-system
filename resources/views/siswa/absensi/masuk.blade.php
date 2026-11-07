@extends('layouts.skydash-siswa')

@section('title', 'Absen Masuk')

@section('content')

{{-- =========================================================
     HEADER
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="d-flex align-items-center">

                    <div
                        class="rounded-3 bg-primary bg-opacity-10
                        d-flex align-items-center justify-content-center me-3"
                        style="width:52px;height:52px;">

                        <i
                            class="mdi mdi-camera-account text-primary"
                            style="font-size:27px;">
                        </i>

                    </div>

                    <div>

                        <h4 class="fw-bold mb-1">
                            Absen Masuk
                        </h4>

                        <p class="text-muted mb-0">
                            Lakukan verifikasi wajah dan lokasi untuk mencatat kehadiran.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     NOTIFIKASI
========================================================= --}}

<div class="row">

    <div class="col-12">

        @if(session('success'))

        <div
            class="alert alert-success alert-dismissible fade show
            border-0 shadow-sm"
            role="alert">

            <div class="d-flex align-items-center">

                <i
                    class="mdi mdi-check-circle-outline me-2"
                    style="font-size:22px;">
                </i>

                <span>
                    {{ session('success') }}
                </span>

            </div>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

        @endif


        @if(session('error'))

        <div
            class="alert alert-danger alert-dismissible fade show
            border-0 shadow-sm"
            role="alert">

            <div class="d-flex align-items-center">

                <i
                    class="mdi mdi-alert-circle-outline me-2"
                    style="font-size:22px;">
                </i>

                <span>
                    {{ session('error') }}
                </span>

            </div>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

        @endif


        @if($errors->any())

        <div
            class="alert alert-danger alert-dismissible fade show
            border-0 shadow-sm"
            role="alert">

            <div class="d-flex">

                <i
                    class="mdi mdi-alert-circle-outline me-2"
                    style="font-size:22px;">
                </i>

                <div>

                    <h6 class="fw-bold mb-1">
                        Terjadi Kesalahan
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

    </div>

</div>


{{-- =========================================================
     ABSENSI
========================================================= --}}

<div class="row">


    {{-- =====================================================
         KAMERA
    ====================================================== --}}

    <div class="col-lg-8 grid-margin stretch-card">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">


                {{-- HEADER KAMERA --}}

                <div class="d-flex justify-content-between
                    align-items-center mb-4">

                    <div>

                        <h5 class="card-title mb-1">

                            <i
                                class="mdi mdi-face-recognition text-primary me-1">
                            </i>

                            Verifikasi Wajah

                        </h5>

                        <p class="text-muted small mb-0">

                            Posisikan wajah Anda di depan kamera.

                        </p>

                    </div>


                    <span
                        class="badge bg-light text-primary
                        border px-3 py-2">

                        <i
                            class="mdi mdi-shield-check-outline me-1">
                        </i>

                        Face Verification

                    </span>

                </div>


                <form
                    action="{{ route('siswa.absensi.masuk.store') }}"
                    method="POST"
                    id="formAbsensi"
                    data-verify-url="{{ route('siswa.absensi.verify-face') }}">

                    @csrf


                    {{-- GPS --}}

                    <input
                        type="hidden"
                        name="latitude"
                        id="latitude">

                    <input
                        type="hidden"
                        name="longitude"
                        id="longitude">


                    {{-- FOTO --}}

                    <input
                        type="hidden"
                        name="foto_masuk"
                        id="fotoMasuk">


                    {{-- =================================================
                         AREA KAMERA
                    ================================================== --}}

                    <div
                        id="cameraWrapper"
                        class="bg-light rounded-3 p-3">

                        <div
                            id="cameraPlaceholder"
                            class="text-center py-5">

                            <div
                                class="rounded-circle bg-white
                                d-flex align-items-center
                                justify-content-center mx-auto mb-3
                                shadow-sm"
                                style="width:82px;height:82px;">

                                <i
                                    class="mdi mdi-camera-outline text-primary"
                                    style="font-size:42px;">
                                </i>

                            </div>

                            <h6 class="fw-bold mb-2">

                                Kamera Belum Aktif

                            </h6>

                            <p class="text-muted small mb-0">

                                Klik tombol di bawah untuk memulai
                                verifikasi wajah.

                            </p>

                        </div>


                        <div
                            id="cameraContainer"
                            style="display:none;">

                            <div
                                class="position-relative overflow-hidden
                                rounded-3 bg-dark">

                                <video
                                    id="video"
                                    width="100%"
                                    autoplay
                                    playsinline
                                    class="d-block"
                                    style="
                                        width:100%;
                                        max-height:430px;
                                        object-fit:cover;
                                    ">
                                </video>


                                {{-- CAMERA LABEL --}}

                                <div
                                    class="position-absolute top-0 start-0
                                    m-3">

                                    <span
                                        class="badge bg-dark bg-opacity-75
                                        px-3 py-2">

                                        <i
                                            class="mdi mdi-camera-outline me-1">
                                        </i>

                                        Kamera Aktif

                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         STATUS
                    ================================================== --}}

                    <div
                        id="statusWajah"
                        class="alert alert-info border-0
                        d-flex align-items-center mt-3 mb-3">

                        <i
                            class="mdi mdi-information-outline me-2"
                            style="font-size:21px;">
                        </i>

                        <span>
                            Menunggu Scan Wajah...
                        </span>

                    </div>


                    {{-- =================================================
                         BUTTON
                    ================================================== --}}

                    <div class="d-flex gap-2">

                        <button
                            type="button"
                            id="btnBukaKamera"
                            class="btn btn-primary flex-grow-1">

                            <i class="mdi mdi-camera-outline me-1"></i>

                            Mulai Scan Wajah

                        </button>


                        <button
                            type="submit"
                            id="btnSubmit"
                            class="btn btn-success flex-grow-1"
                            disabled>

                            <i class="mdi mdi-check-circle-outline me-1"></i>

                            Kirim Absensi

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- =====================================================
         DATA VERIFIKASI
    ====================================================== --}}

    <div class="col-lg-4 grid-margin stretch-card">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">


                {{-- HEADER --}}

                <div class="d-flex align-items-center mb-4">

                    <div
                        class="rounded-3 bg-primary bg-opacity-10
                        d-flex align-items-center justify-content-center me-3"
                        style="width:42px;height:42px;">

                        <i
                            class="mdi mdi-account-check-outline text-primary"
                            style="font-size:22px;">
                        </i>

                    </div>

                    <div>

                        <h5 class="card-title mb-1">
                            Data Verifikasi
                        </h5>

                        <p class="text-muted small mb-0">
                            Status identitas Anda.
                        </p>

                    </div>

                </div>


                {{-- =================================================
                     BELUM VERIFIKASI
                ================================================== --}}

                <div
                    id="belumVerifikasi"
                    class="text-center py-4">

                    <div
                        class="rounded-circle bg-light
                        d-flex align-items-center
                        justify-content-center mx-auto mb-3"
                        style="width:76px;height:76px;">

                        <i
                            class="mdi mdi-face-recognition text-muted"
                            style="font-size:39px;">
                        </i>

                    </div>

                    <h6 class="fw-bold mb-1">

                        Belum Terverifikasi

                    </h6>

                    <p class="text-muted small mb-0">

                        Lakukan scan wajah terlebih dahulu
                        untuk memverifikasi identitas.

                    </p>

                </div>


                {{-- =================================================
                     SUDAH VERIFIKASI
                ================================================== --}}

                <div
                    id="dataSiswa"
                    style="display:none;">


                    {{-- STATUS --}}

                    <div
                        class="bg-success bg-opacity-10
                        rounded-3 p-3 mb-4">

                        <div class="d-flex align-items-center">

                            <div
                                class="rounded-circle bg-success
                                d-flex align-items-center
                                justify-content-center me-3"
                                style="width:40px;height:40px;">

                                <i
                                    class="mdi mdi-check text-white"
                                    style="font-size:22px;">
                                </i>

                            </div>

                            <div>

                                <h6 class="fw-bold text-success mb-0">

                                    Wajah Terverifikasi

                                </h6>

                                <small class="text-muted">

                                    Identitas berhasil dikenali.

                                </small>

                            </div>

                        </div>

                    </div>


                    {{-- DATA --}}

                    <div class="border rounded-3 p-3 mb-3">

                        <small class="text-muted d-block mb-1">

                            Nama Siswa

                        </small>

                        <h6 class="fw-semibold mb-0">

                            {{ $siswa->user->name ?? auth()->user()->name }}

                        </h6>

                    </div>


                    <div class="border rounded-3 p-3 mb-3">

                        <small class="text-muted d-block mb-1">

                            Status

                        </small>

                        <span
                            class="badge bg-success px-3 py-2">

                            <i
                                class="mdi mdi-check-circle-outline me-1">
                            </i>

                            Terverifikasi

                        </span>

                    </div>


                    <div class="border rounded-3 p-3">

                        <small class="text-muted d-block mb-1">

                            Waktu Verifikasi

                        </small>

                        <h6
                            class="fw-semibold mb-0"
                            id="jamScan">

                            -

                        </h6>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     INFORMASI ABSENSI
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="row align-items-center">


                    <div class="col-md-4 mb-3 mb-md-0">

                        <div class="d-flex align-items-center">

                            <div
                                class="rounded-3 bg-primary bg-opacity-10
                                d-flex align-items-center justify-content-center
                                me-3"
                                style="width:42px;height:42px;">

                                <i
                                    class="mdi mdi-map-marker-radius-outline
                                    text-primary"
                                    style="font-size:22px;">
                                </i>

                            </div>

                            <div>

                                <small class="text-muted d-block">
                                    Lokasi
                                </small>

                                <span class="fw-semibold">
                                    GPS otomatis
                                </span>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-4 mb-3 mb-md-0">

                        <div class="d-flex align-items-center">

                            <div
                                class="rounded-3 bg-success bg-opacity-10
                                d-flex align-items-center justify-content-center
                                me-3"
                                style="width:42px;height:42px;">

                                <i
                                    class="mdi mdi-face-recognition
                                    text-success"
                                    style="font-size:22px;">
                                </i>

                            </div>

                            <div>

                                <small class="text-muted d-block">
                                    Verifikasi
                                </small>

                                <span class="fw-semibold">
                                    Pengenalan wajah
                                </span>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="d-flex align-items-center">

                            <div
                                class="rounded-3 bg-warning bg-opacity-10
                                d-flex align-items-center justify-content-center
                                me-3"
                                style="width:42px;height:42px;">

                                <i
                                    class="mdi mdi-shield-check-outline
                                    text-warning"
                                    style="font-size:22px;">
                                </i>

                            </div>

                            <div>

                                <small class="text-muted d-block">
                                    Keamanan
                                </small>

                                <span class="fw-semibold">
                                    Data terlindungi
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection


@push('scripts')

<script>
    document.addEventListener(
        'DOMContentLoaded',
        function() {


            /*
            |--------------------------------------------------------------------------
            | ELEMENT
            |--------------------------------------------------------------------------
            */

            const formAbsensi =
                document.getElementById(
                    'formAbsensi'
                );


            const btnKamera =
                document.getElementById(
                    'btnBukaKamera'
                );


            const btnSubmit =
                document.getElementById(
                    'btnSubmit'
                );


            const video =
                document.getElementById(
                    'video'
                );


            const statusWajah =
                document.getElementById(
                    'statusWajah'
                );


            const cameraContainer =
                document.getElementById(
                    'cameraContainer'
                );


            const cameraPlaceholder =
                document.getElementById(
                    'cameraPlaceholder'
                );


            const fotoMasuk =
                document.getElementById(
                    'fotoMasuk'
                );


            /*
            |--------------------------------------------------------------------------
            | URL VERIFIKASI
            |--------------------------------------------------------------------------
            */

            const verifyFaceUrl =
                formAbsensi.dataset.verifyUrl;


            /*
            |--------------------------------------------------------------------------
            | VARIABLE
            |--------------------------------------------------------------------------
            */

            let stream = null;

            let verified = false;

            let scanCount = 0;

            let scanInterval = null;

            let isScanning = false;


            /*
            |--------------------------------------------------------------------------
            | GPS
            |--------------------------------------------------------------------------
            */

            if (
                navigator.geolocation
            ) {

                navigator.geolocation.getCurrentPosition(

                    function(position) {

                        document.getElementById(
                                'latitude'
                            ).value =
                            position.coords.latitude;


                        document.getElementById(
                                'longitude'
                            ).value =
                            position.coords.longitude;

                    },

                    function() {

                        statusWajah.innerHTML =
                            '<i class="mdi mdi-alert-outline me-2"></i>' +
                            '<span>Lokasi GPS tidak dapat diperoleh.</span>';

                    },

                    {
                        enableHighAccuracy: true,
                        timeout: 15000,
                        maximumAge: 0
                    }

                );

            }


            /*
            |--------------------------------------------------------------------------
            | TOMBOL KAMERA
            |--------------------------------------------------------------------------
            */

            btnKamera.addEventListener(
                'click',
                startCamera
            );


            /*
            |--------------------------------------------------------------------------
            | START CAMERA
            |--------------------------------------------------------------------------
            */

            async function startCamera() {

                if (verified) {

                    return;

                }


                try {

                    stream =
                        await navigator
                        .mediaDevices
                        .getUserMedia({

                            video: {
                                facingMode: 'user'
                            },

                            audio: false

                        });


                    cameraPlaceholder.style.display =
                        'none';


                    cameraContainer.style.display =
                        'block';


                    video.srcObject =
                        stream;


                    statusWajah.className =
                        'alert alert-info border-0 d-flex align-items-center mt-3 mb-3';


                    statusWajah.innerHTML =
                        '<i class="mdi mdi-loading mdi-spin me-2"></i>' +
                        '<span>Memulai scan wajah...</span>';


                    btnKamera.innerHTML =
                        '<i class="mdi mdi-camera-outline me-1"></i> Kamera Aktif';


                    verified = false;

                    scanCount = 0;

                    isScanning = false;


                    startFaceScan();

                } catch (error) {

                    console.error(
                        error
                    );


                    statusWajah.className =
                        'alert alert-danger border-0 d-flex align-items-center mt-3 mb-3';


                    statusWajah.innerHTML =
                        '<i class="mdi mdi-camera-off-outline me-2"></i>' +
                        '<span>Kamera tidak dapat diakses.</span>';


                    alert(
                        'Kamera tidak dapat diakses. Pastikan izin kamera diberikan.'
                    );

                }

            }


            /*
            |--------------------------------------------------------------------------
            | SCAN WAJAH
            |--------------------------------------------------------------------------
            */

            function startFaceScan() {

                if (scanInterval) {

                    clearInterval(
                        scanInterval
                    );

                }


                scanInterval =
                    setInterval(
                        async function() {

                                if (verified) {

                                    clearInterval(
                                        scanInterval
                                    );

                                    scanInterval =
                                        null;

                                    return;

                                }


                                if (isScanning) {

                                    return;

                                }


                                isScanning = true;

                                scanCount++;


                                statusWajah.className =
                                    'alert alert-info border-0 d-flex align-items-center mt-3 mb-3';


                                statusWajah.innerHTML =
                                    '<i class="mdi mdi-loading mdi-spin me-2"></i>' +
                                    '<span>Memindai wajah... Scan ke-' +
                                    scanCount +
                                    '</span>';


                                if (
                                    !video.videoWidth
                                ) {

                                    isScanning = false;

                                    return;

                                }


                                /*
                                |--------------------------------------------------------------------------
                                | CANVAS
                                |--------------------------------------------------------------------------
                                */

                                const canvas =
                                    document.createElement(
                                        'canvas'
                                    );


                                canvas.width =
                                    video.videoWidth;


                                canvas.height =
                                    video.videoHeight;


                                const context =
                                    canvas.getContext(
                                        '2d'
                                    );


                                context.drawImage(
                                    video,
                                    0,
                                    0,
                                    canvas.width,
                                    canvas.height
                                );


                                /*
                                |--------------------------------------------------------------------------
                                | BASE64
                                |--------------------------------------------------------------------------
                                */

                                const image =
                                    canvas.toDataURL(
                                        'image/jpeg',
                                        0.85
                                    );


                                try {

                                    /*
                                    |--------------------------------------------------------------------------
                                    | REQUEST KE LARAVEL
                                    |--------------------------------------------------------------------------
                                    */

                                    const response =
                                        await fetch(
                                            verifyFaceUrl, {

                                                method: 'POST',

                                                headers: {

                                                    'Content-Type': 'application/json',

                                                    'Accept': 'application/json',

                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'

                                                },

                                                body: JSON.stringify({

                                                    image: image

                                                })

                                            }
                                        );


                                    const result =
                                        await response.json();


                                    isScanning = false;


                                    /*
                                    |--------------------------------------------------------------------------
                                    | WAJAH BERHASIL
                                    |--------------------------------------------------------------------------
                                    */

                                    if (
                                        result.verified === true
                                    ) {

                                        verified = true;


                                        clearInterval(
                                            scanInterval
                                        );


                                        scanInterval =
                                            null;


                                        btnKamera.disabled =
                                            true;


                                        btnKamera.classList.remove(
                                            'btn-primary'
                                        );


                                        btnKamera.classList.add(
                                            'btn-success'
                                        );


                                        btnKamera.innerHTML =
                                            '<i class="mdi mdi-check-circle-outline me-1"></i> Wajah Terverifikasi';


                                        fotoMasuk.value =
                                            image;


                                        statusWajah.className =
                                            'alert alert-success border-0 d-flex align-items-center mt-3 mb-3';


                                        statusWajah.innerHTML =
                                            '<i class="mdi mdi-check-circle-outline me-2"></i>' +
                                            '<span>Wajah berhasil diverifikasi.</span>';


                                        btnSubmit.disabled =
                                            false;


                                        btnSubmit.innerHTML =
                                            '<i class="mdi mdi-check-circle-outline me-1"></i> Kirim Absensi';


                                        document.getElementById(
                                                'dataSiswa'
                                            ).style.display =
                                            'block';


                                        document.getElementById(
                                                'belumVerifikasi'
                                            ).style.display =
                                            'none';


                                        document.getElementById(
                                                'jamScan'
                                            ).innerHTML =
                                            new Date()
                                            .toLocaleTimeString(
                                                'id-ID', {
                                                    timeZone: 'Asia/Jakarta'
                                                }
                                            );


                                        /*
                                        |--------------------------------------------------------------------------
                                        | STOP CAMERA
                                        |--------------------------------------------------------------------------
                                        */

                                        if (stream) {

                                            stream
                                                .getTracks()
                                                .forEach(
                                                    function(track) {

                                                        track.stop();

                                                    }
                                                );

                                            stream = null;

                                        }


                                        cameraContainer.style.display =
                                            'none';


                                        return;

                                    }


                                    /*
                                    |--------------------------------------------------------------------------
                                    | WAJAH TIDAK TERDETEKSI
                                    |--------------------------------------------------------------------------
                                    */

                                    if (
                                        result.message ===
                                        'Wajah tidak terdeteksi'
                                    ) {

                                        statusWajah.className =
                                            'alert alert-warning border-0 d-flex align-items-center mt-3 mb-3';


                                        statusWajah.innerHTML =
                                            '<i class="mdi mdi-face-outline me-2"></i>' +
                                            '<span>Wajah tidak terdeteksi. Posisikan wajah di depan kamera.</span>';

                                    } else {

                                        statusWajah.className =
                                            'alert alert-danger border-0 d-flex align-items-center mt-3 mb-3';


                                        statusWajah.innerHTML =
                                            '<i class="mdi mdi-face-recognition me-2"></i>' +
                                            '<span>Wajah tidak sesuai. Scan ke-' +
                                            scanCount +
                                            '</span>';

                                    }


                                } catch (error) {

                                    console.error(
                                        error
                                    );


                                    isScanning = false;


                                    statusWajah.className =
                                        'alert alert-warning border-0 d-flex align-items-center mt-3 mb-3';


                                    statusWajah.innerHTML =
                                        '<i class="mdi mdi-server-network-off me-2"></i>' +
                                        '<span>Gagal menghubungi server AI.</span>';

                                }

                            },
                            2000
                    );

            }


            /*
            |--------------------------------------------------------------------------
            | SUBMIT
            |--------------------------------------------------------------------------
            */

            formAbsensi.addEventListener(
                'submit',
                function(event) {

                    if (!verified) {

                        event.preventDefault();

                        return;

                    }


                    btnSubmit.disabled =
                        true;


                    btnSubmit.innerHTML =
                        '<i class="mdi mdi-loading mdi-spin me-1"></i> Memproses...';

                }
            );

        }
    );
</script>

@endpush