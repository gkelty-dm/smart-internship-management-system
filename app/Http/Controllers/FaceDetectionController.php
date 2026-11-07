<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FaceDetectionController extends Controller
{
    public function detect(Request $request)
    {
        if (!$request->hasFile('image')) {
            return response()->json([
                'detected' => false,
                'message' => 'Gambar tidak ditemukan'
            ], 400);
        }

        $response = Http::attach(
            'image',
            file_get_contents(
                $request->file('image')->getRealPath()
            ),
            'detect.jpg'
        )->post(
            env('AI_SERVER_URL') . '/detect-face'
        );

        return response()->json(
            $response->json(),
            $response->status()
        );
    }
}