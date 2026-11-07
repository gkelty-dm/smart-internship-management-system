<?php

namespace App\Http\Controllers\Siswa\Profil;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class SiswaProfilController extends Controller
{
    /**
     * Menampilkan profil siswa.
     */
    public function index()
    {
        $user = User::findOrFail(
            Auth::id()
        );

        $siswa = $user->siswa;

        if (!$siswa) {
            abort(
                403,
                'Data siswa belum tersedia.'
            );
        }

        $siswa->load([
            'user',
            'jurusan',
            'kelas',
        ]);

        return view(
            'siswa.profil.index',
            compact(
                'user',
                'siswa'
            )
        );
    }


    /**
     * Menampilkan form edit profil.
     */
    public function edit()
    {
        $user = User::findOrFail(
            Auth::id()
        );

        $siswa = $user->siswa;

        if (!$siswa) {
            abort(
                403,
                'Data siswa belum tersedia.'
            );
        }

        $siswa->load([
            'user',
            'jurusan',
            'kelas',
        ]);

        return view(
            'siswa.profil.edit',
            compact(
                'user',
                'siswa'
            )
        );
    }


    /**
     * Update profil siswa.
     */
    public function update(
        Request $request
    ) {
        $user = User::findOrFail(
            Auth::id()
        );

        $siswa = $user->siswa;

        if (!$siswa) {
            abort(
                403,
                'Data siswa belum tersedia.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',

                Rule::unique(
                    'users',
                    'email'
                )->ignore(
                    $user->id
                ),
            ],

            'nisn' => [
                'required',
                'string',
                'max:50',
            ],

            /*
            | Database menggunakan:
            | L = Laki-laki
            | P = Perempuan
            */

            'jenis_kelamin' => [
                'required',
                'in:L,P',
            ],

            'tempat_lahir' => [
                'nullable',
                'string',
                'max:100',
            ],

            'tanggal_lahir' => [
                'nullable',
                'date',
            ],

            'no_hp' => [
                'nullable',
                'string',
                'max:30',
            ],

            'alamat' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'foto_profil' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | UPDATE USER
        |--------------------------------------------------------------------------
        */

        $user->name =
            $validated['name'];

        $user->email =
            $validated['email'];


        /*
        |--------------------------------------------------------------------------
        | FOTO PROFIL
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('foto_profil')) {

            /*
            | Hapus foto profil lama
            */

            if ($user->foto_profil) {

                $oldPath = parse_url(
                    $user->foto_profil,
                    PHP_URL_PATH
                );

                $oldPath = ltrim(
                    $oldPath ?? '',
                    '/'
                );


                /*
                | Hilangkan "storage/"
                | agar sesuai dengan disk public
                */

                if (
                    str_starts_with(
                        $oldPath,
                        'storage/'
                    )
                ) {

                    $oldPath = substr(
                        $oldPath,
                        strlen('storage/')
                    );
                }


                /*
                | Hapus file lama jika ada
                */

                if (
                    $oldPath &&
                    Storage::disk('public')->exists(
                        $oldPath
                    )
                ) {

                    Storage::disk('public')->delete(
                        $oldPath
                    );
                }
            }


            /*
            | Folder foto siswa
            */

            $folderSiswa =
                'foto-profil/siswa/' .
                $siswa->id;


            /*
            | Simpan foto baru
            */

            $foto = $request
                ->file('foto_profil')
                ->store(
                    $folderSiswa,
                    'public'
                );


            /*
            | Simpan URL foto
            */

            $user->foto_profil =
                '/storage/' . $foto;
        }


        /*
        | Simpan perubahan User
        */

        $user->save();


        /*
        |--------------------------------------------------------------------------
        | UPDATE DATA SISWA
        |--------------------------------------------------------------------------
        */

        $siswa->nisn =
            $validated['nisn'];

        /*
        | Database:
        | L = Laki-laki
        | P = Perempuan
        */

        $siswa->jenis_kelamin =
            $validated['jenis_kelamin'];

        $siswa->tempat_lahir =
            $validated['tempat_lahir']
            ?? null;

        $siswa->tanggal_lahir =
            $validated['tanggal_lahir']
            ?? null;

        $siswa->no_hp =
            $validated['no_hp']
            ?? null;

        $siswa->alamat =
            $validated['alamat']
            ?? null;


        /*
        | Simpan perubahan Siswa
        */

        $siswa->save();


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'siswa.profil.index'
            )
            ->with(
                'success',
                'Profil berhasil diperbarui.'
            );
    }


    /**
     * Menampilkan halaman ubah password.
     */
    public function password()
    {
        return view(
            'siswa.profil.password'
        );
    }


    /**
     * Update password siswa.
     */
    public function updatePassword(
        Request $request
    ) {

        /*
        |--------------------------------------------------------------------------
        | VALIDASI PASSWORD
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'password_lama' => [
                'required',
            ],

            'password_baru' => [
                'required',
                'min:6',
                'confirmed',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | USER
        |--------------------------------------------------------------------------
        */

        $user = User::findOrFail(
            Auth::id()
        );


        /*
        |--------------------------------------------------------------------------
        | CEK PASSWORD LAMA
        |--------------------------------------------------------------------------
        */

        if (
            !Hash::check(
                $request->password_lama,
                $user->password
            )
        ) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Password lama tidak sesuai.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | PASSWORD BARU
        |--------------------------------------------------------------------------
        */

        $user->password =
            Hash::make(
                $request->password_baru
            );

        $user->save();


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'siswa.profil.index'
            )
            ->with(
                'success',
                'Password berhasil diubah.'
            );
    }
}
