<?php

namespace App\Http\Controllers\Industri\SiswaBimbingan;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Logbook;
use App\Models\NilaiPKL;
use App\Models\PenempatanPKL;
use App\Models\PenilaianGuru;
use App\Models\PenilaianIndustri;
use App\Models\Siswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndustriSiswaBimbinganController extends Controller
{
    /**
     * Daftar siswa PKL yang dibimbing industri.
     */
    public function index()
    {
        $industri = Auth::user()->industri;

        abort_unless($industri, 403);

        $penempatans = PenempatanPKL::with([
            'siswa.user',
            'siswa.jurusan',
            'siswa.kelas',
            'perusahaan'
        ])
            ->where(
                'industri_id',
                $industri->id
            )
            ->latest()
            ->get();

        return view(
            'industri.siswa.index',
            compact('penempatans')
        );
    }


    /**
     * Detail siswa PKL.
     */
    public function detail(Siswa $siswa)
    {
        $industri = Auth::user()->industri;

        abort_unless($industri, 403);

        $penempatan = PenempatanPKL::with([
            'siswa.user',
            'siswa.jurusan',
            'siswa.kelas',
            'guru.user',
            'industri.user',
            'perusahaan'
        ])
            ->where(
                'industri_id',
                $industri->id
            )
            ->where(
                'siswa_id',
                $siswa->id
            )
            ->first();

        abort_unless($penempatan, 404);

        $siswa->load([
            'user',
            'jurusan',
            'kelas'
        ]);

        $absensis = Absensi::where(
            'siswa_id',
            $siswa->id
        )
            ->latest()
            ->take(10)
            ->get();

        $logbooks = Logbook::with(
            'fotos'
        )
            ->where(
                'siswa_id',
                $siswa->id
            )
            ->latest()
            ->take(10)
            ->get();

        return view(
            'industri.siswa.show',
            compact(
                'siswa',
                'penempatan',
                'absensis',
                'logbooks'
            )
        );
    }


    /**
     * Detail absensi siswa.
     */
    public function detailAbsensi(Siswa $siswa)
    {
        $industri = Auth::user()->industri;

        abort_unless($industri, 403);

        $penempatan = PenempatanPKL::where(
            'industri_id',
            $industri->id
        )
            ->where(
                'siswa_id',
                $siswa->id
            )
            ->first();

        abort_unless($penempatan, 404);

        $siswa->load([
            'user',
            'jurusan',
            'kelas'
        ]);

        $absensis = Absensi::where(
            'siswa_id',
            $siswa->id
        )
            ->latest('tanggal')
            ->paginate(10);

        return view(
            'industri.siswa.absensi',
            compact(
                'siswa',
                'absensis'
            )
        );
    }


    /**
     * Detail logbook siswa.
     */
    public function detailLogbook(Siswa $siswa)
    {
        $industri = Auth::user()->industri;

        abort_unless($industri, 403);

        $penempatan = PenempatanPKL::where(
            'industri_id',
            $industri->id
        )
            ->where(
                'siswa_id',
                $siswa->id
            )
            ->first();

        abort_unless($penempatan, 404);

        $siswa->load([
            'user',
            'jurusan',
            'kelas'
        ]);

        $logbooks = Logbook::with(
            'fotos'
        )
            ->where(
                'siswa_id',
                $siswa->id
            )
            ->latest('tanggal')
            ->paginate(10);

        return view(
            'industri.siswa.logbook',
            compact(
                'siswa',
                'logbooks'
            )
        );
    }


    /**
     * Detail penilaian siswa.
     */
    public function detailPenilaian(Siswa $siswa)
    {
        $industri = Auth::user()->industri;

        abort_unless($industri, 403);

        $penempatan = PenempatanPKL::with([
            'siswa.user',
            'siswa.jurusan',
            'siswa.kelas',
            'guru.user',
            'industri.user',
            'perusahaan',
            'penilaianGuru',
            'penilaianIndustri',
            'nilaiPKL'
        ])
            ->where(
                'industri_id',
                $industri->id
            )
            ->where(
                'siswa_id',
                $siswa->id
            )
            ->first();

        abort_unless($penempatan, 404);

        $siswa->load([
            'user',
            'jurusan',
            'kelas'
        ]);

        $penilaianGuru =
            $penempatan->penilaianGuru;

        $penilaianIndustri =
            $penempatan->penilaianIndustri;

        $nilaiPKL =
            $penempatan->nilaiPKL;

        return view(
            'industri.siswa.penilaian',
            compact(
                'siswa',
                'penempatan',
                'penilaianGuru',
                'penilaianIndustri',
                'nilaiPKL'
            )
        );
    }


    /**
     * Cetak / preview laporan siswa.
     */
    public function cetakLaporan(Siswa $siswa)
    {
        $industri = Auth::user()->industri;

        abort_unless($industri, 403);

        /*
        |--------------------------------------------------------------------------
        | Pastikan siswa merupakan siswa PKL di industri ini
        |--------------------------------------------------------------------------
        */

        $penempatan = PenempatanPKL::with([
            'siswa.user',
            'siswa.jurusan',
            'siswa.kelas',
            'guru.user',
            'industri.user',
            'perusahaan',
            'nilaiPKL',
            'penilaianGuru',
            'penilaianIndustri'
        ])
            ->where(
                'industri_id',
                $industri->id
            )
            ->where(
                'siswa_id',
                $siswa->id
            )
            ->first();

        abort_unless($penempatan, 404);


        /*
        |--------------------------------------------------------------------------
        | Data siswa
        |--------------------------------------------------------------------------
        */

        $siswa->load([
            'user',
            'jurusan',
            'kelas'
        ]);


        /*
        |--------------------------------------------------------------------------
        | Data absensi
        |--------------------------------------------------------------------------
        */

        $absensis = Absensi::where(
            'siswa_id',
            $siswa->id
        )
            ->orderBy(
                'tanggal',
                'asc'
            )
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Rekap absensi
        |--------------------------------------------------------------------------
        */

        $hadir = Absensi::where(
            'siswa_id',
            $siswa->id
        )
            ->where(
                'status',
                'hadir'
            )
            ->count();

        $izin = Absensi::where(
            'siswa_id',
            $siswa->id
        )
            ->where(
                'status',
                'izin'
            )
            ->count();

        $sakit = Absensi::where(
            'siswa_id',
            $siswa->id
        )
            ->where(
                'status',
                'sakit'
            )
            ->count();

        $alpha = Absensi::where(
            'siswa_id',
            $siswa->id
        )
            ->where(
                'status',
                'alpha'
            )
            ->count();

        $totalAbsensi = $absensis->count();


        /*
        |--------------------------------------------------------------------------
        | Data logbook
        |--------------------------------------------------------------------------
        */

        $logbooks = Logbook::with(
            'fotos'
        )
            ->where(
                'siswa_id',
                $siswa->id
            )
            ->orderBy(
                'tanggal',
                'asc'
            )
            ->get();

        $jumlahLogbook = $logbooks->count();


        /*
        |--------------------------------------------------------------------------
        | Rekap logbook
        |--------------------------------------------------------------------------
        */

        $logbookValid = Logbook::where(
            'siswa_id',
            $siswa->id
        )
            ->where(
                'status_validasi',
                'disetujui'
            )
            ->count();

        $logbookPending = Logbook::where(
            'siswa_id',
            $siswa->id
        )
            ->where(
                'status_validasi',
                'pending'
            )
            ->count();

        $logbookDitolak = Logbook::where(
            'siswa_id',
            $siswa->id
        )
            ->where(
                'status_validasi',
                'ditolak'
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Data penilaian
        |--------------------------------------------------------------------------
        */

        $penilaianGuru =
            $penempatan->penilaianGuru;

        $penilaianIndustri =
            $penempatan->penilaianIndustri;

        $nilaiPKL =
            $penempatan->nilaiPKL;


        /*
        |--------------------------------------------------------------------------
        | Generate PDF
        |--------------------------------------------------------------------------
        */

        $pdf = Pdf::loadView(
            'industri.pdf.laporan-siswa',
            compact(
                'industri',
                'siswa',
                'penempatan',
                'absensis',
                'hadir',
                'izin',
                'sakit',
                'alpha',
                'totalAbsensi',
                'logbooks',
                'jumlahLogbook',
                'logbookValid',
                'logbookPending',
                'logbookDitolak',
                'penilaianGuru',
                'penilaianIndustri',
                'nilaiPKL'
            )
        );


        /*
        |--------------------------------------------------------------------------
        | Ukuran PDF
        |--------------------------------------------------------------------------
        */

        $pdf->setPaper(
            'A4',
            'portrait'
        );


        /*
        |--------------------------------------------------------------------------
        | Preview PDF
        |--------------------------------------------------------------------------
        */

        return $pdf->stream(
            'Laporan-PKL-' .
                ($siswa->user->name ?? 'Siswa') .
                '.pdf'
        );
    }


    /**
     * Validasi logbook oleh pembimbing industri.
     */
    public function validasiIndustri(
        Request $request,
        Logbook $logbook
    ) {
        /*
        |--------------------------------------------------------------------------
        | Pastikan logbook milik siswa yang berada di industri ini
        |--------------------------------------------------------------------------
        */

        $industri = Auth::user()->industri;

        abort_unless($industri, 403);

        $penempatan = PenempatanPKL::where(
            'industri_id',
            $industri->id
        )
            ->where(
                'siswa_id',
                $logbook->siswa_id
            )
            ->first();

        abort_unless($penempatan, 404);


        /*
        |--------------------------------------------------------------------------
        | Validasi input
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'status_validasi' =>
            'required|in:disetujui,ditolak',

            'catatan_guru' =>
            'nullable|string'

        ]);


        /*
        |--------------------------------------------------------------------------
        | Update logbook
        |--------------------------------------------------------------------------
        */

        $logbook->update([

            'status_validasi' =>
            $request->status_validasi,

            'catatan_guru' =>
            $request->catatan_guru

        ]);


        /*
        |--------------------------------------------------------------------------
        | Kembali ke logbook industri
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'industri.logbook.index'
            )
            ->with(
                'success',
                'Logbook berhasil divalidasi.'
            );
    }
}
