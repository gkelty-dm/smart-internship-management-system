@extends('layouts.skydash-industri')

@section('title', 'Dashboard Industri')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Dashboard Industri</h3>
        <p class="text-muted">Selamat datang, {{ auth()->user()->name }}</p>
    </div>

    {{-- Sisanya tetap sama seperti sebelumnya --}}
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card card-tale">
            <div class="card-body">
                <p class="mb-4">Total Siswa PKL</p>
                <p class="fs-30 mb-2 font-weight-bold">{{ $jumlahSiswa }}</p>
            </div>
        </div>
    </div>
</div>
...
@endsection