@extends('layouts.skydash-guru')

@section('title', 'Detail Siswa')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Detail Siswa PKL</h3>
        <p class="text-muted">Informasi lengkap data siswa dan riwayat kegiatan PKL.</p>
    </div>

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Informasi Siswa</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">Nama</label>
                            <div class="col-sm-8"><p class="form-control-static">{{ $siswa->user->name }}</p></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">NISN</label>
                            <div class="col-sm-8"><p class="form-control-static">{{ $siswa->nisn }}</p></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">Jurusan</label>
                            <div class="col-sm-8"><p class="form-control-static">{{ $siswa->jurusan->nama_jurusan ?? '-' }}</p></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">Kelas</label>
                            <div class="col-sm-8"><p class="form-control-static">{{ $siswa->kelas->nama_kelas ?? '-' }}</p></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">Perusahaan</label>
                            <div class="col-sm-8"><p class="form-control-static">{{ $penempatan->perusahaan->nama_perusahaan ?? '-' }}</p></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">Status PKL</label>
                            <div class="col-sm-8">
                                <p class="form-control-static">
                                    <label class="badge badge-{{ $penempatan->status_pkl == 'aktif' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($penempatan->status_pkl ?? '-') }}
                                    </label>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Aksi Navigasi</h4>
                <div class="template-demo">
                    <a href="{{ route('guru.siswa.absensi', $siswa->id) }}" class="btn btn-primary btn-icon-text">
                        <i class="mdi mdi-calendar-check btn-icon-prepend"></i> Detail Absensi
                    </a>
                    <a href="{{ route('guru.siswa.logbook', $siswa->id) }}" class="btn btn-success btn-icon-text">
                        <i class="mdi mdi-book-open-page-variant btn-icon-prepend"></i> Detail Logbook
                    </a>
                    <a href="{{ route('guru.siswa.penilaian', $siswa->id) }}" class="btn btn-warning btn-icon-text">
                        <i class="mdi mdi-star btn-icon-prepend"></i> Detail Penilaian
                    </a>
                    <a href="{{ route('guru.siswa.laporan', $siswa->id) }}" class="btn btn-danger btn-icon-text">
                        <i class="mdi mdi-file-pdf btn-icon-prepend"></i> Cetak PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection