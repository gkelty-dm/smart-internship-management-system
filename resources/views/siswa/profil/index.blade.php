@extends('layouts.skydash-siswa')

@section('title', 'Profil Saya')

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
                            class="mdi mdi-account-outline text-primary"
                            style="font-size:27px;">
                        </i>

                    </div>

                    <div>

                        <h4 class="fw-bold mb-1">
                            Profil Saya
                        </h4>

                        <p class="text-muted mb-0">
                            Informasi akun dan data pribadi siswa.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     ALERT
========================================================= --}}

@if(session('success'))

<div class="row">

    <div class="col-12">

        <div class="alert alert-success border-0 shadow-sm">

            <i class="mdi mdi-check-circle-outline me-1"></i>

            {{ session('success') }}

        </div>

    </div>

</div>

@endif


{{-- =========================================================
     PROFIL UTAMA
========================================================= --}}

<div class="row">

    {{-- =====================================================
         KARTU IDENTITAS
    ====================================================== --}}

    <div class="col-lg-4 grid-margin stretch-card">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="text-center">

                    {{-- FOTO PROFIL --}}

                    @if($user->foto_profil)

                    <div class="mb-3">

                        <img
                            src="{{ url($user->foto_profil) }}"
                            alt="Foto Profil"
                            class="rounded-circle border"
                            style="
                                width:130px;
                                height:130px;
                                object-fit:cover;
                            ">

                    </div>

                    @else

                    <div
                        class="rounded-circle bg-primary text-white
                        d-flex align-items-center justify-content-center
                        mx-auto mb-3"
                        style="
                            width:130px;
                            height:130px;
                            font-size:48px;
                            font-weight:600;
                        ">

                        {{ strtoupper(
                            substr(
                                $user->name,
                                0,
                                1
                            )
                        ) }}

                    </div>

                    @endif


                    {{-- NAMA --}}

                    <h5 class="fw-bold mb-1">

                        {{ $user->name }}

                    </h5>


                    {{-- EMAIL --}}

                    <p class="text-muted mb-3">

                        {{ $user->email }}

                    </p>


                    {{-- KELAS --}}

                    <span class="badge bg-primary px-3 py-2">

                        <i class="mdi mdi-school-outline me-1"></i>

                        {{ $siswa->kelas->nama_kelas ?? 'Kelas -' }}

                    </span>

                </div>


                <hr class="my-4">


                {{-- STATUS AKUN --}}

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted d-block">
                            Status Akun
                        </small>

                        <span class="fw-semibold">
                            Akun Siswa
                        </span>

                    </div>


                    <span class="badge bg-success">

                        <i class="mdi mdi-check-circle-outline me-1"></i>

                        Aktif

                    </span>

                </div>


                {{-- TOMBOL --}}

                <div class="d-grid gap-2 mt-4">

                    <a
                        href="{{ route('siswa.profil.edit') }}"
                        class="btn btn-primary">

                        <i class="mdi mdi-pencil-outline me-1"></i>

                        Edit Profil

                    </a>


                    <a
                        href="{{ route('siswa.password.index') }}"
                        class="btn btn-light">

                        <i class="mdi mdi-lock-outline me-1"></i>

                        Ubah Password

                    </a>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         DATA SISWA
    ====================================================== --}}

    <div class="col-lg-8 grid-margin stretch-card">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex align-items-center mb-4">

                    <div
                        class="rounded-3 bg-primary bg-opacity-10
                        d-flex align-items-center justify-content-center me-3"
                        style="width:45px;height:45px;">

                        <i
                            class="mdi mdi-card-account-details-outline text-primary"
                            style="font-size:23px;">
                        </i>

                    </div>

                    <div>

                        <h5 class="card-title mb-1">
                            Data Siswa
                        </h5>

                        <p class="text-muted small mb-0">
                            Informasi identitas pribadi siswa.
                        </p>

                    </div>

                </div>


                <div class="row">

                    {{-- NAMA --}}

                    <div class="col-md-6 mb-4">

                        <div class="profile-info">

                            <small class="text-muted d-block mb-1">
                                Nama Lengkap
                            </small>

                            <div class="fw-semibold">
                                {{ $user->name }}
                            </div>

                        </div>

                    </div>


                    {{-- NISN --}}

                    <div class="col-md-6 mb-4">

                        <div class="profile-info">

                            <small class="text-muted d-block mb-1">
                                NISN
                            </small>

                            <div class="fw-semibold">
                                {{ $siswa->nisn ?? '-' }}
                            </div>

                        </div>

                    </div>


                    {{-- EMAIL --}}

                    <div class="col-md-6 mb-4">

                        <div class="profile-info">

                            <small class="text-muted d-block mb-1">
                                Email
                            </small>

                            <div class="fw-semibold text-break">
                                {{ $user->email }}
                            </div>

                        </div>

                    </div>


                    {{-- JENIS KELAMIN --}}

                    <div class="col-md-6 mb-4">

                        <div class="profile-info">

                            <small class="text-muted d-block mb-1">
                                Jenis Kelamin
                            </small>

                            <div class="fw-semibold">

                                {{ $siswa->jenis_kelamin ?? '-' }}

                            </div>

                        </div>

                    </div>


                    {{-- TEMPAT LAHIR --}}

                    <div class="col-md-6 mb-4">

                        <div class="profile-info">

                            <small class="text-muted d-block mb-1">
                                Tempat Lahir
                            </small>

                            <div class="fw-semibold">

                                {{ $siswa->tempat_lahir ?? '-' }}

                            </div>

                        </div>

                    </div>


                    {{-- TANGGAL LAHIR --}}

                    <div class="col-md-6 mb-4">

                        <div class="profile-info">

                            <small class="text-muted d-block mb-1">
                                Tanggal Lahir
                            </small>

                            <div class="fw-semibold">

                                @if($siswa->tanggal_lahir)

                                {{ \Carbon\Carbon::parse(
                                    $siswa->tanggal_lahir
                                )->translatedFormat('d F Y') }}

                                @else

                                -

                                @endif

                            </div>

                        </div>

                    </div>


                    {{-- JURUSAN --}}

                    <div class="col-md-6 mb-4">

                        <div class="profile-info">

                            <small class="text-muted d-block mb-1">
                                Jurusan
                            </small>

                            <div class="fw-semibold">

                                {{ $siswa->jurusan->nama_jurusan ?? '-' }}

                            </div>

                        </div>

                    </div>


                    {{-- KELAS --}}

                    <div class="col-md-6 mb-4">

                        <div class="profile-info">

                            <small class="text-muted d-block mb-1">
                                Kelas
                            </small>

                            <div class="fw-semibold">

                                {{ $siswa->kelas->nama_kelas ?? '-' }}

                            </div>

                        </div>

                    </div>


                    {{-- NOMOR HP --}}

                    <div class="col-md-6 mb-4">

                        <div class="profile-info">

                            <small class="text-muted d-block mb-1">
                                Nomor HP
                            </small>

                            <div class="fw-semibold">

                                {{ $siswa->no_hp ?? '-' }}

                            </div>

                        </div>

                    </div>


                    {{-- ALAMAT --}}

                    <div class="col-12">

                        <div class="profile-info">

                            <small class="text-muted d-block mb-1">
                                Alamat
                            </small>

                            <div class="fw-semibold">

                                {{ $siswa->alamat ?? '-' }}

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     RINGKASAN DATA
========================================================= --}}

<div class="row">

    {{-- JURUSAN --}}

    <div class="col-md-4 grid-margin stretch-card">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex align-items-center">

                    <div
                        class="rounded-3 bg-info bg-opacity-10
                        text-info d-flex align-items-center justify-content-center"
                        style="width:45px;height:45px;">

                        <i class="mdi mdi-book-education-outline"
                            style="font-size:23px;">
                        </i>

                    </div>

                    <div class="ms-3">

                        <small class="text-muted d-block">
                            Jurusan
                        </small>

                        <h6 class="fw-bold mb-0">

                            {{ $siswa->jurusan->nama_jurusan ?? '-' }}

                        </h6>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- KELAS --}}

    <div class="col-md-4 grid-margin stretch-card">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex align-items-center">

                    <div
                        class="rounded-3 bg-primary bg-opacity-10
                        text-primary d-flex align-items-center justify-content-center"
                        style="width:45px;height:45px;">

                        <i class="mdi mdi-google-classroom"
                            style="font-size:23px;">
                        </i>

                    </div>

                    <div class="ms-3">

                        <small class="text-muted d-block">
                            Kelas
                        </small>

                        <h6 class="fw-bold mb-0">

                            {{ $siswa->kelas->nama_kelas ?? '-' }}

                        </h6>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- NISN --}}

    <div class="col-md-4 grid-margin stretch-card">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex align-items-center">

                    <div
                        class="rounded-3 bg-success bg-opacity-10
                        text-success d-flex align-items-center justify-content-center"
                        style="width:45px;height:45px;">

                        <i class="mdi mdi-identifier"
                            style="font-size:23px;">
                        </i>

                    </div>

                    <div class="ms-3">

                        <small class="text-muted d-block">
                            NISN
                        </small>

                        <h6 class="fw-bold mb-0">

                            {{ $siswa->nisn ?? '-' }}

                        </h6>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection


@push('styles')

<style>
    .profile-info {

        padding: 14px 16px;

        border: 1px solid #f0f0f0;

        border-radius: 10px;

        background: #fff;

        min-height: 72px;

        display: flex;

        flex-direction: column;

        justify-content: center;

    }


    .profile-info:hover {

        background: #fafafa;

    }


    .card {

        transition:
            box-shadow .2s ease,
            transform .2s ease;

    }


    .card:hover {

        box-shadow:
            0 8px 24px rgba(0, 0, 0, .06) !important;

    }


    @media (max-width: 767px) {

        .profile-info {

            min-height: auto;

        }

    }
</style>

@endpush