<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Industri;
use App\Models\Perusahaan;
use App\Models\PenempatanPKL;
use App\Models\Absensi;
use App\Models\Logbook;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | STATISTIK DASHBOARD
        |--------------------------------------------------------------------------
        */

        $jumlahUser = User::count();

        $jumlahSiswa = Siswa::count();

        $jumlahGuru = Guru::count();

        $jumlahIndustri = Industri::count();

        $jumlahPerusahaan = Perusahaan::count();

        $jumlahPenempatan = PenempatanPKL::count();

        $jumlahAbsensi = Absensi::count();

        $jumlahLogbook = Logbook::count();


        /*
        |--------------------------------------------------------------------------
        | STATUS PENEMPATAN PKL
        |--------------------------------------------------------------------------
        */

        $pklAktif = PenempatanPKL::where(
            'status_pkl',
            'aktif'
        )->count();

        $pklPending = PenempatanPKL::where(
            'status_pkl',
            'pending'
        )->count();

        $pklSelesai = PenempatanPKL::where(
            'status_pkl',
            'selesai'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | STATUS LOGBOOK
        |--------------------------------------------------------------------------
        */

        $logbookPending = Logbook::where(
            'status_validasi',
            'pending'
        )->count();

        $logbookDisetujui = Logbook::where(
            'status_validasi',
            'disetujui'
        )->count();

        $logbookDitolak = Logbook::where(
            'status_validasi',
            'ditolak'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | ABSENSI HARI INI
        |--------------------------------------------------------------------------
        */

        $absensiHariIni = Absensi::whereDate(
            'tanggal',
            today()
        )->count();


        /*
        |--------------------------------------------------------------------------
        | DATA TERBARU
        |--------------------------------------------------------------------------
        */

        $penempatanTerbaru = PenempatanPKL::with([
            'siswa.user',
            'guru.user',
            'industri.user',
            'perusahaan',
        ])
            ->latest()
            ->take(5)
            ->get();


        $logbookTerbaru = Logbook::with([
            'siswa.user',
        ])
            ->latest()
            ->take(5)
            ->get();


        $absensiTerbaru = Absensi::with([
            'siswa.user',
        ])
            ->latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | DASHBOARD VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.dashboard.index',
            compact(
                'jumlahUser',
                'jumlahSiswa',
                'jumlahGuru',
                'jumlahIndustri',
                'jumlahPerusahaan',
                'jumlahPenempatan',
                'jumlahAbsensi',
                'jumlahLogbook',
                'pklAktif',
                'pklPending',
                'pklSelesai',
                'logbookPending',
                'logbookDisetujui',
                'logbookDitolak',
                'absensiHariIni',
                'penempatanTerbaru',
                'logbookTerbaru',
                'absensiTerbaru'
            )
        );
    }
}
