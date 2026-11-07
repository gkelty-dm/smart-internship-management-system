@extends('layouts.skydash-admin')

@section('title', 'Edit Kelas')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Data Kelas</h4>
                <p class="card-description">Ubah informasi kelas di bawah ini.</p>
                
                <form class="forms-sample" method="POST" action="{{ route('kelas.update', $kela->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="jurusan_id">Jurusan</label>
                        <select name="jurusan_id" id="jurusan_id" class="form-control @error('jurusan_id') is-invalid @enderror" required>
                            @foreach($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}" {{ $jurusan->id == $kela->jurusan_id ? 'selected' : '' }}>
                                    {{ $jurusan->nama_jurusan }}
                                </option>
                            @endforeach
                        </select>
                        @error('jurusan_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama_kelas">Nama Kelas</label>
                        <input type="text" 
                               name="nama_kelas" 
                               class="form-control @error('nama_kelas') is-invalid @enderror" 
                               id="nama_kelas" 
                               value="{{ old('nama_kelas', $kela->nama_kelas) }}" 
                               required>
                        @error('nama_kelas')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary me-2">
                        <i class="mdi mdi-check"></i> Update Data
                    </button>
                    <a href="{{ route('kelas.index') }}" class="btn btn-light">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection