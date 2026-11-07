@extends('layouts.skydash-siswa')

@section('title', 'Riwayat Absensi')

@section('content')

{{-- =========================================================
     HEADER
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="d-flex align-items-center">

                    <div
                        class="rounded-3 bg-primary bg-opacity-10
                        d-flex align-items-center justify-content-center me-3"
                        style="width:52px;height:52px;">

                        <i
                            class="mdi mdi-calendar-check text-primary"
                            style="font-size:27px;">
                        </i>

                    </div>

                    <div>

                        <h4 class="fw-bold mb-1">
                            Riwayat Absensi
                        </h4>

                        <p class="text-muted mb-0">
                            Riwayat kehadiran Anda selama melaksanakan PKL.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     STATISTIK
========================================================= --}}

<div class="row">


    {{-- TOTAL ABSENSI --}}

    <div class="col-md-4 grid-margin stretch-card">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div
                    class="d-flex justify-content-between
                    align-items-start">

                    <div>

                        <p class="text-muted small mb-2">
                            Total Absensi
                        </p>

                        <h3 class="fw-bold mb-1">
                            {{ $absensis->total() }}
                        </h3>

                        <small class="text-muted">
                            Seluruh riwayat kehadiran
                        </small>

                    </div>

                    <div
                        class="rounded-3 bg-primary bg-opacity-10
                        d-flex align-items-center
                        justify-content-center"
                        style="width:48px;height:48px;">

                        <i
                            class="mdi mdi-calendar-multiple
                            text-primary"
                            style="font-size:24px;">
                        </i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- KEHADIRAN --}}

    <div class="col-md-4 grid-margin stretch-card">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div
                    class="d-flex justify-content-between
                    align-items-start">

                    <div>

                        <p class="text-muted small mb-2">
                            Kehadiran
                        </p>

                        <h3 class="fw-bold text-success mb-1">

                            {{
                                $absensis
                                    ->getCollection()
                                    ->where('status', 'hadir')
                                    ->count()
                            }}

                        </h3>

                        <small class="text-muted">
                            Data hadir pada halaman ini
                        </small>

                    </div>

                    <div
                        class="rounded-3 bg-success bg-opacity-10
                        d-flex align-items-center
                        justify-content-center"
                        style="width:48px;height:48px;">

                        <i
                            class="mdi mdi-check-circle-outline
                            text-success"
                            style="font-size:24px;">
                        </i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- HALAMAN --}}

    <div class="col-md-4 grid-margin stretch-card">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div
                    class="d-flex justify-content-between
                    align-items-start">

                    <div>

                        <p class="text-muted small mb-2">
                            Halaman
                        </p>

                        <h3 class="fw-bold mb-1">

                            {{ $absensis->currentPage() }}

                            <span
                                class="text-muted fs-6 fw-normal">

                                /
                                {{ $absensis->lastPage() }}

                            </span>

                        </h3>

                        <small class="text-muted">
                            Halaman riwayat saat ini
                        </small>

                    </div>

                    <div
                        class="rounded-3 bg-info bg-opacity-10
                        d-flex align-items-center
                        justify-content-center"
                        style="width:48px;height:48px;">

                        <i
                            class="mdi mdi-file-document-outline
                            text-info"
                            style="font-size:24px;">
                        </i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     TABEL RIWAYAT ABSENSI
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card border-0 shadow-sm">

            <div class="card-body">


                {{-- HEADER TABLE --}}

                <div
                    class="d-flex justify-content-between
                    align-items-center mb-4 flex-wrap">

                    <div>

                        <h5 class="card-title mb-1">
                            Riwayat Kehadiran
                        </h5>

                        <p class="text-muted small mb-0">
                            Seluruh data absensi Anda selama PKL.
                        </p>

                    </div>

                    <div class="mt-2 mt-md-0">

                        <span
                            class="badge bg-primary px-3 py-2">

                            <i
                                class="mdi mdi-calendar-check-outline me-1">
                            </i>

                            {{ $absensis->total() }} Data

                        </span>

                    </div>

                </div>


                {{-- =================================================
                     TABLE
                ================================================== --}}

                @if($absensis->count())

                <div class="table-responsive">

                    <table
                        class="table table-hover align-middle mb-0">

                        <thead>

                            <tr>

                                <th class="text-muted small">
                                    No
                                </th>

                                <th class="text-muted small">
                                    Tanggal
                                </th>

                                <th class="text-muted small">
                                    Jam Masuk
                                </th>

                                <th class="text-muted small">
                                    Jam Pulang
                                </th>

                                <th class="text-muted small">
                                    Status
                                </th>

                                <th class="text-muted small">
                                    Metode
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($absensis as $index => $absensi)

                            <tr>


                                {{-- NO --}}

                                <td>

                                    <span class="fw-semibold">

                                        {{
                                            $absensis->firstItem()
                                            + $index
                                        }}

                                    </span>

                                </td>


                                {{-- TANGGAL --}}

                                <td>

                                    <div
                                        class="d-flex align-items-center">

                                        <div
                                            class="rounded-2 bg-light
                                            d-flex align-items-center
                                            justify-content-center me-2"
                                            style="
                                                width:36px;
                                                height:36px;
                                                min-width:36px;
                                            ">

                                            <i
                                                class="mdi
                                                mdi-calendar-outline
                                                text-primary">
                                            </i>

                                        </div>

                                        <div>

                                            <span
                                                class="fw-semibold d-block">

                                                {{
                                                    \Carbon\Carbon::parse(
                                                        $absensi->tanggal
                                                    )->translatedFormat(
                                                        'd F Y'
                                                    )
                                                }}

                                            </span>

                                        </div>

                                    </div>

                                </td>


                                {{-- =================================================
                                     JAM MASUK
                                ================================================== --}}

                                <td>

                                    @if($absensi->jam_masuk)

                                    @if($absensi->foto_masuk)

                                    <button
                                        type="button"
                                        class="btn btn-link
                                                p-0 text-decoration-none"
                                        data-bs-toggle="modal"
                                        data-bs-target="#fotoMasukModal{{ $absensi->id }}">

                                        <span
                                            class="badge
                                                    bg-success
                                                    bg-opacity-10
                                                    text-success
                                                    px-3 py-2">

                                            <i
                                                class="mdi
                                                        mdi-login me-1">
                                            </i>

                                            {{ $absensi->jam_masuk }}

                                            <i
                                                class="mdi
                                                        mdi-image-outline ms-1">
                                            </i>

                                        </span>

                                    </button>

                                    @else

                                    <span
                                        class="badge
                                                bg-success
                                                bg-opacity-10
                                                text-success
                                                px-3 py-2">

                                        <i
                                            class="mdi
                                                    mdi-login me-1">
                                        </i>

                                        {{ $absensi->jam_masuk }}

                                    </span>

                                    @endif

                                    @else

                                    <span class="text-muted">
                                        -
                                    </span>

                                    @endif

                                </td>


                                {{-- =================================================
                                     JAM PULANG
                                ================================================== --}}

                                <td>

                                    @if($absensi->jam_pulang)

                                    @if($absensi->foto_pulang)

                                    <button
                                        type="button"
                                        class="btn btn-link
                                                p-0 text-decoration-none"
                                        data-bs-toggle="modal"
                                        data-bs-target="#fotoPulangModal{{ $absensi->id }}">

                                        <span
                                            class="badge
                                                    bg-primary
                                                    bg-opacity-10
                                                    text-primary
                                                    px-3 py-2">

                                            <i
                                                class="mdi
                                                        mdi-logout me-1">
                                            </i>

                                            {{ $absensi->jam_pulang }}

                                            <i
                                                class="mdi
                                                        mdi-image-outline ms-1">
                                            </i>

                                        </span>

                                    </button>

                                    @else

                                    <span
                                        class="badge
                                                bg-primary
                                                bg-opacity-10
                                                text-primary
                                                px-3 py-2">

                                        <i
                                            class="mdi
                                                    mdi-logout me-1">
                                        </i>

                                        {{ $absensi->jam_pulang }}

                                    </span>

                                    @endif

                                    @else

                                    <span
                                        class="text-muted small">

                                        Belum pulang

                                    </span>

                                    @endif

                                </td>


                                {{-- STATUS --}}

                                <td>

                                    @if(
                                    $absensi->status === 'hadir'
                                    )

                                    <span
                                        class="badge
                                            bg-success px-3 py-2">

                                        <i
                                            class="mdi
                                                mdi-check-circle-outline
                                                me-1">
                                        </i>

                                        Hadir

                                    </span>

                                    @elseif(
                                    $absensi->status === 'izin'
                                    )

                                    <span
                                        class="badge
                                            bg-warning
                                            text-dark px-3 py-2">

                                        <i
                                            class="mdi
                                                mdi-information-outline
                                                me-1">
                                        </i>

                                        Izin

                                    </span>

                                    @elseif(
                                    $absensi->status === 'sakit'
                                    )

                                    <span
                                        class="badge
                                            bg-info px-3 py-2">

                                        <i
                                            class="mdi
                                                mdi-medical-bag me-1">
                                        </i>

                                        Sakit

                                    </span>

                                    @else

                                    <span
                                        class="badge
                                            bg-secondary px-3 py-2">

                                        {{
                                                ucfirst(
                                                    $absensi->status ?? '-'
                                                )
                                            }}

                                    </span>

                                    @endif

                                </td>


                                {{-- METODE --}}

                                <td>

                                    @if(
                                    $absensi->metode_verifikasi
                                    === 'gps_face'
                                    )

                                    <span
                                        class="badge
                                            bg-primary
                                            bg-opacity-10
                                            text-primary
                                            px-3 py-2">

                                        <i
                                            class="mdi
                                                mdi-map-marker-radius
                                                me-1">
                                        </i>

                                        GPS + Wajah

                                    </span>

                                    @elseif(
                                    $absensi->metode_verifikasi
                                    )

                                    <span
                                        class="text-muted small">

                                        {{
                                                $absensi
                                                    ->metode_verifikasi
                                            }}

                                    </span>

                                    @else

                                    <span class="text-muted">
                                        -
                                    </span>

                                    @endif

                                </td>

                            </tr>


                            {{-- =================================================
                                 MODAL FOTO MASUK
                            ================================================== --}}

                            @if($absensi->foto_masuk)

                            <div
                                class="modal fade"
                                id="fotoMasukModal{{ $absensi->id }}"
                                tabindex="-1"
                                aria-hidden="true">

                                <div
                                    class="modal-dialog
                                    modal-dialog-centered
                                    modal-lg">

                                    <div class="modal-content border-0">

                                        <div class="modal-header">

                                            <div>

                                                <h5
                                                    class="modal-title
                                                    fw-bold">

                                                    Foto Absen Masuk

                                                </h5>

                                                <small
                                                    class="text-muted">

                                                    {{
                                                        \Carbon\Carbon::parse(
                                                            $absensi->tanggal
                                                        )->translatedFormat(
                                                            'd F Y'
                                                        )
                                                    }}

                                                    •
                                                    {{ $absensi->jam_masuk }}

                                                </small>

                                            </div>

                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close">
                                            </button>

                                        </div>

                                        <div
                                            class="modal-body
                                            text-center p-3">

                                            <img
                                                src="{{ asset(
                                                    'storage/' .
                                                    $absensi->foto_masuk
                                                ) }}"
                                                alt="Foto Absen Masuk"
                                                class="img-fluid rounded"
                                                style="
                                                    max-height:70vh;
                                                    width:auto;
                                                    max-width:100%;
                                                    object-fit:contain;
                                                ">

                                        </div>

                                    </div>

                                </div>

                            </div>

                            @endif


                            {{-- =================================================
                                 MODAL FOTO PULANG
                            ================================================== --}}

                            @if($absensi->foto_pulang)

                            <div
                                class="modal fade"
                                id="fotoPulangModal{{ $absensi->id }}"
                                tabindex="-1"
                                aria-hidden="true">

                                <div
                                    class="modal-dialog
                                    modal-dialog-centered
                                    modal-lg">

                                    <div class="modal-content border-0">

                                        <div class="modal-header">

                                            <div>

                                                <h5
                                                    class="modal-title
                                                    fw-bold">

                                                    Foto Absen Pulang

                                                </h5>

                                                <small
                                                    class="text-muted">

                                                    {{
                                                        \Carbon\Carbon::parse(
                                                            $absensi->tanggal
                                                        )->translatedFormat(
                                                            'd F Y'
                                                        )
                                                    }}

                                                    •
                                                    {{ $absensi->jam_pulang }}

                                                </small>

                                            </div>

                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close">
                                            </button>

                                        </div>

                                        <div
                                            class="modal-body
                                            text-center p-3">

                                            <img
                                                src="{{ asset(
                                                    'storage/' .
                                                    $absensi->foto_pulang
                                                ) }}"
                                                alt="Foto Absen Pulang"
                                                class="img-fluid rounded"
                                                style="
                                                    max-height:70vh;
                                                    width:auto;
                                                    max-width:100%;
                                                    object-fit:contain;
                                                ">

                                        </div>

                                    </div>

                                </div>

                            </div>

                            @endif

                            @endforeach

                        </tbody>

                    </table>

                </div>


                {{-- PAGINATION --}}

                <div
                    class="d-flex justify-content-between
                    align-items-center mt-4 flex-wrap">

                    <div
                        class="text-muted small
                        mb-2 mb-md-0">

                        Menampilkan

                        <strong>
                            {{ $absensis->firstItem() ?? 0 }}
                        </strong>

                        sampai

                        <strong>
                            {{ $absensis->lastItem() ?? 0 }}
                        </strong>

                        dari

                        <strong>
                            {{ $absensis->total() }}
                        </strong>

                        data

                    </div>


                    <div>

                        {{ $absensis->links() }}

                    </div>

                </div>


                @else

                {{-- EMPTY STATE --}}

                <div class="text-center py-5">

                    <div
                        class="rounded-circle bg-light
                        d-flex align-items-center
                        justify-content-center mx-auto"
                        style="
                            width:80px;
                            height:80px;
                        ">

                        <i
                            class="mdi
                            mdi-calendar-remove-outline
                            text-muted"
                            style="font-size:40px;">
                        </i>

                    </div>


                    <h6 class="fw-bold mt-4 mb-2">

                        Belum Ada Data Absensi

                    </h6>


                    <p class="text-muted small mb-0">

                        Riwayat kehadiran Anda belum tersedia.

                    </p>

                </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection