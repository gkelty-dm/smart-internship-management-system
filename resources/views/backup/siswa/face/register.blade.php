@extends('layouts.skydash-siswa')

@section('title', 'Registrasi Wajah')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Registrasi Wajah</h3>
        <p class="text-muted">Ambil minimal 5 foto wajah untuk verifikasi absensi.</p>

        {{-- Progress Counter --}}
        <div class="alert {{ $jumlahFoto >= 5 ? 'alert-success' : 'alert-info' }} mt-3">
            <strong>Progres Anda:</strong> {{ $jumlahFoto }} dari 5 foto telah tersimpan.
            @if($jumlahFoto >= 5)
            <span class="font-italic ml-2">(Registrasi sudah lengkap)</span>
            @endif
        </div>
    </div>

    @if(session('success'))
    <div class="col-12">
        <div class="alert alert-success">{{ session('success') }}</div>
    </div>
    @endif
    @if(session('error'))
    <div class="col-12">
        <div class="alert alert-danger">{{ session('error') }}</div>
    </div>
    @endif

    @if($jumlahFoto < 5)
        <div class="col-12 col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Kamera Registrasi</h4>
                <div id="cameraWrapper">
                    <video id="video" autoplay playsinline></video>
                    <div id="faceFrame"></div>
                </div>

                <div id="faceStatus" class="alert alert-info mt-3 text-center font-weight-bold">
                    ⏳ Menunggu Deteksi Wajah
                </div>
                <div id="countdown" class="text-center h3 font-weight-bold text-success mt-2"></div>

                <button type="button" onclick="captureFace()" class="btn btn-primary btn-block">
                    <i class="mdi mdi-camera"></i> Ambil Foto
                </button>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Hasil Preview</h4>
                <form id="faceForm">
                    @csrf
                    <input type="hidden" name="foto" id="foto">

                    <div id="previewContainer" class="hidden text-center mb-4">
                       <img id="preview" class="img-fluid rounded border shadow-sm" style="max-width: 280px;">
                    </div>

                   <div id="placeholder" class="text-center py-5 border rounded mb-4" style="min-height: 280px;">
                        <i class="mdi mdi-account-circle-outline display-3 text-muted"></i>
                        <p class="text-muted">Silakan ambil foto wajah Anda</p>
                    </div>

                    <button type="submit" id="btnSimpan" class="btn btn-success btn-block" disabled>
                        <i class="mdi mdi-content-save"></i> Simpan Foto ({{ $jumlahFoto + 1 }} / 5)
                    </button>
                </form>
            </div>
        </div>
    </div>
    @else
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div class="text-center mb-4">
                    <i class="mdi mdi-check-decagram text-success display-1"></i>

                    <h2 class="mt-3">
                        Registrasi Selesai
                    </h2>

                    <p class="text-muted">
                        Data wajah Anda telah berhasil diregistrasikan dan siap digunakan untuk absensi.
                    </p>
                </div>

                <hr>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title mb-0">
                        Foto Wajah Yang Telah Diregistrasikan
                    </h4>
                    <span class="badge badge-success p-2">
                        {{ $profile->images->count() }} / 5 Foto
                    </span>
                </div>

                <div class="row">
                    @forelse($profile->images as $foto)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card shadow-sm face-card">
                                <img src="{{ Storage::url($foto->file_path) }}" class="card-img-top face-image" alt="Foto Registrasi">
                                <div class="card-body text-center py-2">
                                    <h6 class="mb-1">
                                        Foto {{ $loop->iteration }}
                                    </h6>
                                    <small class="text-success">
                                        ✔ Tersimpan
                                    </small>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-warning">
                                Belum ada foto yang tersimpan.
                            </div>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
    @endif

    <canvas id="canvas" class="d-none"></canvas>
</div>
@endsection

<style>
    #cameraWrapper {
        position: relative;
        width: 100%;
        max-width: 500px;
        margin: auto;
        overflow: hidden;
        border-radius: 20px;
        background: #000;
        aspect-ratio: 3 / 4;
    }

    #video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 20px;
        transform: scaleX(-1);
    }

    #faceFrame {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 55%;
        aspect-ratio: 0.75 / 1;
        border: 5px solid #28a745;
        border-radius: 50% 50% 45% 45%;
        pointer-events: none;
        transition: .3s ease;
        box-shadow: 0 0 20px rgba(40,167,69,.8), inset 0 0 20px rgba(40,167,69,.3);
    }

    @media (max-width: 768px) {
        #cameraWrapper {
            max-width: 100%;
        }

        #faceFrame {
            width: 65%;
        }
    }

    .face-card {
        transition: .3s;
        border-radius: 12px;
        overflow: hidden;
    }

    .face-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,.2);
    }

    .face-image {
        height: 250px;
        width: 100%;
        object-fit: cover;
        cursor: pointer;
    }
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/face-api.js"></script>
<script>
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const preview = document.getElementById('preview');
    const previewContainer = document.getElementById('previewContainer');
    const placeholder = document.getElementById('placeholder');
    const btnSimpan = document.getElementById('btnSimpan');
    const inputFoto = document.getElementById('foto');

    let detectInterval = null;
    let autoCaptureRunning = false;
    let sudahSubmit = false;
    let photoCount = 0;
    let sedangMendeteksi = false;

    let countdownInterval = null;
    let countdownValue = 3;
    let faceDetected = false;

    @if ($jumlahFoto < 5)
    navigator.mediaDevices.getUserMedia({
        video: {
            facingMode: 'user'
        }
    })
    .then(stream => {
        video.srcObject = stream;
        detectInterval = setInterval(detectFace, 300);
    })
    .catch(error => {
        alert('Izin kamera diperlukan untuk registrasi.');
    });
    @endif

    async function detectFace() {
        if (sedangMendeteksi) {
            return;
        }

        sedangMendeteksi = true;

        if (!video.videoWidth) {
            sedangMendeteksi = false;
            return;
        }

        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        canvas.getContext('2d').drawImage(video, 0, 0);

        canvas.toBlob(async function(blob) {
            const formData = new FormData();
            formData.append('image', blob, 'detect.jpg');

            try {
                const response = await fetch('{{ route("face.detect") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const result = await response.json();
                const status = document.getElementById('faceStatus');

                if (result.detected) {
                    faceDetected = true;
                    status.innerHTML = '✅ WAJAH TERDETEKSI';
                    status.className = 'alert alert-success mt-3 text-center';
                    document.getElementById('faceFrame').style.border = '5px solid green';

                    if (!autoCaptureRunning) {
                        startCountdown();
                    }
                } else {
                    faceDetected = false;
                    status.innerHTML = '⚠️ Arahkan wajah ke kamera';
                    status.className = 'alert alert-warning mt-3 text-center';
                    document.getElementById('faceFrame').style.border = '5px solid red';
                    resetCountdown();
                }
            } catch (error) {
                console.log(error);
            } finally {
                sedangMendeteksi = false;
            }
        }, 'image/jpeg');
    }

    function startCountdown() {
        if (autoCaptureRunning) {
            return;
        }

        autoCaptureRunning = true;
        countdownValue = 3;
        const countdown = document.getElementById('countdown');
        countdown.innerHTML = countdownValue;

        countdownInterval = setInterval(() => {
            const status = document.getElementById('faceStatus');

            if (!faceDetected || !status.innerHTML.includes('WAJAH TERDETEKSI')) {
                resetCountdown();
                return;
            }

            countdownValue--;

            if (countdownValue > 0) {
                countdown.innerHTML = countdownValue;
            } else {
                clearInterval(countdownInterval);
                countdown.innerHTML = '';
                captureFace();
            }
        }, 1000);
    }

    function resetCountdown() {
        clearInterval(countdownInterval);
        autoCaptureRunning = false;
        countdownValue = 3;
        document.getElementById('countdown').innerHTML = '';
    }

    function captureFace() {
        clearInterval(detectInterval);
        autoCaptureRunning = true;

        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        canvas.getContext('2d').drawImage(video, 0, 0);

        const image = canvas.toDataURL('image/png');
        inputFoto.value = image;
        preview.src = image;
        previewContainer.classList.remove('hidden');
        placeholder.classList.add('hidden');
        btnSimpan.disabled = true;

        document.getElementById('countdown').innerHTML = '📸 Mengirim foto...';
        photoCount++;

        if (sudahSubmit) {
            return;
        }

        setTimeout(async () => {
            try {
                const response = await fetch("{{ route('face.store') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "Accept": "application/json"
                    },
                    body: new FormData(document.getElementById("faceForm"))
                });

                const result = await response.json();
                location.reload();
            } catch (error) {
                console.log(error);
                alert("Gagal menyimpan foto");
            }
        }, 1000);
    }
</script>
@endpush