<?php

namespace App\Http\Controllers\Siswa\Absensi;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\PenempatanPKL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class AbsensiMasukController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | FORM ABSEN MASUK
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            abort(403, 'Data siswa belum tersedia.');
        }

        $faceProfile = $siswa->faceProfile;

        if (
            !$faceProfile ||
            !$faceProfile->is_registered
        ) {
            return redirect()
                ->route('siswa.face.register')
                ->with(
                    'error',
                    'Silakan registrasi wajah terlebih dahulu.'
                );
        }

        $penempatan = PenempatanPKL::with('perusahaan')
            ->where('siswa_id', $siswa->id)
            ->where('status_pkl', 'aktif')
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
            'siswa.absensi.masuk',
            compact(
                'siswa',
                'penempatan',
                'absensiHariIni'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | VERIFIKASI WAJAH
    |--------------------------------------------------------------------------
    |
    | Logika ini dipertahankan dari controller lama.
    | Digunakan oleh halaman absen masuk dan absen pulang.
    |
    */

    public function verifyFace(Request $request)
    {
        $request->validate([
            'image' => 'required'
        ]);

        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            return response()->json([
                'verified' => false,
                'message' => 'Data siswa belum tersedia.'
            ], 403);
        }

        $image = $request->image;

        $image = preg_replace(
            '/^data:image\/\w+;base64,/',
            '',
            $image
        );

        $image = str_replace(
            ' ',
            '+',
            $image
        );

        $data = base64_decode(
            $image,
            true
        );

        if ($data === false) {
            return response()->json([
                'verified' => false,
                'message' => 'Foto tidak valid.'
            ], 422);
        }

        $tempFile = storage_path(
            'app/temp_verify.png'
        );

        file_put_contents(
            $tempFile,
            $data
        );

        try {

            $faceProfile = $siswa->faceProfile;

            if (
                !$faceProfile ||
                !$faceProfile->is_registered
            ) {

                if (file_exists($tempFile)) {
                    unlink($tempFile);
                }

                return response()->json([
                    'verified' => false,
                    'message' =>
                    'Registrasi wajah belum lengkap.'
                ]);
            }

            $fotoWajah = $faceProfile
                ->images()
                ->pluck('file_path')
                ->toArray();

            $response = Http::timeout(60)
                ->attach(
                    'selfie',
                    fopen(
                        $tempFile,
                        'r'
                    ),
                    'temp_verify.png'
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

            if (file_exists($tempFile)) {
                unlink($tempFile);
            }

            return response()->json(
                $response->json(),
                $response->status()
            );
        } catch (\Throwable $e) {

            if (file_exists($tempFile)) {
                unlink($tempFile);
            }

            return response()->json([
                'verified' => false,
                'message' =>
                'Gagal menghubungi server AI.'
            ], 500);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN ABSEN MASUK
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

            'foto_masuk' => [
                'required'
            ],
        ]);

        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            abort(403, 'Data siswa belum tersedia.');
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
                ->withInput()
                ->with(
                    'error',
                    'Silakan registrasi wajah terlebih dahulu.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK ABSEN HARI INI
        |--------------------------------------------------------------------------
        */

        $sudahAbsen = Absensi::where(
            'siswa_id',
            $siswa->id
        )
            ->whereDate(
                'tanggal',
                now()
            )
            ->first();

        if ($sudahAbsen) {
            return back()
                ->with(
                    'error',
                    'Anda sudah melakukan absen masuk hari ini.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK PENEMPATAN PKL
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
        | CEK JARAK GPS
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
        | DECODE FOTO
        |--------------------------------------------------------------------------
        */

        $foto = $request->foto_masuk;

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
        | SIMPAN FOTO
        |--------------------------------------------------------------------------
        */

        $namaFile =
            'masuk_' .
            time() .
            '_' .
            $siswa->id .
            '.png';

        $fotoMasuk =
            'absensi_masuk/' .
            $siswa->id .
            '/' .
            $namaFile;

        Storage::disk('public')->put(
            $fotoMasuk,
            $dataFoto
        );


        /*
        |--------------------------------------------------------------------------
        | VERIFIKASI ULANG KE AI
        |--------------------------------------------------------------------------
        */

        try {

            $fotoWajah = $faceProfile
                ->images()
                ->pluck('file_path')
                ->toArray();

            $fileSelfie = storage_path(
                'app/public/' .
                    $fotoMasuk
            );

            $response = Http::timeout(60)
                ->attach(
                    'selfie',
                    fopen(
                        $fileSelfie,
                        'r'
                    ),
                    basename($fotoMasuk)
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
                    $fotoMasuk
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
                    $fotoMasuk
                );

                return back()
                    ->with(
                        'error',
                        'Wajah tidak sesuai dengan data registrasi.'
                    );
            }
        } catch (\Throwable $e) {

            Storage::disk('public')->delete(
                $fotoMasuk
            );

            return back()
                ->with(
                    'error',
                    'Gagal terhubung ke server AI.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN ABSENSI
        |--------------------------------------------------------------------------
        */

        Absensi::create([

            'siswa_id' =>
            $siswa->id,

            'tanggal' =>
            now()->toDateString(),

            'jam_masuk' =>
            now()->format('H:i:s'),

            'foto_masuk' =>
            $fotoMasuk,

            'latitude_masuk' =>
            $request->latitude,

            'longitude_masuk' =>
            $request->longitude,

            'metode_verifikasi' =>
            'gps_face',

            'status' =>
            'hadir',

        ]);

        return redirect()
            ->route('siswa.absensi.masuk')
            ->with(
                'success',
                'Absen masuk berhasil.'
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
