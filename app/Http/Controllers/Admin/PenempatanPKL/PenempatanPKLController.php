<?php

namespace App\Http\Controllers\Admin\PenempatanPKL;

use App\Http\Controllers\Controller;
use App\Models\PenempatanPKL;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Industri;
use App\Models\Perusahaan;
use Illuminate\Http\Request;

class PenempatanPKLController extends Controller
{
    public function index(Request $request)
    {
        $query = PenempatanPKL::with([
            'siswa.user',
            'siswa.kelas',
            'siswa.jurusan',
            'guru.user',
            'industri.user',
            'perusahaan',
        ]);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->whereHas('siswa.user', function ($user) use ($search) {
                    $user->where('name', 'like', "%{$search}%");
                });

                $q->orWhereHas('guru.user', function ($user) use ($search) {
                    $user->where('name', 'like', "%{$search}%");
                });

                $q->orWhereHas('industri.user', function ($user) use ($search) {
                    $user->where('name', 'like', "%{$search}%");
                });

                $q->orWhereHas('perusahaan', function ($perusahaan) use ($search) {
                    $perusahaan->where(
                        'nama_perusahaan',
                        'like',
                        "%{$search}%"
                    );
                });
            });
        }

        if ($request->filled('status_pkl')) {
            $query->where(
                'status_pkl',
                $request->status_pkl
            );
        }

        $penempatans = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalPenempatan = PenempatanPKL::count();

        $totalAktif = PenempatanPKL::where(
            'status_pkl',
            'aktif'
        )->count();

        $totalPending = PenempatanPKL::where(
            'status_pkl',
            'pending'
        )->count();

        $totalSelesai = PenempatanPKL::where(
            'status_pkl',
            'selesai'
        )->count();

        return view(
            'admin.penempatan-pkl.index',
            compact(
                'penempatans',
                'totalPenempatan',
                'totalAktif',
                'totalPending',
                'totalSelesai'
            )
        );
    }

    public function create()
    {
        $siswas = Siswa::with([
            'user',
            'kelas',
            'jurusan',
        ])
            ->orderBy('id', 'desc')
            ->get();

        $gurus = Guru::with('user')
            ->orderBy('id', 'desc')
            ->get();

        $perusahaans = Perusahaan::orderBy(
            'nama_perusahaan'
        )->get();

        $industris = Industri::with([
            'user',
            'perusahaan',
        ])
            ->orderBy('id', 'desc')
            ->get();

        return view(
            'admin.penempatan-pkl.create',
            compact(
                'siswas',
                'gurus',
                'perusahaans',
                'industris'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'siswa_id' => [
                'required',
                'exists:siswas,id',
            ],

            'guru_id' => [
                'required',
                'exists:gurus,id',
            ],

            'industri_id' => [
                'nullable',
                'exists:industris,id',
            ],

            'perusahaan_id' => [
                'required',
                'exists:perusahaans,id',
            ],

            'tanggal_mulai' => [
                'nullable',
                'date',
            ],

            'tanggal_selesai' => [
                'nullable',
                'date',
                'after_or_equal:tanggal_mulai',
            ],

            'status_pkl' => [
                'required',
                'in:pending,aktif,selesai,dibatalkan',
            ],

        ]);

        $sudahAda = PenempatanPKL::where(
            'siswa_id',
            $request->siswa_id
        )
            ->whereIn('status_pkl', [
                'pending',
                'aktif',
            ])
            ->exists();

        if ($sudahAda) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Siswa tersebut masih memiliki penempatan PKL yang aktif atau pending.'
                );
        }

        PenempatanPKL::create([

            'siswa_id' =>
            $request->siswa_id,

            'guru_id' =>
            $request->guru_id,

            'industri_id' =>
            $request->industri_id,

            'perusahaan_id' =>
            $request->perusahaan_id,

            'tanggal_mulai' =>
            $request->tanggal_mulai,

            'tanggal_selesai' =>
            $request->tanggal_selesai,

            'status_pkl' =>
            $request->status_pkl,

        ]);

        return redirect()
            ->route('admin.penempatan-pkl.index')
            ->with(
                'success',
                'Penempatan PKL berhasil ditambahkan.'
            );
    }

    public function show(PenempatanPKL $penempatan_pkl)
    {
        $penempatan_pkl->load([
            'siswa.user',
            'siswa.kelas',
            'siswa.jurusan',
            'guru.user',
            'industri.user',
            'industri.perusahaan',
            'perusahaan',
        ]);

        $penempatan = $penempatan_pkl;

        return view(
            'admin.penempatan-pkl.show',
            compact('penempatan')
        );
    }

    public function edit($id)
    {
        $penempatan = PenempatanPKL::with([
            'siswa.user',
            'siswa.kelas',
            'siswa.jurusan',
            'guru.user',
            'industri.user',
            'perusahaan',
        ])->findOrFail($id);

        $siswas = Siswa::with([
            'user',
            'kelas',
            'jurusan',
        ])
            ->orderBy('id', 'desc')
            ->get();

        $gurus = Guru::with('user')
            ->orderBy('id', 'desc')
            ->get();

        $perusahaans = Perusahaan::orderBy(
            'nama_perusahaan'
        )->get();

        $industris = Industri::with([
            'user',
            'perusahaan',
        ])
            ->orderBy('id', 'desc')
            ->get();

        return view(
            'admin.penempatan-pkl.edit',
            compact(
                'penempatan',
                'siswas',
                'gurus',
                'perusahaans',
                'industris'
            )
        );
    }

    public function update(
        Request $request,
        PenempatanPKL $penempatan_pkl
    ) {
        $request->validate([

            'siswa_id' => [
                'required',
                'exists:siswas,id',
            ],

            'guru_id' => [
                'required',
                'exists:gurus,id',
            ],

            'industri_id' => [
                'nullable',
                'exists:industris,id',
            ],

            'perusahaan_id' => [
                'required',
                'exists:perusahaans,id',
            ],

            'tanggal_mulai' => [
                'nullable',
                'date',
            ],

            'tanggal_selesai' => [
                'nullable',
                'date',
                'after_or_equal:tanggal_mulai',
            ],

            'status_pkl' => [
                'required',
                'in:pending,aktif,selesai,dibatalkan',
            ],

        ]);

        /*
        |--------------------------------------------------------------------------
        | Pastikan pembimbing industri memang milik perusahaan yang dipilih
        |--------------------------------------------------------------------------
        */

        if ($request->filled('industri_id')) {

            $industri = Industri::find(
                $request->industri_id
            );

            if (
                !$industri ||
                $industri->perusahaan_id != $request->perusahaan_id
            ) {

                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'Pembimbing industri tidak sesuai dengan perusahaan yang dipilih.'
                    );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Cek siswa
        |--------------------------------------------------------------------------
        */

        $sudahAda = PenempatanPKL::where(
            'siswa_id',
            $request->siswa_id
        )
            ->where(
                'id',
                '!=',
                $penempatan_pkl->id
            )
            ->whereIn('status_pkl', [
                'pending',
                'aktif',
            ])
            ->exists();

        if ($sudahAda) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Siswa tersebut sudah memiliki penempatan PKL lain yang aktif atau pending.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Update data
        |--------------------------------------------------------------------------
        */

        $penempatan_pkl->update([

            'siswa_id' =>
            $request->siswa_id,

            'guru_id' =>
            $request->guru_id,

            'industri_id' =>
            $request->industri_id,

            'perusahaan_id' =>
            $request->perusahaan_id,

            'tanggal_mulai' =>
            $request->tanggal_mulai,

            'tanggal_selesai' =>
            $request->tanggal_selesai,

            'status_pkl' =>
            $request->status_pkl,

        ]);

        return redirect()
            ->route('admin.penempatan-pkl.index')
            ->with(
                'success',
                'Penempatan PKL berhasil diperbarui.'
            );
    }

    public function destroy(PenempatanPKL $penempatan_pkl)
    {
        $penempatan_pkl->delete();

        if ($penempatan_pkl->exists) {

            return redirect()
                ->route('admin.penempatan-pkl.index')
                ->with(
                    'error',
                    'Data Penempatan PKL gagal dihapus.'
                );
        }

        return redirect()
            ->route('admin.penempatan-pkl.index')
            ->with(
                'success',
                'Penempatan PKL berhasil dihapus.'
            );
    }
}
