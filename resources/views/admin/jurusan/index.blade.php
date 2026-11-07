@extends('layouts.skydash-admin')

@section('title', 'Data Jurusan')

@section('content')

<style>
    /* =========================================================
       IMPORT MODAL
    ========================================================= */

    .import-modal {
        border: 0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 15px 45px rgba(0, 0, 0, .12);
    }

    .import-modal-header {
        padding: 20px 22px;
        border-bottom: 1px solid #eeeeee;
        background: #ffffff;
    }

    .import-icon {
        width: 44px;
        height: 44px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(25, 135, 84, .10);
        color: #198754;
        margin-right: 12px;
        flex-shrink: 0;
    }

    .import-icon i {
        font-size: 23px;
    }

    .import-title {
        font-size: 15px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 3px;
    }

    .import-subtitle {
        font-size: 10px;
        color: #9a9aa5;
    }

    .import-modal-body {
        padding: 22px;
    }

    /* UPLOAD AREA */

    .upload-area {
        border: 1.5px dashed #d9d9e2;
        border-radius: 10px;
        padding: 27px 20px;
        text-align: center;
        background: #fafaff;
        transition: all .2s ease;
        cursor: pointer;
    }

    .upload-area:hover,
    .upload-area.dragover {
        border-color: #4b49ac;
        background: rgba(75, 73, 172, .035);
    }

    .upload-icon {
        width: 54px;
        height: 54px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(75, 73, 172, .10);
        color: #4b49ac;
        margin: 0 auto 11px;
    }

    .upload-icon i {
        font-size: 27px;
    }

    .upload-title {
        font-size: 13px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 5px;
    }

    .upload-text {
        font-size: 10px;
        color: #8e8e98;
        margin-bottom: 5px;
    }

    .upload-format {
        font-size: 9px;
        color: #b0b0b8;
    }

    .upload-area .btn {
        font-size: 9px;
        border-radius: 6px;
        padding: 7px 13px;
    }

    /* SELECTED FILE */

    .selected-file {
        margin-top: 12px;
        padding: 11px 13px;
        border: 1px solid #e5e5eb;
        border-radius: 8px;
        background: #ffffff;
        display: flex;
        align-items: center;
    }

    .selected-file-icon {
        width: 38px;
        height: 38px;
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(25, 135, 84, .10);
        color: #198754;
        margin-right: 10px;
        flex-shrink: 0;
    }

    .selected-file-icon i {
        font-size: 20px;
    }

    .selected-file-info {
        flex: 1;
        min-width: 0;
    }

    .selected-file-info strong {
        display: block;
        font-size: 10px;
        color: #343a40;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .selected-file-info small {
        display: block;
        font-size: 9px;
        color: #9999a5;
        margin-top: 2px;
    }

    #btnRemoveFileJurusan {
        border: 0;
        color: #9999a5;
        flex-shrink: 0;
    }

    #btnRemoveFileJurusan:hover {
        color: #dc3545;
    }

    /* FORMAT CARD */

    .import-format-card {
        margin-top: 18px;
        border: 1px solid #eeeeee;
        border-radius: 9px;
        overflow: hidden;
    }

    .format-header {
        display: flex;
        align-items: center;
        padding: 13px 15px;
        background: #fafafa;
        border-bottom: 1px solid #eeeeee;
    }

    .format-header-icon {
        width: 34px;
        height: 34px;
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(75, 73, 172, .10);
        color: #4b49ac;
        margin-right: 9px;
    }

    .format-header-icon i {
        font-size: 17px;
    }

    .format-title {
        font-size: 11px;
        font-weight: 600;
        color: #343a40;
    }

    .format-header small {
        font-size: 9px;
    }

    .format-table-wrapper {
        overflow-x: auto;
    }

    .format-table {
        min-width: 500px;
    }

    .format-table th {
        background: #ffffff;
        color: #9999a5;
        font-size: 9px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .2px;
        padding: 10px 13px;
        border-bottom: 1px solid #eeeeee;
    }

    .format-table td {
        font-size: 9px;
        color: #666b73;
        padding: 10px 13px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f1f1;
    }

    .format-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .column-name {
        display: inline-block;
        padding: 4px 7px;
        border-radius: 4px;
        background: #f4f4f7;
        color: #4b49ac;
        font-family: monospace;
        font-size: 9px;
    }

    /* NOTE */

    .import-note {
        display: flex;
        align-items: flex-start;
        gap: 9px;
        margin-top: 15px;
        padding: 11px 13px;
        border-radius: 7px;
        background: #f7f8fc;
        color: #6f7178;
    }

    .import-note>i {
        color: #4b49ac;
        font-size: 17px;
        margin-top: 1px;
    }

    .import-note strong {
        display: block;
        font-size: 9px;
        color: #4b49ac;
        margin-bottom: 2px;
    }

    .import-note p {
        font-size: 9px;
        line-height: 1.5;
    }

    .import-note code {
        font-size: 8px;
        background: #ececf4;
        color: #4b49ac;
        padding: 2px 4px;
        border-radius: 3px;
    }

    /* FOOTER */

    .import-modal-footer {
        padding: 14px 22px;
        border-top: 1px solid #eeeeee;
        background: #ffffff;
    }

    .import-modal-footer .btn {
        min-height: 38px;
        border-radius: 6px;
        font-size: 10px;
        padding: 8px 16px;
    }

    @media (max-width: 575.98px) {

        .import-modal-header {
            padding: 16px;
        }

        .import-modal-body {
            padding: 16px;
        }

        .import-modal-footer {
            padding: 12px 16px;
        }

        .import-modal-footer .btn {
            flex: 1;
        }

        .upload-area {
            padding: 22px 15px;
        }
    }
</style>


{{-- =========================================================
     HEADER
========================================================= --}}

<div class="row">

    <div class="col-md-12 grid-margin">

        <div class="row align-items-center">

            <div class="col-12 col-xl-8 mb-3 mb-xl-0">

                <h3 class="font-weight-bold mb-1">
                    Master Data Jurusan
                </h3>

                <h6 class="font-weight-normal text-muted mb-0">

                    Kelola daftar jurusan dan program keahlian
                    untuk sistem

                    <span class="text-primary font-weight-bold">
                        SIMPKL
                    </span>

                </h6>

            </div>


            <div class="col-12 col-xl-4">

                <div class="justify-content-start justify-content-xl-end d-flex gap-2">

                    <button
                        type="button"
                        class="btn btn-sm btn-outline-success btn-icon-text"
                        data-bs-toggle="modal"
                        data-bs-target="#modalImportJurusan">

                        <i class="mdi mdi-file-excel btn-icon-prepend"></i>

                        Import Excel

                    </button>


                    <a
                        href="{{ route('admin.jurusan.create') }}"
                        class="btn btn-sm btn-primary btn-icon-text">

                        <i class="mdi mdi-plus btn-icon-prepend"></i>

                        Tambah Jurusan

                    </a>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         STATISTIC CARDS
    ====================================================== --}}

    <div class="col-12 grid-margin">

        <div class="row">

            <div class="col-md-3 stretch-card grid-margin grid-margin-md-0 mb-3 mb-md-0">

                <div
                    class="card text-white"
                    style="background-color:#79a0f8;border-radius:12px;">

                    <div class="card-body p-4">

                        <p
                            class="mb-2 font-weight-medium"
                            style="opacity:.9;">

                            Total Jurusan

                        </p>

                        <h2 class="mb-1 font-weight-bold">

                            {{ $totalJurusan ?? (method_exists($jurusans, 'total') ? $jurusans->total() : count($jurusans)) }}

                        </h2>

                        <small style="opacity:.8;">
                            Terdaftar dalam sistem
                        </small>

                    </div>

                </div>

            </div>


            <div class="col-md-3 stretch-card grid-margin grid-margin-md-0 mb-3 mb-md-0">

                <div
                    class="card text-white"
                    style="background-color:#4b49ac;border-radius:12px;">

                    <div class="card-body p-4">

                        <p
                            class="mb-2 font-weight-medium"
                            style="opacity:.9;">

                            Hasil Filter

                        </p>

                        <h2 class="mb-1 font-weight-bold">

                            {{ method_exists($jurusans, 'count') ? $jurusans->count() : count($jurusans) }}

                        </h2>

                        <small style="opacity:.8;">
                            Tampil semua
                        </small>

                    </div>

                </div>

            </div>


            <div class="col-md-3 stretch-card grid-margin grid-margin-md-0 mb-3 mb-md-0">

                <div
                    class="card text-white"
                    style="background-color:#7da0fa;border-radius:12px;">

                    <div class="card-body p-4">

                        <p
                            class="mb-2 font-weight-medium"
                            style="opacity:.9;">

                            Status Data

                        </p>

                        <h2 class="mb-1 font-weight-bold">
                            Aktif
                        </h2>

                        <small style="opacity:.8;">
                            Siap digunakan relasi
                        </small>

                    </div>

                </div>

            </div>


            <div class="col-md-3 stretch-card grid-margin grid-margin-md-0">

                <div
                    class="card text-white"
                    style="background-color:#f1536e;border-radius:12px;">

                    <div class="card-body p-4">

                        <p
                            class="mb-2 font-weight-medium"
                            style="opacity:.9;">

                            Modul Sistem

                        </p>

                        <h2 class="mb-1 font-weight-bold">
                            Master
                        </h2>

                        <small style="opacity:.8;">
                            SIMPKL Admin
                        </small>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         VALIDATION ERRORS
    ====================================================== --}}

    @if($errors->any())

    <div class="col-12">

        <div
            class="alert alert-danger alert-dismissible fade show"
            role="alert">

            <strong>

                <i class="mdi mdi-alert-circle me-1"></i>

                Terjadi Kesalahan Input:

            </strong>


            <ul class="mb-0 mt-1 ps-3">

                @foreach($errors->all() as $error)

                <li>
                    {{ $error }}
                </li>

                @endforeach

            </ul>


            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close">
            </button>

        </div>

    </div>

    @endif


    {{-- =====================================================
         TABLE
    ====================================================== --}}

    <div class="col-md-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3">

                    <div>

                        <p class="card-title mb-0">
                            Daftar Jurusan
                        </p>

                        <p class="text-muted font-weight-normal mb-0">

                            Data utama jurusan yang terdaftar pada sistem

                        </p>

                    </div>


                    <div class="mt-3 mt-md-0">

                        <form
                            action="{{ route('admin.jurusan.index') }}"
                            method="GET">

                            <div class="input-group">

                                <input
                                    type="text"
                                    name="search"
                                    class="form-control form-control-sm"
                                    placeholder="Cari jurusan..."
                                    value="{{ request('search') }}">


                                <div class="input-group-append">

                                    <button
                                        class="btn btn-sm btn-primary"
                                        type="submit">

                                        <i class="mdi mdi-magnify"></i>

                                    </button>


                                    @if(request('search'))

                                    <a
                                        href="{{ route('admin.jurusan.index') }}"
                                        class="btn btn-sm btn-light border"
                                        title="Reset">

                                        <i class="mdi mdi-refresh"></i>

                                    </a>

                                    @endif

                                </div>

                            </div>

                        </form>

                    </div>

                </div>


                {{-- TABLE RESPONSIVE --}}

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="bg-light">

                            <tr>

                                <th style="width:60px;">
                                    No
                                </th>

                                <th>
                                    Nama Jurusan
                                </th>

                                <th>
                                    Kode Master
                                </th>

                                <th>
                                    Status
                                </th>

                                <th
                                    class="text-center"
                                    style="width:150px;">

                                    Aksi

                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($jurusans as $jurusan)

                            <tr>

                                <td class="font-weight-bold">

                                    {{ method_exists($jurusans, 'firstItem')
                                            ? $jurusans->firstItem() + $loop->index
                                            : $loop->iteration }}

                                </td>


                                <td>

                                    <span class="font-weight-bold text-dark">

                                        {{ $jurusan->nama_jurusan }}

                                    </span>

                                </td>


                                <td>

                                    <span class="badge bg-light text-dark border">

                                        #JRN-{{ sprintf('%03d', $jurusan->id) }}

                                    </span>

                                </td>


                                <td>

                                    <label class="badge badge-success px-3 py-2">

                                        Aktif

                                    </label>

                                </td>


                                <td class="text-center">

                                    <div
                                        class="d-flex justify-content-center align-items-center gap-2">

                                        <a
                                            href="{{ route('admin.jurusan.show', $jurusan->id) }}"
                                            class="btn btn-sm btn-outline-info btn-icon d-flex align-items-center justify-content-center"
                                            title="Detail"
                                            style="width:32px;height:32px;padding:0;">

                                            <i
                                                class="mdi mdi-eye-outline"
                                                style="font-size:16px;">
                                            </i>

                                        </a>


                                        <a
                                            href="{{ route('admin.jurusan.edit', $jurusan->id) }}"
                                            class="btn btn-sm btn-outline-primary btn-icon d-flex align-items-center justify-content-center"
                                            title="Edit"
                                            style="width:32px;height:32px;padding:0;">

                                            <i
                                                class="mdi mdi-pencil-outline"
                                                style="font-size:16px;">
                                            </i>

                                        </a>


                                        <button
                                            type="button"
                                            class="btn btn-sm btn-outline-danger btn-icon btn-delete d-flex align-items-center justify-content-center"
                                            data-id="{{ $jurusan->id }}"
                                            data-name="{{ $jurusan->nama_jurusan }}"
                                            title="Hapus"
                                            style="width:32px;height:32px;padding:0;">

                                            <i
                                                class="mdi mdi-delete-outline"
                                                style="font-size:16px;">
                                            </i>

                                        </button>


                                        <form
                                            id="delete-form-{{ $jurusan->id }}"
                                            action="{{ route('admin.jurusan.destroy', $jurusan->id) }}"
                                            method="POST"
                                            class="d-none">

                                            @csrf

                                            @method('DELETE')

                                        </form>

                                    </div>

                                </td>

                            </tr>


                            @empty

                            <tr>

                                <td
                                    colspan="5"
                                    class="text-center py-4">

                                    <p class="text-muted mb-2">

                                        Data jurusan tidak ditemukan

                                    </p>


                                    @if(request('search'))

                                    <a
                                        href="{{ route('admin.jurusan.index') }}"
                                        class="btn btn-sm btn-light">

                                        Reset Pencarian

                                    </a>

                                    @endif

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- PAGINATION --}}

                @if(method_exists($jurusans, 'links'))

                <div
                    class="d-flex justify-content-between align-items-center mt-4">

                    <small class="text-muted">

                        Menampilkan
                        {{ $jurusans->firstItem() ?? 0 }}
                        sampai
                        {{ $jurusans->lastItem() ?? 0 }}
                        dari
                        {{ $jurusans->total() ?? 0 }}
                        data

                    </small>


                    <div>

                        {{ $jurusans->withQueryString()->links('pagination::bootstrap-5') }}

                    </div>

                </div>

                @endif

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     MODAL IMPORT EXCEL JURUSAN
========================================================= --}}

<div
    class="modal fade"
    id="modalImportJurusan"
    tabindex="-1"
    aria-labelledby="modalImportJurusanLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content import-modal">


            {{-- HEADER --}}

            <div class="modal-header import-modal-header">

                <div class="d-flex align-items-center">

                    <div class="import-icon">

                        <i class="mdi mdi-file-excel-outline"></i>

                    </div>


                    <div>

                        <h5
                            class="modal-title import-title"
                            id="modalImportJurusanLabel">

                            Import Data Jurusan

                        </h5>


                        <p class="import-subtitle mb-0">

                            Tambahkan banyak data jurusan sekaligus menggunakan file Excel.

                        </p>

                    </div>

                </div>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>


            {{-- FORM --}}

            <form
                action="{{ route('admin.jurusan.import') }}"
                method="POST"
                enctype="multipart/form-data"
                id="formImportJurusan">

                @csrf


                <div class="modal-body import-modal-body">


                    {{-- UPLOAD AREA --}}

                    <div
                        class="upload-area"
                        id="uploadAreaJurusan">

                        <input
                            type="file"
                            name="file"
                            id="fileJurusan"
                            accept=".xlsx,.xls"
                            required
                            hidden>


                        <div class="upload-icon">

                            <i class="mdi mdi-cloud-upload-outline"></i>

                        </div>


                        <h6 class="upload-title">

                            Pilih File Excel

                        </h6>


                        <p class="upload-text">

                            Klik untuk memilih file atau seret file ke area ini

                        </p>


                        <span class="upload-format">

                            XLSX atau XLS

                        </span>


                        <div>

                            <button
                                type="button"
                                class="btn btn-outline-primary btn-sm mt-3"
                                id="btnChooseFileJurusan">

                                <i class="mdi mdi-folder-open-outline me-1"></i>

                                Pilih File

                            </button>

                        </div>

                    </div>


                    {{-- FILE TERPILIH --}}

                    <div
                        id="selectedFileJurusan"
                        class="selected-file d-none">

                        <div class="selected-file-icon">

                            <i class="mdi mdi-file-excel-outline"></i>

                        </div>


                        <div class="selected-file-info">

                            <strong id="selectedFileNameJurusan">
                                -
                            </strong>

                            <small id="selectedFileSizeJurusan">
                                -
                            </small>

                        </div>


                        <button
                            type="button"
                            class="btn btn-sm btn-light"
                            id="btnRemoveFileJurusan"
                            title="Hapus file">

                            <i class="mdi mdi-close"></i>

                        </button>

                    </div>


                    {{-- FORMAT FILE --}}

                    <div class="import-format-card">

                        <div class="format-header">

                            <div class="format-header-icon">

                                <i class="mdi mdi-table-large"></i>

                            </div>


                            <div>

                                <h6 class="format-title mb-0">

                                    Format File Excel

                                </h6>

                                <small class="text-muted">

                                    Header kolom harus sesuai dengan format berikut.

                                </small>

                            </div>

                        </div>


                        <div class="format-table-wrapper">

                            <table class="table format-table mb-0">

                                <thead>

                                    <tr>

                                        <th>
                                            Kolom
                                        </th>

                                        <th>
                                            Keterangan
                                        </th>

                                        <th>
                                            Contoh
                                        </th>

                                    </tr>

                                </thead>


                                <tbody>

                                    <tr>

                                        <td>

                                            <span class="column-name">

                                                nama_jurusan

                                            </span>

                                        </td>

                                        <td>
                                            Nama jurusan
                                        </td>

                                        <td>
                                            Rekayasa Perangkat Lunak
                                        </td>

                                    </tr>

                                </tbody>

                            </table>

                        </div>

                    </div>


                    {{-- CATATAN --}}

                    <div class="import-note">

                        <i class="mdi mdi-information-outline"></i>


                        <div>

                            <strong>
                                Perhatikan
                            </strong>


                            <p class="mb-0">

                                Baris pertama file harus berisi nama kolom
                                <code>nama_jurusan</code>.
                                Pastikan data sudah sesuai sebelum melakukan import.

                            </p>

                        </div>

                    </div>

                </div>


                {{-- FOOTER --}}

                <div class="modal-footer import-modal-footer">

                    <button
                        type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal">

                        Batal

                    </button>


                    <button
                        type="submit"
                        class="btn btn-success"
                        id="btnImportJurusan"
                        disabled>

                        <i class="mdi mdi-file-import-outline me-1"></i>

                        Import Data

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- =========================================================
     SCRIPT IMPORT JURUSAN
========================================================= --}}

@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const fileInput =
            document.getElementById('fileJurusan');

        const uploadArea =
            document.getElementById('uploadAreaJurusan');

        const chooseButton =
            document.getElementById('btnChooseFileJurusan');

        const selectedFile =
            document.getElementById('selectedFileJurusan');

        const selectedFileName =
            document.getElementById('selectedFileNameJurusan');

        const selectedFileSize =
            document.getElementById('selectedFileSizeJurusan');

        const removeButton =
            document.getElementById('btnRemoveFileJurusan');

        const importButton =
            document.getElementById('btnImportJurusan');

        const form =
            document.getElementById('formImportJurusan');

        const modal =
            document.getElementById('modalImportJurusan');


        if (
            !fileInput ||
            !uploadArea ||
            !chooseButton ||
            !selectedFile ||
            !importButton
        ) {

            return;

        }


        /* =====================================================
           PILIH FILE
        ====================================================== */

        chooseButton.addEventListener('click', function(e) {

            e.stopPropagation();

            fileInput.click();

        });


        uploadArea.addEventListener('click', function(e) {

            if (
                e.target !== chooseButton &&
                !chooseButton.contains(e.target)
            ) {

                fileInput.click();

            }

        });


        /* =====================================================
           DRAG & DROP
        ====================================================== */

        uploadArea.addEventListener('dragover', function(e) {

            e.preventDefault();

            uploadArea.classList.add('dragover');

        });


        uploadArea.addEventListener('dragleave', function() {

            uploadArea.classList.remove('dragover');

        });


        uploadArea.addEventListener('drop', function(e) {

            e.preventDefault();

            uploadArea.classList.remove('dragover');


            if (e.dataTransfer.files.length > 0) {

                fileInput.files =
                    e.dataTransfer.files;

                handleFile();

            }

        });


        /* =====================================================
           FILE CHANGE
        ====================================================== */

        fileInput.addEventListener('change', function() {

            handleFile();

        });


        function handleFile() {

            const file =
                fileInput.files[0];


            if (!file) {

                resetFile();

                return;

            }


            const allowedExtensions = [
                'xlsx',
                'xls'
            ];


            const extension =
                file.name
                .split('.')
                .pop()
                .toLowerCase();


            if (!allowedExtensions.includes(extension)) {

                if (typeof Swal !== 'undefined') {

                    Swal.fire({

                        icon: 'warning',

                        title: 'Format File Tidak Sesuai',

                        text: 'Silakan pilih file Excel dengan format .xlsx atau .xls.',

                        confirmButtonText: 'Mengerti',

                        customClass: {

                            confirmButton: 'btn btn-primary px-4'

                        },

                        buttonsStyling: false

                    });

                }


                resetFile();

                return;

            }


            selectedFileName.textContent =
                file.name;


            selectedFileSize.textContent =
                formatFileSize(file.size);


            uploadArea.classList.add('d-none');

            selectedFile.classList.remove('d-none');

            importButton.disabled = false;

        }


        /* =====================================================
           HAPUS FILE
        ====================================================== */

        if (removeButton) {

            removeButton.addEventListener('click', function() {

                resetFile();

            });

        }


        function resetFile() {

            fileInput.value = '';

            uploadArea.classList.remove('d-none');

            selectedFile.classList.add('d-none');

            importButton.disabled = true;

            selectedFileName.textContent = '-';

            selectedFileSize.textContent = '-';

            importButton.innerHTML =
                '<i class="mdi mdi-file-import-outline me-1"></i> Import Data';

        }


        /* =====================================================
           FORMAT UKURAN FILE
        ====================================================== */

        function formatFileSize(bytes) {

            if (bytes === 0) {

                return '0 Bytes';

            }


            const sizes = [
                'Bytes',
                'KB',
                'MB',
                'GB'
            ];


            const index =
                Math.floor(
                    Math.log(bytes) /
                    Math.log(1024)
                );


            return (
                parseFloat(
                    (
                        bytes /
                        Math.pow(1024, index)
                    ).toFixed(2)
                ) +
                ' ' +
                sizes[index]
            );

        }


        /* =====================================================
           SUBMIT IMPORT
        ====================================================== */

        if (form) {

            form.addEventListener('submit', function() {

                importButton.disabled = true;

                importButton.innerHTML =
                    '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Mengimport...';

            });

        }


        /* =====================================================
           RESET SAAT MODAL DITUTUP
        ====================================================== */

        if (modal) {

            modal.addEventListener(
                'hidden.bs.modal',
                function() {

                    resetFile();

                }
            );

        }

    });
</script>

@endpush

@endsection