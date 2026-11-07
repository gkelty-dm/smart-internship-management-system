@extends('layouts.skydash-industri')

@section('title', 'Detail Absensi')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Detail Absensi</h3>
        <p class="text-muted">Informasi lengkap kehadiran siswa.</p>
    </div>

    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Informasi Kehadiran</h4>
                <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                        <tbody>
                            <tr>
                                <td class="font-weight-bold">Nama Siswa</td>
                                <td>{{ $absensi->siswa->user->name }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tanggal</td>
                                <td>{{ $absensi->tanggal }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Jam Masuk</td>
                                <td>{{ $absensi->jam_masuk ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Jam Pulang</td>
                                <td>{{ $absensi->jam_pulang ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Status</td>
                                <td>
                                    <label class="badge badge-{{ ($absensi->status == 'hadir') ? 'success' : 'warning' }}">
                                        {{ ucfirst($absensi->status) }}
                                    </label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Lokasi (Koordinat)</h4>
                <p class="text-muted small">Titik lokasi saat melakukan absensi.</p>
                <div class="mt-3">
                    <p class="mb-1"><small class="text-primary font-weight-bold">MASUK</small></p>
                    <p class="mb-2">Lat: {{ $absensi->latitude_masuk ?? '-' }}</p>
                    <p class="mb-3">Long: {{ $absensi->longitude_masuk ?? '-' }}</p>

                    <p class="mb-1"><small class="text-info font-weight-bold">PULANG</small></p>
                    <p class="mb-2">Lat: {{ $absensi->latitude_pulang ?? '-' }}</p>
                    <p class="mb-0">Long: {{ $absensi->longitude_pulang ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <a href="{{ route('industri.absensi') }}" class="btn btn-light">
            <i class="mdi mdi-arrow-left"></i> Kembali
        </a>
    </div>
</div>
@endsection