@extends('layouts.skydash-siswa')

@section('title', 'Ubah Password')

@section('content')

{{-- =========================================================
     HEADER
========================================================= --}}

<div class="row">

    <div class="col-12">

        <div
            class="card border-0 shadow-sm mb-4"
            style="border-radius:12px;">

            <div class="card-body">

                <div
                    class="d-flex justify-content-between
                    align-items-center flex-wrap">

                    <div class="d-flex align-items-center">

                        <div
                            class="d-flex align-items-center
                            justify-content-center"
                            style="
                                width:52px;
                                height:52px;
                                min-width:52px;
                                background:rgba(75,73,172,.10);
                                color:#4B49AC;
                                border-radius:12px;
                                font-size:25px;
                                margin-right:15px;
                            ">

                            <i class="mdi mdi-lock-reset"></i>

                        </div>

                        <div>

                            <h4
                                class="fw-bold mb-1"
                                style="font-size:20px;">

                                Ubah Password

                            </h4>

                            <p class="text-muted mb-0">

                                Perbarui password akun siswa Anda.

                            </p>

                        </div>

                    </div>


                    <a
                        href="{{ route('siswa.profil.index') }}"
                        class="btn btn-light mt-3 mt-md-0">

                        <i class="mdi mdi-arrow-left me-1"></i>

                        Kembali

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     ALERT SUCCESS
========================================================= --}}

@if(session('success'))

<div class="row">

    <div class="col-12">

        <div class="alert alert-success border-0 shadow-sm">

            <i class="mdi mdi-check-circle-outline me-1"></i>

            {{ session('success') }}

        </div>

    </div>

</div>

@endif


{{-- =========================================================
     ALERT ERROR
========================================================= --}}

@if(session('error'))

<div class="row">

    <div class="col-12">

        <div class="alert alert-danger border-0 shadow-sm">

            <i class="mdi mdi-alert-circle-outline me-1"></i>

            {{ session('error') }}

        </div>

    </div>

</div>

@endif


{{-- =========================================================
     VALIDATION ERROR
========================================================= --}}

@if($errors->any())

<div class="row">

    <div class="col-12">

        <div class="alert alert-danger border-0 shadow-sm">

            <div class="d-flex align-items-start">

                <i
                    class="mdi mdi-alert-circle-outline me-2"
                    style="font-size:21px;">
                </i>

                <div>

                    <strong>
                        Password belum dapat diperbarui.
                    </strong>

                    <ul class="mb-0 mt-2 ps-3">

                        @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    </div>

</div>

@endif


{{-- =========================================================
     FORM PASSWORD
========================================================= --}}

<div class="row justify-content-center">

    <div class="col-xl-7 col-lg-8 col-md-10">

        <div
            class="card border-0 shadow-sm mb-4"
            style="border-radius:12px;">

            <div class="card-body p-4 p-md-5">


                {{-- =================================================
                     HEADER KEAMANAN
                ================================================== --}}

                <div class="text-center mb-5">

                    <div
                        class="d-flex align-items-center
                        justify-content-center mx-auto mb-3"
                        style="
                            width:72px;
                            height:72px;
                            background:rgba(75,73,172,.10);
                            color:#4B49AC;
                            border-radius:50%;
                            font-size:34px;
                        ">

                        <i class="mdi mdi-shield-lock-outline"></i>

                    </div>


                    <h5 class="fw-bold mb-2">

                        Keamanan Akun

                    </h5>


                    <p
                        class="text-muted mb-0"
                        style="line-height:1.6;">

                        Gunakan password yang kuat dan mudah
                        Anda ingat untuk menjaga keamanan akun.

                    </p>

                </div>


                <form
                    action="{{ route('siswa.password.update') }}"
                    method="POST">

                    @csrf

                    @method('PUT')


                    {{-- =================================================
                         PASSWORD LAMA
                    ================================================== --}}

                    <div class="mb-4">

                        <label
                            for="password_lama"
                            class="form-label fw-semibold">

                            Password Lama

                            <span class="text-danger">
                                *
                            </span>

                        </label>


                        <div class="password-input">

                            <input
                                type="password"
                                name="password_lama"
                                id="password_lama"
                                class="form-control password-field @error('password_lama') is-invalid @enderror"
                                placeholder="Masukkan password lama"
                                autocomplete="current-password"
                                required>


                            <button
                                type="button"
                                class="password-toggle"
                                data-target="password_lama"
                                aria-label="Tampilkan password">

                                <i class="mdi mdi-eye-outline"></i>

                            </button>

                        </div>


                        @error('password_lama')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                        @enderror

                    </div>


                    {{-- =================================================
                         PASSWORD BARU
                    ================================================== --}}

                    <div class="mb-4">

                        <label
                            for="password_baru"
                            class="form-label fw-semibold">

                            Password Baru

                            <span class="text-danger">
                                *
                            </span>

                        </label>


                        <div class="password-input">

                            <input
                                type="password"
                                name="password_baru"
                                id="password_baru"
                                class="form-control password-field @error('password_baru') is-invalid @enderror"
                                placeholder="Masukkan password baru"
                                autocomplete="new-password"
                                minlength="6"
                                required>


                            <button
                                type="button"
                                class="password-toggle"
                                data-target="password_baru"
                                aria-label="Tampilkan password">

                                <i class="mdi mdi-eye-outline"></i>

                            </button>

                        </div>


                        <small class="text-muted d-block mt-2">

                            <i class="mdi mdi-information-outline me-1"></i>

                            Password baru minimal
                            <strong>6 karakter</strong>.

                        </small>


                        @error('password_baru')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                        @enderror

                    </div>


                    {{-- =================================================
                         KONFIRMASI PASSWORD
                    ================================================== --}}

                    <div class="mb-4">

                        <label
                            for="password_baru_confirmation"
                            class="form-label fw-semibold">

                            Konfirmasi Password Baru

                            <span class="text-danger">
                                *
                            </span>

                        </label>


                        <div class="password-input">

                            <input
                                type="password"
                                name="password_baru_confirmation"
                                id="password_baru_confirmation"
                                class="form-control password-field"
                                placeholder="Ulangi password baru"
                                autocomplete="new-password"
                                minlength="6"
                                required>


                            <button
                                type="button"
                                class="password-toggle"
                                data-target="password_baru_confirmation"
                                aria-label="Tampilkan password">

                                <i class="mdi mdi-eye-outline"></i>

                            </button>

                        </div>


                        <div
                            id="passwordMatch"
                            class="small mt-2"
                            style="display:none;">
                        </div>

                    </div>


                    {{-- =================================================
                         INFORMASI KEAMANAN
                    ================================================== --}}

                    <div
                        class="p-3 mb-4"
                        style="
                            background:#f8f9fc;
                            border:1px solid #ebedf2;
                            border-radius:10px;
                        ">

                        <div class="d-flex align-items-start">

                            <div
                                class="d-flex align-items-center
                                justify-content-center"
                                style="
                                    width:38px;
                                    height:38px;
                                    min-width:38px;
                                    background:rgba(75,73,172,.10);
                                    color:#4B49AC;
                                    border-radius:8px;
                                    margin-right:12px;
                                ">

                                <i class="mdi mdi-shield-check-outline"></i>

                            </div>

                            <div>

                                <h6 class="fw-semibold mb-1">

                                    Tips Keamanan

                                </h6>

                                <p
                                    class="text-muted small mb-0"
                                    style="line-height:1.6;">

                                    Jangan gunakan password yang mudah
                                    ditebak dan jangan membagikan password
                                    kepada orang lain.

                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         BUTTON
                    ================================================== --}}

                    <div
                        class="d-flex justify-content-between
                        align-items-center flex-wrap gap-2
                        border-top pt-4">

                        <a
                            href="{{ route('siswa.profil.index') }}"
                            class="btn btn-light">

                            <i class="mdi mdi-arrow-left me-1"></i>

                            Batal

                        </a>


                        <button
                            type="submit"
                            class="btn btn-primary px-4">

                            <i class="mdi mdi-lock-reset me-1"></i>

                            Ubah Password

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     STYLE
========================================================= --}}

<style>
    .password-input {

        position: relative;

        width: 100%;

    }


    .password-field {

        min-height: 46px;

        padding-right: 50px !important;

        border-color: #ebedf2;

    }


    .password-field:focus {

        border-color: #4B49AC;

        box-shadow:
            0 0 0 .15rem rgba(75, 73, 172, .08);

    }


    .password-toggle {

        position: absolute;

        right: 1px;

        top: 1px;

        width: 44px;

        height: 44px;

        border: 0;

        background: transparent;

        color: #6c7293;

        display: flex;

        align-items: center;

        justify-content: center;

        cursor: pointer;

        border-radius: 0 6px 6px 0;

        z-index: 5;

    }


    .password-toggle:hover {

        color: #4B49AC;

        background: rgba(75, 73, 172, .05);

    }


    .password-toggle:focus {

        outline: none;

        color: #4B49AC;

    }


    .form-label {

        color: #343a40;

    }


    @media (max-width: 575px) {

        .card-body {

            padding: 20px !important;

        }


        .d-flex.justify-content-between {

            align-items: stretch !important;

        }


        .d-flex.justify-content-between>.btn {

            width: 100%;

            text-align: center;

        }

    }
</style>


{{-- =========================================================
     JAVASCRIPT
========================================================= --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {

        /*
        |--------------------------------------------------------------------------
        | Toggle Password
        |--------------------------------------------------------------------------
        */

        document
            .querySelectorAll('.password-toggle')
            .forEach(function(button) {

                button.addEventListener(
                    'click',
                    function() {

                        const target =
                            this.getAttribute('data-target');

                        const input =
                            document.getElementById(target);

                        const icon =
                            this.querySelector('i');


                        if (!input) {

                            return;

                        }


                        if (
                            input.type === 'password'
                        ) {

                            input.type = 'text';

                            icon.classList.remove(
                                'mdi-eye-outline'
                            );

                            icon.classList.add(
                                'mdi-eye-off-outline'
                            );

                        } else {

                            input.type = 'password';

                            icon.classList.remove(
                                'mdi-eye-off-outline'
                            );

                            icon.classList.add(
                                'mdi-eye-outline'
                            );

                        }

                    }
                );

            });


        /*
        |--------------------------------------------------------------------------
        | Cek Konfirmasi Password
        |--------------------------------------------------------------------------
        */

        const passwordBaru =
            document.getElementById('password_baru');

        const passwordKonfirmasi =
            document.getElementById(
                'password_baru_confirmation'
            );

        const passwordMatch =
            document.getElementById('passwordMatch');


        if (
            passwordBaru &&
            passwordKonfirmasi &&
            passwordMatch
        ) {

            function checkPasswordMatch() {

                if (
                    passwordKonfirmasi.value === ''
                ) {

                    passwordMatch.style.display =
                        'none';

                    passwordKonfirmasi.classList.remove(
                        'is-valid',
                        'is-invalid'
                    );

                    return;

                }


                if (
                    passwordBaru.value ===
                    passwordKonfirmasi.value
                ) {

                    passwordMatch.textContent =
                        'Password baru dan konfirmasi sudah sesuai.';

                    passwordMatch.className =
                        'small mt-2 text-success';

                    passwordMatch.style.display =
                        'block';

                    passwordKonfirmasi.classList.remove(
                        'is-invalid'
                    );

                    passwordKonfirmasi.classList.add(
                        'is-valid'
                    );

                } else {

                    passwordMatch.textContent =
                        'Konfirmasi password belum sesuai.';

                    passwordMatch.className =
                        'small mt-2 text-danger';

                    passwordMatch.style.display =
                        'block';

                    passwordKonfirmasi.classList.remove(
                        'is-valid'
                    );

                    passwordKonfirmasi.classList.add(
                        'is-invalid'
                    );

                }

            }


            passwordBaru.addEventListener(
                'input',
                checkPasswordMatch
            );


            passwordKonfirmasi.addEventListener(
                'input',
                checkPasswordMatch
            );

        }

    });
</script>

@endsection