<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Skydash Admin</title>

<!-- plugins:css -->
<link rel="stylesheet" href="{{ asset('skydash/vendors/feather/feather.css') }}">
<link rel="stylesheet" href="{{ asset('skydash/vendors/ti-icons/css/themify-icons.css') }}">
<link rel="stylesheet" href="{{ asset('skydash/vendors/css/vendor.bundle.base.css') }}">
<link rel="stylesheet" href="{{ asset('skydash/vendors/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('skydash/vendors/mdi/css/materialdesignicons.min.css') }}">

<!-- Plugin css for this page -->
<link rel="stylesheet" href="{{ asset('skydash/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('skydash/js/select.dataTables.min.css') }}">

<!-- inject:css -->
<link rel="stylesheet" href="{{ asset('skydash/css/style.css') }}">

<link rel="shortcut icon" href="{{ asset('skydash/images/favicon.png') }}" />

{{-- Custom Style Global untuk Konsistensi Seluruh Halaman --}}
<style>
    /* Styling Dasar Area Konten */
    .content-wrapper {
        background-color: #f5f7ff;
        padding: 1.8rem 2.2rem;
    }

    /* Konsistensi Kartu (Card) */
    .card {
        border: none !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        border-radius: 12px !important;
        background-color: #ffffff;
        margin-bottom: 1.5rem;
    }

    .card .card-title {
        font-weight: 600;
        color: #2b2b2b;
        font-size: 1.1rem;
        margin-bottom: 1.2rem;
    }

    /* Konsistensi Tabel Data */
    .table thead th {
        font-weight: 600;
        border-bottom: 2px solid #eef2f5 !important;
        color: #4b4b4b;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        background-color: #fafbfc;
        padding: 12px 15px;
    }

    .table td {
        padding: 12px 15px;
        vertical-align: middle;
    }

    .table-hover tbody tr:hover {
        background-color: #f8faff;
    }

    /* Konsistensi Badge & Status */
    .badge {
        font-weight: 500;
        padding: 0.45em 0.85em;
        border-radius: 6px;
        font-size: 0.75rem;
    }

    /* Konsistensi Tombol Aksi */
    .btn {
        border-radius: 8px;
        font-weight: 500;
    }

    .btn-icon-sm {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
    }
</style>