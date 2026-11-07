<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $admins = User::where(
            'role',
            'admin'
        )->get();

        $gurus = User::where(
            'role',
            'guru'
        )->get();

        $siswas = User::where(
            'role',
            'siswa'
        )->get();

        $industris = User::where(
            'role',
            'industri'
        )->get();

        return view(
            'users.index',
            compact(
                'admins',
                'gurus',
                'siswas',
                'industris'
            )
        );
    }

    public function edit(User $user)
    {
        return view(
            'users.edit',
            compact('user')
        );
    }

    public function update(
        Request $request,
        User $user
    ) {
        $request->validate([

            'name' => 'required',
            'email' => 'required|email'

        ]);

        $user->update([

            'name' => $request->name,
            'email' => $request->email

        ]);

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User berhasil diperbarui'
            );
    }



    public function resetPassword(
        User $user
    ) {
        $user->update([

            'password' => Hash::make(
                '12345678'
            )

        ]);

        return back()->with(
            'success',
            'Password berhasil direset menjadi 12345678'
        );
    }

    public function nonaktifkan(
        User $user
    ) {
        if (
            auth()->id() ==
            $user->id
        ) {
            return back()->with(
                'error',
                'Anda tidak dapat menonaktifkan akun sendiri'
            );
        }

        $user->update([

            'is_active' => false

        ]);

        return back()->with(
            'success',
            'User berhasil dinonaktifkan'
        );
    }

    public function aktifkan(
        User $user
    ) {
        $user->update([

            'is_active' => true

        ]);

        return back()->with(
            'success',
            'User berhasil diaktifkan'
        );
    }
}
