@extends('layouts.skydash-industri')

@section('title', 'Detail Siswa')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Detail Siswa PKL</h3>
        <p class="text-muted">Informasi lengkap data diri dan progress PKL siswa.</p>
    </div>

    {{-- Profil Siswa --}}
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body text-center">
                <img src="{{ $siswa->user->foto_profil ? asset('storage/'.$siswa->user->foto_profil) : 'https://via.placeholder.com/200' }}" 
                     class="img-lg rounded-circle mb-3" alt="Profile">
                <h4 class="font-weight-bold">{{ $siswa->user->name }}</h4>
                <p class="text-muted">{{ $siswa->nisn }}</p>
                <div class="border-top pt-3 text-left">
                    <p><strong>Jurusan:</strong> {{ $siswa->jurusan->nama_jurusan ?? '-' }}</p>
                    <p><strong>Kelas:</strong> {{ $siswa->kelas->nama_kelas ?? '-' }}</p>
                    <p><strong>No HP:</strong> {{ $siswa->no_hp ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Informasi PKL --}}
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Informasi PKL</h4>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tr>
                            <td class="text-muted">Perusahaan</td>
                            <td class="font-weight-bold">{{ $penempatan->perusahaan->nama_perusahaan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Guru Pembimbing</td>
                            <td class="font-weight-bold">{{ $penempatan->guru->user->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Tanggal PKL</td>
                            <td class="font-weight-bold">{{ $penempatan->tanggal_mulai }} s/d {{ $penempatan->tanggal_selesai }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Status</td>
                            <td><label class="badge badge-info">{{ ucfirst($penempatan->status_pkl) }}</label></td>
                        </tr>
                    </table>
                </div>

                {{-- Statistik Singkat --}}
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="card card-tale text-white p-3 text-center">
                            <h6>Absensi</h6>
                            <h3>{{ $totalAbsensi }}</h3>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-dark-blue text-white p-3 text-center">
                            <h6>Logbook</h6>
                            <h3>{{ $totalLogbook }}</h3>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-light-blue text-white p-3 text-center">
                            <h6>Nilai Akhir</h6>
                            <h3>{{ $penempatan->nilaiPKL->nilai_akhir ?? '-' }}</h3>
                        </div>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="mt-4">
                    <a href="{{ route('industri.siswa.absensi', $siswa->id) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-calendar-check"></i> Absensi</a>
                    <a href="{{ route('industri.siswa.logbook', $siswa->id) }}" class="btn btn-success btn-sm"><i class="mdi mdi-book-open"></i> Logbook</a>
                    <a href="{{ route('industri.siswa.penilaian', $siswa->id) }}" class="btn btn-warning btn-sm"><i class="mdi mdi-star"></i> Penilaian</a>
                    <a href="{{ route('industri.siswa.laporan', $siswa->id) }}" class="btn btn-info btn-sm"><i class="mdi mdi-file-pdf"></i> Cetak PDF</a>
                    <a href="{{ route('industri.siswa') }}" class="btn btn-light btn-sm">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection