@extends('layouts.skydash-admin')

@section('title', 'Detail Penempatan PKL')

@section('content')

<style>
    .page-card {
        border: 0;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .035);
    }

    .page-header {
        padding: 20px 22px;
    }

    .page-header-icon {
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

    .page-header-icon i {
        font-size: 23px;
    }

    .page-title {
        font-size: 18px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 3px;
    }

    .page-subtitle {
        font-size: 11px;
        color: #9a9aa5;
        margin: 0;
    }

    .page-header .btn {
        font-size: 10px;
        border-radius: 6px;
        padding: 8px 13px;
    }

    .detail-card {
        border: 0;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .035);
    }

    .detail-card-body {
        padding: 22px;
    }

    .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .section-icon {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        background: rgba(75, 73, 172, .10);
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
        flex-shrink: 0;
    }

    .section-icon i {
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

    .profile-box {
        border: 1px solid #eeeeee;
        border-radius: 9px;
        padding: 18px;
        background: #fff;
    }

    .profile-icon {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: rgba(75, 73, 172, .08);
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .profile-icon i {
        font-size: 31px;
    }

    .profile-name {
        font-size: 14px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 3px;
    }

    .profile-subtitle {
        font-size: 10px;
        color: #9a9aa5;
        margin: 0;
    }

    .detail-item {
        padding: 11px 0;
        border-bottom: 1px solid #eeeeee;
    }

    .detail-item:last-child {
        border-bottom: 0;
        padding-bottom: 0;
    }

    .detail-label {
        display: block;
        font-size: 9px;
        color: #9a9aa5;
        margin-bottom: 4px;
    }

    .detail-value {
        display: block;
        font-size: 11px;
        font-weight: 600;
        color: #343a40;
        line-height: 1.5;
    }

    .detail-value-normal {
        display: block;
        font-size: 11px;
        color: #495057;
        line-height: 1.6;
    }

    .status-box {
        border: 1px solid #eeeeee;
        border-radius: 9px;
        padding: 16px 18px;
        background: #fff;
    }

    .status-label {
        font-size: 10px;
        color: #9a9aa5;
        margin-bottom: 7px;
    }

    .status-box .badge {
        font-size: 9px;
        padding: 7px 10px;
        border-radius: 5px;
    }

    .period-box {
        border: 1px solid #eeeeee;
        border-radius: 9px;
        padding: 16px 18px;
        height: 100%;
    }

    .period-icon {
        width: 34px;
        height: 34px;
        border-radius: 7px;
        background: rgba(75, 73, 172, .08);
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
        flex-shrink: 0;
    }

    .period-icon i {
        font-size: 17px;
    }

    .period-label {
        font-size: 9px;
        color: #9a9aa5;
        margin-bottom: 4px;
    }

    .period-date {
        font-size: 13px;
        font-weight: 600;
        color: #343a40;
    }

    .system-item {
        padding-right: 20px;
    }

    .system-item:not(:last-child) {
        border-right: 1px solid #eeeeee;
    }

    .empty-state {
        text-align: center;
        padding: 35px 15px;
    }

    .empty-state i {
        font-size: 40px;
        color: #c7c7cf;
    }

    .empty-state p {
        font-size: 10px;
        color: #9a9aa5;
        margin-top: 8px;
        margin-bottom: 0;
    }

    @media (max-width: 767.98px) {

        .page-header {
            padding: 17px;
        }

        .page-header-actions {
            width: 100%;
            margin-top: 15px;
        }

        .page-header-actions .btn {
            width: 100%;
            margin-bottom: 8px;
        }

        .detail-card-body {
            padding: 17px;
        }

        .profile-box {
            padding: 15px;
        }

        .system-item {
            border-right: 0 !important;
            border-bottom: 1px solid #eeeeee;
            padding: 12px 0;
        }

        .system-item:last-child {
            border-bottom: 0;
        }
    }
</style>


{{-- =========================================================
     HEADER
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card page-card">

            <div class="page-header">

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <div class="d-flex align-items-center">

                            <div class="page-header-icon me-3">

                                <i class="mdi mdi-briefcase-account-outline"></i>

                            </div>

                            <div>

                                <h4 class="page-title">
                                    Detail Penempatan PKL
                                </h4>

                                <p class="page-subtitle">
                                    Informasi lengkap penempatan siswa selama kegiatan PKL.
                                </p>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="d-flex justify-content-md-end page-header-actions">

                            <a
                                href="{{ route('admin.penempatan-pkl.edit', $penempatan->id) }}"
                                class="btn btn-primary me-2">

                                <i class="mdi mdi-square-edit-outline me-1"></i>

                                Edit

                            </a>

                            <a
                                href="{{ route('admin.penempatan-pkl.index') }}"
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
     STATUS
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card detail-card">

            <div class="detail-card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <h5 class="section-title mb-1">
                            Status Penempatan
                        </h5>

                        <p class="section-subtitle">
                            Status kegiatan PKL siswa saat ini.
                        </p>

                    </div>

                    <div>

                        @if($penempatan->status_pkl === 'pending')

                        <span class="badge badge-warning">

                            <i class="mdi mdi-clock-outline me-1"></i>

                            Pending

                        </span>

                        @elseif($penempatan->status_pkl === 'aktif')

                        <span class="badge badge-success">

                            <i class="mdi mdi-check-circle-outline me-1"></i>

                            Aktif

                        </span>

                        @elseif($penempatan->status_pkl === 'selesai')

                        <span class="badge badge-primary">

                            <i class="mdi mdi-check-all me-1"></i>

                            Selesai

                        </span>

                        @elseif($penempatan->status_pkl === 'dibatalkan')

                        <span class="badge badge-danger">

                            <i class="mdi mdi-close-circle-outline me-1"></i>

                            Dibatalkan

                        </span>

                        @else

                        <span class="badge badge-secondary">
                            -
                        </span>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     SISWA + GURU
========================================================= --}}

<div class="row">

    {{-- SISWA --}}

    <div class="col-md-6 grid-margin stretch-card">

        <div class="card detail-card">

            <div class="detail-card-body">

                <div class="section-header">

                    <div class="section-icon">

                        <i class="mdi mdi-account-school-outline"></i>

                    </div>

                    <div>

                        <h5 class="section-title">
                            Data Siswa
                        </h5>

                        <p class="section-subtitle">
                            Informasi siswa yang ditempatkan.
                        </p>

                    </div>

                </div>


                @if($penempatan->siswa)

                <div class="profile-box">

                    <div class="d-flex align-items-center mb-3">

                        <div class="profile-icon me-3">

                            <i class="mdi mdi-account-school-outline"></i>

                        </div>

                        <div>

                            <h5 class="profile-name">

                                {{ $penempatan->siswa->user->name ?? '-' }}

                            </h5>

                            <p class="profile-subtitle">

                                NISN:
                                {{ $penempatan->siswa->nisn ?? '-' }}

                            </p>

                        </div>

                    </div>


                    <div class="row">

                        <div class="col-sm-6">

                            <div class="detail-item">

                                <span class="detail-label">
                                    Kelas
                                </span>

                                <span class="detail-value">

                                    {{ $penempatan->siswa->kelas->nama_kelas ?? '-' }}

                                </span>

                            </div>

                        </div>

                        <div class="col-sm-6">

                            <div class="detail-item">

                                <span class="detail-label">
                                    Jurusan
                                </span>

                                <span class="detail-value">

                                    {{ $penempatan->siswa->jurusan->nama_jurusan ?? '-' }}

                                </span>

                            </div>

                        </div>

                    </div>


                    <div class="detail-item">

                        <span class="detail-label">
                            No. HP
                        </span>

                        <span class="detail-value">

                            {{ $penempatan->siswa->no_hp ?? '-' }}

                        </span>

                    </div>


                    <div class="detail-item">

                        <span class="detail-label">
                            Alamat
                        </span>

                        <span class="detail-value-normal">

                            {{ $penempatan->siswa->alamat ?? '-' }}

                        </span>

                    </div>

                </div>

                @else

                <div class="empty-state">

                    <i class="mdi mdi-account-off-outline"></i>

                    <p>
                        Data siswa tidak ditemukan.
                    </p>

                </div>

                @endif

            </div>

        </div>

    </div>


    {{-- GURU --}}

    <div class="col-md-6 grid-margin stretch-card">

        <div class="card detail-card">

            <div class="detail-card-body">

                <div class="section-header">

                    <div class="section-icon">

                        <i class="mdi mdi-account-supervisor-outline"></i>

                    </div>

                    <div>

                        <h5 class="section-title">
                            Guru Pembimbing
                        </h5>

                        <p class="section-subtitle">
                            Guru pembimbing dari sekolah.
                        </p>

                    </div>

                </div>


                @if($penempatan->guru)

                <div class="profile-box">

                    <div class="d-flex align-items-center mb-3">

                        <div class="profile-icon me-3">

                            <i class="mdi mdi-account-supervisor-outline"></i>

                        </div>

                        <div>

                            <h5 class="profile-name">

                                {{ $penempatan->guru->user->name ?? '-' }}

                            </h5>

                            <p class="profile-subtitle">
                                Guru Pembimbing Sekolah
                            </p>

                        </div>

                    </div>


                    <div class="detail-item">

                        <span class="detail-label">
                            NIP
                        </span>

                        <span class="detail-value">

                            {{ $penempatan->guru->nip ?? '-' }}

                        </span>

                    </div>


                    <div class="detail-item">

                        <span class="detail-label">
                            No. HP
                        </span>

                        <span class="detail-value">

                            {{ $penempatan->guru->no_hp ?? '-' }}

                        </span>

                    </div>


                    <div class="detail-item">

                        <span class="detail-label">
                            Email
                        </span>

                        <span class="detail-value">

                            {{ $penempatan->guru->user->email ?? '-' }}

                        </span>

                    </div>

                </div>

                @else

                <div class="empty-state">

                    <i class="mdi mdi-account-off-outline"></i>

                    <p>
                        Data guru pembimbing tidak ditemukan.
                    </p>

                </div>

                @endif

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     PERUSAHAAN + PEMBIMBING INDUSTRI
========================================================= --}}

<div class="row">

    {{-- PERUSAHAAN --}}

    <div class="col-md-6 grid-margin stretch-card">

        <div class="card detail-card">

            <div class="detail-card-body">

                <div class="section-header">

                    <div class="section-icon">

                        <i class="mdi mdi-domain"></i>

                    </div>

                    <div>

                        <h5 class="section-title">
                            Perusahaan / Lokasi PKL
                        </h5>

                        <p class="section-subtitle">
                            Tempat siswa melaksanakan PKL.
                        </p>

                    </div>

                </div>


                @if($penempatan->perusahaan)

                <div class="profile-box">

                    <h5 class="profile-name mb-3">

                        {{ $penempatan->perusahaan->nama_perusahaan }}

                    </h5>


                    <div class="detail-item">

                        <span class="detail-label">
                            Alamat
                        </span>

                        <span class="detail-value-normal">

                            {{ $penempatan->perusahaan->alamat ?? '-' }}

                        </span>

                    </div>


                    <div class="row">

                        <div class="col-sm-6">

                            <div class="detail-item">

                                <span class="detail-label">
                                    Telepon
                                </span>

                                <span class="detail-value">

                                    {{ $penempatan->perusahaan->telepon ?? '-' }}

                                </span>

                            </div>

                        </div>

                        <div class="col-sm-6">

                            <div class="detail-item">

                                <span class="detail-label">
                                    Email
                                </span>

                                <span class="detail-value">

                                    {{ $penempatan->perusahaan->email ?? '-' }}

                                </span>

                            </div>

                        </div>

                    </div>

                </div>

                @else

                <div class="empty-state">

                    <i class="mdi mdi-domain-off"></i>

                    <p>
                        Data perusahaan tidak ditemukan.
                    </p>

                </div>

                @endif

            </div>

        </div>

    </div>


    {{-- PEMBIMBING INDUSTRI --}}

    <div class="col-md-6 grid-margin stretch-card">

        <div class="card detail-card">

            <div class="detail-card-body">

                <div class="section-header">

                    <div class="section-icon">

                        <i class="mdi mdi-account-tie-outline"></i>

                    </div>

                    <div>

                        <h5 class="section-title">
                            Pembimbing Industri
                        </h5>

                        <p class="section-subtitle">
                            Pembimbing dari pihak perusahaan.
                        </p>

                    </div>

                </div>


                @if($penempatan->industri)

                <div class="profile-box">

                    <div class="d-flex align-items-center mb-3">

                        <div class="profile-icon me-3">

                            <i class="mdi mdi-account-tie-outline"></i>

                        </div>

                        <div>

                            <h5 class="profile-name">

                                {{ $penempatan->industri->user->name ?? '-' }}

                            </h5>

                            <p class="profile-subtitle">

                                {{ $penempatan->industri->jabatan ?? 'Pembimbing Industri' }}

                            </p>

                        </div>

                    </div>


                    <div class="detail-item">

                        <span class="detail-label">
                            Perusahaan
                        </span>

                        <span class="detail-value">

                            {{ $penempatan->industri->perusahaan->nama_perusahaan ?? '-' }}

                        </span>

                    </div>


                    <div class="detail-item">

                        <span class="detail-label">
                            Email
                        </span>

                        <span class="detail-value">

                            {{ $penempatan->industri->user->email ?? '-' }}

                        </span>

                    </div>


                    <div class="detail-item">

                        <span class="detail-label">
                            No. HP
                        </span>

                        <span class="detail-value">

                            {{ $penempatan->industri->no_hp ?? '-' }}

                        </span>

                    </div>

                </div>

                @else

                <div class="empty-state">

                    <i class="mdi mdi-account-off-outline"></i>

                    <p>
                        Pembimbing industri belum ditentukan.
                    </p>

                </div>

                @endif

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     PERIODE PKL
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card detail-card">

            <div class="detail-card-body">

                <div class="section-header">

                    <div class="section-icon">

                        <i class="mdi mdi-calendar-range"></i>

                    </div>

                    <div>

                        <h5 class="section-title">
                            Periode PKL
                        </h5>

                        <p class="section-subtitle">
                            Periode pelaksanaan kegiatan PKL siswa.
                        </p>

                    </div>

                </div>


                <div class="row">

                    <div class="col-md-6 mb-3 mb-md-0">

                        <div class="period-box">

                            <div class="d-flex align-items-center">

                                <div class="period-icon">

                                    <i class="mdi mdi-calendar-start"></i>

                                </div>

                                <div>

                                    <div class="period-label">
                                        Tanggal Mulai
                                    </div>

                                    <div class="period-date">

                                        {{ $penempatan->tanggal_mulai
                                            ? \Carbon\Carbon::parse(
                                                $penempatan->tanggal_mulai
                                            )->format('d F Y')
                                            : '-'
                                        }}

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="period-box">

                            <div class="d-flex align-items-center">

                                <div class="period-icon">

                                    <i class="mdi mdi-calendar-end"></i>

                                </div>

                                <div>

                                    <div class="period-label">
                                        Tanggal Selesai
                                    </div>

                                    <div class="period-date">

                                        {{ $penempatan->tanggal_selesai
                                            ? \Carbon\Carbon::parse(
                                                $penempatan->tanggal_selesai
                                            )->format('d F Y')
                                            : '-'
                                        }}

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     INFORMASI SISTEM
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card detail-card">

            <div class="detail-card-body">

                <div class="section-header">

                    <div class="section-icon">

                        <i class="mdi mdi-information-outline"></i>

                    </div>

                    <div>

                        <h5 class="section-title">
                            Informasi Sistem
                        </h5>

                        <p class="section-subtitle">
                            Informasi pencatatan data penempatan.
                        </p>

                    </div>

                </div>


                <div class="row">

                    <div class="col-md-4 mb-3 mb-md-0">

                        <div class="system-item">

                            <span class="detail-label">
                                ID Penempatan
                            </span>

                            <span class="detail-value">

                                #{{ $penempatan->id }}

                            </span>

                        </div>

                    </div>


                    <div class="col-md-4 mb-3 mb-md-0">

                        <div class="system-item">

                            <span class="detail-label">
                                Dibuat
                            </span>

                            <span class="detail-value">

                                {{ $penempatan->created_at
                                    ? $penempatan->created_at->format('d/m/Y H:i')
                                    : '-'
                                }}

                            </span>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="system-item">

                            <span class="detail-label">
                                Terakhir Diperbarui
                            </span>

                            <span class="detail-value">

                                {{ $penempatan->updated_at
                                    ? $penempatan->updated_at->format('d/m/Y H:i')
                                    : '-'
                                }}

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection