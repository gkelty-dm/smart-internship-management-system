@extends('layouts.skydash-siswa')

@section('title', 'Profil PKL')

@section('content')

{{-- =========================================================
     HEADER PROFIL PKL
========================================================= --}}

<div class="row">

    <div class="col-12">

        <div
            class="card border-0 shadow-sm mb-4"
            style="border-radius:14px;">

            <div class="card-body p-4">

                <div
                    class="d-flex align-items-center">

                    {{-- ICON --}}

                    <div
                        class="d-flex align-items-center justify-content-center"
                        style="
                            width:58px;
                            height:58px;
                            min-width:58px;
                            background:rgba(75,73,172,.10);
                            color:#4B49AC;
                            border-radius:12px;
                            font-size:28px;
                            margin-right:16px;
                        ">

                        <i class="mdi mdi-briefcase-account-outline"></i>

                    </div>


                    {{-- JUDUL --}}

                    <div>

                        <h4
                            class="fw-bold mb-1"
                            style="font-size:21px;">

                            Profil PKL

                        </h4>

                        <p class="text-muted mb-0">

                            Informasi penempatan dan pembimbing PKL Anda.

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     BELUM ADA PENEMPATAN
========================================================= --}}

@if(!$penempatan)

<div class="row">

    <div class="col-12">

        <div
            class="card border-0 shadow-sm"
            style="border-radius:14px;">

            <div
                class="card-body text-center"
                style="padding:70px 30px;">

                <div
                    class="d-flex align-items-center
                    justify-content-center mx-auto mb-4"
                    style="
                        width:90px;
                        height:90px;
                        border-radius:50%;
                        background:rgba(75,73,172,.08);
                        color:#4B49AC;
                        font-size:42px;
                    ">

                    <i class="mdi mdi-briefcase-outline"></i>

                </div>


                <h5 class="fw-bold mb-2">

                    Belum Ada Penempatan PKL

                </h5>


                <p
                    class="text-muted mb-0"
                    style="max-width:450px;margin:0 auto;">

                    Data penempatan PKL Anda belum tersedia.
                    Silakan menunggu informasi dari pihak sekolah.

                </p>

            </div>

        </div>

    </div>

</div>


@else


{{-- =========================================================
     STATUS PKL
========================================================= --}}

<div class="row">

    <div class="col-12">

        <div
            class="card border-0 shadow-sm mb-4"
            style="border-radius:14px;">

            <div class="card-body p-4">

                <div
                    class="d-flex justify-content-between
                    align-items-center flex-wrap">

                    <div>

                        <div
                            class="d-flex align-items-center mb-1">

                            <i
                                class="mdi mdi-clipboard-check-outline text-primary me-2"
                                style="font-size:22px;">
                            </i>

                            <h5 class="fw-bold mb-0">

                                Status PKL

                            </h5>

                        </div>

                        <p class="text-muted mb-0 ms-4">

                            Status penempatan PKL Anda saat ini.

                        </p>

                    </div>


                    {{-- STATUS --}}

                    <div class="mt-3 mt-md-0">

                        @if($penempatan->status_pkl == 'aktif')

                        <span
                            class="badge px-3 py-2"
                            style="
                                background:#e8f7ee;
                                color:#198754;
                                font-size:13px;
                                border-radius:8px;
                            ">

                            <i class="mdi mdi-check-circle-outline me-1"></i>

                            Aktif

                        </span>

                        @elseif($penempatan->status_pkl == 'selesai')

                        <span
                            class="badge px-3 py-2"
                            style="
                                background:#e8efff;
                                color:#4B49AC;
                                font-size:13px;
                                border-radius:8px;
                            ">

                            <i class="mdi mdi-check-all me-1"></i>

                            Selesai

                        </span>

                        @elseif($penempatan->status_pkl == 'dibatalkan')

                        <span
                            class="badge px-3 py-2"
                            style="
                                background:#fdecec;
                                color:#dc3545;
                                font-size:13px;
                                border-radius:8px;
                            ">

                            <i class="mdi mdi-close-circle-outline me-1"></i>

                            Dibatalkan

                        </span>

                        @else

                        <span
                            class="badge px-3 py-2"
                            style="
                                background:#fff4d6;
                                color:#856404;
                                font-size:13px;
                                border-radius:8px;
                            ">

                            <i class="mdi mdi-clock-outline me-1"></i>

                            Pending

                        </span>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     SISWA + TEMPAT PKL
========================================================= --}}

<div class="row">


    {{-- =====================================================
         DATA SISWA
    ====================================================== --}}

    <div class="col-lg-4">

        <div
            class="card border-0 shadow-sm mb-4"
            style="border-radius:14px;">

            <div class="card-body text-center p-4">

                <span
                    class="d-block text-muted small mb-3">

                    DATA SISWA

                </span>


                {{-- FOTO --}}

                @if(
                $siswa->user &&
                $siswa->user->foto_profil
                )

                <img
                    src="{{ url($siswa->user->foto_profil) }}"
                    alt="Foto Profil"
                    style="
                        width:110px !important;
                        height:110px !important;
                        min-width:110px !important;
                        max-width:110px !important;
                        min-height:110px !important;
                        max-height:110px !important;
                        object-fit:cover !important;
                        object-position:center !important;
                        border-radius:50% !important;
                        border:4px solid #ffffff !important;
                        box-shadow:0 3px 12px rgba(0,0,0,.12);
                        margin-bottom:15px;
                    ">

                @else

                <div
                    class="mx-auto mb-3"
                    style="
                        width:110px;
                        height:110px;
                        border-radius:50%;
                        background:#f1f2f7;
                        color:#6c7293;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        font-size:50px;
                    ">

                    <i class="mdi mdi-account-outline"></i>

                </div>

                @endif


                <h5 class="fw-bold mb-1">

                    {{ $siswa->user->name ?? '-' }}

                </h5>


                <p class="text-muted mb-3">

                    NISN:
                    {{ $siswa->nisn ?? '-' }}

                </p>


                <div
                    class="d-flex justify-content-center
                    gap-2 flex-wrap">

                    <span
                        class="badge"
                        style="
                            background:rgba(75,73,172,.10);
                            color:#4B49AC;
                            padding:8px 12px;
                            border-radius:7px;
                        ">

                        {{ $siswa->kelas->nama_kelas ?? '-' }}

                    </span>


                    <span
                        class="badge"
                        style="
                            background:#f1f2f7;
                            color:#555;
                            padding:8px 12px;
                            border-radius:7px;
                        ">

                        {{ $siswa->jurusan->nama_jurusan ?? '-' }}

                    </span>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         TEMPAT PKL
    ====================================================== --}}

    <div class="col-lg-8">

        <div
            class="card border-0 shadow-sm mb-4"
            style="border-radius:14px;">

            <div class="card-body p-4">

                <div
                    class="d-flex align-items-center mb-4">

                    <div
                        class="d-flex align-items-center
                        justify-content-center me-3"
                        style="
                            width:44px;
                            height:44px;
                            min-width:44px;
                            border-radius:10px;
                            background:rgba(75,73,172,.10);
                            color:#4B49AC;
                            font-size:22px;
                        ">

                        <i class="mdi mdi-office-building-outline"></i>

                    </div>

                    <div>

                        <h5 class="fw-bold mb-0">

                            Tempat PKL

                        </h5>

                        <small class="text-muted">

                            Informasi perusahaan tempat Anda melaksanakan PKL.

                        </small>

                    </div>

                </div>


                <h4 class="fw-bold mb-3">

                    {{ $penempatan->perusahaan->nama_perusahaan ?? '-' }}

                </h4>


                {{-- ALAMAT --}}

                <div
                    class="d-flex align-items-start mb-4">

                    <i
                        class="mdi mdi-map-marker-outline text-primary me-3"
                        style="font-size:21px;">
                    </i>

                    <div>

                        <small class="text-muted d-block mb-1">
                            Alamat
                        </small>

                        <span>

                            {{ $penempatan->perusahaan->alamat ?? '-' }}

                        </span>

                    </div>

                </div>


                <div class="row">


                    {{-- TELEPON --}}

                    <div class="col-md-6 mb-3 mb-md-0">

                        <div
                            class="p-3"
                            style="
                                background:#f8f9fc;
                                border:1px solid #ebedf2;
                                border-radius:9px;
                            ">

                            <small class="text-muted d-block mb-1">

                                Telepon

                            </small>

                            <span class="fw-semibold">

                                {{ $penempatan->perusahaan->telepon ?? '-' }}

                            </span>

                        </div>

                    </div>


                    {{-- EMAIL --}}

                    <div class="col-md-6">

                        <div
                            class="p-3"
                            style="
                                background:#f8f9fc;
                                border:1px solid #ebedf2;
                                border-radius:9px;
                            ">

                            <small class="text-muted d-block mb-1">

                                Email

                            </small>

                            <span class="fw-semibold">

                                {{ $penempatan->perusahaan->email ?? '-' }}

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     PERIODE PKL
========================================================= --}}

<div class="row">

    <div class="col-12">

        <div
            class="card border-0 shadow-sm mb-4"
            style="border-radius:14px;">

            <div class="card-body p-4">

                <div
                    class="d-flex align-items-center mb-4">

                    <div
                        class="d-flex align-items-center
                        justify-content-center me-3"
                        style="
                            width:44px;
                            height:44px;
                            min-width:44px;
                            border-radius:10px;
                            background:rgba(75,73,172,.10);
                            color:#4B49AC;
                            font-size:22px;
                        ">

                        <i class="mdi mdi-calendar-range-outline"></i>

                    </div>

                    <div>

                        <h5 class="fw-bold mb-0">

                            Periode PKL

                        </h5>

                        <small class="text-muted">

                            Jadwal pelaksanaan kegiatan PKL.

                        </small>

                    </div>

                </div>


                <div class="row">


                    {{-- MULAI --}}

                    <div class="col-md-6 mb-3 mb-md-0">

                        <div
                            class="p-3"
                            style="
                                background:#f8f9fc;
                                border:1px solid #ebedf2;
                                border-radius:10px;
                            ">

                            <div
                                class="d-flex align-items-center">

                                <div
                                    style="
                                        width:40px;
                                        height:40px;
                                        min-width:40px;
                                        border-radius:8px;
                                        background:#e8f7ee;
                                        color:#198754;
                                        display:flex;
                                        align-items:center;
                                        justify-content:center;
                                        margin-right:12px;
                                    ">

                                    <i class="mdi mdi-calendar-start"></i>

                                </div>

                                <div>

                                    <small class="text-muted d-block">

                                        Tanggal Mulai

                                    </small>

                                    <strong>

                                        @if($penempatan->tanggal_mulai)

                                        {{ \Carbon\Carbon::parse(
                                            $penempatan->tanggal_mulai
                                        )->translatedFormat('d F Y') }}

                                        @else

                                        -

                                        @endif

                                    </strong>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- SELESAI --}}

                    <div class="col-md-6">

                        <div
                            class="p-3"
                            style="
                                background:#f8f9fc;
                                border:1px solid #ebedf2;
                                border-radius:10px;
                            ">

                            <div
                                class="d-flex align-items-center">

                                <div
                                    style="
                                        width:40px;
                                        height:40px;
                                        min-width:40px;
                                        border-radius:8px;
                                        background:#fdecec;
                                        color:#dc3545;
                                        display:flex;
                                        align-items:center;
                                        justify-content:center;
                                        margin-right:12px;
                                    ">

                                    <i class="mdi mdi-calendar-end"></i>

                                </div>

                                <div>

                                    <small class="text-muted d-block">

                                        Tanggal Selesai

                                    </small>

                                    <strong>

                                        @if($penempatan->tanggal_selesai)

                                        {{ \Carbon\Carbon::parse(
                                            $penempatan->tanggal_selesai
                                        )->translatedFormat('d F Y') }}

                                        @else

                                        -

                                        @endif

                                    </strong>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     PEMBIMBING
========================================================= --}}

<div class="row">


    {{-- GURU PEMBIMBING --}}

    <div class="col-md-6">

        <div
            class="card border-0 shadow-sm mb-4"
            style="border-radius:14px;">

            <div class="card-body p-4">

                <div
                    class="d-flex align-items-center mb-4">

                    <div
                        style="
                            width:44px;
                            height:44px;
                            min-width:44px;
                            border-radius:10px;
                            background:rgba(75,73,172,.10);
                            color:#4B49AC;
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            margin-right:13px;
                            font-size:22px;
                        ">

                        <i class="mdi mdi-account-tie-outline"></i>

                    </div>

                    <div>

                        <h5 class="fw-bold mb-0">

                            Guru Pembimbing

                        </h5>

                        <small class="text-muted">

                            Pembimbing dari sekolah.

                        </small>

                    </div>

                </div>


                <div
                    class="d-flex align-items-center p-3"
                    style="
                        background:#f8f9fc;
                        border:1px solid #ebedf2;
                        border-radius:10px;
                    ">

                    <div
                        style="
                            width:52px;
                            height:52px;
                            min-width:52px;
                            border-radius:50%;
                            background:rgba(75,73,172,.10);
                            color:#4B49AC;
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            font-size:25px;
                            margin-right:13px;
                        ">

                        <i class="mdi mdi-account-tie-outline"></i>

                    </div>

                    <div>

                        <h6 class="fw-bold mb-1">

                            {{ $penempatan->guru->user->name ?? '-' }}

                        </h6>

                        <small class="text-muted">

                            Guru Pembimbing Sekolah

                        </small>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- PEMBIMBING INDUSTRI --}}

    <div class="col-md-6">

        <div
            class="card border-0 shadow-sm mb-4"
            style="border-radius:14px;">

            <div class="card-body p-4">

                <div
                    class="d-flex align-items-center mb-4">

                    <div
                        style="
                            width:44px;
                            height:44px;
                            min-width:44px;
                            border-radius:10px;
                            background:rgba(75,73,172,.10);
                            color:#4B49AC;
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            margin-right:13px;
                            font-size:22px;
                        ">

                        <i class="mdi mdi-account-hard-hat"></i>

                    </div>

                    <div>

                        <h5 class="fw-bold mb-0">

                            Pembimbing Industri

                        </h5>

                        <small class="text-muted">

                            Pembimbing dari tempat PKL.

                        </small>

                    </div>

                </div>


                <div
                    class="d-flex align-items-center p-3"
                    style="
                        background:#f8f9fc;
                        border:1px solid #ebedf2;
                        border-radius:10px;
                    ">

                    <div
                        style="
                            width:52px;
                            height:52px;
                            min-width:52px;
                            border-radius:50%;
                            background:rgba(75,73,172,.10);
                            color:#4B49AC;
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            font-size:25px;
                            margin-right:13px;
                        ">

                        <i class="mdi mdi-account-hard-hat"></i>

                    </div>

                    <div>

                        <h6 class="fw-bold mb-1">

                            {{ $penempatan->industri->user->name ?? '-' }}

                        </h6>

                        <small class="text-muted">

                            Pembimbing Industri

                        </small>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


@endif

@endsection