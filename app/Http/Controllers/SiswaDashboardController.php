<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Logbook;
use App\Models\Siswa;
use App\Models\PenempatanPKL;
use App\Models\FaceProfile;
use App\Models\NilaiPKL;
use Illuminate\Support\Facades\Hash;


class SiswaDashboardController extends Controller
{
    public function index()
{
    $siswa = Auth::user()->siswa;

    $jumlahLogbook = Logbook::where(
        'siswa_id',
        $siswa->id
    )->count();

    $absensiHariIni = Absensi::where(
        'siswa_id',
        $siswa->id
    )
    ->whereDate(
        'tanggal',
        now()
    )
    ->first();

    $penempatan = PenempatanPKL::with([
        'perusahaan',
        'guru',
        'industri'
    ])
    ->where('siswa_id', $siswa->id)
    ->first();

    $faceProfile = $siswa->faceProfile;

    return view(
        'siswa.dashboard',
        compact(
            'siswa',
            'jumlahLogbook',
            'absensiHariIni',
            'faceProfile',
            'penempatan'
        )
    );
}

public function profilPKL()
{
    $siswa = Auth::user()->siswa;

    $penempatan = PenempatanPKL::with([
        'perusahaan',
        'guru.user',
        'industri.user'
    ])
    ->where(
        'siswa_id',
        $siswa->id
    )
    ->first();

    return view(
        'siswa.profil-pkl',
        compact(
            'siswa',
            'penempatan'
        )
    );
}

public function nilaiPKL()
{
    $siswa = auth()->user()->siswa;

    $penempatan = PenempatanPKL::where(
        'siswa_id',
        $siswa->id
    )->first();

    $nilaiPKL = null;

    if ($penempatan) {

        $nilaiPKL = NilaiPKL::where(
            'penempatan_pkl_id',
            $penempatan->id
        )->first();

    }

    return view(
        'siswa.nilai-pkl',
        compact('nilaiPKL')
    );
}

public function profil()
{
    $siswa = auth()->user()->siswa;

    return view(
        'siswa.profil.index',
        compact('siswa')
    );
}

public function editProfil()
{
    $siswa = auth()->user()->siswa;

    return view(
        'siswa.profil.edit',
        compact('siswa')
    );
}

public function updateProfil(Request $request)
{
    $request->validate([

        'name' => 'required',

        'email' => 'required|email',

        'nisn' => 'required',

        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'

    ]);

    $user = Auth::user();

    $user->update([

        'name' => $request->name,

        'email' => $request->email

    ]);

    $foto = $user->siswa->foto;

    if ($request->hasFile('foto')) {

        $folder = 'foto-profil/siswa-' . $user->siswa->id;

        $foto = $request
            ->file('foto')
            ->store(
                $folder,
                'public'
            );
    }

    $user->siswa->update([

        'nisn' => $request->nisn,

        'no_hp' => $request->no_hp,

        'alamat' => $request->alamat,

        'foto' => $foto

    ]);

    return redirect()
        ->route('siswa.profil')
        ->with(
            'success',
            'Profil berhasil diperbarui'
        );
}

public function password()
{
    return view(
        'siswa.profil.password'
    );
}

public function updatePassword(Request $request)
{
    $request->validate([

        'current_password' => 'required',

        'password' => 'required|min:8|confirmed'

    ]);

    if(
        !Hash::check(
            $request->current_password,
            Auth::user()->password
        )
    )
    {
        return back()
            ->withErrors([
                'current_password' =>
                'Password lama tidak sesuai'
            ]);
    }

    Auth::user()->update([

        'password' => Hash::make(
            $request->password
        )

    ]);

    return redirect()
        ->route('siswa.password')
        ->with(
            'success',
            'Password berhasil diubah'
        );
}

}