<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Logbook;
use App\Models\Absensi;
use App\Models\PenempatanPKL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Siswa;
use App\Models\PenilaianGuru;
use App\Models\PenilaianIndustri;
use App\Models\NilaiPKL;
use Barryvdh\DomPDF\Facade\Pdf;

class GuruDashboardController extends Controller
{
    public function index()
    {
        $guru = Guru::where(
            'user_id',
            Auth::id()
        )->first();

        $totalSiswa = PenempatanPKL::where(
            'guru_id',
            $guru->id
        )->count();

        $siswaIds = PenempatanPKL::where(
            'guru_id',
            $guru->id
        )->pluck('siswa_id');

        $logbookPending = Logbook::whereIn(
            'siswa_id',
            $siswaIds
        )
        ->where(
            'status_validasi',
            'pending'
        )
        ->count();

        $absensiHariIni = Absensi::whereIn(
            'siswa_id',
            $siswaIds
        )
        ->whereDate(
            'tanggal',
            now()
        )
        ->count();

        $siswaBimbingan = PenempatanPKL::with([
            'siswa.user',
            'perusahaan'
        ])
        ->where(
            'guru_id',
            $guru->id
        )
        ->latest()
        ->take(10)
        ->get();

        return view(
            'guru.dashboard',
            compact(
                'guru',
                'totalSiswa',
                'logbookPending',
                'absensiHariIni',
                'siswaBimbingan'
            )
        );
    }

    public function profil()
{
    $guru = Auth::user()->guru;

    return view(
        'guru.profil',
        compact('guru')
    );
}
public function updateProfil(
    Request $request
)
{
    $request->validate([

        'name' => 'required',

        'email' => 'required|email',

        'nip' => 'required',

        'no_hp' => 'nullable',

        'alamat' => 'nullable',

    ]);

    $user = Auth::user();

    $user->update([

        'name' => $request->name,

        'email' => $request->email,

    ]);

    $user->guru->update([

        'nip' => $request->nip,

        'no_hp' => $request->no_hp,

        'alamat' => $request->alamat,

    ]);

    if ($request->password) {

        $user->update([

            'password' => Hash::make(
                $request->password
            )

        ]);
    }

    return back()->with(
        'success',
        'Profil berhasil diperbarui'
    );
}


public function siswaBimbingan()
{
    $guru = auth()->user()->guru;

    $penempatans = PenempatanPKL::with([
        'siswa.user',
        'perusahaan'
    ])
    ->where(
        'guru_id',
        $guru->id
    )
    ->get();

    return view(
        'guru.siswa.index',
        compact('penempatans')
    );
}

public function detailSiswa(Siswa $siswa)
{
    $penempatan = PenempatanPKL::with(
        'perusahaan'
    )
    ->where(
        'siswa_id',
        $siswa->id
    )
    ->first();

    $absensis = Absensi::where(
        'siswa_id',
        $siswa->id
    )
    ->latest()
    ->take(10)
    ->get();

    $logbooks = Logbook::where(
        'siswa_id',
        $siswa->id
    )
    ->latest()
    ->take(10)
    ->get();

    return view(
        'guru.siswa.detail',
        compact(
            'siswa',
            'penempatan',
            'absensis',
            'logbooks'
        )
    );
}

public function detailAbsensi(
    Siswa $siswa
)
{
    $absensis = Absensi::where(
        'siswa_id',
        $siswa->id
    )
    ->latest()
    ->paginate(10);

    return view(
        'guru.siswa.absensi',
        compact(
            'siswa',
            'absensis'
        )
    );
}
public function detailLogbook(
    Siswa $siswa
)
{
    $logbooks = Logbook::where(
        'siswa_id',
        $siswa->id
    )
    ->latest()
    ->paginate(10);

    return view(
        'guru.siswa.logbook',
        compact(
            'siswa',
            'logbooks'
        )
    );
}
public function detailPenilaian(
    Siswa $siswa
)
{
    $penempatan = PenempatanPKL::where(
        'siswa_id',
        $siswa->id
    )->first();

    $penilaianGuru = null;
    $penilaianIndustri = null;
    $nilaiPKL = null;

    if ($penempatan) {

        $penilaianGuru =
            PenilaianGuru::where(
                'penempatan_pkl_id',
                $penempatan->id
            )->first();

        $penilaianIndustri =
            PenilaianIndustri::where(
                'penempatan_pkl_id',
                $penempatan->id
            )->first();

        $nilaiPKL =
            NilaiPKL::where(
                'penempatan_pkl_id',
                $penempatan->id
            )->first();
    }

    return view(
        'guru.siswa.penilaian',
        compact(
            'siswa',
            'penilaianGuru',
            'penilaianIndustri',
            'nilaiPKL'
        )
    );
}

public function cetakLaporan(
    Siswa $siswa
)
{
    $siswa->load([
        'user',
        'jurusan',
        'kelas'
    ]);

    $penempatan = PenempatanPKL::with([
        'guru.user',
        'industri.user',
        'perusahaan',
        'nilaiPKL',
        'penilaianIndustri',
        'penilaianGuru'
    ])
    ->where(
        'siswa_id',
        $siswa->id
    )
    ->first();

    $hadir = Absensi::where(
        'siswa_id',
        $siswa->id
    )->where(
        'status',
        'hadir'
    )->count();

    $izin = Absensi::where(
        'siswa_id',
        $siswa->id
    )->where(
        'status',
        'izin'
    )->count();

    $sakit = Absensi::where(
        'siswa_id',
        $siswa->id
    )->where(
        'status',
        'sakit'
    )->count();

    $alpha = Absensi::where(
        'siswa_id',
        $siswa->id
    )->where(
        'status',
        'alpha'
    )->count();

    $jumlahLogbook = Logbook::where(
        'siswa_id',
        $siswa->id
    )->count();

    $pdf = Pdf::loadView(
        'guru.pdf.laporan-siswa',
        compact(
            'siswa',
            'penempatan',
            'hadir',
            'izin',
            'sakit',
            'alpha',
            'jumlahLogbook'
        )
    );

    return $pdf->download(
        'Laporan-PKL-'.$siswa->user->name.'.pdf'
    );
}
public function editProfil()
{
    $guru = auth()->user()
        ->guru()
        ->with('user')
        ->first();

    return view(
        'guru.edit-profil',
        compact('guru')
    );
}

public function password()
{
    return view(
        'guru.password'
    );
}

public function updatePassword(
    Request $request
)
{
    $request->validate([

        'password_lama' =>
            'required',

        'password_baru' =>
            'required|min:6|confirmed'

    ]);

    $user = auth()->user();

    if (
        !Hash::check(
            $request->password_lama,
            $user->password
        )
    ) {

        return back()->with(
            'error',
            'Password lama salah'
        );

    }

    $user->update([

        'password' =>
            Hash::make(
                $request->password_baru
            )

    ]);

    return redirect()
        ->route('guru.profil')
        ->with(
            'success',
            'Password berhasil diubah'
        );
}
}