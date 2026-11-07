<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Industri;
use App\Models\Perusahaan;
use App\Models\PenempatanPKL;
use App\Imports\PenempatanPKLImport;
use Maatwebsite\Excel\Facades\Excel;

class PenempatanPKLController extends Controller
{
    public function index()
    {
        $penempatans = PenempatanPKL::with([
            'siswa.user',
            'guru.user',
            'industri.user',
            'perusahaan'
        ])
        ->latest()
        ->paginate(10);

        return view(
            'penempatan-pkl.index',
            compact('penempatans')
        );
    }

   public function create()
{
    $siswas = Siswa::with('user')
        ->whereNotIn(
            'id',
            PenempatanPKL::where(
                'status_pkl',
                'aktif'
            )->pluck(
                'siswa_id'
            )
        )
        ->get();

    $gurus = Guru::with('user')->get();

    $industris = Industri::with([
        'user',
        'perusahaan'
    ])->get();

    $perusahaans = Perusahaan::all();

    return view(
        'penempatan-pkl.create',
        compact(
            'siswas',
            'gurus',
            'industris',
            'perusahaans'
        )
    );
}

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required',
            'guru_id' => 'required',
            'industri_id' => 'required',
            'perusahaan_id' => 'required',
            'tanggal_mulai' => 'required|date',
            'status_pkl' => 'required',
        ]);

        $cekPenempatan = PenempatanPKL::where(
    'siswa_id',
    $request->siswa_id
)
->where(
    'status_pkl',
    'aktif'
)
->exists();

if($cekPenempatan)
{
    return back()
        ->withInput()
        ->with(
            'error',
            'Siswa sudah memiliki penempatan PKL aktif.'
        );
}

        $industri = Industri::findOrFail(
            $request->industri_id
        );

        if (
            $industri->perusahaan_id !=
            $request->perusahaan_id
        ) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Pembimbing industri tidak sesuai dengan perusahaan yang dipilih.'
                );
        }

        PenempatanPKL::create([
            'siswa_id' => $request->siswa_id,
            'guru_id' => $request->guru_id,
            'industri_id' => $request->industri_id,
            'perusahaan_id' => $request->perusahaan_id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status_pkl' => $request->status_pkl,
        ]);

        return redirect()
            ->route('penempatan-pkl.index')
            ->with(
                'success',
                'Penempatan PKL berhasil ditambahkan'
            );
    }

    public function show(string $id)
    {
        //
    }

    public function edit(PenempatanPKL $penempatan_pkl)
    {
        $siswas = Siswa::with('user')->get();

        $gurus = Guru::with('user')->get();

        $industris = Industri::with([
            'user',
            'perusahaan'
        ])->get();

        $perusahaans = Perusahaan::all();

        return view(
            'penempatan-pkl.edit',
            compact(
                'penempatan_pkl',
                'siswas',
                'gurus',
                'industris',
                'perusahaans'
            )
        );
    }

    public function update(
        Request $request,
        PenempatanPKL $penempatan_pkl
    )
    {
        $request->validate([
            'siswa_id' => 'required',
            'guru_id' => 'required',
            'industri_id' => 'required',
            'perusahaan_id' => 'required',
            'tanggal_mulai' => 'required|date',
            'status_pkl' => 'required',
        ]);

        $industri = Industri::findOrFail(
            $request->industri_id
        );

        if (
            $industri->perusahaan_id !=
            $request->perusahaan_id
        ) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Pembimbing industri tidak sesuai dengan perusahaan yang dipilih.'
                );
        }

        $penempatan_pkl->update([
            'siswa_id' => $request->siswa_id,
            'guru_id' => $request->guru_id,
            'industri_id' => $request->industri_id,
            'perusahaan_id' => $request->perusahaan_id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status_pkl' => $request->status_pkl,
        ]);

        return redirect()
            ->route('penempatan-pkl.index')
            ->with(
                'success',
                'Data penempatan berhasil diupdate'
            );
    }

    public function destroy(PenempatanPKL $penempatan_pkl)
    {
        $penempatan_pkl->delete();

        return redirect()
            ->route('penempatan-pkl.index')
            ->with(
                'success',
                'Data penempatan berhasil dihapus'
            );
    }

    public function import(Request $request)
{
    $request->validate([

        'file' => 'required|mimes:xlsx,xls'

    ]);

    Excel::import(

        new PenempatanPKLImport,

        $request->file('file')

    );

    return redirect()
        ->route(
            'penempatan-pkl.index'
        )
        ->with(
            'success',
            'Data penempatan berhasil diimport'
        );
}
}