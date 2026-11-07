@extends('layouts.skydash-guru')

@section('title', 'Detail Penilaian Siswa')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Detail Penilaian PKL</h3>
        <p class="text-muted">Riwayat penilaian untuk siswa: <strong>{{ $siswa->user->name }}</strong></p>
    </div>

    {{-- Penilaian Industri & Guru --}}
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-primary"><i class="mdi mdi-factory"></i> Nilai Industri</h4>
                @if($penilaianIndustri)
                    <table class="table table-striped">
                        <tbody>
                            <tr><td>Disiplin</td><td>{{ $penilaianIndustri->disiplin }}</td></tr>
                            <tr><td>Kerjasama</td><td>{{ $penilaianIndustri->kerjasama }}</td></tr>
                            <tr><td>Inisiatif</td><td>{{ $penilaianIndustri->inisiatif }}</td></tr>
                            <tr><td>Tanggung Jawab</td><td>{{ $penilaianIndustri->tanggung_jawab }}</td></tr>
                            <tr><td>Keterampilan</td><td>{{ $penilaianIndustri->keterampilan }}</td></tr>
                            <tr class="table-info font-weight-bold"><td>Nilai Akhir</td><td>{{ $penilaianIndustri->nilai_akhir }}</td></tr>
                        </tbody>
                    </table>
                @else
                    <p class="text-muted">Belum ada penilaian dari industri.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-primary"><i class="mdi mdi-teach"></i> Nilai Guru</h4>
                @if($penilaianGuru)
                    <table class="table table-striped">
                        <tbody>
                            <tr><td>Disiplin</td><td>{{ $penilaianGuru->disiplin }}</td></tr>
                            <tr><td>Kerjasama</td><td>{{ $penilaianGuru->kerjasama }}</td></tr>
                            <tr><td>Inisiatif</td><td>{{ $penilaianGuru->inisiatif }}</td></tr>
                            <tr><td>Tanggung Jawab</td><td>{{ $penilaianGuru->tanggung_jawab }}</td></tr>
                            <tr><td>Keterampilan</td><td>{{ $penilaianGuru->keterampilan }}</td></tr>
                            <tr class="table-info font-weight-bold"><td>Nilai Akhir</td><td>{{ $penilaianGuru->nilai_akhir }}</td></tr>
                        </tbody>
                    </table>
                @else
                    <p class="text-muted">Belum ada penilaian dari guru.</p>
                @endif
            </div>
        </div>
    </div>

    {{-- Nilai Akhir --}}
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-success"><i class="mdi mdi-checkbox-marked-circle-outline"></i> Nilai Akhir PKL</h4>
                @if($nilaiPKL)
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tr><td>Nilai Industri</td><td><strong>{{ $nilaiPKL->nilai_industri }}</strong></td></tr>
                                <tr><td>Nilai Guru</td><td><strong>{{ $nilaiPKL->nilai_guru }}</strong></td></tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="alert alert-success">
                                <h4 class="alert-heading">Nilai Akhir: {{ $nilaiPKL->nilai_akhir }}</h4>
                                <p class="mb-0">Predikat: <strong>{{ $nilaiPKL->predikat }}</strong></p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning">
                        Nilai akhir belum tersedia karena penilaian guru atau industri belum lengkap.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection