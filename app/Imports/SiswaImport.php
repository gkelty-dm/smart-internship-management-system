<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Jurusan;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class SiswaImport implements ToModel, WithHeadingRow
{
    private $jurusan = [];

    private $kelas = [];

    public function __construct()
    {
        $this->jurusan = Jurusan::pluck(
            'id',
            'nama_jurusan'
        )->toArray();

        $this->kelas = Kelas::pluck(
            'id',
            'nama_kelas'
        )->toArray();
    }

    public function model(array $row)
    {
        $jurusanId = $this->jurusan[
            $row['jurusan']
        ] ?? null;

        $kelasId = $this->kelas[
            $row['kelas']
        ] ?? null;

        if (
            !$jurusanId ||
            !$kelasId
        ) {
            return null;
        }

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

                'role' => 'siswa',
                'is_active' => true
            ]

        );

        Siswa::firstOrCreate(

            [
                'nisn' => $row['nisn']
            ],

            [
                'user_id' => $user->id,

                'jenis_kelamin' => $row['jenis_kelamin'],

                'tempat_lahir' => $row['tempat_lahir'],

                'tanggal_lahir' => is_numeric(
                    $row['tanggal_lahir']
                )
                    ? Date::excelToDateTimeObject(
                        $row['tanggal_lahir']
                    )->format('Y-m-d')
                    : $row['tanggal_lahir'],

                'alamat' => $row['alamat'],

                'no_hp' => $row['no_hp'],

                'jurusan_id' => $jurusanId,

                'kelas_id' => $kelasId
            ]

        );

        return null;
    }
}