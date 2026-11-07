<?php

namespace App\Http\Controllers;

use App\Models\FaceProfile;
use App\Models\FaceImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FaceRegistrationController extends Controller
{
    public function index()
{
    $siswa = Auth::user()->siswa;

    $profile = FaceProfile::with('images')->firstOrCreate(
        [
            'siswa_id' => $siswa->id
        ],
        [
            'is_registered' => false
        ]
    );

    // Load relasi gambar setelah firstOrCreate
    $profile->load('images');

    $jumlahFoto = FaceImage::where(
        'face_profile_id',
        $profile->id
    )->count();

    return view(
        'siswa.face.register',
        compact(
            'profile',
            'jumlahFoto'
        )
    );
}

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required'
        ]);

        $siswa = Auth::user()->siswa;

        $profile = FaceProfile::firstOrCreate([
            'siswa_id' => $siswa->id
        ]);

        $jumlahFoto = FaceImage::where(
            'face_profile_id',
            $profile->id
        )->count();

        if ($jumlahFoto >= 5) {

            return response()->json([
                'success' => false,
                'message' => 'Registrasi wajah sudah lengkap'
            ]);

        }

        $foto = $request->foto;

        $foto = preg_replace(
            '/^data:image\/\w+;base64,/',
            '',
            $foto
        );

        $foto = str_replace(
            ' ',
            '+',
            $foto
        );

        $tempPath = storage_path(
            'app/temp_face.png'
        );

        file_put_contents(
            $tempPath,
            base64_decode($foto)
        );

       $namaFile = 'wajah_' . ($jumlahFoto + 1) . '.png';

$pathFoto = 'registrasi_wajah_siswa/' .
    $siswa->id .
    '/' .
    $namaFile;

Storage::disk('public')->put(
    $pathFoto,
    file_get_contents($tempPath)
);

unlink($tempPath);

        FaceImage::create([
            'face_profile_id' => $profile->id,
            'file_path' => $pathFoto
        ]);

        $jumlahFoto = FaceImage::where(
            'face_profile_id',
            $profile->id
        )->count();

        if ($jumlahFoto >= 5) {

            $profile->update([
                'is_registered' => true,
                'registered_at' => now()
            ]);

        }

        return response()->json([
            'success' => true,
            'message' => 'Foto wajah berhasil disimpan'
        ]);
    }
}