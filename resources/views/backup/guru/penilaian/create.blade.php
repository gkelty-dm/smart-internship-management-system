@extends('layouts.skydash-guru')

@section('title', 'Penilaian Siswa')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Formulir Penilaian Siswa</h3>
        <p class="text-muted">Berikan penilaian objektif berdasarkan performa siswa selama PKL.</p>
    </div>

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="mdi mdi-clipboard-check text-primary"></i> Input Nilai Siswa
                </h4>

                {{-- Informasi Siswa --}}
                <div class="bg-light p-3 rounded mb-4 border">
                    <div class="row">
                        <div class="col-md-6">
                            <small class="text-muted text-uppercase font-weight-bold">Nama Siswa</small>
                            <p class="font-weight-bold text-dark mb-0">{{ $penempatan->siswa->user->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted text-uppercase font-weight-bold">Perusahaan</small>
                            <p class="font-weight-bold text-dark mb-0">{{ $penempatan->perusahaan->nama_perusahaan }}</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('guru.penilaian.store', $penempatan->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Disiplin</label>
                            <input type="number" name="disiplin" min="0" max="100" required class="form-control" placeholder="0 - 100">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Kerjasama</label>
                            <input type="number" name="kerjasama" min="0" max="100" required class="form-control" placeholder="0 - 100">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Inisiatif</label>
                            <input type="number" name="inisiatif" min="0" max="100" required class="form-control" placeholder="0 - 100">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Tanggung Jawab</label>
                            <input type="number" name="tanggung_jawab" min="0" max="100" required class="form-control" placeholder="0 - 100">
                        </div>
                        <div class="col-12 form-group">
                            <label>Keterampilan</label>
                            <input type="number" name="keterampilan" min="0" max="100" required class="form-control" placeholder="0 - 100">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Catatan Guru</label>
                        <textarea name="catatan" rows="4" class="form-control" placeholder="Berikan evaluasi atau pesan untuk siswa..."></textarea>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="mdi mdi-content-save"></i> Simpan Penilaian
                        </button>
                        <a href="{{ route('guru.penilaian') }}" class="btn btn-light">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection