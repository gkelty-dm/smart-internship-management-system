@extends('layouts.skydash-guru')

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
                    'guru.penilaian.edit',
                    $penilaianGuru->id
                ) }}"
                    class="btn btn-primary">

                    <i class="mdi mdi-pencil-outline me-1"></i>
                    Edit

                </a>

                <a href="{{ route('guru.penilaian.index') }}"
                    class="btn btn-light">

                    <i class="mdi mdi-arrow-left me-1"></i>
                    Kembali

                </a>

            </div>

        </div>

    </div>

</div>


<div class="row">


    {{-- PROFIL SISWA --}}

    <div class="col-lg-4 grid-margin stretch-card">

        <div class="card">

            <div class="card-body text-center">

                @if(
                $penilaianGuru->penempatan->siswa &&
                $penilaianGuru->penempatan->siswa->user &&
                $penilaianGuru->penempatan->siswa->user->foto_profil
                )

                <img src="{{ $penilaianGuru->penempatan->siswa->user->foto_profil }}"
                    width="110"
                    height="110"
                    class="rounded-circle mb-3"
                    alt="Foto Siswa">

                @else

                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3"
                    style="width:110px;height:110px;">

                    <i class="mdi mdi-account-outline text-muted"
                        style="font-size:55px;"></i>

                </div>

                @endif


                <h5 class="fw-bold mb-1">

                    {{ $penilaianGuru->penempatan->siswa->user->name ?? '-' }}

                </h5>


                <p class="text-muted mb-2">

                    NISN:
                    {{ $penilaianGuru->penempatan->siswa->nisn ?? '-' }}

                </p>


                <span class="badge bg-primary">

                    {{ $penilaianGuru->penempatan->siswa->kelas->nama_kelas ?? 'Kelas -' }}

                </span>


                <div class="border-top mt-4 pt-3 text-start">

                    <small class="text-muted d-block mb-1">
                        Perusahaan
                    </small>

                    <strong>
                        {{ $penilaianGuru->penempatan->perusahaan->nama_perusahaan ?? '-' }}
                    </strong>

                </div>

            </div>

        </div>

    </div>


    {{-- NILAI --}}

    <div class="col-lg-8 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <h5 class="card-title mb-0">
                        Hasil Penilaian
                    </h5>


                    @php
                    $nilai = $penilaianGuru->nilai_akhir;
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


                    <div class="col-md-6 mb-4">

                        <div class="border rounded p-3">

                            <small class="text-muted d-block mb-1">
                                Disiplin
                            </small>

                            <h4 class="fw-bold mb-0">

                                {{ number_format(
                                    $penilaianGuru->disiplin,
                                    2
                                ) }}

                            </h4>

                        </div>

                    </div>


                    <div class="col-md-6 mb-4">

                        <div class="border rounded p-3">

                            <small class="text-muted d-block mb-1">
                                Kerjasama
                            </small>

                            <h4 class="fw-bold mb-0">

                                {{ number_format(
                                    $penilaianGuru->kerjasama,
                                    2
                                ) }}

                            </h4>

                        </div>

                    </div>


                    <div class="col-md-6 mb-4">

                        <div class="border rounded p-3">

                            <small class="text-muted d-block mb-1">
                                Inisiatif
                            </small>

                            <h4 class="fw-bold mb-0">

                                {{ number_format(
                                    $penilaianGuru->inisiatif,
                                    2
                                ) }}

                            </h4>

                        </div>

                    </div>


                    <div class="col-md-6 mb-4">

                        <div class="border rounded p-3">

                            <small class="text-muted d-block mb-1">
                                Tanggung Jawab
                            </small>

                            <h4 class="fw-bold mb-0">

                                {{ number_format(
                                    $penilaianGuru->tanggung_jawab,
                                    2
                                ) }}

                            </h4>

                        </div>

                    </div>


                    <div class="col-md-6 mb-4">

                        <div class="border rounded p-3">

                            <small class="text-muted d-block mb-1">
                                Keterampilan
                            </small>

                            <h4 class="fw-bold mb-0">

                                {{ number_format(
                                    $penilaianGuru->keterampilan,
                                    2
                                ) }}

                            </h4>

                        </div>

                    </div>


                    <div class="col-md-6 mb-4">

                        <div class="border rounded p-3 bg-light">

                            <small class="text-muted d-block mb-1">
                                Nilai Akhir
                            </small>

                            <h3 class="fw-bold text-primary mb-0">

                                {{ number_format(
                                    $penilaianGuru->nilai_akhir,
                                    2
                                ) }}

                            </h3>

                        </div>

                    </div>

                </div>


                @if($penilaianGuru->catatan)

                <div class="border-top pt-4">

                    <h6 class="fw-bold mb-2">
                        Catatan
                    </h6>

                    <div class="bg-light rounded p-3">

                        {{ $penilaianGuru->catatan }}

                    </div>

                </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection