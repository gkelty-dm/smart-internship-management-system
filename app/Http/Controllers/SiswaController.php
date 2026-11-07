<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Models\FaceProfile;
use App\Models\FaceImage;
use App\Models\Absensi;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $search = $request->search;
    $faceStatus = $request->face_status;
    $jurusan = $request->jurusan;

    $query = Siswa::with([
        'user',
        'jurusan',
        'kelas',
        'faceProfile'
    ]);

    // Filter pencarian
    $query->when($search, function ($query) use ($search) {
        $query->where('nisn', 'like', "%{$search}%")
            ->orWhereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            })
            ->orWhereHas('kelas', function ($q) use ($search) {
                $q->where('nama_kelas', 'like', "%{$search}%");
            })
            ->orWhereHas('jurusan', function ($q) use ($search) {
                $q->where('nama_jurusan', 'like', "%{$search}%");
            });
    });

    // Filter status registrasi wajah
    $query->when($faceStatus, function ($query) use ($faceStatus) {

        if ($faceStatus == 'registered') {

            $query->whereHas('faceProfile', function ($q) {
                $q->where('is_registered', true);
            });

        } elseif ($faceStatus == 'not_registered') {

            $query->where(function ($q) {

                $q->whereDoesntHave('faceProfile')
                  ->orWhereHas('faceProfile', function ($qq) {
                      $qq->where('is_registered', false);
                  });

            });

        }

    });

    $query->when($jurusan, function ($query) use ($jurusan) {

    $query->where(
        'jurusan_id',
        $jurusan
    );

});

    // Statistik
    $totalSiswa = Siswa::count();

    $totalRegistered = Siswa::whereHas('faceProfile', function ($q) {
        $q->where('is_registered', true);
    })->count();

    $totalNotRegistered = $totalSiswa - $totalRegistered;

    $jurusans = Jurusan::orderBy(
    'nama_jurusan'
)->get();

    $siswas = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return view(
    'siswa.index',
    compact(
        'siswas',
        'jurusans',
        'totalSiswa',
        'totalRegistered',
        'totalNotRegistered'
    )
);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $jurusans = Jurusan::all();
    $kelas = Kelas::all();

    return view('siswa.create', compact(
        'jurusans',
        'kelas'
    ));
}
    
    public function show(Siswa $siswa)
{
    $siswa->load([
        'user',
        'kelas',
        'jurusan',
        'faceProfile.images'
    ]);

    $jumlahFoto = 0;

    if ($siswa->faceProfile) {
        $jumlahFoto = $siswa->faceProfile->images->count();
    }

    return view(
        'siswa.show',
        compact(
            'siswa',
            'jumlahFoto'
        )
    );
}


public function riwayatAbsensi(Siswa $siswa)
{
    $siswa->load([
        'user',
        'jurusan',
        'kelas'
    ]);

    $absensis = Absensi::where(
            'siswa_id',
            $siswa->id
        )
        ->orderBy('tanggal', 'desc')
        ->paginate(10);

    return view(
        'siswa.riwayat-absensi',
        compact(
            'siswa',
            'absensis'
        )
    );
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',

        'nisn' => 'required|unique:siswas,nisn',
        'jenis_kelamin' => 'required',

        'jurusan_id' => 'required',
        'kelas_id' => 'required',
    ]);

    $user = User::create([
        'role' => 'siswa',
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'is_active' => true,
    ]);

    Siswa::create([
        'user_id' => $user->id,
        'nisn' => $request->nisn,
        'jenis_kelamin' => $request->jenis_kelamin,
        'tempat_lahir' => $request->tempat_lahir,
        'tanggal_lahir' => $request->tanggal_lahir,
        'alamat' => $request->alamat,
        'no_hp' => $request->no_hp,
        'jurusan_id' => $request->jurusan_id,
        'kelas_id' => $request->kelas_id,
    ]);

    return redirect()
        ->route('siswa.index')
        ->with('success', 'Data siswa berhasil ditambahkan');
}

 

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
{
    $jurusans = Jurusan::all();
    $kelas = Kelas::all();

    return view('siswa.edit', compact(
        'siswa',
        'jurusans',
        'kelas'
    ));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $siswa->user_id,

        'nisn' => 'required|unique:siswas,nisn,' . $siswa->id,

        'jenis_kelamin' => 'required',
        'jurusan_id' => 'required',
        'kelas_id' => 'required',
    ]);

    $siswa->user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    $siswa->update([
        'nisn' => $request->nisn,
        'jenis_kelamin' => $request->jenis_kelamin,
        'tempat_lahir' => $request->tempat_lahir,
        'tanggal_lahir' => $request->tanggal_lahir,
        'alamat' => $request->alamat,
        'no_hp' => $request->no_hp,
        'jurusan_id' => $request->jurusan_id,
        'kelas_id' => $request->kelas_id,
    ]);

    return redirect()
        ->route('siswa.index')
        ->with('success', 'Data siswa berhasil diupdate');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
{
    // Hapus folder penyimpanan

    Storage::disk('public')->deleteDirectory(
        'foto_profil_siswa/' . $siswa->id
    );

    Storage::disk('public')->deleteDirectory(
        'registrasi_wajah_siswa/' . $siswa->id
    );

    Storage::disk('public')->deleteDirectory(
        'absensi_masuk/' . $siswa->id
    );

    Storage::disk('public')->deleteDirectory(
        'absensi_pulang/' . $siswa->id
    );

    Storage::disk('public')->deleteDirectory(
        'logbook/' . $siswa->id
    );

    // Hapus data wajah

    if ($siswa->faceProfile) {

        $siswa->faceProfile
            ->images()
            ->delete();

        $siswa->faceProfile
            ->delete();
    }

    // Hapus logbook

    $siswa->logbooks()->delete();

    // Hapus penempatan PKL

    $siswa->penempatanPKL()->delete();

    // Hapus data siswa

    $user = $siswa->user;

    $siswa->delete();

    // Hapus akun user

    if ($user) {
        $user->delete();
    }

    return redirect()
        ->route('siswa.index')
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
    )->get();

    return response()->json(
        $kelas
    );
}

public function import(
    Request $request
)
{
    $request->validate([

        'file' => 'required|mimes:xlsx,xls'

    ]);

    Excel::import(

        new SiswaImport,

        $request->file('file')

    );

    return redirect()
        ->route(
            'siswa.index'
        )
        ->with(
            'success',
            'Data siswa berhasil diimport'
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

        Storage::disk('public')->deleteDirectory(

            'registrasi_wajah_siswa/' . $siswa->id

        );

        $faceProfile->images()->delete();

        $faceProfile->update([
            'is_registered' => false,
            'face_encoding_path' => null,
        ]);

        return back()->with(
            'success',
            'Registrasi wajah berhasil direset.'
        );

    } catch (\Exception $e) {

        return back()->with(
            'error',
            $e->getMessage()
        );
    }
}

public function uploadFace(Request $request, Siswa $siswa)
{
    $request->validate([
        'foto' => 'required',
        'foto.*' => 'image|mimes:jpg,jpeg,png|max:5120'
    ]);

    $profile = FaceProfile::firstOrCreate(
        [
            'siswa_id' => $siswa->id
        ],
        [
            'is_registered' => false
        ]
    );

    $jumlahFoto = FaceImage::where(
        'face_profile_id',
        $profile->id
    )->count();

    $files = $request->file('foto');

    // Cek apakah jumlah foto melebihi batas
    if (($jumlahFoto + count($files)) > 5) {

        return back()->with(
            'error',
            'Maksimal hanya 5 foto registrasi.'
        );

    }

    foreach ($files as $file) {

        $jumlahFoto++;

        $namaFile = 'wajah_' . $jumlahFoto . '.png';

        $path = $file->storeAs(
            'registrasi_wajah_siswa/' . $siswa->id,
            $namaFile,
            'public'
        );

        FaceImage::create([
            'face_profile_id' => $profile->id,
            'file_path' => $path
        ]);
    }

    if ($jumlahFoto >= 5) {

        $profile->update([
            'is_registered' => true,
            'registered_at' => now()
        ]);

    }

    return back()->with(
        'success',
        'Foto berhasil diupload.'
    );
}

}
