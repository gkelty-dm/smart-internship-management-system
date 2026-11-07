@extends('layouts.skydash-siswa')
@section('title', 'Dashboard Siswa')

@section('content')
{{-- Header Section --}}
<div class="row">
    <div class="col-12 mb-4">
        <h3 class="font-weight-bold">Dashboard Siswa</h3>
        <p class="text-muted">Selamat datang, <span class="text-primary font-weight-bold">{{ $siswa->user->name }}</span>.</p>
    </div>
</div>

{{-- Stats Grid --}}
<div class="row">
    @php
        $cards = [
            ['label' => 'NISN', 'value' => $siswa->nisn, 'icon' => 'mdi-identifier', 'color' => 'primary'],
            ['label' => 'Kelas', 'value' => $siswa->kelas->nama_kelas ?? '-', 'icon' => 'mdi-google-classroom', 'color' => 'success'],
            ['label' => 'Total Logbook', 'value' => $jumlahLogbook, 'icon' => 'mdi-book-open-page-variant', 'color' => 'info'],
        ];
    @endphp

    @foreach($cards as $c)
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card card-tale bg-{{ $c['color'] }} text-white">
            <div class="card-body">
                <p class="mb-2 text-uppercase font-weight-bold" style="font-size: 10px; opacity: 0.8; letter-spacing: 2px;">{{ $c['label'] }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="mb-0 font-weight-bold">{{ $c['value'] }}</h2>
                    <i class="mdi {{ $c['icon'] }} mdi-36px" style="opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    {{-- Card Status Wajah --}}
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card bg-warning text-dark">
            <div class="card-body">
                <p class="mb-2 text-uppercase font-weight-bold" style="font-size: 10px; letter-spacing: 2px;">Status Wajah</p>
                <div class="d-flex justify-content-between align-items-center">
                    @if($faceProfile && $faceProfile->is_registered)
                        <span class="badge badge-success">TERVERIFIKASI</span>
                    @else
                        <span class="badge badge-danger">BELUM REG</span>
                    @endif
                    <i class="mdi mdi-face-recognition mdi-36px"></i>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Section Penempatan --}}
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-muted text-uppercase" style="font-size: 12px;">Informasi Penempatan PKL</h4>
                @if($penempatan)
                    <div class="d-flex align-items-center">
                        <div class="bg-primary text-white p-3 rounded mr-3">
                            <i class="mdi mdi-domain mdi-24px"></i>
                        </div>
                        <div>
                            <h4 class="font-weight-bold mb-1">{{ $penempatan->perusahaan->nama_perusahaan }}</h4>
                            <p class="text-muted mb-0">Mulai: {{ \Carbon\Carbon::parse($penempatan->tanggal_mulai)->format('d M Y') }}</p>
                        </div>
                    </div>
                @else
                    <p class="text-muted font-italic">Belum ada penempatan.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection