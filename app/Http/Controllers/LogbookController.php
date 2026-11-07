<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logbook;
use App\Models\LogbookFoto;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\PenempatanPKL;

use App\Models\Jurusan;
use App\Models\Kelas;



class LogbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penilaians = PenilaianIndustri::with([
            'penempatan.siswa.user',
            'penempatan.perusahaan',
            'industri.user'
        ])
            ->latest()
            ->paginate(10);

        return view(
            'penilaian-industri.index',
            compact('penilaians')
        );
    }

    /**
     * Show the form for creating a new resource.
     */

    public function adminIndex(Request $request)
{
    $query = Logbook::with([
        'siswa.user',
        'siswa.jurusan',
        'siswa.kelas',
        'fotos'
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
    | Filter Tanggal
    |--------------------------------------------------------------------------
    */

    if ($request->filled('tanggal')) {

        $query->whereDate(
            'tanggal',
            $request->tanggal
        );

    }

    /*
    |--------------------------------------------------------------------------
    | Filter Status
    |--------------------------------------------------------------------------
    */

    if ($request->filled('status')) {

        $query->where(
            'status_validasi',
            $request->status
        );

    }

    /*
    |--------------------------------------------------------------------------
    | Statistik
    |--------------------------------------------------------------------------
    */

    $totalLogbook = Logbook::count();

    $pending = Logbook::where(
        'status_validasi',
        'pending'
    )->count();

    $disetujui = Logbook::where(
        'status_validasi',
        'disetujui'
    )->count();

    $ditolak = Logbook::where(
        'status_validasi',
        'ditolak'
    )->count();

    /*
    |--------------------------------------------------------------------------
    | Data
    |--------------------------------------------------------------------------
    */

    $logbooks = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    $jurusans = Jurusan::orderBy(
        'nama_jurusan'
    )->get();

    $kelas = Kelas::orderBy(
        'nama_kelas'
    )->get();

    return view(
        'logbook.logbook_admin',
        compact(
            'logbooks',
            'jurusans',
            'kelas',
            'totalLogbook',
            'pending',
            'disetujui',
            'ditolak'
        )
    );
}

public function adminValidasi(
    Request $request,
    Logbook $logbook
)
{
    $request->validate([

        'status_validasi' =>
        'required|in:pending,disetujui,ditolak',

        'catatan_guru' =>
        'nullable|string'

    ]);

    $logbook->update([

        'status_validasi' =>
        $request->status_validasi,

        'catatan_guru' =>
        $request->catatan_guru

    ]);

    return redirect()
        ->route('admin.logbook')
        ->with(
            'success',
            'Logbook berhasil divalidasi.'
        );
}


    public function create()
    {
        $siswas = Siswa::with('user')->get();

        return view(
            'logbook.create',
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
            'kegiatan' => 'required',
        ]);

        $logbook = Logbook::create([
            'siswa_id' => $request->siswa_id,
            'tanggal' => $request->tanggal,
            'kegiatan' => $request->kegiatan,
            'kendala' => $request->kendala,
            'solusi' => $request->solusi,
        ]);

        if ($request->hasFile('foto')) {

    foreach ($request->file('foto') as $foto) {

        $tanggal = $request->tanggal;

        $namaFoto =
            time() . '_' .
            $foto->getClientOriginalName();

        $pathFoto = $foto->storeAs(

            'logbook/' .
            $siswa->id .
            '/' .
            $tanggal,

            $namaFoto,

            'public'

        );

        LogbookFoto::create([

            'logbook_id' => $logbook->id,

            'foto' => $pathFoto

        ]);
    }
}

        return redirect()
            ->route('logbook.index')
            ->with('success', 'Logbook berhasil ditambahkan');
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
    public function edit(Logbook $logbook)
    {
        $siswas = Siswa::with('user')->get();

        return view(
            'logbook.edit',
            compact(
                'logbook',
                'siswas'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        Logbook $logbook
    ) {
        $request->validate([
            'siswa_id' => 'required',
            'tanggal' => 'required',
            'kegiatan' => 'required',
        ]);

        $logbook->update([
            'siswa_id' => $request->siswa_id,
            'tanggal' => $request->tanggal,
            'kegiatan' => $request->kegiatan,
            'kendala' => $request->kendala,
            'solusi' => $request->solusi,
        ]);

        return redirect()
            ->route('logbook.index')
            ->with('success', 'Logbook berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Logbook $logbook)
    {
        $logbook->delete();

        return redirect()
            ->route('logbook.index')
            ->with('success', 'Logbook berhasil dihapus');
    }

    public function siswaIndex()
    {
        $siswa = Auth::user()->siswa;

        $logbooks = Logbook::with('fotos')
            ->where(
                'siswa_id',
                $siswa->id
            )
            ->latest()
            ->paginate(10);

        return view(
            'siswa.logbook.index',
            compact('logbooks')
        );
    }

    public function siswaCreate()
    {
        $siswa = Auth::user()->siswa;

        $penempatan = $siswa->penempatanPKL;

        if (
            !$penempatan ||
            $penempatan->status_pkl != 'aktif'
        ) {
            return redirect()
                ->route('siswa.logbook')
                ->with(
                    'error',
                    'Anda belum memiliki PKL aktif.'
                );
        }

        return view(
            'siswa.logbook.create'
        );
    }

    public function siswaStore(Request $request)
    {
        $request->validate([

            'tanggal' => 'required|date',

            'kegiatan' => 'required',

            'kendala' => 'nullable',

            'solusi' => 'nullable',

            'foto.*' => 'image|max:2048'

        ]);

        $siswa = Auth::user()->siswa;

        $penempatan = $siswa->penempatanPKL;

        if (
            !$penempatan ||
            $penempatan->status_pkl != 'aktif'
        ) {
            return back()->with(
                'error',
                'Anda belum memiliki PKL aktif.'
            );
        }

        $logbook = Logbook::create([

            'siswa_id' => $siswa->id,

            'tanggal' => $request->tanggal,

            'kegiatan' => $request->kegiatan,

            'kendala' => $request->kendala,

            'solusi' => $request->solusi,

            'status_validasi' => 'pending'

        ]);

        if ($request->hasFile('foto')) {

    foreach ($request->file('foto') as $foto) {

        $namaFoto = time() . '_' . $foto->getClientOriginalName();

        $pathFoto = $foto->storeAs(
            'logbook/' .
            $siswa->id .
            '/' .
            $request->tanggal,
            $namaFoto,
            'public'
        );

        LogbookFoto::create([
            'logbook_id' => $logbook->id,
            'foto' => $pathFoto
        ]);
    }
}

        return redirect()
            ->route(
                'siswa.logbook'
            )
            ->with(
                'success',
                'Logbook berhasil ditambahkan'
            );
    }

    public function guruIndex()
    {
        $guru = Auth::user()->guru;

        $siswaIds = PenempatanPKL::where(
            'guru_id',
            $guru->id
        )->pluck('siswa_id');

        $logbooks = Logbook::with([
            'siswa.user'
        ])
            ->whereIn(
                'siswa_id',
                $siswaIds
            )
            ->latest()
            ->paginate(10);

        return view(
            'guru.logbook.index',
            compact('logbooks')
        );
    }

    public function guruShow(
        Logbook $logbook
    ) {
        $logbook->load([
            'siswa.user',
            'fotos'
        ]);

        return view(
            'guru.logbook.show',
            compact('logbook')
        );
    }

    public function validasiGuru(
        Request $request,
        Logbook $logbook
    ) {
        $request->validate([

            'status_validasi' =>
            'required|in:disetujui,ditolak',

            'catatan_guru' =>
            'nullable'

        ]);

        $logbook->update([

            'status_validasi' =>
            $request->status_validasi,

            'catatan_guru' =>
            $request->catatan_guru

        ]);

        return redirect()
            ->route(
                'guru.logbook'
            )
            ->with(
                'success',
                'Logbook berhasil divalidasi'
            );
    }
}
