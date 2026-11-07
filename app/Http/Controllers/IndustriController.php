<?php

namespace App\Http\Controllers;

use App\Models\Industri;
use App\Models\User;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Imports\IndustriImport;
use Maatwebsite\Excel\Facades\Excel;

class IndustriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $industris = Industri::with('user')->latest()->get();

        return view('industri.index', compact('industris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $perusahaans = Perusahaan::all();

        return view('industri.create', compact('perusahaans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'perusahaan_id' => 'required|exists:perusahaans,id',
        ]);

        $user = User::create([
            'role' => 'industri',
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_active' => true,
        ]);

        Industri::create([
            'user_id' => $user->id,
            'perusahaan_id' => $request->perusahaan_id,
            'jabatan' => $request->jabatan,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()
            ->route('industri.index')
            ->with('success', 'Data industri berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Industri $industri)
    {
        $perusahaans = Perusahaan::all();

        return view('industri.edit', compact(
            'industri',
            'perusahaans'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Industri $industri)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $industri->user_id,
            'perusahaan_id' => 'required',
        ]);

        $industri->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $industri->update([
            'perusahaan_id' => $request->perusahaan_id,
            'jabatan' => $request->jabatan,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()
            ->route('industri.index')
            ->with('success', 'Data pembimbing industri berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Industri $industri)
    {
        $industri->user()->delete();

        return redirect()
            ->route('industri.index')
            ->with('success', 'Data industri berhasil dihapus');
    }

    public function import(Request $request)
    {
        $request->validate([

            'file' => 'required|mimes:xlsx,xls'

        ]);

        Excel::import(

            new IndustriImport,

            $request->file('file')

        );

        return redirect()
            ->route('industri.index')
            ->with(
                'success',
                'Data pembimbing industri berhasil diimport'
            );
    }
}
