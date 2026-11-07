@extends('layouts.skydash-guru')

@section('title', 'Detail Logbook')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Detail Logbook</h3>
        <p class="text-muted">Tinjau kegiatan siswa dan berikan validasi.</p>
    </div>

    {{-- Kolom Kiri: Informasi Logbook --}}
    <div class="col-lg-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><i class="mdi mdi-information-outline text-primary"></i> Informasi Logbook</h4>
                <hr>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p class="text-muted mb-1 font-weight-bold">Nama Siswa</p>
                        <p class="text-dark">{{ $logbook->siswa->user->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-1 font-weight-bold">Tanggal</p>
                        <p class="text-dark">{{ \Carbon\Carbon::parse($logbook->tanggal)->format('d F Y') }}</p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="font-weight-bold">Kegiatan</label>
                    <div class="p-3 bg-light border rounded">{{ $logbook->kegiatan }}</div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label class="font-weight-bold">Kendala</label>
                        <div class="p-3 bg-light border rounded">{{ $logbook->kendala ?? '-' }}</div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="font-weight-bold">Solusi</label>
                        <div class="p-3 bg-light border rounded">{{ $logbook->solusi ?? '-' }}</div>
                    </div>
                </div>

                <div class="mt-3">
                    <label class="font-weight-bold">Foto Kegiatan</label>
                    <div class="row mt-2">
                        @foreach($logbook->fotos as $foto)
                            <div class="col-md-3">
                                <img src="{{ asset('storage/'.$foto->foto) }}" class="img-fluid rounded border shadow-sm">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Kolom Kanan: Form Validasi --}}
    <div class="col-lg-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><i class="mdi mdi-checkbox-marked-circle-outline text-success"></i> Validasi Guru</h4>
                <hr>
                <form action="{{ route('guru.logbook.validasi', $logbook->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Status Validasi</label>
                        <select name="status_validasi" class="form-control">
                            <option value="disetujui" {{ $logbook->status_validasi == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="ditolak" {{ $logbook->status_validasi == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Catatan Guru</label>
                        <textarea name="catatan_guru" rows="5" class="form-control" placeholder="Berikan catatan...">{{ $logbook->catatan_guru }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success btn-block">
                        <i class="mdi mdi-check"></i> Simpan Validasi
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection