<?php

namespace App\Imports;

use App\Models\Kelas;
use App\Models\Jurusan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KelasImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $jurusan = Jurusan::where(
            'nama_jurusan',
            $row['nama_jurusan']
        )->first();

        if (!$jurusan) {
            return null;
        }

        Kelas::firstOrCreate([

            'nama_kelas' => $row['nama_kelas']

        ], [

            'jurusan_id' => $jurusan->id

        ]);

        return null;
    }
}