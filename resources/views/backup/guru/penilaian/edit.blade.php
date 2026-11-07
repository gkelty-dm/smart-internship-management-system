@extends('layouts.skydash-guru')

@section('title', 'Edit Penilaian Guru')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Edit Penilaian Siswa</h3>
        <p class="text-muted">Perbarui data penilaian untuk siswa 
            <span class="text-primary font-weight-bold">{{ $penilaianGuru->penempatan->siswa->user->name ?? 'Siswa' }}</span>.
        </p>
    </div>

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="mdi mdi-pencil-box-multiple text-primary"></i> Formulir Edit Nilai
                </h4>

                <form action="{{ route('guru.penilaian.update', $penilaianGuru->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Disiplin</label>
                            <input type="number" name="disiplin" value="{{ $penilaianGuru->disiplin }}" min="0" max="100" required class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Kerjasama</label>
                            <input type="number" name="kerjasama" value="{{ $penilaianGuru->kerjasama }}" min="0" max="100" required class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Inisiatif</label>
                            <input type="number" name="inisiatif" value="{{ $penilaianGuru->inisiatif }}" min="0" max="100" required class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Tanggung Jawab</label>
                            <input type="number" name="tanggung_jawab" value="{{ $penilaianGuru->tanggung_jawab }}" min="0" max="100" required class="form-control">
                        </div>
                        <div class="col-12 form-group">
                            <label>Keterampilan</label>
                            <input type="number" name="keterampilan" value="{{ $penilaianGuru->keterampilan }}" min="0" max="100" required class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Catatan Guru</label>
                        <textarea name="catatan" rows="4" class="form-control">{{ $penilaianGuru->catatan }}</textarea>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="mdi mdi-check-bold"></i> Update Penilaian
                        </button>
                        <a href="{{ route('guru.penilaian') }}" class="btn btn-light">
                            <i class="mdi mdi-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection