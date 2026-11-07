<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;
use App\Imports\PerusahaanImport;
use Maatwebsite\Excel\Facades\Excel;

class PerusahaanController extends Controller
{
    public function index()
    {
        $perusahaans = Perusahaan::latest()->get();

        return view('perusahaan.index', compact('perusahaans'));
    }

    public function create()
    {
        return view('perusahaan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required',
            'alamat' => 'required',
        ]);

        Perusahaan::create($request->all());

        return redirect()
            ->route('perusahaan.index')
            ->with('success', 'Perusahaan berhasil ditambahkan');
    }

    public function edit(Perusahaan $perusahaan)
    {
        return view('perusahaan.edit', compact('perusahaan'));
    }

    public function update(Request $request, Perusahaan $perusahaan)
    {
        $request->validate([
            'nama_perusahaan' => 'required',
            'alamat' => 'required',
        ]);

        $perusahaan->update($request->all());

        return redirect()
            ->route('perusahaan.index')
            ->with('success', 'Perusahaan berhasil diupdate');
    }

    public function destroy(Perusahaan $perusahaan)
    {
        $perusahaan->delete();

        return redirect()
            ->route('perusahaan.index')
            ->with('success', 'Perusahaan berhasil dihapus');
    }

    public function import(
    Request $request
)
{
    $request->validate([

        'file' =>
            'required|mimes:xlsx,xls'

    ]);

    Excel::import(

        new PerusahaanImport,

        $request->file('file')

    );

    return redirect()
        ->route(
            'perusahaan.index'
        )
        ->with(
            'success',
            'Data perusahaan berhasil diimport'
        );
}

}