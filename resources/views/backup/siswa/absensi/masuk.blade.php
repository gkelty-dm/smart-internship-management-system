@extends('layouts.skydash-siswa')

@section('title', 'Absen Masuk')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Absen Masuk</h3>
        <p class="text-muted">Verifikasi wajah Anda untuk melakukan absensi masuk.</p>
    </div>

    {{-- Notifikasi --}}
    <div class="col-12">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
    </div>

    {{-- Kolom Kamera --}}
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('siswa.absen.masuk') }}" method="POST">
                    @csrf
                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">
                    <input type="hidden" name="foto_masuk" id="fotoMasuk">

                    <button type="button" id="btnBukaKamera" class="btn btn-primary btn-block" onclick="startCamera()">
                        <i class="mdi mdi-camera"></i> Mulai Scan Wajah
                    </button>

                    <div id="cameraContainer" class="mt-3" style="display:none;">
                        <video id="video" width="100%" autoplay playsinline class="rounded border"></video>
                    </div>

                    <div id="statusWajah" class="alert alert-info mt-3">
                        <i class="mdi mdi-information-outline"></i> Menunggu Scan Wajah...
                    </div>

                    <button type="submit" id="btnSubmit" class="btn btn-success btn-block mt-3" disabled>
                        <i class="mdi mdi-check-circle"></i> Kirim Absensi Masuk
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Kolom Data --}}
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><i class="mdi mdi-account-check"></i> Data Verifikasi</h4>
                <div id="dataSiswa" style="display:none;">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td><strong>Nama</strong></td>
                                <td>{{ auth()->user()->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td><span class="badge badge-success">Terverifikasi</span></td>
                            </tr>
                            <tr>
                                <td><strong>Waktu</strong></td>
                                <td id="jamScan">-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div id="belumVerifikasi" class="text-center py-5">
                    <i class="mdi mdi-face-recognition mdi-48px text-muted"></i>
                    <p class="text-muted">Wajah belum diverifikasi.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    #video {
        transform: scaleX(-1);
    }
</style>

@push('scripts')
<script>
    // FUNGSI GEOLOCATION
    navigator.geolocation.getCurrentPosition(function(pos) {
        document.getElementById('latitude').value = pos.coords.latitude;
        document.getElementById('longitude').value = pos.coords.longitude;
    });

    // LOGIKA CAMERA & SCAN

    let stream;
    let verified = false;
    let scanCount = 0;
    let scanInterval = null;
    let isScanning = false;

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
                        facingMode: "user"
                    }
                });

            document.getElementById(
                'cameraContainer'
            ).style.display = 'block';

            document.getElementById(
                'video'
            ).srcObject = stream;

            document.getElementById(
                    'statusWajah'
                ).innerHTML =
                '🔍 Memulai scan wajah...';

            verified = false;
            scanCount = 0;
            isScanning = false;

            startFaceScan();
        } catch (error) {
            alert(
                'Kamera tidak dapat diakses'
            );
        }
    }

    function startFaceScan() {
        if (scanInterval) {
            clearInterval(
                scanInterval
            );
        }

        scanInterval =
            setInterval(
                async () => {
                        if (verified) {
                            clearInterval(
                                scanInterval
                            );

                            scanInterval = null;

                            return;
                        }

                        if (isScanning) {
                            return;
                        }

                        isScanning = true;

                        scanCount++;

                        document.getElementById(
                                'statusWajah'
                            ).innerHTML =
                            `🔍 Memindai Wajah... Scan ke-${scanCount}`;

                        const video =
                            document.getElementById(
                                'video'
                            );

                        if (
                            !video.videoWidth
                        ) {
                            isScanning = false;
                            return;
                        }

                        const canvas =
                            document.createElement(
                                'canvas'
                            );

                        canvas.width =
                            video.videoWidth;

                        canvas.height =
                            video.videoHeight;

                        canvas
                            .getContext('2d')
                            .drawImage(
                                video,
                                0,
                                0
                            );

                        const image =
                            canvas.toDataURL(
                                'image/jpeg'
                            );

                        try {
                            const response =
                                await fetch(
                                    '{{ route("siswa.verify.face") }}', {
                                        method: 'POST',

                                        headers: {

                                            'Content-Type': 'application/json',

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

                            if (
                                result.verified
                            ) {
                                verified = true;

                                clearInterval(
                                    scanInterval
                                );

                                scanInterval = null;

                                document.getElementById(
                                    'btnBukaKamera'
                                ).disabled = true;

                                document.getElementById(
                                        'btnBukaKamera'
                                    ).innerHTML =
                                    '✓ Terverifikasi';

                                document.getElementById(
                                        'fotoMasuk'
                                    ).value =
                                    image;

                                document.getElementById(
                                        'statusWajah'
                                    ).innerHTML =
                                    '✅ Wajah Cocok';

                                document.getElementById(
                                        'btnSubmit'
                                    ).disabled =
                                    false;

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

                                if (stream) {
                                    stream
                                        .getTracks()
                                        .forEach(
                                            track =>
                                            track.stop()
                                        );
                                }

                                document.getElementById(
                                        'cameraContainer'
                                    ).style.display =
                                    'none';

                                return;
                            }

                            document.getElementById(
                                    'statusWajah'
                                ).innerHTML =
                                result.message ==
                                'Wajah tidak terdeteksi' ?
                                '⚠️ Wajah Tidak Terdeteksi' :
                                '❌ Wajah Tidak Sesuai (Scan: ' + scanCount + ')';
                        } catch (error) {
                            isScanning = false;

                            document.getElementById(
                                    'statusWajah'
                                ).innerHTML =
                                '⚠️ Gagal menghubungi server AI';
                        }

                    },
                    2000
            );
    }
</script>
@endpush