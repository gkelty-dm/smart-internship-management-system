<?php

namespace App\Http\Controllers\Admin\Siswa;

use App\Http\Controllers\Controller;
use App\Imports\SiswaImport;
use App\Models\Absensi;
use App\Models\FaceImage;
use App\Models\FaceProfile;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Logbook;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $faceStatus = $request->input('face_status');
        $jurusanId = $request->input('jurusan');

        $query = Siswa::with([
            'user',
            'jurusan',
            'kelas',
            'faceProfile',
        ]);

        if ($search) {
            $query->where(function ($q) use ($search) {

                $q->where(
                    'nisn',
                    'like',
                    "%{$search}%"
                )

                    ->orWhereHas('user', function ($user) use ($search) {

                        $user->where(
                            'name',
                            'like',
                            "%{$search}%"
                        )

                            ->orWhere(
                                'email',
                                'like',
                                "%{$search}%"
                            );
                    })

                    ->orWhereHas('kelas', function ($kelas) use ($search) {

                        $kelas->where(
                            'nama_kelas',
                            'like',
                            "%{$search}%"
                        );
                    })

                    ->orWhereHas('jurusan', function ($jurusan) use ($search) {

                        $jurusan->where(
                            'nama_jurusan',
                            'like',
                            "%{$search}%"
                        );
                    });
            });
        }

        if ($faceStatus === 'registered') {

            $query->whereHas(
                'faceProfile',
                function ($q) {
                    $q->where(
                        'is_registered',
                        true
                    );
                }
            );
        }

        if ($faceStatus === 'not_registered') {

            $query->where(function ($q) {

                $q->whereDoesntHave('faceProfile')

                    ->orWhereHas(
                        'faceProfile',
                        function ($qq) {
                            $qq->where(
                                'is_registered',
                                false
                            );
                        }
                    );
            });
        }

        if ($jurusanId) {

            $query->where(
                'jurusan_id',
                $jurusanId
            );
        }

        $totalSiswa = Siswa::count();

        $totalRegistered = Siswa::whereHas(
            'faceProfile',
            function ($q) {
                $q->where(
                    'is_registered',
                    true
                );
            }
        )->count();

        $totalNotRegistered =
            $totalSiswa - $totalRegistered;

        $jurusans = Jurusan::orderBy(
            'nama_jurusan'
        )->get();

        $siswas = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.siswa.index',
            compact(
                'siswas',
                'jurusans',
                'totalSiswa',
                'totalRegistered',
                'totalNotRegistered'
            )
        );
    }

    public function create()
    {
        $jurusans = Jurusan::orderBy(
            'nama_jurusan'
        )->get();

        $kelas = Kelas::orderBy(
            'nama_kelas'
        )->get();

        return view(
            'admin.siswa.create',
            compact(
                'jurusans',
                'kelas'
            )
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' =>
            'required|string|max:255',

            'email' =>
            'required|email|max:255|unique:users,email',

            'password' =>
            'required|string|min:6|confirmed',

            'nisn' =>
            'required|string|max:50|unique:siswas,nisn',

            'jenis_kelamin' =>
            'required|in:L,P',

            'tempat_lahir' =>
            'nullable|string|max:100',

            'tanggal_lahir' =>
            'nullable|date',

            'alamat' =>
            'nullable|string',

            'no_hp' =>
            'nullable|string|max:20',

            'jurusan_id' =>
            'required|exists:jurusans,id',

            'kelas_id' =>
            'required|exists:kelas,id',
        ]);

        DB::transaction(function () use ($validated) {

            $user = User::create([

                'role' => 'siswa',

                'name' =>
                $validated['name'],

                'email' =>
                $validated['email'],

                'password' =>
                Hash::make(
                    $validated['password']
                ),

                'is_active' => true,

            ]);

            Siswa::create([

                'user_id' =>
                $user->id,

                'nisn' =>
                $validated['nisn'],

                'jenis_kelamin' =>
                $validated['jenis_kelamin'],

                'tempat_lahir' =>
                $validated['tempat_lahir'] ?? null,

                'tanggal_lahir' =>
                $validated['tanggal_lahir'] ?? null,

                'alamat' =>
                $validated['alamat'] ?? null,

                'no_hp' =>
                $validated['no_hp'] ?? null,

                'jurusan_id' =>
                $validated['jurusan_id'],

                'kelas_id' =>
                $validated['kelas_id'],
            ]);
        });

        return redirect()
            ->route('admin.siswa.index')
            ->with(
                'success',
                'Data siswa berhasil ditambahkan.'
            );
    }

    public function show(Siswa $siswa)
    {
        $siswa->load([

            'user',
            'jurusan',
            'kelas',
            'faceProfile.images',

            'penempatanPKL.guru.user',
            'penempatanPKL.industri.user',
            'penempatanPKL.perusahaan',

            'absensis',
            'logbooks.fotos',

        ]);

        $jumlahFoto = $siswa->faceProfile
            ? $siswa->faceProfile->images->count()
            : 0;

        return view(
            'admin.siswa.show',
            compact(
                'siswa',
                'jumlahFoto'
            )
        );
    }

    public function edit(Siswa $siswa)
    {
        $siswa->load('user');

        $jurusans = Jurusan::orderBy(
            'nama_jurusan'
        )->get();

        $kelas = Kelas::orderBy(
            'nama_kelas'
        )->get();

        return view(
            'admin.siswa.edit',
            compact(
                'siswa',
                'jurusans',
                'kelas'
            )
        );
    }

    public function update(
        Request $request,
        Siswa $siswa
    ) {
        $validated = $request->validate([

            'name' =>
            'required|string|max:255',

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' .
                    $siswa->user_id,
            ],

            'nisn' => [
                'required',
                'string',
                'max:50',
                'unique:siswas,nisn,' .
                    $siswa->id,
            ],

            'jenis_kelamin' =>
            'required|in:L,P',

            'tempat_lahir' =>
            'nullable|string|max:100',

            'tanggal_lahir' =>
            'nullable|date',

            'alamat' =>
            'nullable|string',

            'no_hp' =>
            'nullable|string|max:20',

            'jurusan_id' =>
            'required|exists:jurusans,id',

            'kelas_id' =>
            'required|exists:kelas,id',
        ]);

        DB::transaction(function () use (
            $validated,
            $siswa
        ) {

            if ($siswa->user) {

                $siswa->user->update([

                    'name' =>
                    $validated['name'],

                    'email' =>
                    $validated['email'],

                ]);
            }

            $siswa->update([

                'nisn' =>
                $validated['nisn'],

                'jenis_kelamin' =>
                $validated['jenis_kelamin'],

                'tempat_lahir' =>
                $validated['tempat_lahir'] ?? null,

                'tanggal_lahir' =>
                $validated['tanggal_lahir'] ?? null,

                'alamat' =>
                $validated['alamat'] ?? null,

                'no_hp' =>
                $validated['no_hp'] ?? null,

                'jurusan_id' =>
                $validated['jurusan_id'],

                'kelas_id' =>
                $validated['kelas_id'],

            ]);
        });

        return redirect()
            ->route('admin.siswa.index')
            ->with(
                'success',
                'Data siswa berhasil diperbarui.'
            );
    }

    public function destroy(Siswa $siswa)
    {
        DB::transaction(function () use ($siswa) {

            $user = $siswa->user;

            Storage::disk('public')
                ->deleteDirectory(
                    'foto_profil_siswa/' .
                        $siswa->id
                );

            Storage::disk('public')
                ->deleteDirectory(
                    'registrasi_wajah_siswa/' .
                        $siswa->id
                );

            Storage::disk('public')
                ->deleteDirectory(
                    'absensi_masuk/' .
                        $siswa->id
                );

            Storage::disk('public')
                ->deleteDirectory(
                    'absensi_pulang/' .
                        $siswa->id
                );

            Storage::disk('public')
                ->deleteDirectory(
                    'logbook/' .
                        $siswa->id
                );

            if ($siswa->faceProfile) {

                $siswa->faceProfile
                    ->images()
                    ->delete();

                $siswa->faceProfile
                    ->delete();
            }

            $siswa->logbooks()->delete();

            $siswa->penempatanPKL()->delete();

            $siswa->delete();

            if ($user) {
                $user->delete();
            }
        });

        return redirect()
            ->route('admin.siswa.index')
            ->with(
                'success',
                'Data siswa berhasil dihapus.'
            );
    }

    public function getKelas($jurusanId)
    {
        $kelas = Kelas::where(
            'jurusan_id',
            $jurusanId
        )
            ->orderBy('nama_kelas')
            ->get();

        return response()->json($kelas);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' =>
            'required|mimes:xlsx,xls|max:5120',
        ]);

        Excel::import(
            new SiswaImport,
            $request->file('file')
        );

        return redirect()
            ->route('admin.siswa.index')
            ->with(
                'success',
                'Data siswa berhasil diimport.'
            );
    }

    public function resetFace(Siswa $siswa)
    {
        try {

            $faceProfile = FaceProfile::where(
                'siswa_id',
                $siswa->id
            )->first();

            if (!$faceProfile) {

                return back()->with(
                    'error',
                    'Siswa belum memiliki data wajah.'
                );
            }

            Storage::disk('public')
                ->deleteDirectory(
                    'registrasi_wajah_siswa/' .
                        $siswa->id
                );

            $faceProfile
                ->images()
                ->delete();

            $faceProfile->update([

                'is_registered' =>
                false,

                'face_encoding_path' =>
                null,

            ]);

            return back()->with(
                'success',
                'Registrasi wajah berhasil direset.'
            );
        } catch (\Throwable $e) {

            return back()->with(
                'error',
                'Gagal mereset registrasi wajah: ' .
                    $e->getMessage()
            );
        }
    }

    public function uploadFace(
        Request $request,
        Siswa $siswa
    ) {
        $request->validate([

            'foto' =>
            'required|array|min:1|max:5',

            'foto.*' =>
            'required|image|mimes:jpg,jpeg,png|max:5120',

        ]);

        $profile = FaceProfile::firstOrCreate(

            [
                'siswa_id' =>
                $siswa->id,
            ],

            [
                'is_registered' =>
                false,
            ]

        );

        $jumlahFoto = FaceImage::where(
            'face_profile_id',
            $profile->id
        )->count();

        $files = $request->file('foto');

        if (
            ($jumlahFoto + count($files)) > 5
        ) {

            return back()->with(
                'error',
                'Maksimal hanya 5 foto registrasi wajah.'
            );
        }

        foreach ($files as $file) {

            $jumlahFoto++;

            $namaFile =
                'wajah_' .
                $jumlahFoto .
                '.png';

            $path = $file->storeAs(
                'registrasi_wajah_siswa/' .
                    $siswa->id,
                $namaFile,
                'public'
            );

            FaceImage::create([

                'face_profile_id' =>
                $profile->id,

                'file_path' =>
                $path,

            ]);
        }

        if ($jumlahFoto >= 5) {

            $profile->update([

                'is_registered' =>
                true,

                'registered_at' =>
                now(),

            ]);
        }

        return back()->with(
            'success',
            'Foto registrasi berhasil diupload.'
        );
    }

    public function riwayatAbsensi(Siswa $siswa)
    {
        $siswa->load([
            'user',
            'jurusan',
            'kelas',
        ]);

        $absensis = Absensi::where(
            'siswa_id',
            $siswa->id
        )
            ->orderByDesc('tanggal')
            ->orderByDesc('id')
            ->paginate(10);

        return view(
            'admin.siswa.riwayat-absensi',
            compact(
                'siswa',
                'absensis'
            )
        );
    }

    public function riwayatLogbook(Siswa $siswa)
    {
        $siswa->load([
            'user',
            'jurusan',
            'kelas',
        ]);

        $logbooks = Logbook::with('fotos')
            ->where(
                'siswa_id',
                $siswa->id
            )
            ->latest('tanggal')
            ->latest('id')
            ->paginate(10);

        return view(
            'admin.siswa.riwayat-logbook',
            compact(
                'siswa',
                'logbooks'
            )
        );
    }
}
