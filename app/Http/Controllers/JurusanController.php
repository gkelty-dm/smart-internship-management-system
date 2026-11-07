<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use App\Imports\JurusanImport;
use Maatwebsite\Excel\Facades\Excel;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::latest()->get();

        return view('jurusan.index', compact('jurusans'));
    }

    public function create()
{
    return view('jurusan.create');
}

public function store(Request $request)
{
    $request->validate([
        'nama_jurusan' => 'required|max:100'
    ]);

    Jurusan::create([
        'nama_jurusan' => $request->nama_jurusan
    ]);

    return redirect()
        ->route('jurusan.index')
        ->with('success', 'Jurusan berhasil ditambahkan');
}

public function edit(Jurusan $jurusan)
{
    return view('jurusan.edit', compact('jurusan'));
}

public function update(Request $request, Jurusan $jurusan)
{
    $request->validate([
        'nama_jurusan' => 'required|max:100'
    ]);

    $jurusan->update([
        'nama_jurusan' => $request->nama_jurusan
    ]);

    return redirect()
        ->route('jurusan.index')
        ->with('success', 'Jurusan berhasil diupdate');
}

public function destroy(Jurusan $jurusan)
{
    $jurusan->delete();

    return redirect()
        ->route('jurusan.index')
        ->with('success', 'Jurusan berhasil dihapus');
}

public function import(Request $request)
{
    $request->validate([

        'file' => 'required|mimes:xlsx,xls'

    ]);

    Excel::import(

        new JurusanImport,

        $request->file('file')

    );

    return redirect()
        ->route('jurusan.index')
        ->with(
            'success',
            'Data jurusan berhasil diimport'
        );
}

}