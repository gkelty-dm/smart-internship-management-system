@extends('layouts.skydash-siswa')

@section('title', 'Absen Pulang')

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
                            class="mdi mdi-logout-variant text-primary"
                            style="font-size:27px;">
                        </i>

                    </div>

                    <div>

                        <h4 class="fw-bold mb-1">
                            Absen Pulang
                        </h4>

                        <p class="text-muted mb-0">
                            Lakukan verifikasi wajah dan lokasi untuk mencatat
                            waktu kepulangan Anda.
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
     CONTENT
========================================================= --}}

<div class="row">


    {{-- =====================================================
         KAMERA / VERIFIKASI
    ====================================================== --}}

    <div class="col-lg-8 grid-margin stretch-card">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">


                {{-- HEADER CARD --}}

                <div class="d-flex justify-content-between
                    align-items-center mb-4">

                    <div>

                        <h5 class="card-title mb-1">

                            <i
                                class="mdi mdi-face-recognition
                                text-primary me-1">
                            </i>

                            Verifikasi Wajah

                        </h5>

                        <p class="text-muted small mb-0">

                            Pastikan wajah terlihat jelas
                            sebelum melakukan absensi.

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


                {{-- =================================================
                     BELUM ABSEN MASUK
                ================================================== --}}

                @if(!$absensiHariIni)

                <div
                    class="text-center py-5">

                    <div
                        class="rounded-circle bg-warning bg-opacity-10
                        d-flex align-items-center justify-content-center
                        mx-auto mb-3"
                        style="width:82px;height:82px;">

                        <i
                            class="mdi mdi-login-variant text-warning"
                            style="font-size:42px;">
                        </i>

                    </div>

                    <h5 class="fw-bold mb-2">

                        Belum Absen Masuk

                    </h5>

                    <p
                        class="text-muted mb-0"
                        style="max-width:420px;margin:auto;">

                        Anda harus melakukan absen masuk
                        terlebih dahulu sebelum dapat melakukan
                        absen pulang.

                    </p>

                </div>


                {{-- =================================================
                     SUDAH ABSEN PULANG
                ================================================== --}}

                @elseif($absensiHariIni->jam_pulang)

                <div
                    class="text-center py-5">

                    <div
                        class="rounded-circle bg-success bg-opacity-10
                        d-flex align-items-center justify-content-center
                        mx-auto mb-3"
                        style="width:82px;height:82px;">

                        <i
                            class="mdi mdi-check-circle-outline text-success"
                            style="font-size:45px;">
                        </i>

                    </div>

                    <h5 class="fw-bold mb-2">

                        Absensi Pulang Selesai

                    </h5>

                    <p class="text-muted mb-3">

                        Anda sudah melakukan absensi pulang
                        untuk hari ini.

                    </p>

                    <span
                        class="badge bg-success px-3 py-2">

                        <i
                            class="mdi mdi-clock-check-outline me-1">
                        </i>

                        {{ $absensiHariIni->jam_pulang }}

                    </span>

                </div>


                {{-- =================================================
                     FORM ABSEN PULANG
                ================================================== --}}

                @else

                <form
                    action="{{ route('siswa.absensi.pulang.store') }}"
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
                        name="foto_pulang"
                        id="fotoPulang">


                    {{-- =================================================
                         CAMERA AREA
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
                                justify-content-center
                                mx-auto mb-3 shadow-sm"
                                style="width:82px;height:82px;">

                                <i
                                    class="mdi mdi-camera-outline
                                    text-primary"
                                    style="font-size:42px;">
                                </i>

                            </div>

                            <h6 class="fw-bold mb-2">

                                Kamera Belum Aktif

                            </h6>

                            <p class="text-muted small mb-0">

                                Klik tombol di bawah untuk
                                memulai verifikasi wajah.

                            </p>

                        </div>


                        {{-- CAMERA --}}

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


                                <div
                                    class="position-absolute
                                    top-0 start-0 m-3">

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

                            <i
                                class="mdi mdi-camera-outline me-1">
                            </i>

                            Mulai Scan Wajah

                        </button>


                        <button
                            type="submit"
                            id="btnSubmit"
                            class="btn btn-success flex-grow-1"
                            disabled>

                            <i
                                class="mdi mdi-check-circle-outline me-1">
                            </i>

                            Kirim Absensi Pulang

                        </button>

                    </div>

                </form>

                @endif

            </div>

        </div>

    </div>


    {{-- =====================================================
         STATUS ABSENSI
    ====================================================== --}}

    <div class="col-lg-4 grid-margin stretch-card">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">


                {{-- HEADER --}}

                <div class="d-flex align-items-center mb-4">

                    <div
                        class="rounded-3 bg-primary bg-opacity-10
                        d-flex align-items-center
                        justify-content-center me-3"
                        style="width:44px;height:44px;">

                        <i
                            class="mdi mdi-account-card-details-outline
                            text-primary"
                            style="font-size:23px;">
                        </i>

                    </div>

                    <div>

                        <h5 class="card-title mb-1">

                            Status Absensi

                        </h5>

                        <p class="text-muted small mb-0">

                            Informasi kehadiran hari ini.

                        </p>

                    </div>

                </div>


                {{-- =================================================
                     DATA SISWA
                ================================================== --}}

                <div
                    class="border rounded-3 p-3 mb-3">

                    <small class="text-muted d-block mb-1">
                        Nama Siswa
                    </small>

                    <h6 class="fw-semibold mb-0">

                        {{ $siswa->user->name ?? auth()->user()->name }}

                    </h6>

                </div>


                {{-- PERUSAHAAN --}}

                <div
                    class="border rounded-3 p-3 mb-3">

                    <small class="text-muted d-block mb-1">
                        Perusahaan
                    </small>

                    <h6 class="fw-semibold mb-0">

                        {{ $penempatan->perusahaan->nama_perusahaan ?? '-' }}

                    </h6>

                </div>


                @if($absensiHariIni)

                {{-- JAM MASUK --}}

                <div
                    class="border rounded-3 p-3 mb-3">

                    <small class="text-muted d-block mb-1">
                        Jam Masuk
                    </small>

                    <div class="d-flex align-items-center">

                        <div
                            class="rounded-circle bg-success bg-opacity-10
                            d-flex align-items-center
                            justify-content-center me-2"
                            style="width:36px;height:36px;">

                            <i
                                class="mdi mdi-login-variant text-success">
                            </i>

                        </div>

                        <h6 class="fw-semibold mb-0">

                            {{ $absensiHariIni->jam_masuk ?? '-' }}

                        </h6>

                    </div>

                </div>


                {{-- SUDAH PULANG --}}

                @if($absensiHariIni->jam_pulang)

                <div
                    class="bg-success bg-opacity-10
                    rounded-3 p-3">

                    <div class="d-flex align-items-center">

                        <div
                            class="rounded-circle bg-success
                            d-flex align-items-center
                            justify-content-center me-3"
                            style="width:42px;height:42px;">

                            <i
                                class="mdi mdi-check text-white"
                                style="font-size:23px;">
                            </i>

                        </div>

                        <div>

                            <h6
                                class="fw-bold text-success mb-1">

                                Sudah Absen Pulang

                            </h6>

                            <small class="text-muted">

                                {{ $absensiHariIni->jam_pulang }}

                            </small>

                        </div>

                    </div>

                </div>

                @else

                {{-- HASIL VERIFIKASI --}}

                <div
                    id="dataSiswa"
                    class="bg-success bg-opacity-10
                    rounded-3 p-3"
                    style="display:none;">

                    <div class="d-flex align-items-center">

                        <div
                            class="rounded-circle bg-success
                            d-flex align-items-center
                            justify-content-center me-3"
                            style="width:42px;height:42px;">

                            <i
                                class="mdi mdi-check text-white"
                                style="font-size:23px;">
                            </i>

                        </div>

                        <div>

                            <h6
                                class="fw-bold text-success mb-1">

                                Wajah Terverifikasi

                            </h6>

                            <small class="text-muted">

                                Waktu Scan:

                                <strong id="jamScan">
                                    -
                                </strong>

                            </small>

                        </div>

                    </div>

                </div>

                @endif

                @endif

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     INFORMASI SISTEM
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="row">


                    <div class="col-md-4 mb-3 mb-md-0">

                        <div class="d-flex align-items-center">

                            <div
                                class="rounded-3 bg-primary bg-opacity-10
                                d-flex align-items-center
                                justify-content-center me-3"
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
                                    GPS Otomatis
                                </span>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-4 mb-3 mb-md-0">

                        <div class="d-flex align-items-center">

                            <div
                                class="rounded-3 bg-success bg-opacity-10
                                d-flex align-items-center
                                justify-content-center me-3"
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
                                    Pengenalan Wajah
                                </span>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="d-flex align-items-center">

                            <div
                                class="rounded-3 bg-warning bg-opacity-10
                                d-flex align-items-center
                                justify-content-center me-3"
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
                                    Data Terlindungi
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


{{-- =========================================================
     STYLE KAMERA
========================================================= --}}

<style>
    #video {
        transform: scaleX(-1);
    }
</style>


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


            /*
            |--------------------------------------------------------------------------
            | JIKA FORM TIDAK ADA
            |--------------------------------------------------------------------------
            */

            if (!formAbsensi || !btnKamera) {

                return;

            }


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


            const fotoPulang =
                document.getElementById(
                    'fotoPulang'
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

                        statusWajah.className =
                            'alert alert-warning border-0 d-flex align-items-center mt-3 mb-3';

                        statusWajah.innerHTML =
                            '<i class="mdi mdi-map-marker-off-outline me-2"></i>' +
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
            | BUKA KAMERA
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
                                | FOTO
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
                                    | REQUEST
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
                                    | BERHASIL
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


                                        fotoPulang.value =
                                            image;


                                        statusWajah.className =
                                            'alert alert-success border-0 d-flex align-items-center mt-3 mb-3';


                                        statusWajah.innerHTML =
                                            '<i class="mdi mdi-check-circle-outline me-2"></i>' +
                                            '<span>Wajah berhasil diverifikasi.</span>';


                                        btnSubmit.disabled =
                                            false;


                                        btnSubmit.innerHTML =
                                            '<i class="mdi mdi-check-circle-outline me-1"></i> Kirim Absensi Pulang';


                                        const dataSiswa =
                                            document.getElementById(
                                                'dataSiswa'
                                            );


                                        if (dataSiswa) {

                                            dataSiswa.style.display =
                                                'block';

                                        }


                                        const jamScan =
                                            document.getElementById(
                                                'jamScan'
                                            );


                                        if (jamScan) {

                                            jamScan.innerHTML =
                                                new Date()
                                                .toLocaleTimeString(
                                                    'id-ID', {
                                                        timeZone: 'Asia/Jakarta'
                                                    }
                                                );

                                        }


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
                                    | GAGAL
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