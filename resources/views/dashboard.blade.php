@extends('layouts.skydash-admin')

@section('content')
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h3 class="font-weight-bold">Dashboard Admin</h3>
        <p>Selamat datang kembali, <strong>{{ auth()->user()->name }}</strong>.</p>
      </div>
    </div>
  </div>
</div>

{{-- Baris Pertama: Data Master --}}
<div class="row">
  @php
  $stats = [
  ['label' => 'Total Siswa', 'value' => $jumlahSiswa, 'color' => 'primary', 'icon' => 'mdi-account-group'],
  ['label' => 'Total Guru', 'value' => $jumlahGuru, 'color' => 'success', 'icon' => 'mdi-teach'],
  ['label' => 'Total Industri', 'value' => $jumlahIndustri, 'color' => 'danger', 'icon' => 'mdi-factory'],
  ['label' => 'Total Perusahaan', 'value' => $jumlahPerusahaan, 'color' => 'warning', 'icon' => 'mdi-domain'],
  ];
  @endphp

  @foreach($stats as $stat)
  <div class="col-md-3 grid-margin stretch-card">
    <div class="card card-tale bg-{{ $stat['color'] }}">
      <div class="card-body">
        <p class="mb-4">{{ $stat['label'] }}</p>
        <p class="fs-30 mb-2 font-weight-bold">{{ $stat['value'] }}</p>
        <i class="mdi {{ $stat['icon'] }} card-icon"></i>
      </div>
    </div>
  </div>
  @endforeach
</div>

{{-- Baris Kedua: Aktivitas PKL --}}
<div class="row">
  @php
  $activities = [
  ['label' => 'PKL Aktif', 'value' => $pklAktif, 'color' => 'info', 'icon' => 'mdi-briefcase-check'],
  ['label' => 'PKL Selesai', 'value' => $pklSelesai, 'color' => 'success', 'icon' => 'mdi-check-decagram'],
  ['label' => 'Logbook Pending', 'value' => $logbookPending, 'color' => 'warning', 'icon' => 'mdi-clock-alert'],
  ['label' => 'Absensi Hari Ini', 'value' => $absensiHariIni, 'color' => 'primary', 'icon' => 'mdi-fingerprint'],
  ];
  @endphp

  @foreach($activities as $act)
  <div class="col-md-3 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <p class="text-muted mb-1">{{ $act['label'] }}</p>
            <h4 class="font-weight-bold">{{ $act['value'] }}</h4>
          </div>
          <i class="mdi {{ $act['icon'] }} text-{{ $act['color'] }} icon-lg"></i>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection