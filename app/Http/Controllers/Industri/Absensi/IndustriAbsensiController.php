<?php

namespace App\Http\Controllers\Industri\Absensi;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\PenempatanPKL;
use Illuminate\Support\Facades\Auth;

class IndustriAbsensiController extends Controller
{
    /**
     * Menampilkan seluruh riwayat absensi
     * siswa PKL yang dibimbing oleh industri yang login.
     */
    public function index()
    {
        $industri = Auth::user()->industri;

        if (!$industri) {
            abort(403, 'Data industri belum tersedia.');
        }

        $siswaIds = PenempatanPKL::where(
            'industri_id',
            $industri->id
        )->pluck('siswa_id');

        $absensis = Absensi::with([
            'siswa.user',
            'siswa.jurusan',
            'siswa.kelas',
        ])
            ->whereIn(
                'siswa_id',
                $siswaIds
            )
            ->where(
                'status',
                'hadir'
            )
            ->latest('tanggal')
            ->latest('id')
            ->paginate(15);

        $totalAbsensi = Absensi::whereIn(
            'siswa_id',
            $siswaIds
        )
            ->where(
                'status',
                'hadir'
            )
            ->count();

        return view(
            'industri.absensi.index',
            compact(
                'absensis',
                'totalAbsensi'
            )
        );
    }


    /**
     * Menampilkan detail satu data absensi.
     */
    public function show(Absensi $absensi)
    {
        $industri = Auth::user()->industri;

        if (!$industri) {
            abort(403, 'Data industri belum tersedia.');
        }

        $this->pastikanAbsensiMilikSiswaPKL(
            $industri->id,
            $absensi
        );

        $absensi->load([
            'siswa.user',
            'siswa.jurusan',
            'siswa.kelas',
        ]);

        return view(
            'industri.absensi.show',
            compact('absensi')
        );
    }


    /**
     * Memastikan absensi berasal dari siswa
     * yang berada di bawah bimbingan industri login.
     */
    private function pastikanAbsensiMilikSiswaPKL(
        int $industriId,
        Absensi $absensi
    ): void {
        $ada = PenempatanPKL::where(
            'industri_id',
            $industriId
        )
            ->where(
                'siswa_id',
                $absensi->siswa_id
            )
            ->exists();

        if (!$ada) {
            abort(
                403,
                'Anda tidak memiliki akses ke data absensi ini.'
            );
        }
    }
}
