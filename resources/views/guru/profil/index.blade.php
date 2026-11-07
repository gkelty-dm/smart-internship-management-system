@extends('layouts.skydash-guru')

@section('title', 'Profil Saya')

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

                            <i
                                class="mdi mdi-account-circle-outline text-white"
                                style="font-size:24px;">
                            </i>

                        </div>

                        <div>

                            <h4 class="fw-bold mb-1">
                                Profil Saya
                            </h4>

                            <p class="text-muted small mb-0">
                                Informasi akun dan data pribadi guru pembimbing.
                            </p>

                        </div>

                    </div>


                    <a
                        href="{{ route('guru.profil.edit') }}"
                        class="btn btn-primary btn-sm">

                        <i class="mdi mdi-pencil-outline me-1"></i>

                        Edit Profil

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>


<div class="row">


    {{-- PROFIL UTAMA --}}

    <div class="col-lg-4 grid-margin stretch-card">

        <div class="card h-100">

            <div class="card-body text-center">


                {{-- FOTO PROFIL --}}

                @if($user->foto_profil)

                <img
                    src="{{ url($user->foto_profil) }}"
                    alt="Foto Profil"
                    width="125"
                    height="125"
                    class="rounded-circle mb-3"
                    style="width:125px;height:125px;object-fit:cover;">

                @else

                <div
                    class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3"
                    style="width:125px;height:125px;">

                    <i
                        class="mdi mdi-account-outline text-muted"
                        style="font-size:62px;">
                    </i>

                </div>

                @endif


                <h4 class="fw-bold mb-1">

                    {{ $user->name ?? '-' }}

                </h4>


                <p class="text-muted small mb-3">

                    {{ $user->email ?? '-' }}

                </p>


                <span class="badge bg-primary rounded-pill px-3 py-2">

                    <i class="mdi mdi-school-outline me-1"></i>

                    Guru Pembimbing

                </span>


                <div class="border-top mt-4 pt-4">


                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <span class="text-muted small">
                            Status Akun
                        </span>


                        @if($user->is_active)

                        <span class="badge bg-success">

                            <i class="mdi mdi-check-circle-outline me-1"></i>

                            Aktif

                        </span>

                        @else

                        <span class="badge bg-danger">

                            <i class="mdi mdi-close-circle-outline me-1"></i>

                            Tidak Aktif

                        </span>

                        @endif

                    </div>


                    <div class="d-flex justify-content-between align-items-center">

                        <span class="text-muted small">
                            NIP
                        </span>

                        <span class="fw-semibold small">

                            {{ $guru->nip ?? '-' }}

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- INFORMASI PRIBADI --}}

    <div class="col-lg-8 grid-margin stretch-card">

        <div class="card h-100">

            <div class="card-body">

                <div class="d-flex align-items-center mb-4">

                    <div
                        class="bg-light rounded-3 d-flex align-items-center justify-content-center me-3"
                        style="width:40px;height:40px;">

                        <i
                            class="mdi mdi-account-details-outline text-primary"
                            style="font-size:21px;">
                        </i>

                    </div>

                    <div>

                        <h5 class="card-title mb-1">
                            Informasi Pribadi
                        </h5>

                        <p class="text-muted small mb-0">
                            Data pribadi guru pembimbing.
                        </p>

                    </div>

                </div>


                <div class="row">


                    <div class="col-md-6 mb-4">

                        <div class="border rounded-3 p-3 h-100">

                            <small class="text-muted d-block mb-1">

                                <i class="mdi mdi-account-outline me-1"></i>

                                Nama Lengkap

                            </small>

                            <h6 class="fw-semibold mb-0">

                                {{ $user->name ?? '-' }}

                            </h6>

                        </div>

                    </div>


                    <div class="col-md-6 mb-4">

                        <div class="border rounded-3 p-3 h-100">

                            <small class="text-muted d-block mb-1">

                                <i class="mdi mdi-email-outline me-1"></i>

                                Email

                            </small>

                            <h6 class="fw-semibold mb-0 text-break">

                                {{ $user->email ?? '-' }}

                            </h6>

                        </div>

                    </div>


                    <div class="col-md-6 mb-4">

                        <div class="border rounded-3 p-3 h-100">

                            <small class="text-muted d-block mb-1">

                                <i class="mdi mdi-card-account-details-outline me-1"></i>

                                NIP

                            </small>

                            <h6 class="fw-semibold mb-0">

                                {{ $guru->nip ?? '-' }}

                            </h6>

                        </div>

                    </div>


                    <div class="col-md-6 mb-4">

                        <div class="border rounded-3 p-3 h-100">

                            <small class="text-muted d-block mb-1">

                                <i class="mdi mdi-phone-outline me-1"></i>

                                Nomor HP

                            </small>

                            <h6 class="fw-semibold mb-0">

                                {{ $guru->no_hp ?? '-' }}

                            </h6>

                        </div>

                    </div>


                    <div class="col-12">

                        <div class="border rounded-3 p-3">

                            <small class="text-muted d-block mb-2">

                                <i class="mdi mdi-map-marker-outline me-1"></i>

                                Alamat

                            </small>

                            <p class="mb-0">

                                {{ $guru->alamat ?? 'Belum ada alamat.' }}

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- INFORMASI SISTEM --}}

<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <h5 class="card-title mb-4">
                    Informasi Akun Sistem
                </h5>


                <div class="row">

                    <div class="col-lg-4 col-md-6 mb-3">

                        <div class="border rounded-3 p-3">

                            <small class="text-muted d-block mb-1">
                                Role
                            </small>

                            <h6 class="fw-semibold mb-0">
                                Guru Pembimbing
                            </h6>

                        </div>

                    </div>


                    <div class="col-lg-4 col-md-6 mb-3">

                        <div class="border rounded-3 p-3">

                            <small class="text-muted d-block mb-1">
                                Status
                            </small>

                            <h6 class="fw-semibold mb-0">

                                @if($user->is_active)
                                Aktif
                                @else
                                Tidak Aktif
                                @endif

                            </h6>

                        </div>

                    </div>


                    <div class="col-lg-4 col-md-6 mb-3">

                        <div class="border rounded-3 p-3">

                            <small class="text-muted d-block mb-1">
                                Terdaftar Sejak
                            </small>

                            <h6 class="fw-semibold mb-0">

                                @if($user->created_at)

                                {{ $user->created_at->translatedFormat('d F Y') }}

                                @else

                                -

                                @endif

                            </h6>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection