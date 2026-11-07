<?php

namespace App\Http\Controllers\Siswa\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\FaceProfile;
use App\Models\Logbook;
use App\Models\NilaiPKL;
use App\Models\PenempatanPKL;
use Illuminate\Support\Facades\Auth;

class SiswaDashboardController extends Controller
{
    /**
     * Dashboard Siswa.
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | DATA USER
        |--------------------------------------------------------------------------
        */

        $user = Auth::user();

        if (!$user) {

            return redirect()->route('login');
        }


        /*
        |--------------------------------------------------------------------------
        | DATA SISWA
        |--------------------------------------------------------------------------
        */

        $siswa = $user->siswa;

        if (!$siswa) {

            abort(
                403,
                'Data siswa belum tersedia.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK REGISTRASI WAJAH
        |--------------------------------------------------------------------------
        */

        $faceProfile = FaceProfile::where(
            'siswa_id',
            $siswa->id
        )->first();


        if (
            !$faceProfile ||
            !$faceProfile->is_registered
        ) {

            return redirect()
                ->route('siswa.face.register')
                ->with(
                    'error',
                    'Silakan registrasi wajah terlebih dahulu.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | JUMLAH LOGBOOK
        |--------------------------------------------------------------------------
        */

        $jumlahLogbook = Logbook::where(
            'siswa_id',
            $siswa->id
        )->count();


        /*
        |--------------------------------------------------------------------------
        | LOGBOOK MENUNGGU VALIDASI
        |--------------------------------------------------------------------------
        */

        $logbookPending = Logbook::where(
            'siswa_id',
            $siswa->id
        )
            ->where(
                'status_validasi',
                'pending'
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | LOGBOOK DISETUJUI
        |--------------------------------------------------------------------------
        */

        $logbookDisetujui = Logbook::where(
            'siswa_id',
            $siswa->id
        )
            ->where(
                'status_validasi',
                'disetujui'
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | LOGBOOK DITOLAK
        |--------------------------------------------------------------------------
        */

        $logbookDitolak = Logbook::where(
            'siswa_id',
            $siswa->id
        )
            ->where(
                'status_validasi',
                'ditolak'
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | ABSENSI HARI INI
        |--------------------------------------------------------------------------
        */

        $absensiHariIni = Absensi::where(
            'siswa_id',
            $siswa->id
        )
            ->whereDate(
                'tanggal',
                now()
            )
            ->first();


        /*
        |--------------------------------------------------------------------------
        | TOTAL ABSENSI
        |--------------------------------------------------------------------------
        */

        $totalAbsensi = Absensi::where(
            'siswa_id',
            $siswa->id
        )->count();


        /*
        |--------------------------------------------------------------------------
        | TOTAL KEHADIRAN
        |--------------------------------------------------------------------------
        */

        $totalHadir = Absensi::where(
            'siswa_id',
            $siswa->id
        )
            ->where(
                'status',
                'hadir'
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | PENEMPATAN PKL
        |--------------------------------------------------------------------------
        */

        $penempatan = PenempatanPKL::with([
            'perusahaan',
            'guru.user',
            'industri.user',
        ])
            ->where(
                'siswa_id',
                $siswa->id
            )
            ->first();


        /*
        |--------------------------------------------------------------------------
        | NILAI PKL
        |--------------------------------------------------------------------------
        */

        $nilaiPKL = null;

        if ($penempatan) {

            $nilaiPKL = NilaiPKL::where(
                'penempatan_pkl_id',
                $penempatan->id
            )->first();
        }


        /*
        |--------------------------------------------------------------------------
        | LOGBOOK TERBARU
        |--------------------------------------------------------------------------
        */

        $logbookTerbaru = Logbook::with([
            'fotos',
        ])
            ->where(
                'siswa_id',
                $siswa->id
            )
            ->latest('tanggal')
            ->latest('id')
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | ABSENSI TERBARU
        |--------------------------------------------------------------------------
        */

        $absensiTerbaru = Absensi::where(
            'siswa_id',
            $siswa->id
        )
            ->latest('tanggal')
            ->latest('id')
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */

        return view(
            'siswa.dashboard.index',
            compact(
                'siswa',
                'jumlahLogbook',
                'logbookPending',
                'logbookDisetujui',
                'logbookDitolak',
                'absensiHariIni',
                'totalAbsensi',
                'totalHadir',
                'penempatan',
                'nilaiPKL',
                'logbookTerbaru',
                'absensiTerbaru'
            )
        );
    }
}
