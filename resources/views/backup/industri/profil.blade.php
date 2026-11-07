@extends('layouts.skydash-industri')

@section('title', 'Profil Saya')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Profil Pembimbing Industri</h3>
        <p class="text-muted">Informasi detail akun dan ringkasan aktivitas pembimbing.</p>
    </div>

    {{-- Detail Profil --}}
    <div class="col-md-7 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Informasi Pribadi</h4>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tr>
                            <td class="text-muted">Nama Lengkap</td>
                            <td class="font-weight-bold">{{ $industri->user->name }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Email</td>
                            <td class="font-weight-bold">{{ $industri->user->email }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Jabatan</td>
                            <td class="font-weight-bold">{{ $industri->jabatan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">No HP</td>
                            <td class="font-weight-bold">{{ $industri->no_hp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Perusahaan</td>
                            <td class="font-weight-bold">{{ $industri->perusahaan->nama_perusahaan ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Statistik Ringkas --}}
    <div class="col-md-5 grid-margin stretch-card">
        <div class="row w-100 mx-0">
            <div class="col-12 stretch-card grid-margin px-0">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <p class="mb-4">Jumlah Siswa PKL</p>
                        <h2 class="font-weight-bold mb-0">{{ $jumlahSiswa }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-12 stretch-card px-0">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <p class="mb-4">Logbook Perlu Validasi</p>
                        <h2 class="font-weight-bold mb-0">{{ $jumlahLogbookPending }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tombol Aksi --}}
    <div class="col-12">
        <a href="{{ route('industri.profil.edit') }}" class="btn btn-primary">
            <i class="mdi mdi-account-edit"></i> Edit Profil
        </a>
        <a href="{{ route('industri.password') }}" class="btn btn-warning">
            <i class="mdi mdi-key"></i> Ganti Password
        </a>
    </div>
</div>
@endsection