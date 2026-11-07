@extends('layouts.skydash-guru')

@section('title', 'Dashboard Guru')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Dashboard Guru Pembimbing</h3>
        <p class="text-muted">Selamat datang, berikut adalah ringkasan data siswa bimbingan Anda.</p>
    </div>

    {{-- Statistik Tiles --}}
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card card-tale">
            <div class="card-body">
                <p class="mb-2">Total Siswa</p>
                <h2 class="font-weight-bold mb-2">{{ $totalSiswa }}</h2>
                <i class="mdi mdi-account-group mdi-36px"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card card-dark-blue">
            <div class="card-body">
                <p class="mb-2">Logbook Pending</p>
                <h2 class="font-weight-bold mb-2">{{ $logbookPending }}</h2>
                <i class="mdi mdi-book-clock mdi-36px"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card card-light-blue">
            <div class="card-body">
                <p class="mb-2">Absensi Hari Ini</p>
                <h2 class="font-weight-bold mb-2">{{ $absensiHariIni }}</h2>
                <i class="mdi mdi-calendar-check mdi-36px"></i>
            </div>
        </div>
    </div>

    {{-- Tabel Data --}}
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Siswa Bimbingan</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Perusahaan</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($siswaBimbingan as $item)
                            <tr>
                                <td class="font-weight-bold text-dark">{{ $item->siswa->user->name }}</td>
                                <td>{{ $item->perusahaan->nama_perusahaan }}</td>
                                <td class="text-center">
                                    @if($item->status_pkl == 'aktif')
                                        <label class="badge badge-success">Aktif</label>
                                    @else
                                        <label class="badge badge-secondary">Selesai</label>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection