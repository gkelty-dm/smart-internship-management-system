@extends('layouts.skydash-siswa')

@section('title', 'Profil Saya')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Profil Saya</h3>
        <p class="text-muted">Informasi akun dan data pribadi siswa.</p>
    </div>

    @if(session('success'))
    <div class="col-12">
        <div class="alert alert-success">
            <i class="mdi mdi-check-circle"></i> {{ session('success') }}
        </div>
    </div>
    @endif

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center flex-wrap mb-4">
                    @if($siswa->foto)
                        <img src="{{ asset('storage/'.$siswa->foto) }}" alt="Foto Profil" class="rounded-circle mr-4" style="width: 120px; height: 120px; object-fit: cover; border: 4px solid #f8f9fa; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($siswa->user->name) }}&background=4B49AC&color=ffffff&size=200" alt="Avatar" class="rounded-circle mr-4" style="width: 120px; height: 120px; border: 4px solid #f8f9fa; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                    @endif
                    
                    <div>
                        <h4 class="font-weight-bold">{{ $siswa->user->name }}</h4>
                        <p class="text-muted mb-1">Siswa PKL</p>
                        <p class="text-primary font-weight-bold mb-0">NISN : {{ $siswa->nisn }}</p>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th width="250" class="pl-0">Nama Lengkap</th>
                            <td>{{ $siswa->user->name }}</td>
                        </tr>
                        <tr>
                            <th class="pl-0">Email</th>
                            <td>{{ $siswa->user->email }}</td>
                        </tr>
                        <tr>
                            <th class="pl-0">NISN</th>
                            <td>{{ $siswa->nisn }}</td>
                        </tr>
                        <tr>
                            <th class="pl-0">No HP</th>
                            <td>{{ $siswa->no_hp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="pl-0">Alamat</th>
                            <td>{{ $siswa->alamat ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="pl-0">Kelas</th>
                            <td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="pl-0">Jurusan</th>
                            <td>{{ $siswa->jurusan->nama_jurusan ?? '-' }}</td>
                        </tr>
                    </table>
                </div>

                <div class="mt-4">
                    <a href="{{ route('siswa.profil.edit') }}" class="btn btn-primary">
                        <i class="mdi mdi-pencil"></i> Edit Profil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection