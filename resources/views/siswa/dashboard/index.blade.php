@extends('layouts.skydash-siswa')

@section('title', 'Dashboard')

@section('content')

{{-- =========================================================
     ALERT
========================================================= --}}

@if(session('error'))

<div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4"
    role="alert">

    <div class="d-flex align-items-center">

        <div class="rounded-circle bg-danger bg-opacity-10 d-flex align-items-center justify-content-center me-3"
            style="width:40px;height:40px;">

            <i class="mdi mdi-alert-circle-outline text-danger"
                style="font-size:21px;">
            </i>

        </div>

        <div>

            <h6 class="fw-bold mb-1">
                Perhatian
            </h6>

            <span>
                {{ session('error') }}
            </span>

        </div>

    </div>

    <button
        type="button"
        class="btn-close"
        data-bs-dismiss="alert"
        aria-label="Close">
    </button>

</div>

@endif


@if(session('success'))

<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4"
    role="alert">

    <div class="d-flex align-items-center">

        <div class="rounded-circle bg-success bg-opacity-10 d-flex align-items-center justify-content-center me-3"
            style="width:40px;height:40px;">

            <i class="mdi mdi-check-circle-outline text-success"
                style="font-size:21px;">
            </i>

        </div>

        <div>

            <h6 class="fw-bold mb-1">
                Berhasil
            </h6>

            <span>
                {{ session('success') }}
            </span>

        </div>

    </div>

    <button
        type="button"
        class="btn-close"
        data-bs-dismiss="alert"
        aria-label="Close">
    </button>

</div>

@endif


{{-- =========================================================
     HEADER DASHBOARD
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <div class="d-flex align-items-center">

                            <div
                                class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center me-3"
                                style="width:54px;height:54px;">

                                <i
                                    class="mdi mdi-school-outline text-primary"
                                    style="font-size:28px;">
                                </i>

                            </div>

                            <div>

                                <p class="text-muted mb-1 small">
                                    Selamat datang di SIMPKL
                                </p>

                                <h4 class="fw-bold mb-1">

                                    {{ $siswa->user->name ?? '-' }}

                                </h4>

                                <p class="text-muted mb-0 small">

                                    Pantau aktivitas PKL, logbook,
                                    absensi, dan nilai Anda.

                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-4 mt-3 mt-md-0">

                        <div class="bg-light rounded-3 p-3 text-md-end">

                            <small class="text-muted d-block mb-1">
                                Status PKL
                            </small>

                            @if($penempatan)

                            @if($penempatan->status_pkl == 'aktif')

                            <span class="badge bg-success px-3 py-2">

                                <i class="mdi mdi-check-circle-outline me-1"></i>

                                PKL Aktif

                            </span>

                            @elseif($penempatan->status_pkl == 'selesai')

                            <span class="badge bg-primary px-3 py-2">

                                <i class="mdi mdi-check-all me-1"></i>

                                PKL Selesai

                            </span>

                            @elseif($penempatan->status_pkl == 'pending')

                            <span class="badge bg-warning text-dark px-3 py-2">

                                <i class="mdi mdi-clock-outline me-1"></i>

                                Menunggu

                            </span>

                            @else

                            <span class="badge bg-secondary px-3 py-2">

                                {{ ucfirst($penempatan->status_pkl) }}

                            </span>

                            @endif

                            @else

                            <span class="badge bg-secondary px-3 py-2">

                                Belum Ada Penempatan

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
     STATISTIK
========================================================= --}}

<div class="row">


    {{-- TOTAL LOGBOOK --}}

    <div class="col-xl-3 col-md-6 grid-margin stretch-card">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <p class="text-muted small mb-2">
                            Total Logbook
                        </p>

                        <h3 class="fw-bold mb-1">
                            {{ $jumlahLogbook }}
                        </h3>

                        <small class="text-muted">
                            Seluruh kegiatan
                        </small>

                    </div>


                    <div
                        class="rounded-3 bg-primary bg-opacity-10 d-flex align-items-center justify-content-center"
                        style="width:48px;height:48px;">

                        <i
                            class="mdi mdi-book-open-page-variant text-primary"
                            style="font-size:24px;">
                        </i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- PENDING --}}

    <div class="col-xl-3 col-md-6 grid-margin stretch-card">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <p class="text-muted small mb-2">
                            Menunggu Validasi
                        </p>

                        <h3 class="fw-bold mb-1">
                            {{ $logbookPending }}
                        </h3>

                        <small class="text-muted">
                            Belum diperiksa guru
                        </small>

                    </div>


                    <div
                        class="rounded-3 bg-warning bg-opacity-10 d-flex align-items-center justify-content-center"
                        style="width:48px;height:48px;">

                        <i
                            class="mdi mdi-clock-outline text-warning"
                            style="font-size:24px;">
                        </i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- DISETUJUI --}}

    <div class="col-xl-3 col-md-6 grid-margin stretch-card">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <p class="text-muted small mb-2">
                            Logbook Disetujui
                        </p>

                        <h3 class="fw-bold mb-1">
                            {{ $logbookDisetujui }}
                        </h3>

                        <small class="text-muted">
                            Telah disetujui guru
                        </small>

                    </div>


                    <div
                        class="rounded-3 bg-success bg-opacity-10 d-flex align-items-center justify-content-center"
                        style="width:48px;height:48px;">

                        <i
                            class="mdi mdi-check-circle-outline text-success"
                            style="font-size:24px;">
                        </i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- KEHADIRAN --}}

    <div class="col-xl-3 col-md-6 grid-margin stretch-card">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <p class="text-muted small mb-2">
                            Total Kehadiran
                        </p>

                        <h3 class="fw-bold mb-1">
                            {{ $totalHadir }}
                        </h3>

                        <small class="text-muted">
                            Hari hadir
                        </small>

                    </div>


                    <div
                        class="rounded-3 bg-info bg-opacity-10 d-flex align-items-center justify-content-center"
                        style="width:48px;height:48px;">

                        <i
                            class="mdi mdi-calendar-check text-info"
                            style="font-size:24px;">
                        </i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     INFORMASI PKL + ABSENSI
========================================================= --}}

<div class="row">


    {{-- INFORMASI PKL --}}

    <div class="col-lg-8 grid-margin stretch-card">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>

                        <h5 class="card-title mb-1">
                            Informasi PKL
                        </h5>

                        <p class="text-muted small mb-0">
                            Informasi penempatan PKL Anda.
                        </p>

                    </div>


                    <a
                        href="{{ route('siswa.pkl.index') }}"
                        class="btn btn-primary btn-sm">

                        <i class="mdi mdi-eye-outline me-1"></i>

                        Detail

                    </a>

                </div>


                @if($penempatan)

                <div class="row">


                    {{-- PERUSAHAAN --}}

                    <div class="col-md-6 mb-3">

                        <div class="bg-light rounded-3 p-3 h-100">

                            <div class="d-flex align-items-center">

                                <div
                                    class="rounded-3 bg-primary bg-opacity-10 d-flex align-items-center justify-content-center me-3"
                                    style="width:38px;height:38px;">

                                    <i
                                        class="mdi mdi-domain text-primary"
                                        style="font-size:20px;">
                                    </i>

                                </div>

                                <div>

                                    <small class="text-muted d-block">
                                        Perusahaan
                                    </small>

                                    <span class="fw-semibold">

                                        {{ $penempatan->perusahaan->nama_perusahaan ?? '-' }}

                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- STATUS --}}

                    <div class="col-md-6 mb-3">

                        <div class="bg-light rounded-3 p-3 h-100">

                            <small class="text-muted d-block mb-2">
                                Status PKL
                            </small>


                            @if($penempatan->status_pkl == 'aktif')

                            <span class="badge bg-success">

                                <i class="mdi mdi-check-circle-outline me-1"></i>

                                Aktif

                            </span>

                            @elseif($penempatan->status_pkl == 'selesai')

                            <span class="badge bg-primary">

                                Selesai

                            </span>

                            @elseif($penempatan->status_pkl == 'pending')

                            <span class="badge bg-warning text-dark">

                                Pending

                            </span>

                            @else

                            <span class="badge bg-secondary">

                                {{ ucfirst($penempatan->status_pkl) }}

                            </span>

                            @endif

                        </div>

                    </div>


                    {{-- GURU --}}

                    <div class="col-md-6 mb-3">

                        <div class="bg-light rounded-3 p-3 h-100">

                            <div class="d-flex align-items-center">

                                <div
                                    class="rounded-3 bg-info bg-opacity-10 d-flex align-items-center justify-content-center me-3"
                                    style="width:38px;height:38px;">

                                    <i
                                        class="mdi mdi-account-tie-outline text-info"
                                        style="font-size:20px;">
                                    </i>

                                </div>

                                <div>

                                    <small class="text-muted d-block">
                                        Guru Pembimbing
                                    </small>

                                    <span class="fw-semibold">

                                        {{ $penempatan->guru->user->name ?? '-' }}

                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- INDUSTRI --}}

                    <div class="col-md-6 mb-3">

                        <div class="bg-light rounded-3 p-3 h-100">

                            <div class="d-flex align-items-center">

                                <div
                                    class="rounded-3 bg-warning bg-opacity-10 d-flex align-items-center justify-content-center me-3"
                                    style="width:38px;height:38px;">

                                    <i
                                        class="mdi mdi-account-hard-hat-outline text-warning"
                                        style="font-size:20px;">
                                    </i>

                                </div>

                                <div>

                                    <small class="text-muted d-block">
                                        Pembimbing Industri
                                    </small>

                                    <span class="fw-semibold">

                                        {{ $penempatan->industri->user->name ?? '-' }}

                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- TANGGAL --}}

                    <div class="col-md-6">

                        <div class="border rounded-3 p-3">

                            <small class="text-muted d-block mb-1">
                                <i class="mdi mdi-calendar-start me-1"></i>
                                Tanggal Mulai
                            </small>

                            <h6 class="fw-semibold mb-0">

                                {{ $penempatan->tanggal_mulai
                                    ? \Carbon\Carbon::parse(
                                        $penempatan->tanggal_mulai
                                    )->translatedFormat('d F Y')
                                    : '-'
                                }}

                            </h6>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="border rounded-3 p-3">

                            <small class="text-muted d-block mb-1">
                                <i class="mdi mdi-calendar-end me-1"></i>
                                Tanggal Selesai
                            </small>

                            <h6 class="fw-semibold mb-0">

                                {{ $penempatan->tanggal_selesai
                                    ? \Carbon\Carbon::parse(
                                        $penempatan->tanggal_selesai
                                    )->translatedFormat('d F Y')
                                    : '-'
                                }}

                            </h6>

                        </div>

                    </div>

                </div>

                @else

                <div class="text-center py-5">

                    <div
                        class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto"
                        style="width:70px;height:70px;">

                        <i
                            class="mdi mdi-information-outline text-muted"
                            style="font-size:35px;">
                        </i>

                    </div>

                    <h6 class="fw-bold mt-3 mb-1">
                        Belum Ada Penempatan PKL
                    </h6>

                    <p class="text-muted small mb-0">
                        Data penempatan PKL Anda belum tersedia.
                    </p>

                </div>

                @endif

            </div>

        </div>

    </div>


    {{-- ABSENSI HARI INI --}}

    <div class="col-lg-4 grid-margin stretch-card">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex align-items-center mb-4">

                    <div
                        class="rounded-3 bg-success bg-opacity-10 d-flex align-items-center justify-content-center me-3"
                        style="width:42px;height:42px;">

                        <i
                            class="mdi mdi-calendar-check text-success"
                            style="font-size:22px;">
                        </i>

                    </div>

                    <div>

                        <h5 class="card-title mb-1">
                            Absensi Hari Ini
                        </h5>

                        <p class="text-muted small mb-0">
                            Status kehadiran hari ini.
                        </p>

                    </div>

                </div>


                @if($absensiHariIni)

                <div class="text-center py-3">

                    <div
                        class="rounded-circle bg-success bg-opacity-10 d-flex align-items-center justify-content-center mx-auto mb-3"
                        style="width:82px;height:82px;">

                        <i
                            class="mdi mdi-check-circle-outline text-success"
                            style="font-size:45px;">
                        </i>

                    </div>

                    <h5 class="fw-bold mb-1">
                        Hadir
                    </h5>

                    <p class="text-muted small mb-1">
                        Jam Masuk
                    </p>

                    <h4 class="fw-bold text-primary mb-0">

                        {{ $absensiHariIni->jam_masuk ?? '-' }}

                    </h4>

                </div>

                @else

                <div class="text-center py-3">

                    <div
                        class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3"
                        style="width:82px;height:82px;">

                        <i
                            class="mdi mdi-calendar-remove-outline text-muted"
                            style="font-size:43px;">
                        </i>

                    </div>

                    <h6 class="fw-bold mb-1">
                        Belum Ada Absensi
                    </h6>

                    <p class="text-muted small mb-0">
                        Anda belum melakukan absensi hari ini.
                    </p>

                </div>

                @endif


                <div class="border-top pt-3 mt-3">

                    <a
                        href="{{ route('siswa.absensi.riwayat') }}"
                        class="btn btn-light btn-sm w-100">

                        <i class="mdi mdi-history me-1"></i>

                        Lihat Riwayat Absensi

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     NILAI + LOGBOOK
========================================================= --}}

<div class="row">


    {{-- NILAI PKL --}}

    <div class="col-lg-4 grid-margin stretch-card">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>

                        <h5 class="card-title mb-1">
                            Nilai PKL
                        </h5>

                        <p class="text-muted small mb-0">
                            Nilai akhir PKL Anda.
                        </p>

                    </div>


                    <a
                        href="{{ route('siswa.nilai.index') }}"
                        class="btn btn-light btn-sm">

                        Detail

                    </a>

                </div>


                @if($nilaiPKL)

                <div class="text-center py-3">

                    <div
                        class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center mx-auto mb-3"
                        style="width:92px;height:92px;">

                        <i
                            class="mdi mdi-school-outline text-primary"
                            style="font-size:42px;">
                        </i>

                    </div>

                    <small class="text-muted d-block">
                        Nilai Akhir
                    </small>

                    <h1 class="fw-bold text-primary mb-2">

                        {{ number_format(
                            $nilaiPKL->nilai_akhir ?? 0,
                            2
                        ) }}

                    </h1>


                    @if(($nilaiPKL->nilai_akhir ?? 0) >= 90)

                    <span class="badge bg-success px-3 py-2">
                        Sangat Baik
                    </span>

                    @elseif(($nilaiPKL->nilai_akhir ?? 0) >= 80)

                    <span class="badge bg-primary px-3 py-2">
                        Baik
                    </span>

                    @elseif(($nilaiPKL->nilai_akhir ?? 0) >= 70)

                    <span class="badge bg-warning text-dark px-3 py-2">
                        Cukup
                    </span>

                    @else

                    <span class="badge bg-danger px-3 py-2">
                        Kurang
                    </span>

                    @endif

                </div>

                @else

                <div class="text-center py-4">

                    <div
                        class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto"
                        style="width:75px;height:75px;">

                        <i
                            class="mdi mdi-school-outline text-muted"
                            style="font-size:38px;">
                        </i>

                    </div>

                    <h6 class="fw-bold mt-3 mb-1">
                        Nilai Belum Tersedia
                    </h6>

                    <p class="text-muted small mb-0">
                        Nilai PKL Anda belum diberikan.
                    </p>

                </div>

                @endif

            </div>

        </div>

    </div>


    {{-- LOGBOOK TERBARU --}}

    <div class="col-lg-8 grid-margin stretch-card">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>

                        <h5 class="card-title mb-1">
                            Logbook Terbaru
                        </h5>

                        <p class="text-muted small mb-0">
                            Aktivitas logbook terakhir Anda.
                        </p>

                    </div>


                    <a
                        href="{{ route('siswa.logbook.index') }}"
                        class="btn btn-light btn-sm">

                        <i class="mdi mdi-format-list-bulleted me-1"></i>

                        Lihat Semua

                    </a>

                </div>


                @if($logbookTerbaru->count())

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead>

                            <tr>

                                <th class="text-muted small">
                                    Tanggal
                                </th>

                                <th class="text-muted small">
                                    Kegiatan
                                </th>

                                <th class="text-muted small text-end">
                                    Status
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($logbookTerbaru as $logbook)

                            <tr>

                                <td class="text-nowrap">

                                    <div class="d-flex align-items-center">

                                        <div
                                            class="rounded-2 bg-light d-flex align-items-center justify-content-center me-2"
                                            style="width:34px;height:34px;">

                                            <i
                                                class="mdi mdi-calendar-outline text-primary">
                                            </i>

                                        </div>

                                        <span class="small fw-semibold">

                                            {{ \Carbon\Carbon::parse(
                                                $logbook->tanggal
                                            )->format('d/m/Y') }}

                                        </span>

                                    </div>

                                </td>


                                <td>

                                    <span class="small">

                                        {{ \Illuminate\Support\Str::limit(
                                            $logbook->kegiatan ?? '-',
                                            55
                                        ) }}

                                    </span>

                                </td>


                                <td class="text-end">

                                    @if($logbook->status_validasi == 'disetujui')

                                    <span class="badge bg-success">

                                        <i class="mdi mdi-check me-1"></i>

                                        Disetujui

                                    </span>

                                    @elseif($logbook->status_validasi == 'ditolak')

                                    <span class="badge bg-danger">

                                        <i class="mdi mdi-close me-1"></i>

                                        Ditolak

                                    </span>

                                    @else

                                    <span class="badge bg-warning text-dark">

                                        <i class="mdi mdi-clock-outline me-1"></i>

                                        Menunggu

                                    </span>

                                    @endif

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                @else

                <div class="text-center py-5">

                    <div
                        class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto"
                        style="width:70px;height:70px;">

                        <i
                            class="mdi mdi-book-open-outline text-muted"
                            style="font-size:35px;">
                        </i>

                    </div>

                    <h6 class="fw-bold mt-3 mb-1">
                        Belum Ada Logbook
                    </h6>

                    <p class="text-muted small mb-0">
                        Anda belum memiliki data logbook.
                    </p>

                </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection