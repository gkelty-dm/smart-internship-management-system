@extends('layouts.skydash-admin')

@section('title', 'Riwayat Logbook Siswa')

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

    .student-card {
        border: 0;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .035);
    }

    .student-card-body {
        padding: 18px 20px;
    }

    .student-profile {
        display: flex;
        align-items: center;
    }

    .student-avatar {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background: #f0effb;
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 13px;
        flex-shrink: 0;
        overflow: hidden;
    }

    .student-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .student-avatar i {
        font-size: 26px;
    }

    .student-name {
        font-size: 13px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 2px;
    }

    .student-nisn {
        font-size: 9px;
        color: #9a9aa5;
        margin: 0;
    }

    .student-info {
        border-left: 1px solid #eeeeee;
        padding-left: 20px;
    }

    .student-info-label {
        font-size: 9px;
        color: #9a9aa5;
        margin-bottom: 3px;
    }

    .student-info-value {
        font-size: 11px;
        font-weight: 600;
        color: #343a40;
    }

    .summary-card {
        border: 0;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .035);
    }

    .summary-body {
        padding: 16px 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .summary-label {
        font-size: 9px;
        color: #9a9aa5;
        margin-bottom: 4px;
    }

    .summary-number {
        font-size: 20px;
        font-weight: 600;
        color: #343a40;
        line-height: 1.1;
    }

    .summary-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .summary-icon i {
        font-size: 19px;
    }

    .summary-primary .summary-icon {
        background: #f0effb;
        color: #4b49ac;
    }

    .summary-warning .summary-icon {
        background: #fff8df;
        color: #d99b00;
    }

    .summary-success .summary-icon {
        background: #eaf7ef;
        color: #198754;
    }

    .summary-danger .summary-icon {
        background: #fff0f0;
        color: #dc3545;
    }

    .logbook-card {
        border: 0;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .035);
    }

    .logbook-card-body {
        padding: 0;
    }

    .logbook-header {
        padding: 20px;
        border-bottom: 1px solid #eeeeee;
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
        font-size: 13px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 2px;
    }

    .section-subtitle {
        font-size: 9px;
        color: #9a9aa5;
        margin: 0;
    }

    .total-badge {
        background: #f0effb;
        color: #4b49ac;
        font-size: 9px;
        font-weight: 600;
        padding: 5px 9px;
        border-radius: 20px;
        white-space: nowrap;
    }

    .table-wrapper {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .logbook-table {
        min-width: 1250px;
        margin-bottom: 0;
    }

    .logbook-table thead th {
        background: #f8f9fa;
        border-bottom: 1px solid #eeeeee;
        color: #777782;
        font-size: 9px;
        font-weight: 600;
        padding: 12px 14px;
        white-space: nowrap;
        text-transform: uppercase;
    }

    .logbook-table tbody td {
        font-size: 10px;
        color: #555b62;
        padding: 13px 14px;
        border-bottom: 1px solid #f1f1f3;
        vertical-align: middle;
    }

    .logbook-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .logbook-table tbody tr:hover {
        background: #fafaff;
    }

    .date-value {
        font-weight: 600;
        color: #343a40;
        white-space: nowrap;
    }

    .content-box {
        min-width: 180px;
        max-width: 300px;
        line-height: 1.6;
        color: #626871;
        white-space: normal;
    }

    .content-empty {
        color: #b0b0b8;
    }

    .photo-button {
        border-radius: 6px;
        font-size: 9px;
        padding: 6px 10px;
        white-space: nowrap;
    }

    .no-photo {
        color: #b0b0b8;
        font-size: 9px;
        white-space: nowrap;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        border-radius: 20px;
        padding: 5px 9px;
        font-size: 9px;
        font-weight: 500;
        white-space: nowrap;
    }

    .status-pending {
        color: #856404;
        background: #fff8df;
    }

    .status-approved {
        color: #198754;
        background: #eaf7ef;
    }

    .status-rejected {
        color: #dc3545;
        background: #fff0f0;
    }

    .status-default {
        color: #6c757d;
        background: #f1f2f4;
    }

    .empty-state {
        padding: 55px 20px;
        text-align: center;
    }

    .empty-icon {
        width: 62px;
        height: 62px;
        border-radius: 50%;
        background: #f5f5f7;
        color: #aaaab4;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 11px;
    }

    .empty-icon i {
        font-size: 30px;
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

    .table-footer {
        padding: 16px 20px;
        border-top: 1px solid #eeeeee;
    }

    .pagination-info {
        font-size: 9px;
        color: #9a9aa5;
    }

    .modal-content {
        border: 0;
        border-radius: 10px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, .12);
    }

    .modal-header {
        padding: 15px 18px;
        border-bottom: 1px solid #eeeeee;
    }

    .modal-title {
        font-size: 13px;
        font-weight: 600;
        color: #343a40;
    }

    .modal-body {
        padding: 20px;
    }

    .logbook-photo-card {
        border: 1px solid #eeeeee;
        border-radius: 8px;
        padding: 7px;
        background: #fff;
    }

    .logbook-photo {
        width: 100%;
        height: 280px;
        object-fit: cover;
        border-radius: 6px;
        display: block;
    }

    .photo-caption {
        font-size: 9px;
        color: #9a9aa5;
        text-align: center;
        margin: 8px 0 2px;
    }

    .modal-footer {
        padding: 12px 18px;
        border-top: 1px solid #eeeeee;
    }

    .modal-footer .btn {
        font-size: 10px;
        border-radius: 6px;
        padding: 7px 13px;
    }

    @media (max-width: 767.98px) {

        .page-header-actions {
            width: 100%;
            margin-top: 15px;
        }

        .page-header-actions .btn {
            flex: 1;
        }

        .student-info {
            border-left: 0;
            border-top: 1px solid #eeeeee;
            padding-left: 0;
            padding-top: 13px;
            margin-top: 13px;
        }

        .logbook-header {
            padding: 17px;
        }

        .table-footer {
            padding: 14px 17px;
        }

        .table-footer-content {
            flex-direction: column;
            align-items: flex-start !important;
        }

        .table-footer-content nav {
            width: 100%;
            margin-top: 10px;
            overflow-x: auto;
        }

        .logbook-photo {
            height: 220px;
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

                    <div class="col-md-7">

                        <div class="d-flex align-items-center">

                            <div class="page-header-icon me-3">

                                <i class="mdi mdi-notebook-check-outline"></i>

                            </div>

                            <div>

                                <h4 class="page-title">
                                    Riwayat Logbook Siswa
                                </h4>

                                <p class="page-subtitle">

                                    Riwayat kegiatan PKL
                                    <strong>
                                        {{ $siswa->user->name ?? '-' }}
                                    </strong>

                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-5">

                        <div class="d-flex justify-content-md-end page-header-actions">

                            <a
                                href="{{ route('admin.siswa.show', $siswa->id) }}"
                                class="btn btn-light me-2">

                                <i class="mdi mdi-arrow-left me-1"></i>

                                Detail Siswa

                            </a>


                            <a
                                href="{{ route('admin.siswa.index') }}"
                                class="btn btn-primary">

                                <i class="mdi mdi-account-school-outline me-1"></i>

                                Data Siswa

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     IDENTITAS SISWA
========================================================= --}}

<div class="row">

    <div class="col-md-4 grid-margin">

        <div class="card student-card">

            <div class="student-card-body">

                <div class="student-profile">

                    <div class="student-avatar">

                        @if($siswa->user && $siswa->user->foto_profil)

                        <img
                            src="{{ asset('storage/' . $siswa->user->foto_profil) }}"
                            alt="Foto Profil">

                        @else

                        <i class="mdi mdi-account-school-outline"></i>

                        @endif

                    </div>


                    <div>

                        <div class="student-name">

                            {{ $siswa->user->name ?? '-' }}

                        </div>

                        <p class="student-nisn">

                            NISN:
                            {{ $siswa->nisn ?? '-' }}

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-4 grid-margin">

        <div class="card student-card">

            <div class="student-card-body">

                <div
                    class="student-info"
                    style="border-left:0;padding-left:0;">

                    <div class="student-info-label">
                        Jurusan
                    </div>

                    <div class="student-info-value">

                        <i class="mdi mdi-school-outline text-primary me-1"></i>

                        {{ $siswa->jurusan->nama_jurusan ?? '-' }}

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-4 grid-margin">

        <div class="card student-card">

            <div class="student-card-body">

                <div
                    class="student-info"
                    style="border-left:0;padding-left:0;">

                    <div class="student-info-label">
                        Kelas
                    </div>

                    <div class="student-info-value">

                        <i class="mdi mdi-google-classroom text-primary me-1"></i>

                        {{ $siswa->kelas->nama_kelas ?? '-' }}

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     STATISTIK
========================================================= --}}

@php

$totalLogbook = $logbooks->total();

$pendingCount = $logbooks->getCollection()
->where('status_validasi', 'pending')
->count();

$disetujuiCount = $logbooks->getCollection()
->where('status_validasi', 'disetujui')
->count();

$ditolakCount = $logbooks->getCollection()
->where('status_validasi', 'ditolak')
->count();

@endphp


<div class="row">

    <div class="col-md-3 grid-margin">

        <div class="card summary-card summary-primary">

            <div class="summary-body">

                <div>

                    <div class="summary-label">
                        Total Logbook
                    </div>

                    <div class="summary-number">
                        {{ $totalLogbook }}
                    </div>

                </div>

                <div class="summary-icon">

                    <i class="mdi mdi-notebook-outline"></i>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-3 grid-margin">

        <div class="card summary-card summary-warning">

            <div class="summary-body">

                <div>

                    <div class="summary-label">
                        Pending
                    </div>

                    <div class="summary-number">
                        {{ $pendingCount }}
                    </div>

                </div>

                <div class="summary-icon">

                    <i class="mdi mdi-clock-outline"></i>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-3 grid-margin">

        <div class="card summary-card summary-success">

            <div class="summary-body">

                <div>

                    <div class="summary-label">
                        Disetujui
                    </div>

                    <div class="summary-number">
                        {{ $disetujuiCount }}
                    </div>

                </div>

                <div class="summary-icon">

                    <i class="mdi mdi-check-circle-outline"></i>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-3 grid-margin">

        <div class="card summary-card summary-danger">

            <div class="summary-body">

                <div>

                    <div class="summary-label">
                        Ditolak
                    </div>

                    <div class="summary-number">
                        {{ $ditolakCount }}
                    </div>

                </div>

                <div class="summary-icon">

                    <i class="mdi mdi-close-circle-outline"></i>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     TABLE LOGBOOK
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card logbook-card">

            <div class="logbook-card-body">

                <div class="logbook-header">

                    <div class="d-flex justify-content-between align-items-center">

                        <div class="d-flex align-items-center">

                            <div class="section-icon">

                                <i class="mdi mdi-notebook-check-outline"></i>

                            </div>

                            <div>

                                <h5 class="section-title">
                                    Daftar Kegiatan PKL
                                </h5>

                                <p class="section-subtitle">
                                    Seluruh kegiatan logbook siswa.
                                </p>

                            </div>

                        </div>


                        <span class="total-badge">

                            {{ $logbooks->total() }} Data

                        </span>

                    </div>

                </div>


                <div class="table-wrapper">

                    <table class="table logbook-table">

                        <thead>

                            <tr>

                                <th style="width:55px;">
                                    No
                                </th>

                                <th>
                                    Tanggal
                                </th>

                                <th>
                                    Kegiatan
                                </th>

                                <th>
                                    Kendala
                                </th>

                                <th>
                                    Solusi
                                </th>

                                <th>
                                    Foto
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Catatan Guru
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($logbooks as $logbook)

                            @php

                            $status = strtolower(
                            $logbook->status_validasi ?? ''
                            );

                            @endphp


                            <tr>

                                <td>

                                    {{ $logbooks->firstItem() + $loop->index }}

                                </td>


                                <td>

                                    <span class="date-value">

                                        {{ $logbook->tanggal
                                                ? \Carbon\Carbon::parse($logbook->tanggal)->format('d/m/Y')
                                                : '-' }}

                                    </span>

                                </td>


                                <td>

                                    <div class="content-box">

                                        @if($logbook->kegiatan)

                                        {{ $logbook->kegiatan }}

                                        @else

                                        <span class="content-empty">
                                            -
                                        </span>

                                        @endif

                                    </div>

                                </td>


                                <td>

                                    <div class="content-box">

                                        @if($logbook->kendala)

                                        {{ $logbook->kendala }}

                                        @else

                                        <span class="content-empty">
                                            -
                                        </span>

                                        @endif

                                    </div>

                                </td>


                                <td>

                                    <div class="content-box">

                                        @if($logbook->solusi)

                                        {{ $logbook->solusi }}

                                        @else

                                        <span class="content-empty">
                                            -
                                        </span>

                                        @endif

                                    </div>

                                </td>


                                <td>

                                    @if($logbook->fotos && $logbook->fotos->count())

                                    <button
                                        type="button"
                                        class="btn btn-sm btn-outline-primary photo-button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalFotoLogbook{{ $logbook->id }}">

                                        <i class="mdi mdi-image-multiple-outline me-1"></i>

                                        {{ $logbook->fotos->count() }} Foto

                                    </button>

                                    @else

                                    <span class="no-photo">

                                        <i class="mdi mdi-image-off-outline me-1"></i>

                                        Tidak Ada

                                    </span>

                                    @endif

                                </td>


                                <td>

                                    @if($status === 'pending')

                                    <span class="status-badge status-pending">

                                        <i class="mdi mdi-clock-outline me-1"></i>

                                        Pending

                                    </span>

                                    @elseif($status === 'disetujui')

                                    <span class="status-badge status-approved">

                                        <i class="mdi mdi-check-circle-outline me-1"></i>

                                        Disetujui

                                    </span>

                                    @elseif($status === 'ditolak')

                                    <span class="status-badge status-rejected">

                                        <i class="mdi mdi-close-circle-outline me-1"></i>

                                        Ditolak

                                    </span>

                                    @else

                                    <span class="status-badge status-default">

                                        {{ $logbook->status_validasi ?? '-' }}

                                    </span>

                                    @endif

                                </td>


                                <td>

                                    <div class="content-box">

                                        @if($logbook->catatan_guru)

                                        {{ $logbook->catatan_guru }}

                                        @else

                                        <span class="content-empty">
                                            -
                                        </span>

                                        @endif

                                    </div>

                                </td>

                            </tr>


                            {{-- =================================================
                                     MODAL FOTO LOGBOOK
                                ================================================== --}}

                            @if($logbook->fotos && $logbook->fotos->count())

                            <div
                                class="modal fade"
                                id="modalFotoLogbook{{ $logbook->id }}"
                                tabindex="-1"
                                aria-hidden="true">

                                <div class="modal-dialog modal-dialog-centered modal-lg">

                                    <div class="modal-content">

                                        <div class="modal-header">

                                            <div>

                                                <h5 class="modal-title mb-1">

                                                    <i class="mdi mdi-image-multiple-outline text-primary me-1"></i>

                                                    Foto Kegiatan Logbook

                                                </h5>

                                                <small class="text-muted">

                                                    {{ $logbook->tanggal
                                                                ? \Carbon\Carbon::parse($logbook->tanggal)->format('d/m/Y')
                                                                : '-' }}

                                                </small>

                                            </div>


                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close">
                                            </button>

                                        </div>


                                        <div class="modal-body">

                                            <div class="row">

                                                @foreach($logbook->fotos as $foto)

                                                <div class="col-md-6 mb-4">

                                                    <div class="logbook-photo-card">

                                                        <img
                                                            src="{{ asset('storage/' . $foto->foto) }}"
                                                            alt="Foto Logbook"
                                                            class="logbook-photo">

                                                    </div>


                                                    <p class="photo-caption">

                                                        Foto {{ $loop->iteration }}

                                                    </p>

                                                </div>

                                                @endforeach

                                            </div>

                                        </div>


                                        <div class="modal-footer">

                                            <button
                                                type="button"
                                                class="btn btn-light"
                                                data-bs-dismiss="modal">

                                                Tutup

                                            </button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            @endif

                            @empty

                            <tr>

                                <td
                                    colspan="8"
                                    class="p-0">

                                    <div class="empty-state">

                                        <div class="empty-icon">

                                            <i class="mdi mdi-notebook-remove-outline"></i>

                                        </div>


                                        <div class="empty-title">

                                            Belum Ada Logbook

                                        </div>


                                        <p class="empty-text">

                                            Siswa belum memiliki riwayat kegiatan PKL.

                                        </p>

                                    </div>

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- =================================================
                     PAGINATION
                ================================================== --}}

                @if($logbooks->hasPages())

                <div class="table-footer">

                    <div class="table-footer-content d-flex justify-content-between align-items-center">

                        <small class="pagination-info">

                            Menampilkan

                            <strong>
                                {{ $logbooks->firstItem() }}
                            </strong>

                            sampai

                            <strong>
                                {{ $logbooks->lastItem() }}
                            </strong>

                            dari

                            <strong>
                                {{ $logbooks->total() }}
                            </strong>

                            data

                        </small>


                        <nav>

                            {{ $logbooks->links('pagination::bootstrap-5') }}

                        </nav>

                    </div>

                </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection