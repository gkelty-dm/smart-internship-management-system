@extends('layouts.skydash-admin')

@section('title', 'Penempatan PKL')

@section('content')

<style>
    /* =========================================================
       PENEMPATAN PKL
    ========================================================= */

    .penempatan-table {
        min-width: 1100px;
    }

    .penempatan-table th,
    .penempatan-table td {
        white-space: nowrap;
        vertical-align: middle;
    }

    /* =========================================================
       PAGINATION
    ========================================================= */

    .pagination {
        margin-bottom: 0;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 4px;
    }

    .pagination .page-item {
        margin: 0;
    }

    .pagination .page-link {
        width: 32px;
        height: 32px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px !important;
        font-size: 11px;
        line-height: 1;
        color: #4b49ac;
        border: 1px solid #e5e5eb;
        background: #fff;
        box-shadow: none;
    }

    .pagination .page-link:hover {
        background: #f5f4ff;
        color: #4b49ac;
        border-color: #d8d7ef;
    }

    .pagination .page-item.active .page-link {
        background: #4b49ac;
        border-color: #4b49ac;
        color: #fff;
    }

    .pagination .page-item.disabled .page-link {
        color: #c5c5cc;
        background: #fafafa;
        border-color: #eeeeee;
    }

    .pagination .page-link svg {
        width: 14px !important;
        height: 14px !important;
        max-width: 14px !important;
        max-height: 14px !important;
        display: block;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 767.98px) {

        .penempatan-header-action {
            width: 100%;
        }

        .penempatan-header-action .btn {
            width: 100%;
        }

        .pagination .page-link {
            width: 29px;
            height: 29px;
            font-size: 10px;
        }

        .pagination .page-link svg {
            width: 12px !important;
            height: 12px !important;
            max-width: 12px !important;
            max-height: 12px !important;
        }

    }
</style>


<div class="row">

    {{-- =========================================================
         HEADER
    ========================================================= --}}
    <div class="col-md-12 grid-margin">

        <div class="row align-items-center">

            <div class="col-12 col-xl-8 mb-3 mb-xl-0">

                <h3 class="font-weight-bold mb-1">
                    Penempatan PKL
                </h3>

                <h6 class="font-weight-normal text-muted mb-0">

                    Kelola penempatan siswa pada perusahaan,
                    guru pembimbing, dan pembimbing industri.

                </h6>

            </div>


            <div class="col-12 col-xl-4">

                <div
                    class="d-flex justify-content-start justify-content-xl-end penempatan-header-action">

                    <a
                        href="{{ route('admin.penempatan-pkl.create') }}"
                        class="btn btn-sm btn-primary btn-icon-text shadow-sm">

                        <i class="mdi mdi-plus btn-icon-prepend"></i>

                        Tambah Penempatan

                    </a>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         ALERT SUCCESS
    ========================================================= --}}
    @if(session('success'))

    <div class="col-12">

        <div
            class="alert alert-success alert-dismissible fade show border-0 shadow-sm"
            role="alert">

            <strong>

                <i class="mdi mdi-check-circle me-1"></i>

                Berhasil:

            </strong>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close">
            </button>

        </div>

    </div>

    @endif


    {{-- =========================================================
         ALERT ERROR
    ========================================================= --}}
    @if(session('error'))

    <div class="col-12">

        <div
            class="alert alert-danger alert-dismissible fade show border-0 shadow-sm"
            role="alert">

            <strong>

                <i class="mdi mdi-alert-circle me-1"></i>

                Gagal:

            </strong>

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close">
            </button>

        </div>

    </div>

    @endif


    {{-- =========================================================
         STATISTIK
    ========================================================= --}}

    {{-- TOTAL --}}
    <div class="col-md-3 stretch-card grid-margin">

        <div
            class="card text-white shadow-sm"
            style="
                background: linear-gradient(135deg, #79a0f8 0%, #4b49ac 100%);
                border-radius: 12px;
                border: none;
            ">

            <div
                class="card-body p-4 d-flex justify-content-between align-items-center">

                <div>

                    <p
                        class="mb-1 font-weight-medium"
                        style="opacity:.9;">

                        Total Penempatan

                    </p>

                    <h2 class="mb-1 font-weight-bold">

                        {{ $totalPenempatan }}

                    </h2>

                    <small style="opacity:.8;">

                        Seluruh penempatan PKL

                    </small>

                </div>


                <div
                    class="p-3 bg-white bg-opacity-10 rounded-circle">

                    <i
                        class="mdi mdi-briefcase-account text-white"
                        style="font-size:28px;">
                    </i>

                </div>

            </div>

        </div>

    </div>


    {{-- AKTIF --}}
    <div class="col-md-3 stretch-card grid-margin">

        <div
            class="card text-white shadow-sm"
            style="
                background: linear-gradient(135deg, #20c997 0%, #168f6b 100%);
                border-radius: 12px;
                border: none;
            ">

            <div
                class="card-body p-4 d-flex justify-content-between align-items-center">

                <div>

                    <p
                        class="mb-1 font-weight-medium"
                        style="opacity:.9;">

                        Aktif

                    </p>

                    <h2 class="mb-1 font-weight-bold">

                        {{ $totalAktif }}

                    </h2>

                    <small style="opacity:.8;">

                        Sedang melaksanakan PKL

                    </small>

                </div>


                <div
                    class="p-3 bg-white bg-opacity-10 rounded-circle">

                    <i
                        class="mdi mdi-check-circle-outline text-white"
                        style="font-size:28px;">
                    </i>

                </div>

            </div>

        </div>

    </div>


    {{-- PENDING --}}
    <div class="col-md-3 stretch-card grid-margin">

        <div
            class="card text-white shadow-sm"
            style="
                background: linear-gradient(135deg, #f7b731 0%, #d68910 100%);
                border-radius: 12px;
                border: none;
            ">

            <div
                class="card-body p-4 d-flex justify-content-between align-items-center">

                <div>

                    <p
                        class="mb-1 font-weight-medium"
                        style="opacity:.9;">

                        Pending

                    </p>

                    <h2 class="mb-1 font-weight-bold">

                        {{ $totalPending }}

                    </h2>

                    <small style="opacity:.8;">

                        Menunggu proses

                    </small>

                </div>


                <div
                    class="p-3 bg-white bg-opacity-10 rounded-circle">

                    <i
                        class="mdi mdi-clock-outline text-white"
                        style="font-size:28px;">
                    </i>

                </div>

            </div>

        </div>

    </div>


    {{-- SELESAI --}}
    <div class="col-md-3 stretch-card grid-margin">

        <div
            class="card text-white shadow-sm"
            style="
                background: linear-gradient(135deg, #17c1e8 0%, #117fa3 100%);
                border-radius: 12px;
                border: none;
            ">

            <div
                class="card-body p-4 d-flex justify-content-between align-items-center">

                <div>

                    <p
                        class="mb-1 font-weight-medium"
                        style="opacity:.9;">

                        Selesai

                    </p>

                    <h2 class="mb-1 font-weight-bold">

                        {{ $totalSelesai }}

                    </h2>

                    <small style="opacity:.8;">

                        PKL telah selesai

                    </small>

                </div>


                <div
                    class="p-3 bg-white bg-opacity-10 rounded-circle">

                    <i
                        class="mdi mdi-check-all text-white"
                        style="font-size:28px;">
                    </i>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         FILTER
    ========================================================= --}}
    <div class="col-12 grid-margin stretch-card">

        <div
            class="card shadow-sm border-0"
            style="border-radius:12px;">

            <div class="card-body p-4">

                <div
                    class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-3">

                    <div class="d-flex align-items-center">

                        <div
                            class="bg-primary text-white p-2 rounded-3 me-3 d-flex align-items-center justify-content-center"
                            style="width:38px;height:38px;">

                            <i
                                class="mdi mdi-filter-variant"
                                style="font-size:20px;">
                            </i>

                        </div>


                        <div>

                            <h5
                                class="card-title font-weight-bold mb-0 text-dark">

                                Pencarian & Filter Data

                            </h5>

                            <p class="text-muted small mb-0">

                                Cari penempatan berdasarkan siswa,
                                perusahaan, pembimbing, atau status.

                            </p>

                        </div>

                    </div>


                    @if(request()->hasAny([
                    'search',
                    'status_pkl'
                    ]))

                    <span
                        class="badge bg-soft-primary text-primary border border-primary px-3 py-2 rounded-pill font-weight-medium">

                        <i class="mdi mdi-filter-check me-1"></i>

                        Filter Aktif

                    </span>

                    @endif

                </div>


                <form
                    method="GET"
                    action="{{ route('admin.penempatan-pkl.index') }}">

                    <div class="row align-items-end">

                        {{-- SEARCH --}}
                        <div class="col-lg-7 col-md-6">

                            <div class="form-group mb-3 mb-lg-0">

                                <label
                                    for="search"
                                    class="form-label font-weight-bold text-dark small">

                                    Kata Kunci

                                </label>


                                <div class="input-group input-group-sm">

                                    <span
                                        class="input-group-text bg-light border-end-0 text-muted">

                                        <i class="mdi mdi-magnify"></i>

                                    </span>


                                    <input
                                        type="text"
                                        name="search"
                                        id="search"
                                        class="form-control border-start-0 ps-0"
                                        value="{{ request('search') }}"
                                        placeholder="Nama siswa, perusahaan, guru pembimbing, atau pembimbing industri..."
                                        autocomplete="off">

                                </div>

                            </div>

                        </div>


                        {{-- STATUS --}}
                        <div class="col-lg-3 col-md-4">

                            <div class="form-group mb-3 mb-lg-0">

                                <label
                                    for="status_pkl"
                                    class="form-label font-weight-bold text-dark small">

                                    Status PKL

                                </label>


                                <select
                                    name="status_pkl"
                                    id="status_pkl"
                                    class="form-control form-control-sm">

                                    <option value="">
                                        Semua Status
                                    </option>

                                    <option
                                        value="pending"
                                        {{ request('status_pkl') === 'pending' ? 'selected' : '' }}>

                                        Pending

                                    </option>

                                    <option
                                        value="aktif"
                                        {{ request('status_pkl') === 'aktif' ? 'selected' : '' }}>

                                        Aktif

                                    </option>

                                    <option
                                        value="selesai"
                                        {{ request('status_pkl') === 'selesai' ? 'selected' : '' }}>

                                        Selesai

                                    </option>

                                    <option
                                        value="dibatalkan"
                                        {{ request('status_pkl') === 'dibatalkan' ? 'selected' : '' }}>

                                        Dibatalkan

                                    </option>

                                </select>

                            </div>

                        </div>


                        {{-- BUTTON --}}
                        <div class="col-lg-2 col-md-2">

                            <div class="d-flex gap-2 mb-3 mb-lg-0">

                                <button
                                    type="submit"
                                    class="btn btn-sm btn-primary w-100 font-weight-medium d-flex align-items-center justify-content-center">

                                    <i class="mdi mdi-magnify me-1"></i>

                                    Cari

                                </button>


                                @if(request()->hasAny([
                                'search',
                                'status_pkl'
                                ]))

                                <a
                                    href="{{ route('admin.penempatan-pkl.index') }}"
                                    class="btn btn-sm btn-outline-secondary d-flex align-items-center justify-content-center px-3"
                                    title="Reset">

                                    <i class="mdi mdi-refresh"></i>

                                </a>

                                @endif

                            </div>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- =========================================================
         TABLE
    ========================================================= --}}
    <div class="col-12 grid-margin stretch-card">

        <div
            class="card shadow-sm border-0"
            style="border-radius:12px;">

            <div class="card-body">

                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3">

                    <div>

                        <p class="card-title mb-1">
                            Daftar Penempatan PKL
                        </p>

                        <p class="text-muted font-weight-normal mb-0">

                            Seluruh data penempatan siswa
                            pada lokasi PKL.

                        </p>

                    </div>


                    <div class="mt-2 mt-md-0">

                        <span
                            class="badge bg-primary text-white font-weight-medium px-3 py-2 rounded-pill">

                            <i class="mdi mdi-account-school-outline me-1"></i>

                            Total:
                            {{ $penempatans->total() }}
                            Data

                        </span>

                    </div>

                </div>


                {{-- TABLE RESPONSIVE --}}
                <div class="table-responsive">

                    <table
                        class="table table-hover align-middle penempatan-table">

                        <thead class="bg-light">

                            <tr>

                                <th style="width:55px;">
                                    No
                                </th>

                                <th>
                                    Siswa
                                </th>

                                <th>
                                    Perusahaan
                                </th>

                                <th>
                                    Guru Pembimbing
                                </th>

                                <th>
                                    Pembimbing Industri
                                </th>

                                <th>
                                    Periode
                                </th>

                                <th>
                                    Status
                                </th>

                                <th
                                    class="text-center"
                                    style="width:130px;">

                                    Aksi

                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($penempatans as $penempatan)

                            <tr>

                                {{-- NO --}}
                                <td class="font-weight-bold text-muted">

                                    {{ $penempatans->firstItem() + $loop->index }}

                                </td>


                                {{-- SISWA --}}
                                <td>

                                    <div class="d-flex align-items-center">

                                        <div
                                            class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                                            style="width:42px;height:42px;">

                                            <i
                                                class="mdi mdi-account-school-outline text-primary"
                                                style="font-size:21px;">
                                            </i>

                                        </div>


                                        <div>

                                            <h6
                                                class="font-weight-bold mb-1 text-dark">

                                                {{ $penempatan->siswa->user->name ?? '-' }}

                                            </h6>

                                            <small class="text-muted">

                                                NISN:
                                                {{ $penempatan->siswa->nisn ?? '-' }}

                                            </small>

                                        </div>

                                    </div>

                                </td>


                                {{-- PERUSAHAAN --}}
                                <td>

                                    <strong class="text-dark">

                                        {{ $penempatan->perusahaan->nama_perusahaan ?? '-' }}

                                    </strong>

                                </td>


                                {{-- GURU PEMBIMBING --}}
                                <td>

                                    {{ $penempatan->guru->user->name ?? '-' }}

                                </td>


                                {{-- PEMBIMBING INDUSTRI --}}
                                <td>

                                    @if($penempatan->industri)

                                    <strong class="text-dark">

                                        {{ $penempatan->industri->user->name ?? '-' }}

                                    </strong>

                                    @if($penempatan->industri->jabatan)

                                    <small class="text-muted d-block">

                                        {{ $penempatan->industri->jabatan }}

                                    </small>

                                    @endif

                                    @else

                                    <span class="text-muted">

                                        Belum ditentukan

                                    </span>

                                    @endif

                                </td>


                                {{-- PERIODE --}}
                                <td>

                                    <small class="d-block">

                                        <i
                                            class="mdi mdi-calendar-start text-success me-1">
                                        </i>

                                        {{ $penempatan->tanggal_mulai
                                            ? \Carbon\Carbon::parse(
                                                $penempatan->tanggal_mulai
                                            )->format('d/m/Y')
                                            : '-'
                                        }}

                                    </small>


                                    <small class="text-muted d-block mt-1">

                                        <i
                                            class="mdi mdi-calendar-end text-danger me-1">
                                        </i>

                                        {{ $penempatan->tanggal_selesai
                                            ? \Carbon\Carbon::parse(
                                                $penempatan->tanggal_selesai
                                            )->format('d/m/Y')
                                            : '-'
                                        }}

                                    </small>

                                </td>


                                {{-- STATUS --}}
                                <td>

                                    @if($penempatan->status_pkl === 'pending')

                                    <span
                                        class="badge badge-warning">

                                        <i class="mdi mdi-clock-outline me-1"></i>

                                        Pending

                                    </span>

                                    @elseif($penempatan->status_pkl === 'aktif')

                                    <span
                                        class="badge badge-success">

                                        <i class="mdi mdi-check-circle-outline me-1"></i>

                                        Aktif

                                    </span>

                                    @elseif($penempatan->status_pkl === 'selesai')

                                    <span
                                        class="badge badge-primary">

                                        <i class="mdi mdi-check-all me-1"></i>

                                        Selesai

                                    </span>

                                    @elseif($penempatan->status_pkl === 'dibatalkan')

                                    <span
                                        class="badge badge-danger">

                                        <i class="mdi mdi-close-circle-outline me-1"></i>

                                        Dibatalkan

                                    </span>

                                    @else

                                    <span
                                        class="badge badge-secondary">

                                        {{ ucfirst($penempatan->status_pkl ?? '-') }}

                                    </span>

                                    @endif

                                </td>


                                {{-- AKSI --}}
                                <td class="text-center">

                                    <div
                                        class="d-flex justify-content-center align-items-center gap-1">


                                        {{-- DETAIL --}}
                                        <a
                                            href="{{ route(
                                                'admin.penempatan-pkl.show',
                                                $penempatan->id
                                            ) }}"
                                            class="btn btn-sm btn-outline-info btn-icon d-flex align-items-center justify-content-center rounded-circle"
                                            title="Detail"
                                            style="width:32px;height:32px;padding:0;">

                                            <i
                                                class="mdi mdi-eye-outline"
                                                style="font-size:16px;">
                                            </i>

                                        </a>


                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route(
                                                'admin.penempatan-pkl.edit',
                                                $penempatan->id
                                            ) }}"
                                            class="btn btn-sm btn-outline-primary btn-icon d-flex align-items-center justify-content-center rounded-circle"
                                            title="Edit"
                                            style="width:32px;height:32px;padding:0;">

                                            <i
                                                class="mdi mdi-square-edit-outline"
                                                style="font-size:16px;">
                                            </i>

                                        </a>


                                        {{-- HAPUS --}}
                                        <form
                                            action="{{ route(
                                                'admin.penempatan-pkl.destroy',
                                                $penempatan->id
                                            ) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus penempatan PKL ini?')">

                                            @csrf

                                            @method('DELETE')


                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-outline-danger btn-icon d-flex align-items-center justify-content-center rounded-circle"
                                                title="Hapus"
                                                style="width:32px;height:32px;padding:0;">

                                                <i
                                                    class="mdi mdi-trash-can-outline"
                                                    style="font-size:16px;">
                                                </i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>


                            @empty

                            <tr>

                                <td
                                    colspan="8"
                                    class="text-center py-5">

                                    <div class="mb-3">

                                        <div
                                            class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center"
                                            style="width:80px;height:80px;">

                                            <i
                                                class="mdi mdi-account-school-outline text-muted"
                                                style="font-size:40px;">
                                            </i>

                                        </div>

                                    </div>


                                    <h5
                                        class="font-weight-bold mb-1">

                                        @if(request()->hasAny([
                                        'search',
                                        'status_pkl'
                                        ]))

                                        Data Tidak Ditemukan

                                        @else

                                        Belum Ada Data Penempatan

                                        @endif

                                    </h5>


                                    <p class="text-muted mb-3">

                                        @if(request()->hasAny([
                                        'search',
                                        'status_pkl'
                                        ]))

                                        Tidak ada penempatan PKL
                                        yang sesuai dengan filter.

                                        @else

                                        Belum terdapat data penempatan
                                        PKL dalam sistem.

                                        @endif

                                    </p>


                                    @if(request()->hasAny([
                                    'search',
                                    'status_pkl'
                                    ]))

                                    <a
                                        href="{{ route('admin.penempatan-pkl.index') }}"
                                        class="btn btn-light btn-sm">

                                        <i class="mdi mdi-refresh me-1"></i>

                                        Reset Filter

                                    </a>

                                    @else

                                    <a
                                        href="{{ route('admin.penempatan-pkl.create') }}"
                                        class="btn btn-primary btn-sm">

                                        <i class="mdi mdi-plus me-1"></i>

                                        Tambah Penempatan

                                    </a>

                                    @endif

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- =================================================
                     PAGINATION
                ================================================== --}}

                @if($penempatans->hasPages())

                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 pt-3 border-top gap-2">

                    <small class="text-muted">

                        Menampilkan

                        <strong>
                            {{ $penempatans->firstItem() ?? 0 }}
                        </strong>

                        sampai

                        <strong>
                            {{ $penempatans->lastItem() ?? 0 }}
                        </strong>

                        dari

                        <strong>
                            {{ $penempatans->total() ?? 0 }}
                        </strong>

                        data

                    </small>


                    <div>

                        {{ $penempatans->appends(request()->query())->links('pagination::bootstrap-5') }}

                    </div>

                </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection