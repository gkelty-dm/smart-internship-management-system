@extends('layouts.skydash-industri')

@section('title', 'Beri Nilai Siswa')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Penilaian Siswa PKL</h3>
        <p class="text-muted">Isikan penilaian kinerja siswa untuk <strong>{{ $penempatan->siswa->user->name }}</strong>.</p>
    </div>

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Formulir Penilaian</h4>
                
                <form action="{{ route('industri.penilaian.store', $penempatan->id) }}" method="POST">
                    @csrf
                    
                    <div class="form-group mb-4">
                        <label class="font-weight-bold">Nama Siswa</label>
                        <input type="text" class="form-control form-control-lg" value="{{ $penempatan->siswa->user->name }}" readonly>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Disiplin (0-100)</label>
                                <input type="number" name="disiplin" class="form-control" min="0" max="100" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kerjasama (0-100)</label>
                                <input type="number" name="kerjasama" class="form-control" min="0" max="100" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Inisiatif (0-100)</label>
                                <input type="number" name="inisiatif" class="form-control" min="0" max="100" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggung Jawab (0-100)</label>
                                <input type="number" name="tanggung_jawab" class="form-control" min="0" max="100" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Keterampilan (0-100)</label>
                                <input type="number" name="keterampilan" class="form-control" min="0" max="100" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label>Catatan</label>
                        <textarea name="catatan" class="form-control" rows="4" placeholder="Berikan catatan atau masukan tambahan..."></textarea>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="mdi mdi-content-save"></i> Simpan Penilaian
                        </button>
                        <a href="{{ route('industri.penilaian') }}" class="btn btn-light">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection