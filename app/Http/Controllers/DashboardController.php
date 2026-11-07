<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Industri;
use App\Models\Perusahaan;
use App\Models\PenempatanPKL;
use App\Models\Logbook;
use App\Models\Absensi;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahSiswa = Siswa::count();

        $jumlahGuru = Guru::count();

        $jumlahIndustri = Industri::count();

        $jumlahPerusahaan = Perusahaan::count();

        $pklAktif = PenempatanPKL::where(
            'status_pkl',
            'aktif'
        )->count();

        $pklSelesai = PenempatanPKL::where(
            'status_pkl',
            'selesai'
        )->count();

        $logbookPending = Logbook::where(
            'status_validasi',
            'pending'
        )->count();

        $absensiHariIni = Absensi::whereDate(
            'tanggal',
            now()
        )->count();

        return view(
            'dashboard',
            compact(
                'jumlahSiswa',
                'jumlahGuru',
                'jumlahIndustri',
                'jumlahPerusahaan',
                'pklAktif',
                'pklSelesai',
                'logbookPending',
                'absensiHariIni'
            )
        );
    }
}