@extends('layouts.skydash-guru')

@section('title', 'Detail Logbook')

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

                        <div
                            class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3"
                            style="width:46px;height:46px;">

                            <i
                                class="mdi mdi-book-open-page-variant text-white"
                                style="font-size:23px;">
                            </i>

                        </div>

                        <div>

                            <h4 class="font-weight-bold mb-1">
                                Detail Logbook
                            </h4>

                            <p class="text-muted mb-0 small">
                                Detail kegiatan dan validasi logbook siswa.
                            </p>

                        </div>

                    </div>


                    <a
                        href="{{ route('guru.logbook.index') }}"
                        class="btn btn-light btn-sm mt-3 mt-md-0">

                        <i class="mdi mdi-arrow-left me-1"></i>

                        Kembali

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     INFORMASI SISWA
========================================================= --}}

<div class="row">

    <div class="col-lg-4 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="text-center">

                    @if(
                    $logbook->siswa &&
                    $logbook->siswa->user &&
                    $logbook->siswa->user->foto_profil
                    )

                    <img
                        src="{{ $logbook->siswa->user->foto_profil }}"
                        width="110"
                        height="110"
                        class="rounded-circle mb-3"
                        style="object-fit:cover;"
                        alt="Foto Siswa">

                    @else

                    <div
                        class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                        style="width:110px;height:110px;">

                        <i
                            class="mdi mdi-account-school-outline text-primary"
                            style="font-size:55px;">
                        </i>

                    </div>

                    @endif


                    <h5 class="font-weight-bold mb-1">

                        {{ $logbook->siswa->user->name ?? '-' }}

                    </h5>


                    <p class="text-muted mb-3">

                        {{ $logbook->siswa->user->email ?? '-' }}

                    </p>


                    <span class="badge bg-primary px-3 py-2">

                        <i class="mdi mdi-google-classroom me-1"></i>

                        {{ $logbook->siswa->kelas->nama_kelas ?? 'Kelas -' }}

                    </span>

                </div>


                <div class="border-top mt-4 pt-4">

                    <div class="mb-3">

                        <small class="text-muted d-block mb-1">
                            NISN
                        </small>

                        <span class="font-weight-bold">
                            {{ $logbook->siswa->nisn ?? '-' }}
                        </span>

                    </div>


                    <div class="mb-3">

                        <small class="text-muted d-block mb-1">
                            Jurusan
                        </small>

                        <span class="font-weight-bold">
                            {{ $logbook->siswa->jurusan->nama_jurusan ?? '-' }}
                        </span>

                    </div>


                    <div>

                        <small class="text-muted d-block mb-1">
                            Tanggal Logbook
                        </small>

                        <span class="font-weight-bold">

                            {{ $logbook->tanggal
                                ? \Carbon\Carbon::parse($logbook->tanggal)->translatedFormat('d F Y')
                                : '-' }}

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         DETAIL KEGIATAN
    ========================================================== --}}

    <div class="col-lg-8 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">

                    <div>

                        <h5 class="card-title mb-1">
                            Informasi Kegiatan
                        </h5>

                        <small class="text-muted">
                            Detail aktivitas PKL siswa.
                        </small>

                    </div>


                    @if($logbook->status_validasi === 'disetujui')

                    <span class="badge bg-success">

                        <i class="mdi mdi-check-circle-outline me-1"></i>

                        Disetujui

                    </span>

                    @elseif($logbook->status_validasi === 'ditolak')

                    <span class="badge bg-danger">

                        <i class="mdi mdi-close-circle-outline me-1"></i>

                        Ditolak

                    </span>

                    @else

                    <span class="badge bg-warning text-dark">

                        <i class="mdi mdi-clock-outline me-1"></i>

                        Pending

                    </span>

                    @endif

                </div>


                {{-- TANGGAL --}}

                <div class="mb-4">

                    <div class="d-flex align-items-center mb-2">

                        <i class="mdi mdi-calendar-outline text-primary me-2"></i>

                        <small class="font-weight-bold">
                            Tanggal Kegiatan
                        </small>

                    </div>

                    <div class="bg-light rounded p-3">

                        {{ $logbook->tanggal
                            ? \Carbon\Carbon::parse($logbook->tanggal)->translatedFormat('d F Y')
                            : '-' }}

                    </div>

                </div>


                {{-- KEGIATAN --}}

                <div class="mb-4">

                    <div class="d-flex align-items-center mb-2">

                        <i class="mdi mdi-clipboard-text-outline text-primary me-2"></i>

                        <small class="font-weight-bold">
                            Kegiatan
                        </small>

                    </div>

                    <div class="bg-light rounded p-3">

                        {{ $logbook->kegiatan ?? '-' }}

                    </div>

                </div>


                {{-- KENDALA --}}

                <div class="mb-4">

                    <div class="d-flex align-items-center mb-2">

                        <i class="mdi mdi-alert-circle-outline text-warning me-2"></i>

                        <small class="font-weight-bold">
                            Kendala
                        </small>

                    </div>

                    <div class="bg-light rounded p-3">

                        {{ $logbook->kendala ?? '-' }}

                    </div>

                </div>


                {{-- SOLUSI --}}

                <div>

                    <div class="d-flex align-items-center mb-2">

                        <i class="mdi mdi-lightbulb-outline text-success me-2"></i>

                        <small class="font-weight-bold">
                            Solusi
                        </small>

                    </div>

                    <div class="bg-light rounded p-3">

                        {{ $logbook->solusi ?? '-' }}

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     DOKUMENTASI KEGIATAN
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex align-items-center mb-4">

                    <div
                        class="bg-primary bg-opacity-10 rounded d-flex align-items-center justify-content-center me-3"
                        style="width:42px;height:42px;">

                        <i
                            class="mdi mdi-image-multiple-outline text-primary"
                            style="font-size:22px;">
                        </i>

                    </div>

                    <div>

                        <h5 class="card-title mb-1">
                            Dokumentasi Kegiatan
                        </h5>

                        <small class="text-muted">
                            Foto kegiatan yang diunggah siswa.
                        </small>

                    </div>

                </div>


                @if($logbook->fotos && $logbook->fotos->count())

                <div class="row">

                    @foreach($logbook->fotos as $foto)

                    <div class="col-md-4 col-lg-3 mb-4">

                        <div class="border rounded p-2">

                            <img
                                src="{{ asset('storage/' . $foto->foto) }}"
                                class="img-fluid rounded"
                                style="width:100%;height:200px;object-fit:cover;"
                                alt="Dokumentasi Logbook">

                        </div>

                    </div>

                    @endforeach

                </div>

                @else

                <div class="text-center py-5">

                    <div
                        class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                        style="width:75px;height:75px;">

                        <i
                            class="mdi mdi-image-off-outline text-muted"
                            style="font-size:38px;">
                        </i>

                    </div>

                    <h6 class="font-weight-bold">
                        Belum Ada Dokumentasi
                    </h6>

                    <p class="text-muted small mb-0">
                        Belum ada foto kegiatan yang diunggah siswa.
                    </p>

                </div>

                @endif

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     CATATAN GURU
========================================================= --}}

@if($logbook->catatan_guru)

<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex align-items-center mb-3">

                    <div
                        class="bg-info bg-opacity-10 rounded d-flex align-items-center justify-content-center me-3"
                        style="width:42px;height:42px;">

                        <i
                            class="mdi mdi-account-edit-outline text-info"
                            style="font-size:22px;">
                        </i>

                    </div>

                    <div>

                        <h5 class="card-title mb-1">
                            Catatan Guru
                        </h5>

                        <small class="text-muted">
                            Catatan dari guru pembimbing.
                        </small>

                    </div>

                </div>


                <div class="bg-light rounded p-3">

                    {{ $logbook->catatan_guru }}

                </div>

            </div>

        </div>

    </div>

</div>

@endif


{{-- =========================================================
     VALIDASI LOGBOOK
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex align-items-center mb-4">

                    <div
                        class="bg-primary bg-opacity-10 rounded d-flex align-items-center justify-content-center me-3"
                        style="width:42px;height:42px;">

                        <i
                            class="mdi mdi-check-decagram-outline text-primary"
                            style="font-size:22px;">
                        </i>

                    </div>

                    <div>

                        <h5 class="card-title mb-1">
                            Validasi Logbook
                        </h5>

                        <small class="text-muted">
                            Periksa kegiatan siswa dan tentukan hasil validasi.
                        </small>

                    </div>

                </div>


                {{-- PESAN BERHASIL --}}

                @if(session('success'))

                <div class="alert alert-success alert-dismissible fade show">

                    <i class="mdi mdi-check-circle-outline me-1"></i>

                    {{ session('success') }}

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                    </button>

                </div>

                @endif


                {{-- PESAN ERROR --}}

                @if($errors->any())

                <div class="alert alert-danger">

                    <div class="font-weight-bold mb-2">

                        <i class="mdi mdi-alert-circle-outline me-1"></i>

                        Validasi gagal.

                    </div>

                    <ul class="mb-0 ps-3">

                        @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                        @endforeach

                    </ul>

                </div>

                @endif


                <form
                    action="{{ route('guru.logbook.validasi', $logbook->id) }}"
                    method="POST">

                    @csrf


                    <div class="row">

                        {{-- STATUS --}}

                        <div class="col-md-5 mb-3">

                            <label
                                for="status_validasi"
                                class="form-label">

                                Status Validasi

                            </label>

                            <select
                                name="status_validasi"
                                id="status_validasi"
                                class="form-select @error('status_validasi') is-invalid @enderror"
                                required>

                                <option value="">
                                    -- Pilih Status --
                                </option>


                                <option
                                    value="disetujui"
                                    {{ old(
                                        'status_validasi',
                                        $logbook->status_validasi
                                    ) === 'disetujui'
                                        ? 'selected'
                                        : '' }}>

                                    Disetujui

                                </option>


                                <option
                                    value="ditolak"
                                    {{ old(
                                        'status_validasi',
                                        $logbook->status_validasi
                                    ) === 'ditolak'
                                        ? 'selected'
                                        : '' }}>

                                    Ditolak

                                </option>

                            </select>


                            @error('status_validasi')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>


                        {{-- CATATAN --}}

                        <div class="col-md-7 mb-3">

                            <label
                                for="catatan_guru"
                                class="form-label">

                                Catatan Guru

                            </label>

                            <textarea
                                name="catatan_guru"
                                id="catatan_guru"
                                rows="3"
                                class="form-control @error('catatan_guru') is-invalid @enderror"
                                placeholder="Tambahkan catatan untuk siswa...">{{ old(
                                    'catatan_guru',
                                    $logbook->catatan_guru
                                ) }}</textarea>


                            @error('catatan_guru')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>

                    </div>


                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="mdi mdi-content-save-outline me-1"></i>

                        Simpan Validasi

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection