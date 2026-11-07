<?php

namespace App\Http\Controllers\Admin\Absensi;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $query = Absensi::with([
            'siswa.user',
            'siswa.kelas',
            'siswa.jurusan',
        ]);

        /*
        |--------------------------------------------------------------------------
        | PENCARIAN SISWA
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->whereHas(
                'siswa.user',
                function ($q) use ($search) {

                    $q->where(
                        'name',
                        'like',
                        '%' . $search . '%'
                    )
                        ->orWhere(
                            'email',
                            'like',
                            '%' . $search . '%'
                        );
                }
            );
        }


        /*
        |--------------------------------------------------------------------------
        | FILTER JURUSAN
        |--------------------------------------------------------------------------
        */

        if ($request->filled('jurusan')) {

            $query->whereHas(
                'siswa',
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
        | FILTER KELAS
        |--------------------------------------------------------------------------
        */

        if ($request->filled('kelas')) {

            $query->whereHas(
                'siswa',
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
        | FILTER STATUS
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }


        /*
        |--------------------------------------------------------------------------
        | FILTER TANGGAL
        |--------------------------------------------------------------------------
        */

        if ($request->filled('tanggal')) {

            $query->whereDate(
                'tanggal',
                $request->tanggal
            );
        }


        /*
        |--------------------------------------------------------------------------
        | DATA ABSENSI
        |--------------------------------------------------------------------------
        */

        $absensis = $query
            ->latest('tanggal')
            ->latest('id')
            ->paginate(10)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | STATISTIK
        |--------------------------------------------------------------------------
        */

        $totalAbsensi = Absensi::count();

        $hadir = Absensi::where(
            'status',
            'hadir'
        )->count();

        $izin = Absensi::where(
            'status',
            'izin'
        )->count();

        $sakit = Absensi::where(
            'status',
            'sakit'
        )->count();

        $alpha = Absensi::where(
            'status',
            'alpha'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | DATA FILTER
        |--------------------------------------------------------------------------
        */

        $jurusans = Jurusan::orderBy(
            'nama_jurusan'
        )->get();

        $kelas = Kelas::orderBy(
            'nama_kelas'
        )->get();


        return view(
            'admin.absensi.index',
            compact(
                'absensis',
                'jurusans',
                'kelas',
                'totalAbsensi',
                'hadir',
                'izin',
                'sakit',
                'alpha'
            )
        );
    }


    public function show(Absensi $absensi)
    {
        $absensi->load([
            'siswa.user',
            'siswa.kelas',
            'siswa.jurusan',
        ]);

        return view(
            'admin.absensi.show',
            compact('absensi')
        );
    }
}
