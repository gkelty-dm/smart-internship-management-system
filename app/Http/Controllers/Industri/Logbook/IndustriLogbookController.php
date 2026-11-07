<?php

namespace App\Http\Controllers\Industri\Logbook;

use App\Http\Controllers\Controller;
use App\Models\Logbook;
use App\Models\PenempatanPKL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndustriLogbookController extends Controller
{
    /**
     * Menampilkan seluruh logbook
     * siswa PKL yang dibimbing industri login.
     */
    public function index()
    {
        $industri = Auth::user()->industri;

        if (!$industri) {
            abort(403, 'Data industri belum tersedia.');
        }

        $siswaIds = PenempatanPKL::where(
            'industri_id',
            $industri->id
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
            'industri.logbook.index',
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
        $industri = Auth::user()->industri;

        if (!$industri) {
            abort(403, 'Data industri belum tersedia.');
        }

        $this->pastikanLogbookMilikSiswaPKL(
            $industri->id,
            $logbook
        );

        $logbook->load([
            'siswa.user',
            'siswa.jurusan',
            'siswa.kelas',
            'fotos',
        ]);

        return view(
            'industri.logbook.show',
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
        $industri = Auth::user()->industri;

        if (!$industri) {
            abort(403, 'Data industri belum tersedia.');
        }

        $this->pastikanLogbookMilikSiswaPKL(
            $industri->id,
            $logbook
        );

        $request->validate([
            'status_validasi' => [
                'required',
                'in:disetujui,ditolak,pending'
            ],

            'catatan_industri' => [
                'nullable',
                'string'
            ],
        ]);

        $logbook->update([
            'status_validasi' =>
            $request->status_validasi,

            'catatan_industri' =>
            $request->catatan_industri,
        ]);

        return redirect()
            ->route(
                'industri.logbook.show',
                $logbook->id
            )
            ->with(
                'success',
                'Logbook berhasil diperbarui.'
            );
    }


    /**
     * Memastikan logbook berasal dari siswa
     * yang berada pada penempatan industri login.
     */
    private function pastikanLogbookMilikSiswaPKL(
        int $industriId,
        Logbook $logbook
    ): void {
        $ada = PenempatanPKL::where(
            'industri_id',
            $industriId
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
