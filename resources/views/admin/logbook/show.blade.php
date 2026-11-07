@extends('layouts.skydash-admin')

@section('title', 'Detail Logbook')

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

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 10px;
        border-radius: 5px;
        font-size: 8px;
        font-weight: 600;
    }

    .status-pending {
        background: rgba(255, 193, 7, .13);
        color: #b38600;
    }

    .status-disetujui {
        background: rgba(40, 167, 69, .10);
        color: #28a745;
    }

    .status-ditolak {
        background: rgba(220, 53, 69, .10);
        color: #dc3545;
    }

    .activity-box {
        border: 1px solid #eeeeee;
        border-radius: 9px;
        background: #fafaff;
        padding: 17px 18px;
        color: #555;
        font-size: 11px;
        line-height: 1.8;
    }

    .text-box {
        border: 1px solid #eeeeee;
        border-radius: 8px;
        padding: 14px;
        min-height: 105px;
        color: #555;
        font-size: 10px;
        line-height: 1.7;
        background: #fff;
    }

    .text-box-empty {
        color: #9a9aa5;
        font-style: italic;
    }

    .subsection-title {
        font-size: 11px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 9px;
    }

    .photo-card {
        border: 1px solid #eeeeee;
        border-radius: 9px;
        padding: 10px;
        background: #fff;
    }

    .photo-container {
        height: 190px;
        width: 100%;
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

    .photo-number {
        font-size: 9px;
        color: #9a9aa5;
        margin-top: 7px;
    }

    .validation-box {
        border: 1px solid #eeeeee;
        border-radius: 9px;
        padding: 18px;
        background: #fff;
    }

    .form-label-custom {
        display: block;
        font-size: 10px;
        font-weight: 600;
        color: #555;
        margin-bottom: 7px;
    }

    .form-control-custom {
        border: 1px solid #e2e2e8;
        border-radius: 7px;
        font-size: 10px;
        box-shadow: none !important;
    }

    .form-control-custom:focus {
        border-color: #4b49ac;
    }

    .validation-btn {
        height: 40px;
        border-radius: 7px;
        font-size: 10px;
        padding: 8px 16px;
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

                    <div class="col-md-8">

                        <div class="d-flex align-items-center">

                            <div class="page-header-icon me-3">

                                <i class="mdi mdi-notebook-outline"></i>

                            </div>

                            <div>

                                <h4 class="page-title">
                                    Detail Logbook
                                </h4>

                                <p class="page-subtitle">
                                    Detail kegiatan dan validasi logbook siswa.
                                </p>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="d-flex justify-content-md-end page-header-actions">

                            <a
                                href="{{ route('admin.logbook') }}"
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
     SISWA + INFORMASI KEGIATAN
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
                            Identitas pemilik logbook.
                        </p>

                    </div>

                </div>


                <div class="student-card">

                    <div class="text-center">

                        <div class="student-avatar">

                            <i class="mdi mdi-account-school-outline"></i>

                        </div>

                        <div class="student-name">

                            {{ $logbook->siswa->user->name ?? '-' }}

                        </div>

                        <div class="student-email">

                            {{ $logbook->siswa->user->email ?? '-' }}

                        </div>

                    </div>


                    <div class="info-item mt-3">

                        <span class="info-label">
                            Jurusan
                        </span>

                        <span class="info-value">

                            {{
                                $logbook->siswa->jurusan->nama_jurusan
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
                                $logbook->siswa->kelas->nama_kelas
                                ?? '-'
                            }}

                        </span>

                    </div>


                    <div class="info-item">

                        <span class="info-label">
                            Tanggal Logbook
                        </span>

                        <span class="info-value">

                            {{
                                \Carbon\Carbon::parse(
                                    $logbook->tanggal
                                )->format('d F Y')
                            }}

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- KEGIATAN --}}

    <div class="col-lg-8 grid-margin stretch-card">

        <div class="card content-card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div class="section-header mb-0">

                        <div class="section-icon">

                            <i class="mdi mdi-clipboard-text-outline"></i>

                        </div>

                        <div>

                            <h5 class="section-title">
                                Kegiatan
                            </h5>

                            <p class="section-subtitle">
                                Laporan kegiatan yang dilakukan siswa.
                            </p>

                        </div>

                    </div>


                    <div>

                        @if(
                        $logbook->status_validasi === 'pending'
                        )

                        <span class="status-badge status-pending">

                            <i class="mdi mdi-clock-outline me-1"></i>

                            Pending

                        </span>

                        @elseif(
                        $logbook->status_validasi === 'disetujui'
                        )

                        <span class="status-badge status-disetujui">

                            <i class="mdi mdi-check-circle-outline me-1"></i>

                            Disetujui

                        </span>

                        @elseif(
                        $logbook->status_validasi === 'ditolak'
                        )

                        <span class="status-badge status-ditolak">

                            <i class="mdi mdi-close-circle-outline me-1"></i>

                            Ditolak

                        </span>

                        @endif

                    </div>

                </div>


                <div class="activity-box mb-4">

                    {{ $logbook->kegiatan }}

                </div>


                <div class="row">

                    {{-- KENDALA --}}

                    <div class="col-md-6 mb-3 mb-md-0">

                        <div class="subsection-title">

                            <i class="mdi mdi-alert-circle-outline text-warning me-1"></i>

                            Kendala

                        </div>

                        <div class="text-box">

                            @if($logbook->kendala)

                            {{ $logbook->kendala }}

                            @else

                            <span class="text-box-empty">
                                Tidak ada kendala.
                            </span>

                            @endif

                        </div>

                    </div>


                    {{-- SOLUSI --}}

                    <div class="col-md-6">

                        <div class="subsection-title">

                            <i class="mdi mdi-lightbulb-outline text-primary me-1"></i>

                            Solusi

                        </div>

                        <div class="text-box">

                            @if($logbook->solusi)

                            {{ $logbook->solusi }}

                            @else

                            <span class="text-box-empty">
                                Tidak ada solusi.
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
     DOKUMENTASI
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card content-card">

            <div class="card-body">

                <div class="section-header">

                    <div class="section-icon">

                        <i class="mdi mdi-image-multiple-outline"></i>

                    </div>

                    <div>

                        <h5 class="section-title">
                            Dokumentasi Kegiatan
                        </h5>

                        <p class="section-subtitle">
                            Foto dokumentasi yang dilampirkan pada logbook.
                        </p>

                    </div>

                </div>


                @if($logbook->fotos->count())

                <div class="row">

                    @foreach($logbook->fotos as $foto)

                    <div class="col-md-4 col-lg-3 mb-3">

                        <div class="photo-card">

                            <div class="photo-container">

                                <img
                                    src="{{ asset('storage/' . $foto->foto) }}"
                                    alt="Dokumentasi kegiatan">

                            </div>

                            <div class="photo-number">

                                Dokumentasi {{ $loop->iteration }}

                            </div>

                        </div>

                    </div>

                    @endforeach

                </div>

                @else

                <div class="text-center py-5">

                    <i
                        class="mdi mdi-image-off-outline text-muted"
                        style="font-size:50px;">
                    </i>

                    <p class="text-muted mt-2 mb-0 small">
                        Belum ada dokumentasi kegiatan.
                    </p>

                </div>

                @endif

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     VALIDASI
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card content-card">

            <div class="card-body">

                <div class="section-header">

                    <div class="section-icon">

                        <i class="mdi mdi-check-decagram-outline"></i>

                    </div>

                    <div>

                        <h5 class="section-title">
                            Validasi Logbook
                        </h5>

                        <p class="section-subtitle">
                            Periksa dan tentukan status validasi logbook siswa.
                        </p>

                    </div>

                </div>


                <div class="validation-box">

                    <form
                        action="{{ route(
                            'admin.logbook.validasi',
                            $logbook->id
                        ) }}"
                        method="POST">

                        @csrf

                        @method('PUT')


                        <div class="row">

                            {{-- STATUS --}}

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label
                                        for="status_validasi"
                                        class="form-label-custom">

                                        Status Validasi

                                    </label>

                                    <select
                                        name="status_validasi"
                                        id="status_validasi"
                                        class="form-control form-control-custom"
                                        required>

                                        <option
                                            value="pending"
                                            {{ $logbook->status_validasi === 'pending' ? 'selected' : '' }}>

                                            Pending

                                        </option>

                                        <option
                                            value="disetujui"
                                            {{ $logbook->status_validasi === 'disetujui' ? 'selected' : '' }}>

                                            Disetujui

                                        </option>

                                        <option
                                            value="ditolak"
                                            {{ $logbook->status_validasi === 'ditolak' ? 'selected' : '' }}>

                                            Ditolak

                                        </option>

                                    </select>

                                </div>

                            </div>


                            {{-- CATATAN --}}

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label
                                        for="catatan_guru"
                                        class="form-label-custom">

                                        Catatan

                                    </label>

                                    <textarea
                                        name="catatan_guru"
                                        id="catatan_guru"
                                        class="form-control form-control-custom"
                                        rows="4"
                                        placeholder="Tambahkan catatan validasi...">{{ $logbook->catatan_guru }}</textarea>

                                </div>

                            </div>

                        </div>


                        <button
                            type="submit"
                            class="btn btn-primary validation-btn">

                            <i class="mdi mdi-check-circle-outline me-1"></i>

                            Simpan Validasi

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection