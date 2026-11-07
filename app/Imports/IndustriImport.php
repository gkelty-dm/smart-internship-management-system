<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Industri;
use App\Models\Perusahaan;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class IndustriImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $perusahaan = Perusahaan::where(
            'nama_perusahaan',
            $row['perusahaan']
        )->first();

        if (!$perusahaan) {

            return null;

        }

        $user = User::firstOrCreate(

            [
                'email' => $row['email']
            ],

            [
                'name' => $row['nama'],
                'password' => Hash::make(
                    $row['password']
                ),
                'role' => 'industri',
                'is_active' => true
            ]

        );

        Industri::firstOrCreate(

            [
                'user_id' => $user->id
            ],

            [
                'perusahaan_id' => $perusahaan->id,
                'jabatan' => $row['jabatan'],
                'no_hp' => $row['no_hp']
            ]

        );

        return null;
    }
}