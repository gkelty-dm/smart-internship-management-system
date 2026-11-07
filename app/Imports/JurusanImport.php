<?php

namespace App\Imports;

use App\Models\Jurusan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JurusanImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        Jurusan::firstOrCreate([

            'nama_jurusan' => $row['nama_jurusan']

        ]);

        return null;
    }
}