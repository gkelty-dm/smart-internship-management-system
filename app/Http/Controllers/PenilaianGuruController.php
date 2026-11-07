<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenilaianGuru;
use App\Models\PenempatanPKL;
use Illuminate\Support\Facades\Auth;
use App\Models\Guru;
use App\Http\Controllers\NilaiPKLController;
use App\Models\Jurusan;
use App\Models\Kelas;

class PenilaianGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $penilaians = PenilaianGuru::with([
            'penempatan.siswa.user',
            'penempatan.perusahaan',
            'guru.user'
        ])
        ->latest()
        ->paginate(10);

        return view(
            'penilaian-guru.index',
            compact('penilaians')
        );
    }

    public function adminIndex(Request $request)
{
    $query = PenilaianGuru::with([
        'penempatan.siswa.user',
        'penempatan.siswa.jurusan',
        'penempatan.siswa.kelas',
        'penempatan.perusahaan',
        'guru.user'
    ]);

    /*
    |--------------------------------------------------------------------------
    | Filter Nama Siswa
    |--------------------------------------------------------------------------
    */

    if ($request->filled('search')) {

        $query->whereHas('penempatan.siswa.user', function ($q) use ($request) {

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

        $query->whereHas('penempatan.siswa', function ($q) use ($request) {

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

        $query->whereHas('penempatan.siswa', function ($q) use ($request) {

            $q->where(
                'kelas_id',
                $request->kelas
            );

        });

    }

    /*
    |--------------------------------------------------------------------------
    | Filter Guru
    |--------------------------------------------------------------------------
    */

    if ($request->filled('guru')) {

        $query->where(
            'guru_id',
            $request->guru
        );

    }

    /*
    |--------------------------------------------------------------------------
    | Filter Industri
    |--------------------------------------------------------------------------
    */

    if ($request->filled('perusahaan')) {

        $query->whereHas('penempatan', function ($q) use ($request) {

            $q->where(
                'perusahaan_id',
                $request->perusahaan
            );

        });

    }

    /*
    |--------------------------------------------------------------------------
    | Statistik
    |--------------------------------------------------------------------------
    */

    $totalPenilaian = PenilaianGuru::count();

    $nilaiA = PenilaianGuru::where('nilai_akhir', '>=', 90)->count();

    $nilaiB = PenilaianGuru::whereBetween(
        'nilai_akhir',
        [80, 89.99]
    )->count();

    $nilaiC = PenilaianGuru::whereBetween(
        'nilai_akhir',
        [70, 79.99]
    )->count();

    $nilaiD = PenilaianGuru::where(
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

    $gurus = Guru::with('user')
        ->orderBy('id')
        ->get();

    return view(
        'penilaian-guru.guru_admin',
        compact(
            'penilaians',
            'jurusans',
            'kelas',
            'gurus',
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
    PenilaianGuru $penilaianGuru
)
{
    $request->validate([

        'disiplin' => 'required|numeric|min:0|max:100',

        'kerjasama' => 'required|numeric|min:0|max:100',

        'inisiatif' => 'required|numeric|min:0|max:100',

        'tanggung_jawab' => 'required|numeric|min:0|max:100',

        'keterampilan' => 'required|numeric|min:0|max:100',

        'catatan' => 'nullable|string'

    ]);

    $nilaiAkhir = (

        $request->disiplin +

        $request->kerjasama +

        $request->inisiatif +

        $request->tanggung_jawab +

        $request->keterampilan

    ) / 5;

    $penilaianGuru->update([

        'disiplin' => $request->disiplin,

        'kerjasama' => $request->kerjasama,

        'inisiatif' => $request->inisiatif,

        'tanggung_jawab' => $request->tanggung_jawab,

        'keterampilan' => $request->keterampilan,

        'nilai_akhir' => $nilaiAkhir,

        'catatan' => $request->catatan

    ]);

    return redirect()
        ->route('admin.penilaian-guru')
        ->with(
            'success',
            'Penilaian guru berhasil diperbarui.'
        );
}

public function adminDestroy(
    PenilaianGuru $penilaianGuru
)
{
    $penilaianGuru->delete();

    return redirect()
        ->route('admin.penilaian-guru')
        ->with(
            'success',
            'Data penilaian berhasil dihapus.'
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
            'guru.user'
        ])->get();

        return view(
            'penilaian-guru.create',
            compact('penempatans')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'penempatan_pkl_id' => 'required',
            'disiplin' => 'required',
            'kerjasama' => 'required',
            'inisiatif' => 'required',
            'tanggung_jawab' => 'required',
            'keterampilan' => 'required',
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

        PenilaianGuru::create([
            'penempatan_pkl_id' => $penempatan->id,
            'guru_id' => $penempatan->guru_id,

            'disiplin' => $request->disiplin,
            'kerjasama' => $request->kerjasama,
            'inisiatif' => $request->inisiatif,
            'tanggung_jawab' => $request->tanggung_jawab,
            'keterampilan' => $request->keterampilan,

            'nilai_akhir' => $nilaiAkhir,
            'catatan' => $request->catatan,
        ]);
        NilaiPKLController::generateNilai(
    $penempatan->id
);

        return redirect()
            ->route('penilaian-guru.index')
            ->with(
                'success',
                'Penilaian guru berhasil disimpan'
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
    public function edit(
        PenilaianGuru $penilaianGuru
    )
    {
        $penempatans = PenempatanPKL::with([
            'siswa.user',
            'perusahaan',
            'guru.user'
        ])->get();

        return view(
            'penilaian-guru.edit',
            compact(
                'penilaianGuru',
                'penempatans'
            )
        );
    }

    public function update(
        Request $request,
        PenilaianGuru $penilaianGuru
    )
    {
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

        $penilaianGuru->update([
            'penempatan_pkl_id' => $penempatan->id,
            'guru_id' => $penempatan->guru_id,

            'disiplin' => $request->disiplin,
            'kerjasama' => $request->kerjasama,
            'inisiatif' => $request->inisiatif,
            'tanggung_jawab' => $request->tanggung_jawab,
            'keterampilan' => $request->keterampilan,

            'nilai_akhir' => $nilaiAkhir,
            'catatan' => $request->catatan,
        ]);

        NilaiPKLController::generateNilai(
    $penilaianGuru->penempatan_pkl_id
);

        return redirect()
            ->route('penilaian-guru.index')
            ->with(
                'success',
                'Penilaian guru berhasil diupdate'
            );
    }

    public function destroy(
        PenilaianGuru $penilaianGuru
    )
    {
        $penilaianGuru->delete();

        return redirect()
            ->route('penilaian-guru.index')
            ->with(
                'success',
                'Data berhasil dihapus'
            );
    }

    public function guruIndex()
{
    $guru = Auth::user()->guru;

    $penempatans = PenempatanPKL::with([
        'siswa.user',
        'perusahaan',
        'penilaianGuru'
    ])
    ->where(
        'guru_id',
        $guru->id
    )
    ->get();

    return view(
        'guru.penilaian.index',
        compact('penempatans')
    );
}

public function guruCreate(
    PenempatanPKL $penempatan
)
{
    return view(
        'guru.penilaian.create',
        compact('penempatan')
    );
}

public function guruStore(
    Request $request,
    PenempatanPKL $penempatan
)
{
    $request->validate([

        'disiplin' => 'required|numeric',

        'kerjasama' => 'required|numeric',

        'inisiatif' => 'required|numeric',

        'tanggung_jawab' => 'required|numeric',

        'keterampilan' => 'required|numeric',

    ]);

    $nilaiAkhir = (

        $request->disiplin +

        $request->kerjasama +

        $request->inisiatif +

        $request->tanggung_jawab +

        $request->keterampilan

    ) / 5;

    PenilaianGuru::updateOrCreate(

        [
            'penempatan_pkl_id' =>
                $penempatan->id
        ],

        [

            'guru_id' =>
                Auth::user()->guru->id,

            'disiplin' =>
                $request->disiplin,

            'kerjasama' =>
                $request->kerjasama,

            'inisiatif' =>
                $request->inisiatif,

            'tanggung_jawab' =>
                $request->tanggung_jawab,

            'keterampilan' =>
                $request->keterampilan,

            'nilai_akhir' =>
                $nilaiAkhir,

            'catatan' =>
                $request->catatan

        ]
    );

    return redirect()
        ->route(
            'guru.penilaian'
        )
        ->with(
            'success',
            'Penilaian berhasil disimpan'
        );
}

public function guruEdit(
    PenilaianGuru $penilaianGuru
)
{
    return view(
        'guru.penilaian.edit',
        compact('penilaianGuru')
    );
}

public function guruUpdate(
    Request $request,
    PenilaianGuru $penilaianGuru
)
{
    $request->validate([

        'disiplin' => 'required|numeric',

        'kerjasama' => 'required|numeric',

        'inisiatif' => 'required|numeric',

        'tanggung_jawab' => 'required|numeric',

        'keterampilan' => 'required|numeric',

    ]);

    $nilaiAkhir = (

        $request->disiplin +

        $request->kerjasama +

        $request->inisiatif +

        $request->tanggung_jawab +

        $request->keterampilan

    ) / 5;

    $penilaianGuru->update([

        'disiplin' =>
            $request->disiplin,

        'kerjasama' =>
            $request->kerjasama,

        'inisiatif' =>
            $request->inisiatif,

        'tanggung_jawab' =>
            $request->tanggung_jawab,

        'keterampilan' =>
            $request->keterampilan,

        'nilai_akhir' =>
            $nilaiAkhir,

        'catatan' =>
            $request->catatan

    ]);

    return redirect()
        ->route('guru.penilaian')
        ->with(
            'success',
            'Penilaian berhasil diupdate'
        );
}
}
