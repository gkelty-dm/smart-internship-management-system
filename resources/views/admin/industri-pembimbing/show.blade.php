@extends('layouts.skydash-admin')

@section('title', 'Detail Pembimbing Industri')

@section('content')

<style>
    /* =========================================================
       DETAIL PEMBIMBING INDUSTRI
       Mengikuti gaya Skydash + Bootstrap
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
       PROFILE INFORMATION
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
       COMPANY
    ========================================================= */

    .company-section {
        border-top: 1px solid #eeeeee;
        margin-top: 5px;
        padding-top: 20px;
    }

    .company-heading {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .company-heading-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background: #f0effb;
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
    }

    .company-heading-icon i {
        font-size: 18px;
    }

    .company-title {
        font-size: 13px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 2px;
    }

    .company-subtitle {
        font-size: 9px;
        color: #9a9aa5;
        margin: 0;
    }

    .company-box {
        padding: 15px;
        background: #fafaff;
        border: 1px solid #eeeeee;
        border-radius: 8px;
    }

    .company-name {
        font-size: 13px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 5px;
    }

    .company-address {
        font-size: 10px;
        color: #777780;
        line-height: 1.6;
    }

    .company-address i {
        color: #4b49ac;
        margin-right: 4px;
    }

    .company-contact {
        border-top: 1px solid #eeeeee;
        margin-top: 11px;
        padding-top: 10px;
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
       EMPTY TABLE
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
                                    Detail Pembimbing Industri
                                </h4>

                                <p class="detail-subtitle">
                                    Informasi pembimbing industri dan data siswa PKL yang dibimbing.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="d-flex justify-content-md-end detail-header-actions">

                            <a
                                href="{{ route('admin.industri-pembimbing.edit', $industri->id) }}"
                                class="btn btn-primary me-2">

                                <i class="mdi mdi-pencil-outline me-1"></i>

                                Edit

                            </a>


                            <a
                                href="{{ route('admin.industri-pembimbing.index') }}"
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
         FLASH MESSAGE
    ========================================================= --}}

    @if(session('success'))

    <div class="col-12">

        <div class="alert alert-success alert-dismissible fade show">

            <div class="d-flex align-items-center">

                <i
                    class="mdi mdi-check-circle-outline me-2"
                    style="font-size:20px;">
                </i>

                <span>
                    {{ session('success') }}
                </span>

            </div>


            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    </div>

    @endif


    @if(session('error'))

    <div class="col-12">

        <div class="alert alert-danger alert-dismissible fade show">

            <div class="d-flex align-items-center">

                <i
                    class="mdi mdi-alert-circle-outline me-2"
                    style="font-size:20px;">
                </i>

                <span>
                    {{ session('error') }}
                </span>

            </div>


            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    </div>

    @endif


    {{-- =========================================================
         PROFILE + PERUSAHAAN
    ========================================================= --}}

    <div class="col-12 grid-margin">

        <div class="card detail-card">

            <div class="profile-overview">

                <div class="row">

                    {{-- PEMBIMBING --}}

                    <div class="col-lg-6">

                        <div class="profile-main">

                            <div class="profile-avatar">

                                <i class="mdi mdi-account-tie-outline"></i>

                            </div>


                            <div>

                                <div class="profile-name">

                                    {{ $industri->user->name ?? '-' }}

                                </div>


                                <span class="profile-role">

                                    <i class="mdi mdi-briefcase-account-outline me-1"></i>

                                    Pembimbing Industri

                                </span>


                                <div class="profile-status">

                                    @if($industri->user && $industri->user->is_active)

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

                                <div class="col-md-6">

                                    <div class="info-item">

                                        <div class="info-label">
                                            Email
                                        </div>

                                        <div class="info-value">

                                            <i class="mdi mdi-email-outline"></i>

                                            {{ $industri->user->email ?? '-' }}

                                        </div>

                                    </div>

                                </div>


                                <div class="col-md-6">

                                    <div class="info-item">

                                        <div class="info-label">
                                            Nomor HP
                                        </div>

                                        <div class="info-value">

                                            <i class="mdi mdi-phone-outline"></i>

                                            {{ $industri->no_hp ?? '-' }}

                                        </div>

                                    </div>

                                </div>


                                <div class="col-md-6">

                                    <div class="info-item">

                                        <div class="info-label">
                                            Jabatan
                                        </div>

                                        <div class="info-value">

                                            <i class="mdi mdi-badge-account-outline"></i>

                                            {{ $industri->jabatan ?? '-' }}

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- PERUSAHAAN --}}

                    <div class="col-lg-6">

                        <div class="info-grid">

                            <div class="company-heading">

                                <div class="company-heading-icon">

                                    <i class="mdi mdi-office-building-outline"></i>

                                </div>

                                <div>

                                    <div class="company-title">
                                        Industri / DUDI
                                    </div>

                                    <p class="company-subtitle">
                                        Perusahaan tempat pembimbing bertugas.
                                    </p>

                                </div>

                            </div>


                            <div class="company-box">

                                <div class="company-name">

                                    {{ $industri->perusahaan->nama_perusahaan ?? '-' }}

                                </div>


                                <div class="company-address">

                                    <i class="mdi mdi-map-marker-outline"></i>

                                    {{ $industri->perusahaan->alamat ?? '-' }}

                                </div>


                                <div class="company-contact">

                                    <div class="row">

                                        <div class="col-md-6">

                                            <div class="info-label">
                                                Telepon
                                            </div>

                                            <div class="info-value">

                                                <i class="mdi mdi-phone-outline"></i>

                                                {{ $industri->perusahaan->telepon ?? '-' }}

                                            </div>

                                        </div>


                                        <div class="col-md-6">

                                            <div class="info-label">
                                                Email
                                            </div>

                                            <div class="info-value">

                                                <i class="mdi mdi-email-outline"></i>

                                                {{ $industri->perusahaan->email ?? '-' }}

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
                        {{ $penempatans->count() }}
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
                        PKL Aktif
                    </div>

                    <div class="stat-number">
                        {{ $penempatans->where('status_pkl', 'aktif')->count() }}
                    </div>

                    <p class="stat-description">
                        Sedang berlangsung
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
                        {{ $penempatans->where('status_pkl', 'selesai')->count() }}
                    </div>

                    <p class="stat-description">
                        Telah selesai
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

                                <i class="mdi mdi-account-school-outline text-primary me-1"></i>

                                Siswa Bimbingan

                            </h5>

                            <p class="section-description">

                                Daftar siswa PKL yang berada di bawah bimbingan pembimbing ini.

                            </p>

                        </div>


                        <div class="mt-3 mt-md-0">

                            <span class="badge badge-primary">

                                <i class="mdi mdi-account-school-outline me-1"></i>

                                {{ $penempatans->count() }} Siswa

                            </span>

                        </div>

                    </div>

                </div>


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
                                    Guru Pembimbing
                                </th>

                                <th
                                    class="text-center"
                                    style="width:120px;">

                                    Status

                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($penempatans as $penempatan)

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
                                                Siswa PKL
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

                                    {{ $penempatan->guru->user->name ?? '-' }}

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

                            @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="empty-state">

                                    <div class="empty-icon">

                                        <i class="mdi mdi-account-school-outline"></i>

                                    </div>


                                    <div class="empty-title">

                                        Belum Ada Siswa Bimbingan

                                    </div>


                                    <p class="empty-text">

                                        Belum terdapat siswa PKL yang ditempatkan
                                        pada pembimbing ini.

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

                            Kelola Pembimbing

                        </h5>

                        <p class="action-description">

                            Kelola data pembimbing industri ini melalui tindakan yang tersedia.

                        </p>

                    </div>


                    <form
                        action="{{ route('admin.industri-pembimbing.destroy', $industri->id) }}"
                        method="POST"
                        class="form-delete">

                        @csrf

                        @method('DELETE')

                        <button
                            type="button"
                            class="btn btn-outline-danger btn-delete"
                            data-name="{{ $industri->user->name ?? 'pembimbing industri ini' }}">

                            <i class="mdi mdi-delete-outline me-1"></i>

                            Hapus Pembimbing

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection