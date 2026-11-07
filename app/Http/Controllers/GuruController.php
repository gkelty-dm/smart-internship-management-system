<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Imports\GuruImport;
use Maatwebsite\Excel\Facades\Excel;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $gurus = Guru::with('user')->latest()->get();

    return view('guru.index', compact('gurus'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return view('guru.create');
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
        'nip' => 'required',
    ]);

    $user = User::create([
        'role' => 'guru',
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'is_active' => true,
    ]);

    Guru::create([
        'user_id' => $user->id,
        'nip' => $request->nip,
        'alamat' => $request->alamat,
        'no_hp' => $request->no_hp,
    ]);

    return redirect()
        ->route('guru.index')
        ->with('success', 'Guru berhasil ditambahkan');
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
    public function edit(Guru $guru)
{
    return view('guru.edit', compact('guru'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guru $guru)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $guru->user_id,
        'nip' => 'required',
    ]);

    $guru->user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    $guru->update([
        'nip' => $request->nip,
        'alamat' => $request->alamat,
        'no_hp' => $request->no_hp,
    ]);

    return redirect()
        ->route('guru.index')
        ->with('success', 'Guru berhasil diupdate');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guru $guru)
{
    $guru->user()->delete();

    return redirect()
        ->route('guru.index')
        ->with('success', 'Guru berhasil dihapus');
}

public function import(Request $request)
{
    $request->validate([

        'file' => 'required|mimes:xlsx,xls'

    ]);

    Excel::import(

        new GuruImport,

        $request->file('file')

    );

    return redirect()
        ->route('guru.index')
        ->with(
            'success',
            'Data guru berhasil diimport'
        );
}


}
