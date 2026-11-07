@extends('layouts.skydash-admin')

@section('title', 'Detail Absensi')

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
        border-radius: 7px;
        padding: 8px 14px;
    }

    .content-card {
        border: 0;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .035);
    }

    .content-card .card-body {
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

    .student-card {
        border: 1px solid #eeeeee;
        border-radius: 9px;
        padding: 20px;
        height: 100%;
    }

    .student-avatar {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: rgba(75, 73, 172, .08);
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 13px;
    }

    .student-avatar i {
        font-size: 38px;
    }

    .student-name {
        font-size: 14px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 3px;
    }

    .student-email {
        font-size: 9px;
        color: #9a9aa5;
    }

    .info-item {
        padding: 11px 0;
        border-bottom: 1px solid #eeeeee;
        text-align: left;
    }

    .info-item:last-child {
        border-bottom: 0;
        padding-bottom: 0;
    }

    .info-label {
        display: block;
        font-size: 9px;
        color: #9a9aa5;
        margin-bottom: 4px;
    }

    .info-value {
        display: block;
        font-size: 11px;
        font-weight: 600;
        color: #343a40;
        line-height: 1.5;
    }

    .time-card {
        border: 1px solid #eeeeee;
        border-radius: 9px;
        padding: 18px;
        height: 100%;
    }

    .time-icon {
        width: 36px;
        height: 36px;
        border-radius: 7px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
    }

    .time-icon i {
        font-size: 18px;
    }

    .time-in {
        background: rgba(40, 167, 69, .10);
        color: #28a745;
    }

    .time-out {
        background: rgba(23, 162, 184, .10);
        color: #138496;
    }

    .time-label {
        font-size: 9px;
        color: #9a9aa5;
        margin-bottom: 4px;
    }

    .time-value {
        font-size: 22px;
        font-weight: 600;
        color: #343a40;
        margin: 0;
    }

    .meta-card {
        border: 1px solid #eeeeee;
        border-radius: 9px;
        padding: 14px 16px;
        height: 100%;
    }

    .meta-label {
        font-size: 9px;
        color: #9a9aa5;
        display: block;
        margin-bottom: 7px;
    }

    .status-badge,
    .method-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 9px;
        border-radius: 5px;
        font-size: 8px;
        font-weight: 600;
    }

    .status-hadir {
        background: rgba(40, 167, 69, .10);
        color: #28a745;
    }

    .status-izin {
        background: rgba(255, 193, 7, .13);
        color: #b38600;
    }

    .status-sakit {
        background: rgba(220, 53, 69, .10);
        color: #dc3545;
    }

    .status-alpha {
        background: rgba(108, 117, 125, .10);
        color: #6c757d;
    }

    .status-default {
        background: #f1f1f4;
        color: #777;
    }

    .method-badge {
        background: rgba(75, 73, 172, .10);
        color: #4b49ac;
    }

    .photo-card {
        border: 1px solid #eeeeee;
        border-radius: 9px;
        padding: 12px;
        background: #fff;
        height: 100%;
    }

    .photo-title {
        font-size: 11px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 10px;
    }

    .photo-container {
        width: 100%;
        height: 300px;
        background: #f8f8fb;
        border-radius: 7px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .photo-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .photo-empty {
        text-align: center;
    }

    .photo-empty i {
        font-size: 40px;
        color: #c8c8d0;
    }

    .photo-empty p {
        font-size: 9px;
        color: #9a9aa5;
        margin: 7px 0 0;
    }

    .location-card {
        border: 1px solid #eeeeee;
        border-radius: 9px;
        padding: 17px;
        height: 100%;
    }

    .location-title {
        display: flex;
        align-items: center;
        font-size: 12px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 15px;
    }

    .location-title-icon {
        width: 32px;
        height: 32px;
        border-radius: 7px;
        background: rgba(75, 73, 172, .10);
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 9px;
    }

    .location-title-icon i {
        font-size: 16px;
    }

    .coordinate {
        background: #f8f8fb;
        border-radius: 6px;
        padding: 9px 11px;
        margin-bottom: 8px;
    }

    .coordinate-label {
        font-size: 8px;
        color: #9a9aa5;
        display: block;
        margin-bottom: 3px;
    }

    .coordinate-value {
        font-size: 10px;
        font-weight: 600;
        color: #343a40;
        word-break: break-all;
    }

    .maps-btn {
        font-size: 9px;
        border-radius: 6px;
        padding: 7px 10px;
    }

    @media (max-width: 767.98px) {

        .page-header {
            padding: 17px;
        }

        .page-header-actions {
            margin-top: 15px;
            width: 100%;
        }

        .page-header-actions .btn {
            width: 100%;
        }

        .content-card .card-body {
            padding: 17px;
        }

        .photo-container {
            height: 240px;
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

                                <i class="mdi mdi-calendar-check-outline"></i>

                            </div>

                            <div>

                                <h4 class="page-title">
                                    Detail Absensi
                                </h4>

                                <p class="page-subtitle">
                                    Informasi lengkap riwayat absensi siswa.
                                </p>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="d-flex justify-content-md-end page-header-actions">

                            <a
                                href="{{ route('admin.absensi') }}"
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
     DATA SISWA + WAKTU
========================================================= --}}

<div class="row">

    {{-- DATA SISWA --}}

    <div class="col-lg-4 grid-margin stretch-card">

        <div class="card content-card">

            <div class="card-body">

                <div class="section-header">

                    <div class="section-icon">

                        <i class="mdi mdi-account-school-outline"></i>

                    </div>

                    <div>

                        <h5 class="section-title">
                            Data Siswa
                        </h5>

                        <p class="section-subtitle">
                            Identitas siswa yang melakukan absensi.
                        </p>

                    </div>

                </div>


                <div class="student-card">

                    <div class="text-center">

                        <div class="student-avatar">

                            <i class="mdi mdi-account-school-outline"></i>

                        </div>

                        <div class="student-name">

                            {{ $absensi->siswa->user->name ?? '-' }}

                        </div>

                        <div class="student-email">

                            {{ $absensi->siswa->user->email ?? '-' }}

                        </div>

                    </div>


                    <div class="info-item mt-3">

                        <span class="info-label">
                            Jurusan
                        </span>

                        <span class="info-value">

                            {{
                                $absensi->siswa->jurusan->nama_jurusan
                                ?? '-'
                            }}

                        </span>

                    </div>


                    <div class="info-item">

                        <span class="info-label">
                            Kelas
                        </span>

                        <span class="info-value">

                            {{
                                $absensi->siswa->kelas->nama_kelas
                                ?? '-'
                            }}

                        </span>

                    </div>


                    <div class="info-item">

                        <span class="info-label">
                            Tanggal Absensi
                        </span>

                        <span class="info-value">

                            {{
                                \Carbon\Carbon::parse(
                                    $absensi->tanggal
                                )->format('d F Y')
                            }}

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- WAKTU ABSENSI --}}

    <div class="col-lg-8 grid-margin stretch-card">

        <div class="card content-card">

            <div class="card-body">

                <div class="section-header">

                    <div class="section-icon">

                        <i class="mdi mdi-clock-outline"></i>

                    </div>

                    <div>

                        <h5 class="section-title">
                            Waktu Absensi
                        </h5>

                        <p class="section-subtitle">
                            Waktu masuk dan pulang siswa.
                        </p>

                    </div>

                </div>


                <div class="row">

                    {{-- JAM MASUK --}}

                    <div class="col-md-6 mb-3">

                        <div class="time-card">

                            <div class="time-icon time-in">

                                <i class="mdi mdi-login-variant"></i>

                            </div>

                            <div class="time-label">
                                Jam Masuk
                            </div>

                            @if($absensi->jam_masuk)

                            <h3 class="time-value">
                                {{ $absensi->jam_masuk }}
                            </h3>

                            @else

                            <h3 class="time-value text-muted">
                                -
                            </h3>

                            @endif

                        </div>

                    </div>


                    {{-- JAM PULANG --}}

                    <div class="col-md-6 mb-3">

                        <div class="time-card">

                            <div class="time-icon time-out">

                                <i class="mdi mdi-logout-variant"></i>

                            </div>

                            <div class="time-label">
                                Jam Pulang
                            </div>

                            @if($absensi->jam_pulang)

                            <h3 class="time-value">
                                {{ $absensi->jam_pulang }}
                            </h3>

                            @else

                            <h3 class="time-value text-muted">
                                -
                            </h3>

                            @endif

                        </div>

                    </div>

                </div>


                <div class="row">

                    {{-- STATUS --}}

                    <div class="col-md-6 mb-3">

                        <div class="meta-card">

                            <span class="meta-label">
                                Status Absensi
                            </span>

                            @switch($absensi->status)

                            @case('hadir')

                            <span class="status-badge status-hadir">

                                <i class="mdi mdi-check-circle-outline me-1"></i>

                                Hadir

                            </span>

                            @break

                            @case('izin')

                            <span class="status-badge status-izin">

                                <i class="mdi mdi-alert-circle-outline me-1"></i>

                                Izin

                            </span>

                            @break

                            @case('sakit')

                            <span class="status-badge status-sakit">

                                <i class="mdi mdi-hospital-box-outline me-1"></i>

                                Sakit

                            </span>

                            @break

                            @case('alpha')

                            <span class="status-badge status-alpha">

                                <i class="mdi mdi-close-circle-outline me-1"></i>

                                Alpha

                            </span>

                            @break

                            @default

                            <span class="status-badge status-default">

                                {{ ucfirst($absensi->status ?? '-') }}

                            </span>

                            @endswitch

                        </div>

                    </div>


                    {{-- METODE --}}

                    <div class="col-md-6 mb-3">

                        <div class="meta-card">

                            <span class="meta-label">
                                Metode Verifikasi
                            </span>

                            @if(
                            $absensi->metode_verifikasi === 'gps_face'
                            )

                            <span class="method-badge">

                                <i class="mdi mdi-map-marker-radius-outline me-1"></i>

                                GPS + Face Recognition

                            </span>

                            @else

                            <span class="method-badge">

                                {{
                                        $absensi->metode_verifikasi
                                        ?? '-'
                                    }}

                            </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     FOTO ABSENSI
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card content-card">

            <div class="card-body">

                <div class="section-header">

                    <div class="section-icon">

                        <i class="mdi mdi-camera-outline"></i>

                    </div>

                    <div>

                        <h5 class="section-title">
                            Bukti Foto Absensi
                        </h5>

                        <p class="section-subtitle">
                            Foto yang tersimpan pada saat absensi.
                        </p>

                    </div>

                </div>


                <div class="row">

                    {{-- FOTO MASUK --}}

                    <div class="col-md-6 mb-3 mb-md-0">

                        <div class="photo-card">

                            <div class="photo-title">

                                <i class="mdi mdi-login-variant text-success me-1"></i>

                                Foto Masuk

                            </div>


                            <div class="photo-container">

                                @if($absensi->foto_masuk)

                                <img
                                    src="{{ asset(
                                            'storage/' . $absensi->foto_masuk
                                        ) }}"
                                    alt="Foto masuk">

                                @else

                                <div class="photo-empty">

                                    <i class="mdi mdi-camera-off-outline"></i>

                                    <p>
                                        Foto masuk tidak tersedia.
                                    </p>

                                </div>

                                @endif

                            </div>

                        </div>

                    </div>


                    {{-- FOTO PULANG --}}

                    <div class="col-md-6">

                        <div class="photo-card">

                            <div class="photo-title">

                                <i class="mdi mdi-logout-variant text-info me-1"></i>

                                Foto Pulang

                            </div>


                            <div class="photo-container">

                                @if($absensi->foto_pulang)

                                <img
                                    src="{{ asset(
                                            'storage/' . $absensi->foto_pulang
                                        ) }}"
                                    alt="Foto pulang">

                                @else

                                <div class="photo-empty">

                                    <i class="mdi mdi-camera-off-outline"></i>

                                    <p>
                                        Foto pulang belum tersedia.
                                    </p>

                                </div>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     LOKASI ABSENSI
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card content-card">

            <div class="card-body">

                <div class="section-header">

                    <div class="section-icon">

                        <i class="mdi mdi-map-marker-radius-outline"></i>

                    </div>

                    <div>

                        <h5 class="section-title">
                            Lokasi Absensi
                        </h5>

                        <p class="section-subtitle">
                            Koordinat lokasi saat siswa melakukan absensi.
                        </p>

                    </div>

                </div>


                <div class="row">

                    {{-- LOKASI MASUK --}}

                    <div class="col-md-6 mb-3 mb-md-0">

                        <div class="location-card">

                            <div class="location-title">

                                <div class="location-title-icon">

                                    <i class="mdi mdi-login-variant"></i>

                                </div>

                                Lokasi Masuk

                            </div>


                            <div class="coordinate">

                                <span class="coordinate-label">
                                    Latitude
                                </span>

                                <span class="coordinate-value">

                                    {{ $absensi->latitude_masuk ?? '-' }}

                                </span>

                            </div>


                            <div class="coordinate">

                                <span class="coordinate-label">
                                    Longitude
                                </span>

                                <span class="coordinate-value">

                                    {{ $absensi->longitude_masuk ?? '-' }}

                                </span>

                            </div>


                            @if(
                            $absensi->latitude_masuk &&
                            $absensi->longitude_masuk
                            )

                            <a
                                href="https://www.google.com/maps/search/?api=1&query={{ $absensi->latitude_masuk }},{{ $absensi->longitude_masuk }}"
                                target="_blank"
                                class="btn btn-outline-primary maps-btn">

                                <i class="mdi mdi-map-outline me-1"></i>

                                Buka Google Maps

                            </a>

                            @endif

                        </div>

                    </div>


                    {{-- LOKASI PULANG --}}

                    <div class="col-md-6">

                        <div class="location-card">

                            <div class="location-title">

                                <div class="location-title-icon">

                                    <i class="mdi mdi-logout-variant"></i>

                                </div>

                                Lokasi Pulang

                            </div>


                            <div class="coordinate">

                                <span class="coordinate-label">
                                    Latitude
                                </span>

                                <span class="coordinate-value">

                                    {{ $absensi->latitude_pulang ?? '-' }}

                                </span>

                            </div>


                            <div class="coordinate">

                                <span class="coordinate-label">
                                    Longitude
                                </span>

                                <span class="coordinate-value">

                                    {{ $absensi->longitude_pulang ?? '-' }}

                                </span>

                            </div>


                            @if(
                            $absensi->latitude_pulang &&
                            $absensi->longitude_pulang
                            )

                            <a
                                href="https://www.google.com/maps/search/?api=1&query={{ $absensi->latitude_pulang }},{{ $absensi->longitude_pulang }}"
                                target="_blank"
                                class="btn btn-outline-primary maps-btn">

                                <i class="mdi mdi-map-outline me-1"></i>

                                Buka Google Maps

                            </a>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection