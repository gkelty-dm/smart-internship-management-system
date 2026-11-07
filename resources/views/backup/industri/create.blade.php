@extends('layouts.skydash-admin')

@section('title', 'Tambah Industri')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data Industri Baru</h4>
                <p class="card-description">Silakan isi form di bawah ini untuk menambah akun industri baru.</p>

                <form class="forms-sample" method="POST" action="{{ route('industri.store') }}">
                    @csrf

                    <h5 class="text-primary mt-4 mb-3"><i class="mdi mdi-account-circle"></i> Informasi Akun</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama Lengkap Pembimbing</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Nama Pembimbing" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="info@perusahaan.com" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="********" required>
                    </div>

                    <h5 class="text-primary mt-4 mb-3"><i class="mdi mdi-domain"></i> Detail Industri</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="perusahaan_id">Perusahaan</label>
                                <select name="perusahaan_id" id="perusahaan_id" class="form-control" required>
                                    <option value="" disabled selected>-- Pilih Perusahaan --</option>
                                    @foreach($perusahaans as $perusahaan)
                                        <option value="{{ $perusahaan->id }}" {{ old('perusahaan_id') == $perusahaan->id ? 'selected' : '' }}>
                                            {{ $perusahaan->nama_perusahaan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jabatan">Jabatan</label>
                                <input type="text" name="jabatan" id="jabatan" class="form-control" value="{{ old('jabatan') }}" placeholder="Contoh: HRD / Mentor">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="no_hp">No HP/WhatsApp</label>
                        <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx" required>
                    </div>

                    <button type="submit" class="btn btn-primary me-2">
                        <i class="mdi mdi-content-save"></i> Simpan Data
                    </button>
                    <a href="{{ route('industri.index') }}" class="btn btn-light">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection