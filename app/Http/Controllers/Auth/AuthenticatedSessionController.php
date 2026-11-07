<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }


    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | AUTHENTICATE
        |--------------------------------------------------------------------------
        */

        $request->authenticate();


        /*
        |--------------------------------------------------------------------------
        | CEK AKUN AKTIF
        |--------------------------------------------------------------------------
        */

        $user = Auth::user();

        if (!$user) {

            return back()->withErrors([
                'email' => 'Login gagal.'
            ]);
        }


        if (!$user->is_active) {

            Auth::logout();

            return back()->withErrors([
                'email' =>
                'Akun Anda telah dinonaktifkan oleh admin.'
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | REGENERATE SESSION
        |--------------------------------------------------------------------------
        */

        $request->session()->regenerate();


        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'admin') {

            return redirect()->route(
                'admin.dashboard'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | GURU
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'guru') {

            return redirect()->route(
                'guru.dashboard'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | INDUSTRI
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'industri') {

            return redirect()->route(
                'industri.dashboard'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | SISWA
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'siswa') {

            /*
            |----------------------------------------------------------------------
            | Ambil data siswa
            |----------------------------------------------------------------------
            */

            $siswa = $user->siswa;


            /*
            |----------------------------------------------------------------------
            | Pastikan data siswa tersedia
            |----------------------------------------------------------------------
            */

            if (!$siswa) {

                Auth::logout();

                return back()->withErrors([
                    'email' =>
                    'Data siswa belum tersedia.'
                ]);
            }


            /*
            |----------------------------------------------------------------------
            | CEK REGISTRASI WAJAH
            |----------------------------------------------------------------------
            */

            $faceProfile = $siswa->faceProfile;


            /*
            |----------------------------------------------------------------------
            | BELUM REGISTRASI WAJAH
            |----------------------------------------------------------------------
            */

            if (
                !$faceProfile ||
                !$faceProfile->is_registered
            ) {

                return redirect()->route(
                    'siswa.face.register'
                );
            }


            /*
            |----------------------------------------------------------------------
            | SUDAH REGISTRASI WAJAH
            |----------------------------------------------------------------------
            */

            return redirect()->route(
                'siswa.dashboard'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | ROLE TIDAK DIKENAL
        |--------------------------------------------------------------------------
        */

        Auth::logout();

        return redirect('/login')->withErrors([
            'email' =>
            'Role akun tidak dikenali.'
        ]);
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
