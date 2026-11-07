<?php

namespace App\Http\Controllers\Admin\GuruPembimbing;

use App\Http\Controllers\Controller;
use App\Imports\GuruImport;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class GuruPembimbingController extends Controller
{
    /**
     * Menampilkan daftar guru pembimbing.
     */
    public function index()
    {
        $gurus = Guru::with('user')
            ->latest()
            ->paginate(10);

        return view(
            'admin.guru-pembimbing.index',
            compact('gurus')
        );
    }


    /**
     * Menampilkan form tambah guru pembimbing.
     */
    public function create()
    {
        return view(
            'admin.guru-pembimbing.create'
        );
    }


    /**
     * Menyimpan guru pembimbing baru.
     */
    public function store(Request $request)
    {
        $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed',
            ],

            'nip' => [
                'required',
                'string',
                'max:50',
                'unique:gurus,nip',
            ],

            'alamat' => [
                'nullable',
                'string',
            ],

            'no_hp' => [
                'nullable',
                'string',
                'max:20',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Membuat akun User
        |--------------------------------------------------------------------------
        */

        $user = User::create([

            'role' => 'guru',

            'name' => $request->name,

            'email' => $request->email,

            'password' => Hash::make(
                $request->password
            ),

            'is_active' => true,

        ]);


        /*
        |--------------------------------------------------------------------------
        | Membuat data Guru
        |--------------------------------------------------------------------------
        */

        Guru::create([

            'user_id' => $user->id,

            'nip' => $request->nip,

            'alamat' => $request->alamat,

            'no_hp' => $request->no_hp,

        ]);


        return redirect()
            ->route('admin.guru-pembimbing.index')
            ->with(
                'success',
                'Guru pembimbing berhasil ditambahkan.'
            );
    }


    /**
     * Menampilkan detail guru pembimbing.
     */
    public function show(Guru $guru_pembimbing)
    {
        $guru_pembimbing->load([

            'user',

            'penempatanPKL.siswa.user',

            'penempatanPKL.siswa.jurusan',

            'penempatanPKL.siswa.kelas',

            'penempatanPKL.industri.user',

            'penempatanPKL.perusahaan',

        ]);


        return view(
            'admin.guru-pembimbing.show',
            [
                'guru' => $guru_pembimbing
            ]
        );
    }


    /**
     * Menampilkan form edit guru pembimbing.
     */
    public function edit(Guru $guru_pembimbing)
    {
        $guru_pembimbing->load('user');


        return view(
            'admin.guru-pembimbing.edit',
            [
                'guru' => $guru_pembimbing
            ]
        );
    }


    /**
     * Memperbarui data guru pembimbing.
     */
    public function update(
        Request $request,
        Guru $guru_pembimbing
    ) {
        $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $guru_pembimbing->user_id,
            ],

            'nip' => [
                'required',
                'string',
                'max:50',
                'unique:gurus,nip,' . $guru_pembimbing->id,
            ],

            'alamat' => [
                'nullable',
                'string',
            ],

            'no_hp' => [
                'nullable',
                'string',
                'max:20',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Update akun User
        |--------------------------------------------------------------------------
        */

        if ($guru_pembimbing->user) {

            $guru_pembimbing->user->update([

                'name' => $request->name,

                'email' => $request->email,

            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Update data Guru
        |--------------------------------------------------------------------------
        */

        $guru_pembimbing->update([

            'nip' => $request->nip,

            'alamat' => $request->alamat,

            'no_hp' => $request->no_hp,

        ]);


        return redirect()
            ->route('admin.guru-pembimbing.index')
            ->with(
                'success',
                'Data guru pembimbing berhasil diperbarui.'
            );
    }


    /**
     * Menghapus guru pembimbing beserta akun User.
     */
    public function destroy(Guru $guru_pembimbing)
    {
        $user = $guru_pembimbing->user;


        /*
        |--------------------------------------------------------------------------
        | Hapus data Guru
        |--------------------------------------------------------------------------
        */

        $guru_pembimbing->delete();


        /*
        |--------------------------------------------------------------------------
        | Hapus akun User
        |--------------------------------------------------------------------------
        */

        if ($user) {

            $user->delete();
        }


        return redirect()
            ->route('admin.guru-pembimbing.index')
            ->with(
                'success',
                'Data guru pembimbing berhasil dihapus.'
            );
    }


    /**
     * Import data guru pembimbing dari Excel.
     */
    public function import(Request $request)
    {
        $request->validate([

            'file' => [
                'required',
                'mimes:xlsx,xls',
            ],

        ]);


        Excel::import(
            new GuruImport,
            $request->file('file')
        );


        return redirect()
            ->route('admin.guru-pembimbing.index')
            ->with(
                'success',
                'Data guru pembimbing berhasil diimport.'
            );
    }
}
