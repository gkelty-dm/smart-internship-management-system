<?php

namespace App\Http\Controllers\Admin\IndustriPembimbing;

use App\Http\Controllers\Controller;
use App\Models\Industri;
use App\Models\Perusahaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class IndustriPembimbingController extends Controller
{
    /**
     * Menampilkan daftar pembimbing industri.
     */
    public function index(Request $request)
    {
        $query = Industri::with([
            'user',
            'perusahaan',
        ]);

        /*
        |--------------------------------------------------------------------------
        | PENCARIAN
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->whereHas('user', function ($user) use ($search) {

                    $user->where(
                        'name',
                        'like',
                        "%{$search}%"
                    )
                        ->orWhere(
                            'email',
                            'like',
                            "%{$search}%"
                        );
                });

                $q->orWhere(
                    'jabatan',
                    'like',
                    "%{$search}%"
                );

                $q->orWhere(
                    'no_hp',
                    'like',
                    "%{$search}%"
                );

                $q->orWhereHas(
                    'perusahaan',
                    function ($perusahaan) use ($search) {

                        $perusahaan->where(
                            'nama_perusahaan',
                            'like',
                            "%{$search}%"
                        );
                    }
                );
            });
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER INDUSTRI
        |--------------------------------------------------------------------------
        */

        if ($request->filled('perusahaan_id')) {

            $query->where(
                'perusahaan_id',
                $request->perusahaan_id
            );
        }

        /*
        |--------------------------------------------------------------------------
        | DATA PEMBIMBING
        |--------------------------------------------------------------------------
        */

        $industris = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | DATA INDUSTRI
        |--------------------------------------------------------------------------
        */

        $perusahaans = Perusahaan::orderBy(
            'nama_perusahaan'
        )->get();

        /*
        |--------------------------------------------------------------------------
        | STATISTIK
        |--------------------------------------------------------------------------
        */

        $totalIndustri = Industri::count();

        $totalPerusahaan = Perusahaan::count();

        return view(
            'admin.industri-pembimbing.index',
            compact(
                'industris',
                'perusahaans',
                'totalIndustri',
                'totalPerusahaan'
            )
        );
    }


    /**
     * Menampilkan form tambah pembimbing industri.
     */
    public function create()
    {
        $perusahaans = Perusahaan::orderBy(
            'nama_perusahaan'
        )->get();

        return view(
            'admin.industri-pembimbing.create',
            compact('perusahaans')
        );
    }


    /**
     * Menyimpan pembimbing industri baru.
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
                'confirmed',
                'min:6',
            ],

            'perusahaan_id' => [
                'required',
                'exists:perusahaans,id',
            ],

            'jabatan' => [
                'required',
                'string',
                'max:255',
            ],

            'no_hp' => [
                'nullable',
                'string',
                'max:30',
            ],

        ]);

        /*
        |--------------------------------------------------------------------------
        | MEMBUAT AKUN USER
        |--------------------------------------------------------------------------
        */

        $user = User::create([

            'name' => $request->name,

            'email' => $request->email,

            'password' => Hash::make(
                $request->password
            ),

        ]);

        /*
        |--------------------------------------------------------------------------
        | MEMBUAT DATA PEMBIMBING INDUSTRI
        |--------------------------------------------------------------------------
        */

        Industri::create([

            'user_id' => $user->id,

            'perusahaan_id' => $request->perusahaan_id,

            'jabatan' => $request->jabatan,

            'no_hp' => $request->no_hp,

        ]);

        return redirect()
            ->route('admin.industri-pembimbing.index')
            ->with(
                'success',
                'Pembimbing industri berhasil ditambahkan.'
            );
    }


    /**
     * Menampilkan detail pembimbing industri.
     */
    public function show(Industri $industri)
    {
        $industri->load([
            'user',
            'perusahaan',
        ]);

        $penempatans = $industri
            ->penempatanPKL()
            ->with([
                'siswa.user',
                'siswa.kelas',
                'siswa.jurusan',
                'guru.user',
            ])
            ->latest()
            ->get();

        return view(
            'admin.industri-pembimbing.show',
            compact(
                'industri',
                'penempatans'
            )
        );
    }


    /**
     * Menampilkan form edit pembimbing industri.
     */
    public function edit(Industri $industri)
    {
        $industri->load([
            'user',
            'perusahaan',
        ]);

        $perusahaans = Perusahaan::orderBy(
            'nama_perusahaan'
        )->get();

        return view(
            'admin.industri-pembimbing.edit',
            compact(
                'industri',
                'perusahaans'
            )
        );
    }


    /**
     * Memperbarui data pembimbing industri.
     */
    public function update(
        Request $request,
        Industri $industri
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
                Rule::unique('users', 'email')
                    ->ignore($industri->user_id),
            ],

            'perusahaan_id' => [
                'required',
                'exists:perusahaans,id',
            ],

            'jabatan' => [
                'required',
                'string',
                'max:255',
            ],

            'no_hp' => [
                'nullable',
                'string',
                'max:30',
            ],

        ]);

        /*
        |--------------------------------------------------------------------------
        | UPDATE USER
        |--------------------------------------------------------------------------
        */

        $industri->user->update([

            'name' => $request->name,

            'email' => $request->email,

        ]);

        /*
        |--------------------------------------------------------------------------
        | UPDATE DATA INDUSTRI
        |--------------------------------------------------------------------------
        */

        $industri->update([

            'perusahaan_id' => $request->perusahaan_id,

            'jabatan' => $request->jabatan,

            'no_hp' => $request->no_hp,

        ]);

        /*
        |--------------------------------------------------------------------------
        | UPDATE PASSWORD JIKA DIISI
        |--------------------------------------------------------------------------
        */

        if ($request->filled('password')) {

            $request->validate([

                'password' => [
                    'confirmed',
                    'min:6',
                ],

            ]);

            $industri->user->update([

                'password' => Hash::make(
                    $request->password
                ),

            ]);
        }

        return redirect()
            ->route('admin.industri-pembimbing.index')
            ->with(
                'success',
                'Data pembimbing industri berhasil diperbarui.'
            );
    }


    /**
     * Menghapus pembimbing industri.
     */
    public function destroy(Industri $industri)
    {
        /*
        |--------------------------------------------------------------------------
        | CEK PENEMPATAN PKL
        |--------------------------------------------------------------------------
        */

        if ($industri->penempatanPKL()->exists()) {

            return redirect()
                ->route('admin.industri-pembimbing.index')
                ->with(
                    'error',
                    'Pembimbing industri tidak dapat dihapus karena masih digunakan pada penempatan PKL.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | SIMPAN USER
        |--------------------------------------------------------------------------
        */

        $user = $industri->user;

        /*
        |--------------------------------------------------------------------------
        | HAPUS DATA INDUSTRI
        |--------------------------------------------------------------------------
        */

        $industri->delete();

        /*
        |--------------------------------------------------------------------------
        | HAPUS USER
        |--------------------------------------------------------------------------
        */

        if ($user) {
            $user->delete();
        }

        return redirect()
            ->route('admin.industri-pembimbing.index')
            ->with(
                'success',
                'Pembimbing industri berhasil dihapus.'
            );
    }
}
