@extends('layouts.skydash-admin')

@section('title', 'Edit Perusahaan')

@section('content')

<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                {{-- HEADER --}}
                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>

                        <h4 class="card-title mb-1">
                            Edit Perusahaan
                        </h4>

                        <p class="text-muted mb-0">
                            Perbarui informasi perusahaan dan lokasi GPS.
                        </p>

                    </div>

                    <a href="{{ route('admin.perusahaan.index') }}"
                        class="btn btn-light">

                        <i class="mdi mdi-arrow-left me-1"></i>

                        Kembali

                    </a>

                </div>


                {{-- ERROR --}}
                @if($errors->any())

                <div class="alert alert-danger">

                    <h6 class="font-weight-bold">

                        <i class="mdi mdi-alert-circle-outline me-1"></i>

                        Terdapat kesalahan pada data.

                    </h6>

                    <ul class="mb-0 ps-3">

                        @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                        @endforeach

                    </ul>

                </div>

                @endif


                {{-- FORM --}}
                <form action="{{ route(
                    'admin.perusahaan.update',
                    $perusahaan->id
                ) }}"
                    method="POST"
                    class="forms-sample">

                    @csrf

                    @method('PUT')


                    {{-- INFORMASI PERUSAHAAN --}}
                    <h5 class="text-primary mb-3">

                        <i class="mdi mdi-domain me-1"></i>

                        Informasi Perusahaan

                    </h5>


                    <div class="form-group">

                        <label for="nama_perusahaan">
                            Nama Perusahaan
                        </label>

                        <input type="text"
                            name="nama_perusahaan"
                            id="nama_perusahaan"
                            class="form-control @error('nama_perusahaan') is-invalid @enderror"
                            value="{{ old(
                                   'nama_perusahaan',
                                   $perusahaan->nama_perusahaan
                               ) }}"
                            required>

                        @error('nama_perusahaan')

                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>

                        @enderror

                    </div>


                    <div class="form-group">

                        <label for="alamat">
                            Alamat Perusahaan
                        </label>

                        <textarea name="alamat"
                            id="alamat"
                            rows="4"
                            class="form-control @error('alamat') is-invalid @enderror"
                            required>{{ old(
                                      'alamat',
                                      $perusahaan->alamat
                                  ) }}</textarea>

                        @error('alamat')

                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>

                        @enderror

                    </div>


                    <div class="row">

                        {{-- TELEPON --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="telepon">
                                    Telepon
                                </label>

                                <input type="text"
                                    name="telepon"
                                    id="telepon"
                                    class="form-control @error('telepon') is-invalid @enderror"
                                    value="{{ old(
                                           'telepon',
                                           $perusahaan->telepon
                                       ) }}"
                                    placeholder="08xxxxxxxxxx">

                                @error('telepon')

                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>

                                @enderror

                            </div>

                        </div>


                        {{-- EMAIL --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="email">
                                    Email
                                </label>

                                <input type="email"
                                    name="email"
                                    id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old(
                                           'email',
                                           $perusahaan->email
                                       ) }}"
                                    placeholder="perusahaan@email.com">

                                @error('email')

                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>

                                @enderror

                            </div>

                        </div>

                    </div>


                    {{-- LOKASI --}}
                    <h5 class="text-primary mt-4 mb-3">

                        <i class="mdi mdi-map-marker-outline me-1"></i>

                        Lokasi GPS

                    </h5>


                    <div class="alert alert-info">

                        <i class="mdi mdi-information-outline me-1"></i>

                        Koordinat ini digunakan sebagai titik lokasi
                        perusahaan untuk validasi absensi GPS siswa.

                    </div>


                    <div class="row">

                        {{-- LATITUDE --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="latitude">
                                    Latitude
                                </label>

                                <input type="number"
                                    name="latitude"
                                    id="latitude"
                                    class="form-control @error('latitude') is-invalid @enderror"
                                    value="{{ old(
                                           'latitude',
                                           $perusahaan->latitude
                                       ) }}"
                                    step="any"
                                    placeholder="Contoh: 3.595196">

                                @error('latitude')

                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>

                                @enderror

                                <small class="text-muted">
                                    Nilai antara -90 sampai 90.
                                </small>

                            </div>

                        </div>


                        {{-- LONGITUDE --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="longitude">
                                    Longitude
                                </label>

                                <input type="number"
                                    name="longitude"
                                    id="longitude"
                                    class="form-control @error('longitude') is-invalid @enderror"
                                    value="{{ old(
                                           'longitude',
                                           $perusahaan->longitude
                                       ) }}"
                                    step="any"
                                    placeholder="Contoh: 98.672222">

                                @error('longitude')

                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>

                                @enderror

                                <small class="text-muted">
                                    Nilai antara -180 sampai 180.
                                </small>

                            </div>

                        </div>

                    </div>


                    {{-- RADIUS --}}
                    <div class="form-group">

                        <label for="radius_absensi">
                            Radius Absensi
                        </label>

                        <div class="input-group">

                            <input type="number"
                                name="radius_absensi"
                                id="radius_absensi"
                                class="form-control @error('radius_absensi') is-invalid @enderror"
                                value="{{ old(
                                       'radius_absensi',
                                       $perusahaan->radius_absensi ?? 100
                                   ) }}"
                                min="10"
                                required>

                            <div class="input-group-append">

                                <span class="input-group-text">
                                    meter
                                </span>

                            </div>

                        </div>

                        @error('radius_absensi')

                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>

                        @enderror

                        <small class="text-muted">
                            Jarak maksimum siswa dari titik perusahaan
                            ketika melakukan absensi GPS.
                        </small>

                    </div>


                    {{-- STATUS LOKASI --}}
                    @if(
                    $perusahaan->latitude !== null &&
                    $perusahaan->longitude !== null
                    )

                    <div class="alert alert-success">

                        <i class="mdi mdi-map-marker-check-outline me-1"></i>

                        Lokasi GPS perusahaan sudah tersedia.

                        <div class="mt-2">

                            Latitude:
                            <strong>
                                {{ $perusahaan->latitude }}
                            </strong>

                            <br>

                            Longitude:
                            <strong>
                                {{ $perusahaan->longitude }}
                            </strong>

                        </div>

                    </div>

                    @else

                    <div class="alert alert-warning">

                        <i class="mdi mdi-map-marker-off-outline me-1"></i>

                        Lokasi GPS perusahaan belum diatur.

                    </div>

                    @endif


                    {{-- BUTTON --}}
                    <div class="mt-4">

                        <button type="submit"
                            class="btn btn-primary me-2">

                            <i class="mdi mdi-content-save-outline me-1"></i>

                            Simpan Perubahan

                        </button>


                        <a href="{{ route('admin.perusahaan.index') }}"
                            class="btn btn-light">

                            <i class="mdi mdi-close me-1"></i>

                            Batal

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection