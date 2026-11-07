<?php

namespace App\Http\Controllers\Siswa\Absensi;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;

class AbsensiRiwayatController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | RIWAYAT ABSENSI SISWA
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            abort(403, 'Data siswa belum tersedia.');
        }

        $absensis = Absensi::where(
            'siswa_id',
            $siswa->id
        )
            ->latest('tanggal')
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view(
            'siswa.absensi.riwayat',
            compact(
                'siswa',
                'absensis'
            )
        );
    }
}
