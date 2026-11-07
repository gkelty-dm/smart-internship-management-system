@extends('layouts.skydash-admin')

@section('title', 'Detail Perusahaan')

@section('content')

<div class="row">

    {{-- HEADER --}}
    <div class="col-12 grid-margin">

        <div class="d-flex justify-content-between align-items-center">

            <div>
                <h4 class="font-weight-bold mb-1">
                    Detail Perusahaan
                </h4>

                <p class="text-muted mb-0">
                    Informasi perusahaan, lokasi GPS, pembimbing industri,
                    dan siswa PKL.
                </p>
            </div>

            <div>

                <a href="{{ route(
                    'admin.perusahaan.edit',
                    $perusahaan->id
                ) }}"
                    class="btn btn-primary me-2">

                    <i class="mdi mdi-square-edit-outline me-1"></i>

                    Edit

                </a>

                <a href="{{ route(
                    'admin.perusahaan.index'
                ) }}"
                    class="btn btn-light">

                    <i class="mdi mdi-arrow-left me-1"></i>

                    Kembali

                </a>

            </div>

        </div>

    </div>


    {{-- INFORMASI PERUSAHAAN --}}
    <div class="col-lg-6 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <h5 class="card-title">

                    <i class="mdi mdi-domain text-primary me-1"></i>

                    Informasi Perusahaan

                </h5>


                <div class="text-center py-3">

                    <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center"
                        style="width:100px;height:100px;">

                        <i class="mdi mdi-domain text-primary"
                            style="font-size:55px;">
                        </i>

                    </div>


                    <h5 class="font-weight-bold mt-3 mb-1">

                        {{ $perusahaan->nama_perusahaan }}

                    </h5>

                    <p class="text-muted mb-0">

                        ID Perusahaan:
                        {{ $perusahaan->id }}

                    </p>

                </div>


                <hr>


                <div class="mb-3">

                    <small class="text-muted d-block">
                        Alamat
                    </small>

                    <p class="mb-0">

                        {{ $perusahaan->alamat }}

                    </p>

                </div>


                <div class="row">

                    <div class="col-md-6 mb-3">

                        <small class="text-muted d-block">
                            Telepon
                        </small>

                        <strong>

                            {{ $perusahaan->telepon ?? '-' }}

                        </strong>

                    </div>


                    <div class="col-md-6 mb-3">

                        <small class="text-muted d-block">
                            Email
                        </small>

                        <strong>

                            {{ $perusahaan->email ?? '-' }}

                        </strong>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- LOKASI GPS --}}
    <div class="col-lg-6 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <h5 class="card-title">

                    <i class="mdi mdi-map-marker-radius-outline text-primary me-1"></i>

                    Lokasi & Absensi GPS

                </h5>


                @if(
                $perusahaan->latitude !== null &&
                $perusahaan->longitude !== null
                )

                <div class="alert alert-success">

                    <i class="mdi mdi-map-marker-check-outline me-1"></i>

                    Lokasi GPS sudah tersedia.

                </div>


                <div class="row">

                    <div class="col-md-6 mb-3">

                        <div class="border rounded p-3">

                            <small class="text-muted d-block">
                                Latitude
                            </small>

                            <strong>

                                {{ $perusahaan->latitude }}

                            </strong>

                        </div>

                    </div>


                    <div class="col-md-6 mb-3">

                        <div class="border rounded p-3">

                            <small class="text-muted d-block">
                                Longitude
                            </small>

                            <strong>

                                {{ $perusahaan->longitude }}

                            </strong>

                        </div>

                    </div>

                </div>


                <div class="border rounded p-3">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted d-block">
                                Radius Absensi
                            </small>

                            <h4 class="font-weight-bold mb-0">

                                {{ $perusahaan->radius_absensi }}

                                <small class="font-weight-normal">
                                    meter
                                </small>

                            </h4>

                        </div>


                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center"
                            style="width:50px;height:50px;">

                            <i class="mdi mdi-map-marker-radius-outline text-white"
                                style="font-size:25px;">
                            </i>

                        </div>

                    </div>

                </div>


                <div class="mt-3">

                    <a href="https://www.google.com/maps/search/?api=1&query={{ $perusahaan->latitude }},{{ $perusahaan->longitude }}"
                        target="_blank"
                        class="btn btn-outline-primary btn-sm">

                        <i class="mdi mdi-map-outline me-1"></i>

                        Buka di Google Maps

                    </a>

                </div>

                @else

                <div class="text-center py-5">

                    <i class="mdi mdi-map-marker-off-outline text-warning"
                        style="font-size:55px;">
                    </i>

                    <h6 class="font-weight-bold mt-3">

                        Lokasi GPS Belum Diatur

                    </h6>

                    <p class="text-muted mb-3">

                        Latitude dan longitude perusahaan
                        belum tersedia.

                    </p>


                    <a href="{{ route(
                            'admin.perusahaan.edit',
                            $perusahaan->id
                        ) }}"
                        class="btn btn-primary btn-sm">

                        <i class="mdi mdi-map-marker-plus-outline me-1"></i>

                        Atur Lokasi

                    </a>

                </div>

                @endif

            </div>

        </div>

    </div>


    {{-- PEMBIMBING INDUSTRI --}}
    <div class="col-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <div>

                        <h5 class="card-title mb-1">

                            <i class="mdi mdi-account-tie-outline text-primary me-1"></i>

                            Pembimbing Industri

                        </h5>

                        <p class="text-muted mb-0">

                            Pembimbing industri yang terhubung dengan perusahaan ini.

                        </p>

                    </div>


                    <span class="badge badge-primary">

                        {{ $perusahaan->industris->count() }}

                        Pembimbing

                    </span>

                </div>


                <div class="table-responsive">

                    <table class="table table-hover">

                        <thead>

                            <tr>

                                <th>No</th>

                                <th>Nama</th>

                                <th>Email</th>

                                <th>Jabatan</th>

                                <th>No. HP</th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($perusahaan->industris as $industri)

                            <tr>

                                <td>

                                    {{ $loop->iteration }}

                                </td>


                                <td>

                                    <strong>

                                        {{ $industri->user->name ?? '-' }}

                                    </strong>

                                </td>


                                <td>

                                    {{ $industri->user->email ?? '-' }}

                                </td>


                                <td>

                                    {{ $industri->jabatan ?? '-' }}

                                </td>


                                <td>

                                    {{ $industri->no_hp ?? '-' }}

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="5"
                                    class="text-center py-4">

                                    <i class="mdi mdi-account-off-outline text-muted"
                                        style="font-size:45px;">
                                    </i>

                                    <p class="text-muted mb-0 mt-2">

                                        Belum ada pembimbing industri
                                        pada perusahaan ini.

                                    </p>

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>


    {{-- SISWA PKL --}}
    <div class="col-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <div>

                        <h5 class="card-title mb-1">

                            <i class="mdi mdi-account-school-outline text-primary me-1"></i>

                            Siswa PKL

                        </h5>

                        <p class="text-muted mb-0">

                            Siswa yang ditempatkan pada perusahaan ini.

                        </p>

                    </div>


                    <span class="badge badge-primary">

                        {{ $perusahaan->penempatanPKL->count() }}

                        Siswa

                    </span>

                </div>


                <div class="table-responsive">

                    <table class="table table-hover">

                        <thead>

                            <tr>

                                <th>No</th>

                                <th>Siswa</th>

                                <th>NISN</th>

                                <th>Guru Pembimbing</th>

                                <th>Pembimbing Industri</th>

                                <th>Periode</th>

                                <th>Status</th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($perusahaan->penempatanPKL as $penempatan)

                            <tr>

                                <td>

                                    {{ $loop->iteration }}

                                </td>


                                <td>

                                    <strong>

                                        {{ $penempatan->siswa->user->name ?? '-' }}

                                    </strong>

                                </td>


                                <td>

                                    {{ $penempatan->siswa->nisn ?? '-' }}

                                </td>


                                <td>

                                    {{ $penempatan->guru->user->name ?? '-' }}

                                </td>


                                <td>

                                    {{ $penempatan->industri->user->name ?? '-' }}

                                </td>


                                <td>

                                    <small class="d-block">

                                        {{ $penempatan->tanggal_mulai
                                                ? \Carbon\Carbon::parse(
                                                    $penempatan->tanggal_mulai
                                                )->format('d/m/Y')
                                                : '-'
                                            }}

                                    </small>

                                    <small class="text-muted">

                                        s/d

                                        {{ $penempatan->tanggal_selesai
                                                ? \Carbon\Carbon::parse(
                                                    $penempatan->tanggal_selesai
                                                )->format('d/m/Y')
                                                : '-'
                                            }}

                                    </small>

                                </td>


                                <td>

                                    @if($penempatan->status_pkl === 'aktif')

                                    <span class="badge badge-success">
                                        Aktif
                                    </span>

                                    @elseif($penempatan->status_pkl === 'selesai')

                                    <span class="badge badge-primary">
                                        Selesai
                                    </span>

                                    @else

                                    <span class="badge badge-secondary">

                                        {{ ucfirst(
                                                    $penempatan->status_pkl ?? '-'
                                                ) }}

                                    </span>

                                    @endif

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="7"
                                    class="text-center py-4">

                                    <i class="mdi mdi-account-school-outline text-muted"
                                        style="font-size:45px;">
                                    </i>

                                    <p class="text-muted mb-0 mt-2">

                                        Belum ada siswa PKL
                                        pada perusahaan ini.

                                    </p>

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection