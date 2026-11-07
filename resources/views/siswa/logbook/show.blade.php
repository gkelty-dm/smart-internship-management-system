@extends('layouts.skydash-siswa')

@section('title', 'Detail Logbook')

@section('content')

{{-- =========================================================
     HEADER
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center flex-wrap">

                    <div class="d-flex align-items-center">

                        <div
                            class="rounded-3 bg-primary bg-opacity-10
                            d-flex align-items-center justify-content-center me-3"
                            style="width:52px;height:52px;">

                            <i
                                class="mdi mdi-book-open-page-variant-outline text-primary"
                                style="font-size:27px;">
                            </i>

                        </div>

                        <div>

                            <h4 class="fw-bold mb-1">
                                Detail Logbook
                            </h4>

                            <p class="text-muted mb-0">
                                Detail kegiatan PKL dan status validasi Anda.
                            </p>

                        </div>

                    </div>


                    <div class="d-flex gap-2 mt-3 mt-md-0">

                        @if($logbook->status_validasi == 'ditolak')

                        <a
                            href="{{ route(
                                'siswa.logbook.edit',
                                $logbook->id
                            ) }}"
                            class="btn btn-primary">

                            <i class="mdi mdi-pencil-outline me-1"></i>

                            Edit Logbook

                        </a>

                        @endif


                        <a
                            href="{{ route('siswa.logbook.index') }}"
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
     ALERT
========================================================= --}}

@if(session('success'))

<div class="row">

    <div class="col-12">

        <div
            class="alert alert-success border-0 shadow-sm
            d-flex align-items-center">

            <i
                class="mdi mdi-check-circle-outline me-2"
                style="font-size:22px;">
            </i>

            <span>
                {{ session('success') }}
            </span>

        </div>

    </div>

</div>

@endif


@if(session('error'))

<div class="row">

    <div class="col-12">

        <div
            class="alert alert-danger border-0 shadow-sm
            d-flex align-items-center">

            <i
                class="mdi mdi-alert-circle-outline me-2"
                style="font-size:22px;">
            </i>

            <span>
                {{ session('error') }}
            </span>

        </div>

    </div>

</div>

@endif


{{-- =========================================================
     DETAIL DAN STATUS
========================================================= --}}

<div class="row">


    {{-- =====================================================
         DETAIL KEGIATAN
    ====================================================== --}}

    <div class="col-lg-8 grid-margin stretch-card">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">


                {{-- HEADER CARD --}}

                <div
                    class="d-flex justify-content-between
                    align-items-center mb-4">

                    <div>

                        <h5 class="card-title mb-1">
                            Kegiatan PKL
                        </h5>

                        <small class="text-muted">
                            Informasi kegiatan yang dicatat.
                        </small>

                    </div>


                    {{-- STATUS --}}

                    @if($logbook->status_validasi == 'disetujui')

                    <span
                        class="badge bg-success px-3 py-2">

                        <i class="mdi mdi-check-circle-outline me-1"></i>

                        Disetujui

                    </span>

                    @elseif($logbook->status_validasi == 'ditolak')

                    <span
                        class="badge bg-danger px-3 py-2">

                        <i class="mdi mdi-close-circle-outline me-1"></i>

                        Ditolak

                    </span>

                    @else

                    <span
                        class="badge bg-warning text-dark px-3 py-2">

                        <i class="mdi mdi-clock-outline me-1"></i>

                        Menunggu Validasi

                    </span>

                    @endif

                </div>


                {{-- =================================================
                     TANGGAL
                ================================================== --}}

                <div
                    class="bg-light rounded-3 p-3 mb-4">

                    <div class="d-flex align-items-center">

                        <div
                            class="rounded-3 bg-white
                            d-flex align-items-center
                            justify-content-center me-3"
                            style="width:45px;height:45px;">

                            <i
                                class="mdi mdi-calendar-outline
                                text-primary"
                                style="font-size:24px;">
                            </i>

                        </div>

                        <div>

                            <small class="text-muted d-block">
                                Tanggal Kegiatan
                            </small>

                            <h6 class="fw-bold mb-0">

                                {{ \Carbon\Carbon::parse(
                                    $logbook->tanggal
                                )->translatedFormat('d F Y') }}

                            </h6>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     KEGIATAN
                ================================================== --}}

                <div class="mb-4">

                    <div class="d-flex align-items-center mb-2">

                        <i
                            class="mdi mdi-briefcase-outline
                            text-primary me-2"
                            style="font-size:20px;">
                        </i>

                        <h6 class="fw-bold mb-0">
                            Kegiatan
                        </h6>

                    </div>


                    <div
                        class="border rounded-3 p-3">

                        {!! nl2br(e($logbook->kegiatan)) !!}

                    </div>

                </div>


                {{-- =================================================
                     KENDALA
                ================================================== --}}

                <div class="mb-4">

                    <div class="d-flex align-items-center mb-2">

                        <i
                            class="mdi mdi-alert-circle-outline
                            text-warning me-2"
                            style="font-size:20px;">
                        </i>

                        <h6 class="fw-bold mb-0">
                            Kendala
                        </h6>

                    </div>


                    <div
                        class="border rounded-3 p-3">

                        @if($logbook->kendala)

                        {!! nl2br(e($logbook->kendala)) !!}

                        @else

                        <span class="text-muted">
                            Tidak ada kendala yang dicatat.
                        </span>

                        @endif

                    </div>

                </div>


                {{-- =================================================
                     SOLUSI
                ================================================== --}}

                <div>

                    <div class="d-flex align-items-center mb-2">

                        <i
                            class="mdi mdi-lightbulb-outline
                            text-success me-2"
                            style="font-size:20px;">
                        </i>

                        <h6 class="fw-bold mb-0">
                            Solusi
                        </h6>

                    </div>


                    <div
                        class="border rounded-3 p-3">

                        @if($logbook->solusi)

                        {!! nl2br(e($logbook->solusi)) !!}

                        @else

                        <span class="text-muted">
                            Tidak ada solusi yang dicatat.
                        </span>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         STATUS VALIDASI
    ====================================================== --}}

    <div class="col-lg-4 grid-margin stretch-card">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">


                <div class="mb-4">

                    <h5 class="card-title mb-1">
                        Status Validasi
                    </h5>

                    <small class="text-muted">
                        Hasil pemeriksaan guru pembimbing.
                    </small>

                </div>


                {{-- =================================================
                     DISETUJUI
                ================================================== --}}

                @if($logbook->status_validasi == 'disetujui')

                <div class="text-center">

                    <div
                        class="rounded-circle bg-success bg-opacity-10
                        d-flex align-items-center justify-content-center
                        mx-auto mb-3"
                        style="width:90px;height:90px;">

                        <i
                            class="mdi mdi-check-circle text-success"
                            style="font-size:50px;">
                        </i>

                    </div>

                    <h5 class="fw-bold text-success mb-2">
                        Logbook Disetujui
                    </h5>

                    <p class="text-muted small mb-0">
                        Logbook Anda telah diperiksa dan disetujui
                        oleh guru pembimbing.
                    </p>

                </div>


                {{-- =================================================
                     DITOLAK
                ================================================== --}}

                @elseif($logbook->status_validasi == 'ditolak')

                <div class="text-center">

                    <div
                        class="rounded-circle bg-danger bg-opacity-10
                        d-flex align-items-center justify-content-center
                        mx-auto mb-3"
                        style="width:90px;height:90px;">

                        <i
                            class="mdi mdi-close-circle text-danger"
                            style="font-size:50px;">
                        </i>

                    </div>

                    <h5 class="fw-bold text-danger mb-2">
                        Logbook Ditolak
                    </h5>

                    <p class="text-muted small mb-0">
                        Silakan perbaiki logbook berdasarkan
                        catatan pembimbing.
                    </p>

                </div>


                {{-- =================================================
                     PENDING
                ================================================== --}}

                @else

                <div class="text-center">

                    <div
                        class="rounded-circle bg-warning bg-opacity-10
                        d-flex align-items-center justify-content-center
                        mx-auto mb-3"
                        style="width:90px;height:90px;">

                        <i
                            class="mdi mdi-clock-outline text-warning"
                            style="font-size:50px;">
                        </i>

                    </div>

                    <h5 class="fw-bold text-warning mb-2">
                        Menunggu Validasi
                    </h5>

                    <p class="text-muted small mb-0">
                        Logbook sedang menunggu pemeriksaan
                        dari guru pembimbing.
                    </p>

                </div>

                @endif


                {{-- =================================================
                     CATATAN GURU
                ================================================== --}}

                @if($logbook->catatan_guru)

                <div
                    class="border-top mt-4 pt-4">

                    <div class="d-flex align-items-center mb-2">

                        <i
                            class="mdi mdi-comment-text-outline
                            text-primary me-2"
                            style="font-size:20px;">
                        </i>

                        <h6 class="fw-bold mb-0">
                            Catatan Pembimbing
                        </h6>

                    </div>


                    <div
                        class="bg-light rounded-3 p-3">

                        {!! nl2br(
                        e($logbook->catatan_guru)
                        ) !!}

                    </div>

                </div>

                @endif


                {{-- =================================================
                     TOMBOL EDIT
                ================================================== --}}

                @if($logbook->status_validasi == 'ditolak')

                <div
                    class="border-top mt-4 pt-4">

                    <a
                        href="{{ route(
                            'siswa.logbook.edit',
                            $logbook->id
                        ) }}"
                        class="btn btn-primary w-100">

                        <i
                            class="mdi mdi-pencil-outline me-1">
                        </i>

                        Perbaiki Logbook

                    </a>

                </div>

                @endif

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     FOTO DOKUMENTASI
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card border-0 shadow-sm">

            <div class="card-body">


                {{-- HEADER FOTO --}}

                <div
                    class="d-flex justify-content-between
                    align-items-center mb-4">

                    <div>

                        <h5 class="card-title mb-1">
                            Foto Dokumentasi
                        </h5>

                        <small class="text-muted">
                            Dokumentasi kegiatan PKL.
                        </small>

                    </div>


                    @if($logbook->fotos && $logbook->fotos->count())

                    <span class="badge bg-primary">

                        {{ $logbook->fotos->count() }} Foto

                    </span>

                    @endif

                </div>


                @if($logbook->fotos && $logbook->fotos->count())

                <div class="row g-3">

                    @foreach($logbook->fotos as $foto)

                    <div class="col-6 col-md-4 col-lg-3">

                        <div
                            class="border rounded-3 overflow-hidden
                            bg-light">

                            <img
                                src="{{ asset('storage/' . $foto->foto) }}"
                                alt="Dokumentasi Logbook"
                                class="img-fluid w-100"
                                style="height:200px;object-fit:cover;">

                        </div>

                    </div>

                    @endforeach

                </div>

                @else

                <div
                    class="text-center py-5">

                    <div
                        class="rounded-circle bg-light
                        d-flex align-items-center justify-content-center
                        mx-auto mb-3"
                        style="width:75px;height:75px;">

                        <i
                            class="mdi mdi-image-off-outline
                            text-muted"
                            style="font-size:38px;">
                        </i>

                    </div>

                    <h6 class="fw-semibold mb-1">
                        Belum Ada Dokumentasi
                    </h6>

                    <p class="text-muted small mb-0">
                        Belum ada foto dokumentasi untuk logbook ini.
                    </p>

                </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection