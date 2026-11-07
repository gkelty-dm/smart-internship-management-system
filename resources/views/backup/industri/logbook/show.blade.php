@extends('layouts.skydash-industri')

@section('title', 'Validasi Logbook')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Validasi Logbook</h3>
        <p class="text-muted">Periksa kegiatan harian siswa dan berikan status validasi.</p>
    </div>

    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail Kegiatan</h4>
                <div class="template-demo">
                    <p class="text-muted mb-1">Siswa</p>
                    <h5 class="font-weight-bold mb-3">{{ $logbook->siswa->user->name }}</h5>
                    
                    <p class="text-muted mb-1">Tanggal</p>
                    <h5 class="font-weight-bold mb-3">{{ $logbook->tanggal }}</h5>
                    
                    <p class="text-muted mb-1">Kegiatan</p>
                    <div class="p-3 border rounded bg-light">
                        {{ $logbook->kegiatan }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Validasi</h4>
                <form method="POST" action="{{ route('industri.logbook.validasi', $logbook->id) }}">
                    @csrf
                    <div class="form-group">
                        <label>Status Validasi</label>
                        <select name="status_validasi" class="form-control form-control-lg">
                            <option value="disetujui" {{ $logbook->status_validasi == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="ditolak" {{ $logbook->status_validasi == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Catatan</label>
                        <textarea name="catatan" class="form-control" rows="5" placeholder="Masukkan catatan jika ada...">{{ $logbook->catatan }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="mdi mdi-content-save"></i> Simpan Validasi
                    </button>
                    <a href="{{ route('industri.logbook') }}" class="btn btn-light btn-block">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection