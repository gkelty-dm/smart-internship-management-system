@extends('layouts.skydash-guru')

@section('title', 'Detail Absensi')

@section('content')

{{-- =========================================================
     HEADER
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body py-3">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                    <div class="d-flex align-items-center">

                        <div
                            class="bg-primary rounded-3 d-flex align-items-center justify-content-center me-3"
                            style="width:46px;height:46px;">

                            <i
                                class="mdi mdi-calendar-check text-white"
                                style="font-size:23px;">
                            </i>

                        </div>

                        <div>

                            <h4 class="fw-bold mb-1">
                                Detail Absensi
                            </h4>

                            <p class="text-muted small mb-0">
                                Informasi lengkap kehadiran siswa.
                            </p>

                        </div>

                    </div>


                    <a href="{{ route('guru.absensi.index') }}"
                        class="btn btn-light btn-sm border">

                        <i class="mdi mdi-arrow-left me-1"></i>

                        Kembali

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     DETAIL
========================================================= --}}

<div class="row">

    {{-- =====================================================
         PROFIL SISWA
    ====================================================== --}}

    <div class="col-lg-4 grid-margin stretch-card">

        <div class="card h-100">

            <div class="card-body">

                <div class="text-center">

                    {{-- FOTO PROFIL --}}

                    @if(
                    $absensi->siswa &&
                    $absensi->siswa->user &&
                    $absensi->siswa->user->foto_profil
                    )

                    <img
                        src="{{ $absensi->siswa->user->foto_profil }}"
                        width="110"
                        height="110"
                        class="rounded-circle mb-3"
                        style="object-fit:cover;"
                        alt="Foto {{ $absensi->siswa->user->name }}">

                    @else

                    <div
                        class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3"
                        style="width:110px;height:110px;">

                        <i
                            class="mdi mdi-account-outline text-muted"
                            style="font-size:55px;">
                        </i>

                    </div>

                    @endif


                    <h5 class="fw-bold mb-1">

                        {{ $absensi->siswa->user->name ?? '-' }}

                    </h5>


                    <p class="text-muted small mb-3">

                        <i class="mdi mdi-card-account-details-outline me-1"></i>

                        NISN:
                        {{ $absensi->siswa->nisn ?? '-' }}

                    </p>


                    <span class="badge bg-primary rounded-pill px-3 py-2">

                        <i class="mdi mdi-google-classroom me-1"></i>

                        {{ $absensi->siswa->kelas->nama_kelas ?? 'Kelas -' }}

                    </span>

                </div>


                <hr class="my-4">


                {{-- RINGKASAN --}}

                <div>

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <span class="text-muted small">
                            Status Kehadiran
                        </span>

                        <span class="badge bg-success rounded-pill px-3 py-2">

                            <i class="mdi mdi-check-circle-outline me-1"></i>

                            Hadir

                        </span>

                    </div>


                    <div class="d-flex justify-content-between align-items-center">

                        <span class="text-muted small">
                            Metode Verifikasi
                        </span>

                        <span class="fw-semibold small text-end">

                            {{ $absensi->metode_verifikasi ?? '-' }}

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         INFORMASI ABSENSI
    ====================================================== --}}

    <div class="col-lg-8 grid-margin stretch-card">

        <div class="card h-100">

            <div class="card-body">

                <div class="d-flex align-items-center mb-4">

                    <div
                        class="bg-primary bg-opacity-10 rounded-3 d-flex align-items-center justify-content-center me-3"
                        style="width:44px;height:44px;">

                        <i
                            class="mdi mdi-information-outline text-primary"
                            style="font-size:22px;">
                        </i>

                    </div>

                    <div>

                        <h5 class="card-title mb-1">
                            Informasi Absensi
                        </h5>

                        <p class="text-muted small mb-0">
                            Detail waktu dan verifikasi kehadiran.
                        </p>

                    </div>

                </div>


                {{-- INFORMASI UTAMA --}}

                <div class="row">


                    {{-- TANGGAL --}}

                    <div class="col-md-6 mb-4">

                        <div class="bg-light rounded-3 p-3 h-100">

                            <div class="d-flex align-items-center mb-2">

                                <div
                                    class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-2"
                                    style="width:34px;height:34px;">

                                    <i
                                        class="mdi mdi-calendar-outline text-white">
                                    </i>

                                </div>

                                <small class="text-muted">
                                    Tanggal
                                </small>

                            </div>

                            <h6 class="fw-bold mb-0">

                                {{ $absensi->tanggal
                                    ? \Carbon\Carbon::parse(
                                        $absensi->tanggal
                                    )->translatedFormat('d F Y')
                                    : '-' }}

                            </h6>

                        </div>

                    </div>


                    {{-- STATUS --}}

                    <div class="col-md-6 mb-4">

                        <div class="bg-light rounded-3 p-3 h-100">

                            <div class="d-flex align-items-center mb-2">

                                <div
                                    class="bg-success rounded-circle d-flex align-items-center justify-content-center me-2"
                                    style="width:34px;height:34px;">

                                    <i
                                        class="mdi mdi-check text-white">
                                    </i>

                                </div>

                                <small class="text-muted">
                                    Status
                                </small>

                            </div>

                            <span class="badge bg-success rounded-pill px-3 py-2">

                                <i class="mdi mdi-check-circle-outline me-1"></i>

                                Hadir

                            </span>

                        </div>

                    </div>


                    {{-- JAM MASUK --}}

                    <div class="col-md-6 mb-4">

                        <div class="bg-light rounded-3 p-3 h-100">

                            <div class="d-flex align-items-center mb-2">

                                <div
                                    class="bg-success rounded-circle d-flex align-items-center justify-content-center me-2"
                                    style="width:34px;height:34px;">

                                    <i
                                        class="mdi mdi-login text-white">
                                    </i>

                                </div>

                                <small class="text-muted">
                                    Jam Masuk
                                </small>

                            </div>

                            <h5 class="fw-bold mb-0 text-success">

                                {{ $absensi->jam_masuk ?? '-' }}

                            </h5>

                        </div>

                    </div>


                    {{-- JAM PULANG --}}

                    <div class="col-md-6 mb-4">

                        <div class="bg-light rounded-3 p-3 h-100">

                            <div class="d-flex align-items-center mb-2">

                                <div
                                    class="bg-danger rounded-circle d-flex align-items-center justify-content-center me-2"
                                    style="width:34px;height:34px;">

                                    <i
                                        class="mdi mdi-logout text-white">
                                    </i>

                                </div>

                                <small class="text-muted">
                                    Jam Pulang
                                </small>

                            </div>

                            <h5 class="fw-bold mb-0 text-danger">

                                {{ $absensi->jam_pulang ?? '-' }}

                            </h5>

                        </div>

                    </div>


                    {{-- METODE VERIFIKASI --}}

                    <div class="col-md-6 mb-4">

                        <div class="bg-light rounded-3 p-3 h-100">

                            <div class="d-flex align-items-center mb-2">

                                <div
                                    class="bg-info rounded-circle d-flex align-items-center justify-content-center me-2"
                                    style="width:34px;height:34px;">

                                    <i
                                        class="mdi mdi-shield-check-outline text-white">
                                    </i>

                                </div>

                                <small class="text-muted">
                                    Metode Verifikasi
                                </small>

                            </div>

                            <h6 class="fw-semibold mb-0">

                                {{ $absensi->metode_verifikasi ?? '-' }}

                            </h6>

                        </div>

                    </div>


                    {{-- IP ADDRESS --}}

                    <div class="col-md-6 mb-4">

                        <div class="bg-light rounded-3 p-3 h-100">

                            <div class="d-flex align-items-center mb-2">

                                <div
                                    class="bg-secondary rounded-circle d-flex align-items-center justify-content-center me-2"
                                    style="width:34px;height:34px;">

                                    <i
                                        class="mdi mdi-ip text-white">
                                    </i>

                                </div>

                                <small class="text-muted">
                                    IP Address
                                </small>

                            </div>

                            <h6 class="fw-semibold mb-0">

                                {{ $absensi->ip_address ?? '-' }}

                            </h6>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     FOTO ABSENSI
                ================================================== --}}

                @if($absensi->foto_masuk || $absensi->foto_pulang)

                <div class="border-top pt-4 mt-2">

                    <div class="d-flex align-items-center mb-4">

                        <div
                            class="bg-primary bg-opacity-10 rounded-3 d-flex align-items-center justify-content-center me-3"
                            style="width:42px;height:42px;">

                            <i
                                class="mdi mdi-camera-outline text-primary"
                                style="font-size:21px;">
                            </i>

                        </div>

                        <div>

                            <h5 class="fw-bold mb-1">
                                Foto Absensi
                            </h5>

                            <p class="text-muted small mb-0">
                                Dokumentasi foto saat melakukan absensi.
                            </p>

                        </div>

                    </div>


                    <div class="row">


                        {{-- FOTO MASUK --}}

                        @if($absensi->foto_masuk)

                        <div class="col-md-6 mb-4">

                            <div class="card border shadow-none h-100">

                                <div class="card-body p-2">

                                    <div class="d-flex justify-content-between align-items-center px-2 py-2">

                                        <span class="fw-semibold small">

                                            <i
                                                class="mdi mdi-login text-success me-1">
                                            </i>

                                            Foto Masuk

                                        </span>

                                    </div>


                                    <img
                                        src="{{ asset('storage/' . $absensi->foto_masuk) }}"
                                        class="img-fluid rounded"
                                        style="width:100%;height:260px;object-fit:cover;"
                                        alt="Foto Masuk">

                                </div>

                            </div>

                        </div>

                        @endif


                        {{-- FOTO PULANG --}}

                        @if($absensi->foto_pulang)

                        <div class="col-md-6 mb-4">

                            <div class="card border shadow-none h-100">

                                <div class="card-body p-2">

                                    <div class="d-flex justify-content-between align-items-center px-2 py-2">

                                        <span class="fw-semibold small">

                                            <i
                                                class="mdi mdi-logout text-danger me-1">
                                            </i>

                                            Foto Pulang

                                        </span>

                                    </div>


                                    <img
                                        src="{{ asset('storage/' . $absensi->foto_pulang) }}"
                                        class="img-fluid rounded"
                                        style="width:100%;height:260px;object-fit:cover;"
                                        alt="Foto Pulang">

                                </div>

                            </div>

                        </div>

                        @endif

                    </div>

                </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection