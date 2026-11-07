@extends('layouts.skydash-industri')

@section('title', 'Edit Penilaian')

@section('content')

<div class="row">

    <div class="col-12">

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">

            <div>

                <h4 class="fw-bold mb-1">
                    Edit Penilaian
                </h4>

                <p class="text-muted mb-0">
                    Perbarui nilai siswa PKL yang Anda bimbing.
                </p>

            </div>

            <a href="{{ route(
                'industri.penilaian.show',
                $penilaianIndustri->id
            ) }}"
                class="btn btn-light mt-2 mt-md-0">

                <i class="mdi mdi-arrow-left me-1"></i>
                Kembali

            </a>

        </div>

    </div>

</div>


<div class="row">


    {{-- =========================================================
         INFORMASI SISWA
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
                    style="object-fit: cover;"
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
         FORM EDIT
    ========================================================== --}}

    <div class="col-lg-8 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <h5 class="card-title mb-1">
                    Form Penilaian
                </h5>

                <p class="text-muted mb-4">
                    Nilai berada pada rentang 0 sampai 100.
                </p>


                @if($errors->any())

                <div class="alert alert-danger">

                    <strong>
                        Periksa kembali data penilaian.
                    </strong>

                    <ul class="mb-0 mt-2">

                        @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                        @endforeach

                    </ul>

                </div>

                @endif


                <form
                    action="{{ route(
                        'industri.penilaian.update',
                        $penilaianIndustri->id
                    ) }}"
                    method="POST">

                    @csrf

                    @method('PUT')


                    <div class="row">


                        {{-- DISIPLIN --}}

                        <div class="col-md-6 mb-4">

                            <label
                                for="disiplin"
                                class="form-label fw-semibold">

                                Disiplin

                            </label>

                            <input
                                type="number"
                                name="disiplin"
                                id="disiplin"
                                class="form-control @error('disiplin') is-invalid @enderror"
                                value="{{ old(
                                    'disiplin',
                                    $penilaianIndustri->disiplin
                                ) }}"
                                min="0"
                                max="100"
                                step="0.01"
                                required>

                            @error('disiplin')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>


                        {{-- KERJASAMA --}}

                        <div class="col-md-6 mb-4">

                            <label
                                for="kerjasama"
                                class="form-label fw-semibold">

                                Kerjasama

                            </label>

                            <input
                                type="number"
                                name="kerjasama"
                                id="kerjasama"
                                class="form-control @error('kerjasama') is-invalid @enderror"
                                value="{{ old(
                                    'kerjasama',
                                    $penilaianIndustri->kerjasama
                                ) }}"
                                min="0"
                                max="100"
                                step="0.01"
                                required>

                            @error('kerjasama')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>


                        {{-- INISIATIF --}}

                        <div class="col-md-6 mb-4">

                            <label
                                for="inisiatif"
                                class="form-label fw-semibold">

                                Inisiatif

                            </label>

                            <input
                                type="number"
                                name="inisiatif"
                                id="inisiatif"
                                class="form-control @error('inisiatif') is-invalid @enderror"
                                value="{{ old(
                                    'inisiatif',
                                    $penilaianIndustri->inisiatif
                                ) }}"
                                min="0"
                                max="100"
                                step="0.01"
                                required>

                            @error('inisiatif')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>


                        {{-- TANGGUNG JAWAB --}}

                        <div class="col-md-6 mb-4">

                            <label
                                for="tanggung_jawab"
                                class="form-label fw-semibold">

                                Tanggung Jawab

                            </label>

                            <input
                                type="number"
                                name="tanggung_jawab"
                                id="tanggung_jawab"
                                class="form-control @error('tanggung_jawab') is-invalid @enderror"
                                value="{{ old(
                                    'tanggung_jawab',
                                    $penilaianIndustri->tanggung_jawab
                                ) }}"
                                min="0"
                                max="100"
                                step="0.01"
                                required>

                            @error('tanggung_jawab')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>


                        {{-- KETERAMPILAN --}}

                        <div class="col-md-6 mb-4">

                            <label
                                for="keterampilan"
                                class="form-label fw-semibold">

                                Keterampilan

                            </label>

                            <input
                                type="number"
                                name="keterampilan"
                                id="keterampilan"
                                class="form-control @error('keterampilan') is-invalid @enderror"
                                value="{{ old(
                                    'keterampilan',
                                    $penilaianIndustri->keterampilan
                                ) }}"
                                min="0"
                                max="100"
                                step="0.01"
                                required>

                            @error('keterampilan')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                            @enderror

                        </div>


                        {{-- CATATAN --}}

                        <div class="col-12 mb-4">

                            <label
                                for="catatan"
                                class="form-label fw-semibold">

                                Catatan

                            </label>

                            <textarea
                                name="catatan"
                                id="catatan"
                                rows="4"
                                class="form-control"
                                placeholder="Tambahkan catatan...">{{ old(
                                    'catatan',
                                    $penilaianIndustri->catatan
                                ) }}</textarea>

                        </div>

                    </div>


                    {{-- =================================================
                         TOMBOL
                    ================================================== --}}

                    <div class="border-top pt-4">

                        <button
                            type="submit"
                            class="btn btn-primary">

                            <i class="mdi mdi-content-save-outline me-1"></i>

                            Simpan Perubahan

                        </button>


                        <a
                            href="{{ route(
                                'industri.penilaian.show',
                                $penilaianIndustri->id
                            ) }}"
                            class="btn btn-light">

                            Batal

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection