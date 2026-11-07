<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Imports\KelasImport;
use Maatwebsite\Excel\Facades\Excel;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with('jurusan')->latest()->get();

        return view('kelas.index', compact('kelas'));
    }

    public function create()
{
    $jurusans = Jurusan::orderBy('nama_jurusan')->get();

    return view('kelas.create', compact('jurusans'));
}

public function store(Request $request)
{
    $request->validate([
        'jurusan_id' => 'required',
        'nama_kelas' => 'required|max:50'
    ]);

    Kelas::create([
        'jurusan_id' => $request->jurusan_id,
        'nama_kelas' => $request->nama_kelas
    ]);

    return redirect()
        ->route('kelas.index')
        ->with('success', 'Kelas berhasil ditambahkan');
}

public function import(Request $request)
{
    $request->validate([

        'file' => 'required|mimes:xlsx,xls'

    ]);

    Excel::import(

        new KelasImport,

        $request->file('file')

    );

    return redirect()
        ->route('kelas.index')
        ->with(
            'success',
            'Data kelas berhasil diimport'
        );
}

public function edit(Kelas $kela)
{
    $jurusans = Jurusan::all();

    return view('kelas.edit', [
        'kela' => $kela,
        'jurusans' => $jurusans
    ]);
}

public function update(Request $request, Kelas $kela)
{
    $request->validate([
        'jurusan_id' => 'required',
        'nama_kelas' => 'required'
    ]);

    $kela->update([
        'jurusan_id' => $request->jurusan_id,
        'nama_kelas' => $request->nama_kelas
    ]);

    return redirect()
        ->route('kelas.index')
        ->with('success', 'Kelas berhasil diupdate');
}

public function destroy(Kelas $kela)
{
    $kela->delete();

    return redirect()
        ->route('kelas.index')
        ->with('success', 'Kelas berhasil dihapus');
}

}