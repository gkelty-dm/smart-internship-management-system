@extends('layouts.skydash-admin')

@section('title', 'Riwayat Absensi Siswa')

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

    .summary-success .summary-icon {
        background: #eaf7ef;
        color: #198754;
    }

    .summary-warning .summary-icon {
        background: #fff8df;
        color: #d99b00;
    }

    .summary-danger .summary-icon {
        background: #fff0f0;
        color: #dc3545;
    }

    .attendance-card {
        border: 0;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .035);
    }

    .attendance-card-body {
        padding: 0;
    }

    .attendance-header {
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

    .attendance-table {
        min-width: 1050px;
        margin-bottom: 0;
    }

    .attendance-table thead th {
        background: #f8f9fa;
        border-bottom: 1px solid #eeeeee;
        color: #777782;
        font-size: 9px;
        font-weight: 600;
        padding: 12px 14px;
        white-space: nowrap;
        text-transform: uppercase;
    }

    .attendance-table tbody td {
        font-size: 10px;
        color: #555b62;
        padding: 12px 14px;
        border-bottom: 1px solid #f1f1f3;
        vertical-align: middle;
        white-space: nowrap;
    }

    .attendance-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .attendance-table tbody tr:hover {
        background: #fafaff;
    }

    .date-value {
        font-weight: 600;
        color: #343a40;
    }

    .time-badge {
        display: inline-flex;
        align-items: center;
        border-radius: 20px;
        padding: 5px 9px;
        font-size: 9px;
        font-weight: 500;
    }

    .time-in {
        background: #eaf7ef;
        color: #198754;
    }

    .time-out {
        background: #eaf8fc;
        color: #0891b2;
    }

    .photo-button {
        border-radius: 6px;
        font-size: 9px;
        padding: 6px 9px;
    }

    .no-photo {
        color: #b0b0b8;
        font-size: 9px;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        border-radius: 20px;
        padding: 5px 9px;
        font-size: 9px;
        font-weight: 500;
    }

    .status-hadir {
        color: #198754;
        background: #eaf7ef;
    }

    .status-izin {
        color: #856404;
        background: #fff8df;
    }

    .status-sakit {
        color: #087990;
        background: #eaf8fc;
    }

    .status-alpha {
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

    .attendance-photo {
        max-height: 550px;
        max-width: 100%;
        width: auto;
        border-radius: 8px;
        object-fit: contain;
    }

    .photo-info {
        margin-top: 15px;
        padding: 12px;
        border-radius: 8px;
        background: #fafaff;
        border: 1px solid #eeeeee;
    }

    .photo-student {
        font-size: 11px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 3px;
    }

    .photo-detail {
        font-size: 9px;
        color: #9a9aa5;
        margin: 0;
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

        .page-header {
            align-items: flex-start !important;
        }

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

        .attendance-header {
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
            margin-top: 10px;
            width: 100%;
            overflow-x: auto;
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

                                <i class="mdi mdi-calendar-check-outline"></i>

                            </div>

                            <div>

                                <h4 class="page-title">
                                    Riwayat Absensi Siswa
                                </h4>

                                <p class="page-subtitle">

                                    Riwayat kehadiran
                                    <strong>{{ $siswa->user->name ?? '-' }}</strong>

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

                <div class="student-info" style="border-left:0;padding-left:0;">

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

                <div class="student-info" style="border-left:0;padding-left:0;">

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
     RINGKASAN
========================================================= --}}

@php

$totalData = $absensis->total();

$jumlahHadir = $absensis->getCollection()
->filter(function ($item) {
return strtolower($item->status ?? '') === 'hadir';
})
->count();

$jumlahIzin = $absensis->getCollection()
->filter(function ($item) {
return strtolower($item->status ?? '') === 'izin';
})
->count();

$jumlahSakit = $absensis->getCollection()
->filter(function ($item) {
return strtolower($item->status ?? '') === 'sakit';
})
->count();

$jumlahAlpha = $absensis->getCollection()
->filter(function ($item) {
return in_array(
strtolower($item->status ?? ''),
['alpha', 'alpa']
);
})
->count();

@endphp


<div class="row">

    <div class="col-md-3 grid-margin">

        <div class="card summary-card summary-primary">

            <div class="summary-body">

                <div>

                    <div class="summary-label">
                        Total Absensi
                    </div>

                    <div class="summary-number">
                        {{ $totalData }}
                    </div>

                </div>

                <div class="summary-icon">

                    <i class="mdi mdi-calendar-multiple-check"></i>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-3 grid-margin">

        <div class="card summary-card summary-success">

            <div class="summary-body">

                <div>

                    <div class="summary-label">
                        Hadir
                    </div>

                    <div class="summary-number">
                        {{ $jumlahHadir }}
                    </div>

                </div>

                <div class="summary-icon">

                    <i class="mdi mdi-check-circle-outline"></i>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-3 grid-margin">

        <div class="card summary-card summary-warning">

            <div class="summary-body">

                <div>

                    <div class="summary-label">
                        Izin / Sakit
                    </div>

                    <div class="summary-number">

                        {{ $jumlahIzin + $jumlahSakit }}

                    </div>

                </div>

                <div class="summary-icon">

                    <i class="mdi mdi-information-outline"></i>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-3 grid-margin">

        <div class="card summary-card summary-danger">

            <div class="summary-body">

                <div>

                    <div class="summary-label">
                        Alpha
                    </div>

                    <div class="summary-number">
                        {{ $jumlahAlpha }}
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
     TABLE
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card attendance-card">

            <div class="attendance-card-body">

                <div class="attendance-header">

                    <div class="d-flex justify-content-between align-items-center">

                        <div class="d-flex align-items-center">

                            <div class="section-icon">

                                <i class="mdi mdi-calendar-check-outline"></i>

                            </div>

                            <div>

                                <h5 class="section-title">
                                    Riwayat Kehadiran
                                </h5>

                                <p class="section-subtitle">
                                    Seluruh data absensi siswa.
                                </p>

                            </div>

                        </div>


                        <span class="total-badge">

                            {{ $absensis->total() }} Data

                        </span>

                    </div>

                </div>


                <div class="table-wrapper">

                    <table class="table attendance-table">

                        <thead>

                            <tr>

                                <th style="width:55px;">
                                    No
                                </th>

                                <th>
                                    Tanggal
                                </th>

                                <th>
                                    Jam Masuk
                                </th>

                                <th class="text-center">
                                    Foto Masuk
                                </th>

                                <th>
                                    Jam Pulang
                                </th>

                                <th class="text-center">
                                    Foto Pulang
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Keterangan
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($absensis as $absensi)

                            @php

                            $status = strtolower(
                            $absensi->status ?? ''
                            );

                            @endphp


                            <tr>

                                <td>

                                    {{ $absensis->firstItem() + $loop->index }}

                                </td>


                                <td>

                                    <span class="date-value">

                                        {{ $absensi->tanggal
                                                ? \Carbon\Carbon::parse($absensi->tanggal)->format('d/m/Y')
                                                : '-' }}

                                    </span>

                                </td>


                                <td>

                                    @if($absensi->jam_masuk)

                                    <span class="time-badge time-in">

                                        <i class="mdi mdi-login me-1"></i>

                                        {{ $absensi->jam_masuk }}

                                    </span>

                                    @else

                                    <span class="text-muted">
                                        -
                                    </span>

                                    @endif

                                </td>


                                <td class="text-center">

                                    @if($absensi->foto_masuk)

                                    <button
                                        type="button"
                                        class="btn btn-sm btn-outline-primary photo-button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalFotoMasuk{{ $absensi->id }}">

                                        <i class="mdi mdi-camera-outline me-1"></i>

                                        Lihat Foto

                                    </button>

                                    @else

                                    <span class="no-photo">

                                        <i class="mdi mdi-camera-off-outline me-1"></i>

                                        Tidak Ada

                                    </span>

                                    @endif

                                </td>


                                <td>

                                    @if($absensi->jam_pulang)

                                    <span class="time-badge time-out">

                                        <i class="mdi mdi-logout me-1"></i>

                                        {{ $absensi->jam_pulang }}

                                    </span>

                                    @else

                                    <span class="text-muted">
                                        -
                                    </span>

                                    @endif

                                </td>


                                <td class="text-center">

                                    @if($absensi->foto_pulang)

                                    <button
                                        type="button"
                                        class="btn btn-sm btn-outline-info photo-button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalFotoPulang{{ $absensi->id }}">

                                        <i class="mdi mdi-camera-outline me-1"></i>

                                        Lihat Foto

                                    </button>

                                    @else

                                    <span class="no-photo">

                                        <i class="mdi mdi-camera-off-outline me-1"></i>

                                        Tidak Ada

                                    </span>

                                    @endif

                                </td>


                                <td>

                                    @if($status === 'hadir')

                                    <span class="status-badge status-hadir">

                                        <i class="mdi mdi-check-circle-outline me-1"></i>

                                        Hadir

                                    </span>

                                    @elseif($status === 'izin')

                                    <span class="status-badge status-izin">

                                        <i class="mdi mdi-alert-circle-outline me-1"></i>

                                        Izin

                                    </span>

                                    @elseif($status === 'sakit')

                                    <span class="status-badge status-sakit">

                                        <i class="mdi mdi-medical-bag me-1"></i>

                                        Sakit

                                    </span>

                                    @elseif(in_array($status, ['alpha', 'alpa']))

                                    <span class="status-badge status-alpha">

                                        <i class="mdi mdi-close-circle-outline me-1"></i>

                                        Alpha

                                    </span>

                                    @else

                                    <span class="status-badge status-default">

                                        {{ $absensi->status ?? '-' }}

                                    </span>

                                    @endif

                                </td>


                                <td>

                                    {{ $absensi->keterangan ?? '-' }}

                                </td>

                            </tr>


                            {{-- =================================================
                                     MODAL FOTO MASUK
                                ================================================== --}}

                            @if($absensi->foto_masuk)

                            <div
                                class="modal fade"
                                id="modalFotoMasuk{{ $absensi->id }}"
                                tabindex="-1"
                                aria-hidden="true">

                                <div class="modal-dialog modal-dialog-centered modal-lg">

                                    <div class="modal-content">

                                        <div class="modal-header">

                                            <h5 class="modal-title">

                                                <i class="mdi mdi-camera-outline text-primary me-1"></i>

                                                Foto Absensi Masuk

                                            </h5>


                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close">
                                            </button>

                                        </div>


                                        <div class="modal-body text-center">

                                            <img
                                                src="{{ asset('storage/' . $absensi->foto_masuk) }}"
                                                alt="Foto Absensi Masuk"
                                                class="attendance-photo">


                                            <div class="photo-info">

                                                <div class="photo-student">

                                                    {{ $siswa->user->name ?? '-' }}

                                                </div>


                                                <p class="photo-detail">

                                                    {{ $absensi->tanggal
                                                                ? \Carbon\Carbon::parse($absensi->tanggal)->format('d/m/Y')
                                                                : '-' }}

                                                    &nbsp; • &nbsp;

                                                    {{ $absensi->jam_masuk ?? '-' }}

                                                </p>

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


                            {{-- =================================================
                                     MODAL FOTO PULANG
                                ================================================== --}}

                            @if($absensi->foto_pulang)

                            <div
                                class="modal fade"
                                id="modalFotoPulang{{ $absensi->id }}"
                                tabindex="-1"
                                aria-hidden="true">

                                <div class="modal-dialog modal-dialog-centered modal-lg">

                                    <div class="modal-content">

                                        <div class="modal-header">

                                            <h5 class="modal-title">

                                                <i class="mdi mdi-camera-outline text-info me-1"></i>

                                                Foto Absensi Pulang

                                            </h5>


                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close">
                                            </button>

                                        </div>


                                        <div class="modal-body text-center">

                                            <img
                                                src="{{ asset('storage/' . $absensi->foto_pulang) }}"
                                                alt="Foto Absensi Pulang"
                                                class="attendance-photo">


                                            <div class="photo-info">

                                                <div class="photo-student">

                                                    {{ $siswa->user->name ?? '-' }}

                                                </div>


                                                <p class="photo-detail">

                                                    {{ $absensi->tanggal
                                                                ? \Carbon\Carbon::parse($absensi->tanggal)->format('d/m/Y')
                                                                : '-' }}

                                                    &nbsp; • &nbsp;

                                                    {{ $absensi->jam_pulang ?? '-' }}

                                                </p>

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

                                            <i class="mdi mdi-calendar-remove-outline"></i>

                                        </div>


                                        <div class="empty-title">

                                            Belum Ada Riwayat Absensi

                                        </div>


                                        <p class="empty-text">

                                            Belum terdapat data kehadiran untuk siswa ini.

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

                @if($absensis->hasPages())

                <div class="table-footer">

                    <div class="table-footer-content d-flex justify-content-between align-items-center">

                        <small class="pagination-info">

                            Menampilkan

                            <strong>
                                {{ $absensis->firstItem() }}
                            </strong>

                            sampai

                            <strong>
                                {{ $absensis->lastItem() }}
                            </strong>

                            dari

                            <strong>
                                {{ $absensis->total() }}
                            </strong>

                            data

                        </small>


                        <nav>

                            {{ $absensis->links('pagination::bootstrap-5') }}

                        </nav>

                    </div>

                </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection