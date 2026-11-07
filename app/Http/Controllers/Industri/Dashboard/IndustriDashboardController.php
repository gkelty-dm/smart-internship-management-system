<?php

namespace App\Http\Controllers\Industri\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Logbook;
use App\Models\PenempatanPKL;
use Illuminate\Support\Facades\Auth;

class IndustriDashboardController extends Controller
{
    /**
     * Dashboard Pembimbing Industri.
     */
    public function index()
    {
        $industri = Auth::user()->industri;

        /*
        |--------------------------------------------------------------------------
        | Jika akun industri belum memiliki data Industri
        |--------------------------------------------------------------------------
        */

        if (!$industri) {
            abort(403, 'Data industri belum tersedia.');
        }


        /*
        |--------------------------------------------------------------------------
        | Data Penempatan PKL Industri
        |--------------------------------------------------------------------------
        */

        $penempatanQuery = PenempatanPKL::where(
            'industri_id',
            $industri->id
        );


        /*
        |--------------------------------------------------------------------------
        | Data Penempatan untuk Dashboard
        |--------------------------------------------------------------------------
        |
        | Blade dashboard menggunakan variabel $penempatans.
        | Karena itu variabel ini harus dikirim dari controller.
        |
        */

        $penempatans = (clone $penempatanQuery)
            ->with([
                'siswa.user',
                'siswa.jurusan',
                'siswa.kelas',
                'perusahaan',
            ])
            ->latest()
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Total Siswa Bimbingan
        |--------------------------------------------------------------------------
        */

        $totalSiswa = (clone $penempatanQuery)
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Siswa PKL Aktif
        |--------------------------------------------------------------------------
        */

        $siswaAktif = (clone $penempatanQuery)
            ->where(
                'status_pkl',
                'aktif'
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Siswa PKL Selesai
        |--------------------------------------------------------------------------
        */

        $siswaSelesai = (clone $penempatanQuery)
            ->where(
                'status_pkl',
                'selesai'
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | ID Siswa Bimbingan
        |--------------------------------------------------------------------------
        */

        $siswaIds = (clone $penempatanQuery)
            ->pluck('siswa_id');


        /*
        |--------------------------------------------------------------------------
        | Logbook Menunggu Validasi
        |--------------------------------------------------------------------------
        */

        $logbookPending = Logbook::whereIn(
            'siswa_id',
            $siswaIds
        )
            ->where(
                'status_validasi',
                'pending'
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Total Logbook
        |--------------------------------------------------------------------------
        */

        $totalLogbook = Logbook::whereIn(
            'siswa_id',
            $siswaIds
        )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Logbook Sudah Valid
        |--------------------------------------------------------------------------
        */

        $logbookValid = Logbook::whereIn(
            'siswa_id',
            $siswaIds
        )
            ->where(
                'status_validasi',
                'valid'
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Logbook Ditolak
        |--------------------------------------------------------------------------
        */

        $logbookDitolak = Logbook::whereIn(
            'siswa_id',
            $siswaIds
        )
            ->where(
                'status_validasi',
                'ditolak'
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Absensi Hari Ini
        |--------------------------------------------------------------------------
        */

        $absensiHariIni = Absensi::whereIn(
            'siswa_id',
            $siswaIds
        )
            ->whereDate(
                'tanggal',
                now()
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Kehadiran Hari Ini
        |--------------------------------------------------------------------------
        */

        $hadirHariIni = Absensi::whereIn(
            'siswa_id',
            $siswaIds
        )
            ->whereDate(
                'tanggal',
                now()
            )
            ->where(
                'status',
                'hadir'
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Izin Hari Ini
        |--------------------------------------------------------------------------
        */

        $izinHariIni = Absensi::whereIn(
            'siswa_id',
            $siswaIds
        )
            ->whereDate(
                'tanggal',
                now()
            )
            ->where(
                'status',
                'izin'
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Sakit Hari Ini
        |--------------------------------------------------------------------------
        */

        $sakitHariIni = Absensi::whereIn(
            'siswa_id',
            $siswaIds
        )
            ->whereDate(
                'tanggal',
                now()
            )
            ->where(
                'status',
                'sakit'
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Alpha Hari Ini
        |--------------------------------------------------------------------------
        */

        $alphaHariIni = Absensi::whereIn(
            'siswa_id',
            $siswaIds
        )
            ->whereDate(
                'tanggal',
                now()
            )
            ->where(
                'status',
                'alpha'
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Data Siswa Bimbingan Terbaru
        |--------------------------------------------------------------------------
        */

        $siswaBimbingan = PenempatanPKL::with([
            'siswa.user',
            'siswa.jurusan',
            'siswa.kelas',
            'perusahaan',
        ])
            ->where(
                'industri_id',
                $industri->id
            )
            ->latest()
            ->take(10)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Absensi Terbaru
        |--------------------------------------------------------------------------
        */

        $absensiTerbaru = Absensi::with([
            'siswa.user',
        ])
            ->whereIn(
                'siswa_id',
                $siswaIds
            )
            ->latest('tanggal')
            ->latest('id')
            ->take(10)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Logbook Terbaru
        |--------------------------------------------------------------------------
        */

        $logbookTerbaru = Logbook::with([
            'siswa.user',
        ])
            ->whereIn(
                'siswa_id',
                $siswaIds
            )
            ->latest('tanggal')
            ->latest('id')
            ->take(10)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Penempatan Terbaru
        |--------------------------------------------------------------------------
        */

        $penempatanTerbaru = PenempatanPKL::with([
            'siswa.user',
            'siswa.jurusan',
            'siswa.kelas',
            'perusahaan',
        ])
            ->where(
                'industri_id',
                $industri->id
            )
            ->latest()
            ->take(10)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Kirim Data ke Dashboard
        |--------------------------------------------------------------------------
        */

        return view(
            'industri.dashboard.index',
            compact(
                'industri',

                'totalSiswa',
                'siswaAktif',
                'siswaSelesai',

                'logbookPending',
                'totalLogbook',
                'logbookValid',
                'logbookDitolak',

                'absensiHariIni',
                'hadirHariIni',
                'izinHariIni',
                'sakitHariIni',
                'alphaHariIni',

                'penempatans',

                'siswaBimbingan',
                'absensiTerbaru',
                'logbookTerbaru',
                'penempatanTerbaru'
            )
        );
    }
}
