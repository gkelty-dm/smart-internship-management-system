@extends('layouts.skydash-industri')

@section('title', 'Ubah Password')

@section('content')

<div class="row">

    <div class="col-12">

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">

            <div>

                <h4 class="fw-bold mb-1">
                    Ubah Password
                </h4>

                <p class="text-muted mb-0">
                    Ubah password akun pembimbing industri untuk menjaga keamanan akun.
                </p>

            </div>

            <a href="{{ route('industri.profil.index') }}"
                class="btn btn-light mt-2 mt-md-0">

                <i class="mdi mdi-arrow-left me-1"></i>

                Kembali

            </a>

        </div>

    </div>

</div>


<div class="row justify-content-center">

    <div class="col-lg-7 col-xl-6 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="text-center mb-4">

                    <div
                        class="rounded-circle bg-light
                        d-flex align-items-center justify-content-center
                        mx-auto mb-3"
                        style="width:80px;height:80px;">

                        <i
                            class="mdi mdi-lock-outline text-primary"
                            style="font-size:40px;">
                        </i>

                    </div>

                    <h5 class="fw-bold">
                        Keamanan Akun
                    </h5>

                    <p class="text-muted mb-0">

                        Masukkan password lama dan password baru
                        Anda.

                    </p>

                </div>


                <form
                    action="{{ route('industri.password.update') }}"
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

                        </label>

                        <div class="input-group">

                            <input
                                type="password"
                                name="password_lama"
                                id="password_lama"
                                class="form-control @error('password_lama') is-invalid @enderror"
                                placeholder="Masukkan password lama"
                                required>


                            <button
                                type="button"
                                class="btn btn-outline-secondary toggle-password"
                                data-target="password_lama">

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

                        </label>

                        <div class="input-group">

                            <input
                                type="password"
                                name="password_baru"
                                id="password_baru"
                                class="form-control @error('password_baru') is-invalid @enderror"
                                placeholder="Minimal 6 karakter"
                                required>


                            <button
                                type="button"
                                class="btn btn-outline-secondary toggle-password"
                                data-target="password_baru">

                                <i class="mdi mdi-eye-outline"></i>

                            </button>

                        </div>


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

                        </label>

                        <div class="input-group">

                            <input
                                type="password"
                                name="password_baru_confirmation"
                                id="password_baru_confirmation"
                                class="form-control"
                                placeholder="Ulangi password baru"
                                required>


                            <button
                                type="button"
                                class="btn btn-outline-secondary toggle-password"
                                data-target="password_baru_confirmation">

                                <i class="mdi mdi-eye-outline"></i>

                            </button>

                        </div>

                    </div>


                    {{-- =================================================
                         INFORMASI
                    ================================================== --}}

                    <div class="alert alert-info">

                        <i class="mdi mdi-information-outline me-1"></i>

                        Password baru harus memiliki minimal
                        <strong>6 karakter</strong>.

                    </div>


                    {{-- =================================================
                         BUTTON
                    ================================================== --}}

                    <div class="d-flex justify-content-end gap-2">

                        <a
                            href="{{ route('industri.profil.index') }}"
                            class="btn btn-light">

                            Batal

                        </a>


                        <button
                            type="submit"
                            class="btn btn-primary">

                            <i class="mdi mdi-lock-reset me-1"></i>

                            Ubah Password

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>


@push('scripts')

<script>
    document.addEventListener(
        'DOMContentLoaded',
        function() {

            document.querySelectorAll(
                '.toggle-password'
            ).forEach(function(button) {

                button.addEventListener(
                    'click',
                    function() {

                        const targetId =
                            this.dataset.target;

                        const input =
                            document.getElementById(
                                targetId
                            );

                        const icon =
                            this.querySelector(
                                'i'
                            );


                        if (
                            input.type ===
                            'password'
                        ) {

                            input.type =
                                'text';

                            icon.classList.remove(
                                'mdi-eye-outline'
                            );

                            icon.classList.add(
                                'mdi-eye-off-outline'
                            );

                        } else {

                            input.type =
                                'password';

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

        }
    );
</script>

@endpush

@endsection