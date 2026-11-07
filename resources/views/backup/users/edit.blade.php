@extends('layouts.skydash-admin')

@section('title', 'Edit User')

@section('content')
<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit User</h4>
                <p class="card-description">Ubah data pengguna sistem.</p>

                <form class="forms-sample" action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" id="name" class="form-control" 
                               value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" 
                               value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="role">Role</label>
                        <input type="text" id="role" class="form-control bg-light" 
                               value="{{ $user->role }}" readonly>
                        <small class="text-muted">Role tidak dapat diubah dari halaman ini.</small>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-2">Simpan</button>
                        <a href="{{ route('users.index') }}" class="btn btn-light">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection