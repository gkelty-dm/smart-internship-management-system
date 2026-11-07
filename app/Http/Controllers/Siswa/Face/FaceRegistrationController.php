<?php

namespace App\Http\Controllers\Siswa\Face;

use App\Http\Controllers\Controller;
use App\Models\FaceProfile;
use App\Models\FaceImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FaceRegistrationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN REGISTRASI WAJAH
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $siswa = Auth::user()->siswa;

        if (!$siswa) {

            abort(
                403,
                'Data siswa belum tersedia.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | AMBIL / BUAT FACE PROFILE
        |--------------------------------------------------------------------------
        */

        $profile = FaceProfile::with('images')
            ->firstOrCreate(
                [
                    'siswa_id' => $siswa->id
                ],
                [
                    'is_registered' => false
                ]
            );


        /*
        |--------------------------------------------------------------------------
        | LOAD ULANG RELASI FOTO
        |--------------------------------------------------------------------------
        */

        $profile->load('images');


        /*
        |--------------------------------------------------------------------------
        | JUMLAH FOTO
        |--------------------------------------------------------------------------
        */

        $jumlahFoto = FaceImage::where(
            'face_profile_id',
            $profile->id
        )->count();


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'siswa.face.register',
            compact(
                'profile',
                'jumlahFoto'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN FOTO WAJAH
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'foto' => [
                'required',
                'string'
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | DATA SISWA
        |--------------------------------------------------------------------------
        */

        $siswa = Auth::user()->siswa;


        if (!$siswa) {

            return response()->json([
                'success' => false,
                'message' => 'Data siswa belum tersedia.'
            ], 403);
        }


        /*
        |--------------------------------------------------------------------------
        | AMBIL / BUAT FACE PROFILE
        |--------------------------------------------------------------------------
        */

        $profile = FaceProfile::firstOrCreate(
            [
                'siswa_id' => $siswa->id
            ],
            [
                'is_registered' => false
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | HITUNG JUMLAH FOTO
        |--------------------------------------------------------------------------
        */

        $jumlahFoto = FaceImage::where(
            'face_profile_id',
            $profile->id
        )->count();


        /*
        |--------------------------------------------------------------------------
        | MAKSIMAL 5 FOTO
        |--------------------------------------------------------------------------
        */

        if ($jumlahFoto >= 5) {

            return response()->json([
                'success' => false,
                'complete' => true,
                'jumlahFoto' => 5,
                'message' =>
                'Registrasi wajah sudah lengkap.'
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA BASE64
        |--------------------------------------------------------------------------
        */

        $foto = $request->foto;


        /*
        |--------------------------------------------------------------------------
        | HAPUS PREFIX BASE64
        |--------------------------------------------------------------------------
        */

        $foto = preg_replace(
            '/^data:image\/\w+;base64,/',
            '',
            $foto
        );


        /*
        |--------------------------------------------------------------------------
        | PERBAIKI SPASI BASE64
        |--------------------------------------------------------------------------
        */

        $foto = str_replace(
            ' ',
            '+',
            $foto
        );


        /*
        |--------------------------------------------------------------------------
        | DECODE BASE64
        |--------------------------------------------------------------------------
        */

        $dataFoto = base64_decode(
            $foto,
            true
        );


        if ($dataFoto === false) {

            return response()->json([
                'success' => false,
                'complete' => false,
                'jumlahFoto' => $jumlahFoto,
                'message' =>
                'Format foto tidak valid.'
            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | NOMOR FOTO
        |--------------------------------------------------------------------------
        */

        $nomorFoto =
            $jumlahFoto + 1;


        /*
        |--------------------------------------------------------------------------
        | NAMA FILE
        |--------------------------------------------------------------------------
        */

        $namaFile =
            'wajah_' .
            $nomorFoto .
            '.png';


        /*
        |--------------------------------------------------------------------------
        | PATH FOTO
        |--------------------------------------------------------------------------
        */

        $pathFoto =
            'registrasi_wajah_siswa/' .
            $siswa->id .
            '/' .
            $namaFile;


        /*
        |--------------------------------------------------------------------------
        | SIMPAN FOTO
        |--------------------------------------------------------------------------
        */

        Storage::disk('public')->put(
            $pathFoto,
            $dataFoto
        );


        /*
        |--------------------------------------------------------------------------
        | SIMPAN DATA KE DATABASE
        |--------------------------------------------------------------------------
        */

        FaceImage::create([
            'face_profile_id' =>
            $profile->id,

            'file_path' =>
            $pathFoto,
        ]);


        /*
        |--------------------------------------------------------------------------
        | HITUNG ULANG FOTO
        |--------------------------------------------------------------------------
        */

        $jumlahFoto = FaceImage::where(
            'face_profile_id',
            $profile->id
        )->count();


        /*
        |--------------------------------------------------------------------------
        | JIKA SUDAH 5 FOTO
        |--------------------------------------------------------------------------
        */

        if ($jumlahFoto >= 5) {

            $profile->update([
                'is_registered' => true,
                'registered_at' => now()
            ]);


            return response()->json([
                'success' => true,
                'complete' => true,
                'jumlahFoto' => $jumlahFoto,
                'message' =>
                'Registrasi wajah berhasil diselesaikan.'
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | FOTO BELUM 5
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'success' => true,
            'complete' => false,
            'jumlahFoto' => $jumlahFoto,
            'message' =>
            'Foto wajah berhasil disimpan.'
        ]);
    }
}
