<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Guru;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GuruImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $user = User::firstOrCreate(

            [
                'email' => $row['email']
            ],

            [
                'name' => $row['nama'],

                'password' => Hash::make(

                    empty($row['password'])
                        ? '12345678'
                        : $row['password']

                ),

                'role' => 'guru',

                'is_active' => true
            ]

        );

        Guru::firstOrCreate(

            [
                'nip' => $row['nip']
            ],

            [
                'user_id' => $user->id,

                'alamat' => $row['alamat'],

                'no_hp' => $row['no_hp']
            ]

        );

        return null;
    }
}
