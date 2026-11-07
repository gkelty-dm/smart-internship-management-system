<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Login | SIMPKL SMK Negeri 1 Tanjung Morawa</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4B49AC',
                        primaryDark: '#3F3D91'
                    }
                }
            }
        }
    </script>

</head>


<body class="min-h-screen bg-slate-50">


    <div class="min-h-screen flex">


        {{-- =====================================================
             PANEL KIRI
        ====================================================== --}}

        <div class="hidden lg:flex lg:w-[52%] relative overflow-hidden bg-[#4B49AC]">


            {{-- Background Decoration --}}

            <div class="absolute -top-32 -left-32 w-96 h-96 rounded-full bg-white/5"></div>

            <div class="absolute -right-40 top-1/3 w-[500px] h-[500px] rounded-full bg-white/5"></div>

            <div class="absolute -bottom-40 left-1/4 w-[500px] h-[500px] rounded-full bg-black/5"></div>


            <div class="relative z-10 w-full flex flex-col justify-between p-14">


                {{-- BRAND --}}

                <div class="flex items-center gap-4">

                    <div class="w-14 h-14 rounded-xl bg-white flex items-center justify-center shadow-lg">

                        <img
                            src="{{ asset('images/logo.png') }}"
                            alt="Logo SMK Negeri 1 Tanjung Morawa"
                            class="w-11 h-11 object-contain">

                    </div>


                    <div>

                        <div class="text-white text-xl font-bold tracking-wide">
                            SIMPKL
                        </div>

                        <div class="text-white/70 text-xs mt-1">
                            SMK Negeri 1 Tanjung Morawa
                        </div>

                    </div>

                </div>


                {{-- INFORMASI UTAMA --}}

                <div class="max-w-xl">


                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 border border-white/10 mb-6">

                        <span class="w-2 h-2 rounded-full bg-emerald-300"></span>

                        <span class="text-xs text-white/80">
                            Sistem Informasi Praktik Kerja Lapangan
                        </span>

                    </div>


                    <h1 class="text-5xl font-bold text-white leading-tight mb-6">

                        Pengelolaan PKL
                        <br>

                        <span class="text-indigo-200">
                            dalam satu sistem.
                        </span>

                    </h1>


                    <p class="text-white/70 text-sm leading-7 max-w-lg">

                        SIMPKL merupakan sistem informasi yang digunakan
                        untuk mendukung pengelolaan kegiatan Praktik Kerja
                        Lapangan di SMK Negeri 1 Tanjung Morawa secara
                        terintegrasi.

                    </p>


                    {{-- ROLE SISTEM --}}

                    <div class="mt-10">

                        <p class="text-xs font-semibold text-white/60 uppercase tracking-wider mb-4">
                            Pengguna Sistem
                        </p>


                        <div class="grid grid-cols-2 gap-3">


                            {{-- ADMIN --}}

                            <div class="flex items-center gap-3">

                                <div class="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center">

                                    <svg
                                        class="w-4 h-4 text-white"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v2h8z" />

                                    </svg>

                                </div>

                                <span class="text-xs text-white/80">
                                    Admin
                                </span>

                            </div>


                            {{-- SISWA --}}

                            <div class="flex items-center gap-3">

                                <div class="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center">

                                    <svg
                                        class="w-4 h-4 text-white"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 14l9-5-9-5-9 5 9 5z" />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 14l6.16-3.422A12.083 12.083 0 0118 15.5c0 1.657-2.686 3-6 3s-6-1.343-6-3c0-.99.254-1.91.84-2.922L12 14z" />

                                    </svg>

                                </div>

                                <span class="text-xs text-white/80">
                                    Siswa
                                </span>

                            </div>


                            {{-- GURU --}}

                            <div class="flex items-center gap-3">

                                <div class="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center">

                                    <svg
                                        class="w-4 h-4 text-white"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-9a4 4 0 110 8 4 4 0 010-8z" />

                                    </svg>

                                </div>

                                <span class="text-xs text-white/80">
                                    Guru Pembimbing
                                </span>

                            </div>


                            {{-- INDUSTRI --}}

                            <div class="flex items-center gap-3">

                                <div class="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center">

                                    <svg
                                        class="w-4 h-4 text-white"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-4h6v4M9 10h.01M15 10h.01M9 14h.01M15 14h.01" />

                                    </svg>

                                </div>

                                <span class="text-xs text-white/80">
                                    Industri
                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- FOOTER --}}

                <div>

                    <p class="text-xs text-white/40">
                        © {{ date('Y') }} SMK Negeri 1 Tanjung Morawa
                    </p>

                </div>

            </div>

        </div>


        {{-- =====================================================
             PANEL LOGIN
        ====================================================== --}}

        <div class="w-full lg:w-[48%] flex items-center justify-center px-6 py-10 sm:px-10 lg:px-16 xl:px-24 bg-white">


            <div class="w-full max-w-md">


                {{-- LOGO MOBILE --}}

                <div class="lg:hidden flex justify-center mb-9">

                    <div class="text-center">

                        <div class="w-16 h-16 mx-auto rounded-xl bg-[#4B49AC]/10 flex items-center justify-center mb-3">

                            <img
                                src="{{ asset('images/logo.png') }}"
                                alt="Logo SMK Negeri 1 Tanjung Morawa"
                                class="w-12 h-12 object-contain">

                        </div>

                        <h1 class="font-bold text-lg text-gray-800">
                            SIMPKL
                        </h1>

                        <p class="text-xs text-gray-400 mt-1">
                            SMK Negeri 1 Tanjung Morawa
                        </p>

                    </div>

                </div>


                {{-- HEADER LOGIN --}}

                <div class="mb-9">

                    <p class="text-xs font-semibold text-[#4B49AC] uppercase tracking-widest mb-3">
                        Portal Pengguna
                    </p>


                    <h2 class="text-3xl font-bold text-gray-800 mb-3">
                        Selamat Datang
                    </h2>


                    <p class="text-sm text-gray-500 leading-6">
                        Masuk menggunakan akun Anda untuk mengakses
                        Sistem Informasi Praktik Kerja Lapangan.
                    </p>

                </div>


                {{-- ERROR --}}

                @if($errors->any())

                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-100">

                    <div class="flex items-start gap-3">

                        <div class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center flex-shrink-0">

                            <svg
                                class="w-4 h-4 text-red-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 9v2m0 4h.01M5.07 19h13.86a2 2 0 001.73-3L13.73 4a2 2 0 00-3.46 0L3.34 16a2 2 0 001.73 3z" />

                            </svg>

                        </div>

                        <div>

                            <p class="text-sm font-semibold text-red-700">
                                Login gagal
                            </p>

                            <p class="text-xs text-red-600 mt-1">
                                Email atau password yang Anda masukkan tidak sesuai.
                            </p>

                        </div>

                    </div>

                </div>

                @endif


                {{-- FORM --}}

                <form
                    method="POST"
                    action="{{ route('login') }}"
                    class="space-y-5">

                    @csrf


                    {{-- EMAIL --}}

                    <div>

                        <label
                            for="email"
                            class="block text-xs font-semibold text-gray-700 mb-2">

                            Email

                        </label>


                        <div class="relative">

                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">

                                <svg
                                    class="w-4 h-4 text-gray-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />

                                </svg>

                            </div>


                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="email"
                                placeholder="Masukkan email"
                                class="w-full h-12 pl-11 pr-4 text-sm text-gray-800 bg-gray-50 border border-gray-200 rounded-xl outline-none transition focus:bg-white focus:border-[#4B49AC] focus:ring-4 focus:ring-[#4B49AC]/10 @error('email') border-red-400 @enderror">

                        </div>


                        @error('email')

                        <p class="text-xs text-red-500 mt-2">
                            {{ $message }}
                        </p>

                        @enderror

                    </div>


                    {{-- PASSWORD --}}

                    <div>

                        <label
                            for="password"
                            class="block text-xs font-semibold text-gray-700 mb-2">

                            Password

                        </label>


                        <div class="relative">

                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">

                                <svg
                                    class="w-4 h-4 text-gray-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v2h8z" />

                                </svg>

                            </div>


                            <input
                                type="password"
                                name="password"
                                id="password"
                                required
                                autocomplete="current-password"
                                placeholder="Masukkan password"
                                class="w-full h-12 pl-11 pr-12 text-sm text-gray-800 bg-gray-50 border border-gray-200 rounded-xl outline-none transition focus:bg-white focus:border-[#4B49AC] focus:ring-4 focus:ring-[#4B49AC]/10 @error('password') border-red-400 @enderror">


                            <button
                                type="button"
                                onclick="togglePassword()"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-[#4B49AC] transition">

                                <svg
                                    id="eyeIcon"
                                    class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />

                                </svg>

                            </button>

                        </div>


                        @error('password')

                        <p class="text-xs text-red-500 mt-2">
                            {{ $message }}
                        </p>

                        @enderror

                    </div>


                    {{-- BUTTON LOGIN --}}

                    <button
                        type="submit"
                        class="w-full h-12 mt-3 bg-[#4B49AC] hover:bg-[#3F3D91] text-white text-sm font-semibold rounded-xl shadow-lg shadow-[#4B49AC]/20 transition-all duration-200 hover:-translate-y-0.5 active:translate-y-0">

                        <span class="flex items-center justify-center gap-2">

                            Masuk ke Sistem

                            <svg
                                class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />

                            </svg>

                        </span>

                    </button>

                </form>


                {{-- FOOTER LOGIN --}}

                <div class="text-center mt-8">

                    <p class="text-[10px] text-gray-400">

                        Sistem Informasi Praktik Kerja Lapangan

                    </p>

                    <p class="text-[10px] text-gray-400 mt-1">

                        SMK Negeri 1 Tanjung Morawa

                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         PASSWORD TOGGLE
    ====================================================== --}}

    <script>
        function togglePassword() {

            const password = document.getElementById('password');

            const eyeIcon = document.getElementById('eyeIcon');


            if (password.type === 'password') {

                password.type = 'text';

                eyeIcon.innerHTML = `
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.97 9.97 0 012.245-3.592M6.6 6.6A9.96 9.96 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.96 9.96 0 01-4.132 5.168M3 3l18 18"
                    />
                `;

            } else {

                password.type = 'password';

                eyeIcon.innerHTML = `
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268 2.943-9.542 7-9.542-7z"
                    />
                `;

            }

        }
    </script>

</body>

</html>