<?php

namespace App\Http\Controllers\Industri\Profil;

use App\Http\Controllers\Controller;
use App\Models\Industri;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class IndustriProfilController extends Controller
{
    /**
     * Menampilkan profil industri
     */
    public function index()
    {
        $user = User::findOrFail(
            Auth::id()
        );

        $industri = Industri::with('user')
            ->where(
                'user_id',
                $user->id
            )
            ->firstOrFail();

        return view(
            'industri.profil.index',
            compact(
                'user',
                'industri'
            )
        );
    }


    /**
     * Menampilkan halaman edit profil
     */
    public function edit()
    {
        $user = User::findOrFail(
            Auth::id()
        );

        $industri = Industri::with('user')
            ->where(
                'user_id',
                $user->id
            )
            ->firstOrFail();

        return view(
            'industri.profil.edit',
            compact(
                'user',
                'industri'
            )
        );
    }


    /**
     * Update profil industri
     */
    public function update(Request $request)
    {
        $user = User::findOrFail(
            Auth::id()
        );

        $industri = Industri::where(
            'user_id',
            $user->id
        )->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Validasi
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'email',
                'max:255',

                Rule::unique(
                    'users',
                    'email'
                )->ignore($user->id)
            ],

            'nama_perusahaan' => [
                'required',
                'string',
                'max:255'
            ],

            'no_hp' => [
                'nullable',
                'string',
                'max:30'
            ],

            'alamat' => [
                'nullable',
                'string',
                'max:1000'
            ],

            'foto_profil' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Update User
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
            |--------------------------------------------------------------------------
            | Hapus foto lama
            |--------------------------------------------------------------------------
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
                | Jika tersimpan dalam bentuk:
                | /storage/foto-profil/...
                |
                | ubah menjadi:
                | foto-profil/...
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
                | Hapus foto lama
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
            |--------------------------------------------------------------------------
            | Folder Industri
            |--------------------------------------------------------------------------
            |
            | Setiap pembimbing industri memiliki
            | folder sendiri berdasarkan ID USER.
            |
            | Contoh:
            |
            | storage/app/public/
            | └── foto-profil/
            |     └── industri/
            |         └── 15/
            |             └── foto.jpg
            |
            */

            $folderIndustri =
                'foto-profil/industri/' .
                $user->id;


            /*
            |--------------------------------------------------------------------------
            | Simpan Foto
            |--------------------------------------------------------------------------
            */

            $foto = $request
                ->file('foto_profil')
                ->store(
                    $folderIndustri,
                    'public'
                );


            /*
            |--------------------------------------------------------------------------
            | Simpan Path ke Database
            |--------------------------------------------------------------------------
            */

            $user->foto_profil =
                Storage::url($foto);
        }


        /*
        |--------------------------------------------------------------------------
        | Simpan User
        |--------------------------------------------------------------------------
        */

        $user->save();


        /*
        |--------------------------------------------------------------------------
        | Update Data Industri
        |--------------------------------------------------------------------------
        */

        $industri->nama_perusahaan =
            $validated['nama_perusahaan'];

        $industri->no_hp =
            $validated['no_hp'] ?? null;

        $industri->alamat =
            $validated['alamat'] ?? null;


        /*
        |--------------------------------------------------------------------------
        | Simpan Industri
        |--------------------------------------------------------------------------
        */

        $industri->save();


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'industri.profil.index'
            )
            ->with(
                'success',
                'Profil berhasil diperbarui.'
            );
    }


    /**
     * Halaman ubah password
     */
    public function password()
    {
        return view(
            'industri.profil.password'
        );
    }


    /**
     * Update password
     */
    public function updatePassword(
        Request $request
    ) {
        $request->validate([

            'password_lama' => [
                'required'
            ],

            'password_baru' => [
                'required',
                'min:6',
                'confirmed'
            ],

        ]);


        $user = User::findOrFail(
            Auth::id()
        );


        /*
        |--------------------------------------------------------------------------
        | Cek Password Lama
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
        | Password Baru
        |--------------------------------------------------------------------------
        */

        $user->password =
            Hash::make(
                $request->password_baru
            );


        $user->save();


        return redirect()
            ->route(
                'industri.profil.index'
            )
            ->with(
                'success',
                'Password berhasil diubah.'
            );
    }
}
