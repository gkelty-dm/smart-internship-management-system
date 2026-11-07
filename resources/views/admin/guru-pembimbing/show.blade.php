@extends('layouts.skydash-admin')

@section('title', 'Detail Guru Pembimbing')

@section('content')

<style>
    /* =========================================================
       DETAIL GURU PEMBIMBING
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
       PROFILE OVERVIEW
    ========================================================= */

    .profile-overview {
        padding: 22px;
    }

    .profile-main {
        display: flex;
        align-items: center;
        min-height: 90px;
    }

    .profile-avatar {
        width: 76px;
        height: 76px;
        border-radius: 50%;
        background: #f0effb;
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-right: 17px;
    }

    .profile-avatar i {
        font-size: 38px;
    }

    .profile-name {
        font-size: 17px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 5px;
    }

    .profile-role {
        display: inline-block;
        padding: 4px 9px;
        border-radius: 20px;
        background: #f0effb;
        color: #4b49ac;
        font-size: 9px;
        font-weight: 500;
    }

    .profile-status {
        margin-top: 8px;
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
       INFORMATION
    ========================================================= */

    .info-grid {
        border-left: 1px solid #eeeeee;
        padding-left: 22px;
    }

    .info-item {
        padding: 8px 0;
    }

    .info-label {
        font-size: 9px;
        color: #9a9aa5;
        margin-bottom: 3px;
        text-transform: uppercase;
        letter-spacing: .2px;
    }

    .info-value {
        font-size: 11px;
        color: #343a40;
        font-weight: 500;
        word-break: break-word;
    }

    .info-value i {
        color: #4b49ac;
        font-size: 13px;
        margin-right: 5px;
    }

    /* =========================================================
       ADDRESS
    ========================================================= */

    .address-section {
        border-top: 1px solid #eeeeee;
        margin-top: 16px;
        padding-top: 15px;
    }

    .address-box {
        background: #fafaff;
        border: 1px solid #eeeeee;
        border-radius: 8px;
        padding: 13px 15px;
        margin-top: 8px;
    }

    .address-box p {
        font-size: 10px;
        line-height: 1.7;
        color: #666b73;
        margin: 0;
        white-space: pre-line;
    }

    /* =========================================================
       STATISTIC
    ========================================================= */

    .stat-card {
        border: 0;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .035);
    }

    .stat-body {
        padding: 17px 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .stat-label {
        font-size: 10px;
        color: #92929c;
        margin-bottom: 5px;
    }

    .stat-number {
        font-size: 23px;
        line-height: 1;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 4px;
    }

    .stat-description {
        font-size: 9px;
        color: #a1a1aa;
        margin: 0;
    }

    .stat-icon {
        width: 45px;
        height: 45px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .stat-icon i {
        font-size: 22px;
    }

    .stat-primary .stat-icon {
        background: #f0effb;
        color: #4b49ac;
    }

    .stat-success .stat-icon {
        background: #eaf7ef;
        color: #198754;
    }

    .stat-info .stat-icon {
        background: #eaf8fc;
        color: #0dcaf0;
    }

    /* =========================================================
       SECTION TITLE
    ========================================================= */

    .section-title {
        font-size: 14px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 3px;
    }

    .section-description {
        font-size: 10px;
        color: #9a9aa5;
        margin-bottom: 0;
    }

    /* =========================================================
       TABLE
    ========================================================= */

    .student-table-wrapper {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .student-table {
        min-width: 850px;
        margin-bottom: 0;
    }

    .student-table thead th {
        background: #f8f9fa;
        color: #7e7e88;
        border-bottom: 1px solid #eeeeee;
        font-size: 9px;
        font-weight: 600;
        text-transform: uppercase;
        padding: 12px 15px;
        white-space: nowrap;
    }

    .student-table tbody td {
        font-size: 10px;
        color: #555b62;
        padding: 12px 15px;
        border-bottom: 1px solid #f1f1f3;
        white-space: nowrap;
        vertical-align: middle;
    }

    .student-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .student-table tbody tr:hover {
        background: #fafaff;
    }

    .student-avatar {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        background: #f0effb;
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-right: 9px;
    }

    .student-avatar i {
        font-size: 17px;
    }

    .student-name {
        font-size: 10px;
        font-weight: 600;
        color: #343a40;
    }

    .student-label {
        font-size: 8px;
        color: #9a9aa5;
        margin-top: 2px;
    }

    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .empty-state {
        padding: 45px 20px !important;
        text-align: center;
        white-space: normal !important;
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
       ACTION
    ========================================================= */

    .action-card {
        border: 0;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .035);
    }

    .action-body {
        padding: 17px 20px;
    }

    .action-title {
        font-size: 13px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 3px;
    }

    .action-description {
        font-size: 10px;
        color: #9a9aa5;
        margin: 0;
    }

    .action-body .btn {
        font-size: 10px;
        border-radius: 6px;
        padding: 8px 13px;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 991.98px) {

        .info-grid {
            border-left: 0;
            border-top: 1px solid #eeeeee;
            padding-left: 0;
            padding-top: 15px;
            margin-top: 15px;
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

        .profile-overview {
            padding: 17px;
        }

        .profile-main {
            min-height: auto;
        }

        .profile-avatar {
            width: 62px;
            height: 62px;
            margin-right: 13px;
        }

        .profile-avatar i {
            font-size: 30px;
        }

        .profile-name {
            font-size: 15px;
        }

        .stat-body {
            padding: 15px;
        }

        .action-body .btn {
            width: 100%;
            margin-top: 12px;
        }
    }
</style>


<div class="row">

    {{-- =========================================================
         HEADER
    ========================================================= --}}

    <div class="col-12 grid-margin">

        <div class="card detail-card">

            <div class="detail-header">

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <div class="d-flex align-items-center">

                            <div class="detail-icon me-3">

                                <i class="mdi mdi-account-tie-outline"></i>

                            </div>

                            <div>

                                <h4 class="detail-title">
                                    Detail Guru Pembimbing
                                </h4>

                                <p class="detail-subtitle">
                                    Informasi guru pembimbing dan siswa PKL yang menjadi tanggung jawabnya.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="d-flex justify-content-md-end detail-header-actions">

                            <a
                                href="{{ route('admin.guru-pembimbing.edit', $guru->id) }}"
                                class="btn btn-primary me-2">

                                <i class="mdi mdi-pencil-outline me-1"></i>

                                Edit

                            </a>


                            <a
                                href="{{ route('admin.guru-pembimbing.index') }}"
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


    {{-- =========================================================
         PROFILE GURU
    ========================================================= --}}

    <div class="col-12 grid-margin">

        <div class="card detail-card">

            <div class="profile-overview">

                <div class="row">

                    {{-- PROFIL --}}

                    <div class="col-lg-6">

                        <div class="profile-main">

                            <div class="profile-avatar">

                                <i class="mdi mdi-account-tie-outline"></i>

                            </div>


                            <div>

                                <div class="profile-name">

                                    {{ $guru->user->name ?? '-' }}

                                </div>


                                <span class="profile-role">

                                    <i class="mdi mdi-school-outline me-1"></i>

                                    Guru Pembimbing PKL

                                </span>


                                <div class="profile-status">

                                    @if($guru->user && $guru->user->is_active)

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


                        <div class="info-grid mt-3">

                            <div class="row">

                                {{-- NIP --}}

                                <div class="col-md-6">

                                    <div class="info-item">

                                        <div class="info-label">
                                            NIP
                                        </div>

                                        <div class="info-value">

                                            <i class="mdi mdi-card-account-details-outline"></i>

                                            {{ $guru->nip ?? '-' }}

                                        </div>

                                    </div>

                                </div>


                                {{-- EMAIL --}}

                                <div class="col-md-6">

                                    <div class="info-item">

                                        <div class="info-label">
                                            Email
                                        </div>

                                        <div class="info-value">

                                            <i class="mdi mdi-email-outline"></i>

                                            {{ $guru->user->email ?? '-' }}

                                        </div>

                                    </div>

                                </div>


                                {{-- NO HP --}}

                                <div class="col-md-6">

                                    <div class="info-item">

                                        <div class="info-label">
                                            Nomor HP
                                        </div>

                                        <div class="info-value">

                                            <i class="mdi mdi-phone-outline"></i>

                                            {{ $guru->no_hp ?? '-' }}

                                        </div>

                                    </div>

                                </div>


                                {{-- ROLE --}}

                                <div class="col-md-6">

                                    <div class="info-item">

                                        <div class="info-label">
                                            Role Akun
                                        </div>

                                        <div class="info-value">

                                            <i class="mdi mdi-account-check-outline"></i>

                                            Guru

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- ALAMAT --}}

                    <div class="col-lg-6">

                        <div class="info-grid">

                            <div class="company-heading">

                                <div class="company-heading-icon">

                                    <i class="mdi mdi-map-marker-outline"></i>

                                </div>

                                <div>

                                    <div class="company-title">
                                        Alamat Guru
                                    </div>

                                    <p class="company-subtitle">
                                        Informasi alamat guru pembimbing.
                                    </p>

                                </div>

                            </div>


                            <div class="address-box">

                                @if($guru->alamat)

                                <p>{{ $guru->alamat }}</p>

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

        </div>

    </div>


    {{-- =========================================================
         STATISTIK
    ========================================================= --}}

    <div class="col-md-4 grid-margin">

        <div class="card stat-card stat-primary">

            <div class="stat-body">

                <div>

                    <div class="stat-label">
                        Total Siswa Bimbingan
                    </div>

                    <div class="stat-number">

                        {{ isset($guru->penempatanPKL) ? $guru->penempatanPKL->count() : 0 }}

                    </div>

                    <p class="stat-description">
                        Siswa PKL
                    </p>

                </div>


                <div class="stat-icon">

                    <i class="mdi mdi-account-school-outline"></i>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-4 grid-margin">

        <div class="card stat-card stat-success">

            <div class="stat-body">

                <div>

                    <div class="stat-label">
                        Siswa Aktif
                    </div>

                    <div class="stat-number">

                        {{ isset($guru->penempatanPKL) ? $guru->penempatanPKL->where('status_pkl', 'aktif')->count() : 0 }}

                    </div>

                    <p class="stat-description">
                        Sedang melaksanakan PKL
                    </p>

                </div>


                <div class="stat-icon">

                    <i class="mdi mdi-briefcase-check-outline"></i>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-4 grid-margin">

        <div class="card stat-card stat-info">

            <div class="stat-body">

                <div>

                    <div class="stat-label">
                        PKL Selesai
                    </div>

                    <div class="stat-number">

                        {{ isset($guru->penempatanPKL) ? $guru->penempatanPKL->where('status_pkl', 'selesai')->count() : 0 }}

                    </div>

                    <p class="stat-description">
                        Telah menyelesaikan PKL
                    </p>

                </div>


                <div class="stat-icon">

                    <i class="mdi mdi-check-circle-outline"></i>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         SISWA BIMBINGAN
    ========================================================= --}}

    <div class="col-12 grid-margin">

        <div class="card detail-card">

            <div class="card-body p-0">

                <div class="p-4">

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">

                        <div>

                            <h5 class="section-title">

                                <i class="mdi mdi-account-multiple-outline text-primary me-1"></i>

                                Siswa Bimbingan

                            </h5>

                            <p class="section-description">

                                Daftar siswa yang berada di bawah bimbingan guru ini.

                            </p>

                        </div>


                        <div class="mt-3 mt-md-0">

                            <span class="badge badge-primary">

                                {{ isset($guru->penempatanPKL) ? $guru->penempatanPKL->count() : 0 }}
                                Siswa

                            </span>

                        </div>

                    </div>

                </div>


                @if(isset($guru->penempatanPKL) && $guru->penempatanPKL->count())

                <div class="student-table-wrapper">

                    <table class="table student-table">

                        <thead>

                            <tr>

                                <th style="width:60px;">
                                    No
                                </th>

                                <th>
                                    Siswa
                                </th>

                                <th>
                                    Kelas
                                </th>

                                <th>
                                    Jurusan
                                </th>

                                <th>
                                    Perusahaan
                                </th>

                                <th
                                    class="text-center"
                                    style="width:110px;">

                                    Status

                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($guru->penempatanPKL as $penempatan)

                            <tr>

                                <td class="font-weight-bold">

                                    {{ $loop->iteration }}

                                </td>


                                <td>

                                    <div class="d-flex align-items-center">

                                        <div class="student-avatar">

                                            <i class="mdi mdi-account-school-outline"></i>

                                        </div>


                                        <div>

                                            <div class="student-name">

                                                {{ $penempatan->siswa->user->name ?? '-' }}

                                            </div>

                                            <div class="student-label">

                                                NIS:
                                                {{ $penempatan->siswa->nis ?? '-' }}

                                            </div>

                                        </div>

                                    </div>

                                </td>


                                <td>

                                    {{ $penempatan->siswa->kelas->nama_kelas ?? '-' }}

                                </td>


                                <td>

                                    {{ $penempatan->siswa->jurusan->nama_jurusan ?? '-' }}

                                </td>


                                <td>

                                    {{ $penempatan->perusahaan->nama_perusahaan ?? '-' }}

                                </td>


                                <td class="text-center">

                                    @if($penempatan->status_pkl === 'aktif')

                                    <span class="badge badge-success">

                                        <i class="mdi mdi-check-circle-outline me-1"></i>

                                        Aktif

                                    </span>

                                    @elseif($penempatan->status_pkl === 'selesai')

                                    <span class="badge badge-primary">

                                        <i class="mdi mdi-check-circle-outline me-1"></i>

                                        Selesai

                                    </span>

                                    @else

                                    <span class="badge badge-secondary">

                                        {{ ucfirst($penempatan->status_pkl ?? '-') }}

                                    </span>

                                    @endif

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                @else

                <div class="empty-state">

                    <div class="empty-icon">

                        <i class="mdi mdi-account-group-outline"></i>

                    </div>


                    <div class="empty-title">

                        Belum Ada Siswa Bimbingan

                    </div>


                    <p class="empty-text">

                        Belum terdapat siswa yang ditempatkan
                        pada guru pembimbing ini.

                    </p>

                </div>

                @endif

            </div>

        </div>

    </div>


    {{-- =========================================================
         AKSI
    ========================================================= --}}

    <div class="col-12 grid-margin">

        <div class="card action-card">

            <div class="action-body">

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">

                    <div>

                        <h5 class="action-title">

                            <i class="mdi mdi-cog-outline text-primary me-1"></i>

                            Kelola Guru Pembimbing

                        </h5>

                        <p class="action-description">

                            Gunakan tindakan berikut untuk mengelola data guru pembimbing.

                        </p>

                    </div>


                    <form
                        action="{{ route('admin.guru-pembimbing.destroy', $guru->id) }}"
                        method="POST"
                        class="form-delete">

                        @csrf

                        @method('DELETE')

                        <button
                            type="button"
                            class="btn btn-outline-danger btn-delete"
                            data-name="{{ $guru->user->name ?? 'guru pembimbing ini' }}">

                            <i class="mdi mdi-delete-outline me-1"></i>

                            Hapus Guru Pembimbing

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection