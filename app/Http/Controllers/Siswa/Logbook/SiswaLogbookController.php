<?php

namespace App\Http\Controllers\Siswa\Logbook;

use App\Http\Controllers\Controller;
use App\Models\Logbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SiswaLogbookController extends Controller
{
    /**
     * Menampilkan seluruh logbook siswa.
     */
    public function index()
    {
        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            abort(
                403,
                'Data siswa belum tersedia.'
            );
        }

        $logbooks = Logbook::with([
            'fotos',
        ])
            ->where(
                'siswa_id',
                $siswa->id
            )
            ->latest('tanggal')
            ->latest('id')
            ->paginate(10);

        $totalLogbook = Logbook::where(
            'siswa_id',
            $siswa->id
        )->count();

        $totalPending = Logbook::where(
            'siswa_id',
            $siswa->id
        )
            ->where(
                'status_validasi',
                'pending'
            )
            ->count();

        $totalDisetujui = Logbook::where(
            'siswa_id',
            $siswa->id
        )
            ->where(
                'status_validasi',
                'disetujui'
            )
            ->count();

        $totalDitolak = Logbook::where(
            'siswa_id',
            $siswa->id
        )
            ->where(
                'status_validasi',
                'ditolak'
            )
            ->count();

        return view(
            'siswa.logbook.index',
            compact(
                'logbooks',
                'totalLogbook',
                'totalPending',
                'totalDisetujui',
                'totalDitolak'
            )
        );
    }


    /**
     * Form tambah logbook.
     */
    public function create()
    {
        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            abort(
                403,
                'Data siswa belum tersedia.'
            );
        }

        return view(
            'siswa.logbook.create'
        );
    }


    /**
     * Menyimpan logbook baru.
     */
    public function store(Request $request)
    {
        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            abort(
                403,
                'Data siswa belum tersedia.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Validasi
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'tanggal' => [
                'required',
                'date'
            ],

            'kegiatan' => [
                'required',
                'string'
            ],

            'kendala' => [
                'nullable',
                'string'
            ],

            'solusi' => [
                'nullable',
                'string'
            ],

            'foto.*' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Simpan Logbook
        |--------------------------------------------------------------------------
        */

        $logbook = Logbook::create([

            'siswa_id' =>
            $siswa->id,

            'tanggal' =>
            $validated['tanggal'],

            'kegiatan' =>
            $validated['kegiatan'],

            'kendala' =>
            $validated['kendala'] ?? null,

            'solusi' =>
            $validated['solusi'] ?? null,

            'status_validasi' =>
            'pending',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Folder Foto
        |--------------------------------------------------------------------------
        |
        | Struktur:
        |
        | storage/app/public/logbook/
        | └── ID_SISWA/
        |     └── TANGGAL/
        |
        */

        $folderFoto =
            'logbook/' .
            $siswa->id .
            '/' .
            $validated['tanggal'];


        /*
        |--------------------------------------------------------------------------
        | Simpan Foto
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('foto')) {

            foreach ($request->file('foto') as $foto) {

                $path = $foto->store(
                    'logbook/' .
                        $siswa->id .
                        '/' .
                        $validated['tanggal'],
                    'public'
                );

                $logbook->fotos()->create([
                    'foto' => $path,
                ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'siswa.logbook.index'
            )
            ->with(
                'success',
                'Logbook berhasil ditambahkan.'
            );
    }


    /**
     * Menampilkan detail logbook.
     */
    public function show(
        Logbook $logbook
    ) {
        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            abort(
                403,
                'Data siswa belum tersedia.'
            );
        }

        $this->pastikanLogbookMilikSiswa(
            $siswa->id,
            $logbook
        );

        $logbook->load([
            'fotos',
        ]);

        return view(
            'siswa.logbook.show',
            compact(
                'logbook'
            )
        );
    }


    /**
     * Form edit logbook.
     */
    public function edit(
        Logbook $logbook
    ) {
        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            abort(
                403,
                'Data siswa belum tersedia.'
            );
        }

        $this->pastikanLogbookMilikSiswa(
            $siswa->id,
            $logbook
        );


        /*
        |--------------------------------------------------------------------------
        | Hanya logbook ditolak yang dapat diedit
        |--------------------------------------------------------------------------
        */

        if (
            $logbook->status_validasi !==
            'ditolak'
        ) {

            return redirect()
                ->route(
                    'siswa.logbook.show',
                    $logbook->id
                )
                ->with(
                    'error',
                    'Logbook hanya dapat diedit jika ditolak.'
                );
        }


        $logbook->load([
            'fotos',
        ]);

        return view(
            'siswa.logbook.edit',
            compact(
                'logbook'
            )
        );
    }


    /**
     * Update logbook.
     */
    public function update(
        Request $request,
        Logbook $logbook
    ) {
        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            abort(
                403,
                'Data siswa belum tersedia.'
            );
        }

        $this->pastikanLogbookMilikSiswa(
            $siswa->id,
            $logbook
        );


        /*
        |--------------------------------------------------------------------------
        | Hanya logbook ditolak yang dapat diedit
        |--------------------------------------------------------------------------
        */

        if (
            $logbook->status_validasi !==
            'ditolak'
        ) {

            return redirect()
                ->route(
                    'siswa.logbook.show',
                    $logbook->id
                )
                ->with(
                    'error',
                    'Logbook tidak dapat diedit.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Validasi
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'tanggal' => [
                'required',
                'date'
            ],

            'kegiatan' => [
                'required',
                'string'
            ],

            'kendala' => [
                'nullable',
                'string'
            ],

            'solusi' => [
                'nullable',
                'string'
            ],

            'foto.*' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Update Data Logbook
        |--------------------------------------------------------------------------
        */

        $logbook->update([

            'tanggal' =>
            $validated['tanggal'],

            'kegiatan' =>
            $validated['kegiatan'],

            'kendala' =>
            $validated['kendala'] ?? null,

            'solusi' =>
            $validated['solusi'] ?? null,

            'status_validasi' =>
            'pending',

            'catatan_guru' =>
            null,

        ]);


        /*
        |--------------------------------------------------------------------------
        | Folder Foto Baru
        |--------------------------------------------------------------------------
        */

        $folderFoto =
            'logbook/' .
            $siswa->id .
            '/' .
            $validated['tanggal'];


        /*
        |--------------------------------------------------------------------------
        | Simpan Foto Baru
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('foto')) {

            foreach (
                $request->file('foto')
                as $foto
            ) {

                $path = $foto->store(
                    $folderFoto,
                    'public'
                );


                $logbook->fotos()->create([

                    'foto' =>
                    $path,

                ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'siswa.logbook.show',
                $logbook->id
            )
            ->with(
                'success',
                'Logbook berhasil diperbarui dan dikirim kembali untuk validasi.'
            );
    }


    /**
     * Menghapus logbook.
     */
    public function destroy(
        Logbook $logbook
    ) {
        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            abort(
                403,
                'Data siswa belum tersedia.'
            );
        }

        $this->pastikanLogbookMilikSiswa(
            $siswa->id,
            $logbook
        );


        /*
        |--------------------------------------------------------------------------
        | Hanya pending / ditolak yang dapat dihapus
        |--------------------------------------------------------------------------
        */

        if (
            !in_array(
                $logbook->status_validasi,
                [
                    'pending',
                    'ditolak'
                ]
            )
        ) {

            return redirect()
                ->route(
                    'siswa.logbook.index'
                )
                ->with(
                    'error',
                    'Logbook yang sudah disetujui tidak dapat dihapus.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Hapus Foto
        |--------------------------------------------------------------------------
        */

        $logbook->load(
            'fotos'
        );


        foreach (
            $logbook->fotos as $foto
        ) {

            /*
            |----------------------------------------------------------------------
            | Database menyimpan:
            |
            | logbook/83/2026-07-21/foto.png
            |
            | Jadi langsung gunakan sebagai path disk public.
            |----------------------------------------------------------------------
            */

            $path = $foto->foto;


            if (
                $path &&
                Storage::disk('public')
                ->exists($path)
            ) {

                Storage::disk('public')
                    ->delete($path);
            }


            $foto->delete();
        }


        /*
        |--------------------------------------------------------------------------
        | Hapus Logbook
        |--------------------------------------------------------------------------
        */

        $logbook->delete();


        return redirect()
            ->route(
                'siswa.logbook.index'
            )
            ->with(
                'success',
                'Logbook berhasil dihapus.'
            );
    }


    /**
     * Memastikan logbook milik siswa yang login.
     */
    private function pastikanLogbookMilikSiswa(
        int $siswaId,
        Logbook $logbook
    ): void {

        if (
            $logbook->siswa_id !=
            $siswaId
        ) {

            abort(
                403,
                'Anda tidak memiliki akses ke logbook ini.'
            );
        }
    }
}
