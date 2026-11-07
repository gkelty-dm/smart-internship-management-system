@extends('layouts.skydash-admin')

@section('title', 'Manajemen User')

@section('content')

<style>
    .users-page {
        color: #343a40;
    }

    .users-card {
        border: 0;
        border-radius: 12px;
        box-shadow: 0 3px 16px rgba(0, 0, 0, .035);
        background: #fff;
    }

    /* HEADER */

    .users-header {
        padding: 20px 22px;
    }

    .users-header-icon {
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

    .users-header-icon i {
        font-size: 23px;
    }

    .users-title {
        font-size: 18px;
        font-weight: 600;
        margin: 0 0 3px;
        color: #343a40;
    }

    .users-subtitle {
        font-size: 10px;
        color: #9999a4;
        margin: 0;
    }

    .add-user-btn {
        height: 39px;
        border-radius: 7px;
        padding: 8px 15px;
        font-size: 10px;
        font-weight: 500;
    }

    /* ALERT */

    .users-alert {
        border: 0;
        border-radius: 8px;
        font-size: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .025);
    }

    /* STATISTICS */

    .stat-card {
        border: 0;
        border-radius: 11px;
        box-shadow: 0 3px 14px rgba(0, 0, 0, .035);
        background: #fff;
        overflow: hidden;
    }

    .stat-card .card-body {
        padding: 18px 19px;
    }

    .stat-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .stat-label {
        font-size: 9px;
        color: #9999a4;
        margin-bottom: 5px;
    }

    .stat-number {
        font-size: 22px;
        line-height: 1;
        font-weight: 600;
        color: #343a40;
        margin: 0;
    }

    .stat-icon {
        width: 43px;
        height: 43px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .stat-icon i {
        font-size: 21px;
    }

    .stat-purple {
        background: rgba(75, 73, 172, .10);
        color: #4b49ac;
    }

    .stat-red {
        background: rgba(220, 53, 69, .09);
        color: #dc3545;
    }

    .stat-green {
        background: rgba(40, 167, 69, .09);
        color: #28a745;
    }

    .stat-blue {
        background: rgba(23, 162, 184, .09);
        color: #17a2b8;
    }

    /* MAIN CARD */

    .users-main-card {
        border: 0;
        border-radius: 12px;
        box-shadow: 0 3px 16px rgba(0, 0, 0, .035);
    }

    .users-main-card .card-body {
        padding: 22px;
    }

    .section-heading {
        display: flex;
        align-items: center;
    }

    .section-heading-icon {
        width: 37px;
        height: 37px;
        border-radius: 8px;
        background: rgba(75, 73, 172, .09);
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
    }

    .section-heading-icon i {
        font-size: 18px;
    }

    .section-heading-title {
        font-size: 13px;
        font-weight: 600;
        margin: 0 0 2px;
        color: #343a40;
    }

    .section-heading-subtitle {
        font-size: 9px;
        color: #9999a4;
        margin: 0;
    }

    .total-badge {
        background: rgba(75, 73, 172, .09);
        color: #4b49ac;
        padding: 6px 9px;
        border-radius: 5px;
        font-size: 8px;
        font-weight: 600;
    }

    /* FILTER */

    .filter-box {
        background: #fafaff;
        border: 1px solid #eeeeF2;
        border-radius: 9px;
        padding: 15px;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .filter-label {
        display: block;
        font-size: 9px;
        font-weight: 600;
        color: #555;
        margin-bottom: 6px;
    }

    .filter-input,
    .filter-select {
        height: 39px;
        border: 1px solid #e3e3e8;
        border-radius: 7px;
        background: #fff;
        font-size: 9px;
        color: #555;
        box-shadow: none !important;
    }

    .filter-input {
        padding-left: 37px;
    }

    .search-wrapper {
        position: relative;
    }

    .search-wrapper i {
        position: absolute;
        left: 13px;
        top: 12px;
        color: #aaaab4;
        font-size: 15px;
        z-index: 2;
    }

    .filter-input:focus,
    .filter-select:focus {
        border-color: #4b49ac;
    }

    .filter-button {
        height: 39px;
        border-radius: 7px;
        font-size: 9px;
        padding: 8px 14px;
    }

    .reset-button {
        width: 39px;
        height: 39px;
        border-radius: 7px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    /* TABLE */

    .users-table-wrapper {
        border: 1px solid #eeeeF2;
        border-radius: 9px;
        overflow: hidden;
    }

    .users-table {
        margin-bottom: 0;
    }

    .users-table thead th {
        background: #f8f8fb;
        border-top: 0;
        border-bottom: 1px solid #eeeeF2;
        color: #888894;
        font-size: 8px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .25px;
        padding: 12px 11px;
        white-space: nowrap;
    }

    .users-table tbody td {
        border-top: 1px solid #f0f0f3;
        padding: 11px;
        font-size: 9px;
        color: #555;
        vertical-align: middle;
    }

    .users-table tbody tr:hover {
        background: #fafaff;
    }

    .number-cell {
        color: #aaaab3;
        font-size: 8px;
    }

    .user-avatar {
        width: 37px;
        height: 37px;
        border-radius: 50%;
        background: rgba(75, 73, 172, .09);
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .user-avatar i {
        font-size: 18px;
    }

    .user-name {
        font-size: 9px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 2px;
    }

    .user-id {
        font-size: 7px;
        color: #aaaab3;
    }

    .user-email {
        color: #777783;
        font-size: 9px;
    }

    /* ROLE BADGE */

    .role-badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 8px;
        border-radius: 5px;
        font-size: 7px;
        font-weight: 600;
        white-space: nowrap;
    }

    .role-admin {
        background: rgba(220, 53, 69, .09);
        color: #dc3545;
    }

    .role-guru {
        background: rgba(40, 167, 69, .09);
        color: #28a745;
    }

    .role-siswa {
        background: rgba(23, 162, 184, .09);
        color: #138496;
    }

    .role-industri {
        background: rgba(255, 193, 7, .13);
        color: #a77b00;
    }

    .role-default {
        background: #f1f1f4;
        color: #777;
    }

    /* STATUS */

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 8px;
        border-radius: 5px;
        font-size: 7px;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-active {
        background: rgba(40, 167, 69, .09);
        color: #28a745;
    }

    .status-inactive {
        background: rgba(220, 53, 69, .09);
        color: #dc3545;
    }

    /* ACTIONS */

    .action-list {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 4px;
    }

    .action-btn {
        width: 29px;
        height: 29px;
        padding: 0;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        border: 1px solid;
        background: transparent;
    }

    .action-info {
        color: #17a2b8;
        border-color: rgba(23, 162, 184, .25);
    }

    .action-info:hover {
        background: #17a2b8;
        color: #fff;
    }

    .action-primary {
        color: #4b49ac;
        border-color: rgba(75, 73, 172, .25);
    }

    .action-primary:hover {
        background: #4b49ac;
        color: #fff;
    }

    .action-warning {
        color: #b07c00;
        border-color: rgba(255, 193, 7, .35);
    }

    .action-warning:hover {
        background: #ffc107;
        color: #fff;
    }

    .action-success {
        color: #28a745;
        border-color: rgba(40, 167, 69, .25);
    }

    .action-success:hover {
        background: #28a745;
        color: #fff;
    }

    .action-danger {
        color: #dc3545;
        border-color: rgba(220, 53, 69, .25);
    }

    .action-danger:hover {
        background: #dc3545;
        color: #fff;
    }

    /* EMPTY */

    .empty-state {
        padding: 55px 20px !important;
        text-align: center;
    }

    .empty-state-icon {
        width: 58px;
        height: 58px;
        border-radius: 50%;
        background: #f5f5f8;
        color: #b3b3bd;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 12px;
    }

    .empty-state-icon i {
        font-size: 28px;
    }

    .empty-title {
        font-size: 11px;
        font-weight: 600;
        color: #555;
        margin-bottom: 4px;
    }

    .empty-description {
        font-size: 8px;
        color: #9999a4;
        margin: 0;
    }

    /* PAGINATION */

    .pagination-area {
        margin-top: 18px;
    }

    .pagination-area .pagination {
        margin-bottom: 0;
    }

    .pagination-area .page-link {
        font-size: 8px;
        border-radius: 5px !important;
        margin-left: 3px;
        border-color: #eeeeF2;
        color: #777;
    }

    .pagination-area .page-item.active .page-link {
        background: #4b49ac;
        border-color: #4b49ac;
    }

    .pagination-info {
        font-size: 8px;
        color: #9999a4;
    }

    @media (max-width: 767.98px) {

        .users-header {
            padding: 17px;
        }

        .users-header .row {
            gap: 15px;
        }

        .add-user-btn {
            width: 100%;
        }

        .users-main-card .card-body {
            padding: 17px;
        }

        .filter-box {
            padding: 12px;
        }

        .pagination-area {
            display: block !important;
        }

        .pagination-info {
            display: block;
            margin-bottom: 12px;
        }
    }
</style>


<div class="users-page">


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="row">

        <div class="col-12 grid-margin">

            <div class="card users-card">

                <div class="users-header">

                    <div class="row align-items-center">

                        <div class="col-md-8">

                            <div class="d-flex align-items-center">

                                <div class="users-header-icon me-3">

                                    <i class="mdi mdi-account-cog-outline"></i>

                                </div>

                                <div>

                                    <h4 class="users-title">
                                        Manajemen User
                                    </h4>

                                    <p class="users-subtitle">
                                        Kelola akun, hak akses, dan status pengguna SIMPKL.
                                    </p>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 mt-3 mt-md-0">

                            <div class="d-flex justify-content-md-end">

                                <a
                                    href="{{ route('admin.users.create') }}"
                                    class="btn btn-primary add-user-btn">

                                    <i class="mdi mdi-account-plus-outline me-1"></i>

                                    Tambah User

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         ALERT
    ====================================================== --}}

    @if(session('success'))

    <div class="row">

        <div class="col-12">

            <div
                class="alert alert-success alert-dismissible fade show users-alert"
                role="alert">

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


    @if(session('error'))

    <div class="row">

        <div class="col-12">

            <div
                class="alert alert-danger alert-dismissible fade show users-alert"
                role="alert">

                <i class="mdi mdi-alert-circle-outline me-2"></i>

                {{ session('error') }}

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


    {{-- =====================================================
         STATISTIK
    ====================================================== --}}

    <div class="row">


        {{-- TOTAL --}}

        <div class="col-lg-3 col-md-6 grid-margin stretch-card">

            <div class="card stat-card w-100">

                <div class="card-body">

                    <div class="stat-content">

                        <div>

                            <div class="stat-label">
                                Total User
                            </div>

                            <h3 class="stat-number">
                                {{ $totalUsers }}
                            </h3>

                        </div>

                        <div class="stat-icon stat-purple">

                            <i class="mdi mdi-account-group-outline"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- ADMIN --}}

        <div class="col-lg-3 col-md-6 grid-margin stretch-card">

            <div class="card stat-card w-100">

                <div class="card-body">

                    <div class="stat-content">

                        <div>

                            <div class="stat-label">
                                Administrator
                            </div>

                            <h3 class="stat-number">
                                {{ $totalAdmins }}
                            </h3>

                        </div>

                        <div class="stat-icon stat-red">

                            <i class="mdi mdi-shield-account-outline"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- GURU --}}

        <div class="col-lg-3 col-md-6 grid-margin stretch-card">

            <div class="card stat-card w-100">

                <div class="card-body">

                    <div class="stat-content">

                        <div>

                            <div class="stat-label">
                                Guru Pembimbing
                            </div>

                            <h3 class="stat-number">
                                {{ $totalGurus }}
                            </h3>

                        </div>

                        <div class="stat-icon stat-green">

                            <i class="mdi mdi-teach"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- SISWA --}}

        <div class="col-lg-3 col-md-6 grid-margin stretch-card">

            <div class="card stat-card w-100">

                <div class="card-body">

                    <div class="stat-content">

                        <div>

                            <div class="stat-label">
                                Siswa
                            </div>

                            <h3 class="stat-number">
                                {{ $totalSiswas }}
                            </h3>

                        </div>

                        <div class="stat-icon stat-blue">

                            <i class="mdi mdi-account-school-outline"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         DATA USER
    ====================================================== --}}

    <div class="row">

        <div class="col-12 grid-margin">

            <div class="card users-main-card">

                <div class="card-body">


                    {{-- SECTION HEADER --}}

                    <div class="d-flex justify-content-between align-items-center">

                        <div class="section-heading">

                            <div class="section-heading-icon">

                                <i class="mdi mdi-format-list-bulleted"></i>

                            </div>

                            <div>

                                <h5 class="section-heading-title">
                                    Daftar Pengguna
                                </h5>

                                <p class="section-heading-subtitle">
                                    Cari dan kelola seluruh akun pengguna sistem.
                                </p>

                            </div>

                        </div>


                        <span class="total-badge">

                            {{ $users->total() }} User

                        </span>

                    </div>


                    {{-- =================================================
                         FILTER
                    ================================================== --}}

                    <div class="filter-box">

                        <form
                            method="GET"
                            action="{{ route('admin.users.index') }}">

                            <div class="row align-items-end">


                                {{-- SEARCH --}}

                                <div class="col-lg-5 col-md-6">

                                    <div class="form-group mb-3 mb-lg-0">

                                        <label
                                            for="search"
                                            class="filter-label">

                                            Cari Pengguna

                                        </label>

                                        <div class="search-wrapper">

                                            <i class="mdi mdi-magnify"></i>

                                            <input
                                                type="text"
                                                name="search"
                                                id="search"
                                                class="form-control filter-input"
                                                value="{{ request('search') }}"
                                                placeholder="Nama atau email...">

                                        </div>

                                    </div>

                                </div>


                                {{-- ROLE --}}

                                <div class="col-lg-4 col-md-6">

                                    <div class="form-group mb-3 mb-lg-0">

                                        <label
                                            for="role"
                                            class="filter-label">

                                            Role Pengguna

                                        </label>

                                        <select
                                            name="role"
                                            id="role"
                                            class="form-control filter-select">

                                            <option value="">
                                                Semua Role
                                            </option>

                                            <option
                                                value="admin"
                                                {{ request('role') == 'admin' ? 'selected' : '' }}>

                                                Admin

                                            </option>

                                            <option
                                                value="guru"
                                                {{ request('role') == 'guru' ? 'selected' : '' }}>

                                                Guru Pembimbing

                                            </option>

                                            <option
                                                value="siswa"
                                                {{ request('role') == 'siswa' ? 'selected' : '' }}>

                                                Siswa

                                            </option>

                                            <option
                                                value="industri"
                                                {{ request('role') == 'industri' ? 'selected' : '' }}>

                                                Industri Pembimbing

                                            </option>

                                        </select>

                                    </div>

                                </div>


                                {{-- BUTTON --}}

                                <div class="col-lg-3 col-md-12">

                                    <div class="d-flex gap-2">

                                        <button
                                            type="submit"
                                            class="btn btn-primary filter-button flex-grow-1">

                                            <i class="mdi mdi-filter-outline me-1"></i>

                                            Terapkan Filter

                                        </button>

                                        <a
                                            href="{{ route('admin.users.index') }}"
                                            class="btn btn-light reset-button"
                                            title="Reset Filter">

                                            <i class="mdi mdi-refresh"></i>

                                        </a>

                                    </div>

                                </div>

                            </div>

                        </form>

                    </div>


                    {{-- =================================================
                         TABLE
                    ================================================== --}}

                    <div class="users-table-wrapper">

                        <div class="table-responsive">

                            <table class="table users-table">

                                <thead>

                                    <tr>

                                        <th width="5%">
                                            No
                                        </th>

                                        <th>
                                            Pengguna
                                        </th>

                                        <th>
                                            Email
                                        </th>

                                        <th>
                                            Role
                                        </th>

                                        <th>
                                            Status
                                        </th>

                                        <th
                                            width="22%"
                                            class="text-center">

                                            Aksi

                                        </th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @forelse($users as $user)

                                    <tr>


                                        {{-- NO --}}

                                        <td>

                                            <span class="number-cell">

                                                {{
                                                        $users->firstItem()
                                                        + $loop->index
                                                    }}

                                            </span>

                                        </td>


                                        {{-- USER --}}

                                        <td>

                                            <div class="d-flex align-items-center">

                                                <div class="user-avatar me-3">

                                                    <i class="mdi mdi-account-outline"></i>

                                                </div>

                                                <div>

                                                    <div class="user-name">

                                                        {{ $user->name }}

                                                    </div>

                                                    <div class="user-id">

                                                        ID #{{ $user->id }}

                                                    </div>

                                                </div>

                                            </div>

                                        </td>


                                        {{-- EMAIL --}}

                                        <td>

                                            <span class="user-email">

                                                {{ $user->email }}

                                            </span>

                                        </td>


                                        {{-- ROLE --}}

                                        <td>

                                            @if($user->role === 'admin')

                                            <span class="role-badge role-admin">

                                                <i class="mdi mdi-shield-account-outline me-1"></i>

                                                Admin

                                            </span>

                                            @elseif($user->role === 'guru')

                                            <span class="role-badge role-guru">

                                                <i class="mdi mdi-teach me-1"></i>

                                                Guru

                                            </span>

                                            @elseif($user->role === 'siswa')

                                            <span class="role-badge role-siswa">

                                                <i class="mdi mdi-account-school-outline me-1"></i>

                                                Siswa

                                            </span>

                                            @elseif($user->role === 'industri')

                                            <span class="role-badge role-industri">

                                                <i class="mdi mdi-domain me-1"></i>

                                                Industri

                                            </span>

                                            @else

                                            <span class="role-badge role-default">

                                                {{ ucfirst($user->role) }}

                                            </span>

                                            @endif

                                        </td>


                                        {{-- STATUS --}}

                                        <td>

                                            @if($user->is_active)

                                            <span class="status-badge status-active">

                                                <i class="mdi mdi-check-circle-outline me-1"></i>

                                                Aktif

                                            </span>

                                            @else

                                            <span class="status-badge status-inactive">

                                                <i class="mdi mdi-close-circle-outline me-1"></i>

                                                Nonaktif

                                            </span>

                                            @endif

                                        </td>


                                        {{-- ACTION --}}

                                        <td>

                                            <div class="action-list">


                                                {{-- DETAIL --}}

                                                <a
                                                    href="{{ route('admin.users.show', $user->id) }}"
                                                    class="action-btn action-info"
                                                    title="Detail">

                                                    <i class="mdi mdi-eye-outline"></i>

                                                </a>


                                                {{-- EDIT --}}

                                                <a
                                                    href="{{ route('admin.users.edit', $user->id) }}"
                                                    class="action-btn action-primary"
                                                    title="Edit">

                                                    <i class="mdi mdi-pencil-outline"></i>

                                                </a>


                                                {{-- RESET PASSWORD --}}

                                                <form
                                                    action="{{ route('admin.users.reset-password', $user->id) }}"
                                                    method="POST">

                                                    @csrf

                                                    <button
                                                        type="submit"
                                                        class="action-btn action-warning"
                                                        title="Reset Password"
                                                        onclick="return confirm('Reset password menjadi 12345678?')">

                                                        <i class="mdi mdi-lock-reset"></i>

                                                    </button>

                                                </form>


                                                {{-- AKTIF / NONAKTIF --}}

                                                @if($user->is_active)

                                                <form
                                                    action="{{ route('admin.users.nonaktif', $user->id) }}"
                                                    method="POST">

                                                    @csrf

                                                    <button
                                                        type="submit"
                                                        class="action-btn action-danger"
                                                        title="Nonaktifkan"
                                                        onclick="return confirm('Nonaktifkan akun ini?')">

                                                        <i class="mdi mdi-account-off-outline"></i>

                                                    </button>

                                                </form>

                                                @else

                                                <form
                                                    action="{{ route('admin.users.aktif', $user->id) }}"
                                                    method="POST">

                                                    @csrf

                                                    <button
                                                        type="submit"
                                                        class="action-btn action-success"
                                                        title="Aktifkan"
                                                        onclick="return confirm('Aktifkan akun ini?')">

                                                        <i class="mdi mdi-account-check-outline"></i>

                                                    </button>

                                                </form>

                                                @endif


                                                {{-- HAPUS --}}

                                                @if(\Illuminate\Support\Facades\Auth::id() != $user->id)

                                                <form
                                                    action="{{ route('admin.users.destroy', $user->id) }}"
                                                    method="POST">

                                                    @csrf

                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="action-btn action-danger"
                                                        title="Hapus"
                                                        onclick="return confirm('Yakin ingin menghapus user ini?')">

                                                        <i class="mdi mdi-delete-outline"></i>

                                                    </button>

                                                </form>

                                                @endif

                                            </div>

                                        </td>

                                    </tr>

                                    @empty

                                    <tr>

                                        <td
                                            colspan="6"
                                            class="empty-state">

                                            <div class="empty-state-icon">

                                                <i class="mdi mdi-account-search-outline"></i>

                                            </div>

                                            <div class="empty-title">

                                                User tidak ditemukan

                                            </div>

                                            <p class="empty-description">

                                                Tidak ada pengguna yang sesuai
                                                dengan pencarian atau filter.

                                            </p>

                                        </td>

                                    </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>


                    {{-- =================================================
                         PAGINATION
                    ================================================== --}}

                    @if($users->hasPages())

                    <div class="pagination-area d-flex justify-content-between align-items-center">

                        <span class="pagination-info">

                            Menampilkan

                            <strong>
                                {{ $users->firstItem() }}
                            </strong>

                            sampai

                            <strong>
                                {{ $users->lastItem() }}
                            </strong>

                            dari

                            <strong>
                                {{ $users->total() }}
                            </strong>

                            user

                        </span>


                        {{ $users->links('pagination::bootstrap-5') }}

                    </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection