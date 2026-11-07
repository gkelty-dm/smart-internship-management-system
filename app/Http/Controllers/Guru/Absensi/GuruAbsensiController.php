<?php

namespace App\Http\Controllers\Guru\Absensi;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\PenempatanPKL;
use Illuminate\Support\Facades\Auth;

class GuruAbsensiController extends Controller
{
    /**
     * Menampilkan seluruh riwayat absensi
     * siswa yang dibimbing oleh guru yang login.
     */
    public function index()
    {
        $guru = Auth::user()->guru;

        if (!$guru) {
            abort(403, 'Data guru belum tersedia.');
        }

        $siswaIds = PenempatanPKL::where(
            'guru_id',
            $guru->id
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
            ->latest('tanggal')
            ->latest('id')
            ->paginate(15);

        $totalAbsensi = Absensi::whereIn(
            'siswa_id',
            $siswaIds
        )->count();

        $totalHadir = Absensi::whereIn(
            'siswa_id',
            $siswaIds
        )
            ->where(
                'status',
                'hadir'
            )
            ->count();

        $totalIzin = Absensi::whereIn(
            'siswa_id',
            $siswaIds
        )
            ->where(
                'status',
                'izin'
            )
            ->count();

        $totalSakit = Absensi::whereIn(
            'siswa_id',
            $siswaIds
        )
            ->where(
                'status',
                'sakit'
            )
            ->count();

        $totalAlpha = Absensi::whereIn(
            'siswa_id',
            $siswaIds
        )
            ->where(
                'status',
                'alpha'
            )
            ->count();

        return view(
            'guru.absensi.index',
            compact(
                'absensis',
                'totalAbsensi',
                'totalHadir',
                'totalIzin',
                'totalSakit',
                'totalAlpha'
            )
        );
    }

    /**
     * Menampilkan detail satu data absensi.
     */
    public function show(Absensi $absensi)
    {
        $guru = Auth::user()->guru;

        if (!$guru) {
            abort(403, 'Data guru belum tersedia.');
        }

        $this->pastikanAbsensiMilikSiswaBimbingan(
            $guru->id,
            $absensi
        );

        $absensi->load([
            'siswa.user',
            'siswa.jurusan',
            'siswa.kelas',
        ]);

        return view(
            'guru.absensi.show',
            compact('absensi')
        );
    }

    /**
     * Memastikan absensi berasal dari siswa
     * yang dibimbing oleh guru login.
     */
    private function pastikanAbsensiMilikSiswaBimbingan(
        int $guruId,
        Absensi $absensi
    ): void {
        $ada = PenempatanPKL::where(
            'guru_id',
            $guruId
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
