<!DOCTYPE html>
<html lang="id">

<head>

    @include('components.skydash-head-industri')

    <style>
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
                opacity .25s ease,
                visibility .25s ease;
        }


        #skydash-loader.hidden {
            opacity: 0 !important;
            visibility: hidden !important;
            pointer-events: none !important;
        }


        .skydash-dots-loader {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }


        .skydash-dots-loader div {
            width: 14px;
            height: 14px;
            background: #4B49AC;
            border-radius: 50%;

            animation:
                skydashDots 1.4s infinite ease-in-out both;
        }


        .skydash-dots-loader div:nth-child(1) {
            animation-delay: -.32s;
        }


        .skydash-dots-loader div:nth-child(2) {
            animation-delay: -.16s;
        }


        @keyframes skydashDots {

            0%,
            80%,
            100% {
                opacity: .25;
                transform: scale(.85);
            }

            40% {
                opacity: 1;
                transform: scale(1.15);
            }

        }
    </style>

</head>


<body>


    <div
        id="flash-message-container"

        data-success="{{ session('success') }}"

        data-error="{{ session('error') }}"

        data-has-errors="{{ $errors->any() ? 'true' : 'false' }}">
    </div>


    <div id="skydash-loader">

        <div class="skydash-dots-loader">

            <div></div>
            <div></div>
            <div></div>

        </div>

    </div>


    <div class="container-scroller">


        @include(
        'components.skydash-navbar-industri'
        )


        <div class="container-fluid page-body-wrapper">


            @include(
            'components.skydash-sidebar-industri'
            )


            <div class="main-panel">

                <div class="content-wrapper">

                    @yield('content')

                </div>


                @include(
                'components.skydash-footer-industri'
                )

            </div>

        </div>

    </div>


    @include(
    'components.skydash-scripts-industri'
    )


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        document.addEventListener(
            'DOMContentLoaded',
            function() {


                const loader =
                    document.getElementById(
                        'skydash-loader'
                    );


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


                /* PAGE SELESAI */

                window.addEventListener(
                    'load',
                    hideLoader
                );


                /* BACK / FORWARD */

                window.addEventListener(
                    'pageshow',
                    hideLoader
                );


                /* PAGE HIDE */

                window.addEventListener(
                    'pagehide',
                    hideLoader
                );


                /* TAB AKTIF */

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


                /* FALLBACK */

                setTimeout(
                    hideLoader,
                    1000
                );


                /* NAVIGATION */

                document.addEventListener(
                    'click',
                    function(e) {


                        if (
                            e.target.closest(
                                '.btn-delete'
                            )
                        ) {

                            return;

                        }


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


                /* FORM */

                document.addEventListener(
                    'submit',
                    function(e) {

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


                /* FLASH */

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


                /* DELETE SWEETALERT */

                document.addEventListener(
                    'click',
                    function(e) {


                        const deleteBtn =
                            e.target.closest(
                                '.btn-delete'
                            );


                        if (!deleteBtn) {
                            return;
                        }


                        e.preventDefault();

                        e.stopPropagation();


                        const form =
                            deleteBtn.closest(
                                'form'
                            );


                        const itemName =
                            deleteBtn.getAttribute(
                                'data-name'
                            ) ||
                            'data ini';


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

                                    if (form) {

                                        form.classList.add(
                                            'form-delete'
                                        );

                                        showLoader();

                                        form.submit();

                                    }

                                } else {

                                    hideLoader();

                                }

                            }
                        );

                    },
                    true
                );


            }
        );
    </script>


    @stack('scripts')


</body>

</html>