@extends('layouts.skydash-admin')

@section('content')

{{-- BANNER WELCOME --}}
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Dashboard Admin</h3>
                <h6 class="font-weight-normal mb-0">
                    Selamat datang kembali, <span class="text-primary font-weight-bold">{{ auth()->user()->name }}</span>!
                </h6>
            </div>
        </div>
    </div>
</div>

{{-- SECTION 1: MASTER DATA --}}
<div class="row">
    <div class="col-md-12 grid-margin">
        <h4 class="card-title mb-3">Ringkasan Data Master</h4>
    </div>
</div>

<div class="row">
    {{-- Total Siswa --}}
    <div class="col-6 col-md-3 grid-margin stretch-card">
        <div class="card card-tale">
            <div class="card-body">
                <p class="mb-2">Total Siswa</p>
                <p class="fs-30 mb-2">{{ $jumlahSiswa }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <small>Siswa terdaftar</small>
                    <i class="mdi mdi-account-group icon-lg"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Total Guru --}}
    <div class="col-6 col-md-3 grid-margin stretch-card">
        <div class="card card-dark-blue">
            <div class="card-body">
                <p class="mb-2">Total Guru Pembimbing</p>
                <p class="fs-30 mb-2">{{ $jumlahGuru }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <small>Guru pembimbing</small>
                    <i class="mdi mdi-teach icon-lg"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Total Industri --}}
    <div class="col-6 col-md-3 grid-margin stretch-card">
        <div class="card card-light-blue">
            <div class="card-body">
                <p class="mb-2">Total Industri Pembimbing</p>
                <p class="fs-30 mb-2">{{ $jumlahIndustri }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <small>Industri pembimbing</small>
                    <i class="mdi mdi-factory icon-lg"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Total Perusahaan --}}
    <div class="col-6 col-md-3 grid-margin stretch-card">
        <div class="card card-light-danger">
            <div class="card-body">
                <p class="mb-2">Total Perusahaan</p>
                <p class="fs-30 mb-2">{{ $jumlahPerusahaan }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <small>Perusahaan mitra</small>
                    <i class="mdi mdi-domain icon-lg"></i>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- SECTION 2: AKTIVITAS PKL --}}
<div class="row mt-2">
    <div class="col-md-12 grid-margin">
        <h4 class="card-title mb-3">Aktivitas & Operasional PKL</h4>
    </div>
</div>

<div class="row">
    {{-- PKL Aktif --}}
    <div class="col-6 col-md-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title text-md-center text-xl-left mb-2">PKL Aktif</p>
                <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 font-weight-bold text-info">{{ $pklAktif }}</h3>
                    <i class="mdi mdi-briefcase-check icon-md text-info"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- PKL Selesai --}}
    <div class="col-6 col-md-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title text-md-center text-xl-left mb-2">PKL Selesai</p>
                <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 font-weight-bold text-success">{{ $pklSelesai }}</h3>
                    <i class="mdi mdi-check-decagram icon-md text-success"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Logbook Pending --}}
    <div class="col-6 col-md-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title text-md-center text-xl-left mb-2">Logbook Pending</p>
                <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 font-weight-bold text-warning">{{ $logbookPending }}</h3>
                    <i class="mdi mdi-clock-alert icon-md text-warning"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Absensi Hari Ini --}}
    <div class="col-6 col-md-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title text-md-center text-xl-left mb-2">Absensi Hari Ini</p>
                <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 font-weight-bold text-primary">{{ $absensiHariIni }}</h3>
                    <i class="mdi mdi-fingerprint icon-md text-primary"></i>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection