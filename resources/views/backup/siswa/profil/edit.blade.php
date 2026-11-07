@extends('layouts.skydash-siswa')

@section('title', 'Edit Profil')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Edit Profil</h3>
        <p class="text-muted">Perbarui informasi akun dan data pribadi Anda.</p>
    </div>

    @if($errors->any())
    <div class="col-12">
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('siswa.profil.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="text-center mb-4">
                        @if($siswa->foto)
                            <img src="{{ asset('storage/'.$siswa->foto) }}" class="rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #dee2e6;">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($siswa->user->name) }}&background=4B49AC&color=ffffff&size=200" class="rounded-circle mb-3" style="width: 120px; height: 120px; border: 3px solid #dee2e6;">
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Foto Profil</label>
                        <input type="file" name="foto" class="form-control file-upload-info" accept="image/*">
                        <small class="text-muted">Format JPG, JPEG, PNG.</small>
                    </div>

                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $siswa->user->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $siswa->user->email) }}" required>
                    </div>

                    <div class="form-group">
                        <label>NISN</label>
                        <input type="text" name="nisn" class="form-control" value="{{ old('nisn', $siswa->nisn) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Nomor HP</label>
                        <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $siswa->no_hp) }}">
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" rows="4">{{ old('alamat', $siswa->alamat) }}</textarea>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="mdi mdi-content-save"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('siswa.profil') }}" class="btn btn-light">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection