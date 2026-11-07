@extends('layouts.skydash-admin')

@section('title', 'Edit Guru')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Data Guru</h4>
                <p class="card-description">Perbarui profil informasi guru.</p>

                <form class="forms-sample" method="POST" action="{{ route('guru.update', $guru->id) }}">
                    @csrf
                    @method('PUT')

                    <h5 class="text-primary mt-4 mb-3"><i class="mdi mdi-account-circle"></i> Informasi Akun</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" name="name" id="name" class="form-control" 
                                       value="{{ old('name', $guru->user->name) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" 
                                       value="{{ old('email', $guru->user->email) }}" required>
                            </div>
                        </div>
                    </div>

                    <h5 class="text-primary mt-4 mb-3"><i class="mdi mdi-badge-account"></i> Profil Guru</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nip">NIP</label>
                                <input type="text" name="nip" id="nip" class="form-control" 
                                       value="{{ old('nip', $guru->nip) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_hp">No HP</label>
                                <input type="text" name="no_hp" id="no_hp" class="form-control" 
                                       value="{{ old('no_hp', $guru->no_hp) }}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" rows="4">{{ old('alamat', $guru->alamat) }}</textarea>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="mdi mdi-check"></i> Update Data
                        </button>
                        <a href="{{ route('guru.index') }}" class="btn btn-light">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection