<?php

namespace App\Http\Controllers\Admin\Kelas;

use App\Http\Controllers\Controller;
use App\Imports\KelasImport;
use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KelasController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = Kelas::with('jurusan');


        /*
        |--------------------------------------------------------------------------
        | PENCARIAN
        |--------------------------------------------------------------------------
        |
        | Bisa mencari:
        | - Nama kelas
        | - Nama jurusan
        |
        */

        if ($request->filled('search')) {

            $search = trim($request->search);


            $query->where(function ($q) use ($search) {

                /*
                |------------------------------------------------------------------
                | Cari nama kelas
                |------------------------------------------------------------------
                */

                $q->where(
                    'nama_kelas',
                    'like',
                    "%{$search}%"
                );


                /*
                |------------------------------------------------------------------
                | Cari nama jurusan
                |------------------------------------------------------------------
                */

                $q->orWhereHas(
                    'jurusan',
                    function ($jurusan) use ($search) {

                        $jurusan->where(
                            'nama_jurusan',
                            'like',
                            "%{$search}%"
                        );
                    }
                );
            });
        }


        /*
        |--------------------------------------------------------------------------
        | DATA KELAS
        |--------------------------------------------------------------------------
        */

        $kelas = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | TOTAL SELURUH KELAS
        |--------------------------------------------------------------------------
        */

        $totalKelas = Kelas::count();


        return view(
            'admin.kelas.index',
            compact(
                'kelas',
                'totalKelas'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $jurusans = Jurusan::orderBy(
            'nama_jurusan'
        )->get();


        return view(
            'admin.kelas.create',
            compact('jurusans')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([

            'jurusan_id' => [
                'required',
                'exists:jurusans,id'
            ],

            'nama_kelas' => [
                'required',
                'string',
                'max:50'
            ],

        ]);


        Kelas::create([

            'jurusan_id' => $request->jurusan_id,

            'nama_kelas' => $request->nama_kelas,

        ]);


        return redirect()
            ->route('admin.kelas.index')
            ->with(
                'success',
                'Kelas berhasil ditambahkan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(Kelas $kela)
    {
        $kela->load('jurusan');


        return view(
            'admin.kelas.show',
            compact('kela')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(Kelas $kela)
    {
        $jurusans = Jurusan::orderBy(
            'nama_jurusan'
        )->get();


        return view(
            'admin.kelas.edit',
            [
                'kela' => $kela,
                'jurusans' => $jurusans,
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Kelas $kela
    ) {
        $request->validate([

            'jurusan_id' => [
                'required',
                'exists:jurusans,id'
            ],

            'nama_kelas' => [
                'required',
                'string',
                'max:50'
            ],

        ]);


        $kela->update([

            'jurusan_id' => $request->jurusan_id,

            'nama_kelas' => $request->nama_kelas,

        ]);


        return redirect()
            ->route(
                'admin.kelas.index'
            )
            ->with(
                'success',
                'Kelas berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy(Kelas $kela)
    {
        $kela->delete();


        return redirect()
            ->route(
                'admin.kelas.index'
            )
            ->with(
                'success',
                'Kelas berhasil dihapus.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | IMPORT EXCEL
    |--------------------------------------------------------------------------
    */

    public function import(Request $request)
    {
        $request->validate([

            'file' => [
                'required',
                'mimes:xlsx,xls'
            ],

        ]);


        Excel::import(
            new KelasImport,
            $request->file('file')
        );


        return redirect()
            ->route(
                'admin.kelas.index'
            )
            ->with(
                'success',
                'Data kelas berhasil diimport.'
            );
    }
}
