@extends('layouts.skydash-guru')

@section('title', 'Dashboard Guru')

@section('content')

{{-- =========================================================
     HEADER
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center flex-wrap">

                    <div>

                        <div class="d-flex align-items-center mb-2">

                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3"
                                style="width:48px;height:48px;">

                                <i class="mdi mdi-account-tie text-white"
                                    style="font-size:23px;"></i>

                            </div>

                            <div>

                                <p class="text-muted mb-0 small">
                                    Dashboard Guru Pembimbing
                                </p>

                                <h4 class="font-weight-bold mb-0">
                                    Selamat Datang, {{ $guru->user->name ?? 'Guru' }}
                                </h4>

                            </div>

                        </div>

                        <p class="text-muted mb-0 small">

                            Pantau siswa bimbingan, kegiatan PKL,
                            logbook, absensi, dan penilaian melalui
                            dashboard ini.

                        </p>

                    </div>


                    <div class="mt-3 mt-md-0">

                        <span class="badge bg-light text-dark border px-3 py-2">

                            <i class="mdi mdi-calendar-outline text-primary me-1"></i>

                            {{ now()->translatedFormat('d F Y') }}

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     STATISTIK UTAMA
========================================================= --}}

<div class="row">

    {{-- TOTAL SISWA --}}

    <div class="col-xl-3 col-md-6 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <p class="text-muted mb-2 small">
                            Total Siswa
                        </p>

                        <h2 class="font-weight-bold mb-1">
                            {{ $totalSiswa }}
                        </h2>

                        <small class="text-muted">
                            Siswa bimbingan
                        </small>

                    </div>

                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                        style="width:50px;height:50px;">

                        <i class="mdi mdi-account-group-outline text-white"
                            style="font-size:24px;"></i>

                    </div>

                </div>

                <div class="mt-3">

                    <span class="text-success small">
                        <i class="mdi mdi-account-check-outline me-1"></i>
                        {{ $siswaAktif }} aktif
                    </span>

                </div>

            </div>

        </div>

    </div>


    {{-- SISWA AKTIF --}}

    <div class="col-xl-3 col-md-6 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <p class="text-muted mb-2 small">
                            PKL Aktif
                        </p>

                        <h2 class="font-weight-bold mb-1">
                            {{ $siswaAktif }}
                        </h2>

                        <small class="text-muted">
                            Sedang menjalani PKL
                        </small>

                    </div>

                    <div class="bg-success rounded-circle d-flex align-items-center justify-content-center"
                        style="width:50px;height:50px;">

                        <i class="mdi mdi-briefcase-check-outline text-white"
                            style="font-size:24px;"></i>

                    </div>

                </div>

                <div class="mt-3">

                    <span class="text-muted small">

                        {{ $siswaSelesai }} siswa selesai

                    </span>

                </div>

            </div>

        </div>

    </div>


    {{-- LOGBOOK --}}

    <div class="col-xl-3 col-md-6 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <p class="text-muted mb-2 small">
                            Logbook Pending
                        </p>

                        <h2 class="font-weight-bold mb-1">
                            {{ $logbookPending }}
                        </h2>

                        <small class="text-muted">
                            Menunggu validasi
                        </small>

                    </div>

                    <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center"
                        style="width:50px;height:50px;">

                        <i class="mdi mdi-book-open-page-variant text-white"
                            style="font-size:24px;"></i>

                    </div>

                </div>

                <div class="mt-3">

                    <span class="text-primary small">

                        {{ $logbookValid }} sudah valid

                    </span>

                </div>

            </div>

        </div>

    </div>


    {{-- ABSENSI --}}

    <div class="col-xl-3 col-md-6 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <p class="text-muted mb-2 small">
                            Absensi Hari Ini
                        </p>

                        <h2 class="font-weight-bold mb-1">
                            {{ $absensiHariIni }}
                        </h2>

                        <small class="text-muted">
                            Total kehadiran tercatat
                        </small>

                    </div>

                    <div class="bg-info rounded-circle d-flex align-items-center justify-content-center"
                        style="width:50px;height:50px;">

                        <i class="mdi mdi-calendar-check-outline text-white"
                            style="font-size:24px;"></i>

                    </div>

                </div>

                <div class="mt-3">

                    <span class="text-success small">

                        {{ $hadirHariIni }} siswa hadir

                    </span>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     RINGKASAN
========================================================= --}}

<div class="row">

    {{-- STATUS PKL --}}

    <div class="col-lg-4 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>

                        <h5 class="card-title mb-1">
                            Status PKL
                        </h5>

                        <p class="card-description mb-0">
                            Kondisi siswa bimbingan
                        </p>

                    </div>

                    <i class="mdi mdi-briefcase-outline text-primary"
                        style="font-size:25px;"></i>

                </div>


                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div class="d-flex align-items-center">

                        <span class="bg-success rounded-circle me-2"
                            style="width:9px;height:9px;"></span>

                        <span class="text-muted">
                            Aktif
                        </span>

                    </div>

                    <strong>
                        {{ $siswaAktif }}
                    </strong>

                </div>


                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div class="d-flex align-items-center">

                        <span class="bg-primary rounded-circle me-2"
                            style="width:9px;height:9px;"></span>

                        <span class="text-muted">
                            Selesai
                        </span>

                    </div>

                    <strong>
                        {{ $siswaSelesai }}
                    </strong>

                </div>


                <div class="d-flex justify-content-between align-items-center">

                    <div class="d-flex align-items-center">

                        <span class="bg-secondary rounded-circle me-2"
                            style="width:9px;height:9px;"></span>

                        <span class="text-muted">
                            Total
                        </span>

                    </div>

                    <strong>
                        {{ $totalSiswa }}
                    </strong>

                </div>

            </div>

        </div>

    </div>


    {{-- STATUS LOGBOOK --}}

    <div class="col-lg-4 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>

                        <h5 class="card-title mb-1">
                            Status Logbook
                        </h5>

                        <p class="card-description mb-0">
                            Rekapitulasi validasi
                        </p>

                    </div>

                    <i class="mdi mdi-book-open-outline text-warning"
                        style="font-size:25px;"></i>

                </div>


                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div class="d-flex align-items-center">

                        <span class="bg-warning rounded-circle me-2"
                            style="width:9px;height:9px;"></span>

                        <span class="text-muted">
                            Menunggu
                        </span>

                    </div>

                    <strong>
                        {{ $logbookPending }}
                    </strong>

                </div>


                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div class="d-flex align-items-center">

                        <span class="bg-success rounded-circle me-2"
                            style="width:9px;height:9px;"></span>

                        <span class="text-muted">
                            Valid
                        </span>

                    </div>

                    <strong>
                        {{ $logbookValid }}
                    </strong>

                </div>


                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div class="d-flex align-items-center">

                        <span class="bg-danger rounded-circle me-2"
                            style="width:9px;height:9px;"></span>

                        <span class="text-muted">
                            Ditolak
                        </span>

                    </div>

                    <strong>
                        {{ $logbookDitolak }}
                    </strong>

                </div>


                <div class="border-top pt-3">

                    <div class="d-flex justify-content-between">

                        <span class="text-muted small">
                            Total Logbook
                        </span>

                        <strong>
                            {{ $totalLogbook }}
                        </strong>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ABSENSI HARI INI --}}

    <div class="col-lg-4 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>

                        <h5 class="card-title mb-1">
                            Absensi Hari Ini
                        </h5>

                        <p class="card-description mb-0">
                            Rekap kehadiran siswa
                        </p>

                    </div>

                    <i class="mdi mdi-calendar-check-outline text-success"
                        style="font-size:25px;"></i>

                </div>


                <div class="d-flex justify-content-between mb-3">

                    <span class="text-muted">
                        Hadir
                    </span>

                    <span class="badge bg-success">
                        {{ $hadirHariIni }}
                    </span>

                </div>


                <div class="d-flex justify-content-between mb-3">

                    <span class="text-muted">
                        Izin
                    </span>

                    <span class="badge bg-warning text-dark">
                        {{ $izinHariIni }}
                    </span>

                </div>


                <div class="d-flex justify-content-between mb-3">

                    <span class="text-muted">
                        Sakit
                    </span>

                    <span class="badge bg-info">
                        {{ $sakitHariIni }}
                    </span>

                </div>


                <div class="d-flex justify-content-between">

                    <span class="text-muted">
                        Alpha
                    </span>

                    <span class="badge bg-danger">
                        {{ $alphaHariIni }}
                    </span>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     SISWA BIMBINGAN
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">

                    <div>

                        <h5 class="card-title mb-1">
                            Siswa Bimbingan
                        </h5>

                        <p class="card-description mb-0">
                            Daftar siswa terbaru yang berada dalam bimbingan Anda.
                        </p>

                    </div>


                    <a
                        href="{{ route('guru.siswa.index') }}"
                        class="btn btn-primary btn-sm mt-2 mt-md-0">

                        <i class="mdi mdi-account-group-outline me-1"></i>

                        Lihat Semua

                    </a>

                </div>


                @if($siswaBimbingan->count())

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead>

                            <tr>

                                <th>
                                    #
                                </th>

                                <th>
                                    Siswa
                                </th>

                                <th>
                                    NISN
                                </th>

                                <th>
                                    Jurusan
                                </th>

                                <th>
                                    Kelas
                                </th>

                                <th>
                                    Industri
                                </th>

                                <th>
                                    Status
                                </th>

                                <th class="text-center">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($siswaBimbingan as $index => $penempatan)

                            <tr>

                                <td>
                                    {{ $index + 1 }}
                                </td>


                                <td>

                                    <div class="d-flex align-items-center">

                                        @if(
                                        $penempatan->siswa &&
                                        $penempatan->siswa->user &&
                                        $penempatan->siswa->user->foto_profil
                                        )

                                        <img
                                            src="{{ $penempatan->siswa->user->foto_profil }}"
                                            width="40"
                                            height="40"
                                            class="rounded-circle me-3"
                                            alt="Foto">

                                        @else

                                        <div
                                            class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3"
                                            style="width:40px;height:40px;">

                                            <i class="mdi mdi-account-outline text-muted"></i>

                                        </div>

                                        @endif


                                        <div>

                                            <h6 class="font-weight-bold mb-0">

                                                {{ $penempatan->siswa->user->name ?? '-' }}

                                            </h6>

                                            <small class="text-muted">

                                                Siswa PKL

                                            </small>

                                        </div>

                                    </div>

                                </td>


                                <td>

                                    {{ $penempatan->siswa->nisn ?? '-' }}

                                </td>


                                <td>

                                    {{ $penempatan->siswa->jurusan->nama_jurusan ?? '-' }}

                                </td>


                                <td>

                                    {{ $penempatan->siswa->kelas->nama_kelas ?? '-' }}

                                </td>


                                <td>

                                    {{ $penempatan->perusahaan->nama_perusahaan ?? '-' }}

                                </td>


                                <td>

                                    @if($penempatan->status_pkl === 'aktif')

                                    <span class="badge bg-success">
                                        Aktif
                                    </span>

                                    @elseif($penempatan->status_pkl === 'selesai')

                                    <span class="badge bg-primary">
                                        Selesai
                                    </span>

                                    @elseif($penempatan->status_pkl === 'pending')

                                    <span class="badge bg-warning text-dark">
                                        Pending
                                    </span>

                                    @else

                                    <span class="badge bg-secondary">
                                        {{ ucfirst($penempatan->status_pkl ?? '-') }}
                                    </span>

                                    @endif

                                </td>


                                <td class="text-center">

                                    @if($penempatan->siswa)

                                    <a
                                        href="{{ route(
                                                        'guru.siswa.show',
                                                        $penempatan->siswa->id
                                                    ) }}"
                                        class="btn btn-outline-primary btn-sm"
                                        title="Detail">

                                        <i class="mdi mdi-eye-outline"></i>

                                    </a>

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
                        class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                        style="width:80px;height:80px;">

                        <i
                            class="mdi mdi-account-search-outline text-muted"
                            style="font-size:38px;">
                        </i>

                    </div>


                    <h6 class="font-weight-bold">
                        Belum Ada Siswa Bimbingan
                    </h6>


                    <p class="text-muted small mb-0">

                        Belum terdapat siswa yang ditempatkan
                        pada bimbingan Anda.

                    </p>

                </div>

                @endif

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     AKTIVITAS TERBARU
========================================================= --}}

<div class="row">


    {{-- LOGBOOK TERBARU --}}

    <div class="col-lg-6 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>

                        <h5 class="card-title mb-1">
                            Logbook Terbaru
                        </h5>

                        <p class="card-description mb-0">
                            Aktivitas logbook siswa terbaru.
                        </p>

                    </div>


                    <a
                        href="{{ route('guru.logbook.index') }}"
                        class="btn btn-outline-primary btn-sm">

                        Lihat Semua

                    </a>

                </div>


                @forelse($logbookTerbaru as $logbook)

                <div class="d-flex align-items-start border-bottom pb-3 mb-3">

                    <div
                        class="bg-warning rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                        style="width:40px;height:40px;">

                        <i class="mdi mdi-book-open-page-variant text-white"></i>

                    </div>


                    <div class="flex-grow-1">

                        <h6 class="font-weight-bold mb-1">

                            {{ $logbook->siswa->user->name ?? 'Siswa' }}

                        </h6>


                        <p class="text-muted small mb-1">

                            {{ \Illuminate\Support\Str::limit($logbook->kegiatan ?? $logbook->deskripsi ?? '-', 70) }}

                        </p>


                        <small class="text-muted">

                            <i class="mdi mdi-calendar-outline me-1"></i>

                            {{ $logbook->tanggal ? \Carbon\Carbon::parse($logbook->tanggal)->translatedFormat('d F Y') : '-' }}

                        </small>

                    </div>


                    <div>

                        @if($logbook->status_validasi === 'pending')

                        <span class="badge bg-warning text-dark">
                            Pending
                        </span>

                        @elseif($logbook->status_validasi === 'valid')

                        <span class="badge bg-success">
                            Valid
                        </span>

                        @elseif($logbook->status_validasi === 'ditolak')

                        <span class="badge bg-danger">
                            Ditolak
                        </span>

                        @else

                        <span class="badge bg-secondary">
                            -
                        </span>

                        @endif

                    </div>

                </div>

                @empty

                <div class="text-center py-4">

                    <i
                        class="mdi mdi-book-open-outline text-muted"
                        style="font-size:40px;">
                    </i>

                    <p class="text-muted small mt-2 mb-0">
                        Belum ada logbook terbaru.
                    </p>

                </div>

                @endforelse

            </div>

        </div>

    </div>


    {{-- ABSENSI TERBARU --}}

    <div class="col-lg-6 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>

                        <h5 class="card-title mb-1">
                            Absensi Terbaru
                        </h5>

                        <p class="card-description mb-0">
                            Data kehadiran siswa terbaru.
                        </p>

                    </div>


                    <a
                        href="{{ route('guru.absensi.index') }}"
                        class="btn btn-outline-primary btn-sm">

                        Lihat Semua

                    </a>

                </div>


                @forelse($absensiTerbaru as $absensi)

                <div class="d-flex align-items-center border-bottom pb-3 mb-3">

                    <div
                        class="bg-success rounded-circle d-flex align-items-center justify-content-center me-3"
                        style="width:40px;height:40px;">

                        <i class="mdi mdi-calendar-check-outline text-white"></i>

                    </div>


                    <div class="flex-grow-1">

                        <h6 class="font-weight-bold mb-1">

                            {{ $absensi->siswa->user->name ?? 'Siswa' }}

                        </h6>


                        <small class="text-muted">

                            {{ $absensi->tanggal ? \Carbon\Carbon::parse($absensi->tanggal)->translatedFormat('d F Y') : '-' }}

                        </small>

                    </div>


                    <div>

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

                    </div>

                </div>

                @empty

                <div class="text-center py-4">

                    <i
                        class="mdi mdi-calendar-remove-outline text-muted"
                        style="font-size:40px;">
                    </i>

                    <p class="text-muted small mt-2 mb-0">
                        Belum ada data absensi terbaru.
                    </p>

                </div>

                @endforelse

            </div>

        </div>

    </div>

</div>

@endsection