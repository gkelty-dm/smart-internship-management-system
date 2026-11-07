@extends('layouts.skydash-admin')

@section('title', 'Tambah Jurusan')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Jurusan Baru</h4>
                <p class="card-description">Silakan isi form di bawah ini untuk menambah jurusan baru.</p>
                
                <form class="forms-sample" method="POST" action="{{ route('jurusan.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="nama_jurusan">Nama Jurusan</label>
                        <input type="text" 
                               name="nama_jurusan" 
                               class="form-control @error('nama_jurusan') is-invalid @enderror" 
                               id="nama_jurusan" 
                               placeholder="Contoh: Rekayasa Perangkat Lunak" 
                               value="{{ old('nama_jurusan') }}" 
                               required>
                        
                        @error('nama_jurusan')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary me-2">
                        <i class="mdi mdi-content-save"></i> Simpan
                    </button>
                    <a href="{{ route('jurusan.index') }}" class="btn btn-light">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection