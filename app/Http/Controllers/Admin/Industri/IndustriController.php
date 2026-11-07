<?php

namespace App\Http\Controllers\Admin\Industri;

use App\Http\Controllers\Controller;
use App\Imports\PerusahaanImport;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class IndustriController extends Controller
{
    public function index(Request $request)
    {
        $query = Perusahaan::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where(
                    'nama_perusahaan',
                    'like',
                    "%{$search}%"
                )
                    ->orWhere(
                        'alamat',
                        'like',
                        "%{$search}%"
                    )
                    ->orWhere(
                        'telepon',
                        'like',
                        "%{$search}%"
                    )
                    ->orWhere(
                        'email',
                        'like',
                        "%{$search}%"
                    );
            });
        }

        $perusahaans = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalPerusahaan = Perusahaan::count();

        $totalDenganLokasi = Perusahaan::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->count();

        $totalTanpaLokasi =
            $totalPerusahaan - $totalDenganLokasi;

        return view(
            'admin.industri.index',
            compact(
                'perusahaans',
                'totalPerusahaan',
                'totalDenganLokasi',
                'totalTanpaLokasi'
            )
        );
    }

    public function create()
    {
        return view('admin.industri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => [
                'required',
                'string',
                'max:255',
            ],

            'alamat' => [
                'required',
                'string',
            ],

            'latitude' => [
                'nullable',
                'numeric',
                'between:-90,90',
            ],

            'longitude' => [
                'nullable',
                'numeric',
                'between:-180,180',
            ],

            'radius_absensi' => [
                'required',
                'integer',
                'min:10',
            ],

            'telepon' => [
                'nullable',
                'string',
                'max:30',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],
        ]);

        Perusahaan::create([
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat' => $request->alamat,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'radius_absensi' => $request->radius_absensi,
            'telepon' => $request->telepon,
            'email' => $request->email,
        ]);

        return redirect()
            ->route('admin.industri.index')
            ->with(
                'success',
                'Industri berhasil ditambahkan.'
            );
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => [
                'required',
                'file',
                'mimes:xlsx,xls,csv',
            ],
        ]);

        Excel::import(
            new PerusahaanImport,
            $request->file('file')
        );

        return redirect()
            ->route('admin.industri.index')
            ->with(
                'success',
                'Data industri berhasil diimport.'
            );
    }

    public function show(Perusahaan $perusahaan)
    {
        $perusahaan->load([
            'industris.user',
            'industris.penempatanPKL.siswa.user',
        ]);

        return view(
            'admin.industri.show',
            compact('perusahaan')
        );
    }

    public function edit(Perusahaan $perusahaan)
    {
        return view(
            'admin.industri.edit',
            compact('perusahaan')
        );
    }

    public function update(
        Request $request,
        Perusahaan $perusahaan
    ) {
        $request->validate([
            'nama_perusahaan' => [
                'required',
                'string',
                'max:255',
            ],

            'alamat' => [
                'required',
                'string',
            ],

            'latitude' => [
                'nullable',
                'numeric',
                'between:-90,90',
            ],

            'longitude' => [
                'nullable',
                'numeric',
                'between:-180,180',
            ],

            'radius_absensi' => [
                'required',
                'integer',
                'min:10',
            ],

            'telepon' => [
                'nullable',
                'string',
                'max:30',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],
        ]);

        $perusahaan->update([
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat' => $request->alamat,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'radius_absensi' => $request->radius_absensi,
            'telepon' => $request->telepon,
            'email' => $request->email,
        ]);

        return redirect()
            ->route('admin.industri.index')
            ->with(
                'success',
                'Data industri berhasil diperbarui.'
            );
    }

    public function destroy(Perusahaan $perusahaan)
    {
        if ($perusahaan->industris()->exists()) {

            return redirect()
                ->route('admin.industri.index')
                ->with(
                    'error',
                    'Industri tidak dapat dihapus karena masih memiliki pembimbing industri.'
                );
        }

        $perusahaan->delete();

        return redirect()
            ->route('admin.industri.index')
            ->with(
                'success',
                'Industri berhasil dihapus.'
            );
    }
}
