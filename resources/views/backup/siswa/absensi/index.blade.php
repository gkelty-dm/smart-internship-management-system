@extends('layouts.siswa')
@section('title', 'Absensi Siswa')

@section('content')
<section class="section main-section">
    <div class="mb-6">
        <h1 class="text-3xl font-bold">Absensi PKL</h1>
        <p class="text-gray-500 mt-1">Lakukan absensi masuk dan pulang harian.</p>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
    <div class="notification green mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="notification red mb-4">{{ session('error') }}</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- ABSEN MASUK --}}
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">Absen Masuk</p>
            </header>
            <div class="card-content">
                <form action="{{ route('siswa.absen.masuk') }}" method="POST">
                    @csrf
                    <input type="hidden" name="latitude" id="latitudeMasuk">
                    <input type="hidden" name="longitude" id="longitudeMasuk">
                    <input type="hidden" name="foto_masuk" id="fotoMasuk">

                    <button type="button" class="button yellow mb-4 w-full" onclick="startCameraMasuk()">Buka Kamera</button>

                    <div id="kameraMasukContainer" style="display:none;" class="mb-4">
                        <video id="videoMasuk" width="100%" autoplay playsinline class="rounded-lg bg-gray-200"></video>
                        <button type="button" class="button blue mt-3 w-full" onclick="captureMasuk()">Ambil Foto</button>
                    </div>

                    <div id="previewMasukContainer" style="display:none;" class="mb-4">
                        <img id="previewMasuk" width="100%" class="rounded-lg">
                        <button type="button" class="button yellow mt-3 w-full" onclick="startCameraMasuk()">Ambil Ulang</button>
                    </div>

                    <button type="submit" class="button green w-full">Absen Masuk</button>
                </form>
            </div>
        </div>

        {{-- ABSEN PULANG --}}
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">Absen Pulang</p>
            </header>
            <div class="card-content">
                <form action="{{ route('siswa.absen.pulang') }}" method="POST">
                    @csrf
                    <input type="hidden" name="latitude" id="latitudePulang">
                    <input type="hidden" name="longitude" id="longitudePulang">
                    <input type="hidden" name="foto_pulang" id="fotoPulang">

                    <button type="button" class="button yellow mb-4 w-full" onclick="startCameraPulang()">Buka Kamera</button>

                    <div id="kameraPulangContainer" style="display:none;" class="mb-4">
                        <video id="videoPulang" width="100%" autoplay playsinline class="rounded-lg bg-gray-200"></video>
                        <button type="button" class="button blue mt-3 w-full" onclick="capturePulang()">Ambil Foto</button>
                    </div>

                    <div id="previewPulangContainer" style="display:none;" class="mb-4">
                        <img id="previewPulang" width="100%" class="rounded-lg">
                        <button type="button" class="button yellow mt-3 w-full" onclick="startCameraPulang()">Ambil Ulang</button>
                    </div>

                    <button type="submit" class="button blue w-full">Absen Pulang</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Riwayat --}}
    <div class="card mt-6 has-table">
        <header class="card-header">
            <p class="card-header-title">Riwayat Absensi</p>
        </header>
        <div class="card-content">
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Masuk</th>
                        <th>Pulang</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($absensis as $item)
                    <tr>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->jam_masuk }}</td>
                        <td>{{ $item->jam_pulang }}</td>
                        <td><span class="tag is-success">{{ ucfirst($item->status) }}</span></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Belum ada data absensi</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">{{ $absensis->links() }}</div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Geolocation
    navigator.geolocation.getCurrentPosition(pos => {
        ['Masuk', 'Pulang'].forEach(t => {
            document.getElementById('latitude' + t).value = pos.coords.latitude;
            document.getElementById('longitude' + t).value = pos.coords.longitude;
        });
    });

    // Camera Logic
    async function startCamera(type) {
        const stream = await navigator.mediaDevices.getUserMedia({
            video: {
                facingMode: "user"
            }
        });
        document.getElementById('video' + type).srcObject = stream;
        document.getElementById('kamera' + type + 'Container').style.display = 'block';
        document.getElementById('preview' + type + 'Container').style.display = 'none';
    }

    function capture(type) {
        const video = document.getElementById('video' + type);
        const canvas = document.createElement('canvas');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        canvas.getContext('2d').drawImage(video, 0, 0);
        const data = canvas.toDataURL('image/jpeg');
        document.getElementById('foto' + type).value = data;
        document.getElementById('preview' + type).src = data;
        document.getElementById('kamera' + type + 'Container').style.display = 'none';
        document.getElementById('preview' + type + 'Container').style.display = 'block';
        video.srcObject.getTracks().forEach(track => track.stop());
    }

    // Helper wrappers
    const startCameraMasuk = () => startCamera('Masuk');
    const startCameraPulang = () => startCamera('Pulang');
    const captureMasuk = () => capture('Masuk');
    const capturePulang = () => capture('Pulang');
</script>
@endpush