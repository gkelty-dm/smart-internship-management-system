@extends('layouts.skydash-admin')

@section('title', 'Data Guru Pembimbing')

@section('content')

<style>
    /* =========================================================
       IMPORT MODAL
    ========================================================= */

    .import-modal .modal-content {
        border: 0;
        border-radius: 16px;
        overflow: hidden;
    }

    .import-modal .modal-header {
        padding: 20px 24px;
        border-bottom: 1px solid #eeeeee;
        background: #ffffff;
    }

    .import-modal .modal-body {
        padding: 24px;
    }

    .import-modal .modal-footer {
        padding: 16px 24px;
        border-top: 1px solid #eeeeee;
        background: #fafafa;
    }

    .import-icon-wrapper {
        width: 72px;
        height: 72px;
        border-radius: 16px;
        background: rgba(40, 167, 69, 0.10);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
    }

    .import-icon-wrapper i {
        font-size: 38px;
    }

    .import-upload-box {
        border: 2px dashed #d9d9e3;
        border-radius: 14px;
        padding: 25px 20px;
        text-align: center;
        background: #fafaff;
        transition: all .2s ease;
    }

    .import-upload-box:hover {
        border-color: #4b49ac;
        background: #f8f8ff;
    }

    .import-upload-icon {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 12px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, .06);
    }

    .import-upload-icon i {
        font-size: 25px;
        color: #4b49ac;
    }

    .import-upload-box .form-control {
        max-width: 100%;
        margin-top: 15px;
        height: 45px;
        background: #ffffff;
    }

    .import-info-card {
        border-radius: 12px;
        border: 1px solid #e8e8f0;
        background: #ffffff;
        padding: 15px;
    }

    .import-info-title {
        font-size: 14px;
        font-weight: 600;
        color: #343a40;
    }

    .import-info-text {
        font-size: 12px;
        color: #6c757d;
        line-height: 1.6;
    }

    .import-template-table {
        margin-bottom: 0;
        font-size: 11px;
        white-space: nowrap;
    }

    .import-template-table th {
        background: #f8f9fa;
        font-weight: 600;
        color: #495057;
    }

    .import-template-table td,
    .import-template-table th {
        padding: 8px 10px;
    }

    /* =========================================================
       MOBILE TEMPLATE
    ========================================================= */

    .import-mobile-template {
        display: none;
    }

    .import-mobile-field {
        border: 1px solid #eeeeee;
        border-radius: 10px;
        padding: 10px 12px;
        background: #fafafa;
    }

    .import-mobile-field+.import-mobile-field {
        margin-top: 8px;
    }

    .import-mobile-label {
        display: block;
        font-size: 11px;
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 3px;
    }

    .import-mobile-value {
        display: block;
        font-size: 12px;
        font-weight: 500;
        color: #343a40;
        word-break: break-word;
    }

    .import-note {
        border-radius: 10px;
        padding: 12px 14px;
        font-size: 12px;
        line-height: 1.6;
    }

    .import-note i {
        font-size: 18px;
        flex-shrink: 0;
    }

    .import-modal .btn {
        border-radius: 8px;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 767.98px) {

        .import-modal .modal-dialog {
            margin: 10px;
        }

        .import-modal .modal-header {
            padding: 16px;
        }

        .import-modal .modal-body {
            padding: 16px;
        }

        .import-modal .modal-footer {
            padding: 14px 16px;
            display: flex;
            flex-direction: column-reverse;
            gap: 8px;
        }

        .import-modal .modal-footer .btn {
            width: 100%;
            margin: 0 !important;
        }

        .import-icon-wrapper {
            width: 62px;
            height: 62px;
        }

        .import-icon-wrapper i {
            font-size: 32px;
        }

        .import-upload-box {
            padding: 20px 15px;
        }

        .import-modal .modal-title {
            font-size: 15px;
        }

        .import-modal .modal-header small {
            font-size: 11px;
        }

        .import-desktop-template {
            display: none;
        }

        .import-mobile-template {
            display: block;
        }

        .import-info-card {
            padding: 13px;
        }
    }
</style>


<div class="row">

    {{-- =========================================================
         1. HEADER
    ========================================================= --}}
    <div class="col-md-12 grid-margin">

        <div class="row align-items-center">

            <div class="col-12 col-xl-8 mb-3 mb-xl-0">

                <h3 class="font-weight-bold mb-1">
                    Master Data Guru Pembimbing
                </h3>

                <h6 class="font-weight-normal text-muted mb-0">
                    Kelola data guru pembimbing PKL, akun, dan status
                    keaktifan pada sistem
                    <span class="text-primary font-weight-bold">
                        SIMPKL
                    </span>
                </h6>

            </div>


            <div class="col-12 col-xl-4">

                <div class="justify-content-start justify-content-xl-end d-flex gap-2">

                    {{-- IMPORT --}}
                    <button
                        type="button"
                        class="btn btn-sm btn-outline-success btn-icon-text shadow-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#modalImportGuru">

                        <i class="mdi mdi-file-excel btn-icon-prepend"></i>

                        Import Excel

                    </button>


                    {{-- TAMBAH --}}
                    <a
                        href="{{ route('admin.guru-pembimbing.create') }}"
                        class="btn btn-sm btn-primary btn-icon-text shadow-sm">

                        <i class="mdi mdi-plus btn-icon-prepend"></i>

                        Tambah Guru

                    </a>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         2. STATISTIC CARDS
    ========================================================= --}}
    <div class="col-12 grid-margin">

        <div class="row">

            {{-- TOTAL GURU --}}
            <div class="col-md-4 stretch-card grid-margin grid-margin-md-0 mb-3 mb-md-0">

                <div
                    class="card text-white shadow-sm"
                    style="background: linear-gradient(135deg, #79a0f8 0%, #4b49ac 100%); border-radius: 12px; border: none;">

                    <div class="card-body p-4 d-flex justify-content-between align-items-center">

                        <div>

                            <p class="mb-1 font-weight-medium" style="opacity: .9;">
                                Total Guru
                            </p>

                            <h2 class="mb-0 font-weight-bold">

                                {{ method_exists($gurus, 'total') ? $gurus->total() : count($gurus) }}

                            </h2>

                            <small style="opacity: .8;">
                                Terdaftar dalam sistem
                            </small>

                        </div>


                        <div class="p-3 bg-white bg-opacity-10 rounded-circle">

                            <i
                                class="mdi mdi-account-tie text-white"
                                style="font-size: 28px;">
                            </i>

                        </div>

                    </div>

                </div>

            </div>


            {{-- GURU AKTIF --}}
            <div class="col-md-4 stretch-card grid-margin grid-margin-md-0 mb-3 mb-md-0">

                <div
                    class="card text-white shadow-sm"
                    style="background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%); border-radius: 12px; border: none;">

                    <div class="card-body p-4 d-flex justify-content-between align-items-center">

                        <div>

                            <p class="mb-1 font-weight-medium" style="opacity: .9;">
                                Guru Aktif
                            </p>

                            <h2 class="mb-0 font-weight-bold">

                                {{ \App\Models\Guru::whereHas('user', fn($q) => $q->where('is_active', true))->count() }}

                            </h2>

                            <small style="opacity: .8;">
                                Dapat membimbing PKL
                            </small>

                        </div>


                        <div class="p-3 bg-white bg-opacity-10 rounded-circle">

                            <i
                                class="mdi mdi-account-check-outline text-white"
                                style="font-size: 28px;">
                            </i>

                        </div>

                    </div>

                </div>

            </div>


            {{-- GURU NONAKTIF --}}
            <div class="col-md-4 stretch-card grid-margin grid-margin-md-0">

                <div
                    class="card text-white shadow-sm"
                    style="background: linear-gradient(135deg, #f1536e 0%, #d8304c 100%); border-radius: 12px; border: none;">

                    <div class="card-body p-4 d-flex justify-content-between align-items-center">

                        <div>

                            <p class="mb-1 font-weight-medium" style="opacity: .9;">
                                Guru Nonaktif
                            </p>

                            <h2 class="mb-0 font-weight-bold">

                                {{ \App\Models\Guru::whereHas('user', fn($q) => $q->where('is_active', false))->count() }}

                            </h2>

                            <small style="opacity: .8;">
                                Akun dinonaktifkan
                            </small>

                        </div>


                        <div class="p-3 bg-white bg-opacity-10 rounded-circle">

                            <i
                                class="mdi mdi-account-off-outline text-white"
                                style="font-size: 28px;">
                            </i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         3. ALERT SUCCESS
    ========================================================= --}}
    @if(session('success'))

    <div class="col-12">

        <div
            class="alert alert-success alert-dismissible fade show border-0 shadow-sm"
            role="alert">

            <strong>

                <i class="mdi mdi-check-circle me-1"></i>

                Berhasil:

            </strong>

            {{ session('success') }}


            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close">
            </button>

        </div>

    </div>

    @endif


    {{-- =========================================================
         4. ALERT ERROR
    ========================================================= --}}
    @if(session('error'))

    <div class="col-12">

        <div
            class="alert alert-danger alert-dismissible fade show border-0 shadow-sm"
            role="alert">

            <strong>

                <i class="mdi mdi-alert-circle me-1"></i>

                Gagal:

            </strong>

            {{ session('error') }}


            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close">
            </button>

        </div>

    </div>

    @endif


    {{-- =========================================================
         5. SEARCH & FILTER
    ========================================================= --}}
    <div class="col-12 grid-margin stretch-card">

        <div
            class="card shadow-sm border-0"
            style="border-radius: 12px;">

            <div class="card-body p-4">

                <div
                    class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-3">

                    <div class="d-flex align-items-center">

                        <div
                            class="bg-primary text-white p-2 rounded-3 me-3 d-flex align-items-center justify-content-center"
                            style="width: 38px; height: 38px;">

                            <i
                                class="mdi mdi-filter-variant"
                                style="font-size: 20px;">
                            </i>

                        </div>


                        <div>

                            <h5 class="card-title font-weight-bold mb-0 text-dark">

                                Pencarian & Filter Data

                            </h5>

                            <p class="text-muted small mb-0">

                                Saring data guru berdasarkan NIP, nama,
                                email, atau status keaktifan

                            </p>

                        </div>

                    </div>


                    @if(request()->hasAny(['search', 'status']))

                    <span
                        class="badge bg-soft-primary text-primary border border-primary px-3 py-2 rounded-pill font-weight-medium">

                        <i class="mdi mdi-filter-check me-1"></i>

                        Filter Aktif

                    </span>

                    @endif

                </div>


                <form
                    method="GET"
                    action="{{ route('admin.guru-pembimbing.index') }}">

                    <div class="row g-3 align-items-end">

                        {{-- SEARCH --}}
                        <div class="col-md-6">

                            <label
                                for="search"
                                class="form-label font-weight-bold text-dark small mb-1">

                                Kata Kunci

                            </label>


                            <div class="input-group input-group-sm">

                                <span
                                    class="input-group-text bg-light border-end-0 text-muted">

                                    <i class="mdi mdi-magnify"></i>

                                </span>


                                <input
                                    type="text"
                                    name="search"
                                    id="search"
                                    class="form-control form-control-sm border-start-0 ps-0"
                                    value="{{ request('search') }}"
                                    placeholder="Cari NIP, Nama, atau Email..."
                                    autocomplete="off">

                            </div>

                        </div>


                        {{-- STATUS --}}
                        <div class="col-md-4">

                            <label
                                for="status"
                                class="form-label font-weight-bold text-dark small mb-1">

                                Status Akun

                            </label>


                            <div class="input-group input-group-sm">

                                <span
                                    class="input-group-text bg-light border-end-0 text-muted">

                                    <i class="mdi mdi-account-clock-outline"></i>

                                </span>


                                <select
                                    name="status"
                                    id="status"
                                    class="form-select form-select-sm border-start-0 ps-0">

                                    <option value="">
                                        Semua Status
                                    </option>

                                    <option
                                        value="active"
                                        {{ request('status') === 'active' ? 'selected' : '' }}>

                                        Aktif

                                    </option>

                                    <option
                                        value="inactive"
                                        {{ request('status') === 'inactive' ? 'selected' : '' }}>

                                        Nonaktif

                                    </option>

                                </select>

                            </div>

                        </div>


                        {{-- BUTTON --}}
                        <div class="col-md-2">

                            <div class="d-flex gap-2">

                                <button
                                    type="submit"
                                    class="btn btn-sm btn-primary w-100 font-weight-medium d-flex align-items-center justify-content-center gap-1 shadow-sm">

                                    <i class="mdi mdi-filter"></i>

                                    Terapkan

                                </button>


                                @if(request()->hasAny(['search', 'status']))

                                <a
                                    href="{{ route('admin.guru-pembimbing.index') }}"
                                    class="btn btn-sm btn-outline-secondary d-flex align-items-center justify-content-center px-3"
                                    title="Reset Filter">

                                    <i class="mdi mdi-refresh"></i>

                                </a>

                                @endif

                            </div>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- =========================================================
         6. DATA TABLE
    ========================================================= --}}
    <div class="col-md-12 grid-margin stretch-card">

        <div
            class="card shadow-sm border-0"
            style="border-radius: 12px;">

            <div class="card-body">

                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3">

                    <div>

                        <p class="card-title mb-0">
                            Daftar Guru Pembimbing
                        </p>

                        <p class="text-muted font-weight-normal mb-0">

                            Seluruh data guru pembimbing yang terdaftar
                            pada sistem

                        </p>

                    </div>


                    <div class="mt-2 mt-md-0">

                        <span
                            class="badge bg-primary text-white font-weight-medium px-3 py-2 rounded-pill">

                            <i class="mdi mdi-account-tie me-1"></i>

                            Total:

                            {{ method_exists($gurus, 'total') ? $gurus->total() : count($gurus) }}

                            Guru

                        </span>

                    </div>

                </div>


                {{-- TABLE --}}
                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="bg-light">

                            <tr>

                                <th style="width: 50px;">
                                    No
                                </th>

                                <th>
                                    Guru Pembimbing
                                </th>

                                <th>
                                    NIP
                                </th>

                                <th>
                                    Email
                                </th>

                                <th>
                                    No. HP
                                </th>

                                <th>
                                    Status
                                </th>

                                <th
                                    class="text-center"
                                    style="width: 140px;">

                                    Aksi

                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($gurus as $guru)

                            <tr>

                                {{-- NO --}}
                                <td class="font-weight-bold text-muted">

                                    {{ method_exists($gurus, 'firstItem') ? $gurus->firstItem() + $loop->index : $loop->iteration }}

                                </td>


                                {{-- GURU --}}
                                <td>

                                    <div class="d-flex align-items-center">

                                        <div
                                            class="rounded-circle text-white me-3 d-flex align-items-center justify-content-center shadow-sm font-weight-bold"
                                            style="
                                                width: 42px;
                                                height: 42px;
                                                font-size: 15px;
                                                background: linear-gradient(135deg, #4b49ac, #7da0fa);
                                            ">

                                            {{ strtoupper(substr($guru->user->name ?? 'G', 0, 1)) }}

                                        </div>


                                        <div>

                                            <h6 class="font-weight-bold mb-0 text-dark">

                                                {{ $guru->user->name ?? '-' }}

                                            </h6>

                                            <small class="text-muted d-block">

                                                Guru Pembimbing PKL

                                            </small>

                                        </div>

                                    </div>

                                </td>


                                {{-- NIP --}}
                                <td>

                                    <span
                                        class="badge bg-light text-dark border px-2 py-1 font-weight-semibold">

                                        {{ $guru->nip ?? '-' }}

                                    </span>

                                </td>


                                {{-- EMAIL --}}
                                <td>

                                    <span class="text-muted">

                                        {{ $guru->user->email ?? '-' }}

                                    </span>

                                </td>


                                {{-- NO HP --}}
                                <td>

                                    <span class="text-muted">

                                        {{ $guru->no_hp ?? '-' }}

                                    </span>

                                </td>


                                {{-- STATUS --}}
                                <td>

                                    @if($guru->user?->is_active ?? true)

                                    <span
                                        class="badge bg-success-subtle text-success border border-success px-3 py-2 rounded-pill font-weight-medium">

                                        <i class="mdi mdi-check-circle me-1"></i>

                                        Aktif

                                    </span>

                                    @else

                                    <span
                                        class="badge bg-danger-subtle text-danger border border-danger px-3 py-2 rounded-pill font-weight-medium">

                                        <i class="mdi mdi-close-circle me-1"></i>

                                        Nonaktif

                                    </span>

                                    @endif

                                </td>


                                {{-- AKSI --}}
                                <td class="text-center">

                                    <div
                                        class="d-flex justify-content-center align-items-center gap-1">

                                        {{-- DETAIL --}}
                                        <a
                                            href="{{ route('admin.guru-pembimbing.show', $guru->id) }}"
                                            class="btn btn-sm btn-outline-info btn-icon d-flex align-items-center justify-content-center rounded-circle"
                                            title="Detail"
                                            style="width: 32px; height: 32px; padding: 0;">

                                            <i
                                                class="mdi mdi-eye-outline"
                                                style="font-size: 16px;">
                                            </i>

                                        </a>


                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route('admin.guru-pembimbing.edit', $guru->id) }}"
                                            class="btn btn-sm btn-outline-primary btn-icon d-flex align-items-center justify-content-center rounded-circle"
                                            title="Edit"
                                            style="width: 32px; height: 32px; padding: 0;">

                                            <i
                                                class="mdi mdi-pencil-outline"
                                                style="font-size: 16px;">
                                            </i>

                                        </a>


                                        {{-- DELETE --}}
                                        <form
                                            action="{{ route('admin.guru-pembimbing.destroy', $guru->id) }}"
                                            method="POST"
                                            class="d-inline">

                                            @csrf

                                            @method('DELETE')


                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-outline-danger btn-icon d-flex align-items-center justify-content-center rounded-circle btn-delete"
                                                title="Hapus"
                                                data-name="{{ $guru->user->name ?? 'guru ini' }}"
                                                style="width: 32px; height: 32px; padding: 0;">

                                                <i
                                                    class="mdi mdi-delete-outline"
                                                    style="font-size: 16px;">
                                                </i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>


                            @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="text-center py-5">

                                    <div class="mb-3">

                                        <i
                                            class="mdi mdi-account-search-outline text-muted"
                                            style="font-size: 48px;">
                                        </i>

                                    </div>


                                    <h6 class="font-weight-bold text-dark">

                                        Data guru tidak ditemukan

                                    </h6>


                                    <p class="text-muted small mb-2">

                                        Belum ada data guru pembimbing
                                        yang sesuai dengan filter atau
                                        kriteria pencarian.

                                    </p>


                                    @if(request()->hasAny(['search', 'status']))

                                    <a
                                        href="{{ route('admin.guru-pembimbing.index') }}"
                                        class="btn btn-sm btn-light">

                                        <i class="mdi mdi-refresh me-1"></i>

                                        Reset Filter

                                    </a>

                                    @else

                                    <a
                                        href="{{ route('admin.guru-pembimbing.create') }}"
                                        class="btn btn-sm btn-primary">

                                        <i class="mdi mdi-plus me-1"></i>

                                        Tambah Guru

                                    </a>

                                    @endif

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- PAGINATION --}}
                @if(method_exists($gurus, 'links'))

                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 pt-3 border-top gap-2">

                    <small class="text-muted">

                        Menampilkan

                        <strong>
                            {{ $gurus->firstItem() ?? 0 }}
                        </strong>

                        sampai

                        <strong>
                            {{ $gurus->lastItem() ?? 0 }}
                        </strong>

                        dari

                        <strong>
                            {{ $gurus->total() ?? 0 }}
                        </strong>

                        data

                    </small>


                    <div>

                        {{ $gurus->appends(request()->query())->links('pagination::bootstrap-5') }}

                    </div>

                </div>

                @endif

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     7. MODAL IMPORT EXCEL
========================================================= --}}
<div
    class="modal fade import-modal"
    id="modalImportGuru"
    tabindex="-1"
    aria-labelledby="modalImportGuruLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content shadow-lg">

            {{-- HEADER --}}
            <div class="modal-header">

                <div class="d-flex align-items-center">

                    <div
                        class="d-flex align-items-center justify-content-center rounded-circle bg-light me-3"
                        style="width: 42px; height: 42px;">

                        <i
                            class="mdi mdi-file-excel-outline text-success"
                            style="font-size: 22px;">
                        </i>

                    </div>


                    <div>

                        <h5
                            class="modal-title font-weight-bold mb-0"
                            id="modalImportGuruLabel">

                            Import Data Guru Pembimbing

                        </h5>

                        <small class="text-muted">

                            Tambahkan banyak guru melalui file Excel

                        </small>

                    </div>

                </div>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>


            {{-- FORM --}}
            <form
                action="{{ route('admin.guru-pembimbing.import') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf


                <div class="modal-body">

                    {{-- ICON & DESCRIPTION --}}
                    <div class="text-center mb-4">

                        <div class="import-icon-wrapper">

                            <i class="mdi mdi-file-excel-outline text-success"></i>

                        </div>


                        <h5 class="font-weight-bold mb-1">

                            Import Data Guru

                        </h5>


                        <p class="text-muted small mb-0">

                            Upload file Excel untuk menambahkan
                            data guru pembimbing secara sekaligus.

                        </p>

                    </div>


                    {{-- UPLOAD --}}
                    <div class="import-upload-box mb-4">

                        <div class="import-upload-icon">

                            <i class="mdi mdi-cloud-upload-outline"></i>

                        </div>


                        <h6 class="font-weight-bold mb-1">

                            Pilih File Excel

                        </h6>


                        <p class="text-muted small mb-2">

                            Format yang didukung:
                            <strong>.xlsx</strong> dan
                            <strong>.xls</strong>

                        </p>


                        <input
                            type="file"
                            name="file"
                            id="file"
                            class="form-control @error('file') is-invalid @enderror"
                            accept=".xlsx,.xls"
                            required>


                        @error('file')

                        <div class="invalid-feedback text-start">

                            {{ $message }}

                        </div>

                        @enderror

                    </div>


                    {{-- FORMAT TEMPLATE --}}
                    <div class="import-info-card mb-3">

                        <div class="d-flex align-items-start">

                            <div
                                class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                                style="width: 36px; height: 36px;">

                                <i
                                    class="mdi mdi-file-document-outline"
                                    style="font-size: 18px;">
                                </i>

                            </div>


                            <div class="w-100">

                                <div class="import-info-title mb-1">

                                    Format Template Excel

                                </div>


                                <div class="import-info-text mb-3">

                                    Pastikan nama kolom pada baris pertama
                                    sesuai dengan format import guru.

                                </div>


                                {{-- DESKTOP TABLE --}}
                                <div class="import-desktop-template">

                                    <div class="table-responsive">

                                        <table
                                            class="table table-bordered import-template-table">

                                            <thead>

                                                <tr>

                                                    <th>
                                                        NIP
                                                    </th>

                                                    <th>
                                                        Nama
                                                    </th>

                                                    <th>
                                                        Email
                                                    </th>

                                                    <th>
                                                        No HP
                                                    </th>

                                                </tr>

                                            </thead>


                                            <tbody>

                                                <tr>

                                                    <td>
                                                        198001012005011001
                                                    </td>

                                                    <td>
                                                        Budi Santoso
                                                    </td>

                                                    <td>
                                                        budi@email.com
                                                    </td>

                                                    <td>
                                                        081234567890
                                                    </td>

                                                </tr>

                                            </tbody>

                                        </table>

                                    </div>

                                </div>


                                {{-- MOBILE CARD --}}
                                <div class="import-mobile-template">

                                    <div class="import-mobile-field">

                                        <span class="import-mobile-label">
                                            NIP
                                        </span>

                                        <span class="import-mobile-value">
                                            198001012005011001
                                        </span>

                                    </div>


                                    <div class="import-mobile-field">

                                        <span class="import-mobile-label">
                                            Nama
                                        </span>

                                        <span class="import-mobile-value">
                                            Budi Santoso
                                        </span>

                                    </div>


                                    <div class="import-mobile-field">

                                        <span class="import-mobile-label">
                                            Email
                                        </span>

                                        <span class="import-mobile-value">
                                            budi@email.com
                                        </span>

                                    </div>


                                    <div class="import-mobile-field">

                                        <span class="import-mobile-label">
                                            No HP
                                        </span>

                                        <span class="import-mobile-value">
                                            081234567890
                                        </span>

                                    </div>

                                </div>


                                <small class="text-muted d-block mt-2">

                                    Satu baris digunakan untuk satu guru
                                    pembimbing.

                                </small>

                            </div>

                        </div>

                    </div>


                    {{-- INFORMASI --}}
                    <div
                        class="import-note bg-info-subtle text-info-emphasis mb-3">

                        <div class="d-flex align-items-start">

                            <i class="mdi mdi-information-outline me-2"></i>

                            <div>

                                <strong>
                                    Perhatikan format file
                                </strong>

                                <div>

                                    Pastikan nama kolom dan struktur data
                                    sesuai dengan template sebelum melakukan
                                    import.

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- STATUS --}}
                    <div
                        class="import-note bg-light border">

                        <div class="d-flex align-items-start">

                            <i
                                class="mdi mdi-account-check-outline text-primary me-2">
                            </i>

                            <div>

                                <strong>
                                    Status akun
                                </strong>

                                <div class="text-muted">

                                    Data guru yang berhasil diimport akan
                                    diproses sebagai data guru pembimbing
                                    pada sistem.

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- FOOTER --}}
                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-light px-4"
                        data-bs-dismiss="modal">

                        <i class="mdi mdi-close me-1"></i>

                        Batal

                    </button>


                    <button
                        type="submit"
                        class="btn btn-success px-4">

                        <i class="mdi mdi-file-upload-outline me-1"></i>

                        Import Data

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection