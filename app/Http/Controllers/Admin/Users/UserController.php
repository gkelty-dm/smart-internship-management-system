<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Menampilkan daftar user.
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where(
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
        }

        $users = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalUsers = User::count();

        $totalAdmins = User::where(
            'role',
            'admin'
        )->count();

        $totalGurus = User::where(
            'role',
            'guru'
        )->count();

        $totalSiswas = User::where(
            'role',
            'siswa'
        )->count();

        $totalIndustris = User::where(
            'role',
            'industri'
        )->count();

        return view(
            'admin.users.index',
            compact(
                'users',
                'totalUsers',
                'totalAdmins',
                'totalGurus',
                'totalSiswas',
                'totalIndustris'
            )
        );
    }


    /**
     * Menampilkan form tambah user.
     */
    public function create()
    {
        return view(
            'admin.users.create'
        );
    }


    /**
     * Menyimpan user baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'role' => [
                'required',
                'in:admin,guru,siswa,industri',
            ],

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
                'min:8',
                'confirmed',
            ],

            'is_active' => [
                'required',
                'boolean',
            ],
        ]);


        User::create([
            'role' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make(
                $request->password
            ),
            'is_active' => $request->is_active,
        ]);


        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'User berhasil ditambahkan.'
            );
    }


    /**
     * Menampilkan detail user.
     */
    public function show(User $user)
    {
        return view(
            'admin.users.show',
            compact('user')
        );
    }


    /**
     * Menampilkan form edit user.
     */
    public function edit(User $user)
    {
        return view(
            'admin.users.edit',
            compact('user')
        );
    }


    /**
     * Memperbarui data user.
     */
    public function update(
        Request $request,
        User $user
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
                'unique:users,email,' . $user->id,
            ],

            'is_active' => [
                'required',
                'boolean',
            ],
        ]);


        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'is_active' => $request->is_active,
        ]);


        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'User berhasil diperbarui.'
            );
    }


    /**
     * Menghapus user beserta data yang berkaitan.
     */
    public function destroy(User $user)
    {
        /*
        |--------------------------------------------------------------------------
        | Jangan hapus akun yang sedang login
        |--------------------------------------------------------------------------
        */

        if (
            Auth::check() &&
            Auth::id() == $user->id
        ) {
            return back()->with(
                'error',
                'Anda tidak dapat menghapus akun sendiri.'
            );
        }


        DB::transaction(function () use ($user) {

            /*
            |--------------------------------------------------------------------------
            | SISWA
            |--------------------------------------------------------------------------
            */

            if ($user->role === 'siswa') {

                $siswa = $user->siswa;

                if ($siswa) {

                    /*
                    |--------------------------------------------------------------------------
                    | Logbook dan Foto Logbook
                    |--------------------------------------------------------------------------
                    */

                    $logbooks = $siswa
                        ->logbooks()
                        ->get();

                    foreach ($logbooks as $logbook) {

                        $logbook
                            ->fotos()
                            ->delete();

                        $logbook->delete();
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Absensi
                    |--------------------------------------------------------------------------
                    */

                    $siswa
                        ->absensis()
                        ->delete();


                    /*
                    |--------------------------------------------------------------------------
                    | Face Profile dan Face Image
                    |--------------------------------------------------------------------------
                    */

                    $faceProfile = $siswa->faceProfile;

                    if ($faceProfile) {

                        $faceProfile
                            ->images()
                            ->delete();

                        $faceProfile->delete();
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Penempatan PKL
                    |--------------------------------------------------------------------------
                    */

                    $penempatan = $siswa->penempatanPKL;

                    if ($penempatan) {

                        $penempatan
                            ->penilaianGuru()
                            ->delete();

                        $penempatan
                            ->nilaiPKL()
                            ->delete();

                        $penempatan
                            ->penilaianIndustri()
                            ->delete();

                        $penempatan->delete();
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Data Siswa
                    |--------------------------------------------------------------------------
                    */

                    $siswa->delete();
                }
            }


            /*
            |--------------------------------------------------------------------------
            | GURU
            |--------------------------------------------------------------------------
            */

            if ($user->role === 'guru') {

                $guru = $user->guru;

                if ($guru) {

                    $penempatans = $guru
                        ->penempatanPKL()
                        ->get();

                    foreach ($penempatans as $penempatan) {

                        $penempatan
                            ->penilaianGuru()
                            ->delete();

                        $penempatan
                            ->nilaiPKL()
                            ->delete();

                        $penempatan
                            ->penilaianIndustri()
                            ->delete();

                        $penempatan->delete();
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Data Guru
                    |--------------------------------------------------------------------------
                    */

                    $guru->delete();
                }
            }


            /*
            |--------------------------------------------------------------------------
            | INDUSTRI PEMBIMBING
            |--------------------------------------------------------------------------
            */

            if ($user->role === 'industri') {

                $industri = $user->industri;

                if ($industri) {

                    $penempatans = $industri
                        ->penempatanPKL()
                        ->get();

                    foreach ($penempatans as $penempatan) {

                        $penempatan
                            ->penilaianGuru()
                            ->delete();

                        $penempatan
                            ->nilaiPKL()
                            ->delete();

                        $penempatan
                            ->penilaianIndustri()
                            ->delete();

                        $penempatan->delete();
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Data Industri
                    |--------------------------------------------------------------------------
                    */

                    $industri->delete();
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Hapus Akun User
            |--------------------------------------------------------------------------
            */

            $user->delete();
        });


        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'User dan seluruh data yang berkaitan berhasil dihapus.'
            );
    }


    /**
     * Reset password user.
     */
    public function resetPassword(User $user)
    {
        $user->update([
            'password' => Hash::make(
                '12345678'
            ),
        ]);


        return back()->with(
            'success',
            'Password berhasil direset menjadi 12345678.'
        );
    }


    /**
     * Menonaktifkan akun user.
     */
    public function nonaktifkan(User $user)
    {
        if (
            Auth::check() &&
            Auth::id() == $user->id
        ) {
            return back()->with(
                'error',
                'Anda tidak dapat menonaktifkan akun sendiri.'
            );
        }


        $user->update([
            'is_active' => false,
        ]);


        return back()->with(
            'success',
            'User berhasil dinonaktifkan.'
        );
    }


    /**
     * Mengaktifkan akun user.
     */
    public function aktifkan(User $user)
    {
        $user->update([
            'is_active' => true,
        ]);


        return back()->with(
            'success',
            'User berhasil diaktifkan.'
        );
    }
}
