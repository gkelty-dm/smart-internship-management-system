@extends('layouts.skydash-siswa')

@section('title', 'Registrasi Wajah')

@section('content')

<div class="row">

    <div class="col-12">

        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">

            <div>

                <h4 class="font-weight-bold mb-1">
                    Registrasi Wajah
                </h4>

                <p class="text-muted mb-0">
                    Kelola data wajah yang digunakan untuk verifikasi absensi PKL.
                </p>

            </div>

            <a
                href="{{ route('siswa.dashboard') }}"
                class="btn btn-light mt-3 mt-md-0">

                <i class="mdi mdi-arrow-left me-1"></i>

                Kembali

            </a>

        </div>

    </div>

</div>


{{-- =========================================================
     STATUS REGISTRASI
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex align-items-center justify-content-between flex-wrap">

                    <div class="d-flex align-items-center">

                        <div
                            class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center"
                            style="width:55px;height:55px;">

                            <i
                                class="mdi mdi-face-recognition"
                                style="font-size:27px;">
                            </i>

                        </div>

                        <div class="ms-3">

                            <h5 class="font-weight-bold mb-1">
                                Status Registrasi
                            </h5>

                            <p class="text-muted mb-0">
                                Status data wajah Anda pada sistem.
                            </p>

                        </div>

                    </div>


                    <div class="mt-3 mt-md-0">

                        @if($jumlahFoto >= 5)

                        <span class="badge bg-success px-3 py-2">

                            <i class="mdi mdi-check-circle me-1"></i>

                            Registrasi Lengkap

                        </span>

                        @else

                        <span class="badge bg-warning text-dark px-3 py-2">

                            <i class="mdi mdi-clock-outline me-1"></i>

                            Belum Lengkap

                        </span>

                        @endif

                    </div>

                </div>


                <div class="row mt-4">

                    <div class="col-md-8">

                        <div class="progress"
                            style="height:8px;">

                            <div
                                id="progressBar"
                                class="progress-bar bg-primary"
                                role="progressbar">
                            </div>

                        </div>

                    </div>


                    <div class="col-md-4 text-md-end mt-2 mt-md-0">

                        <span class="font-weight-bold text-primary">

                            <span id="jumlahFoto">
                                {{ $jumlahFoto }}
                            </span>

                            / 5 Foto

                        </span>

                        <small
                            id="progressText"
                            class="text-muted ms-2">

                            @if($jumlahFoto >= 5)

                            Lengkap

                            @else

                            Belum lengkap

                            @endif

                        </small>

                    </div>

                </div>


                @if($jumlahFoto >= 5)

                <div class="alert alert-success mt-4 mb-0">

                    <div class="d-flex align-items-start">

                        <i
                            class="mdi mdi-check-decagram me-2"
                            style="font-size:22px;">
                        </i>

                        <div>

                            <strong>
                                Wajah sudah siap digunakan.
                            </strong>

                            <div class="small mt-1">
                                Data wajah Anda telah lengkap dan dapat digunakan untuk verifikasi absensi PKL.
                            </div>

                        </div>

                    </div>

                </div>

                @else

                <div class="alert alert-info mt-4 mb-0">

                    <i class="mdi mdi-information-outline me-1"></i>

                    Lengkapi registrasi sampai 5 foto agar fitur absensi wajah dapat digunakan.

                </div>

                @endif

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     KAMERA
========================================================= --}}

@if($jumlahFoto < 5)

    <div class="row justify-content-center">

    <div class="col-lg-8 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="text-center mb-4">

                    <div
                        class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center mx-auto"
                        style="width:65px;height:65px;">

                        <i
                            class="mdi mdi-camera-outline"
                            style="font-size:32px;">
                        </i>

                    </div>

                    <h4 class="font-weight-bold mt-3 mb-1">
                        Registrasi Wajah
                    </h4>

                    <p class="text-muted mb-0">
                        Posisikan wajah Anda di tengah kamera.
                    </p>

                </div>


                <div
                    id="cameraWrapper"
                    style="
                        position:relative;
                        width:100%;
                        max-width:480px;
                        margin:0 auto;
                        background:#111;
                        border-radius:16px;
                        overflow:hidden;
                        aspect-ratio:3/4;
                    ">

                    <video
                        id="video"
                        autoplay
                        muted
                        playsinline
                        style="
                            width:100%;
                            height:100%;
                            object-fit:cover;
                            transform:scaleX(-1);
                            display:block;
                        ">
                    </video>


                    <div
                        id="cameraOverlay"
                        style="
                            position:absolute;
                            inset:0;
                            pointer-events:none;
                        ">

                        <div
                            id="faceFrame"
                            style="
                                position:absolute;
                                width:56%;
                                height:67%;
                                left:50%;
                                top:48%;
                                transform:translate(-50%,-50%);
                                border:4px solid #dc3545;
                                border-radius:50%;
                                transition:border-color .25s ease;
                            ">
                        </div>

                    </div>


                    <div
                        style="
                            position:absolute;
                            top:15px;
                            left:15px;
                            background:rgba(0,0,0,.65);
                            color:#fff;
                            padding:7px 12px;
                            border-radius:20px;
                            font-size:11px;
                        ">

                        <span
                            style="
                                display:inline-block;
                                width:7px;
                                height:7px;
                                border-radius:50%;
                                background:#28a745;
                                margin-right:5px;
                            ">
                        </span>

                        Kamera Aktif

                    </div>


                    <div
                        style="
                            position:absolute;
                            left:50%;
                            bottom:18px;
                            transform:translateX(-50%);
                            background:rgba(0,0,0,.68);
                            color:#fff;
                            padding:8px 15px;
                            border-radius:20px;
                            font-size:11px;
                            white-space:nowrap;
                        ">

                        <i class="mdi mdi-face-recognition me-1"></i>

                        Posisikan wajah di tengah

                    </div>

                </div>


                <div
                    id="faceStatus"
                    class="alert alert-info mt-4 text-center">

                    <i class="mdi mdi-clock-outline me-1"></i>

                    Menunggu deteksi wajah...

                </div>


                <div
                    id="countdown"
                    class="text-center text-primary font-weight-bold"
                    style="
                        min-height:50px;
                        font-size:40px;
                        line-height:50px;
                    ">
                </div>


                <p class="text-muted text-center small mb-0">

                    Foto akan diambil otomatis setelah wajah berhasil terdeteksi.

                </p>

            </div>

        </div>

    </div>

    </div>

    @endif


    {{-- =========================================================
     REGISTRASI SELESAI
========================================================= --}}

    @if($jumlahFoto >= 5)

    <div class="row">

        <div class="col-12 grid-margin stretch-card">

            <div class="card">

                <div class="card-body">

                    {{-- HEADER SELESAI --}}

                    <div class="text-center py-3">

                        <div
                            class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center mx-auto"
                            style="width:80px;height:80px;">

                            <i
                                class="mdi mdi-check-decagram"
                                style="font-size:45px;">
                            </i>

                        </div>

                        <h3 class="font-weight-bold mt-3 mb-2">
                            Registrasi Wajah Selesai
                        </h3>

                        <p class="text-muted mb-0">
                            Data wajah Anda sudah siap digunakan untuk absensi PKL.
                        </p>

                    </div>


                    {{-- PEMBATAS --}}

                    <hr class="my-4">


                    {{-- JUDUL GALERI --}}

                    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">

                        <div>

                            <h5 class="font-weight-bold mb-1">
                                Foto Wajah Terdaftar
                            </h5>

                            <p class="text-muted mb-0">
                                Lima foto wajah yang tersimpan untuk verifikasi.
                            </p>

                        </div>


                        <span class="badge bg-success px-3 py-2 mt-2 mt-md-0">

                            <i class="mdi mdi-image-check-outline me-1"></i>

                            {{ $profile->images->count() }} / 5

                        </span>

                    </div>


                    {{-- =================================================
                     GALERI BOOTSTRAP 5
                     5 FOTO = 1 BARIS
                ================================================== --}}

                    <div class="row g-3">

                        @forelse($profile->images as $foto)

                        <div class="col-12 col-sm-6 col-md-4 col-lg">

                            <div
                                class="card h-100 border"
                                style="
                                    border-radius:12px;
                                    overflow:hidden;
                                ">

                                {{-- FOTO --}}

                                <div
                                    class="bg-light d-flex align-items-center justify-content-center"
                                    style="
                                        width:100%;
                                        height:250px;
                                        padding:10px;
                                    ">

                                    <img
                                        src="{{ Storage::url($foto->file_path) }}"
                                        alt="Foto wajah"
                                        class="img-fluid"
                                        style="
                                            max-width:100%;
                                            max-height:230px;
                                            width:auto;
                                            height:auto;
                                            object-fit:contain;
                                            display:block;
                                        ">

                                </div>


                                {{-- STATUS --}}

                                <div
                                    class="text-center py-2 border-top"
                                    style="background:#fff;">

                                    <span class="text-success small font-weight-bold">

                                        <i class="mdi mdi-check-circle me-1"></i>

                                        Terdaftar

                                    </span>

                                </div>

                            </div>

                        </div>

                        @empty

                        <div class="col-12">

                            <div class="text-center py-5">

                                <i
                                    class="mdi mdi-image-off-outline text-muted"
                                    style="font-size:50px;">
                                </i>

                                <h6 class="font-weight-bold mt-3">
                                    Belum Ada Foto
                                </h6>

                                <p class="text-muted mb-0">
                                    Foto registrasi belum tersedia.
                                </p>

                            </div>

                        </div>

                        @endforelse

                    </div>

                </div>

            </div>

        </div>

    </div>

    @endif


    {{-- =========================================================
     CANVAS
========================================================= --}}

    <canvas
        id="canvas"
        class="d-none">
    </canvas>


    {{-- =========================================================
     CONFIG
     ROUTE TETAP - JANGAN DIUBAH
========================================================= --}}

    <div
        id="faceConfig"
        data-detect-url="{{ route('face.detect') }}"
        data-store-url="{{ route('siswa.face.register.store') }}"
        data-count="{{ $jumlahFoto }}"
        data-max="5"
        data-csrf="{{ csrf_token() }}"
        style="display:none;">
    </div>


    @endsection


    {{-- =========================================================
     JAVASCRIPT
========================================================= --}}

    @push('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const config =
                document.getElementById('faceConfig');

            if (!config) {
                return;
            }


            const detectUrl =
                config.dataset.detectUrl;

            const storeUrl =
                config.dataset.storeUrl;

            const csrfToken =
                config.dataset.csrf;

            const maxFoto =
                Number(config.dataset.max);


            let jumlahFoto =
                Number(config.dataset.count);


            const video =
                document.getElementById('video');

            const canvas =
                document.getElementById('canvas');

            const faceStatus =
                document.getElementById('faceStatus');

            const faceFrame =
                document.getElementById('faceFrame');

            const countdown =
                document.getElementById('countdown');


            if (!video) {
                return;
            }


            let stream = null;

            let detectInterval = null;

            let countdownInterval = null;

            let sedangMendeteksi = false;

            let sedangMengambilFoto = false;

            let faceDetected = false;


            function updateProgress() {

                const progressBar =
                    document.getElementById('progressBar');

                const progressText =
                    document.getElementById('progressText');

                const jumlahFotoElement =
                    document.getElementById('jumlahFoto');


                if (!progressBar) {
                    return;
                }


                const percentage =
                    Math.min(
                        (
                            jumlahFoto /
                            maxFoto
                        ) * 100,
                        100
                    );


                progressBar.style.width =
                    percentage + '%';


                if (jumlahFotoElement) {

                    jumlahFotoElement.textContent =
                        jumlahFoto;

                }


                if (progressText) {

                    progressText.textContent =
                        jumlahFoto >= maxFoto ?
                        'Lengkap' :
                        'Belum lengkap';

                }

            }


            function setStatus(type, message) {

                if (!faceStatus) {
                    return;
                }


                faceStatus.className =
                    'alert alert-' +
                    type +
                    ' mt-4 text-center';


                faceStatus.innerHTML =
                    message;

            }


            async function startCamera() {

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


                    video.srcObject =
                        stream;


                    setStatus(
                        'info',
                        '<i class="mdi mdi-camera-outline me-1"></i>' +
                        'Kamera aktif. Menunggu deteksi wajah...'
                    );


                    detectInterval =
                        setInterval(
                            detectFace,
                            500
                        );


                } catch (error) {

                    console.error(error);


                    setStatus(
                        'danger',
                        '<i class="mdi mdi-camera-off-outline me-1"></i>' +
                        'Kamera tidak dapat digunakan. Silakan izinkan akses kamera.'
                    );

                }

            }


            async function detectFace() {

                if (
                    sedangMendeteksi ||
                    sedangMengambilFoto ||
                    jumlahFoto >= maxFoto
                ) {

                    return;

                }


                if (
                    !video.videoWidth ||
                    !video.videoHeight
                ) {

                    return;

                }


                sedangMendeteksi = true;


                canvas.width =
                    video.videoWidth;

                canvas.height =
                    video.videoHeight;


                const context =
                    canvas.getContext('2d');


                context.drawImage(
                    video,
                    0,
                    0,
                    canvas.width,
                    canvas.height
                );


                canvas.toBlob(
                    async function(blob) {

                            if (!blob) {

                                sedangMendeteksi = false;

                                return;

                            }


                            const formData =
                                new FormData();


                            formData.append(
                                'image',
                                blob,
                                'detect.jpg'
                            );


                            try {

                                const response =
                                    await fetch(
                                        detectUrl, {
                                            method: 'POST',

                                            headers: {
                                                'X-CSRF-TOKEN': csrfToken,

                                                'Accept': 'application/json'
                                            },

                                            body: formData
                                        }
                                    );


                                const result =
                                    await response.json();


                                if (
                                    result.detected === true
                                ) {

                                    faceDetected = true;


                                    setStatus(
                                        'success',
                                        '<i class="mdi mdi-check-circle-outline me-1"></i>' +
                                        '<strong>WAJAH TERDETEKSI</strong><br>' +
                                        '<small>Jangan bergerak. Foto akan diambil otomatis.</small>'
                                    );


                                    if (faceFrame) {

                                        faceFrame.style.border =
                                            '4px solid #28a745';

                                    }


                                    startCountdown();


                                } else {

                                    faceDetected = false;


                                    setStatus(
                                        'warning',
                                        '<i class="mdi mdi-face-outline me-1"></i>' +
                                        '<strong>Wajah belum terdeteksi</strong><br>' +
                                        '<small>Posisikan wajah tepat di tengah bingkai.</small>'
                                    );


                                    if (faceFrame) {

                                        faceFrame.style.border =
                                            '4px solid #dc3545';

                                    }


                                    resetCountdown();

                                }


                            } catch (error) {

                                console.error(
                                    'Face detection:',
                                    error
                                );

                            } finally {

                                sedangMendeteksi = false;

                            }

                        },

                        'image/jpeg',

                        0.85
                );

            }


            function startCountdown() {

                if (
                    countdownInterval ||
                    sedangMengambilFoto
                ) {

                    return;

                }


                let value = 3;


                countdown.textContent =
                    value;


                countdownInterval =
                    setInterval(function() {

                        if (!faceDetected) {

                            resetCountdown();

                            return;

                        }


                        value--;


                        if (value > 0) {

                            countdown.textContent =
                                value;

                        } else {

                            clearInterval(
                                countdownInterval
                            );

                            countdownInterval =
                                null;


                            countdown.textContent =
                                '📸';


                            captureFace();

                        }

                    }, 1000);

            }


            function resetCountdown() {

                if (countdownInterval) {

                    clearInterval(
                        countdownInterval
                    );

                }


                countdownInterval =
                    null;

                countdown.textContent =
                    '';

            }


            function captureFace() {

                if (
                    sedangMengambilFoto ||
                    jumlahFoto >= maxFoto
                ) {

                    return;

                }


                sedangMengambilFoto =
                    true;


                if (detectInterval) {

                    clearInterval(
                        detectInterval
                    );

                    detectInterval =
                        null;

                }


                canvas.width =
                    video.videoWidth;

                canvas.height =
                    video.videoHeight;


                const context =
                    canvas.getContext('2d');


                context.drawImage(
                    video,
                    0,
                    0,
                    canvas.width,
                    canvas.height
                );


                const image =
                    canvas.toDataURL(
                        'image/png'
                    );


                savePhoto(image);

            }


            async function savePhoto(image) {

                setStatus(
                    'info',
                    '<i class="mdi mdi-loading mdi-spin me-1"></i>' +
                    'Foto sedang disimpan...'
                );


                try {

                    const formData =
                        new FormData();


                    formData.append(
                        'foto',
                        image
                    );


                    const response =
                        await fetch(
                            storeUrl, {
                                method: 'POST',

                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,

                                    'Accept': 'application/json'
                                },

                                body: formData
                            }
                        );


                    const result =
                        await response.json();


                    if (
                        !response.ok ||
                        result.success !== true
                    ) {

                        throw new Error(
                            result.message ||
                            'Foto gagal disimpan.'
                        );

                    }


                    jumlahFoto =
                        Number(
                            result.jumlahFoto
                        );


                    updateProgress();


                    if (
                        jumlahFoto >= maxFoto ||
                        result.complete === true
                    ) {

                        setStatus(
                            'success',
                            '<i class="mdi mdi-check-decagram me-1"></i>' +
                            '<strong>REGISTRASI WAJAH SELESAI</strong><br>' +
                            '<small>Wajah Anda sudah siap digunakan untuk absensi.</small>'
                        );


                        stopCamera();


                        setTimeout(function() {

                            window.location.reload();

                        }, 1200);


                        return;

                    }


                    setStatus(
                        'success',
                        '<i class="mdi mdi-check-circle-outline me-1"></i>' +
                        '<strong>Foto berhasil disimpan</strong><br>' +
                        '<small>Siapkan wajah untuk foto berikutnya.</small>'
                    );


                    sedangMengambilFoto =
                        false;

                    faceDetected =
                        false;

                    countdown.textContent =
                        '';


                    detectInterval =
                        setInterval(
                            detectFace,
                            500
                        );


                } catch (error) {

                    console.error(error);


                    setStatus(
                        'danger',
                        '<i class="mdi mdi-alert-circle-outline me-1"></i>' +
                        error.message
                    );


                    sedangMengambilFoto =
                        false;

                    faceDetected =
                        false;


                    detectInterval =
                        setInterval(
                            detectFace,
                            500
                        );

                }

            }


            function stopCamera() {

                if (detectInterval) {

                    clearInterval(
                        detectInterval
                    );

                    detectInterval =
                        null;

                }


                resetCountdown();


                if (stream) {

                    stream
                        .getTracks()
                        .forEach(function(track) {

                            track.stop();

                        });


                    stream =
                        null;

                }

            }


            updateProgress();


            startCamera();


            window.addEventListener(
                'beforeunload',
                function() {

                    stopCamera();

                }
            );

        });
    </script>

    @endpush