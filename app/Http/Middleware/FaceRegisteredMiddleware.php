<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class FaceRegisteredMiddleware
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {

        /*
        |--------------------------------------------------------------------------
        | CEK LOGIN
        |--------------------------------------------------------------------------
        */

        $user = Auth::user();

        if (!$user) {

            return redirect()->route('login');
        }


        /*
        |--------------------------------------------------------------------------
        | ROUTE REGISTRASI WAJAH
        |--------------------------------------------------------------------------
        |
        | Route registrasi wajah harus selalu boleh dibuka.
        | Jangan sampai middleware mengarahkan dirinya sendiri.
        |
        */

        if ($request->routeIs('siswa.face.*')) {

            return $next($request);
        }


        /*
        |--------------------------------------------------------------------------
        | DATA SISWA
        |--------------------------------------------------------------------------
        */

        $siswa = $user->siswa;

        if (!$siswa) {

            abort(
                403,
                'Data siswa belum tersedia.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK FACE PROFILE
        |--------------------------------------------------------------------------
        */

        $faceProfile = $siswa->faceProfile;


        /*
        |--------------------------------------------------------------------------
        | BELUM REGISTRASI
        |--------------------------------------------------------------------------
        */

        if (
            !$faceProfile ||
            !$faceProfile->is_registered
        ) {

            return redirect()
                ->route('siswa.face.index')
                ->with(
                    'error',
                    'Silakan registrasi wajah terlebih dahulu.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | SUDAH REGISTRASI
        |--------------------------------------------------------------------------
        */

        return $next($request);
    }
}
