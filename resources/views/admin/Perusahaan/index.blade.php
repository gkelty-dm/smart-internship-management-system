@extends('layouts.skydash-admin')

@section('title', 'Perusahaan / Lokasi Industri')

@section('content')

<div class="row">

    {{-- HEADER --}}
    <div class="col-12 grid-margin">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h4 class="font-weight-bold mb-1">
                    Perusahaan / Lokasi Industri
                </h4>

                <p class="text-muted mb-0">
                    Kelola data perusahaan dan lokasi pelaksanaan PKL.
                </p>

            </div>

            <a href="{{ route('admin.perusahaan.create') }}"
                class="btn btn-primary">

                <i class="mdi mdi-domain-plus me-1"></i>

                Tambah Perusahaan

            </a>

        </div>

    </div>


    {{-- SUCCESS --}}
    @if(session('success'))

    <div class="col-12">

        <div class="alert alert-success">

            <i class="mdi mdi-check-circle-outline me-1"></i>

            {{ session('success') }}

        </div>

    </div>

    @endif


    {{-- ERROR --}}
    @if(session('error'))

    <div class="col-12">

        <div class="alert alert-danger">

            <i class="mdi mdi-alert-circle-outline me-1"></i>

            {{ session('error') }}

        </div>

    </div>

    @endif


    {{-- STATISTIK TOTAL --}}
    <div class="col-md-4 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <p class="text-muted mb-1">
                            Total Perusahaan
                        </p>

                        <h3 class="font-weight-bold mb-0">
                            {{ $totalPerusahaan }}
                        </h3>

                    </div>

                    <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center"
                        style="width:50px;height:50px;">

                        <i class="mdi mdi-domain text-white"
                            style="font-size:25px;">
                        </i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- STATISTIK ADA LOKASI --}}
    <div class="col-md-4 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <p class="text-muted mb-1">
                            Lokasi GPS Tersedia
                        </p>

                        <h3 class="font-weight-bold text-success mb-0">
                            {{ $totalDenganLokasi }}
                        </h3>

                    </div>

                    <div class="rounded-circle bg-success d-flex align-items-center justify-content-center"
                        style="width:50px;height:50px;">

                        <i class="mdi mdi-map-marker-check-outline text-white"
                            style="font-size:25px;">
                        </i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- STATISTIK BELUM ADA LOKASI --}}
    <div class="col-md-4 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <p class="text-muted mb-1">
                            Belum Ada Lokasi GPS
                        </p>

                        <h3 class="font-weight-bold text-warning mb-0">
                            {{ $totalTanpaLokasi }}
                        </h3>

                    </div>

                    <div class="rounded-circle bg-warning d-flex align-items-center justify-content-center"
                        style="width:50px;height:50px;">

                        <i class="mdi mdi-map-marker-off-outline text-white"
                            style="font-size:25px;">
                        </i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- FILTER --}}
    <div class="col-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <h5 class="card-title">

                    <i class="mdi mdi-filter-outline text-primary me-1"></i>

                    Cari Perusahaan

                </h5>


                <form method="GET"
                    action="{{ route('admin.perusahaan.index') }}">

                    <div class="row align-items-end">

                        <div class="col-md-10">

                            <div class="form-group mb-md-0">

                                <label for="search">
                                    Pencarian
                                </label>

                                <input type="text"
                                    name="search"
                                    id="search"
                                    class="form-control"
                                    value="{{ request('search') }}"
                                    placeholder="Nama perusahaan, alamat, telepon, atau email">

                            </div>

                        </div>


                        <div class="col-md-2">

                            <div class="form-group mb-md-0">

                                <button type="submit"
                                    class="btn btn-primary w-100">

                                    <i class="mdi mdi-magnify me-1"></i>

                                    Cari

                                </button>

                            </div>

                        </div>

                    </div>


                    @if(request('search'))

                    <div class="mt-3">

                        <a href="{{ route('admin.perusahaan.index') }}"
                            class="btn btn-light btn-sm">

                            <i class="mdi mdi-refresh me-1"></i>

                            Reset

                        </a>

                    </div>

                    @endif

                </form>

            </div>

        </div>

    </div>


    {{-- TABEL --}}
    <div class="col-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <div>

                        <h5 class="card-title mb-1">
                            Daftar Perusahaan
                        </h5>

                        <p class="text-muted mb-0">
                            Data perusahaan yang menjadi lokasi PKL.
                        </p>

                    </div>

                    <span class="badge badge-primary">

                        {{ $perusahaans->total() }}

                        Data

                    </span>

                </div>


                <div class="table-responsive">

                    <table class="table table-hover">

                        <thead>

                            <tr>

                                <th>No</th>

                                <th>Perusahaan</th>

                                <th>Alamat</th>

                                <th>Kontak</th>

                                <th>Lokasi GPS</th>

                                <th>Radius</th>

                                <th class="text-center">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($perusahaans as $perusahaan)

                            <tr>

                                {{-- NO --}}
                                <td>

                                    {{ $perusahaans->firstItem() + $loop->index }}

                                </td>


                                {{-- PERUSAHAAN --}}
                                <td>

                                    <div>

                                        <h6 class="font-weight-bold mb-1">

                                            {{ $perusahaan->nama_perusahaan }}

                                        </h6>

                                        <small class="text-muted">

                                            ID:
                                            {{ $perusahaan->id }}

                                        </small>

                                    </div>

                                </td>


                                {{-- ALAMAT --}}
                                <td>

                                    <span style="white-space: normal;">

                                        {{ $perusahaan->alamat }}

                                    </span>

                                </td>


                                {{-- KONTAK --}}
                                <td>

                                    @if($perusahaan->telepon)

                                    <small class="d-block">

                                        <i class="mdi mdi-phone-outline me-1"></i>

                                        {{ $perusahaan->telepon }}

                                    </small>

                                    @endif


                                    @if($perusahaan->email)

                                    <small class="d-block mt-1">

                                        <i class="mdi mdi-email-outline me-1"></i>

                                        {{ $perusahaan->email }}

                                    </small>

                                    @endif


                                    @if(!$perusahaan->telepon && !$perusahaan->email)

                                    <span class="text-muted">
                                        -
                                    </span>

                                    @endif

                                </td>


                                {{-- GPS --}}
                                <td>

                                    @if(
                                    $perusahaan->latitude !== null &&
                                    $perusahaan->longitude !== null
                                    )

                                    <span class="badge badge-success">

                                        <i class="mdi mdi-map-marker-check-outline me-1"></i>

                                        Tersedia

                                    </span>

                                    <small class="text-muted d-block mt-1">

                                        {{ $perusahaan->latitude }},
                                        {{ $perusahaan->longitude }}

                                    </small>

                                    @else

                                    <span class="badge badge-warning">

                                        <i class="mdi mdi-map-marker-off-outline me-1"></i>

                                        Belum Diatur

                                    </span>

                                    @endif

                                </td>


                                {{-- RADIUS --}}
                                <td>

                                    @if($perusahaan->radius_absensi)

                                    <strong>

                                        {{ $perusahaan->radius_absensi }}

                                    </strong>

                                    meter

                                    @else

                                    <span class="text-muted">
                                        -
                                    </span>

                                    @endif

                                </td>


                                {{-- AKSI --}}
                                <td class="text-center">

                                    <div class="d-flex justify-content-center gap-2">

                                        {{-- DETAIL --}}
                                        <a href="{{ route(
                                                'admin.perusahaan.show',
                                                $perusahaan->id
                                            ) }}"
                                            class="btn btn-outline-info btn-sm"
                                            title="Detail">

                                            <i class="mdi mdi-eye-outline"></i>

                                        </a>


                                        {{-- EDIT --}}
                                        <a href="{{ route(
                                                'admin.perusahaan.edit',
                                                $perusahaan->id
                                            ) }}"
                                            class="btn btn-outline-primary btn-sm"
                                            title="Edit">

                                            <i class="mdi mdi-square-edit-outline"></i>

                                        </a>


                                        {{-- HAPUS --}}
                                        <form action="{{ route(
                                                'admin.perusahaan.destroy',
                                                $perusahaan->id
                                            ) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus perusahaan ini?')">

                                            @csrf

                                            @method('DELETE')

                                            <button type="submit"
                                                class="btn btn-outline-danger btn-sm"
                                                title="Hapus">

                                                <i class="mdi mdi-trash-can-outline"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="7"
                                    class="text-center py-5">

                                    <i class="mdi mdi-domain-off-outline text-muted"
                                        style="font-size:55px;">
                                    </i>

                                    <p class="text-muted mt-2 mb-0">

                                        Belum ada data perusahaan.

                                    </p>

                                    <a href="{{ route(
                                            'admin.perusahaan.create'
                                        ) }}"
                                        class="btn btn-primary btn-sm mt-3">

                                        <i class="mdi mdi-plus me-1"></i>

                                        Tambah Perusahaan

                                    </a>

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- PAGINATION --}}
                @if($perusahaans->hasPages())

                <div class="mt-4">

                    {{ $perusahaans->links() }}

                </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection