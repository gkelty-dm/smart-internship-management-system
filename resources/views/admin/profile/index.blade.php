@extends('layouts.skydash-admin')

@section('title', 'Profil Saya')

@section('content')

<style>
    .profile-shell {
        background: #fff;
        border-radius: 14px;
        overflow: hidden;
        border: 1px solid #eeeeF2;
        box-shadow: 0 4px 18px rgba(0, 0, 0, .035);
    }

    .profile-cover {
        height: 145px;
        background: linear-gradient(135deg, #4b49ac 0%, #6866c7 55%, #817fd8 100%);
        position: relative;
        overflow: hidden;
    }

    .profile-cover::before {
        content: "";
        position: absolute;
        width: 260px;
        height: 260px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .07);
        right: -70px;
        top: -150px;
    }

    .profile-cover::after {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .05);
        left: 28%;
        top: 65px;
    }

    .profile-main {
        padding: 0 28px 28px;
        position: relative;
    }

    .profile-identity {
        display: flex;
        align-items: flex-end;
        gap: 18px;
        margin-top: -52px;
        position: relative;
        z-index: 2;
    }

    .profile-avatar-wrap {
        width: 104px;
        height: 104px;
        padding: 4px;
        background: #fff;
        border-radius: 50%;
        box-shadow: 0 4px 16px rgba(0, 0, 0, .12);
        flex-shrink: 0;
    }

    .profile-avatar {
        width: 96px;
        height: 96px;
        border-radius: 50%;
        object-fit: cover;
        display: block;
    }

    .profile-avatar-empty {
        width: 96px;
        height: 96px;
        border-radius: 50%;
        background: #f1f1f6;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #aaaab5;
    }

    .profile-avatar-empty i {
        font-size: 48px;
    }

    .identity-info {
        padding-bottom: 8px;
    }

    .identity-name {
        font-size: 21px;
        font-weight: 600;
        color: #fff;
        margin-bottom: 3px;
        text-shadow: 0 1px 2px rgba(0, 0, 0, .08);
    }

    .identity-email {
        font-size: 10px;
        color: rgba(255, 255, 255, .82);
    }

    .identity-role {
        position: absolute;
        right: 0;
        bottom: 8px;
        background: #fff;
        color: #4b49ac;
        border-radius: 6px;
        padding: 7px 11px;
        font-size: 9px;
        font-weight: 600;
        box-shadow: 0 3px 10px rgba(0, 0, 0, .08);
    }

    .profile-body {
        margin-top: 25px;
        border-top: 1px solid #eeeeF2;
        padding-top: 25px;
    }

    .profile-section-title {
        font-size: 13px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 4px;
    }

    .profile-section-subtitle {
        font-size: 9px;
        color: #9a9aa5;
        margin-bottom: 20px;
    }

    .profile-form-box {
        background: #fafaff;
        border: 1px solid #eeeeF2;
        border-radius: 10px;
        padding: 20px;
    }

    .field-group {
        margin-bottom: 18px;
    }

    .field-group:last-child {
        margin-bottom: 0;
    }

    .field-label {
        display: block;
        font-size: 9px;
        font-weight: 600;
        color: #555;
        margin-bottom: 7px;
    }

    .field-wrap {
        position: relative;
    }

    .field-icon {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        color: #aaaab3;
        font-size: 16px;
        z-index: 2;
    }

    .profile-input {
        height: 42px;
        border: 1px solid #e2e2e8;
        border-radius: 7px;
        padding-left: 38px;
        font-size: 10px;
        color: #343a40;
        background: #fff;
        box-shadow: none !important;
    }

    .profile-input:focus {
        border-color: #4b49ac;
        background: #fff;
    }

    .account-panel {
        height: 100%;
        border-left: 1px solid #eeeeF2;
        padding-left: 25px;
    }

    .account-title {
        font-size: 12px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 17px;
    }

    .account-item {
        display: flex;
        align-items: center;
        padding: 11px 0;
        border-bottom: 1px solid #f0f0f3;
    }

    .account-item:last-child {
        border-bottom: 0;
    }

    .account-icon {
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

    .account-icon i {
        font-size: 16px;
    }

    .account-label {
        font-size: 8px;
        color: #9a9aa5;
        margin-bottom: 2px;
    }

    .account-value {
        font-size: 9px;
        font-weight: 600;
        color: #555;
    }

    .active-badge {
        display: inline-flex;
        align-items: center;
        background: rgba(40, 167, 69, .10);
        color: #28a745;
        padding: 4px 7px;
        border-radius: 5px;
        font-size: 8px;
        font-weight: 600;
    }

    .profile-footer {
        margin-top: 22px;
        padding-top: 18px;
        border-top: 1px solid #eeeeF2;
        display: flex;
        justify-content: flex-end;
    }

    .save-profile-btn {
        height: 40px;
        padding: 8px 17px;
        border-radius: 7px;
        font-size: 10px;
        font-weight: 500;
    }

    .security-note {
        margin-top: 18px;
        padding: 11px 13px;
        border-radius: 7px;
        background: #f8f8fb;
        border: 1px solid #eeeeF2;
        display: flex;
        align-items: center;
    }

    .security-note i {
        color: #4b49ac;
        font-size: 16px;
        margin-right: 8px;
    }

    .security-note span {
        font-size: 8px;
        color: #9999a4;
        line-height: 1.5;
    }

    .alert-profile {
        border: 0;
        border-radius: 8px;
        font-size: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .025);
    }

    .alert-profile ul {
        font-size: 9px;
    }

    @media (max-width: 991.98px) {

        .account-panel {
            border-left: 0;
            border-top: 1px solid #eeeeF2;
            padding-left: 0;
            padding-top: 22px;
            margin-top: 22px;
        }
    }

    @media (max-width: 767.98px) {

        .profile-cover {
            height: 125px;
        }

        .profile-main {
            padding: 0 17px 20px;
        }

        .profile-identity {
            display: block;
            text-align: center;
            margin-top: -48px;
        }

        .profile-avatar-wrap {
            margin: 0 auto;
        }

        .identity-info {
            padding-top: 10px;
        }

        .identity-name {
            color: #343a40;
            text-shadow: none;
        }

        .identity-email {
            color: #9a9aa5;
        }

        .identity-role {
            position: static;
            display: inline-flex;
            margin-top: 9px;
        }

        .profile-body {
            margin-top: 20px;
        }

        .profile-form-box {
            padding: 15px;
        }

        .profile-footer {
            justify-content: stretch;
        }

        .save-profile-btn {
            width: 100%;
        }
    }
</style>


{{-- =========================================================
     ALERT
========================================================= --}}

@if(session('success'))

<div class="row">

    <div class="col-12 grid-margin">

        <div class="alert alert-success alert-dismissible fade show alert-profile">

            <i class="mdi mdi-check-circle-outline me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="close"
                data-dismiss="alert">

                <span>&times;</span>

            </button>

        </div>

    </div>

</div>

@endif


@if($errors->any())

<div class="row">

    <div class="col-12 grid-margin">

        <div class="alert alert-danger alert-profile">

            <div class="font-weight-bold mb-2">
                <i class="mdi mdi-alert-circle-outline me-1"></i>
                Terjadi kesalahan
            </div>

            <ul class="mb-0 pl-3">

                @foreach($errors->all() as $error)

                <li>
                    {{ $error }}
                </li>

                @endforeach

            </ul>

        </div>

    </div>

</div>

@endif


{{-- =========================================================
     PROFILE
========================================================= --}}

<div class="row">

    <div class="col-12">

        <div class="profile-shell">

            {{-- COVER --}}

            <div class="profile-cover"></div>


            <div class="profile-main">


                {{-- IDENTITY --}}

                <div class="profile-identity">

                    <div class="profile-avatar-wrap">

                        @if(!empty($user->foto_profil))

                        <img
                            src="{{ asset('storage/' . $user->foto_profil) }}"
                            alt="Foto Profil"
                            class="profile-avatar">

                        @else

                        <div class="profile-avatar-empty">

                            <i class="mdi mdi-account-outline"></i>

                        </div>

                        @endif

                    </div>


                    <div class="identity-info">

                        <div class="identity-name">

                            {{ $user->name ?? '-' }}

                        </div>

                        <div class="identity-email">

                            {{ $user->email ?? '-' }}

                        </div>

                    </div>


                    <div class="identity-role">

                        <i class="mdi mdi-shield-account-outline mr-1"></i>

                        {{ $user->role->nama_role ?? 'Administrator' }}

                    </div>

                </div>


                {{-- BODY --}}

                <div class="profile-body">

                    <div class="row">


                        {{-- FORM PROFIL --}}

                        <div class="col-lg-8">

                            <div class="profile-section-title">

                                Informasi Akun

                            </div>

                            <div class="profile-section-subtitle">

                                Perbarui informasi dasar akun administrator yang sedang digunakan.

                            </div>


                            <form
                                action="{{ route('admin.profile.update') }}"
                                method="POST">

                                @csrf

                                @method('PUT')


                                <div class="profile-form-box">

                                    {{-- NAMA --}}

                                    <div class="field-group">

                                        <label
                                            for="name"
                                            class="field-label">

                                            Nama Lengkap

                                        </label>

                                        <div class="field-wrap">

                                            <i class="mdi mdi-account-outline field-icon"></i>

                                            <input
                                                type="text"
                                                name="name"
                                                id="name"
                                                class="form-control profile-input"
                                                value="{{ old('name', $user->name) }}"
                                                placeholder="Masukkan nama lengkap"
                                                required>

                                        </div>

                                    </div>


                                    {{-- EMAIL --}}

                                    <div class="field-group">

                                        <label
                                            for="email"
                                            class="field-label">

                                            Alamat Email

                                        </label>

                                        <div class="field-wrap">

                                            <i class="mdi mdi-email-outline field-icon"></i>

                                            <input
                                                type="email"
                                                name="email"
                                                id="email"
                                                class="form-control profile-input"
                                                value="{{ old('email', $user->email) }}"
                                                placeholder="Masukkan alamat email"
                                                required>

                                        </div>

                                    </div>


                                    <div class="security-note">

                                        <i class="mdi mdi-information-outline"></i>

                                        <span>
                                            Password akun dikelola melalui menu
                                            <strong>Manajemen User</strong>.
                                        </span>

                                    </div>


                                    <div class="profile-footer">

                                        <button
                                            type="submit"
                                            class="btn btn-primary save-profile-btn">

                                            <i class="mdi mdi-content-save-outline mr-1"></i>

                                            Simpan Perubahan

                                        </button>

                                    </div>

                                </div>

                            </form>

                        </div>


                        {{-- INFORMASI AKUN --}}

                        <div class="col-lg-4">

                            <div class="account-panel">

                                <div class="account-title">

                                    Informasi Akun

                                </div>


                                {{-- STATUS --}}

                                <div class="account-item">

                                    <div class="account-icon">

                                        <i class="mdi mdi-check-circle-outline"></i>

                                    </div>

                                    <div>

                                        <div class="account-label">
                                            Status Akun
                                        </div>

                                        <div class="account-value">

                                            @if($user->is_active)

                                            <span class="active-badge">

                                                <i class="mdi mdi-check mr-1"></i>

                                                Aktif

                                            </span>

                                            @else

                                            <span
                                                class="active-badge"
                                                style="background:rgba(220,53,69,.10);color:#dc3545;">

                                                <i class="mdi mdi-close mr-1"></i>

                                                Tidak Aktif

                                            </span>

                                            @endif

                                        </div>

                                    </div>

                                </div>


                                {{-- ROLE --}}

                                <div class="account-item">

                                    <div class="account-icon">

                                        <i class="mdi mdi-shield-account-outline"></i>

                                    </div>

                                    <div>

                                        <div class="account-label">
                                            Hak Akses
                                        </div>

                                        <div class="account-value">

                                            {{ $user->role->nama_role ?? 'Administrator' }}

                                        </div>

                                    </div>

                                </div>


                                {{-- BERGABUNG --}}

                                <div class="account-item">

                                    <div class="account-icon">

                                        <i class="mdi mdi-calendar-outline"></i>

                                    </div>

                                    <div>

                                        <div class="account-label">
                                            Bergabung
                                        </div>

                                        <div class="account-value">

                                            {{ $user->created_at?->format('d M Y') ?? '-' }}

                                        </div>

                                    </div>

                                </div>


                                {{-- EMAIL --}}

                                <div class="account-item">

                                    <div class="account-icon">

                                        <i class="mdi mdi-email-outline"></i>

                                    </div>

                                    <div style="min-width:0;">

                                        <div class="account-label">
                                            Email
                                        </div>

                                        <div
                                            class="account-value"
                                            style="word-break:break-word;">

                                            {{ $user->email ?? '-' }}

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

@endsection