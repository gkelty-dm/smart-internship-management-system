@extends('layouts.skydash-industri')

@section('title', 'Detail Penilaian')

@section('content')

<div class="row">

    <div class="col-12">

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">

            <div>

                <h4 class="fw-bold mb-1">
                    Detail Penilaian
                </h4>

                <p class="text-muted mb-0">
                    Informasi lengkap penilaian siswa.
                </p>

            </div>


            <div class="d-flex gap-2 mt-2 mt-md-0">

                <a href="{{ route(
                    'industri.penilaian.edit',
                    $penilaianIndustri->id
                ) }}"
                    class="btn btn-primary">

                    <i class="mdi mdi-pencil-outline me-1"></i>

                    Edit

                </a>


                <a href="{{ route(
                    'industri.penilaian.index'
                ) }}"
                    class="btn btn-light">

                    <i class="mdi mdi-arrow-left me-1"></i>

                    Kembali

                </a>

            </div>

        </div>

    </div>

</div>


<div class="row">


    {{-- =========================================================
         PROFIL SISWA
    ========================================================== --}}

    <div class="col-lg-4 grid-margin stretch-card">

        <div class="card">

            <div class="card-body text-center">


                @if(
                $penilaianIndustri->penempatan->siswa &&
                $penilaianIndustri->penempatan->siswa->user &&
                $penilaianIndustri->penempatan->siswa->user->foto_profil
                )

                <img
                    src="{{ $penilaianIndustri->penempatan->siswa->user->foto_profil }}"
                    width="110"
                    height="110"
                    class="rounded-circle mb-3"
                    style="object-fit:cover;"
                    alt="Foto Siswa">

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

                    {{ $penilaianIndustri->penempatan->siswa->user->name ?? '-' }}

                </h5>


                <p class="text-muted mb-2">

                    NISN:
                    {{ $penilaianIndustri->penempatan->siswa->nisn ?? '-' }}

                </p>


                <span class="badge bg-primary">

                    {{ $penilaianIndustri->penempatan->siswa->kelas->nama_kelas ?? 'Kelas -' }}

                </span>


                <div class="border-top mt-4 pt-3 text-start">

                    <small class="text-muted d-block mb-1">
                        Perusahaan
                    </small>

                    <strong>

                        {{ $penilaianIndustri->penempatan->perusahaan->nama_perusahaan ?? '-' }}

                    </strong>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         NILAI
    ========================================================== --}}

    <div class="col-lg-8 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">


                <div class="d-flex justify-content-between align-items-center mb-4">

                    <h5 class="card-title mb-0">
                        Hasil Penilaian
                    </h5>


                    @php

                    $nilai =
                    $penilaianIndustri->nilai_akhir;

                    @endphp


                    @if($nilai >= 90)

                    <span class="badge bg-success">
                        Sangat Baik
                    </span>

                    @elseif($nilai >= 80)

                    <span class="badge bg-primary">
                        Baik
                    </span>

                    @elseif($nilai >= 70)

                    <span class="badge bg-warning text-dark">
                        Cukup
                    </span>

                    @else

                    <span class="badge bg-danger">
                        Kurang
                    </span>

                    @endif

                </div>


                <div class="row">


                    {{-- DISIPLIN --}}

                    <div class="col-md-6 mb-4">

                        <div class="border rounded p-3">

                            <small class="text-muted d-block mb-1">
                                Disiplin
                            </small>

                            <h4 class="fw-bold mb-0">

                                {{ number_format(
                                    $penilaianIndustri->disiplin,
                                    2
                                ) }}

                            </h4>

                        </div>

                    </div>


                    {{-- KERJASAMA --}}

                    <div class="col-md-6 mb-4">

                        <div class="border rounded p-3">

                            <small class="text-muted d-block mb-1">
                                Kerjasama
                            </small>

                            <h4 class="fw-bold mb-0">

                                {{ number_format(
                                    $penilaianIndustri->kerjasama,
                                    2
                                ) }}

                            </h4>

                        </div>

                    </div>


                    {{-- INISIATIF --}}

                    <div class="col-md-6 mb-4">

                        <div class="border rounded p-3">

                            <small class="text-muted d-block mb-1">
                                Inisiatif
                            </small>

                            <h4 class="fw-bold mb-0">

                                {{ number_format(
                                    $penilaianIndustri->inisiatif,
                                    2
                                ) }}

                            </h4>

                        </div>

                    </div>


                    {{-- TANGGUNG JAWAB --}}

                    <div class="col-md-6 mb-4">

                        <div class="border rounded p-3">

                            <small class="text-muted d-block mb-1">
                                Tanggung Jawab
                            </small>

                            <h4 class="fw-bold mb-0">

                                {{ number_format(
                                    $penilaianIndustri->tanggung_jawab,
                                    2
                                ) }}

                            </h4>

                        </div>

                    </div>


                    {{-- KETERAMPILAN --}}

                    <div class="col-md-6 mb-4">

                        <div class="border rounded p-3">

                            <div class="border rounded p-3">

                                <small class="text-muted d-block mb-1">
                                    Keterampilan
                                </small>

                                <h4 class="fw-bold mb-0">

                                    {{ number_format(
                                        $penilaianIndustri->keterampilan,
                                        2
                                    ) }}

                                </h4>

                            </div>

                        </div>

                    </div>


                    {{-- NILAI AKHIR --}}

                    <div class="col-md-6 mb-4">

                        <div class="border rounded p-3 bg-light">

                            <small class="text-muted d-block mb-1">
                                Nilai Akhir
                            </small>

                            <h3 class="fw-bold text-primary mb-0">

                                {{ number_format(
                                    $penilaianIndustri->nilai_akhir,
                                    2
                                ) }}

                            </h3>

                        </div>

                    </div>

                </div>


                {{-- CATATAN --}}

                @if($penilaianIndustri->catatan)

                <div class="border-top pt-4">

                    <h6 class="fw-bold mb-2">
                        Catatan
                    </h6>

                    <div class="bg-light rounded p-3">

                        {{ $penilaianIndustri->catatan }}

                    </div>

                </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection