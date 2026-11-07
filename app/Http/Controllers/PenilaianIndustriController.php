<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenempatanPKL;
use App\Models\Industri;
use App\Models\PenilaianIndustri;
use App\Http\Controllers\NilaiPKLController;
use App\Models\Jurusan;
use App\Models\Kelas;



class PenilaianIndustriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penilaians = PenilaianIndustri::with([
            'penempatan.siswa.user',
            'industri.user'
        ])
            ->latest()
            ->paginate(10);

        return view(
            'penilaian-industri.index',
            compact('penilaians')
        );
    }

    public function adminIndex(Request $request)
{
    $query = PenilaianIndustri::with([
        'penempatan.siswa.user',
        'penempatan.siswa.jurusan',
        'penempatan.siswa.kelas',
        'penempatan.perusahaan',
        'industri.user'
    ]);

    /*
    |--------------------------------------------------------------------------
    | Filter Nama
    |--------------------------------------------------------------------------
    */

    if ($request->filled('search')) {

        $query->whereHas(
            'penempatan.siswa.user',
            function ($q) use ($request) {

                $q->where(
                    'name',
                    'like',
                    '%' . $request->search . '%'
                );

            }
        );

    }

    /*
    |--------------------------------------------------------------------------
    | Filter Jurusan
    |--------------------------------------------------------------------------
    */

    if ($request->filled('jurusan')) {

        $query->whereHas(
            'penempatan.siswa',
            function ($q) use ($request) {

                $q->where(
                    'jurusan_id',
                    $request->jurusan
                );

            }
        );

    }

    /*
    |--------------------------------------------------------------------------
    | Filter Kelas
    |--------------------------------------------------------------------------
    */

    if ($request->filled('kelas')) {

        $query->whereHas(
            'penempatan.siswa',
            function ($q) use ($request) {

                $q->where(
                    'kelas_id',
                    $request->kelas
                );

            }
        );

    }

    /*
    |--------------------------------------------------------------------------
    | Filter Industri
    |--------------------------------------------------------------------------
    */

    if ($request->filled('industri')) {

        $query->where(
            'industri_id',
            $request->industri
        );

    }

    /*
    |--------------------------------------------------------------------------
    | Statistik
    |--------------------------------------------------------------------------
    */

    $totalPenilaian = PenilaianIndustri::count();

    $nilaiA = PenilaianIndustri::where(
        'nilai_akhir',
        '>=',
        90
    )->count();

    $nilaiB = PenilaianIndustri::whereBetween(
        'nilai_akhir',
        [80,89.99]
    )->count();

    $nilaiC = PenilaianIndustri::whereBetween(
        'nilai_akhir',
        [70,79.99]
    )->count();

    $nilaiD = PenilaianIndustri::where(
        'nilai_akhir',
        '<',
        70
    )->count();

    /*
    |--------------------------------------------------------------------------
    | Data
    |--------------------------------------------------------------------------
    */

    $penilaians = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    $jurusans = Jurusan::orderBy(
        'nama_jurusan'
    )->get();

    $kelas = Kelas::orderBy(
        'nama_kelas'
    )->get();

    $industris = Industri::with('user')
        ->orderBy('id')
        ->get();

    return view(
        'penilaian-industri.industri_admin',
        compact(
            'penilaians',
            'jurusans',
            'kelas',
            'industris',
            'totalPenilaian',
            'nilaiA',
            'nilaiB',
            'nilaiC',
            'nilaiD'
        )
    );
}

public function adminUpdate(
    Request $request,
    PenilaianIndustri $penilaianIndustri
)
{
    $request->validate([

        'disiplin'=>'required|numeric|min:0|max:100',
        'kerjasama'=>'required|numeric|min:0|max:100',
        'inisiatif'=>'required|numeric|min:0|max:100',
        'tanggung_jawab'=>'required|numeric|min:0|max:100',
        'keterampilan'=>'required|numeric|min:0|max:100',
        'catatan'=>'nullable'

    ]);

    $nilaiAkhir = (

        $request->disiplin +

        $request->kerjasama +

        $request->inisiatif +

        $request->tanggung_jawab +

        $request->keterampilan

    ) / 5;

    $penilaianIndustri->update([

        'disiplin'=>$request->disiplin,

        'kerjasama'=>$request->kerjasama,

        'inisiatif'=>$request->inisiatif,

        'tanggung_jawab'=>$request->tanggung_jawab,

        'keterampilan'=>$request->keterampilan,

        'nilai_akhir'=>$nilaiAkhir,

        'catatan'=>$request->catatan

    ]);

    NilaiPKLController::generateNilai(
        $penilaianIndustri->penempatan_pkl_id
    );

    return redirect()
        ->route('admin.penilaian-industri')
        ->with(
            'success',
            'Penilaian industri berhasil diperbarui.'
        );
}

public function adminDestroy(
    PenilaianIndustri $penilaianIndustri
)
{
    $penilaianIndustri->delete();

    return redirect()
        ->route('admin.penilaian-industri')
        ->with(
            'success',
            'Data berhasil dihapus.'
        );
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $penempatans = PenempatanPKL::with([
            'siswa.user',
            'perusahaan',
            'industri.user'
        ])->get();

        return view(
            'penilaian-industri.create',
            compact('penempatans')
        );
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'penempatan_pkl_id' => 'required',
            'disiplin' => 'required|numeric|min:0|max:100',
            'kerjasama' => 'required|numeric|min:0|max:100',
            'inisiatif' => 'required|numeric|min:0|max:100',
            'tanggung_jawab' => 'required|numeric|min:0|max:100',
            'keterampilan' => 'required|numeric|min:0|max:100',
        ]);

        $penempatan = PenempatanPKL::findOrFail(
            $request->penempatan_pkl_id
        );

        $nilaiAkhir = (
            $request->disiplin +
            $request->kerjasama +
            $request->inisiatif +
            $request->tanggung_jawab +
            $request->keterampilan
        ) / 5;

        PenilaianIndustri::create([

            'penempatan_pkl_id' => $penempatan->id,

            'industri_id' => $penempatan->industri_id,

            'disiplin' => $request->disiplin,

            'kerjasama' => $request->kerjasama,

            'inisiatif' => $request->inisiatif,

            'tanggung_jawab' => $request->tanggung_jawab,

            'keterampilan' => $request->keterampilan,

            'nilai_akhir' => $nilaiAkhir,

            'catatan' => $request->catatan

        ]);

        NilaiPKLController::generateNilai(
            $penempatan->id
        );

        return redirect()
            ->route('penilaian-industri.index')
            ->with(
                'success',
                'Penilaian berhasil disimpan'
            );
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
    public function edit(PenilaianIndustri $penilaianIndustri)
    {
        $penempatans = PenempatanPKL::with([
            'siswa.user',
            'perusahaan',
            'industri.user'
        ])->get();

        return view(
            'penilaian-industri.edit',
            compact(
                'penilaianIndustri',
                'penempatans'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        PenilaianIndustri $penilaianIndustri
    ) {
        $request->validate([
            'penempatan_pkl_id' => 'required',
            'disiplin' => 'required|numeric|min:0|max:100',
            'kerjasama' => 'required|numeric|min:0|max:100',
            'inisiatif' => 'required|numeric|min:0|max:100',
            'tanggung_jawab' => 'required|numeric|min:0|max:100',
            'keterampilan' => 'required|numeric|min:0|max:100',
        ]);

        $penempatan = PenempatanPKL::findOrFail(
            $request->penempatan_pkl_id
        );

        $nilaiAkhir = (
            $request->disiplin +
            $request->kerjasama +
            $request->inisiatif +
            $request->tanggung_jawab +
            $request->keterampilan
        ) / 5;

        $penilaianIndustri->update([

            'penempatan_pkl_id' => $penempatan->id,

            'industri_id' => $penempatan->industri_id,

            'disiplin' => $request->disiplin,

            'kerjasama' => $request->kerjasama,

            'inisiatif' => $request->inisiatif,

            'tanggung_jawab' => $request->tanggung_jawab,

            'keterampilan' => $request->keterampilan,

            'nilai_akhir' => $nilaiAkhir,

            'catatan' => $request->catatan

        ]);

        NilaiPKLController::generateNilai(
            $penempatan->id
        );

        return redirect()
            ->route('penilaian-industri.index')
            ->with(
                'success',
                'Penilaian berhasil diupdate'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        PenilaianIndustri $penilaianIndustri
    ) {
        $penilaianIndustri->delete();

        return redirect()
            ->route(
                'penilaian-industri.index'
            )
            ->with(
                'success',
                'Data berhasil dihapus'
            );
    }
}
