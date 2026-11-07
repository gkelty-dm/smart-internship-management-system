<?php

namespace App\Imports;

use App\Models\Perusahaan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PerusahaanImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $latitude = null;
        $longitude = null;

        if (
            isset($row['link_maps'])
        ) {

            preg_match(
                '/!3d([-0-9.]+)!4d([-0-9.]+)/',
                $row['link_maps'],
                $matches
            );

            if (
                count($matches) >= 3
            ) {
                $latitude = $matches[1];

                $longitude = $matches[2];
            }
        }

        Perusahaan::firstOrCreate(

            [

                'nama_perusahaan' =>
                    $row['nama_perusahaan']

            ],

            [

                'alamat' =>
                    $row['alamat'],

                'telepon' =>
                    $row['telepon'],

                'link_maps' =>
                    $row['link_maps'],

                'latitude' =>
                    $latitude,

                'longitude' =>
                    $longitude,

                'radius' => 100

            ]

        );

        return null;
    }
}