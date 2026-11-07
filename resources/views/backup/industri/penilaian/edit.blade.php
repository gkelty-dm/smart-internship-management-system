@extends('layouts.skydash-industri')

@section('title', 'Edit Penilaian')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Edit Penilaian Industri</h3>
        <p class="text-muted">Perbarui data evaluasi kinerja untuk siswa: <strong>{{ $penilaianIndustri->penempatan->siswa->user->name }}</strong>.</p>
    </div>

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Formulir Edit Penilaian</h4>
                
                <form action="{{ route('industri.penilaian.update', $penilaianIndustri->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Disiplin</label>
                                <input type="number" name="disiplin" class="form-control" value="{{ $penilaianIndustri->disiplin }}" min="0" max="100" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kerjasama</label>
                                <input type="number" name="kerjasama" class="form-control" value="{{ $penilaianIndustri->kerjasama }}" min="0" max="100" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Inisiatif</label>
                                <input type="number" name="inisiatif" class="form-control" value="{{ $penilaianIndustri->inisiatif }}" min="0" max="100" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggung Jawab</label>
                                <input type="number" name="tanggung_jawab" class="form-control" value="{{ $penilaianIndustri->tanggung_jawab }}" min="0" max="100" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Keterampilan</label>
                                <input type="number" name="keterampilan" class="form-control" value="{{ $penilaianIndustri->keterampilan }}" min="0" max="100" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label>Catatan</label>
                        <textarea name="catatan" class="form-control" rows="4">{{ $penilaianIndustri->catatan }}</textarea>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="mdi mdi-check"></i> Update Penilaian
                        </button>
                        <a href="{{ route('industri.penilaian') }}" class="btn btn-light">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection