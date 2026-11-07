@extends('layouts.skydash-siswa')

@section('title', 'Nilai PKL')

@section('content')

{{-- =========================================================
     HEADER
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="d-flex align-items-center">

                    <div
                        class="rounded-3 bg-primary bg-opacity-10
                        d-flex align-items-center justify-content-center me-3"
                        style="width:52px;height:52px;">

                        <i
                            class="mdi mdi-school-outline text-primary"
                            style="font-size:27px;">
                        </i>

                    </div>

                    <div>

                        <h4 class="fw-bold mb-1">
                            Nilai PKL
                        </h4>

                        <p class="text-muted mb-0">
                            Lihat hasil penilaian PKL Anda.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


@if(!$penempatan)

{{-- =========================================================
     BELUM ADA PENEMPATAN
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card border-0 shadow-sm">

            <div class="card-body text-center py-5">

                <div
                    class="rounded-circle bg-light
                    d-flex align-items-center justify-content-center
                    mx-auto mb-3"
                    style="width:90px;height:90px;">

                    <i
                        class="mdi mdi-school-outline text-muted"
                        style="font-size:45px;">
                    </i>

                </div>

                <h5 class="fw-bold mb-2">
                    Belum Ada Penempatan PKL
                </h5>

                <p class="text-muted mb-0">
                    Data penempatan PKL Anda belum tersedia.
                </p>

            </div>

        </div>

    </div>

</div>


@elseif(!$nilaiPKL)

{{-- =========================================================
     NILAI BELUM TERSEDIA
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card border-0 shadow-sm">

            <div class="card-body text-center py-5">

                <div
                    class="rounded-circle bg-light
                    d-flex align-items-center justify-content-center
                    mx-auto mb-3"
                    style="width:90px;height:90px;">

                    <i
                        class="mdi mdi-clipboard-text-outline text-muted"
                        style="font-size:45px;">
                    </i>

                </div>

                <h5 class="fw-bold mb-2">
                    Nilai Belum Tersedia
                </h5>

                <p class="text-muted mb-0">
                    Nilai PKL Anda belum diberikan atau belum
                    diproses oleh pembimbing.
                </p>

            </div>

        </div>

    </div>

</div>


@else

{{-- =========================================================
     DATA NILAI
========================================================= --}}

@php

$nilaiAkhir = $nilaiPKL->nilai_akhir ?? 0;

@endphp


{{-- =========================================================
     INFORMASI SISWA + NILAI AKHIR
========================================================= --}}

<div class="row">

    {{-- =====================================================
         PROFIL SISWA
    ====================================================== --}}

    <div class="col-lg-4 grid-margin stretch-card">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body text-center">

                @if(
                $siswa->user &&
                $siswa->user->foto_profil
                )

                <img
                    src="{{ url($siswa->user->foto_profil) }}"
                    alt="Foto Profil"
                    class="rounded-circle mb-3 border"
                    style="
                        width:110px;
                        height:110px;
                        object-fit:cover;
                    ">

                @else

                <div
                    class="rounded-circle bg-light
                    d-flex align-items-center justify-content-center
                    mx-auto mb-3"
                    style="width:110px;height:110px;">

                    <i
                        class="mdi mdi-account-outline text-muted"
                        style="font-size:55px;">
                    </i>

                </div>

                @endif


                <h5 class="fw-bold mb-1">

                    {{ $siswa->user->name ?? '-' }}

                </h5>


                <p class="text-muted mb-3">

                    NISN: {{ $siswa->nisn ?? '-' }}

                </p>


                <span class="badge bg-primary px-3 py-2">

                    <i class="mdi mdi-school-outline me-1"></i>

                    {{ $siswa->kelas->nama_kelas ?? '-' }}

                </span>


                <hr class="my-4">


                <div class="d-flex justify-content-between align-items-center">

                    <span class="text-muted">
                        Status Nilai
                    </span>

                    <span class="badge bg-success">

                        <i class="mdi mdi-check-circle-outline me-1"></i>

                        Tersedia

                    </span>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         NILAI AKHIR
    ====================================================== --}}

    <div class="col-lg-8 grid-margin stretch-card">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between
                    align-items-center mb-4 flex-wrap">

                    <div>

                        <h5 class="card-title mb-1">
                            Nilai Akhir PKL
                        </h5>

                        <p class="text-muted mb-0">
                            Hasil akhir penilaian PKL Anda.
                        </p>

                    </div>


                    @if($nilaiAkhir >= 90)

                    <span class="badge bg-success px-3 py-2 mt-2 mt-md-0">

                        <i class="mdi mdi-star-circle-outline me-1"></i>

                        Sangat Baik

                    </span>

                    @elseif($nilaiAkhir >= 80)

                    <span class="badge bg-primary px-3 py-2 mt-2 mt-md-0">

                        <i class="mdi mdi-thumb-up-outline me-1"></i>

                        Baik

                    </span>

                    @elseif($nilaiAkhir >= 70)

                    <span class="badge bg-warning text-dark px-3 py-2 mt-2 mt-md-0">

                        <i class="mdi mdi-alert-circle-outline me-1"></i>

                        Cukup

                    </span>

                    @else

                    <span class="badge bg-danger px-3 py-2 mt-2 mt-md-0">

                        <i class="mdi mdi-alert-outline me-1"></i>

                        Kurang

                    </span>

                    @endif

                </div>


                <div class="text-center py-4">

                    <div class="nilai-akhir-wrapper">

                        <h1 class="nilai-akhir">

                            {{ number_format(
                                $nilaiAkhir,
                                2
                            ) }}

                        </h1>

                        <p class="text-muted mb-0">
                            Nilai Akhir
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     DETAIL NILAI
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="mb-4">

                    <h5 class="card-title mb-1">
                        Detail Nilai PKL
                    </h5>

                    <p class="text-muted mb-0">
                        Rincian hasil penilaian dari pembimbing.
                    </p>

                </div>


                <div class="row">

                    {{-- =================================================
                         NILAI GURU
                    ================================================== --}}

                    <div class="col-md-6 mb-3 mb-md-0">

                        <div
                            class="border rounded-3 p-4 h-100">

                            <div class="d-flex align-items-center mb-4">

                                <div
                                    class="rounded-3 bg-primary bg-opacity-10
                                    d-flex align-items-center justify-content-center"
                                    style="width:50px;height:50px;">

                                    <i
                                        class="mdi mdi-account-tie-outline text-primary"
                                        style="font-size:25px;">
                                    </i>

                                </div>


                                <div class="ms-3">

                                    <h6 class="fw-bold mb-1">
                                        Guru Pembimbing
                                    </h6>

                                    <small class="text-muted">
                                        Penilaian dari sekolah
                                    </small>

                                </div>

                            </div>


                            <div class="d-flex
                                justify-content-between
                                align-items-center">

                                <span class="text-muted">
                                    Nilai
                                </span>


                                <h3 class="fw-bold text-primary mb-0">

                                    @if($penempatan->penilaianGuru)

                                    {{ number_format(
                                        $penempatan->penilaianGuru->nilai_akhir,
                                        2
                                    ) }}

                                    @else

                                    -

                                    @endif

                                </h3>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         NILAI INDUSTRI
                    ================================================== --}}

                    <div class="col-md-6">

                        <div
                            class="border rounded-3 p-4 h-100">

                            <div class="d-flex align-items-center mb-4">

                                <div
                                    class="rounded-3 bg-success bg-opacity-10
                                    d-flex align-items-center justify-content-center"
                                    style="width:50px;height:50px;">

                                    <i
                                        class="mdi mdi-office-building-outline text-success"
                                        style="font-size:25px;">
                                    </i>

                                </div>


                                <div class="ms-3">

                                    <h6 class="fw-bold mb-1">
                                        Pembimbing Industri
                                    </h6>

                                    <small class="text-muted">
                                        Penilaian dari tempat PKL
                                    </small>

                                </div>

                            </div>


                            <div class="d-flex
                                justify-content-between
                                align-items-center">

                                <span class="text-muted">
                                    Nilai
                                </span>


                                <h3 class="fw-bold text-success mb-0">

                                    @if($penempatan->penilaianIndustri)

                                    {{ number_format(
                                        $penempatan->penilaianIndustri->nilai_akhir,
                                        2
                                    ) }}

                                    @else

                                    -

                                    @endif

                                </h3>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     INFORMASI PKL
========================================================= --}}

<div class="row">

    {{-- =====================================================
         TEMPAT PKL
    ====================================================== --}}

    <div class="col-lg-6 grid-margin stretch-card">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex align-items-center mb-4">

                    <div
                        class="rounded-3 bg-info bg-opacity-10
                        d-flex align-items-center justify-content-center"
                        style="width:50px;height:50px;">

                        <i
                            class="mdi mdi-office-building-marker-outline text-info"
                            style="font-size:25px;">
                        </i>

                    </div>


                    <div class="ms-3">

                        <h5 class="card-title mb-1">
                            Tempat PKL
                        </h5>

                        <p class="text-muted small mb-0">
                            Informasi tempat pelaksanaan PKL.
                        </p>

                    </div>

                </div>


                <div class="bg-light rounded-3 p-3">

                    <h6 class="fw-bold mb-2">

                        {{ $penempatan->perusahaan->nama_perusahaan ?? '-' }}

                    </h6>


                    <div class="d-flex align-items-start">

                        <i
                            class="mdi mdi-map-marker-outline
                            text-muted me-2 mt-1">
                        </i>

                        <span class="text-muted">

                            {{ $penempatan->perusahaan->alamat ?? '-' }}

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         PEMBIMBING
    ====================================================== --}}

    <div class="col-lg-6 grid-margin stretch-card">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex align-items-center mb-4">

                    <div
                        class="rounded-3 bg-warning bg-opacity-10
                        d-flex align-items-center justify-content-center"
                        style="width:50px;height:50px;">

                        <i
                            class="mdi mdi-account-group-outline text-warning"
                            style="font-size:25px;">
                        </i>

                    </div>


                    <div class="ms-3">

                        <h5 class="card-title mb-1">
                            Pembimbing PKL
                        </h5>

                        <p class="text-muted small mb-0">
                            Guru dan pembimbing dari industri.
                        </p>

                    </div>

                </div>


                {{-- GURU --}}

                <div class="mb-4">

                    <small class="text-muted d-block mb-2">
                        Guru Pembimbing
                    </small>

                    <div class="d-flex align-items-center">

                        <div
                            class="rounded-circle bg-primary bg-opacity-10
                            text-primary d-flex align-items-center
                            justify-content-center me-3"
                            style="width:38px;height:38px;">

                            <i class="mdi mdi-account-tie-outline"></i>

                        </div>

                        <strong>

                            {{ $penempatan->guru->user->name ?? '-' }}

                        </strong>

                    </div>

                </div>


                {{-- INDUSTRI --}}

                <div>

                    <small class="text-muted d-block mb-2">
                        Pembimbing Industri
                    </small>

                    <div class="d-flex align-items-center">

                        <div
                            class="rounded-circle bg-success bg-opacity-10
                            text-success d-flex align-items-center
                            justify-content-center me-3"
                            style="width:38px;height:38px;">

                            <i class="mdi mdi-account-hard-hat-outline"></i>

                        </div>

                        <strong>

                            {{ $penempatan->industri->user->name ?? '-' }}

                        </strong>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endif

@endsection


@push('styles')

<style>
    .nilai-akhir-wrapper {

        background: #f8f9fc;

        border-radius: 14px;

        padding: 35px 20px;

        max-width: 420px;

        margin: 0 auto;

    }


    .nilai-akhir {

        font-size: 64px;

        font-weight: 700;

        line-height: 1;

        color: #4B49AC;

        margin-bottom: 10px;

        letter-spacing: -2px;

    }


    .card {

        transition:
            box-shadow .2s ease,
            transform .2s ease;

    }


    .card:hover {

        box-shadow:
            0 8px 25px rgba(0, 0, 0, .06) !important;

    }


    @media (max-width: 767px) {

        .nilai-akhir {

            font-size: 48px;

        }

    }
</style>

@endpush