@extends('layouts.skydash-admin')

@section('title', 'Detail Kelas')

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
        padding: 24px;
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

    .hero-card {
        background: #fafaff;
        border: 1px solid #eeeeee;
        border-radius: 9px;
        padding: 18px;
        margin-bottom: 22px;
    }

    .hero-icon {
        width: 58px;
        height: 58px;
        border-radius: 10px;
        background: rgba(75, 73, 172, .10);
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-right: 15px;
    }

    .hero-icon i {
        font-size: 29px;
    }

    .hero-label {
        font-size: 9px;
        color: #9a9aa5;
        text-transform: uppercase;
        letter-spacing: .5px;
        margin-bottom: 4px;
    }

    .hero-name {
        font-size: 16px;
        font-weight: 600;
        color: #343a40;
        margin: 0 0 7px;
    }

    .jurusan-badge {
        display: inline-flex;
        align-items: center;
        background: #f0effb;
        color: #4b49ac;
        border-radius: 20px;
        padding: 5px 10px;
        font-size: 9px;
        font-weight: 500;
    }

    .info-list {
        border: 1px solid #eeeeee;
        border-radius: 8px;
        overflow: hidden;
    }

    .info-row {
        display: flex;
        align-items: center;
        min-height: 54px;
        padding: 10px 14px;
        border-bottom: 1px solid #eeeeee;
    }

    .info-row:last-child {
        border-bottom: 0;
    }

    .info-label {
        width: 38%;
        flex-shrink: 0;
        font-size: 9px;
        color: #9a9aa5;
    }

    .info-value {
        font-size: 10px;
        color: #343a40;
        font-weight: 500;
    }

    .info-value i {
        color: #4b49ac;
        font-size: 15px;
        margin-right: 6px;
        vertical-align: middle;
    }

    .id-badge {
        display: inline-flex;
        align-items: center;
        background: #f5f5f8;
        color: #555b62;
        border: 1px solid #e6e6eb;
        border-radius: 5px;
        padding: 5px 8px;
        font-size: 9px;
        font-weight: 600;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        border-radius: 20px;
        padding: 5px 10px;
        font-size: 9px;
        font-weight: 500;
    }

    .status-active {
        color: #198754;
        background: #eaf7ef;
    }

    .danger-zone {
        margin-top: 24px;
        padding: 16px;
        border-radius: 8px;
        background: #fff8f8;
        border: 1px solid #f3d6d6;
    }

    .danger-icon {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        background: #fff0f0;
        color: #dc3545;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-right: 11px;
    }

    .danger-icon i {
        font-size: 19px;
    }

    .danger-title {
        font-size: 11px;
        font-weight: 600;
        color: #dc3545;
        margin-bottom: 3px;
    }

    .danger-text {
        font-size: 9px;
        color: #8c8c95;
        margin: 0;
        line-height: 1.5;
    }

    .danger-zone .btn {
        font-size: 9px;
        border-radius: 6px;
        padding: 7px 12px;
        white-space: nowrap;
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
            flex: 1;
        }

        .detail-card-body {
            padding: 18px;
        }

        .hero-card {
            padding: 14px;
        }

        .hero-icon {
            width: 50px;
            height: 50px;
            margin-right: 11px;
        }

        .hero-icon i {
            font-size: 25px;
        }

        .hero-name {
            font-size: 14px;
        }

        .info-label {
            width: 42%;
        }

        .danger-zone-content {
            flex-direction: column;
            align-items: flex-start !important;
        }

        .danger-zone-content .btn-wrapper {
            width: 100%;
            margin-top: 13px;
        }

        .danger-zone-content .btn {
            width: 100%;
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

                                <i class="mdi mdi-google-classroom"></i>

                            </div>

                            <div>

                                <h4 class="page-title">
                                    Detail Kelas
                                </h4>

                                <p class="page-subtitle">
                                    Informasi lengkap kelas yang terdaftar dalam sistem SIMPKL.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="d-flex justify-content-md-end page-header-actions">

                            <a
                                href="{{ route('admin.kelas.index') }}"
                                class="btn btn-light me-2">

                                <i class="mdi mdi-arrow-left me-1"></i>

                                Kembali

                            </a>


                            <a
                                href="{{ route('admin.kelas.edit', $kela->id) }}"
                                class="btn btn-primary">

                                <i class="mdi mdi-pencil-outline me-1"></i>

                                Edit

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     DETAIL KELAS
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card detail-card">

            <div class="detail-card-body">

                {{-- SECTION HEADER --}}

                <div class="section-header">

                    <div class="section-icon">

                        <i class="mdi mdi-google-classroom"></i>

                    </div>

                    <div>

                        <h5 class="section-title">
                            Informasi Kelas
                        </h5>

                        <p class="section-subtitle">
                            Detail data kelas yang tersimpan dalam sistem.
                        </p>

                    </div>

                </div>


                {{-- HERO --}}

                <div class="hero-card">

                    <div class="d-flex align-items-center">

                        <div class="hero-icon">

                            <i class="mdi mdi-google-classroom"></i>

                        </div>

                        <div>

                            <div class="hero-label">
                                Nama Kelas
                            </div>

                            <h4 class="hero-name">
                                {{ $kela->nama_kelas }}
                            </h4>

                            <span class="jurusan-badge">

                                <i class="mdi mdi-school-outline me-1"></i>

                                {{ $kela->jurusan?->nama_jurusan ?? 'Tanpa Jurusan' }}

                            </span>

                        </div>

                    </div>

                </div>


                {{-- DETAIL DATA --}}

                <div class="info-list">

                    {{-- ID --}}

                    <div class="info-row">

                        <div class="info-label">
                            ID Kelas
                        </div>

                        <div class="info-value">

                            <span class="id-badge">

                                #{{ $kela->id }}

                            </span>

                        </div>

                    </div>


                    {{-- NAMA KELAS --}}

                    <div class="info-row">

                        <div class="info-label">
                            Nama Kelas
                        </div>

                        <div class="info-value">

                            <i class="mdi mdi-google-classroom"></i>

                            {{ $kela->nama_kelas }}

                        </div>

                    </div>


                    {{-- JURUSAN --}}

                    <div class="info-row">

                        <div class="info-label">
                            Jurusan
                        </div>

                        <div class="info-value">

                            <i class="mdi mdi-school-outline"></i>

                            {{ $kela->jurusan?->nama_jurusan ?? 'Tanpa Jurusan' }}

                        </div>

                    </div>


                    {{-- CREATED --}}

                    <div class="info-row">

                        <div class="info-label">
                            Tanggal Dibuat
                        </div>

                        <div class="info-value">

                            <i class="mdi mdi-calendar-plus-outline"></i>

                            {{ $kela->created_at?->format('d M Y, H:i') ?? '-' }}

                        </div>

                    </div>


                    {{-- UPDATED --}}

                    <div class="info-row">

                        <div class="info-label">
                            Terakhir Diperbarui
                        </div>

                        <div class="info-value">

                            <i class="mdi mdi-history"></i>

                            {{ $kela->updated_at?->format('d M Y, H:i') ?? '-' }}

                        </div>

                    </div>


                    {{-- STATUS --}}

                    <div class="info-row">

                        <div class="info-label">
                            Status Data
                        </div>

                        <div class="info-value">

                            <span class="status-badge status-active">

                                <i class="mdi mdi-check-circle-outline me-1"></i>

                                Data Aktif

                            </span>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     DANGER ZONE
                ================================================== --}}

                <div class="danger-zone">

                    <div class="danger-zone-content d-flex justify-content-between align-items-center">

                        <div class="d-flex align-items-center">

                            <div class="danger-icon">

                                <i class="mdi mdi-delete-alert-outline"></i>

                            </div>

                            <div>

                                <div class="danger-title">
                                    Hapus Data Kelas
                                </div>

                                <p class="danger-text">

                                    Data kelas akan dihapus dari sistem.
                                    Pastikan data tidak memiliki relasi yang masih digunakan.

                                </p>

                            </div>

                        </div>


                        <div class="btn-wrapper">

                            <form
                                action="{{ route('admin.kelas.destroy', $kela->id) }}"
                                method="POST">

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-outline-danger btn-delete"
                                    data-name="{{ $kela->nama_kelas }}">

                                    <i class="mdi mdi-delete-outline me-1"></i>

                                    Hapus Kelas

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection