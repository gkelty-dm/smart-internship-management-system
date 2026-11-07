@extends('layouts.skydash-admin')

@section('title', 'Edit Jurusan')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Data Jurusan</h4>
                <p class="card-description">Ubah informasi jurusan di bawah ini.</p>
                
                <form class="forms-sample" method="POST" action="{{ route('jurusan.update', $jurusan->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nama_jurusan">Nama Jurusan</label>
                        <input type="text" 
                               name="nama_jurusan" 
                               class="form-control @error('nama_jurusan') is-invalid @enderror" 
                               id="nama_jurusan" 
                               placeholder="Contoh: Rekayasa Perangkat Lunak" 
                               value="{{ old('nama_jurusan', $jurusan->nama_jurusan) }}" 
                               required>
                        
                        @error('nama_jurusan')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary me-2">
                        <i class="mdi mdi-check"></i> Update Data
                    </button>
                    <a href="{{ route('jurusan.index') }}" class="btn btn-light">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection