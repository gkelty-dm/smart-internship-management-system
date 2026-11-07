@extends('layouts.skydash-siswa')

@section('title', 'Logbook PKL')

@section('content')


{{-- =========================================================
     HEADER
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div
                    class="d-flex justify-content-between
                    align-items-center flex-wrap">

                    <div class="d-flex align-items-center">

                        <div
                            class="rounded-3
                            bg-primary bg-opacity-10
                            d-flex align-items-center
                            justify-content-center me-3"
                            style="width:52px;height:52px;">

                            <i
                                class="mdi mdi-book-open-page-variant
                                text-primary"
                                style="font-size:27px;">
                            </i>

                        </div>


                        <div>

                            <h4 class="fw-bold mb-1">
                                Logbook PKL
                            </h4>

                            <p class="text-muted mb-0">
                                Kelola dan pantau kegiatan PKL Anda.
                            </p>

                        </div>

                    </div>


                    <a
                        href="{{ route(
                            'siswa.logbook.create'
                        ) }}"
                        class="btn btn-primary mt-3 mt-md-0">

                        <i class="mdi mdi-plus me-1"></i>

                        Tambah Logbook

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>



{{-- =========================================================
     ALERT
========================================================= --}}

@if(session('success'))

<div
    class="alert alert-success
    alert-dismissible fade show
    border-0 shadow-sm"
    role="alert">

    <div class="d-flex align-items-center">

        <i
            class="mdi mdi-check-circle-outline me-2"
            style="font-size:22px;">
        </i>

        <span>
            {{ session('success') }}
        </span>

    </div>


    <button
        type="button"
        class="btn-close"
        data-bs-dismiss="alert">
    </button>

</div>

@endif



@if(session('error'))

<div
    class="alert alert-danger
    alert-dismissible fade show
    border-0 shadow-sm"
    role="alert">

    <div class="d-flex align-items-center">

        <i
            class="mdi mdi-alert-circle-outline me-2"
            style="font-size:22px;">
        </i>

        <span>
            {{ session('error') }}
        </span>

    </div>


    <button
        type="button"
        class="btn-close"
        data-bs-dismiss="alert">
    </button>

</div>

@endif



{{-- =========================================================
     STATISTIK
========================================================= --}}

<div class="row">


    {{-- TOTAL --}}

    <div
        class="col-md-6 col-lg-3
        grid-margin stretch-card">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div
                    class="d-flex
                    justify-content-between
                    align-items-start">

                    <div>

                        <p class="text-muted small mb-2">
                            Total Logbook
                        </p>

                        <h3 class="fw-bold mb-1">
                            {{ $totalLogbook }}
                        </h3>

                        <small class="text-muted">
                            Seluruh kegiatan
                        </small>

                    </div>


                    <div
                        class="rounded-3
                        bg-primary bg-opacity-10
                        d-flex align-items-center
                        justify-content-center"
                        style="width:46px;height:46px;">

                        <i
                            class="mdi mdi-book-open-page-variant
                            text-primary"
                            style="font-size:23px;">
                        </i>

                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- PENDING --}}

    <div
        class="col-md-6 col-lg-3
        grid-margin stretch-card">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div
                    class="d-flex
                    justify-content-between
                    align-items-start">

                    <div>

                        <p class="text-muted small mb-2">
                            Menunggu Validasi
                        </p>

                        <h3
                            class="fw-bold
                            text-warning mb-1">

                            {{ $totalPending }}

                        </h3>

                        <small class="text-muted">
                            Sedang diperiksa
                        </small>

                    </div>


                    <div
                        class="rounded-3
                        bg-warning bg-opacity-10
                        d-flex align-items-center
                        justify-content-center"
                        style="width:46px;height:46px;">

                        <i
                            class="mdi mdi-clock-outline
                            text-warning"
                            style="font-size:23px;">
                        </i>

                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- DISETUJUI --}}

    <div
        class="col-md-6 col-lg-3
        grid-margin stretch-card">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div
                    class="d-flex
                    justify-content-between
                    align-items-start">

                    <div>

                        <p class="text-muted small mb-2">
                            Disetujui
                        </p>

                        <h3
                            class="fw-bold
                            text-success mb-1">

                            {{ $totalDisetujui }}

                        </h3>

                        <small class="text-muted">
                            Kegiatan diterima
                        </small>

                    </div>


                    <div
                        class="rounded-3
                        bg-success bg-opacity-10
                        d-flex align-items-center
                        justify-content-center"
                        style="width:46px;height:46px;">

                        <i
                            class="mdi mdi-check-circle-outline
                            text-success"
                            style="font-size:23px;">
                        </i>

                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- DITOLAK --}}

    <div
        class="col-md-6 col-lg-3
        grid-margin stretch-card">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div
                    class="d-flex
                    justify-content-between
                    align-items-start">

                    <div>

                        <p class="text-muted small mb-2">
                            Ditolak
                        </p>

                        <h3
                            class="fw-bold
                            text-danger mb-1">

                            {{ $totalDitolak }}

                        </h3>

                        <small class="text-muted">
                            Perlu diperbaiki
                        </small>

                    </div>


                    <div
                        class="rounded-3
                        bg-danger bg-opacity-10
                        d-flex align-items-center
                        justify-content-center"
                        style="width:46px;height:46px;">

                        <i
                            class="mdi mdi-close-circle-outline
                            text-danger"
                            style="font-size:23px;">
                        </i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



{{-- =========================================================
     RIWAYAT LOGBOOK
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card border-0 shadow-sm">

            <div class="card-body">


                {{-- HEADER TABLE --}}

                <div
                    class="d-flex
                    justify-content-between
                    align-items-center
                    mb-4 flex-wrap">

                    <div>

                        <h5 class="card-title mb-1">
                            Riwayat Logbook
                        </h5>

                        <p class="text-muted small mb-0">
                            Daftar kegiatan PKL yang telah Anda input.
                        </p>

                    </div>


                    @if($logbooks->count())

                    <span
                        class="badge bg-primary
                        px-3 py-2
                        mt-2 mt-md-0">

                        <i
                            class="mdi mdi-book-open-outline me-1">
                        </i>

                        {{ $logbooks->total() }} Data

                    </span>

                    @endif

                </div>



                @if($logbooks->count())


                {{-- =================================================
                     TABLE
                ================================================== --}}

                <div class="table-responsive">

                    <table
                        class="table table-hover
                        align-middle mb-0">

                        <thead>

                            <tr>

                                <th class="text-muted small">
                                    No
                                </th>

                                <th class="text-muted small">
                                    Tanggal
                                </th>

                                <th class="text-muted small">
                                    Kegiatan
                                </th>

                                <th class="text-muted small">
                                    Dokumentasi
                                </th>

                                <th class="text-muted small">
                                    Status
                                </th>

                                <th
                                    class="text-muted small text-end">

                                    Aksi

                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach(
                            $logbooks as $logbook
                            )

                            <tr>


                                {{-- NO --}}

                                <td>

                                    <span class="fw-semibold">

                                        {{
                                            $logbooks->firstItem()
                                            + $loop->index
                                        }}

                                    </span>

                                </td>



                                {{-- TANGGAL --}}

                                <td class="text-nowrap">

                                    <div
                                        class="d-flex
                                        align-items-center">

                                        <div
                                            class="rounded-2
                                            bg-light
                                            d-flex
                                            align-items-center
                                            justify-content-center
                                            me-2"
                                            style="
                                                width:36px;
                                                height:36px;
                                            ">

                                            <i
                                                class="mdi mdi-calendar-outline
                                                text-primary">
                                            </i>

                                        </div>


                                        <div>

                                            <span
                                                class="fw-semibold
                                                d-block">

                                                {{
                                                    \Carbon\Carbon::parse(
                                                        $logbook->tanggal
                                                    )->translatedFormat(
                                                        'd F Y'
                                                    )
                                                }}

                                            </span>

                                        </div>

                                    </div>

                                </td>



                                {{-- KEGIATAN --}}

                                <td>

                                    <div
                                        class="fw-semibold"
                                        style="max-width:320px;">

                                        {{
                                            \Illuminate\Support\Str::limit(
                                                $logbook->kegiatan,
                                                60
                                            )
                                        }}

                                    </div>

                                </td>



                                {{-- DOKUMENTASI --}}

                                <td>

                                    @if(
                                    $logbook->fotos->count()
                                    )

                                    <span
                                        class="badge
                                        bg-info bg-opacity-10
                                        text-info px-3 py-2">

                                        <i
                                            class="mdi mdi-image-outline
                                            me-1">
                                        </i>

                                        {{
                                            $logbook->fotos->count()
                                        }}
                                        Foto

                                    </span>

                                    @else

                                    <span
                                        class="text-muted small">

                                        <i
                                            class="mdi mdi-image-off-outline
                                            me-1">
                                        </i>

                                        Tidak ada

                                    </span>

                                    @endif

                                </td>



                                {{-- STATUS --}}

                                <td>

                                    @if(
                                    $logbook->status_validasi
                                    == 'disetujui'
                                    )

                                    <span
                                        class="badge
                                        bg-success px-3 py-2">

                                        <i
                                            class="mdi mdi-check-circle-outline
                                            me-1">
                                        </i>

                                        Disetujui

                                    </span>


                                    @elseif(
                                    $logbook->status_validasi
                                    == 'ditolak'
                                    )

                                    <span
                                        class="badge
                                        bg-danger px-3 py-2">

                                        <i
                                            class="mdi mdi-close-circle-outline
                                            me-1">
                                        </i>

                                        Ditolak

                                    </span>


                                    @else

                                    <span
                                        class="badge
                                        bg-warning text-dark
                                        px-3 py-2">

                                        <i
                                            class="mdi mdi-clock-outline
                                            me-1">
                                        </i>

                                        Menunggu

                                    </span>

                                    @endif

                                </td>



                                {{-- =================================================
                                     AKSI
                                ================================================== --}}

                                <td
                                    class="text-end
                                    text-nowrap">


                                    {{-- DETAIL --}}

                                    <a
                                        href="{{ route(
                                            'siswa.logbook.show',
                                            $logbook->id
                                        ) }}"
                                        class="btn btn-sm btn-light"
                                        data-bs-toggle="tooltip"
                                        title="Lihat Detail">

                                        <i
                                            class="mdi mdi-eye-outline">
                                        </i>

                                    </a>



                                    {{-- EDIT --}}

                                    @if(
                                    $logbook->status_validasi
                                    == 'ditolak'
                                    )

                                    <a
                                        href="{{ route(
                                            'siswa.logbook.edit',
                                            $logbook->id
                                        ) }}"
                                        class="btn btn-sm btn-primary"
                                        data-bs-toggle="tooltip"
                                        title="Edit Logbook">

                                        <i
                                            class="mdi mdi-pencil-outline">
                                        </i>

                                    </a>

                                    @endif



                                    {{-- =================================================
                                         DELETE
                                         TANPA confirm()
                                    ================================================== --}}

                                    @if(
                                    in_array(
                                    $logbook->status_validasi,
                                    [
                                    'pending',
                                    'ditolak'
                                    ]
                                    )
                                    )

                                    <form
                                        action="{{ route(
                                            'siswa.logbook.destroy',
                                            $logbook->id
                                        ) }}"
                                        method="POST"
                                        class="d-inline">

                                        @csrf

                                        @method('DELETE')


                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-danger btn-delete"
                                            data-name="Logbook {{ \Carbon\Carbon::parse($logbook->tanggal)->translatedFormat('d F Y') }}"
                                            data-bs-toggle="tooltip"
                                            title="Hapus Logbook">

                                            <i
                                                class="mdi mdi-delete-outline">
                                            </i>

                                        </button>

                                    </form>

                                    @endif


                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>



                {{-- =================================================
                     PAGINATION
                ================================================== --}}

                <div
                    class="d-flex
                    justify-content-between
                    align-items-center
                    mt-4 flex-wrap">

                    <div
                        class="text-muted small
                        mb-2 mb-md-0">

                        Menampilkan

                        <strong>
                            {{ $logbooks->firstItem() }}
                        </strong>

                        sampai

                        <strong>
                            {{ $logbooks->lastItem() }}
                        </strong>

                        dari

                        <strong>
                            {{ $logbooks->total() }}
                        </strong>

                        data

                    </div>


                    <div>

                        {{ $logbooks->links() }}

                    </div>

                </div>


                @else


                {{-- =================================================
                     EMPTY STATE
                ================================================== --}}

                <div
                    class="text-center py-5">

                    <div
                        class="rounded-circle
                        bg-light
                        d-flex
                        align-items-center
                        justify-content-center
                        mx-auto"
                        style="
                            width:82px;
                            height:82px;
                        ">

                        <i
                            class="mdi mdi-book-open-outline
                            text-muted"
                            style="font-size:42px;">
                        </i>

                    </div>


                    <h5
                        class="fw-bold
                        mt-4 mb-2">

                        Belum Ada Logbook

                    </h5>


                    <p
                        class="text-muted
                        mb-4">

                        Anda belum memiliki logbook PKL.
                        Silakan tambahkan kegiatan pertama Anda.

                    </p>


                    <a
                        href="{{ route(
                            'siswa.logbook.create'
                        ) }}"
                        class="btn btn-primary">

                        <i
                            class="mdi mdi-plus me-1">
                        </i>

                        Tambah Logbook

                    </a>

                </div>

                @endif


            </div>

        </div>

    </div>

</div>


@endsection


{{-- =========================================================
     TOOLTIP
========================================================= --}}

@push('scripts')

<script>
    document.addEventListener(
        'DOMContentLoaded',
        function() {

            const tooltipTriggerList =
                document.querySelectorAll(
                    '[data-bs-toggle="tooltip"]'
                );


            tooltipTriggerList.forEach(
                function(tooltipTriggerEl) {

                    if (
                        typeof bootstrap !==
                        'undefined'
                    ) {

                        new bootstrap.Tooltip(
                            tooltipTriggerEl
                        );

                    }

                }
            );

        }
    );
</script>

@endpush