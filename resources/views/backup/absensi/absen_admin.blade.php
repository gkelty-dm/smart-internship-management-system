@extends('layouts.skydash-admin')

@section('title', 'Data Absensi Siswa')

@section('content')

{{-- ===========================
    HEADER
=========================== --}}
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <h4 class="card-title mb-1">

                            Data Absensi Siswa

                        </h4>

                        <p class="text-muted mb-0">

                            Monitoring seluruh data absensi siswa PKL.

                        </p>

                    </div>

                    <a
                        href="{{ route('dashboard') }}"
                        class="btn btn-secondary">

                        <i class="mdi mdi-arrow-left"></i>

                        Kembali

                    </a>

                </div>

            </div>
        </div>
    </div>
</div>


{{-- ===========================
    FLASH MESSAGE
=========================== --}}
@if(session('success'))

<div class="alert alert-success">

    <i class="mdi mdi-check-circle"></i>

    {{ session('success') }}

</div>

@endif


@if(session('error'))

<div class="alert alert-danger">

    <i class="mdi mdi-alert-circle"></i>

    {{ session('error') }}

</div>

@endif



{{-- ===========================
    DASHBOARD STATISTIK
=========================== --}}

<div class="row">

    <div class="col-xl-3 col-md-6 mb-4">

        <div class="card border-left-primary shadow h-100">

            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col">

                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">

                            Total Absensi

                        </div>

                        <div class="h3 mb-0 font-weight-bold">

                            {{ $totalAbsensi }}

                        </div>

                    </div>

                    <div class="col-auto">

                        <i class="mdi mdi-calendar-check mdi-36px text-primary"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <div class="col-xl-3 col-md-6 mb-4">

        <div class="card border-left-success shadow h-100">

            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col">

                        <div class="text-xs font-weight-bold text-success text-uppercase mb-2">

                            Hadir

                        </div>

                        <div class="h3 mb-0 font-weight-bold">

                            {{ $hadir }}

                        </div>

                    </div>

                    <div class="col-auto">

                        <i class="mdi mdi-check-circle mdi-36px text-success"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <div class="col-xl-2 col-md-6 mb-4">

        <div class="card border-left-warning shadow h-100">

            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col">

                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-2">

                            Izin

                        </div>

                        <div class="h3 mb-0 font-weight-bold">

                            {{ $izin }}

                        </div>

                    </div>

                    <div class="col-auto">

                        <i class="mdi mdi-information mdi-36px text-warning"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <div class="col-xl-2 col-md-6 mb-4">

        <div class="card border-left-info shadow h-100">

            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col">

                        <div class="text-xs font-weight-bold text-info text-uppercase mb-2">

                            Sakit

                        </div>

                        <div class="h3 mb-0 font-weight-bold">

                            {{ $sakit }}

                        </div>

                    </div>

                    <div class="col-auto">

                        <i class="mdi mdi-hospital mdi-36px text-info"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <div class="col-xl-2 col-md-6 mb-4">

        <div class="card border-left-danger shadow h-100">

            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col">

                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-2">

                            Alpha

                        </div>

                        <div class="h3 mb-0 font-weight-bold">

                            {{ $alpha }}

                        </div>

                    </div>

                    <div class="col-auto">

                        <i class="mdi mdi-close-circle mdi-36px text-danger"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



{{-- ===========================
    FILTER
=========================== --}}

<div class="card mb-4">

    <div class="card-body">

        <form
            method="GET"
            action="{{ route('admin.absensi') }}">

            <div class="row">

                <div class="col-md-3">

                    <label>

                        Nama Siswa

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari nama...">

                </div>

                <div class="col-md-2">

                    <label>

                        Tanggal

                    </label>

                    <input
                        type="date"
                        class="form-control"
                        name="tanggal"
                        value="{{ request('tanggal') }}">

                </div>

                <div class="col-md-2">

                    <label>

                        Jurusan

                    </label>

                    <select
                        name="jurusan"
                        class="form-control">

                        <option value="">

                            Semua Jurusan

                        </option>

                        @foreach($jurusans as $jurusan)

                            <option
                                value="{{ $jurusan->id }}"
                                {{ request('jurusan')==$jurusan->id ? 'selected' : '' }}>

                                {{ $jurusan->nama_jurusan }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-2">

                    <label>

                        Kelas

                    </label>

                    <select
                        name="kelas"
                        class="form-control">

                        <option value="">

                            Semua Kelas

                        </option>

                        @foreach($kelas as $item)

                            <option
                                value="{{ $item->id }}"
                                {{ request('kelas')==$item->id ? 'selected' : '' }}>

                                {{ $item->nama_kelas }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-2">

                    <label>

                        Status

                    </label>

                    <select
                        name="status"
                        class="form-control">

                        <option value="">Semua</option>

                        <option value="hadir">Hadir</option>

                        <option value="izin">Izin</option>

                        <option value="sakit">Sakit</option>

                        <option value="alpha">Alpha</option>

                    </select>

                </div>

                <div class="col-md-1">

                    <label>&nbsp;</label>

                    <button
                        class="btn btn-primary btn-block">

                        Cari

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>



{{-- ===========================
    TABEL
=========================== --}}

<div class="card">

<div class="card-body">

<div class="table-responsive">

<table class="table table-hover table-bordered">

<thead>

<tr>

<th>No</th>

<th>Tanggal</th>

<th>Nama Siswa</th>

<th>Jurusan</th>

<th>Kelas</th>

<th>Masuk</th>

<th>Pulang</th>

<th>Status</th>

<th>Verifikasi</th>

<th>Foto</th>

<th width="80">

Aksi

</th>

</tr>

</thead>

<tbody>

@forelse($absensis as $absensi)

<tr>

    <td>

        {{ $loop->iteration + ($absensis->firstItem() - 1) }}

    </td>

    <td>

        {{ \Carbon\Carbon::parse($absensi->tanggal)->format('d-m-Y') }}

    </td>

    <td>

        <div class="font-weight-bold">

            {{ $absensi->siswa->user->name }}

        </div>

        <small class="text-muted">

            {{ $absensi->siswa->user->email }}

        </small>

    </td>

    <td>

        <span class="badge badge-info">

            {{ $absensi->siswa->jurusan->nama_jurusan ?? '-' }}

        </span>

    </td>

    <td>

        {{ $absensi->siswa->kelas->nama_kelas ?? '-' }}

    </td>

    <td>

        @if($absensi->jam_masuk)

            <span class="badge badge-success">

                {{ $absensi->jam_masuk }}

            </span>

        @else

            <span class="text-muted">-</span>

        @endif

    </td>

    <td>

        @if($absensi->jam_pulang)

            <span class="badge badge-primary">

                {{ $absensi->jam_pulang }}

            </span>

        @else

            <span class="text-muted">

                -

            </span>

        @endif

    </td>

    <td>

        @switch($absensi->status)

            @case('hadir')

                <span class="badge badge-success">

                    Hadir

                </span>

            @break

            @case('izin')

                <span class="badge badge-warning">

                    Izin

                </span>

            @break

            @case('sakit')

                <span class="badge badge-info">

                    Sakit

                </span>

            @break

            @default

                <span class="badge badge-danger">

                    Alpha

                </span>

        @endswitch

    </td>

    <td>

        @php

            $verifikasi = match($absensi->metode_verifikasi){

                'gps' => 'GPS',

                'face' => 'FACE',

                'gps_face' => 'GPS + FACE',

                default => 'MANUAL'

            };

        @endphp

        <span class="badge badge-dark">

            {{ $verifikasi }}

        </span>

    </td>

    <td>

        <div class="d-flex justify-content-center">

            @if($absensi->foto_masuk)

                <a
                    href="{{ asset('storage/'.$absensi->foto_masuk) }}"
                    target="_blank"
                    class="btn btn-success btn-sm me-1"
                    title="Foto Masuk">

                    <i class="mdi mdi-camera"></i>

                </a>

            @endif


            @if($absensi->foto_pulang)

                <a
                    href="{{ asset('storage/'.$absensi->foto_pulang) }}"
                    target="_blank"
                    class="btn btn-info btn-sm"
                    title="Foto Pulang">

                    <i class="mdi mdi-camera-party-mode"></i>

                </a>

            @endif

        </div>

    </td>

    <td class="text-center">

        <button

            class="btn btn-outline-primary btn-sm"

            data-bs-toggle="modal"

            data-bs-target="#detail{{ $absensi->id }}">

            <i class="mdi mdi-eye"></i>

        </button>

    </td>

</tr>

@empty

<tr>

    <td colspan="11" class="text-center py-5">

        <i class="mdi mdi-calendar-remove mdi-48px text-muted d-block mb-2"></i>

        <h5 class="text-muted">

            Belum ada data absensi

        </h5>

    </td>

</tr>

@endforelse

</tbody>

</table>

</div>

<div class="mt-4 d-flex justify-content-end">

    {{ $absensis->withQueryString()->links('pagination::bootstrap-5') }}

</div>

</div>

</div>


{{-- =========================================================
    MODAL DETAIL ABSENSI
========================================================= --}}

@foreach($absensis as $absensi)

<div class="modal fade"
     id="detail{{ $absensi->id }}"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-scrollable">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <h5 class="modal-title">

                    <i class="mdi mdi-account-details"></i>

                    Detail Absensi Siswa

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <div class="row">

                    {{-- FOTO MASUK --}}
                    <div class="col-md-6">

                        <div class="card shadow-sm">

                            <div class="card-header bg-success text-white">

                                <i class="mdi mdi-camera"></i>

                                Foto Absen Masuk

                            </div>

                            <div class="card-body text-center">

                                @if($absensi->foto_masuk)

                                    <img
                                        src="{{ asset('storage/'.$absensi->foto_masuk) }}"
                                        class="img-fluid rounded border"
                                        style="max-height:350px;">

                                @else

                                    <div class="alert alert-light mb-0">

                                        Belum ada foto masuk.

                                    </div>

                                @endif

                            </div>

                        </div>

                    </div>



                    {{-- FOTO PULANG --}}
                    <div class="col-md-6">

                        <div class="card shadow-sm">

                            <div class="card-header bg-info text-white">

                                <i class="mdi mdi-camera-party-mode"></i>

                                Foto Absen Pulang

                            </div>

                            <div class="card-body text-center">

                                @if($absensi->foto_pulang)

                                    <img
                                        src="{{ asset('storage/'.$absensi->foto_pulang) }}"
                                        class="img-fluid rounded border"
                                        style="max-height:350px;">

                                @else

                                    <div class="alert alert-light mb-0">

                                        Belum melakukan absen pulang.

                                    </div>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>



                <div class="row mt-4">

                    <div class="col-md-6">

                        <div class="card">

                            <div class="card-header">

                                Biodata Siswa

                            </div>

                            <div class="card-body p-0">

                                <table class="table table-bordered mb-0">

                                    <tr>

                                        <th width="35%">

                                            Nama

                                        </th>

                                        <td>

                                            {{ $absensi->siswa->user->name }}

                                        </td>

                                    </tr>

                                    <tr>

                                        <th>

                                            Email

                                        </th>

                                        <td>

                                            {{ $absensi->siswa->user->email }}

                                        </td>

                                    </tr>

                                    <tr>

                                        <th>

                                            NISN

                                        </th>

                                        <td>

                                            {{ $absensi->siswa->nisn }}

                                        </td>

                                    </tr>

                                    <tr>

                                        <th>

                                            Jurusan

                                        </th>

                                        <td>

                                            {{ $absensi->siswa->jurusan->nama_jurusan ?? '-' }}

                                        </td>

                                    </tr>

                                    <tr>

                                        <th>

                                            Kelas

                                        </th>

                                        <td>

                                            {{ $absensi->siswa->kelas->nama_kelas ?? '-' }}

                                        </td>

                                    </tr>

                                </table>

                            </div>

                        </div>

                    </div>



                    <div class="col-md-6">

                        <div class="card">

                            <div class="card-header">

                                Informasi Absensi

                            </div>

                            <div class="card-body p-0">

                                <table class="table table-bordered mb-0">

                                    <tr>

                                        <th width="40%">

                                            Tanggal

                                        </th>

                                        <td>

                                            {{ \Carbon\Carbon::parse($absensi->tanggal)->format('d F Y') }}

                                        </td>

                                    </tr>

                                    <tr>

                                        <th>

                                            Jam Masuk

                                        </th>

                                        <td>

                                            {{ $absensi->jam_masuk ?? '-' }}

                                        </td>

                                    </tr>

                                    <tr>

                                        <th>

                                            Jam Pulang

                                        </th>

                                        <td>

                                            {{ $absensi->jam_pulang ?? '-' }}

                                        </td>

                                    </tr>

                                    <tr>

                                        <th>

                                            Status

                                        </th>

                                        <td>

                                            {{ ucfirst($absensi->status) }}

                                        </td>

                                    </tr>

                                    <tr>

                                        <th>

                                            Verifikasi

                                        </th>

                                        <td>

                                            {{ strtoupper(str_replace('_',' + ',$absensi->metode_verifikasi)) }}

                                        </td>

                                    </tr>

                                    <tr>

                                        <th>

                                            Device

                                        </th>

                                        <td>

                                            {{ $absensi->device_info ?? '-' }}

                                        </td>

                                    </tr>

                                    <tr>

                                        <th>

                                            IP Address

                                        </th>

                                        <td>

                                            {{ $absensi->ip_address ?? '-' }}

                                        </td>

                                    </tr>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>


                                {{-- ===========================
                    LOKASI ABSENSI
                =========================== --}}

                <div class="row mt-4">

                    {{-- Lokasi Masuk --}}
                    <div class="col-md-6">

                        <div class="card border-success">

                            <div class="card-header bg-success text-white">

                                <i class="mdi mdi-map-marker"></i>

                                Lokasi Absen Masuk

                            </div>

                            <div class="card-body">

                                <table class="table table-bordered">

                                    <tr>

                                        <th width="35%">

                                            Latitude

                                        </th>

                                        <td>

                                            {{ $absensi->latitude_masuk ?? '-' }}

                                        </td>

                                    </tr>

                                    <tr>

                                        <th>

                                            Longitude

                                        </th>

                                        <td>

                                            {{ $absensi->longitude_masuk ?? '-' }}

                                        </td>

                                    </tr>

                                </table>

                                @if($absensi->latitude_masuk && $absensi->longitude_masuk)

                                    <a
                                        href="https://www.google.com/maps?q={{ $absensi->latitude_masuk }},{{ $absensi->longitude_masuk }}"
                                        target="_blank"
                                        class="btn btn-success btn-block">

                                        <i class="mdi mdi-google-maps"></i>

                                        Lihat Lokasi Masuk

                                    </a>

                                @else

                                    <button
                                        class="btn btn-secondary btn-block"
                                        disabled>

                                        Lokasi Tidak Tersedia

                                    </button>

                                @endif

                            </div>

                        </div>

                    </div>



                    {{-- Lokasi Pulang --}}
                    <div class="col-md-6">

                        <div class="card border-info">

                            <div class="card-header bg-info text-white">

                                <i class="mdi mdi-map-marker-radius"></i>

                                Lokasi Absen Pulang

                            </div>

                            <div class="card-body">

                                <table class="table table-bordered">

                                    <tr>

                                        <th width="35%">

                                            Latitude

                                        </th>

                                        <td>

                                            {{ $absensi->latitude_pulang ?? '-' }}

                                        </td>

                                    </tr>

                                    <tr>

                                        <th>

                                            Longitude

                                        </th>

                                        <td>

                                            {{ $absensi->longitude_pulang ?? '-' }}

                                        </td>

                                    </tr>

                                </table>

                                @if($absensi->latitude_pulang && $absensi->longitude_pulang)

                                    <a
                                        href="https://www.google.com/maps?q={{ $absensi->latitude_pulang }},{{ $absensi->longitude_pulang }}"
                                        target="_blank"
                                        class="btn btn-info btn-block text-white">

                                        <i class="mdi mdi-google-maps"></i>

                                        Lihat Lokasi Pulang

                                    </a>

                                @else

                                    <button
                                        class="btn btn-secondary btn-block"
                                        disabled>

                                        Belum Absen Pulang

                                    </button>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    Tutup

                </button>

            </div>

        </div>

    </div>

</div>

@endforeach

@endsection