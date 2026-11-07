<?php

namespace App\Http\Controllers\Guru\SiswaBimbingan;

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

class GuruSiswaBimbinganController extends Controller
{
    /**
     * Daftar siswa bimbingan guru.
     */
    public function index()
    {
        $guru = Auth::user()->guru;

        abort_unless($guru, 403);

        $penempatans = PenempatanPKL::with([
            'siswa.user',
            'siswa.jurusan',
            'siswa.kelas',
            'perusahaan'
        ])
            ->where('guru_id', $guru->id)
            ->latest()
            ->get();

        return view(
            'guru.siswa.index',
            compact('penempatans')
        );
    }


    /**
     * Detail siswa bimbingan.
     */
    public function detail(Siswa $siswa)
    {
        $guru = Auth::user()->guru;

        abort_unless($guru, 403);

        $penempatan = PenempatanPKL::with([
            'siswa.user',
            'siswa.jurusan',
            'siswa.kelas',
            'guru.user',
            'industri.user',
            'perusahaan'
        ])
            ->where('guru_id', $guru->id)
            ->where('siswa_id', $siswa->id)
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
            'guru.siswa.show',
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
        $guru = Auth::user()->guru;

        abort_unless($guru, 403);

        $penempatan = PenempatanPKL::where(
            'guru_id',
            $guru->id
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
            'guru.siswa.absensi',
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
        $guru = Auth::user()->guru;

        abort_unless($guru, 403);

        $penempatan = PenempatanPKL::where(
            'guru_id',
            $guru->id
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
            'guru.siswa.logbook',
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
        $guru = Auth::user()->guru;

        abort_unless($guru, 403);

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
                'guru_id',
                $guru->id
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
            'guru.siswa.penilaian',
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
     * Cetak laporan siswa.
     */
    public function cetakLaporan(Siswa $siswa)
    {
        $guru = Auth::user()->guru;

        abort_unless($guru, 403);

        /*
        |--------------------------------------------------------------------------
        | Pastikan siswa merupakan siswa bimbingan guru
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
                'guru_id',
                $guru->id
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
            'guru.pdf.laporan-siswa',
            compact(
                'guru',
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
     * Validasi logbook oleh guru.
     */
    public function validasiGuru(
        Request $request,
        Logbook $logbook
    ) {
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
        | Kembali
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'guru.logbook'
            )
            ->with(
                'success',
                'Logbook berhasil divalidasi.'
            );
    }
}
