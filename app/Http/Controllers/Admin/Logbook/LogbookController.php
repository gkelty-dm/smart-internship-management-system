<?php

namespace App\Http\Controllers\Admin\Logbook;

use App\Http\Controllers\Controller;
use App\Models\Logbook;
use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Http\Request;

class LogbookController extends Controller
{
    public function index(Request $request)
    {
        $query = Logbook::with([
            'siswa.user',
            'siswa.jurusan',
            'siswa.kelas',
            'fotos',
        ]);

        /*
        |--------------------------------------------------------------------------
        | PENCARIAN
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
                'status_validasi',
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
        | DATA
        |--------------------------------------------------------------------------
        */

        $logbooks = $query
            ->latest('tanggal')
            ->latest('id')
            ->paginate(10)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | STATISTIK
        |--------------------------------------------------------------------------
        */

        $totalLogbook = Logbook::count();

        $pending = Logbook::where(
            'status_validasi',
            'pending'
        )->count();

        $disetujui = Logbook::where(
            'status_validasi',
            'disetujui'
        )->count();

        $ditolak = Logbook::where(
            'status_validasi',
            'ditolak'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | FILTER
        |--------------------------------------------------------------------------
        */

        $jurusans = Jurusan::orderBy(
            'nama_jurusan'
        )->get();

        $kelas = Kelas::orderBy(
            'nama_kelas'
        )->get();


        return view(
            'admin.logbook.index',
            compact(
                'logbooks',
                'jurusans',
                'kelas',
                'totalLogbook',
                'pending',
                'disetujui',
                'ditolak'
            )
        );
    }


    public function show(Logbook $logbook)
    {
        $logbook->load([
            'siswa.user',
            'siswa.jurusan',
            'siswa.kelas',
            'fotos',
        ]);

        return view(
            'admin.logbook.show',
            compact('logbook')
        );
    }


    public function validasi(
        Request $request,
        Logbook $logbook
    ) {
        $request->validate([
            'status_validasi' => [
                'required',
                'in:pending,disetujui,ditolak',
            ],

            'catatan_guru' => [
                'nullable',
                'string',
            ],
        ]);

        $logbook->update([
            'status_validasi' => $request->status_validasi,
            'catatan_guru' => $request->catatan_guru,
        ]);

        return redirect()
            ->route('admin.logbook')
            ->with(
                'success',
                'Status logbook berhasil diperbarui.'
            );
    }
}
