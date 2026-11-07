@extends('layouts.skydash-admin')

@section('title', 'Edit Industri')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Data Industri</h4>
                <p class="card-description">Perbarui informasi detail untuk pembimbing industri terpilih.</p>

                <form class="forms-sample" method="POST" action="{{ route('industri.update', $industri->id) }}">
                    @csrf
                    @method('PUT')

                    <h5 class="text-primary mt-4 mb-3"><i class="mdi mdi-account-circle"></i> Informasi Akun</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama Lengkap Pembimbing</label>
                                <input type="text" name="name" id="name" class="form-control" 
                                       value="{{ old('name', $industri->user->name) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" 
                                       value="{{ old('email', $industri->user->email) }}" required>
                            </div>
                        </div>
                    </div>

                    <h5 class="text-primary mt-4 mb-3"><i class="mdi mdi-domain"></i> Detail Industri</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="perusahaan_id">Perusahaan</label>
                                <select name="perusahaan_id" id="perusahaan_id" class="form-control" required>
                                    @foreach($perusahaans as $perusahaan)
                                        <option value="{{ $perusahaan->id }}" 
                                            {{ old('perusahaan_id', $industri->perusahaan_id) == $perusahaan->id ? 'selected' : '' }}>
                                            {{ $perusahaan->nama_perusahaan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jabatan">Jabatan</label>
                                <input type="text" name="jabatan" id="jabatan" class="form-control" 
                                       value="{{ old('jabatan', $industri->jabatan) }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="no_hp">No HP/WhatsApp</label>
                        <input type="text" name="no_hp" id="no_hp" class="form-control" 
                               value="{{ old('no_hp', $industri->no_hp) }}" required>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="mdi mdi-check"></i> Update Data
                        </button>
                        <a href="{{ route('industri.index') }}" class="btn btn-light">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection