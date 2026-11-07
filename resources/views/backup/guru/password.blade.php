@extends('layouts.skydash-guru')

@section('title', 'Ganti Password')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Ganti Password</h3>
        <p class="text-muted">Pastikan akun Anda tetap aman dengan melakukan pembaruan kata sandi secara berkala.</p>
    </div>

    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="mdi mdi-lock-reset text-primary"></i> Form Ubah Password
                </h4>
                
                <form action="{{ route('guru.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Password Lama</label>
                        <input type="password" name="password_lama" class="form-control" placeholder="Masukkan password saat ini" required>
                    </div>

                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" name="password_baru" class="form-control" placeholder="Masukkan password baru" required>
                    </div>

                    <div class="form-group">
                        <label>Konfirmasi Password Baru</label>
                        <input type="password" name="password_baru_confirmation" class="form-control" placeholder="Ulangi password baru" required>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="mdi mdi-check"></i> Ubah Password
                        </button>
                        <a href="{{ route('guru.profil') }}" class="btn btn-light">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection