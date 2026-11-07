@extends('layouts.skydash-industri')

@section('title', 'Penilaian Siswa')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Penilaian Siswa</h3>
        <p class="text-muted">Hasil evaluasi kinerja siswa: <strong>{{ $siswa->user->name }}</strong></p>
    </div>

    @if($penilaianIndustri)
    <div class="col-md-7 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail Kriteria Penilaian</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <tr><td>Disiplin</td><td>{{ $penilaianIndustri->disiplin }}</td></tr>
                            <tr><td>Kerjasama</td><td>{{ $penilaianIndustri->kerjasama }}</td></tr>
                            <tr><td>Inisiatif</td><td>{{ $penilaianIndustri->inisiatif }}</td></tr>
                            <tr><td>Tanggung Jawab</td><td>{{ $penilaianIndustri->tanggung_jawab }}</td></tr>
                            <tr><td>Keterampilan</td><td>{{ $penilaianIndustri->keterampilan }}</td></tr>
                            <tr class="table-info">
                                <td><strong>Nilai Industri</strong></td>
                                <td><strong>{{ $penilaianIndustri->nilai_akhir }}</strong></td>
                            </tr>
                            <tr><td>Catatan</td><td>{{ $penilaianIndustri->catatan ?? '-' }}</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-5 grid-margin stretch-card">
        @if($nilaiPKL)
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h4 class="card-title text-white">Rangkuman Nilai Akhir</h4>
                <div class="d-flex justify-content-between pt-3">
                    <p>Nilai Industri</p>
                    <p class="font-weight-bold">{{ $nilaiPKL->nilai_industri }}</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p>Nilai Guru</p>
                    <p class="font-weight-bold">{{ $nilaiPKL->nilai_guru }}</p>
                </div>
                <hr class="border-white">
                <div class="d-flex justify-content-between">
                    <p>Nilai Akhir</p>
                    <h2 class="font-weight-bold">{{ $nilaiPKL->nilai_akhir }}</h2>
                </div>
                <div class="d-flex justify-content-between">
                    <p>Predikat</p>
                    <h4 class="badge badge-light">{{ $nilaiPKL->predikat }}</h4>
                </div>
            </div>
        </div>
        @endif
    </div>
    @else
    <div class="col-12">
        <div class="alert alert-warning">
            <i class="mdi mdi-alert-outline"></i> Belum ada data penilaian industri untuk siswa ini.
        </div>
    </div>
    @endif

    <div class="col-12">
        <a href="{{ route('industri.siswa') }}" class="btn btn-light">
            <i class="mdi mdi-arrow-left"></i> Kembali
        </a>
    </div>
</div>
@endsection