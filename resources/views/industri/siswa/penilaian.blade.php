@extends('layouts.skydash-industri')

@section('title', 'Penilaian Siswa')

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

                            <i class="mdi mdi-star-outline text-white fs-5"></i>

                        </div>

                        <div>

                            <h4 class="fw-bold mb-1">
                                Penilaian Siswa
                            </h4>

                            <p class="text-muted small mb-0">
                                Informasi hasil penilaian PKL siswa.
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

                <div class="d-flex align-items-center flex-wrap">

                    @if($siswa->user && $siswa->user->foto_profil)

                    <img
                        src="{{ $siswa->user->foto_profil }}"
                        width="65"
                        height="65"
                        class="rounded-circle me-3"
                        style="object-fit:cover;"
                        alt="Foto {{ $siswa->user->name }}">

                    @else

                    <div
                        class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3"
                        style="width:65px;height:65px;">

                        <i class="mdi mdi-account-outline text-muted fs-2"></i>

                    </div>

                    @endif


                    <div>

                        <h5 class="fw-bold mb-1">
                            {{ $siswa->user->name ?? '-' }}
                        </h5>

                        <div class="d-flex align-items-center flex-wrap gap-2">

                            <span class="text-muted small">

                                <i class="mdi mdi-card-account-details-outline me-1"></i>

                                NISN: {{ $siswa->nisn ?? '-' }}

                            </span>


                            @if($siswa->kelas)

                            <span class="badge bg-light text-primary border">

                                <i class="mdi mdi-google-classroom me-1"></i>

                                {{ $siswa->kelas->nama_kelas }}

                            </span>

                            @endif


                            @if($siswa->jurusan)

                            <span class="badge bg-light text-info border">

                                <i class="mdi mdi-school-outline me-1"></i>

                                {{ $siswa->jurusan->nama_jurusan }}

                            </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<div class="row">


    {{-- PENILAIAN GURU --}}

    <div class="col-lg-4 col-md-6 grid-margin stretch-card">

        <div class="card h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <div>

                        <p class="text-muted small mb-1">
                            Penilaian Guru
                        </p>

                        <h5 class="fw-bold mb-0">
                            Guru Pembimbing
                        </h5>

                    </div>

                    <div
                        class="bg-primary bg-opacity-10 rounded-3 d-flex align-items-center justify-content-center"
                        style="width:45px;height:45px;">

                        <i class="mdi mdi-school-outline text-primary fs-4"></i>

                    </div>

                </div>


                @if($penilaianGuru)

                <div class="text-center py-3">

                    <div
                        class="text-primary fw-bold"
                        style="font-size:52px;line-height:1;">

                        {{ $penilaianGuru->nilai_akhir ?? '-' }}

                    </div>

                    <small class="text-muted">
                        Nilai Akhir Guru
                    </small>

                </div>


                <div class="border-top pt-3 mt-2">

                    <div class="d-flex justify-content-between mb-2">

                        <span class="text-muted small">
                            Disiplin
                        </span>

                        <span class="fw-semibold small">
                            {{ $penilaianGuru->disiplin ?? '-' }}
                        </span>

                    </div>

                    <div class="d-flex justify-content-between mb-2">

                        <span class="text-muted small">
                            Kerjasama
                        </span>

                        <span class="fw-semibold small">
                            {{ $penilaianGuru->kerjasama ?? '-' }}
                        </span>

                    </div>

                    <div class="d-flex justify-content-between mb-2">

                        <span class="text-muted small">
                            Inisiatif
                        </span>

                        <span class="fw-semibold small">
                            {{ $penilaianGuru->inisiatif ?? '-' }}
                        </span>

                    </div>

                    <div class="d-flex justify-content-between mb-2">

                        <span class="text-muted small">
                            Tanggung Jawab
                        </span>

                        <span class="fw-semibold small">
                            {{ $penilaianGuru->tanggung_jawab ?? '-' }}
                        </span>

                    </div>

                    <div class="d-flex justify-content-between">

                        <span class="text-muted small">
                            Keterampilan
                        </span>

                        <span class="fw-semibold small">
                            {{ $penilaianGuru->keterampilan ?? '-' }}
                        </span>

                    </div>

                </div>


                @if($penilaianGuru->catatan)

                <div class="bg-light rounded-3 p-3 mt-3">

                    <small class="text-muted d-block mb-1">

                        <i class="mdi mdi-note-text-outline me-1"></i>

                        Catatan Guru

                    </small>

                    <p class="mb-0 small">
                        {{ $penilaianGuru->catatan }}
                    </p>

                </div>

                @endif

                @else

                <div class="text-center py-4">

                    <i
                        class="mdi mdi-clipboard-text-outline text-muted"
                        style="font-size:45px;">
                    </i>

                    <p class="text-muted small mt-2 mb-0">
                        Belum ada penilaian guru.
                    </p>

                </div>

                @endif

            </div>

        </div>

    </div>


    {{-- PENILAIAN INDUSTRI --}}

    <div class="col-lg-4 col-md-6 grid-margin stretch-card">

        <div class="card h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <div>

                        <p class="text-muted small mb-1">
                            Penilaian Industri
                        </p>

                        <h5 class="fw-bold mb-0">
                            Pembimbing Industri
                        </h5>

                    </div>

                    <div
                        class="bg-warning bg-opacity-10 rounded-3 d-flex align-items-center justify-content-center"
                        style="width:45px;height:45px;">

                        <i class="mdi mdi-domain text-warning fs-4"></i>

                    </div>

                </div>


                @if($penilaianIndustri)

                <div class="text-center py-3">

                    <div
                        class="text-warning fw-bold"
                        style="font-size:52px;line-height:1;">

                        {{ $penilaianIndustri->nilai_akhir ?? '-' }}

                    </div>

                    <small class="text-muted">
                        Nilai Akhir Industri
                    </small>

                </div>


                <div class="border-top pt-3 mt-2">

                    <div class="d-flex justify-content-between mb-2">

                        <span class="text-muted small">
                            Disiplin
                        </span>

                        <span class="fw-semibold small">
                            {{ $penilaianIndustri->disiplin ?? '-' }}
                        </span>

                    </div>

                    <div class="d-flex justify-content-between mb-2">

                        <span class="text-muted small">
                            Kerjasama
                        </span>

                        <span class="fw-semibold small">
                            {{ $penilaianIndustri->kerjasama ?? '-' }}
                        </span>

                    </div>

                    <div class="d-flex justify-content-between mb-2">

                        <span class="text-muted small">
                            Inisiatif
                        </span>

                        <span class="fw-semibold small">
                            {{ $penilaianIndustri->inisiatif ?? '-' }}
                        </span>

                    </div>

                    <div class="d-flex justify-content-between mb-2">

                        <span class="text-muted small">
                            Tanggung Jawab
                        </span>

                        <span class="fw-semibold small">
                            {{ $penilaianIndustri->tanggung_jawab ?? '-' }}
                        </span>

                    </div>

                    <div class="d-flex justify-content-between">

                        <span class="text-muted small">
                            Keterampilan
                        </span>

                        <span class="fw-semibold small">
                            {{ $penilaianIndustri->keterampilan ?? '-' }}
                        </span>

                    </div>

                </div>


                @if($penilaianIndustri->catatan)

                <div class="bg-light rounded-3 p-3 mt-3">

                    <small class="text-muted d-block mb-1">

                        <i class="mdi mdi-note-text-outline me-1"></i>

                        Catatan Industri

                    </small>

                    <p class="mb-0 small">
                        {{ $penilaianIndustri->catatan }}
                    </p>

                </div>

                @endif

                @else

                <div class="text-center py-4">

                    <i
                        class="mdi mdi-domain text-muted"
                        style="font-size:45px;">
                    </i>

                    <p class="text-muted small mt-2 mb-0">
                        Belum ada penilaian industri.
                    </p>

                </div>

                @endif

            </div>

        </div>

    </div>


    {{-- NILAI AKHIR PKL --}}

    <div class="col-lg-4 col-md-12 grid-margin stretch-card">

        <div class="card h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <div>

                        <p class="text-muted small mb-1">
                            Hasil Akhir
                        </p>

                        <h5 class="fw-bold mb-0">
                            Nilai Akhir PKL
                        </h5>

                    </div>

                    <div
                        class="bg-success bg-opacity-10 rounded-3 d-flex align-items-center justify-content-center"
                        style="width:45px;height:45px;">

                        <i class="mdi mdi-star text-success fs-4"></i>

                    </div>

                </div>


                @if($nilaiPKL)

                <div class="text-center py-3">

                    <div
                        class="text-success fw-bold"
                        style="font-size:58px;line-height:1;">

                        {{ $nilaiPKL->nilai_akhir ?? '-' }}

                    </div>

                    <small class="text-muted">
                        Nilai Akhir PKL
                    </small>

                </div>


                @if($nilaiPKL->predikat)

                <div class="text-center mb-3">

                    <span class="badge bg-success rounded-pill px-3 py-2">

                        Predikat:
                        {{ $nilaiPKL->predikat }}

                    </span>

                </div>

                @endif


                <div class="border-top pt-3">

                    <div class="d-flex justify-content-between mb-2">

                        <span class="text-muted small">
                            Nilai Guru
                        </span>

                        <span class="fw-semibold small">
                            {{ $nilaiPKL->nilai_guru ?? '-' }}
                        </span>

                    </div>

                    <div class="d-flex justify-content-between">

                        <span class="text-muted small">
                            Nilai Industri
                        </span>

                        <span class="fw-semibold small">
                            {{ $nilaiPKL->nilai_industri ?? '-' }}
                        </span>

                    </div>

                </div>

                @else

                <div class="text-center py-4">

                    <i
                        class="mdi mdi-star-outline text-muted"
                        style="font-size:45px;">
                    </i>

                    <p class="text-muted small mt-2 mb-0">
                        Nilai akhir belum tersedia.
                    </p>

                </div>

                @endif

            </div>

        </div>

    </div>

</div>


@if($penempatan)

<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex align-items-center mb-4">

                    <div
                        class="bg-primary bg-opacity-10 rounded-3 d-flex align-items-center justify-content-center me-3"
                        style="width:44px;height:44px;">

                        <i class="mdi mdi-briefcase-outline text-primary fs-5"></i>

                    </div>

                    <div>

                        <h5 class="card-title mb-1">
                            Informasi Penempatan PKL
                        </h5>

                        <p class="text-muted small mb-0">
                            Informasi tempat dan periode pelaksanaan PKL.
                        </p>

                    </div>

                </div>


                <div class="row">

                    <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">

                        <div class="d-flex align-items-start">

                            <i class="mdi mdi-domain text-primary fs-4 me-3"></i>

                            <div>

                                <small class="text-muted d-block mb-1">
                                    Perusahaan
                                </small>

                                <h6 class="fw-bold mb-0">

                                    {{ $penempatan->perusahaan->nama_perusahaan ?? '-' }}

                                </h6>

                            </div>

                        </div>

                    </div>


                    <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">

                        <div class="d-flex align-items-start">

                            <i class="mdi mdi-calendar-start text-success fs-4 me-3"></i>

                            <div>

                                <small class="text-muted d-block mb-1">
                                    Tanggal Mulai
                                </small>

                                <h6 class="fw-bold mb-0">

                                    {{ $penempatan->tanggal_mulai
                                        ? \Carbon\Carbon::parse($penempatan->tanggal_mulai)->translatedFormat('d F Y')
                                        : '-' }}

                                </h6>

                            </div>

                        </div>

                    </div>


                    <div class="col-lg-4 col-md-6">

                        <div class="d-flex align-items-start">

                            <i class="mdi mdi-calendar-end text-danger fs-4 me-3"></i>

                            <div>

                                <small class="text-muted d-block mb-1">
                                    Tanggal Selesai
                                </small>

                                <h6 class="fw-bold mb-0">

                                    {{ $penempatan->tanggal_selesai
                                        ? \Carbon\Carbon::parse($penempatan->tanggal_selesai)->translatedFormat('d F Y')
                                        : '-' }}

                                </h6>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endif

@endsection