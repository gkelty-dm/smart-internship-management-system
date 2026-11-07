@extends('layouts.skydash-siswa')
@section('title', 'Tambah Logbook')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Tambah Logbook PKL</h3>
        <p class="text-muted">Silakan isi formulir di bawah ini untuk menambahkan kegiatan harian Anda.</p>
    </div>

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><i class="mdi mdi-pencil-plus"></i> Formulir Logbook</h4>
                
                <form action="{{ route('siswa.logbook.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>Tanggal Kegiatan</label>
                        <input type="date" name="tanggal" required class="form-control" value="{{ date('Y-m-d') }}">
                    </div>

                    <div class="form-group">
                        <label>Deskripsi Kegiatan</label>
                        <textarea name="kegiatan" rows="4" required class="form-control" placeholder="Jelaskan apa yang Anda kerjakan hari ini..."></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kendala (Opsional)</label>
                                <textarea name="kendala" rows="3" class="form-control" placeholder="Apakah ada masalah yang dihadapi?"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Solusi (Opsional)</label>
                                <textarea name="solusi" rows="3" class="form-control" placeholder="Bagaimana Anda menyelesaikan kendala tersebut?"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Foto Kegiatan</label>
                        <input type="file" name="foto[]" multiple class="form-control">
                        <small class="text-muted mt-1 d-block">Anda dapat memilih lebih dari satu foto kegiatan.</small>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="mdi mdi-content-save"></i> Simpan Logbook
                        </button>
                        <a href="{{ route('siswa.logbook') }}" class="btn btn-light">
                            <i class="mdi mdi-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection