<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use App\Models\PenempatanPKL;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Models\Jurusan;
use App\Models\Kelas;


class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $absensis = Absensi::with([
            'siswa.user'
        ])
            ->latest()
            ->paginate(10);

        return view(
            'absensi.index',
            compact('absensis')
        );
    }

    public function adminIndex(Request $request)
{
    $query = Absensi::with([
        'siswa.user',
        'siswa.kelas',
        'siswa.jurusan'
    ]);

    /*
    |--------------------------------------------------------------------------
    | Filter Nama
    |--------------------------------------------------------------------------
    */

    if ($request->filled('search')) {

        $query->whereHas('siswa.user', function ($q) use ($request) {

            $q->where(
                'name',
                'like',
                '%' . $request->search . '%'
            );

        });

    }

    /*
    |--------------------------------------------------------------------------
    | Filter Jurusan
    |--------------------------------------------------------------------------
    */

    if ($request->filled('jurusan')) {

        $query->whereHas('siswa', function ($q) use ($request) {

            $q->where(
                'jurusan_id',
                $request->jurusan
            );

        });

    }

    /*
    |--------------------------------------------------------------------------
    | Filter Kelas
    |--------------------------------------------------------------------------
    */

    if ($request->filled('kelas')) {

        $query->whereHas('siswa', function ($q) use ($request) {

            $q->where(
                'kelas_id',
                $request->kelas
            );

        });

    }

    /*
    |--------------------------------------------------------------------------
    | Filter Status
    |--------------------------------------------------------------------------
    */

    if ($request->filled('status')) {

        $query->where(
            'status',
            $request->status
        );

    }

    /*
    |--------------------------------------------------------------------------
    | Filter Tanggal
    |--------------------------------------------------------------------------
    */

    if ($request->filled('tanggal')) {

        $query->whereDate(
            'tanggal',
            $request->tanggal
        );

    }

    $absensis = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    /*
    |--------------------------------------------------------------------------
    | Statistik
    |--------------------------------------------------------------------------
    */

    $totalAbsensi = Absensi::count();

    $hadir = Absensi::where(
        'status',
        'hadir'
    )->count();

    $izin = Absensi::where(
        'status',
        'izin'
    )->count();

    $sakit = Absensi::where(
        'status',
        'sakit'
    )->count();

    $alpha = Absensi::where(
        'status',
        'alpha'
    )->count();

    $jurusans = Jurusan::all();

    $kelas = Kelas::all();

    return view(
        'absensi.absen_admin',
        compact(
            'absensis',
            'jurusans',
            'kelas',
            'totalAbsensi',
            'hadir',
            'izin',
            'sakit',
            'alpha'
        )
    );
}

    public function siswaIndex()
    {
        $siswa = Auth::user()->siswa;

        $faceProfile = $siswa->faceProfile;

        if (
            !$faceProfile ||
            !$faceProfile->is_registered
        ) {

            return back()->with(
                'error',
                'Silakan registrasi wajah terlebih dahulu'
            );
        }

        $absensis = Absensi::where(
            'siswa_id',
            $siswa->id
        )
            ->latest()
            ->paginate(10);

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
            'siswa.absensi.index',
            compact(
                'absensis',
                'absensiHariIni'
            )
        );
    }

    public function absenMasuk(Request $request)
    {
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
            'foto_masuk' => 'required',
        ]);

        $siswa = Auth::user()->siswa;

        $faceProfile = $siswa->faceProfile;

        if (
            !$faceProfile ||
            !$faceProfile->is_registered
        ) {
            return back()->with(
                'error',
                'Silakan registrasi wajah terlebih dahulu'
            );
        }

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
            return back()->with(
                'error',
                'Anda sudah absen hari ini'
            );
        }

        $penempatan = PenempatanPKL::with(
            'perusahaan'
        )
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
            return back()->with(
                'error',
                'Anda belum memiliki penempatan PKL aktif'
            );
        }

        $perusahaan = $penempatan->perusahaan;

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
            return back()->with(
                'error',
                'Anda berada di luar radius absensi. Jarak Anda ' .
                    round($jarak) .
                    ' meter'
            );
        }

        // =========================
        // SIMPAN FOTO SELFIE
        // =========================

        $foto = $request->foto_masuk;

        // hapus semua header image apapun
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

            return back()->with(
                'error',
                'Foto selfie tidak valid'
            );
        }

        $namaFile =
    'masuk_' .
    time() .
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
        // =========================
        // DEEPFACE VERIFY
        // =========================

        try {

            $faceProfile = $siswa->faceProfile;

            $fotoWajah = $faceProfile
                ->images()
                ->pluck('file_path')
                ->toArray();
            $response = Http::timeout(60)
                ->attach(
                    'selfie',
                    fopen(
                        storage_path(
                            'app/public/' .
                                $fotoMasuk
                        ),
                        'r'
                    ),
                    basename($fotoMasuk)
                )
                ->post(
                    env('AI_SERVER_URL') . '/verify-face',
                    [

                        'foto_1' => $fotoWajah[0] ?? null,

                        'foto_2' => $fotoWajah[1] ?? null,

                        'foto_3' => $fotoWajah[2] ?? null,

                        'foto_4' => $fotoWajah[3] ?? null,

                        'foto_5' => $fotoWajah[4] ?? null,

                    ]
                );

            if (!$response->successful()) {

                Storage::disk('public')->delete(
                    $fotoMasuk
                );

                return back()->with(
                    'error',
                    'Server AI tidak merespon'
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

                return back()->with(
                    'error',
                    'Wajah tidak sesuai dengan data registrasi'
                );
            }

            

        } catch (\Exception $e) {

            Storage::disk('public')->delete(
                $fotoMasuk
            );

            return back()->with(
                'error',
                'Gagal terhubung ke server AI'
            );
        }

        Absensi::create([

            'siswa_id' => $siswa->id,

            'tanggal' => now()->toDateString(),

            'jam_masuk' => now()->format('H:i:s'),

            'foto_masuk' => $fotoMasuk,

            'latitude_masuk' => $request->latitude,

            'longitude_masuk' => $request->longitude,

            'metode_verifikasi' => 'gps_face',

            'status' => 'hadir',

        ]);

        return back()->with(
            'success',
            'Absen masuk berhasil'
        );
    }

    public function absenPulang(Request $request)
    {
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
            'foto_pulang' => 'required',
        ]);

        $siswa = Auth::user()->siswa;

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

            return back()->with(
                'error',
                'Anda belum absen masuk'
            );
        }

        if ($absensi->jam_pulang) {

            return back()->with(
                'error',
                'Anda sudah absen pulang'
            );
        }

        $penempatan = PenempatanPKL::with(
            'perusahaan'
        )
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

            return back()->with(
                'error',
                'Anda belum memiliki penempatan PKL aktif'
            );
        }

        $perusahaan = $penempatan->perusahaan;

        if (
            !$perusahaan ||
            !$perusahaan->latitude ||
            !$perusahaan->longitude
        ) {

            return back()->with(
                'error',
                'Lokasi perusahaan belum diatur'
            );
        }

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

            return back()->with(
                'error',
                'Anda berada di luar radius absensi. Jarak Anda ' .
                    round($jarak) .
                    ' meter'
            );
        }

        // =========================
        // SIMPAN FOTO SELFIE
        // =========================

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

            return back()->with(
                'error',
                'Foto selfie tidak valid'
            );
        }

       $namaFile =
    'pulang_' .
    time() .
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

        // =========================
        // VERIFIKASI DEEPFACE
        // =========================

        try {
            $faceProfile = $siswa->faceProfile;

            $fotoWajah = $faceProfile
                ->images()
                ->pluck('file_path')
                ->toArray();

            $response = Http::timeout(60)
                ->attach(
                    'selfie',
                    fopen(
                        storage_path(
                            'app/public/' .
                                $fotoPulang
                        ),
                        'r'
                    ),
                    basename($fotoPulang)
                )
                ->post(
                    env('AI_SERVER_URL') . '/verify-face',
                    [

                        'foto_1' => $fotoWajah[0] ?? null,

                        'foto_2' => $fotoWajah[1] ?? null,

                        'foto_3' => $fotoWajah[2] ?? null,

                        'foto_4' => $fotoWajah[3] ?? null,

                        'foto_5' => $fotoWajah[4] ?? null,

                    ]
                );

            if (!$response->successful()) {

                Storage::disk('public')->delete(
                    $fotoMasuk
                );

                return back()->with(
                    'error',
                    'Server AI tidak merespon'
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

                return back()->with(
                    'error',
                    'Wajah tidak sesuai dengan data registrasi'
                );
            }

       } catch (\Exception $e) {

            Storage::disk('public')->delete(
                $fotoMasuk
            );

            return back()->with(
                'error',
                'Gagal terhubung ke server AI'
            );
        }

        // =========================
        // UPDATE ABSENSI
        // =========================

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
            'gps_face'

        ]);

        return back()->with(
            'success',
            'Absen pulang berhasil'
        );
    }

    private function hitungJarak(
        $lat1,
        $lon1,
        $lat2,
        $lon2
    ) {
        $earthRadius = 6371000;

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $siswas = Siswa::with('user')->get();

        return view(
            'absensi.create',
            compact('siswas')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required',
            'tanggal' => 'required',
            'status' => 'required',
        ]);

        Absensi::create([
            'siswa_id' => $request->siswa_id,

            'tanggal' => $request->tanggal,

            'jam_masuk' => $request->jam_masuk,
            'jam_pulang' => $request->jam_pulang,

            'status' => $request->status,

            'metode_verifikasi' => $request->metode_verifikasi,
        ]);

        return redirect()
            ->route('absensi.index')
            ->with('success', 'Absensi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absensi $absensi)
    {
        $siswas = Siswa::with('user')->get();

        return view(
            'absensi.edit',
            compact(
                'absensi',
                'siswas'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        Absensi $absensi
    ) {
        $request->validate([
            'siswa_id' => 'required',
            'tanggal' => 'required',
            'status' => 'required',
        ]);

        $absensi->update([
            'siswa_id' => $request->siswa_id,

            'tanggal' => $request->tanggal,

            'jam_masuk' => $request->jam_masuk,
            'jam_pulang' => $request->jam_pulang,

            'status' => $request->status,

            'metode_verifikasi' => $request->metode_verifikasi,
        ]);

        return redirect()
            ->route('absensi.index')
            ->with('success', 'Data absensi berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absensi $absensi)
    {
        $absensi->delete();

        return redirect()
            ->route('absensi.index')
            ->with('success', 'Data absensi berhasil dihapus');
    }

    public function guruIndex()
    {
        $guru = Auth::user()->guru;

        $siswaIds = PenempatanPKL::where(
            'guru_id',
            $guru->id
        )->pluck('siswa_id');

        $absensis = Absensi::with([
            'siswa.user'
        ])
            ->whereIn(
                'siswa_id',
                $siswaIds
            )
            ->latest()
            ->paginate(10);

        return view(
            'guru.absensi.index',
            compact('absensis')
        );
    }

    public function verifyFace(Request $request)
    {
        $request->validate([
            'image' => 'required'
        ]);

        $siswa = Auth::user()->siswa;

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

        $data = base64_decode($image);

        $tempFile =
            storage_path(
                'app/temp_verify.png'
            );

        file_put_contents(
            $tempFile,
            $data
        );

        try {
            $faceProfile = $siswa->faceProfile;

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
                    env('AI_SERVER_URL') . '/verify-face',
                    [

                        'foto_1' => $fotoWajah[0] ?? null,

                        'foto_2' => $fotoWajah[1] ?? null,

                        'foto_3' => $fotoWajah[2] ?? null,

                        'foto_4' => $fotoWajah[3] ?? null,

                        'foto_5' => $fotoWajah[4] ?? null,

                    ]
                );

            return response()->json(
                $response->json()
            );
        } catch (\Exception $e) {

            return response()->json([
                'verified' => false,
                'message' =>
                $e->getMessage()
            ]);
        }
    }

    public function formMasuk()
    {
        $siswa = Auth::user()->siswa;

        $penempatan = PenempatanPKL::where(
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
                    'Anda belum memiliki PKL aktif'
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
            compact('absensiHariIni')
        );
    }

    public function formPulang()
    {
        $siswa = Auth::user()->siswa;

        $penempatan = PenempatanPKL::where(
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
                    'Anda belum memiliki PKL aktif'
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
            compact('absensiHariIni')
        );
    }

    public function riwayat()
    {
        $siswa = Auth::user()->siswa;

        $absensis = Absensi::where(
            'siswa_id',
            $siswa->id
        )
            ->latest()
            ->paginate(10);

        return view(
            'siswa.absensi.riwayat',
            compact('absensis')
        );
    }
}
