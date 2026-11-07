@extends('layouts.skydash-siswa')

@section('title', 'Nilai PKL')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Nilai PKL</h3>
        <p class="text-muted">Hasil penilaian Praktik Kerja Lapangan Anda.</p>
    </div>

    @if($nilaiPKL)
    <div class="col-12">
        <div class="row">
            {{-- Nilai Guru --}}
            <div class="col-md-3 grid-margin stretch-card">
                <div class="card card-tale">
                    <div class="card-body text-white">
                        <p class="mb-2">Nilai Guru</p>
                        <h2 class="font-weight-bold">{{ $nilaiPKL->nilai_guru }}</h2>
                    </div>
                </div>
            </div>
            {{-- Nilai Industri --}}
            <div class="col-md-3 grid-margin stretch-card">
                <div class="card card-dark-blue">
                    <div class="card-body text-white">
                        <p class="mb-2">Nilai Industri</p>
                        <h2 class="font-weight-bold">{{ $nilaiPKL->nilai_industri }}</h2>
                    </div>
                </div>
            </div>
            {{-- Nilai Akhir --}}
            <div class="col-md-3 grid-margin stretch-card">
                <div class="card card-light-blue">
                    <div class="card-body text-white">
                        <p class="mb-2">Nilai Akhir</p>
                        <h2 class="font-weight-bold">{{ $nilaiPKL->nilai_akhir }}</h2>
                    </div>
                </div>
            </div>
            {{-- Predikat --}}
            <div class="col-md-3 grid-margin stretch-card">
                <div class="card card-light-danger">
                    <div class="card-body text-white">
                        <p class="mb-2">Predikat</p>
                        <h2 class="font-weight-bold">{{ $nilaiPKL->predikat }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="col-12">
        <div class="alert alert-warning" role="alert">
            <i class="mdi mdi-alert-outline"></i> Nilai PKL belum tersedia.
        </div>
    </div>
    @endif
</div>
@endsection