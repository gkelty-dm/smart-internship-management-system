@extends('layouts.skydash-industri')

@section('title', 'Ganti Password')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Keamanan Akun</h3>
        <p class="text-muted">Ganti kata sandi Anda secara berkala untuk menjaga keamanan akun.</p>
    </div>

    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Formulir Ganti Password</h4>

                @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        <i class="mdi mdi-alert-circle"></i> {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('industri.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Password Lama</label>
                        <input type="password" name="password_lama" class="form-control" placeholder="Masukkan password lama" required>
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
                            <i class="mdi mdi-check-circle-outline"></i> Simpan Password
                        </button>
                        <a href="{{ route('industri.profil') }}" class="btn btn-light">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection