@extends('layouts.skydash-guru')

@section('title', 'Detail Siswa Bimbingan')

@section('content')

{{-- =========================================================
     HEADER
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center flex-wrap">

                    <div class="d-flex align-items-center">

                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3">

                            <i class="mdi mdi-account-school text-white fs-4"></i>

                        </div>

                        <div>

                            <h4 class="font-weight-bold mb-1">
                                Detail Siswa Bimbingan
                            </h4>

                            <p class="text-muted mb-0 small">
                                Informasi dan monitoring siswa PKL yang Anda bimbing.
                            </p>

                        </div>

                    </div>


                    <div class="d-flex gap-2 mt-3 mt-md-0">

                        <a
                            href="{{ route('guru.siswa.laporan', $siswa->id) }}"
                            target="_blank"
                            class="btn btn-danger btn-sm">

                            <i class="mdi mdi-file-pdf-box me-1"></i>

                            Laporan PDF

                        </a>


                        <a
                            href="{{ route('guru.siswa.index') }}"
                            class="btn btn-light btn-sm">

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
     PROFIL & INFORMASI SISWA
========================================================= --}}

<div class="row">


    {{-- PROFIL --}}

    <div class="col-lg-4 grid-margin stretch-card">

        <div class="card">

            <div class="card-body text-center">


                @if($siswa->user && $siswa->user->foto_profil)

                <img
                    src="{{ $siswa->user->foto_profil }}"
                    alt="Foto {{ $siswa->user->name }}"
                    class="rounded-circle mb-3"
                    width="110"
                    height="110"
                    style="object-fit: cover;">

                @else

                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                    style="width:110px;height:110px;">

                    <i class="mdi mdi-account-outline text-muted fs-1"></i>

                </div>

                @endif


                <h5 class="font-weight-bold mb-1">

                    {{ $siswa->user->name ?? '-' }}

                </h5>


                <p class="text-muted small mb-3">

                    NISN {{ $siswa->nisn ?? '-' }}

                </p>


                <div class="d-flex justify-content-center gap-2 flex-wrap">

                    <span class="badge bg-primary">

                        <i class="mdi mdi-google-classroom me-1"></i>

                        {{ $siswa->kelas->nama_kelas ?? 'Kelas -' }}

                    </span>


                    <span class="badge bg-info">

                        <i class="mdi mdi-school-outline me-1"></i>

                        {{ $siswa->jurusan->nama_jurusan ?? 'Jurusan -' }}

                    </span>

                </div>


                <hr class="my-4">


                <div class="text-start">

                    <div class="d-flex align-items-center mb-3">

                        <i class="mdi mdi-card-account-details-outline text-primary fs-5 me-3"></i>

                        <div>

                            <small class="text-muted d-block">
                                NISN
                            </small>

                            <span class="font-weight-bold">
                                {{ $siswa->nisn ?? '-' }}
                            </span>

                        </div>

                    </div>


                    <div class="d-flex align-items-center mb-3">

                        <i class="mdi mdi-gender-male-female text-primary fs-5 me-3"></i>

                        <div>

                            <small class="text-muted d-block">
                                Jenis Kelamin
                            </small>

                            <span class="font-weight-bold">
                                {{ $siswa->jenis_kelamin ?? '-' }}
                            </span>

                        </div>

                    </div>


                    <div class="d-flex align-items-center">

                        <i class="mdi mdi-phone-outline text-primary fs-5 me-3"></i>

                        <div>

                            <small class="text-muted d-block">
                                Nomor HP
                            </small>

                            <span class="font-weight-bold">
                                {{ $siswa->no_hp ?? '-' }}
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- INFORMASI SISWA --}}

    <div class="col-lg-8 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex align-items-center mb-4">

                    <i class="mdi mdi-account-details-outline text-primary fs-4 me-2"></i>

                    <h5 class="card-title mb-0">
                        Informasi Siswa
                    </h5>

                </div>


                <div class="row">


                    <div class="col-md-6 mb-4">

                        <small class="text-muted d-block mb-1">
                            Nama Lengkap
                        </small>

                        <h6 class="font-weight-bold mb-0">
                            {{ $siswa->user->name ?? '-' }}
                        </h6>

                    </div>


                    <div class="col-md-6 mb-4">

                        <small class="text-muted d-block mb-1">
                            NISN
                        </small>

                        <h6 class="font-weight-bold mb-0">
                            {{ $siswa->nisn ?? '-' }}
                        </h6>

                    </div>


                    <div class="col-md-6 mb-4">

                        <small class="text-muted d-block mb-1">
                            Jenis Kelamin
                        </small>

                        <h6 class="font-weight-bold mb-0">
                            {{ $siswa->jenis_kelamin ?? '-' }}
                        </h6>

                    </div>


                    <div class="col-md-6 mb-4">

                        <small class="text-muted d-block mb-1">
                            Kelas
                        </small>

                        <h6 class="font-weight-bold mb-0">
                            {{ $siswa->kelas->nama_kelas ?? '-' }}
                        </h6>

                    </div>


                    <div class="col-md-6 mb-4">

                        <small class="text-muted d-block mb-1">
                            Jurusan
                        </small>

                        <h6 class="font-weight-bold mb-0">
                            {{ $siswa->jurusan->nama_jurusan ?? '-' }}
                        </h6>

                    </div>


                    <div class="col-md-6 mb-4">

                        <small class="text-muted d-block mb-1">
                            Nomor HP
                        </small>

                        <h6 class="font-weight-bold mb-0">
                            {{ $siswa->no_hp ?? '-' }}
                        </h6>

                    </div>


                    <div class="col-md-6 mb-4">

                        <small class="text-muted d-block mb-1">
                            Tempat Lahir
                        </small>

                        <h6 class="font-weight-bold mb-0">
                            {{ $siswa->tempat_lahir ?? '-' }}
                        </h6>

                    </div>


                    <div class="col-md-6 mb-4">

                        <small class="text-muted d-block mb-1">
                            Tanggal Lahir
                        </small>

                        <h6 class="font-weight-bold mb-0">

                            @if($siswa->tanggal_lahir)

                            {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('d F Y') }}

                            @else

                            -

                            @endif

                        </h6>

                    </div>


                    <div class="col-12">

                        <small class="text-muted d-block mb-2">
                            Alamat
                        </small>

                        <div class="bg-light rounded p-3">

                            <i class="mdi mdi-map-marker-outline text-primary me-2"></i>

                            {{ $siswa->alamat ?? '-' }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     PENEMPATAN PKL
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">

                    <div class="d-flex align-items-center">

                        <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3">

                            <i class="mdi mdi-briefcase-outline text-primary fs-5"></i>

                        </div>

                        <div>

                            <h5 class="card-title mb-1">
                                Penempatan PKL
                            </h5>

                            <p class="text-muted small mb-0">
                                Informasi tempat pelaksanaan PKL siswa.
                            </p>

                        </div>

                    </div>


                    @if($penempatan)

                    @if($penempatan->status_pkl === 'aktif')

                    <span class="badge bg-success">

                        <i class="mdi mdi-check-circle-outline me-1"></i>

                        Aktif

                    </span>

                    @elseif($penempatan->status_pkl === 'selesai')

                    <span class="badge bg-primary">

                        <i class="mdi mdi-check-all me-1"></i>

                        Selesai

                    </span>

                    @else

                    <span class="badge bg-warning text-dark">

                        {{ ucfirst($penempatan->status_pkl ?? '-') }}

                    </span>

                    @endif

                    @endif

                </div>


                @if($penempatan)

                <div class="row">


                    <div class="col-lg-4 col-md-6 mb-4">

                        <div class="d-flex align-items-start">

                            <i class="mdi mdi-domain text-primary fs-4 me-3"></i>

                            <div>

                                <small class="text-muted d-block">
                                    Perusahaan
                                </small>

                                <h6 class="font-weight-bold mb-0">

                                    {{ $penempatan->perusahaan->nama_perusahaan ?? '-' }}

                                </h6>

                            </div>

                        </div>

                    </div>


                    <div class="col-lg-4 col-md-6 mb-4">

                        <div class="d-flex align-items-start">

                            <i class="mdi mdi-account-tie-outline text-primary fs-4 me-3"></i>

                            <div>

                                <small class="text-muted d-block">
                                    Pembimbing Guru
                                </small>

                                <h6 class="font-weight-bold mb-0">

                                    {{ $penempatan->guru->user->name ?? '-' }}

                                </h6>

                            </div>

                        </div>

                    </div>


                    <div class="col-lg-4 col-md-6 mb-4">

                        <div class="d-flex align-items-start">

                            <i class="mdi mdi-account-supervisor-outline text-primary fs-4 me-3"></i>

                            <div>

                                <small class="text-muted d-block">
                                    Pembimbing Industri
                                </small>

                                <h6 class="font-weight-bold mb-0">

                                    {{ $penempatan->industri->user->name ?? '-' }}

                                </h6>

                            </div>

                        </div>

                    </div>


                    <div class="col-lg-3 col-md-6">

                        <div class="d-flex align-items-start">

                            <i class="mdi mdi-calendar-start text-success fs-4 me-3"></i>

                            <div>

                                <small class="text-muted d-block">
                                    Tanggal Mulai
                                </small>

                                <h6 class="font-weight-bold mb-0">

                                    @if($penempatan->tanggal_mulai)

                                    {{ \Carbon\Carbon::parse($penempatan->tanggal_mulai)->translatedFormat('d F Y') }}

                                    @else

                                    -

                                    @endif

                                </h6>

                            </div>

                        </div>

                    </div>


                    <div class="col-lg-3 col-md-6">

                        <div class="d-flex align-items-start">

                            <i class="mdi mdi-calendar-end text-danger fs-4 me-3"></i>

                            <div>

                                <small class="text-muted d-block">
                                    Tanggal Selesai
                                </small>

                                <h6 class="font-weight-bold mb-0">

                                    @if($penempatan->tanggal_selesai)

                                    {{ \Carbon\Carbon::parse($penempatan->tanggal_selesai)->translatedFormat('d F Y') }}

                                    @else

                                    -

                                    @endif

                                </h6>

                            </div>

                        </div>

                    </div>

                </div>

                @else

                <div class="alert alert-warning mb-0">

                    <i class="mdi mdi-alert-outline me-2"></i>

                    Siswa belum memiliki data penempatan PKL.

                </div>

                @endif

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     ABSENSI & LOGBOOK
========================================================= --}}

<div class="row">


    {{-- ABSENSI --}}

    <div class="col-lg-6 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>

                        <h5 class="card-title mb-1">
                            Absensi Terbaru
                        </h5>

                        <p class="text-muted small mb-0">
                            Riwayat kehadiran siswa.
                        </p>

                    </div>


                    <a
                        href="{{ route('guru.siswa.absensi', $siswa->id) }}"
                        class="btn btn-sm btn-light border">

                        Lihat Semua

                        <i class="mdi mdi-arrow-right ms-1"></i>

                    </a>

                </div>


                @if($absensis->count())

                <div class="table-responsive">

                    <table class="table table-hover">

                        <thead>

                            <tr>

                                <th>
                                    Tanggal
                                </th>

                                <th>
                                    Masuk
                                </th>

                                <th>
                                    Status
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($absensis as $absensi)

                            <tr>

                                <td>

                                    @if($absensi->tanggal)

                                    {{ \Carbon\Carbon::parse($absensi->tanggal)->format('d/m/Y') }}

                                    @else

                                    -

                                    @endif

                                </td>


                                <td>
                                    {{ $absensi->jam_masuk ?? '-' }}
                                </td>


                                <td>

                                    @if($absensi->status === 'hadir')

                                    <span class="badge bg-success">
                                        Hadir
                                    </span>

                                    @elseif($absensi->status === 'izin')

                                    <span class="badge bg-warning text-dark">
                                        Izin
                                    </span>

                                    @elseif($absensi->status === 'sakit')

                                    <span class="badge bg-info">
                                        Sakit
                                    </span>

                                    @elseif($absensi->status === 'alpha')

                                    <span class="badge bg-danger">
                                        Alpha
                                    </span>

                                    @else

                                    <span class="badge bg-secondary">
                                        {{ ucfirst($absensi->status ?? '-') }}
                                    </span>

                                    @endif

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                @else

                <div class="text-center py-4">

                    <i
                        class="mdi mdi-calendar-remove text-muted"
                        style="font-size:42px;">
                    </i>

                    <p class="text-muted small mb-0 mt-2">
                        Belum ada data absensi.
                    </p>

                </div>

                @endif

            </div>

        </div>

    </div>


    {{-- LOGBOOK --}}

    <div class="col-lg-6 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>

                        <h5 class="card-title mb-1">
                            Logbook Terbaru
                        </h5>

                        <p class="text-muted small mb-0">
                            Aktivitas PKL siswa.
                        </p>

                    </div>


                    <a
                        href="{{ route('guru.siswa.logbook', $siswa->id) }}"
                        class="btn btn-sm btn-light border">

                        Lihat Semua

                        <i class="mdi mdi-arrow-right ms-1"></i>

                    </a>

                </div>


                @if($logbooks->count())

                @foreach($logbooks as $logbook)

                <div class="border-bottom pb-3 mb-3">

                    <div class="d-flex justify-content-between align-items-start">

                        <div class="pe-3">

                            <h6 class="font-weight-bold mb-1">

                                @if($logbook->tanggal)

                                {{ \Carbon\Carbon::parse($logbook->tanggal)->format('d/m/Y') }}

                                @else

                                -

                                @endif

                            </h6>

                            <p class="text-muted small mb-0">

                                {{ \Illuminate\Support\Str::limit(
                                            $logbook->kegiatan ?? '-',
                                            90
                                        ) }}

                            </p>

                        </div>


                        @if($logbook->status_validasi === 'valid')

                        <span class="badge bg-success">
                            Valid
                        </span>

                        @elseif($logbook->status_validasi === 'ditolak')

                        <span class="badge bg-danger">
                            Ditolak
                        </span>

                        @else

                        <span class="badge bg-warning text-dark">
                            Pending
                        </span>

                        @endif

                    </div>

                </div>

                @endforeach

                @else

                <div class="text-center py-4">

                    <i
                        class="mdi mdi-book-open-page-variant text-muted"
                        style="font-size:42px;">
                    </i>

                    <p class="text-muted small mb-0 mt-2">
                        Belum ada data logbook.
                    </p>

                </div>

                @endif

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     MONITORING
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="mb-4">

                    <h5 class="card-title mb-1">
                        Monitoring Siswa
                    </h5>

                    <p class="text-muted small mb-0">
                        Akses cepat untuk memantau kegiatan PKL siswa.
                    </p>

                </div>


                <div class="row">


                    {{-- ABSENSI --}}

                    <div class="col-xl-3 col-md-6 mb-3">

                        <a
                            href="{{ route('guru.siswa.absensi', $siswa->id) }}"
                            class="text-decoration-none">

                            <div class="border rounded p-3 h-100">

                                <div class="d-flex align-items-center">

                                    <div class="bg-primary bg-opacity-10 rounded d-flex align-items-center justify-content-center me-3">

                                        <i class="mdi mdi-calendar-check text-primary fs-4"></i>

                                    </div>

                                    <div>

                                        <h6 class="font-weight-bold text-dark mb-1">
                                            Absensi
                                        </h6>

                                        <small class="text-muted">
                                            Riwayat kehadiran
                                        </small>

                                    </div>

                                </div>

                            </div>

                        </a>

                    </div>


                    {{-- LOGBOOK --}}

                    <div class="col-xl-3 col-md-6 mb-3">

                        <a
                            href="{{ route('guru.siswa.logbook', $siswa->id) }}"
                            class="text-decoration-none">

                            <div class="border rounded p-3 h-100">

                                <div class="d-flex align-items-center">

                                    <div class="bg-info bg-opacity-10 rounded d-flex align-items-center justify-content-center me-3">

                                        <i class="mdi mdi-book-open-page-variant text-info fs-4"></i>

                                    </div>

                                    <div>

                                        <h6 class="font-weight-bold text-dark mb-1">
                                            Logbook
                                        </h6>

                                        <small class="text-muted">
                                            Aktivitas PKL
                                        </small>

                                    </div>

                                </div>

                            </div>

                        </a>

                    </div>


                    {{-- PENILAIAN --}}

                    <div class="col-xl-3 col-md-6 mb-3">

                        <a
                            href="{{ route('guru.siswa.penilaian', $siswa->id) }}"
                            class="text-decoration-none">

                            <div class="border rounded p-3 h-100">

                                <div class="d-flex align-items-center">

                                    <div class="bg-warning bg-opacity-10 rounded d-flex align-items-center justify-content-center me-3">

                                        <i class="mdi mdi-star-outline text-warning fs-4"></i>

                                    </div>

                                    <div>

                                        <h6 class="font-weight-bold text-dark mb-1">
                                            Penilaian
                                        </h6>

                                        <small class="text-muted">
                                            Penilaian siswa
                                        </small>

                                    </div>

                                </div>

                            </div>

                        </a>

                    </div>


                    {{-- LAPORAN --}}

                    <div class="col-xl-3 col-md-6 mb-3">

                        <a
                            href="{{ route('guru.siswa.laporan', $siswa->id) }}"
                            target="_blank"
                            class="text-decoration-none">

                            <div class="border rounded p-3 h-100">

                                <div class="d-flex align-items-center">

                                    <div class="bg-danger bg-opacity-10 rounded d-flex align-items-center justify-content-center me-3">

                                        <i class="mdi mdi-file-pdf-box text-danger fs-4"></i>

                                    </div>

                                    <div>

                                        <h6 class="font-weight-bold text-dark mb-1">
                                            Laporan PDF
                                        </h6>

                                        <small class="text-muted">
                                            Preview laporan PKL
                                        </small>

                                    </div>

                                </div>

                            </div>

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection