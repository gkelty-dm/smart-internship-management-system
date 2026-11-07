<?php

namespace App\Http\Controllers;

use App\Models\PenempatanPKL;
use App\Models\Logbook;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Absensi;
use App\Models\PenilaianIndustri;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\NilaiPKLController;
use App\Models\NilaiPKL;
use Barryvdh\DomPDF\Facade\Pdf;


class IndustriDashboardController extends Controller
{
    public function index()
    {
        $industri = auth()->user()->industri;

        $jumlahSiswa = PenempatanPKL::where(
            'industri_id',
            $industri->id
        )->count();

        $penempatans = PenempatanPKL::with([
            'siswa.user',
            'perusahaan'
        ])
        ->where(
            'industri_id',
            $industri->id
        )
        ->latest()
        ->get();

        return view(
            'industri.dashboard',
            compact(
                'jumlahSiswa',
                'penempatans'
            )
        );
    }

    public function siswaPKL()
{
    $industri = auth()->user()->industri;

    $penempatans = PenempatanPKL::with([
        'siswa.user',
        'guru.user',
        'perusahaan'
    ])
    ->where(
        'perusahaan_id',
        $industri->perusahaan_id
    )
    ->get();

    return view(
        'industri.siswa.index',
        compact('penempatans')
    );
}

public function detailSiswa(
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
        'nilaiPKL'
    ])
    ->where(
        'siswa_id',
        $siswa->id
    )
    ->first();

    $totalAbsensi = Absensi::where(
        'siswa_id',
        $siswa->id
    )->count();

    $totalLogbook = Logbook::where(
        'siswa_id',
        $siswa->id
    )->count();

    return view(
        'industri.siswa.detail',
        compact(
            'siswa',
            'penempatan',
            'totalAbsensi',
            'totalLogbook'
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
        'industri.siswa.absensi',
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
        'industri.siswa.logbook',
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

    $penilaianIndustri = null;
    $nilaiPKL = null;

    if ($penempatan) {

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
        'industri.siswa.penilaian',
        compact(
            'siswa',
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
        'penilaianIndustri',
        'nilaiPKL'
    ])
    ->where(
        'siswa_id',
        $siswa->id
    )
    ->first();

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

    $totalLogbook = Logbook::where(
        'siswa_id',
        $siswa->id
    )->count();

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

    $pdf = Pdf::loadView(
        'industri.pdf.laporan-siswa',
        compact(
            'siswa',
            'penempatan',
            'hadir',
            'izin',
            'sakit',
            'alpha',
            'totalLogbook',
            'logbookValid',
            'logbookPending'
        )
    );

    return $pdf->download(
        'laporan-pkl-'.$siswa->user->name.'.pdf'
    );
}

public function logbook()
{
    $industri = auth()->user()->industri;

    $logbooks = Logbook::with([
        'siswa.user'
    ])
    ->whereHas(
        'siswa.penempatanPKL',
        function ($q) use ($industri) {

            $q->where(
                'perusahaan_id',
                $industri->perusahaan_id
            );

        }
    )
    ->latest()
    ->paginate(10);

    return view(
        'industri.logbook.index',
        compact('logbooks')
    );
}

public function showLogbook(
    Logbook $logbook
)
{
    return view(
        'industri.logbook.show',
        compact('logbook')
    );
}

public function validasiLogbook(
    Request $request,
    Logbook $logbook
)
{
    $request->validate([
        'status_validasi' => 'required',
        'catatan' => 'nullable'
    ]);

    $logbook->update([
        'status_validasi' =>
            $request->status_validasi,

        'catatan_validasi' =>
            $request->catatan
    ]);

    return redirect()
        ->route('industri.logbook')
        ->with(
            'success',
            'Logbook berhasil divalidasi'
        );
}

public function absensi()
{
    $industri = auth()->user()->industri;

    $absensis = Absensi::with([
        'siswa.user'
    ])
    ->whereHas(
        'siswa.penempatanPKL',
        function ($q) use ($industri) {

            $q->where(
                'perusahaan_id',
                $industri->perusahaan_id
            );

        }
    )
    ->latest()
    ->paginate(10);

    return view(
        'industri.absensi.index',
        compact('absensis')
    );
}

public function showAbsensi(
    Absensi $absensi
)
{
    return view(
        'industri.absensi.show',
        compact('absensi')
    );
}

public function penilaian()
{
    $industri = auth()->user()->industri;

    $penempatans = PenempatanPKL::with([
        'siswa.user',
        'penilaianIndustri'
    ])
    ->where(
        'perusahaan_id',
        $industri->perusahaan_id
    )
    ->get();

    return view(
        'industri.penilaian.index',
        compact('penempatans')
    );
}

public function createPenilaian(
    PenempatanPKL $penempatan
)
{
    return view(
        'industri.penilaian.create',
        compact('penempatan')
    );
}

public function storePenilaian(
    Request $request,
    PenempatanPKL $penempatan
)
{
    $nilaiAkhir = (
        $request->disiplin +
        $request->kerjasama +
        $request->inisiatif +
        $request->tanggung_jawab +
        $request->keterampilan
    ) / 5;

    PenilaianIndustri::create([

        'penempatan_pkl_id' =>
            $penempatan->id,

        'industri_id' =>
            auth()->user()
                ->industri
                ->id,

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

    NilaiPKLController::generateNilai(
    $penempatan->id
);

    return redirect()
        ->route(
            'industri.penilaian'
        )
        ->with(
            'success',
            'Penilaian berhasil disimpan'
        );
}

public function editPenilaian(
    PenilaianIndustri $penilaianIndustri
)
{
    return view(
        'industri.penilaian.edit',
        compact(
            'penilaianIndustri'
        )
    );
}

public function updatePenilaian(
    Request $request,
    PenilaianIndustri $penilaianIndustri
)
{
    $nilaiAkhir = (
        $request->disiplin +
        $request->kerjasama +
        $request->inisiatif +
        $request->tanggung_jawab +
        $request->keterampilan
    ) / 5;

    $penilaianIndustri->update([

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

    NilaiPKLController::generateNilai(
    $penempatan->id
);

    return redirect()
        ->route(
            'industri.penilaian'
        )
        ->with(
            'success',
            'Penilaian berhasil diperbarui'
        );
}

public function profil()
{
    $industri = auth()->user()
        ->industri()
        ->with([
            'user',
            'perusahaan'
        ])
        ->first();

    $jumlahSiswa = PenempatanPKL::where(
        'perusahaan_id',
        $industri->perusahaan_id
    )->count();

    $jumlahLogbookPending = Logbook::whereHas(
        'siswa.penempatanPKL',
        function ($q) use ($industri) {

            $q->where(
                'perusahaan_id',
                $industri->perusahaan_id
            );

        }
    )
    ->where(
        'status_validasi',
        'pending'
    )
    ->count();

    return view(
        'industri.profil',
        compact(
            'industri',
            'jumlahSiswa',
            'jumlahLogbookPending'
        )
    );
}

public function editProfil()
{
    $industri = auth()->user()
        ->industri()
        ->with([
            'user',
            'perusahaan'
        ])
        ->first();

    return view(
        'industri.profil-edit',
        compact('industri')
    );
}

public function updateProfil(
    Request $request
)
{
    $industri = auth()->user()->industri;

    $request->validate([

        'name' => 'required',

        'email' =>
            'required|email|unique:users,email,' .
            $industri->user_id,

        'jabatan' => 'nullable',

        'no_hp' => 'nullable'

    ]);

    $industri->user->update([

        'name' => $request->name,

        'email' => $request->email

    ]);

    $industri->update([

        'jabatan' => $request->jabatan,

        'no_hp' => $request->no_hp

    ]);

    return redirect()
        ->route('industri.profil')
        ->with(
            'success',
            'Profil berhasil diperbarui'
        );
}

public function password()
{
    return view(
        'industri.password'
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
            'Password lama tidak sesuai'
        );

    }

    $user->update([

        'password' => Hash::make(
            $request->password_baru
        )

    ]);

    return redirect()
        ->route('industri.profil')
        ->with(
            'success',
            'Password berhasil diubah'
        );
}


}