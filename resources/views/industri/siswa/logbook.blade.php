@extends('layouts.skydash-industri')

@section('title', 'Logbook Siswa')

@section('content')

<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body py-3">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                    <div class="d-flex align-items-center">

                        <div
                            class="bg-primary rounded-3 d-flex align-items-center justify-content-center me-3"
                            style="width:46px;height:46px;">

                            <i class="mdi mdi-book-open-page-variant text-white fs-5"></i>

                        </div>

                        <div>

                            <h4 class="fw-bold mb-1">
                                Logbook Siswa
                            </h4>

                            <p class="text-muted small mb-0">
                                Riwayat kegiatan PKL siswa.
                            </p>

                        </div>

                    </div>

                    <a
                        href="{{ route('industri.siswa.show', $siswa->id) }}"
                        class="btn btn-light btn-sm border">

                        <i class="mdi mdi-arrow-left me-1"></i>
                        Kembali

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>


<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <div class="d-flex align-items-center">

                        @if($siswa->user && $siswa->user->foto_profil)

                        <img
                            src="{{ $siswa->user->foto_profil }}"
                            width="58"
                            height="58"
                            class="rounded-circle me-3"
                            style="object-fit:cover;"
                            alt="Foto {{ $siswa->user->name }}">

                        @else

                        <div
                            class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3"
                            style="width:58px;height:58px;">

                            <i class="mdi mdi-account-outline text-muted fs-3"></i>

                        </div>

                        @endif

                        <div>

                            <h5 class="fw-bold mb-1">
                                {{ $siswa->user->name ?? '-' }}
                            </h5>

                            <div class="d-flex align-items-center flex-wrap gap-2">

                                <span class="text-muted small">

                                    <i class="mdi mdi-card-account-details-outline me-1"></i>

                                    NISN {{ $siswa->nisn ?? '-' }}

                                </span>

                                @if($siswa->kelas)

                                <span class="badge bg-light text-primary border">

                                    <i class="mdi mdi-google-classroom me-1"></i>

                                    {{ $siswa->kelas->nama_kelas }}

                                </span>

                                @endif

                            </div>

                        </div>

                    </div>

                    <div>

                        <span class="badge bg-primary rounded-pill px-3 py-2">

                            <i class="mdi mdi-book-open-page-variant me-1"></i>

                            {{ $logbooks->total() }} Logbook

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>

                        <h5 class="card-title mb-1">
                            Riwayat Kegiatan PKL
                        </h5>

                        <p class="text-muted small mb-0">
                            Daftar kegiatan yang telah dicatat oleh siswa.
                        </p>

                    </div>

                    <span class="text-muted small">

                        <i class="mdi mdi-information-outline me-1"></i>

                        {{ $logbooks->total() }} data

                    </span>

                </div>


                @if($logbooks->count())

                @foreach($logbooks as $logbook)

                <div class="card border shadow-none mb-3">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">

                            <div class="d-flex align-items-center">

                                <div
                                    class="bg-primary bg-opacity-10 rounded-3 d-flex align-items-center justify-content-center me-3"
                                    style="width:44px;height:44px;">

                                    <i class="mdi mdi-calendar-outline text-primary fs-5"></i>

                                </div>

                                <div>

                                    <small class="text-muted d-block mb-1">
                                        Tanggal Kegiatan
                                    </small>

                                    <h6 class="fw-bold mb-0">

                                        {{ $logbook->tanggal
                                            ? \Carbon\Carbon::parse($logbook->tanggal)->translatedFormat('d F Y')
                                            : '-' }}

                                    </h6>

                                </div>

                            </div>


                            <div>

                                @if($logbook->status_validasi === 'disetujui' || $logbook->status_validasi === 'valid')

                                <span class="badge bg-success rounded-pill px-3 py-2">

                                    <i class="mdi mdi-check-circle-outline me-1"></i>

                                    Disetujui

                                </span>

                                @elseif($logbook->status_validasi === 'ditolak')

                                <span class="badge bg-danger rounded-pill px-3 py-2">

                                    <i class="mdi mdi-close-circle-outline me-1"></i>

                                    Ditolak

                                </span>

                                @else

                                <span class="badge bg-warning text-dark rounded-pill px-3 py-2">

                                    <i class="mdi mdi-clock-outline me-1"></i>

                                    Menunggu Validasi

                                </span>

                                @endif

                            </div>

                        </div>


                        <hr class="my-4">


                        <div class="mb-4">

                            <div class="d-flex align-items-center mb-2">

                                <div
                                    class="bg-primary bg-opacity-10 rounded d-flex align-items-center justify-content-center me-2"
                                    style="width:30px;height:30px;">

                                    <i class="mdi mdi-clipboard-text-outline text-primary"></i>

                                </div>

                                <span class="fw-semibold">
                                    Kegiatan
                                </span>

                            </div>

                            <div class="bg-light rounded-3 p-3">

                                <p class="mb-0 text-dark">
                                    {{ $logbook->kegiatan ?? '-' }}
                                </p>

                            </div>

                        </div>


                        @if($logbook->kendala)

                        <div class="mb-4">

                            <div class="d-flex align-items-center mb-2">

                                <div
                                    class="bg-warning bg-opacity-10 rounded d-flex align-items-center justify-content-center me-2"
                                    style="width:30px;height:30px;">

                                    <i class="mdi mdi-alert-circle-outline text-warning"></i>

                                </div>

                                <span class="fw-semibold">
                                    Kendala
                                </span>

                            </div>

                            <div class="bg-light rounded-3 p-3">

                                <p class="mb-0 text-dark">
                                    {{ $logbook->kendala }}
                                </p>

                            </div>

                        </div>

                        @endif


                        @if($logbook->solusi)

                        <div class="mb-4">

                            <div class="d-flex align-items-center mb-2">

                                <div
                                    class="bg-success bg-opacity-10 rounded d-flex align-items-center justify-content-center me-2"
                                    style="width:30px;height:30px;">

                                    <i class="mdi mdi-lightbulb-outline text-success"></i>

                                </div>

                                <span class="fw-semibold">
                                    Solusi
                                </span>

                            </div>

                            <div class="bg-light rounded-3 p-3">

                                <p class="mb-0 text-dark">
                                    {{ $logbook->solusi }}
                                </p>

                            </div>

                        </div>

                        @endif


                        {{-- CATATAN INDUSTRI --}}

                        @if($logbook->catatan_industri)

                        <div class="mb-4">

                            <div class="d-flex align-items-center mb-2">

                                <div
                                    class="bg-info bg-opacity-10 rounded d-flex align-items-center justify-content-center me-2"
                                    style="width:30px;height:30px;">

                                    <i class="mdi mdi-account-edit-outline text-info"></i>

                                </div>

                                <span class="fw-semibold">
                                    Catatan Industri
                                </span>

                            </div>

                            <div class="alert alert-info border-0 mb-0">

                                <p class="mb-0">
                                    {{ $logbook->catatan_industri }}
                                </p>

                            </div>

                        </div>

                        @endif


                        <div class="border-top pt-3 mt-3">

                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                                <div>

                                    @if($logbook->status_validasi === 'disetujui' || $logbook->status_validasi === 'valid')

                                    <small class="text-success">

                                        <i class="mdi mdi-check-circle-outline me-1"></i>

                                        Logbook telah disetujui

                                    </small>

                                    @elseif($logbook->status_validasi === 'ditolak')

                                    <small class="text-danger">

                                        <i class="mdi mdi-close-circle-outline me-1"></i>

                                        Logbook ditolak

                                    </small>

                                    @else

                                    <small class="text-warning">

                                        <i class="mdi mdi-clock-outline me-1"></i>

                                        Menunggu tindakan pembimbing industri

                                    </small>

                                    @endif

                                </div>


                                <a
                                    href="{{ route('industri.logbook.show', $logbook->id) }}"
                                    class="btn btn-primary btn-sm">

                                    <i class="mdi mdi-pencil-outline me-1"></i>

                                    Update Validasi

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

                @endforeach


                @if($logbooks->hasPages())

                <div class="d-flex justify-content-between align-items-center flex-wrap mt-4 pt-3 border-top">

                    <small class="text-muted mb-2 mb-md-0">

                        Menampilkan

                        <strong>{{ $logbooks->firstItem() }}</strong>

                        -

                        <strong>{{ $logbooks->lastItem() }}</strong>

                        dari

                        <strong>{{ $logbooks->total() }}</strong>

                        logbook

                    </small>

                    <div>

                        {{ $logbooks->onEachSide(1)->links('pagination::bootstrap-5') }}

                    </div>

                </div>

                @endif

                @else

                <div class="text-center py-5">

                    <div
                        class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                        style="width:80px;height:80px;">

                        <i
                            class="mdi mdi-book-open-page-variant text-muted"
                            style="font-size:40px;">
                        </i>

                    </div>

                    <h5 class="fw-bold mb-2">
                        Belum Ada Logbook
                    </h5>

                    <p class="text-muted small mb-0">
                        Siswa belum mengisi logbook kegiatan PKL.
                    </p>

                </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection