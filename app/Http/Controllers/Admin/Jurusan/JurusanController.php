<?php

namespace App\Http\Controllers\Admin\Jurusan;

use App\Http\Controllers\Controller;
use App\Imports\JurusanImport;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class JurusanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = Jurusan::query();

        if ($request->filled('search')) {

            $search = trim($request->search);

            $query->where(
                'nama_jurusan',
                'like',
                "%{$search}%"
            );
        }

        $jurusans = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalJurusan = Jurusan::count();

        return view(
            'admin.jurusan.index',
            compact(
                'jurusans',
                'totalJurusan'
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
        return view(
            'admin.jurusan.create'
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

            'nama_jurusan' => [
                'required',
                'string',
                'max:100'
            ],

        ]);


        Jurusan::create([

            'nama_jurusan' => $request->nama_jurusan,

        ]);


        return redirect()
            ->route('admin.jurusan.index')
            ->with(
                'success',
                'Jurusan berhasil ditambahkan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(Jurusan $jurusan)
    {
        return view(
            'admin.jurusan.show',
            compact('jurusan')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(Jurusan $jurusan)
    {
        return view(
            'admin.jurusan.edit',
            compact('jurusan')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Jurusan $jurusan
    ) {
        $request->validate([

            'nama_jurusan' => [
                'required',
                'string',
                'max:100'
            ],

        ]);


        $jurusan->update([

            'nama_jurusan' => $request->nama_jurusan,

        ]);


        return redirect()
            ->route('admin.jurusan.index')
            ->with(
                'success',
                'Jurusan berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();


        return redirect()
            ->route('admin.jurusan.index')
            ->with(
                'success',
                'Jurusan berhasil dihapus.'
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
            new JurusanImport,
            $request->file('file')
        );


        return redirect()
            ->route('admin.jurusan.index')
            ->with(
                'success',
                'Data jurusan berhasil diimport.'
            );
    }
}
