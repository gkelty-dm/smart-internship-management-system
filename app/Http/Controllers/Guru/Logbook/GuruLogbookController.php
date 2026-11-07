<?php

namespace App\Http\Controllers\Guru\Logbook;

use App\Http\Controllers\Controller;
use App\Models\Logbook;
use App\Models\PenempatanPKL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruLogbookController extends Controller
{
    /**
     * Menampilkan seluruh logbook
     * siswa yang dibimbing guru login.
     */
    public function index()
    {
        $guru = Auth::user()->guru;

        if (!$guru) {
            abort(403, 'Data guru belum tersedia.');
        }

        $siswaIds = PenempatanPKL::where(
            'guru_id',
            $guru->id
        )->pluck('siswa_id');

        $logbooks = Logbook::with([
            'siswa.user',
            'siswa.jurusan',
            'siswa.kelas',
            'fotos',
        ])
            ->whereIn(
                'siswa_id',
                $siswaIds
            )
            ->latest('tanggal')
            ->latest('id')
            ->paginate(15);

        $totalLogbook = Logbook::whereIn(
            'siswa_id',
            $siswaIds
        )->count();

        $totalPending = Logbook::whereIn(
            'siswa_id',
            $siswaIds
        )
            ->where(
                'status_validasi',
                'pending'
            )
            ->count();

        $totalDisetujui = Logbook::whereIn(
            'siswa_id',
            $siswaIds
        )
            ->where(
                'status_validasi',
                'disetujui'
            )
            ->count();

        return view(
            'guru.logbook.index',
            compact(
                'logbooks',
                'totalLogbook',
                'totalPending',
                'totalDisetujui'
            )
        );
    }


    /**
     * Menampilkan detail satu logbook.
     */
    public function show(Logbook $logbook)
    {
        $guru = Auth::user()->guru;

        if (!$guru) {
            abort(403, 'Data guru belum tersedia.');
        }

        $this->pastikanLogbookMilikSiswaBimbingan(
            $guru->id,
            $logbook
        );

        $logbook->load([
            'siswa.user',
            'siswa.jurusan',
            'siswa.kelas',
            'fotos',
        ]);

        return view(
            'guru.logbook.show',
            compact('logbook')
        );
    }


    /**
     * Validasi logbook siswa.
     */
    public function validasi(
        Request $request,
        Logbook $logbook
    ) {
        $guru = Auth::user()->guru;

        if (!$guru) {
            abort(403, 'Data guru belum tersedia.');
        }

        $this->pastikanLogbookMilikSiswaBimbingan(
            $guru->id,
            $logbook
        );

        $request->validate([
            'status_validasi' => [
                'required',
                'in:disetujui,ditolak,pending'
            ],

            'catatan_guru' => [
                'nullable',
                'string'
            ],
        ]);

        $logbook->update([
            'status_validasi' =>
            $request->status_validasi,

            'catatan_guru' =>
            $request->catatan_guru,
        ]);

        return redirect()
            ->route(
                'guru.logbook.show',
                $logbook->id
            )
            ->with(
                'success',
                'Logbook berhasil diperbarui.'
            );
    }


    /**
     * Memastikan logbook berasal dari siswa
     * yang dibimbing guru login.
     */
    private function pastikanLogbookMilikSiswaBimbingan(
        int $guruId,
        Logbook $logbook
    ): void {
        $ada = PenempatanPKL::where(
            'guru_id',
            $guruId
        )
            ->where(
                'siswa_id',
                $logbook->siswa_id
            )
            ->exists();

        if (!$ada) {
            abort(
                403,
                'Anda tidak memiliki akses ke logbook ini.'
            );
        }
    }
}
