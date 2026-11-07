<?php

namespace App\Http\Controllers\Admin\Nilai;

use App\Http\Controllers\Controller;
use App\Models\PenempatanPKL;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Menampilkan rekap nilai seluruh siswa PKL.
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Query utama
        |--------------------------------------------------------------------------
        */

        $query = PenempatanPKL::with([
            'siswa.user',
            'siswa.kelas',
            'siswa.jurusan',
            'guru.user',
            'industri.user',
            'perusahaan',
            'penilaianGuru',
            'penilaianIndustri',
        ]);


        /*
        |--------------------------------------------------------------------------
        | PENCARIAN
        |--------------------------------------------------------------------------
        |
        | Bisa mencari berdasarkan:
        | - Nama siswa
        | - NISN
        | - Nama guru
        | - Nama pembimbing industri
        | - Nama perusahaan
        |
        */

        if ($request->filled('search')) {

            $search = trim(
                $request->search
            );


            $query->where(function ($q) use ($search) {

                /*
                |------------------------------------------------------------------
                | Nama siswa
                |------------------------------------------------------------------
                */

                $q->whereHas(
                    'siswa.user',
                    function ($user) use ($search) {

                        $user->where(
                            'name',
                            'like',
                            "%{$search}%"
                        );
                    }
                );


                /*
                |------------------------------------------------------------------
                | NISN SISWA
                |------------------------------------------------------------------
                */

                $q->orWhereHas(
                    'siswa',
                    function ($siswa) use ($search) {

                        $siswa->where(
                            'nisn',
                            'like',
                            "%{$search}%"
                        );
                    }
                );


                /*
                |------------------------------------------------------------------
                | Nama Guru Pembimbing
                |------------------------------------------------------------------
                */

                $q->orWhereHas(
                    'guru.user',
                    function ($user) use ($search) {

                        $user->where(
                            'name',
                            'like',
                            "%{$search}%"
                        );
                    }
                );


                /*
                |------------------------------------------------------------------
                | Nama Pembimbing Industri
                |------------------------------------------------------------------
                */

                $q->orWhereHas(
                    'industri.user',
                    function ($user) use ($search) {

                        $user->where(
                            'name',
                            'like',
                            "%{$search}%"
                        );
                    }
                );


                /*
                |------------------------------------------------------------------
                | Nama Perusahaan
                |------------------------------------------------------------------
                */

                $q->orWhereHas(
                    'perusahaan',
                    function ($perusahaan) use ($search) {

                        $perusahaan->where(
                            'nama_perusahaan',
                            'like',
                            "%{$search}%"
                        );
                    }
                );
            });
        }


        /*
        |--------------------------------------------------------------------------
        | FILTER STATUS PENILAIAN
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $status = $request->status;


            /*
            |----------------------------------------------------------------------
            | Nilai Lengkap
            |----------------------------------------------------------------------
            */

            if ($status === 'lengkap') {

                $query
                    ->whereHas('penilaianGuru')
                    ->whereHas('penilaianIndustri');
            }


            /*
            |----------------------------------------------------------------------
            | Sebagian
            |----------------------------------------------------------------------
            */ elseif ($status === 'sebagian') {

                $query->where(function ($q) {

                    /*
                    | Guru sudah menilai,
                    | Industri belum.
                    */

                    $q->where(function ($sub) {

                        $sub
                            ->whereHas(
                                'penilaianGuru'
                            )
                            ->whereDoesntHave(
                                'penilaianIndustri'
                            );
                    });


                    /*
                    | Industri sudah menilai,
                    | Guru belum.
                    */

                    $q->orWhere(function ($sub) {

                        $sub
                            ->whereDoesntHave(
                                'penilaianGuru'
                            )
                            ->whereHas(
                                'penilaianIndustri'
                            );
                    });
                });
            }


            /*
            |----------------------------------------------------------------------
            | Belum Dinilai
            |----------------------------------------------------------------------
            */ elseif ($status === 'belum') {

                $query
                    ->whereDoesntHave(
                        'penilaianGuru'
                    )
                    ->whereDoesntHave(
                        'penilaianIndustri'
                    );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | FILTER PENILAI
        |--------------------------------------------------------------------------
        */

        if ($request->filled('penilai')) {

            $penilai = $request->penilai;


            /*
            |----------------------------------------------------------------------
            | Guru
            |----------------------------------------------------------------------
            */

            if ($penilai === 'guru') {

                $query->whereHas(
                    'penilaianGuru'
                );
            }


            /*
            |----------------------------------------------------------------------
            | Industri
            |----------------------------------------------------------------------
            */ elseif ($penilai === 'industri') {

                $query->whereHas(
                    'penilaianIndustri'
                );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | DATA PENEMPATAN
        |--------------------------------------------------------------------------
        */

        $penempatans = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | STATISTIK
        |--------------------------------------------------------------------------
        */

        $totalSiswa =
            PenempatanPKL::count();


        $sudahDinilaiGuru =
            PenempatanPKL::whereHas(
                'penilaianGuru'
            )->count();


        $sudahDinilaiIndustri =
            PenempatanPKL::whereHas(
                'penilaianIndustri'
            )->count();


        $sudahLengkap =
            PenempatanPKL::whereHas(
                'penilaianGuru'
            )
            ->whereHas(
                'penilaianIndustri'
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | KIRIM DATA KE VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.nilai.index',
            compact(
                'penempatans',
                'totalSiswa',
                'sudahDinilaiGuru',
                'sudahDinilaiIndustri',
                'sudahLengkap'
            )
        );
    }


    /**
     * Menampilkan detail nilai siswa.
     */
    public function show(
        PenempatanPKL $penempatan
    ) {
        $penempatan->load([
            'siswa.user',
            'siswa.kelas',
            'siswa.jurusan',
            'guru.user',
            'industri.user',
            'perusahaan',
            'penilaianGuru',
            'penilaianIndustri',
        ]);


        return view(
            'admin.nilai.show',
            compact(
                'penempatan'
            )
        );
    }
}
