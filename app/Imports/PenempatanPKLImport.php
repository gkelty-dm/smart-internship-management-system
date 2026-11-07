<?php

namespace App\Imports;

use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Industri;
use App\Models\Perusahaan;
use App\Models\PenempatanPKL;
use PhpOffice\PhpSpreadsheet\Shared\Date;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PenempatanPKLImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $siswa = Siswa::whereHas(
            'user',
            function ($query) use ($row) {

                $query->where(
                    'name',
                    $row['siswa']
                );
            }
        )->first();

        $guru = Guru::whereHas(
            'user',
            function ($query) use ($row) {

                $query->where(
                    'name',
                    $row['guru']
                );
            }
        )->first();

        $perusahaan = Perusahaan::where(
            'nama_perusahaan',
            $row['perusahaan']
        )->first();

        if (!$perusahaan) {
            return null;
        }

        $industri = null;

        if (!empty($row['industri'])) {

            $industri = Industri::where(

                'perusahaan_id',

                $perusahaan->id

            )->whereHas(

                'user',

                function ($query) use ($row) {

                    $query->where(

                        'name',

                        $row['industri']

                    );
                }

            )->first();
        }

        if (
            !$siswa ||
            !$guru ||
            !$perusahaan
        ) {
            return null;
        }

        PenempatanPKL::firstOrCreate(

            [

                'siswa_id' => $siswa->id

            ],

            [

                'guru_id' => $guru->id,

                'industri_id' => $industri?->id,

                'perusahaan_id' => $perusahaan->id,

                'tanggal_mulai' => empty(
                    $row['tanggal_mulai']
                )
                    ? null
                    : (
                        is_numeric(
                            $row['tanggal_mulai']
                        )
                            ? Date::excelToDateTimeObject(
                                $row['tanggal_mulai']
                            )->format('Y-m-d')
                            : $row['tanggal_mulai']
                    ),

                'tanggal_selesai' => empty(
                    $row['tanggal_selesai']
                )
                    ? null
                    : (
                        is_numeric(
                            $row['tanggal_selesai']
                        )
                            ? Date::excelToDateTimeObject(
                                $row['tanggal_selesai']
                            )->format('Y-m-d')
                            : $row['tanggal_selesai']
                    ),

                'status_pkl' => $row['status_pkl']

            ]

        );

        return null;
    }
}