@extends('layouts.skydash-admin')

@section('title', 'Detail User')

@section('content')

<style>
    .user-detail-header {
        border: 0;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 3px 16px rgba(0, 0, 0, .035);
    }

    .header-inner {
        padding: 20px 22px;
    }

    .header-icon {
        width: 46px;
        height: 46px;
        border-radius: 9px;
        background: rgba(75, 73, 172, .10);
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .header-icon i {
        font-size: 23px;
    }

    .page-title {
        font-size: 18px;
        font-weight: 600;
        color: #343a40;
        margin: 0 0 3px;
    }

    .page-subtitle {
        font-size: 10px;
        color: #9999a4;
        margin: 0;
    }

    .header-id {
        display: inline-flex;
        align-items: center;
        padding: 5px 8px;
        background: #f7f7fa;
        border: 1px solid #eeeeF2;
        border-radius: 5px;
        color: #777;
        font-size: 8px;
        margin-left: 8px;
    }

    .header-btn {
        height: 38px;
        border-radius: 7px;
        font-size: 9px;
        padding: 8px 14px;
    }

    .detail-card {
        border: 0;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 3px 16px rgba(0, 0, 0, .035);
    }

    .detail-card .card-body {
        padding: 25px;
    }

    .profile-section {
        display: flex;
        align-items: center;
        padding: 18px;
        background: #fafaff;
        border: 1px solid #eeeeF2;
        border-radius: 10px;
        margin-bottom: 25px;
    }

    .profile-photo {
        width: 72px;
        height: 72px;
        border-radius: 10px;
        object-fit: cover;
        border: 1px solid #eeeeF2;
        background: #fff;
        margin-right: 15px;
    }

    .profile-placeholder {
        width: 72px;
        height: 72px;
        border-radius: 10px;
        background: #fff;
        border: 1px solid #eeeeF2;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        flex-shrink: 0;
    }

    .profile-placeholder i {
        font-size: 34px;
        color: #b5b5bf;
    }

    .profile-name {
        font-size: 15px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 4px;
    }

    .profile-email {
        font-size: 9px;
        color: #9999a4;
        margin-bottom: 8px;
    }

    .role-badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 9px;
        border-radius: 5px;
        font-size: 8px;
        font-weight: 500;
    }

    .role-admin {
        background: rgba(75, 73, 172, .10);
        color: #4b49ac;
    }

    .role-guru {
        background: rgba(40, 167, 69, .10);
        color: #28a745;
    }

    .role-siswa {
        background: rgba(23, 162, 184, .10);
        color: #17a2b8;
    }

    .role-industri {
        background: rgba(255, 193, 7, .13);
        color: #b88600;
    }

    .role-other {
        background: #f1f1f4;
        color: #777;
    }

    .section-heading {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .section-icon {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        background: rgba(75, 73, 172, .09);
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
        flex-shrink: 0;
    }

    .section-icon i {
        font-size: 18px;
    }

    .section-title {
        font-size: 13px;
        font-weight: 600;
        color: #343a40;
        margin: 0 0 2px;
    }

    .section-description {
        font-size: 9px;
        color: #9999a4;
        margin: 0;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        border: 1px solid #eeeeF2;
        border-radius: 9px;
        overflow: hidden;
    }

    .info-item {
        padding: 16px 17px;
        border-bottom: 1px solid #eeeeF2;
    }

    .info-item:nth-child(odd) {
        border-right: 1px solid #eeeeF2;
    }

    .info-item:nth-last-child(-n+2) {
        border-bottom: 0;
    }

    .info-label {
        display: block;
        font-size: 8px;
        color: #9999a4;
        margin-bottom: 6px;
    }

    .info-value {
        font-size: 10px;
        font-weight: 600;
        color: #555;
        word-break: break-word;
    }

    .info-value i {
        color: #4b49ac;
        margin-right: 5px;
    }

    .id-value {
        display: inline-flex;
        padding: 4px 8px;
        border-radius: 5px;
        background: #f7f7fa;
        border: 1px solid #eeeeF2;
        font-size: 8px;
        color: #666;
    }

    .status-active {
        display: inline-flex;
        align-items: center;
        padding: 5px 9px;
        border-radius: 5px;
        background: rgba(40, 167, 69, .10);
        color: #28a745;
        font-size: 8px;
        font-weight: 500;
    }

    .status-inactive {
        display: inline-flex;
        align-items: center;
        padding: 5px 9px;
        border-radius: 5px;
        background: rgba(220, 53, 69, .10);
        color: #dc3545;
        font-size: 8px;
        font-weight: 500;
    }

    .account-actions {
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #eeeeF2;
    }

    .actions-title {
        font-size: 11px;
        font-weight: 600;
        color: #555;
        margin-bottom: 4px;
    }

    .actions-description {
        font-size: 8px;
        color: #9999a4;
        margin-bottom: 14px;
    }

    .action-btn {
        height: 38px;
        border-radius: 7px;
        font-size: 9px;
        padding: 8px 14px;
    }

    .alert-custom {
        border: 0;
        border-radius: 8px;
        font-size: 9px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .025);
    }

    @media (max-width: 767.98px) {

        .header-inner {
            padding: 17px;
        }

        .detail-card .card-body {
            padding: 17px;
        }

        .header-id {
            display: none;
        }

        .profile-section {
            padding: 14px;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .info-item {
            border-right: 0 !important;
            border-bottom: 1px solid #eeeeF2 !important;
        }

        .info-item:last-child {
            border-bottom: 0 !important;
        }

        .header-btn {
            width: 100%;
        }
    }
</style>


{{-- =========================================================
     HEADER
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card user-detail-header">

            <div class="header-inner">

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <div class="d-flex align-items-center">

                            <div class="header-icon me-3">

                                <i class="mdi mdi-account-details-outline"></i>

                            </div>

                            <div>

                                <div class="d-flex align-items-center">

                                    <h4 class="page-title">
                                        Detail User
                                    </h4>

                                    <span class="header-id">
                                        #{{ $user->id }}
                                    </span>

                                </div>

                                <p class="page-subtitle">
                                    Informasi lengkap akun pengguna dalam sistem SIMPKL.
                                </p>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4 mt-3 mt-md-0">

                        <div class="d-flex justify-content-md-end gap-2">

                            <a
                                href="{{ route('admin.users.edit', $user->id) }}"
                                class="btn btn-primary header-btn">

                                <i class="mdi mdi-pencil-outline me-1"></i>

                                Edit User

                            </a>

                            <a
                                href="{{ route('admin.users.index') }}"
                                class="btn btn-light header-btn">

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
     CONTENT
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card detail-card">

            <div class="card-body">


                {{-- =================================================
                     PROFILE
                ================================================== --}}

                <div class="profile-section">

                    @if($user->foto_profil)

                    <img
                        src="{{ $user->foto_profil }}"
                        alt="{{ $user->name }}"
                        class="profile-photo">

                    @else

                    <div class="profile-placeholder">

                        <i class="mdi mdi-account-outline"></i>

                    </div>

                    @endif


                    <div>

                        <div class="profile-name">
                            {{ $user->name }}
                        </div>

                        <div class="profile-email">
                            {{ $user->email }}
                        </div>


                        @if($user->role === 'admin')

                        <span class="role-badge role-admin">

                            <i class="mdi mdi-shield-account-outline me-1"></i>

                            Admin

                        </span>

                        @elseif($user->role === 'guru')

                        <span class="role-badge role-guru">

                            <i class="mdi mdi-teach me-1"></i>

                            Guru Pembimbing

                        </span>

                        @elseif($user->role === 'siswa')

                        <span class="role-badge role-siswa">

                            <i class="mdi mdi-school-outline me-1"></i>

                            Siswa

                        </span>

                        @elseif($user->role === 'industri')

                        <span class="role-badge role-industri">

                            <i class="mdi mdi-domain me-1"></i>

                            Industri Pembimbing

                        </span>

                        @else

                        <span class="role-badge role-other">

                            <i class="mdi mdi-account-outline me-1"></i>

                            {{ ucfirst($user->role) }}

                        </span>

                        @endif

                    </div>

                </div>


                {{-- =================================================
                     INFORMASI AKUN
                ================================================== --}}

                <div class="section-heading">

                    <div class="section-icon">

                        <i class="mdi mdi-information-outline"></i>

                    </div>

                    <div>

                        <h5 class="section-title">
                            Informasi Akun
                        </h5>

                        <p class="section-description">
                            Detail data pengguna yang tersimpan dalam sistem.
                        </p>

                    </div>

                </div>


                <div class="info-grid">


                    {{-- NAMA --}}

                    <div class="info-item">

                        <span class="info-label">
                            Nama Lengkap
                        </span>

                        <div class="info-value">

                            <i class="mdi mdi-account-outline"></i>

                            {{ $user->name }}

                        </div>

                    </div>


                    {{-- EMAIL --}}

                    <div class="info-item">

                        <span class="info-label">
                            Alamat Email
                        </span>

                        <div class="info-value">

                            <i class="mdi mdi-email-outline"></i>

                            {{ $user->email }}

                        </div>

                    </div>


                    {{-- ROLE --}}

                    <div class="info-item">

                        <span class="info-label">
                            Role Pengguna
                        </span>

                        <div class="info-value">

                            <i class="mdi mdi-shield-account-outline"></i>

                            @if($user->role === 'admin')

                            Admin

                            @elseif($user->role === 'guru')

                            Guru Pembimbing

                            @elseif($user->role === 'siswa')

                            Siswa

                            @elseif($user->role === 'industri')

                            Industri Pembimbing

                            @else

                            {{ ucfirst($user->role) }}

                            @endif

                        </div>

                    </div>


                    {{-- STATUS --}}

                    <div class="info-item">

                        <span class="info-label">
                            Status Akun
                        </span>

                        <div>

                            @if($user->is_active)

                            <span class="status-active">

                                <i class="mdi mdi-check-circle-outline me-1"></i>

                                Aktif

                            </span>

                            @else

                            <span class="status-inactive">

                                <i class="mdi mdi-close-circle-outline me-1"></i>

                                Nonaktif

                            </span>

                            @endif

                        </div>

                    </div>


                    {{-- ID USER --}}

                    <div class="info-item">

                        <span class="info-label">
                            ID User
                        </span>

                        <div>

                            <span class="id-value">

                                <i class="mdi mdi-identifier me-1"></i>

                                #{{ $user->id }}

                            </span>

                        </div>

                    </div>


                    {{-- TANGGAL DIBUAT --}}

                    <div class="info-item">

                        <span class="info-label">
                            Akun Dibuat
                        </span>

                        <div class="info-value">

                            <i class="mdi mdi-calendar-plus-outline"></i>

                            {{ $user->created_at ? $user->created_at->format('d M Y, H:i') : '-' }}

                        </div>

                    </div>


                </div>


                {{-- =================================================
                     PENGELOLAAN STATUS AKUN
                ================================================== --}}

                <div class="account-actions">

                    <div class="actions-title">

                        Pengelolaan Status Akun

                    </div>

                    <div class="actions-description">

                        Gunakan tindakan berikut untuk mengubah status akses pengguna.

                    </div>


                    <div class="d-flex flex-wrap gap-2">


                        @if($user->is_active)

                        @if(\Illuminate\Support\Facades\Auth::id() != $user->id)

                        <form
                            action="{{ route('admin.users.nonaktif', $user->id) }}"
                            method="POST">

                            @csrf

                            <button
                                type="submit"
                                class="btn btn-outline-danger action-btn"
                                onclick="return confirm('Nonaktifkan akun ini?')">

                                <i class="mdi mdi-account-off-outline me-1"></i>

                                Nonaktifkan Akun

                            </button>

                        </form>

                        @endif

                        @else

                        <form
                            action="{{ route('admin.users.aktif', $user->id) }}"
                            method="POST">

                            @csrf

                            <button
                                type="submit"
                                class="btn btn-outline-success action-btn"
                                onclick="return confirm('Aktifkan akun ini?')">

                                <i class="mdi mdi-account-check-outline me-1"></i>

                                Aktifkan Akun

                            </button>

                        </form>

                        @endif


                        <a
                            href="{{ route('admin.users.edit', $user->id) }}"
                            class="btn btn-light action-btn">

                            <i class="mdi mdi-pencil-outline me-1"></i>

                            Edit Informasi

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection