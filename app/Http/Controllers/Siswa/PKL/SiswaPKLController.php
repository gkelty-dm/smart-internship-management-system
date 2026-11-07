<?php

namespace App\Http\Controllers\Siswa\PKL;

use App\Http\Controllers\Controller;
use App\Models\PenempatanPKL;
use Illuminate\Support\Facades\Auth;

class SiswaPKLController extends Controller
{
    /**
     * Menampilkan profil / informasi PKL siswa.
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
        ])
            ->where(
                'siswa_id',
                $siswa->id
            )
            ->first();

        return view(
            'siswa.pkl.index',
            compact(
                'siswa',
                'penempatan'
            )
        );
    }
}
