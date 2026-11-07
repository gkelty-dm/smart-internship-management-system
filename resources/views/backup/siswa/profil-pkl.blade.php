@extends('layouts.skydash-siswa')

@section('title', 'Profil PKL')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Profil & Penempatan</h3>
        <p class="text-muted">Kelola informasi data diri dan pantau status penempatan PKL Anda.</p>
    </div>

    {{-- Biodata Siswa --}}
    <div class="col-12 col-xl-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><i class="mdi mdi-account-badge-horizontal"></i> Biodata Siswa</h4>
                <div class="d-flex align-items-center mb-4">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; font-size: 24px;">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="ml-4">
                        <h5 class="font-weight-bold mb-1">{{ $siswa->user->name }}</h5>
                        <p class="text-muted mb-0">{{ $siswa->nis }}</p>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tr>
                            <td class="pl-0 text-muted">Kelas</td>
                            <td class="font-weight-bold">{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="pl-0 text-muted">Jurusan</td>
                            <td class="font-weight-bold">{{ $siswa->jurusan->nama_jurusan ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Status Penempatan --}}
    <div class="col-12 col-xl-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><i class="mdi mdi-domain"></i> Status Penempatan</h4>
                
                @if($penempatan)
                <div class="template-demo">
                    <div class="mb-4">
                        <small class="text-uppercase text-muted d-block mb-1">Perusahaan</small>
                        <h5 class="font-weight-bold text-primary">{{ $penempatan->perusahaan->nama_perusahaan ?? '-' }}</h5>
                    </div>
                    
                    <div class="row">
                        <div class="col-6">
                            <small class="text-uppercase text-muted d-block mb-1">Guru Pembimbing</small>
                            <p class="font-weight-bold">{{ $penempatan->guru->user->name ?? '-' }}</p>
                        </div>
                        <div class="col-6">
                            <small class="text-uppercase text-muted d-block mb-1">Status</small>
                            <label class="badge {{ $penempatan->status_pkl == 'aktif' ? 'badge-success' : 'badge-danger' }}">
                                {{ strtoupper($penempatan->status_pkl) }}
                            </label>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <small class="text-uppercase text-muted d-block mb-1">Periode PKL</small>
                        <p class="font-weight-bold">
                            <i class="mdi mdi-calendar-range mr-1"></i>
                            {{ \Carbon\Carbon::parse($penempatan->tanggal_mulai)->format('d M Y') }} - 
                            {{ \Carbon\Carbon::parse($penempatan->tanggal_selesai)->format('d M Y') }}
                        </p>
                    </div>
                </div>
                @else
                <div class="text-center py-5">
                    <i class="mdi mdi-alert-outline text-warning display-4"></i>
                    <h5 class="mt-3">Data Belum Tersedia</h5>
                    <p class="text-muted">Silakan hubungi admin sekolah terkait penempatan PKL Anda.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection