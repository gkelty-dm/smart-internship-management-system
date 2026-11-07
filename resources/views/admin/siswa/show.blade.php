@extends('layouts.skydash-admin')

@section('title', 'Detail Siswa')

@section('content')

<style>
    /* =========================================================
       DETAIL SISWA
    ========================================================= */

    .detail-card {
        border: 0;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .035);
    }

    .detail-header {
        padding: 20px 22px;
    }

    .detail-icon {
        width: 46px;
        height: 46px;
        border-radius: 8px;
        background: rgba(75, 73, 172, .10);
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .detail-icon i {
        font-size: 23px;
    }

    .detail-title {
        font-size: 18px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 3px;
    }

    .detail-subtitle {
        font-size: 11px;
        color: #9a9aa5;
        margin: 0;
    }

    .detail-header .btn {
        font-size: 11px;
        border-radius: 6px;
        padding: 8px 13px;
    }

    /* =========================================================
       PROFILE
    ========================================================= */

    .profile-card-body {
        padding: 22px;
    }

    .profile-main {
        display: flex;
        align-items: center;
        padding-bottom: 18px;
        border-bottom: 1px solid #eeeeee;
    }

    .profile-photo {
        width: 76px;
        height: 76px;
        border-radius: 50%;
        background: #f0effb;
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        overflow: hidden;
        margin-right: 16px;
    }

    .profile-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-photo i {
        font-size: 38px;
    }

    .profile-name {
        font-size: 17px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 4px;
    }

    .profile-role {
        font-size: 10px;
        color: #9a9aa5;
        margin-bottom: 7px;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        border-radius: 20px;
        padding: 4px 9px;
        font-size: 9px;
        font-weight: 500;
    }

    .status-active {
        color: #198754;
        background: #eaf7ef;
    }

    .status-inactive {
        color: #dc3545;
        background: #fff0f0;
    }

    /* =========================================================
       INFO ITEMS
    ========================================================= */

    .info-list {
        padding-top: 15px;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 10px 0;
        border-bottom: 1px solid #f2f2f4;
    }

    .info-item:last-child {
        border-bottom: 0;
    }

    .info-label {
        font-size: 9px;
        color: #9a9aa5;
        margin-bottom: 3px;
    }

    .info-value {
        font-size: 11px;
        color: #343a40;
        font-weight: 500;
        word-break: break-word;
    }

    .info-icon {
        color: #4b49ac;
        font-size: 17px;
        margin-left: 15px;
    }

    /* =========================================================
       ADDRESS
    ========================================================= */

    .address-box {
        margin-top: 14px;
        padding-top: 14px;
        border-top: 1px solid #eeeeee;
    }

    .address-title {
        font-size: 10px;
        color: #9a9aa5;
        margin-bottom: 7px;
    }

    .address-content {
        background: #fafaff;
        border: 1px solid #eeeeee;
        border-radius: 7px;
        padding: 11px 13px;
    }

    .address-content p {
        font-size: 10px;
        line-height: 1.7;
        color: #666b73;
        margin: 0;
        white-space: pre-line;
    }

    /* =========================================================
       SECTION
    ========================================================= */

    .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 18px;
    }

    .section-header-icon {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        background: rgba(75, 73, 172, .10);
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 11px;
        flex-shrink: 0;
    }

    .section-header-icon i {
        font-size: 19px;
    }

    .section-title {
        font-size: 14px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 2px;
    }

    .section-subtitle {
        font-size: 10px;
        color: #9a9aa5;
        margin: 0;
    }

    /* =========================================================
       ACADEMIC INFO
    ========================================================= */

    .academic-item {
        background: #fafaff;
        border: 1px solid #eeeeee;
        border-radius: 8px;
        padding: 14px;
        height: 100%;
    }

    .academic-label {
        font-size: 9px;
        color: #9a9aa5;
        margin-bottom: 6px;
        text-transform: uppercase;
    }

    .academic-value {
        font-size: 12px;
        font-weight: 600;
        color: #343a40;
    }

    /* =========================================================
       HISTORY BUTTON
    ========================================================= */

    .history-button {
        display: flex;
        align-items: center;
        text-decoration: none;
        border: 1px solid #eeeeee;
        border-radius: 8px;
        padding: 13px 14px;
        background: #fff;
        transition: .2s ease;
    }

    .history-button:hover {
        text-decoration: none;
        background: #fafaff;
        border-color: #4b49ac;
    }

    .history-icon {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        background: #f0effb;
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
        flex-shrink: 0;
    }

    .history-icon.info {
        background: #eaf8fc;
        color: #0dcaf0;
    }

    .history-title {
        font-size: 10px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 2px;
    }

    .history-description {
        font-size: 9px;
        color: #9a9aa5;
        margin: 0;
    }

    /* =========================================================
       FACE REGISTRATION
    ========================================================= */

    .registration-status {
        display: inline-flex;
        align-items: center;
        border-radius: 20px;
        padding: 5px 10px;
        font-size: 9px;
        font-weight: 500;
    }

    .registration-success {
        color: #198754;
        background: #eaf7ef;
    }

    .registration-warning {
        color: #856404;
        background: #fff8df;
    }

    .face-image-card {
        border: 1px solid #eeeeee;
        border-radius: 8px;
        overflow: hidden;
        background: #fff;
    }

    .face-image {
        width: 100%;
        height: 180px;
        object-fit: cover;
        display: block;
    }

    .face-image-caption {
        padding: 9px 11px;
        font-size: 9px;
        color: #8a8a95;
        text-align: center;
        margin: 0;
    }

    .empty-state {
        padding: 42px 20px;
        text-align: center;
    }

    .empty-icon {
        width: 58px;
        height: 58px;
        border-radius: 50%;
        background: #f5f5f7;
        color: #aaaab4;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
    }

    .empty-icon i {
        font-size: 28px;
    }

    .empty-title {
        font-size: 12px;
        font-weight: 600;
        color: #555b62;
        margin-bottom: 3px;
    }

    .empty-text {
        font-size: 10px;
        color: #9a9aa5;
        margin: 0;
    }

    /* =========================================================
       PKL
    ========================================================= */

    .pkl-item {
        padding: 12px 0;
    }

    .pkl-label {
        font-size: 9px;
        color: #9a9aa5;
        margin-bottom: 4px;
    }

    .pkl-value {
        font-size: 11px;
        color: #343a40;
        font-weight: 600;
    }

    .pkl-item+.pkl-item {
        border-left: 1px solid #eeeeee;
        padding-left: 18px;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 991.98px) {

        .pkl-item+.pkl-item {
            border-left: 0;
            padding-left: 12px;
        }

    }

    @media (max-width: 767.98px) {

        .detail-header {
            padding: 17px;
        }

        .detail-header-actions {
            width: 100%;
            margin-top: 15px;
        }

        .detail-header-actions .btn {
            flex: 1;
        }

        .profile-card-body {
            padding: 17px;
        }

        .pkl-item+.pkl-item {
            border-left: 0;
            border-top: 1px solid #eeeeee;
            padding-left: 0;
            padding-top: 12px;
        }

        .face-image {
            height: 200px;
        }

    }
</style>


{{-- =========================================================
     HEADER
========================================================== --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card detail-card">

            <div class="detail-header">

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <div class="d-flex align-items-center">

                            <div class="detail-icon me-3">

                                <i class="mdi mdi-account-school-outline"></i>

                            </div>

                            <div>

                                <h4 class="detail-title">
                                    Detail Siswa
                                </h4>

                                <p class="detail-subtitle">
                                    Informasi lengkap data siswa dan aktivitas PKL.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="d-flex justify-content-md-end detail-header-actions">

                            <a
                                href="{{ route('admin.siswa.edit', $siswa->id) }}"
                                class="btn btn-primary me-2">

                                <i class="mdi mdi-pencil-outline me-1"></i>

                                Edit

                            </a>


                            <a
                                href="{{ route('admin.siswa.index') }}"
                                class="btn btn-light">

                                <i class="mdi mdi-arrow-left me-1"></i>

                                Kembali

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     INFORMASI SISWA
========================================================== --}}

<div class="row">

    {{-- PROFIL --}}

    <div class="col-lg-5 grid-margin">

        <div class="card detail-card">

            <div class="profile-card-body">

                <div class="profile-main">

                    <div class="profile-photo">

                        @if($siswa->user && $siswa->user->foto_profil)

                        <img
                            src="{{ asset('storage/' . $siswa->user->foto_profil) }}"
                            alt="Foto Profil">

                        @else

                        <i class="mdi mdi-account-school-outline"></i>

                        @endif

                    </div>


                    <div>

                        <div class="profile-name">

                            {{ $siswa->user->name ?? '-' }}

                        </div>


                        <div class="profile-role">

                            Siswa

                        </div>


                        <div>

                            @if($siswa->user && $siswa->user->is_active)

                            <span class="status-badge status-active">

                                <i class="mdi mdi-check-circle me-1"></i>

                                Akun Aktif

                            </span>

                            @else

                            <span class="status-badge status-inactive">

                                <i class="mdi mdi-close-circle me-1"></i>

                                Akun Tidak Aktif

                            </span>

                            @endif

                        </div>

                    </div>

                </div>


                <div class="info-list">

                    {{-- NISN --}}

                    <div class="info-item">

                        <div>

                            <div class="info-label">
                                NISN
                            </div>

                            <div class="info-value">
                                {{ $siswa->nisn ?? '-' }}
                            </div>

                        </div>

                        <i class="mdi mdi-card-account-details-outline info-icon"></i>

                    </div>


                    {{-- NIS --}}

                    <div class="info-item">

                        <div>

                            <div class="info-label">
                                NIS
                            </div>

                            <div class="info-value">
                                {{ $siswa->nis ?? '-' }}
                            </div>

                        </div>

                        <i class="mdi mdi-card-text-outline info-icon"></i>

                    </div>


                    {{-- EMAIL --}}

                    <div class="info-item">

                        <div>

                            <div class="info-label">
                                Email
                            </div>

                            <div class="info-value">
                                {{ $siswa->user->email ?? '-' }}
                            </div>

                        </div>

                        <i class="mdi mdi-email-outline info-icon"></i>

                    </div>


                    {{-- NO HP --}}

                    <div class="info-item">

                        <div>

                            <div class="info-label">
                                No. HP
                            </div>

                            <div class="info-value">
                                {{ $siswa->no_hp ?? '-' }}
                            </div>

                        </div>

                        <i class="mdi mdi-phone-outline info-icon"></i>

                    </div>


                    {{-- JENIS KELAMIN --}}

                    <div class="info-item">

                        <div>

                            <div class="info-label">
                                Jenis Kelamin
                            </div>

                            <div class="info-value">

                                @if($siswa->jenis_kelamin === 'L')

                                Laki-laki

                                @elseif($siswa->jenis_kelamin === 'P')

                                Perempuan

                                @else

                                -

                                @endif

                            </div>

                        </div>

                        <i class="mdi mdi-gender-male-female info-icon"></i>

                    </div>

                </div>


                {{-- ALAMAT --}}

                <div class="address-box">

                    <div class="address-title">
                        Alamat
                    </div>

                    <div class="address-content">

                        @if($siswa->alamat)

                        <p>{{ $siswa->alamat }}</p>

                        @else

                        <p class="text-muted">
                            Belum ada alamat.
                        </p>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- AKADEMIK --}}

    <div class="col-lg-7 grid-margin">

        <div class="card detail-card">

            <div class="card-body">

                <div class="section-header">

                    <div class="section-header-icon">

                        <i class="mdi mdi-school-outline"></i>

                    </div>

                    <div>

                        <h5 class="section-title">
                            Informasi Akademik
                        </h5>

                        <p class="section-subtitle">
                            Informasi pendidikan dan status siswa.
                        </p>

                    </div>

                </div>


                <div class="row">

                    {{-- JURUSAN --}}

                    <div class="col-md-6 mb-3">

                        <div class="academic-item">

                            <div class="academic-label">
                                Jurusan
                            </div>

                            <div class="academic-value">
                                {{ $siswa->jurusan->nama_jurusan ?? '-' }}
                            </div>

                        </div>

                    </div>


                    {{-- KELAS --}}

                    <div class="col-md-6 mb-3">

                        <div class="academic-item">

                            <div class="academic-label">
                                Kelas
                            </div>

                            <div class="academic-value">
                                {{ $siswa->kelas->nama_kelas ?? '-' }}
                            </div>

                        </div>

                    </div>


                    {{-- TEMPAT LAHIR --}}

                    <div class="col-md-6 mb-3">

                        <div class="academic-item">

                            <div class="academic-label">
                                Tempat Lahir
                            </div>

                            <div class="academic-value">
                                {{ $siswa->tempat_lahir ?? '-' }}
                            </div>

                        </div>

                    </div>


                    {{-- TANGGAL LAHIR --}}

                    <div class="col-md-6 mb-3">

                        <div class="academic-item">

                            <div class="academic-label">
                                Tanggal Lahir
                            </div>

                            <div class="academic-value">

                                @if($siswa->tanggal_lahir)

                                {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d/m/Y') }}

                                @else

                                -

                                @endif

                            </div>

                        </div>

                    </div>


                    {{-- STATUS PKL --}}

                    <div class="col-12 mb-3">

                        <div class="academic-item">

                            <div class="academic-label">
                                Status PKL
                            </div>

                            <div class="academic-value">

                                @if($siswa->penempatanPKL)

                                <span class="badge badge-success">

                                    <i class="mdi mdi-check-circle-outline me-1"></i>

                                    Terdaftar PKL

                                </span>

                                @else

                                <span class="badge badge-secondary">

                                    Belum Ditempatkan

                                </span>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>


                {{-- RIWAYAT --}}

                <div class="mt-3">

                    <div class="section-header mb-3">

                        <div class="section-header-icon">

                            <i class="mdi mdi-history"></i>

                        </div>

                        <div>

                            <h5 class="section-title">
                                Riwayat Aktivitas
                            </h5>

                            <p class="section-subtitle">
                                Lihat aktivitas siswa selama PKL.
                            </p>

                        </div>

                    </div>


                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <a
                                href="{{ route('admin.siswa.riwayat-absensi', $siswa->id) }}"
                                class="history-button">

                                <div class="history-icon">

                                    <i class="mdi mdi-calendar-check-outline"></i>

                                </div>

                                <div>

                                    <div class="history-title">
                                        Riwayat Absensi
                                    </div>

                                    <p class="history-description">
                                        Lihat catatan kehadiran siswa.
                                    </p>

                                </div>

                            </a>

                        </div>


                        <div class="col-md-6 mb-3">

                            <a
                                href="{{ route('admin.siswa.riwayat-logbook', $siswa->id) }}"
                                class="history-button">

                                <div class="history-icon info">

                                    <i class="mdi mdi-notebook-outline"></i>

                                </div>

                                <div>

                                    <div class="history-title">
                                        Riwayat Logbook
                                    </div>

                                    <p class="history-description">
                                        Lihat aktivitas logbook siswa.
                                    </p>

                                </div>

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     REGISTRASI WAJAH
========================================================== --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card detail-card">

            <div class="card-body">

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">

                    <div>

                        <div class="section-header mb-0">

                            <div class="section-header-icon">

                                <i class="mdi mdi-face-recognition"></i>

                            </div>

                            <div>

                                <h5 class="section-title">
                                    Registrasi Wajah
                                </h5>

                                <p class="section-subtitle">
                                    Foto wajah yang digunakan untuk verifikasi absensi.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="mt-3 mt-md-0">

                        @if(
                        $siswa->faceProfile &&
                        $siswa->faceProfile->is_registered
                        )

                        <span class="registration-status registration-success">

                            <i class="mdi mdi-check-circle me-1"></i>

                            Terdaftar

                        </span>

                        @else

                        <span class="registration-status registration-warning">

                            <i class="mdi mdi-alert-circle-outline me-1"></i>

                            Belum Terdaftar

                        </span>

                        @endif

                    </div>

                </div>


                @if(
                $siswa->faceProfile &&
                $siswa->faceProfile->is_registered &&
                $siswa->faceProfile->images &&
                $siswa->faceProfile->images->count()
                )

                <div class="row">

                    @foreach($siswa->faceProfile->images as $image)

                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4">

                        <div class="face-image-card">

                            <img
                                src="{{ asset('storage/' . $image->file_path) }}"
                                alt="Foto Registrasi Wajah"
                                class="face-image">

                            <p class="face-image-caption">

                                Foto Registrasi
                                {{ $loop->iteration }}

                            </p>

                        </div>

                    </div>

                    @endforeach

                </div>

                @else

                <div class="empty-state">

                    <div class="empty-icon">

                        <i class="mdi mdi-face-recognition"></i>

                    </div>

                    <div class="empty-title">

                        Belum Ada Registrasi Wajah

                    </div>

                    <p class="empty-text">

                        Siswa belum melakukan registrasi wajah.

                    </p>

                </div>

                @endif

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     PENEMPATAN PKL
========================================================== --}}

@if($siswa->penempatanPKL)

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card detail-card">

            <div class="card-body">

                <div class="section-header">

                    <div class="section-header-icon">

                        <i class="mdi mdi-briefcase-outline"></i>

                    </div>

                    <div>

                        <h5 class="section-title">
                            Penempatan PKL
                        </h5>

                        <p class="section-subtitle">
                            Informasi tempat dan pembimbing PKL siswa.
                        </p>

                    </div>

                </div>


                <div class="row">

                    {{-- PERUSAHAAN --}}

                    <div class="col-md-4">

                        <div class="pkl-item">

                            <div class="pkl-label">
                                Perusahaan
                            </div>

                            <div class="pkl-value">

                                {{ $siswa->penempatanPKL->perusahaan->nama_perusahaan ?? '-' }}

                            </div>

                        </div>

                    </div>


                    {{-- GURU --}}

                    <div class="col-md-4">

                        <div class="pkl-item">

                            <div class="pkl-label">
                                Guru Pembimbing
                            </div>

                            <div class="pkl-value">

                                {{ $siswa->penempatanPKL->guru->user->name ?? '-' }}

                            </div>

                        </div>

                    </div>


                    {{-- STATUS --}}

                    <div class="col-md-4">

                        <div class="pkl-item">

                            <div class="pkl-label">
                                Status PKL
                            </div>

                            <div class="pkl-value">

                                @php

                                $statusPKL = strtolower(
                                $siswa->penempatanPKL->status_pkl ?? ''
                                );

                                @endphp


                                @if($statusPKL === 'aktif')

                                <span class="badge badge-success">

                                    <i class="mdi mdi-check-circle-outline me-1"></i>

                                    Aktif

                                </span>

                                @elseif($statusPKL === 'selesai')

                                <span class="badge badge-primary">

                                    <i class="mdi mdi-check-circle-outline me-1"></i>

                                    Selesai

                                </span>

                                @elseif($statusPKL === 'pending')

                                <span class="badge badge-warning">

                                    Pending

                                </span>

                                @else

                                <span class="badge badge-secondary">

                                    {{ $siswa->penempatanPKL->status_pkl ?? '-' }}

                                </span>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endif

@endsection