<!DOCTYPE html>
<html lang="id">

<head>

    @include('components.skydash-head-siswa')

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}">

    <style>
        /* =====================================================
           LOADING SCREEN
        ====================================================== */

        #skydash-loader {
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            background: #ffffff;
            z-index: 999999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
            transition:
                opacity 0.25s ease,
                visibility 0.25s ease;
        }


        #skydash-loader.hidden {
            opacity: 0 !important;
            visibility: hidden !important;
            pointer-events: none !important;
        }


        /* =====================================================
           LOADING DOTS
        ====================================================== */

        .skydash-dots-loader {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }


        .skydash-dots-loader div {
            width: 14px;
            height: 14px;
            background-color: #4B49AC;
            border-radius: 50%;
            animation: skydashDots 1.4s infinite ease-in-out both;
        }


        .skydash-dots-loader div:nth-child(1) {
            animation-delay: -0.32s;
        }


        .skydash-dots-loader div:nth-child(2) {
            animation-delay: -0.16s;
        }


        @keyframes skydashDots {

            0%,
            80%,
            100% {
                opacity: 0.25;
                transform: scale(0.85);
            }

            40% {
                opacity: 1;
                transform: scale(1.15);
            }

        }
    </style>

</head>


<body>


    {{-- =====================================================
         FLASH MESSAGE
    ====================================================== --}}

    <div
        id="flash-message-container"
        data-success="{{ session('success') }}"
        data-error="{{ session('error') }}"
        data-has-errors="{{ $errors->any() ? 'true' : 'false' }}">
    </div>


    {{-- =====================================================
         LOADING SCREEN
    ====================================================== --}}

    <div id="skydash-loader">

        <div class="skydash-dots-loader">

            <div></div>
            <div></div>
            <div></div>

        </div>

    </div>


    {{-- =====================================================
         CONTAINER SCROLLER
    ====================================================== --}}

    <div class="container-scroller">


        {{-- =================================================
             NAVBAR SISWA
        ================================================== --}}

        @include(
        'components.skydash-navbar-siswa'
        )


        <div class="container-fluid page-body-wrapper">


            {{-- =================================================
                 SIDEBAR SISWA
            ================================================== --}}

            @include(
            'components.skydash-sidebar-siswa'
            )


            {{-- =================================================
                 MAIN PANEL
            ================================================== --}}

            <div class="main-panel">

                <div class="content-wrapper">

                    @yield('content')

                </div>


                {{-- =================================================
                     FOOTER SISWA
                ================================================== --}}

                @include(
                'components.skydash-footer-siswa'
                )

            </div>

        </div>

    </div>


    {{-- =====================================================
         SCRIPT SISWA
    ====================================================== --}}

    @include(
    'components.skydash-scripts-siswa'
    )


    {{-- =====================================================
         SWEETALERT2
    ====================================================== --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    {{-- =====================================================
         GLOBAL JAVASCRIPT
    ====================================================== --}}

    <script>
        document.addEventListener(
            'DOMContentLoaded',
            function() {

                const loader =
                    document.getElementById(
                        'skydash-loader'
                    );


                /* =================================================
                   HIDE LOADER
                ================================================== */

                function hideLoader() {

                    if (!loader) {
                        return;
                    }

                    loader.classList.add(
                        'hidden'
                    );

                    loader.style.opacity = '0';

                    loader.style.visibility =
                        'hidden';

                    loader.style.pointerEvents =
                        'none';
                }


                /* =================================================
                   SHOW LOADER
                ================================================== */

                function showLoader() {

                    if (!loader) {
                        return;
                    }

                    loader.classList.remove(
                        'hidden'
                    );

                    loader.style.opacity = '1';

                    loader.style.visibility =
                        'visible';

                    loader.style.pointerEvents =
                        'auto';
                }


                /* =================================================
                   HALAMAN SELESAI DIMUAT
                ================================================== */

                window.addEventListener(
                    'load',
                    function() {

                        hideLoader();

                    }
                );


                /* =================================================
                   BACK / FORWARD BROWSER
                ================================================== */

                window.addEventListener(
                    'pageshow',
                    function() {

                        hideLoader();

                    }
                );


                /* =================================================
                   PAGE SHOW DENGAN BF CACHE
                ================================================== */

                window.addEventListener(
                    'pagehide',
                    function() {

                        hideLoader();

                    }
                );


                /* =================================================
                   VISIBILITY BROWSER
                ================================================== */

                document.addEventListener(
                    'visibilitychange',
                    function() {

                        if (
                            document.visibilityState ===
                            'visible'
                        ) {

                            hideLoader();

                        }

                    }
                );


                /* =================================================
                   FALLBACK
                ================================================== */

                setTimeout(
                    function() {

                        hideLoader();

                    },
                    1000
                );


                /* =================================================
                   NAVIGASI HALAMAN
                ================================================== */

                document.addEventListener(
                    'click',
                    function(e) {

                        /*
                        |--------------------------------------------------------------------------
                        | JANGAN GANGGU TOMBOL DELETE
                        |--------------------------------------------------------------------------
                        */

                        const deleteButton =
                            e.target.closest(
                                '.btn-delete'
                            );

                        if (deleteButton) {

                            return;

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | CARI LINK
                        |--------------------------------------------------------------------------
                        */

                        const link =
                            e.target.closest(
                                'a'
                            );

                        if (!link) {

                            return;

                        }


                        const href =
                            link.getAttribute(
                                'href'
                            );


                        const target =
                            link.getAttribute(
                                'target'
                            );


                        /*
                        |--------------------------------------------------------------------------
                        | LINK YANG TIDAK PERLU LOADER
                        |--------------------------------------------------------------------------
                        */

                        if (
                            !href ||
                            href === '#' ||
                            href.startsWith('#') ||
                            href.startsWith(
                                'javascript:'
                            )
                        ) {

                            return;

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | TAB BARU / CTRL CLICK
                        |--------------------------------------------------------------------------
                        */

                        if (
                            target === '_blank' ||
                            e.ctrlKey ||
                            e.shiftKey ||
                            e.metaKey ||
                            e.button !== 0
                        ) {

                            return;

                        }


                        showLoader();

                    }
                );


                /* =================================================
                   FORM SUBMIT
                ================================================== */

                document.addEventListener(
                    'submit',
                    function(e) {

                        /*
                        |--------------------------------------------------------------------------
                        | FORM DELETE TIDAK LANGSUNG
                        | MENAMPILKAN LOADER
                        |--------------------------------------------------------------------------
                        */

                        if (
                            e.target.classList.contains(
                                'form-delete'
                            )
                        ) {

                            return;

                        }


                        showLoader();

                    }
                );


                /* =================================================
                   FLASH MESSAGE
                ================================================== */

                const flashContainer =
                    document.getElementById(
                        'flash-message-container'
                    );


                if (flashContainer) {

                    const successMsg =
                        flashContainer.getAttribute(
                            'data-success'
                        );


                    const errorMsg =
                        flashContainer.getAttribute(
                            'data-error'
                        );


                    const hasErrors =
                        flashContainer.getAttribute(
                            'data-has-errors'
                        ) === 'true';


                    /* =============================================
                       SUCCESS
                    ============================================== */

                    if (successMsg) {

                        Swal.fire({

                            icon: 'success',

                            title: 'Berhasil!',

                            text: successMsg,

                            showConfirmButton: false,

                            timer: 2200,

                            timerProgressBar: true

                        });

                    }


                    /* =============================================
                       ERROR
                    ============================================== */

                    if (errorMsg) {

                        Swal.fire({

                            icon: 'error',

                            title: 'Gagal!',

                            text: errorMsg,

                            confirmButtonText: 'Tutup',

                            customClass: {

                                confirmButton: 'btn btn-primary px-4'

                            },

                            buttonsStyling: false

                        });

                    }


                    /* =============================================
                       VALIDATION ERROR
                    ============================================== */

                    if (hasErrors) {

                        Swal.fire({

                            icon: 'warning',

                            title: 'Periksa Kembali Form',

                            text: 'Terdapat beberapa isian yang belum sesuai.',

                            confirmButtonText: 'Mengerti',

                            customClass: {

                                confirmButton: 'btn btn-warning text-white px-4'

                            },

                            buttonsStyling: false

                        });

                    }

                }


                /* =================================================
                   DELETE CONFIRMATION
                ================================================== */

                document.addEventListener(
                    'click',
                    function(e) {

                        const deleteButton =
                            e.target.closest(
                                '.btn-delete'
                            );


                        if (!deleteButton) {

                            return;

                        }


                        e.preventDefault();

                        e.stopPropagation();


                        const form =
                            deleteButton.closest(
                                'form'
                            );


                        const itemName =
                            deleteButton.getAttribute(
                                'data-name'
                            ) ||
                            'data ini';


                        /*
                        |--------------------------------------------------------------------------
                        | SWEETALERT DELETE
                        |--------------------------------------------------------------------------
                        */

                        Swal.fire({

                            title: 'Apakah Anda yakin?',

                            html: 'Data <strong>"' +
                                itemName +
                                '"</strong> akan dihapus permanen!',

                            icon: 'warning',

                            showCancelButton: true,

                            confirmButtonText: '<i class="mdi mdi-delete-outline me-1"></i> Ya, Hapus',

                            cancelButtonText: 'Batal',

                            reverseButtons: true,

                            focusCancel: true,

                            customClass: {

                                confirmButton: 'btn btn-danger px-4 ms-2',

                                cancelButton: 'btn btn-light px-4'

                            },

                            buttonsStyling: false

                        }).then(
                            function(result) {

                                if (
                                    result.isConfirmed
                                ) {

                                    /*
                                    | Hanya setelah
                                    | benar-benar klik
                                    | Ya, Hapus.
                                    */

                                    if (form) {

                                        form.classList.add(
                                            'form-delete'
                                        );

                                        showLoader();

                                        form.submit();

                                    }

                                }

                            }
                        );

                    },
                    true
                );


            }
        );
    </script>


    {{-- =====================================================
         SCRIPT TAMBAHAN HALAMAN
    ====================================================== --}}

    @stack('scripts')


</body>

</html>