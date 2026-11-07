@extends('layouts.skydash-guru')

@section('title', 'Profil Guru')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Profil Guru</h3>
        <p class="text-muted">Kelola informasi data diri dan keamanan akun Anda.</p>
    </div>

    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="mdi mdi-account-circle text-primary"></i> Data Diri
                </h4>
                
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tr>
                            <td class="text-muted" width="30%">Nama</td>
                            <td class="font-weight-bold text-dark">{{ $guru->user->name }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Email</td>
                            <td class="font-weight-bold text-dark">{{ $guru->user->email }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">NIP</td>
                            <td class="font-weight-bold text-dark">{{ $guru->nip }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">No HP</td>
                            <td class="font-weight-bold text-dark">{{ $guru->no_hp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Alamat</td>
                            <td class="font-weight-bold text-dark">{{ $guru->alamat ?? '-' }}</td>
                        </tr>
                    </table>
                </div>

                <div class="mt-4">
                    <a href="{{ route('guru.profil.edit') }}" class="btn btn-primary mr-2">
                        <i class="mdi mdi-pencil"></i> Edit Profil
                    </a>
                    <a href="{{ route('guru.password') }}" class="btn btn-danger">
                        <i class="mdi mdi-lock-outline"></i> Ganti Password
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection