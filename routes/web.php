<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| ADMIN CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Admin\Dashboard\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\Users\UserController as AdminUserController;
use App\Http\Controllers\Admin\Siswa\SiswaController as AdminSiswaController;
use App\Http\Controllers\Admin\Jurusan\JurusanController as AdminJurusanController;
use App\Http\Controllers\Admin\Kelas\KelasController as AdminKelasController;
use App\Http\Controllers\Admin\GuruPembimbing\GuruPembimbingController as AdminGuruPembimbingController;
use App\Http\Controllers\Admin\Industri\IndustriController as AdminIndustriController;
use App\Http\Controllers\Admin\IndustriPembimbing\IndustriPembimbingController as AdminIndustriPembimbingController;
use App\Http\Controllers\Admin\PenempatanPKL\PenempatanPKLController as AdminPenempatanPKLController;
use App\Http\Controllers\Admin\Absensi\AbsensiController as AdminAbsensiController;
use App\Http\Controllers\Admin\Logbook\LogbookController as AdminLogbookController;
use App\Http\Controllers\Admin\Nilai\NilaiController as AdminNilaiController;
use App\Http\Controllers\Admin\Profile\ProfileController as AdminProfileController;


/*
|--------------------------------------------------------------------------
| SISWA CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Siswa\Dashboard\SiswaDashboardController;
use App\Http\Controllers\Siswa\Logbook\SiswaLogbookController;
use App\Http\Controllers\Siswa\PKL\SiswaPKLController;
use App\Http\Controllers\Siswa\Nilai\SiswaNilaiController;
use App\Http\Controllers\Siswa\Profil\SiswaProfilController;

use App\Http\Controllers\Siswa\Face\FaceRegistrationController;
use App\Http\Controllers\Siswa\Face\FaceDetectionController;

use App\Http\Controllers\Siswa\Absensi\AbsensiMasukController;
use App\Http\Controllers\Siswa\Absensi\AbsensiPulangController;
use App\Http\Controllers\Siswa\Absensi\AbsensiRiwayatController;


/*
|--------------------------------------------------------------------------
| GURU CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Guru\Dashboard\GuruDashboardController;
use App\Http\Controllers\Guru\SiswaBimbingan\GuruSiswaBimbinganController;
use App\Http\Controllers\Guru\Absensi\GuruAbsensiController;
use App\Http\Controllers\Guru\Logbook\GuruLogbookController;
use App\Http\Controllers\Guru\Penilaian\GuruPenilaianController;
use App\Http\Controllers\Guru\Profil\GuruProfilController;


/*
|--------------------------------------------------------------------------
| INDUSTRI CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Industri\Dashboard\IndustriDashboardController;
use App\Http\Controllers\Industri\SiswaBimbingan\IndustriSiswaBimbinganController;
use App\Http\Controllers\Industri\Absensi\IndustriAbsensiController;
use App\Http\Controllers\Industri\Logbook\IndustriLogbookController;
use App\Http\Controllers\Industri\Penilaian\IndustriPenilaianController;
use App\Http\Controllers\Industri\Profil\IndustriProfilController;


/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    if (Auth::check()) {

        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if (Auth::user()->role === 'guru') {
            return redirect()->route('guru.dashboard');
        }

        if (Auth::user()->role === 'siswa') {
            return redirect()->route('siswa.dashboard');
        }

        if (Auth::user()->role === 'industri') {
            return redirect()->route('industri.dashboard');
        }
    }

    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:admin'
])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [AdminDashboardController::class, 'index']
        )->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | USERS
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'users',
            AdminUserController::class
        );

        Route::post(
            '/users/{user}/reset-password',
            [AdminUserController::class, 'resetPassword']
        )->name('users.reset-password');

        Route::post(
            '/users/{user}/nonaktif',
            [AdminUserController::class, 'nonaktifkan']
        )->name('users.nonaktif');

        Route::post(
            '/users/{user}/aktif',
            [AdminUserController::class, 'aktifkan']
        )->name('users.aktif');


        /*
        |--------------------------------------------------------------------------
        | SISWA
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/siswa',
            [AdminSiswaController::class, 'index']
        )->name('siswa.index');

        Route::post(
            '/siswa',
            [AdminSiswaController::class, 'store']
        )->name('siswa.store');

        Route::get(
            '/siswa/create',
            [AdminSiswaController::class, 'create']
        )->name('siswa.create');

        Route::post(
            '/siswa/import',
            [AdminSiswaController::class, 'import']
        )->name('siswa.import');

        Route::get(
            '/siswa/kelas/{jurusanId}',
            [AdminSiswaController::class, 'getKelas']
        )->name('siswa.getKelas');

        Route::get(
            '/siswa/{siswa}',
            [AdminSiswaController::class, 'show']
        )->name('siswa.show');

        Route::get(
            '/siswa/{siswa}/edit',
            [AdminSiswaController::class, 'edit']
        )->name('siswa.edit');

        Route::put(
            '/siswa/{siswa}',
            [AdminSiswaController::class, 'update']
        )->name('siswa.update');

        Route::delete(
            '/siswa/{siswa}',
            [AdminSiswaController::class, 'destroy']
        )->name('siswa.destroy');

        Route::get(
            '/siswa/{siswa}/riwayat-absensi',
            [AdminSiswaController::class, 'riwayatAbsensi']
        )->name('siswa.riwayat-absensi');

        Route::get(
            '/siswa/{siswa}/riwayat-logbook',
            [AdminSiswaController::class, 'riwayatLogbook']
        )->name('siswa.riwayat-logbook');

        Route::post(
            '/siswa/{siswa}/upload-face',
            [AdminSiswaController::class, 'uploadFace']
        )->name('siswa.upload-face');

        Route::post(
            '/siswa/{siswa}/reset-face',
            [AdminSiswaController::class, 'resetFace']
        )->name('siswa.reset-face');


        /*
        |--------------------------------------------------------------------------
        | JURUSAN
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'jurusan',
            AdminJurusanController::class
        );

        Route::post(
            '/jurusan/import',
            [AdminJurusanController::class, 'import']
        )->name('jurusan.import');


        /*
        |--------------------------------------------------------------------------
        | KELAS
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'kelas',
            AdminKelasController::class
        );

        Route::post(
            '/kelas/import',
            [AdminKelasController::class, 'import']
        )->name('kelas.import');


        /*
        |--------------------------------------------------------------------------
        | GURU PEMBIMBING
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'guru-pembimbing',
            AdminGuruPembimbingController::class
        );

        Route::post(
            '/guru-pembimbing/import',
            [AdminGuruPembimbingController::class, 'import']
        )->name('guru-pembimbing.import');


        /*
        |--------------------------------------------------------------------------
        | INDUSTRI / DUDI
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/industri',
            [AdminIndustriController::class, 'index']
        )->name('industri.index');

        Route::post(
            '/industri',
            [AdminIndustriController::class, 'store']
        )->name('industri.store');

        Route::get(
            '/industri/create',
            [AdminIndustriController::class, 'create']
        )->name('industri.create');

        Route::post(
            '/industri/import',
            [AdminIndustriController::class, 'import']
        )->name('industri.import');

        Route::get(
            '/industri/{perusahaan}',
            [AdminIndustriController::class, 'show']
        )->name('industri.show');

        Route::get(
            '/industri/{perusahaan}/edit',
            [AdminIndustriController::class, 'edit']
        )->name('industri.edit');

        Route::put(
            '/industri/{perusahaan}',
            [AdminIndustriController::class, 'update']
        )->name('industri.update');

        Route::delete(
            '/industri/{perusahaan}',
            [AdminIndustriController::class, 'destroy']
        )->name('industri.destroy');


        /*
|--------------------------------------------------------------------------
| PEMBIMBING INDUSTRI
|--------------------------------------------------------------------------
*/

        Route::resource(
            'industri-pembimbing',
            AdminIndustriPembimbingController::class
        )->parameters([
            'industri-pembimbing' => 'industri'
        ]);

        Route::post(
            '/industri-pembimbing/import',
            [AdminIndustriPembimbingController::class, 'import']
        )->name('industri-pembimbing.import');


        /*
        |--------------------------------------------------------------------------
        | PENEMPATAN PKL
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'penempatan-pkl',
            AdminPenempatanPKLController::class
        );

        Route::post(
            '/penempatan-pkl/import',
            [AdminPenempatanPKLController::class, 'import']
        )->name('penempatan-pkl.import');


        /*
        |--------------------------------------------------------------------------
        | ABSENSI
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/absensi',
            [AdminAbsensiController::class, 'index']
        )->name('absensi');

        Route::get(
            '/absensi/{absensi}',
            [AdminAbsensiController::class, 'show']
        )->name('absensi.show');


        /*
        |--------------------------------------------------------------------------
        | LOGBOOK
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/logbook',
            [AdminLogbookController::class, 'index']
        )->name('logbook');

        Route::get(
            '/logbook/{logbook}',
            [AdminLogbookController::class, 'show']
        )->name('logbook.show');

        Route::put(
            '/logbook/{logbook}/validasi',
            [AdminLogbookController::class, 'validasi']
        )->name('logbook.validasi');


        /*
        |--------------------------------------------------------------------------
        | NILAI
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/nilai',
            [AdminNilaiController::class, 'index']
        )->name('nilai.index');

        Route::get(
            '/nilai/{penempatan}',
            [AdminNilaiController::class, 'show']
        )->name('nilai.show');


        /*
        |--------------------------------------------------------------------------
        | PROFILE ADMIN
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/profile',
            [AdminProfileController::class, 'index']
        )->name('profile');

        Route::put(
            '/profile',
            [AdminProfileController::class, 'update']
        )->name('profile.update');

        Route::put(
            '/profile/password',
            [AdminProfileController::class, 'updatePassword']
        )->name('profile.password');
    });


/*
|--------------------------------------------------------------------------
| SISWA
|--------------------------------------------------------------------------
*/

Route::prefix('siswa')
    ->as('siswa.')
    ->middleware([
        'auth',
        'role:siswa'
    ])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [SiswaDashboardController::class, 'index']
        )->name('dashboard');


        /*
|--------------------------------------------------------------------------
| ABSENSI SISWA
|--------------------------------------------------------------------------
*/

        Route::prefix('absensi')
            ->as('absensi.')
            ->group(function () {

                /*
    |--------------------------------------------------------------------------
    | ABSEN MASUK
    |--------------------------------------------------------------------------
    */

                Route::get(
                    '/masuk',
                    [AbsensiMasukController::class, 'index']
                )->name('masuk');

                Route::post(
                    '/masuk',
                    [AbsensiMasukController::class, 'store']
                )->name('masuk.store');


                /*
    |--------------------------------------------------------------------------
    | ABSEN PULANG
    |--------------------------------------------------------------------------
    */

                Route::get(
                    '/pulang',
                    [AbsensiPulangController::class, 'index']
                )->name('pulang');

                Route::post(
                    '/pulang',
                    [AbsensiPulangController::class, 'store']
                )->name('pulang.store');


                /*
    |--------------------------------------------------------------------------
    | VERIFIKASI WAJAH
    |--------------------------------------------------------------------------
    */

                Route::post(
                    '/verify-face',
                    [AbsensiMasukController::class, 'verifyFace']
                )->name('verify-face');


                /*
    |--------------------------------------------------------------------------
    | RIWAYAT
    |--------------------------------------------------------------------------
    */

                Route::get(
                    '/riwayat',
                    [AbsensiRiwayatController::class, 'index']
                )->name('riwayat');
            });


        /*
        |--------------------------------------------------------------------------
        | LOGBOOK
        |--------------------------------------------------------------------------
        */

        Route::prefix('logbook')
            ->as('logbook.')
            ->group(function () {

                Route::get(
                    '/',
                    [SiswaLogbookController::class, 'index']
                )->name('index');

                Route::get(
                    '/create',
                    [SiswaLogbookController::class, 'create']
                )->name('create');

                Route::post(
                    '/',
                    [SiswaLogbookController::class, 'store']
                )->name('store');

                Route::get(
                    '/{logbook}',
                    [SiswaLogbookController::class, 'show']
                )->name('show');

                Route::get(
                    '/{logbook}/edit',
                    [SiswaLogbookController::class, 'edit']
                )->name('edit');

                Route::put(
                    '/{logbook}',
                    [SiswaLogbookController::class, 'update']
                )->name('update');

                Route::delete(
                    '/{logbook}',
                    [SiswaLogbookController::class, 'destroy']
                )->name('destroy');
            });


        /*
        |--------------------------------------------------------------------------
        | PKL
        |--------------------------------------------------------------------------
        */

        Route::prefix('pkl')
            ->as('pkl.')
            ->group(function () {

                Route::get(
                    '/',
                    [SiswaPKLController::class, 'index']
                )->name('index');
            });


        /*
        |--------------------------------------------------------------------------
        | NILAI PKL
        |--------------------------------------------------------------------------
        */

        Route::prefix('nilai')
            ->as('nilai.')
            ->group(function () {

                Route::get(
                    '/',
                    [SiswaNilaiController::class, 'index']
                )->name('index');
            });


        /*
        |--------------------------------------------------------------------------
        | PROFIL
        |--------------------------------------------------------------------------
        */

        Route::prefix('profil')
            ->as('profil.')
            ->group(function () {

                Route::get(
                    '/',
                    [SiswaProfilController::class, 'index']
                )->name('index');

                Route::get(
                    '/edit',
                    [SiswaProfilController::class, 'edit']
                )->name('edit');

                Route::put(
                    '/',
                    [SiswaProfilController::class, 'update']
                )->name('update');
            });


        /*
        |--------------------------------------------------------------------------
        | PASSWORD
        |--------------------------------------------------------------------------
        */

        Route::prefix('password')
            ->as('password.')
            ->group(function () {

                Route::get(
                    '/',
                    [SiswaProfilController::class, 'password']
                )->name('index');

                Route::put(
                    '/',
                    [SiswaProfilController::class, 'updatePassword']
                )->name('update');
            });


        /*
        |--------------------------------------------------------------------------
        | REGISTRASI WAJAH
        |--------------------------------------------------------------------------
        */

        Route::prefix('face')
            ->as('face.')
            ->group(function () {

                /*
                |------------------------------------------------------------------
                | HALAMAN REGISTRASI
                |------------------------------------------------------------------
                */

                Route::get(
                    '/register',
                    [FaceRegistrationController::class, 'index']
                )->name('register');


                /*
                |------------------------------------------------------------------
                | SIMPAN FOTO
                |------------------------------------------------------------------
                */

                Route::post(
                    '/register',
                    [FaceRegistrationController::class, 'store']
                )->name('register.store');
            });
    });


/*
|--------------------------------------------------------------------------
| FACE DETECTION
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:siswa'
])
    ->post(
        '/siswa/face/detect',
        [FaceDetectionController::class, 'detect']
    )
    ->name('face.detect');


/*
|--------------------------------------------------------------------------
| GURU
|--------------------------------------------------------------------------
*/

Route::prefix('guru')
    ->as('guru.')
    ->middleware(['auth'])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [GuruDashboardController::class, 'index']
        )->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | PROFIL GURU
        |--------------------------------------------------------------------------
        */

        Route::prefix('profil')
            ->as('profil.')
            ->group(function () {

                Route::get(
                    '/',
                    [GuruProfilController::class, 'index']
                )->name('index');

                Route::put(
                    '/',
                    [GuruProfilController::class, 'update']
                )->name('update');

                Route::get(
                    '/edit',
                    [GuruProfilController::class, 'edit']
                )->name('edit');
            });


        /*
        |--------------------------------------------------------------------------
        | PASSWORD
        |--------------------------------------------------------------------------
        */

        Route::prefix('password')
            ->as('password.')
            ->group(function () {

                Route::get(
                    '/',
                    [GuruProfilController::class, 'password']
                )->name('index');

                Route::put(
                    '/',
                    [GuruProfilController::class, 'updatePassword']
                )->name('update');
            });


        /*
        |--------------------------------------------------------------------------
        | SISWA BIMBINGAN
        |--------------------------------------------------------------------------
        */

        Route::prefix('siswa')
            ->as('siswa.')
            ->group(function () {

                Route::get(
                    '/',
                    [GuruSiswaBimbinganController::class, 'index']
                )->name('index');

                Route::get(
                    '/{siswa}',
                    [GuruSiswaBimbinganController::class, 'detail']
                )->name('show');

                Route::get(
                    '/{siswa}/absensi',
                    [GuruSiswaBimbinganController::class, 'detailAbsensi']
                )->name('absensi');

                Route::get(
                    '/{siswa}/logbook',
                    [GuruSiswaBimbinganController::class, 'detailLogbook']
                )->name('logbook');

                Route::get(
                    '/{siswa}/penilaian',
                    [GuruSiswaBimbinganController::class, 'detailPenilaian']
                )->name('penilaian');

                Route::get(
                    '/{siswa}/laporan',
                    [GuruSiswaBimbinganController::class, 'cetakLaporan']
                )->name('laporan');
            });


        /*
        |--------------------------------------------------------------------------
        | ABSENSI
        |--------------------------------------------------------------------------
        */

        Route::prefix('absensi')
            ->as('absensi.')
            ->group(function () {

                Route::get(
                    '/',
                    [GuruAbsensiController::class, 'index']
                )->name('index');

                Route::get(
                    '/{absensi}',
                    [GuruAbsensiController::class, 'show']
                )->name('show');
            });


        /*
        |--------------------------------------------------------------------------
        | LOGBOOK
        |--------------------------------------------------------------------------
        */

        Route::prefix('logbook')
            ->as('logbook.')
            ->group(function () {

                Route::get(
                    '/',
                    [GuruLogbookController::class, 'index']
                )->name('index');

                Route::get(
                    '/{logbook}',
                    [GuruLogbookController::class, 'show']
                )->name('show');

                Route::post(
                    '/{logbook}/validasi',
                    [GuruLogbookController::class, 'validasi']
                )->name('validasi');
            });


        /*
        |--------------------------------------------------------------------------
        | PENILAIAN
        |--------------------------------------------------------------------------
        */

        Route::prefix('penilaian')
            ->as('penilaian.')
            ->group(function () {

                Route::get(
                    '/',
                    [GuruPenilaianController::class, 'index']
                )->name('index');

                Route::get(
                    '/create/{penempatan}',
                    [GuruPenilaianController::class, 'create']
                )->name('create');

                Route::post(
                    '/{penempatan}',
                    [GuruPenilaianController::class, 'store']
                )->name('store');

                Route::get(
                    '/{penilaianGuru}',
                    [GuruPenilaianController::class, 'show']
                )->name('show');

                Route::get(
                    '/{penilaianGuru}/edit',
                    [GuruPenilaianController::class, 'edit']
                )->name('edit');

                Route::put(
                    '/{penilaianGuru}',
                    [GuruPenilaianController::class, 'update']
                )->name('update');
            });
    });


/*
|--------------------------------------------------------------------------
| INDUSTRI
|--------------------------------------------------------------------------
*/

Route::prefix('industri')
    ->as('industri.')
    ->middleware([
        'auth',
        'role:industri'
    ])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [IndustriDashboardController::class, 'index']
        )->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | PROFIL INDUSTRI
        |--------------------------------------------------------------------------
        */

        Route::prefix('profil')
            ->as('profil.')
            ->group(function () {

                Route::get(
                    '/',
                    [IndustriProfilController::class, 'index']
                )->name('index');

                Route::put(
                    '/',
                    [IndustriProfilController::class, 'update']
                )->name('update');

                Route::get(
                    '/edit',
                    [IndustriProfilController::class, 'edit']
                )->name('edit');
            });


        /*
        |--------------------------------------------------------------------------
        | PASSWORD
        |--------------------------------------------------------------------------
        */

        Route::prefix('password')
            ->as('password.')
            ->group(function () {

                Route::get(
                    '/',
                    [IndustriProfilController::class, 'password']
                )->name('index');

                Route::put(
                    '/',
                    [IndustriProfilController::class, 'updatePassword']
                )->name('update');
            });


        /*
        |--------------------------------------------------------------------------
        | SISWA BIMBINGAN
        |--------------------------------------------------------------------------
        */

        Route::prefix('siswa')
            ->as('siswa.')
            ->group(function () {

                Route::get(
                    '/',
                    [IndustriSiswaBimbinganController::class, 'index']
                )->name('index');

                Route::get(
                    '/{siswa}',
                    [IndustriSiswaBimbinganController::class, 'detail']
                )->name('show');

                Route::get(
                    '/{siswa}/absensi',
                    [IndustriSiswaBimbinganController::class, 'detailAbsensi']
                )->name('absensi');

                Route::get(
                    '/{siswa}/logbook',
                    [IndustriSiswaBimbinganController::class, 'detailLogbook']
                )->name('logbook');

                Route::get(
                    '/{siswa}/penilaian',
                    [IndustriSiswaBimbinganController::class, 'detailPenilaian']
                )->name('penilaian');

                Route::get(
                    '/{siswa}/laporan',
                    [IndustriSiswaBimbinganController::class, 'cetakLaporan']
                )->name('laporan');
            });


        /*
        |--------------------------------------------------------------------------
        | ABSENSI
        |--------------------------------------------------------------------------
        */

        Route::prefix('absensi')
            ->as('absensi.')
            ->group(function () {

                Route::get(
                    '/',
                    [IndustriAbsensiController::class, 'index']
                )->name('index');

                Route::get(
                    '/{absensi}',
                    [IndustriAbsensiController::class, 'show']
                )->name('show');
            });


        /*
        |--------------------------------------------------------------------------
        | LOGBOOK
        |--------------------------------------------------------------------------
        */

        Route::prefix('logbook')
            ->as('logbook.')
            ->group(function () {

                Route::get(
                    '/',
                    [IndustriLogbookController::class, 'index']
                )->name('index');

                Route::get(
                    '/{logbook}',
                    [IndustriLogbookController::class, 'show']
                )->name('show');

                Route::post(
                    '/{logbook}/validasi',
                    [IndustriLogbookController::class, 'validasi']
                )->name('validasi');
            });


        /*
        |--------------------------------------------------------------------------
        | PENILAIAN
        |--------------------------------------------------------------------------
        */

        Route::prefix('penilaian')
            ->as('penilaian.')
            ->group(function () {

                Route::get(
                    '/',
                    [IndustriPenilaianController::class, 'index']
                )->name('index');

                Route::get(
                    '/create/{penempatan}',
                    [IndustriPenilaianController::class, 'create']
                )->name('create');

                Route::post(
                    '/{penempatan}',
                    [IndustriPenilaianController::class, 'store']
                )->name('store');

                Route::get(
                    '/{penilaianIndustri}',
                    [IndustriPenilaianController::class, 'show']
                )->name('show');

                Route::get(
                    '/{penilaianIndustri}/edit',
                    [IndustriPenilaianController::class, 'edit']
                )->name('edit');

                Route::put(
                    '/{penilaianIndustri}',
                    [IndustriPenilaianController::class, 'update']
                )->name('update');
            });
    });


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
