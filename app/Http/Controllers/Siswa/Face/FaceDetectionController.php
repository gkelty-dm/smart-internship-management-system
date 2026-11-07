<?php

namespace App\Http\Controllers\Siswa\Face;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FaceDetectionController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DETEKSI WAJAH
    |--------------------------------------------------------------------------
    */

    public function detect(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | CEK FILE GAMBAR
        |--------------------------------------------------------------------------
        */

        if (!$request->hasFile('image')) {

            return response()->json([
                'detected' => false,
                'message' => 'Gambar tidak ditemukan'
            ], 400);
        }


        /*
        |--------------------------------------------------------------------------
        | KIRIM GAMBAR KE AI SERVER
        |--------------------------------------------------------------------------
        */

        $response = Http::attach(
            'image',
            file_get_contents(
                $request
                    ->file('image')
                    ->getRealPath()
            ),
            'detect.jpg'
        )->post(
            env('AI_SERVER_URL') . '/detect-face'
        );


        /*
        |--------------------------------------------------------------------------
        | KEMBALIKAN RESPONSE AI
        |--------------------------------------------------------------------------
        */

        return response()->json(
            $response->json(),
            $response->status()
        );
    }
}
