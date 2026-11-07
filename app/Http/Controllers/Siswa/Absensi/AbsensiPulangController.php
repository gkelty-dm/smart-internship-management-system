<?php

namespace App\Http\Controllers\Siswa\Absensi;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\PenempatanPKL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class AbsensiPulangController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | FORM ABSEN PULANG
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            abort(403, 'Data siswa belum tersedia.');
        }

        $penempatan = PenempatanPKL::with('perusahaan')
            ->where(
                'siswa_id',
                $siswa->id
            )
            ->where(
                'status_pkl',
                'aktif'
            )
            ->first();

        if (!$penempatan) {
            return redirect()
                ->route('siswa.dashboard')
                ->with(
                    'error',
                    'Anda belum memiliki tempat PKL aktif. Silakan hubungi admin untuk mendapatkan penempatan PKL.'
                );
        }

        $absensiHariIni = Absensi::where(
            'siswa_id',
            $siswa->id
        )
            ->whereDate(
                'tanggal',
                now()
            )
            ->first();

        return view(
            'siswa.absensi.pulang',
            compact(
                'siswa',
                'penempatan',
                'absensiHariIni'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN ABSEN PULANG
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'latitude' => [
                'required',
                'numeric'
            ],

            'longitude' => [
                'required',
                'numeric'
            ],

            'foto_pulang' => [
                'required'
            ],
        ]);

        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            abort(403, 'Data siswa belum tersedia.');
        }


        /*
        |--------------------------------------------------------------------------
        | CEK ABSEN MASUK
        |--------------------------------------------------------------------------
        */

        $absensi = Absensi::where(
            'siswa_id',
            $siswa->id
        )
            ->whereDate(
                'tanggal',
                now()
            )
            ->first();

        if (!$absensi) {
            return back()
                ->with(
                    'error',
                    'Anda belum melakukan absen masuk.'
                );
        }

        if ($absensi->jam_pulang) {
            return back()
                ->with(
                    'error',
                    'Anda sudah melakukan absen pulang.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK PENEMPATAN
        |--------------------------------------------------------------------------
        */

        $penempatan = PenempatanPKL::with('perusahaan')
            ->where(
                'siswa_id',
                $siswa->id
            )
            ->where(
                'status_pkl',
                'aktif'
            )
            ->first();

        if (!$penempatan) {
            return back()
                ->with(
                    'error',
                    'Anda belum memiliki penempatan PKL aktif.'
                );
        }

        $perusahaan = $penempatan->perusahaan;

        if (
            !$perusahaan ||
            !$perusahaan->latitude ||
            !$perusahaan->longitude
        ) {
            return back()
                ->with(
                    'error',
                    'Lokasi perusahaan belum diatur.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK GPS
        |--------------------------------------------------------------------------
        */

        $jarak = $this->hitungJarak(
            $request->latitude,
            $request->longitude,
            $perusahaan->latitude,
            $perusahaan->longitude
        );

        if (
            $jarak >
            $perusahaan->radius_absensi
        ) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Anda berada di luar radius absensi. Jarak Anda ' .
                        round($jarak) .
                        ' meter.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK REGISTRASI WAJAH
        |--------------------------------------------------------------------------
        */

        $faceProfile = $siswa->faceProfile;

        if (
            !$faceProfile ||
            !$faceProfile->is_registered
        ) {
            return back()
                ->with(
                    'error',
                    'Silakan registrasi wajah terlebih dahulu.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | DECODE FOTO
        |--------------------------------------------------------------------------
        */

        $foto = $request->foto_pulang;

        $foto = preg_replace(
            '/^data:image\/\w+;base64,/',
            '',
            $foto
        );

        $foto = str_replace(
            ' ',
            '+',
            $foto
        );

        $dataFoto = base64_decode(
            $foto,
            true
        );

        if ($dataFoto === false) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Foto selfie tidak valid.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN FOTO PULANG
        |--------------------------------------------------------------------------
        */

        $namaFile =
            'pulang_' .
            time() .
            '_' .
            $siswa->id .
            '.png';

        $fotoPulang =
            'absensi_pulang/' .
            $siswa->id .
            '/' .
            $namaFile;

        Storage::disk('public')->put(
            $fotoPulang,
            $dataFoto
        );


        /*
        |--------------------------------------------------------------------------
        | VERIFIKASI WAJAH
        |--------------------------------------------------------------------------
        */

        try {

            $fotoWajah = $faceProfile
                ->images()
                ->pluck('file_path')
                ->toArray();

            $fileSelfie = storage_path(
                'app/public/' .
                    $fotoPulang
            );

            $response = Http::timeout(60)
                ->attach(
                    'selfie',
                    fopen(
                        $fileSelfie,
                        'r'
                    ),
                    basename($fotoPulang)
                )
                ->post(
                    env('AI_SERVER_URL') .
                        '/verify-face',
                    [

                        'foto_1' =>
                        $fotoWajah[0] ?? null,

                        'foto_2' =>
                        $fotoWajah[1] ?? null,

                        'foto_3' =>
                        $fotoWajah[2] ?? null,

                        'foto_4' =>
                        $fotoWajah[3] ?? null,

                        'foto_5' =>
                        $fotoWajah[4] ?? null,

                    ]
                );

            if (!$response->successful()) {

                Storage::disk('public')->delete(
                    $fotoPulang
                );

                return back()
                    ->with(
                        'error',
                        'Server AI tidak merespon.'
                    );
            }

            $hasil = $response->json();

            if (
                !isset($hasil['verified']) ||
                !$hasil['verified']
            ) {

                Storage::disk('public')->delete(
                    $fotoPulang
                );

                return back()
                    ->with(
                        'error',
                        'Wajah tidak sesuai dengan data registrasi.'
                    );
            }
        } catch (\Throwable $e) {

            Storage::disk('public')->delete(
                $fotoPulang
            );

            return back()
                ->with(
                    'error',
                    'Gagal terhubung ke server AI.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE ABSENSI
        |--------------------------------------------------------------------------
        */

        $absensi->update([

            'jam_pulang' =>
            now()->format('H:i:s'),

            'foto_pulang' =>
            $fotoPulang,

            'latitude_pulang' =>
            $request->latitude,

            'longitude_pulang' =>
            $request->longitude,

            'metode_verifikasi' =>
            'gps_face',

        ]);

        return redirect()
            ->route('siswa.absensi.pulang')
            ->with(
                'success',
                'Absen pulang berhasil.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | HITUNG JARAK
    |--------------------------------------------------------------------------
    */

    private function hitungJarak(
        $lat1,
        $lon1,
        $lat2,
        $lon2
    ) {
        $earthRadius = 6371000;

        $dLat = deg2rad(
            $lat2 - $lat1
        );

        $dLon = deg2rad(
            $lon2 - $lon1
        );

        $a =
            sin($dLat / 2) *
            sin($dLat / 2) +

            cos(deg2rad($lat1)) *
            cos(deg2rad($lat2)) *

            sin($dLon / 2) *
            sin($dLon / 2);

        $c =
            2 *
            atan2(
                sqrt($a),
                sqrt(1 - $a)
            );

        return $earthRadius * $c;
    }
}
