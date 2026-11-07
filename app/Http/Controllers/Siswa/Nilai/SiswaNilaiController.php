<?php

namespace App\Http\Controllers\Siswa\Nilai;

use App\Http\Controllers\Controller;
use App\Models\NilaiPKL;
use App\Models\PenempatanPKL;
use Illuminate\Support\Facades\Auth;

class SiswaNilaiController extends Controller
{
    /**
     * Menampilkan nilai PKL siswa.
     */
    public function index()
    {
        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            abort(403, 'Data siswa belum tersedia.');
        }

        $penempatan = PenempatanPKL::with([
            'siswa.user',
            'siswa.jurusan',
            'siswa.kelas',
            'guru.user',
            'industri.user',
            'industri.perusahaan',
            'perusahaan',
            'penilaianGuru',
            'penilaianIndustri',
            'nilaiPKL',
        ])
            ->where(
                'siswa_id',
                $siswa->id
            )
            ->first();

        $nilaiPKL = null;

        if ($penempatan) {
            $nilaiPKL = NilaiPKL::where(
                'penempatan_pkl_id',
                $penempatan->id
            )->first();
        }

        return view(
            'siswa.nilai.index',
            compact(
                'siswa',
                'penempatan',
                'nilaiPKL'
            )
        );
    }
}
