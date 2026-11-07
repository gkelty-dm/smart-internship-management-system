@extends('layouts.skydash-industri')

@section('title', 'Edit Profil')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Edit Profil</h3>
        <p class="text-muted">Perbarui informasi data diri Anda sebagai pembimbing industri.</p>
    </div>

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Formulir Informasi Akun</h4>
                
                <form action="{{ route('industri.profil.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $industri->user->name) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $industri->user->email) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jabatan</label>
                                <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan', $industri->jabatan) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>No HP</label>
                                <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $industri->no_hp) }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Perusahaan</label>
                        <input type="text" class="form-control" value="{{ $industri->perusahaan->nama_perusahaan ?? '-' }}" readonly>
                        <small class="text-muted">Nama perusahaan tidak dapat diubah di sini.</small>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="mdi mdi-content-save"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('industri.profil') }}" class="btn btn-light">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection