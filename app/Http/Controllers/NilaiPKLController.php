<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NilaiPKL;
use App\Models\PenempatanPKL;
use App\Models\PenilaianGuru;
use App\Models\PenilaianIndustri;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Industri;

class NilaiPKLController extends Controller
{
    public function index()
    {
        $nilaiPKL = NilaiPKL::with([
            'penempatan.siswa.user',
            'penempatan.perusahaan'
        ])
        ->latest()
        ->paginate(10);

        return view(
            'nilai-pkl.index',
            compact('nilaiPKL')
        );
    }

    public function adminIndex(Request $request)
{
    $query = NilaiPKL::with([
        'penempatan.siswa.user',
        'penempatan.siswa.jurusan',
        'penempatan.siswa.kelas',
        'penempatan.perusahaan',
        'penempatan.guru.user',
        'penempatan.industri.user'
    ]);

    /*
    |--------------------------------------------------------------------------
    | Filter Nama
    |--------------------------------------------------------------------------
    */

    if ($request->filled('search')) {

        $query->whereHas(
            'penempatan.siswa.user',
            function ($q) use ($request) {

                $q->where(
                    'name',
                    'like',
                    '%' . $request->search . '%'
                );

            }
        );

    }

    /*
    |--------------------------------------------------------------------------
    | Filter Jurusan
    |--------------------------------------------------------------------------
    */

    if ($request->filled('jurusan')) {

        $query->whereHas(
            'penempatan.siswa',
            function ($q) use ($request) {

                $q->where(
                    'jurusan_id',
                    $request->jurusan
                );

            }
        );

    }

    /*
    |--------------------------------------------------------------------------
    | Filter Kelas
    |--------------------------------------------------------------------------
    */

    if ($request->filled('kelas')) {

        $query->whereHas(
            'penempatan.siswa',
            function ($q) use ($request) {

                $q->where(
                    'kelas_id',
                    $request->kelas
                );

            }
        );

    }

    /*
    |--------------------------------------------------------------------------
    | Filter Industri
    |--------------------------------------------------------------------------
    */

    if ($request->filled('industri')) {

        $query->whereHas(
            'penempatan',
            function ($q) use ($request) {

                $q->where(
                    'industri_id',
                    $request->industri
                );

            }
        );

    }

    /*
    |--------------------------------------------------------------------------
    | Statistik
    |--------------------------------------------------------------------------
    */

    $totalNilai = NilaiPKL::count();

    $gradeA = NilaiPKL::where('predikat','A')->count();

    $gradeB = NilaiPKL::where('predikat','B')->count();

    $gradeC = NilaiPKL::where('predikat','C')->count();

    $gradeD = NilaiPKL::where('predikat','D')->count();

    $gradeE = NilaiPKL::where('predikat','E')->count();

    /*
    |--------------------------------------------------------------------------
    | Data
    |--------------------------------------------------------------------------
    */

    $nilaiPKL = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    $jurusans = Jurusan::orderBy(
        'nama_jurusan'
    )->get();

    $kelas = Kelas::orderBy(
        'nama_kelas'
    )->get();

    $industris = Industri::with('user')
        ->orderBy('id')
        ->get();

    return view(
        'nilai-pkl.nilai_admin',
        compact(
            'nilaiPKL',
            'jurusans',
            'kelas',
            'industris',
            'totalNilai',
            'gradeA',
            'gradeB',
            'gradeC',
            'gradeD',
            'gradeE'
        )
    );
}

public function adminDestroy(
    NilaiPKL $nilaiPkl
)
{
    $nilaiPkl->delete();

    return redirect()
        ->route('admin.nilai-pkl')
        ->with(
            'success',
            'Data nilai PKL berhasil dihapus.'
        );
}

    public function create()
    {
        $penempatans = PenempatanPKL::with([
            'siswa.user',
            'perusahaan',
            'penilaianGuru',
            'penilaianIndustri'
        ])->get();

        return view(
            'nilai-pkl.create',
            compact('penempatans')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'penempatan_pkl_id' => 'required'
        ]);

        self::generateNilai(
            $request->penempatan_pkl_id
        );

        return redirect()
            ->route('nilai-pkl.index')
            ->with(
                'success',
                'Nilai PKL berhasil dihitung'
            );
    }

    public function destroy(
        NilaiPKL $nilaiPkl
    )
    {
        $nilaiPkl->delete();

        return redirect()
            ->route('nilai-pkl.index')
            ->with(
                'success',
                'Data berhasil dihapus'
            );
    }

    public static function generateNilai(
        $penempatanId
    )
    {
        $nilaiIndustri = PenilaianIndustri::where(
            'penempatan_pkl_id',
            $penempatanId
        )->first();

        $nilaiGuru = PenilaianGuru::where(
            'penempatan_pkl_id',
            $penempatanId
        )->first();

        if (
            !$nilaiIndustri ||
            !$nilaiGuru
        ) {
            return;
        }

        $akhir = round(
            (
                ($nilaiIndustri->nilai_akhir * 0.60)
                +
                ($nilaiGuru->nilai_akhir * 0.40)
            ),
            2
        );

        $predikat = 'E';

        if ($akhir >= 90) {

            $predikat = 'A';

        } elseif ($akhir >= 80) {

            $predikat = 'B';

        } elseif ($akhir >= 70) {

            $predikat = 'C';

        } elseif ($akhir >= 60) {

            $predikat = 'D';

        }

        NilaiPKL::updateOrCreate(

            [
                'penempatan_pkl_id' =>
                    $penempatanId
            ],

            [
                'nilai_industri' =>
                    $nilaiIndustri->nilai_akhir,

                'nilai_guru' =>
                    $nilaiGuru->nilai_akhir,

                'nilai_akhir' =>
                    $akhir,

                'predikat' =>
                    $predikat
            ]
        );
    }
}