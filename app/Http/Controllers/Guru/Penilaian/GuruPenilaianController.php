<?php

namespace App\Http\Controllers\Guru\Penilaian;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NilaiPKLController;
use App\Models\PenilaianGuru;
use App\Models\PenempatanPKL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruPenilaianController extends Controller
{
    /**
     * Menampilkan seluruh penilaian siswa
     * yang dibimbing oleh guru yang sedang login.
     */
    public function index()
    {
        $guru = Auth::user()->guru;

        $penempatans = PenempatanPKL::with([
            'siswa.user',
            'siswa.jurusan',
            'siswa.kelas',
            'perusahaan',
            'penilaianGuru'
        ])
            ->where('guru_id', $guru->id)
            ->latest()
            ->paginate(10);

        return view(
            'guru.penilaian.index',
            compact('penempatans')
        );
    }

    /**
     * Form tambah penilaian.
     */
    public function create(PenempatanPKL $penempatan)
    {
        $guru = Auth::user()->guru;

        // Pastikan penempatan adalah milik guru yang login.
        abort_unless(
            $penempatan->guru_id == $guru->id,
            403
        );

        $penempatan->load([
            'siswa.user',
            'siswa.jurusan',
            'siswa.kelas',
            'perusahaan',
            'penilaianGuru'
        ]);

        // Jika sudah ada penilaian,
        // arahkan ke edit agar tidak membuat data ganda.
        if ($penempatan->penilaianGuru) {
            return redirect()
                ->route(
                    'guru.penilaian.edit',
                    $penempatan->penilaianGuru->id
                );
        }

        return view(
            'guru.penilaian.create',
            compact('penempatan')
        );
    }

    /**
     * Menyimpan penilaian baru.
     */
    public function store(
        Request $request,
        PenempatanPKL $penempatan
    ) {
        $guru = Auth::user()->guru;

        // Pastikan penempatan milik guru yang login.
        abort_unless(
            $penempatan->guru_id == $guru->id,
            403
        );

        $validated = $request->validate([
            'disiplin' => [
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],

            'kerjasama' => [
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],

            'inisiatif' => [
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],

            'tanggung_jawab' => [
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],

            'keterampilan' => [
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],

            'catatan' => [
                'nullable',
                'string'
            ],
        ]);

        // Cegah penilaian ganda.
        $sudahAda = PenilaianGuru::where(
            'penempatan_pkl_id',
            $penempatan->id
        )->exists();

        if ($sudahAda) {
            return redirect()
                ->route('guru.penilaian.index')
                ->with(
                    'error',
                    'Siswa tersebut sudah memiliki penilaian.'
                );
        }

        $nilaiAkhir = (
            $validated['disiplin'] +
            $validated['kerjasama'] +
            $validated['inisiatif'] +
            $validated['tanggung_jawab'] +
            $validated['keterampilan']
        ) / 5;

        $penilaianGuru = PenilaianGuru::create([
            'penempatan_pkl_id' => $penempatan->id,

            'guru_id' => $guru->id,

            'disiplin' => $validated['disiplin'],

            'kerjasama' => $validated['kerjasama'],

            'inisiatif' => $validated['inisiatif'],

            'tanggung_jawab' => $validated['tanggung_jawab'],

            'keterampilan' => $validated['keterampilan'],

            'nilai_akhir' => $nilaiAkhir,

            'catatan' => $validated['catatan'] ?? null,
        ]);

        // Generate/update nilai PKL keseluruhan.
        NilaiPKLController::generateNilai(
            $penempatan->id
        );

        return redirect()
            ->route(
                'guru.penilaian.show',
                $penilaianGuru->id
            )
            ->with(
                'success',
                'Penilaian siswa berhasil disimpan.'
            );
    }

    /**
     * Menampilkan detail penilaian.
     */
    public function show(
        PenilaianGuru $penilaianGuru
    ) {
        $guru = Auth::user()->guru;

        // Pastikan penilaian milik guru yang login.
        abort_unless(
            $penilaianGuru->guru_id == $guru->id,
            403
        );

        $penilaianGuru->load([
            'penempatan.siswa.user',
            'penempatan.siswa.jurusan',
            'penempatan.siswa.kelas',
            'penempatan.perusahaan',
            'guru.user'
        ]);

        return view(
            'guru.penilaian.show',
            compact('penilaianGuru')
        );
    }

    /**
     * Form edit penilaian.
     */
    public function edit(
        PenilaianGuru $penilaianGuru
    ) {
        $guru = Auth::user()->guru;

        abort_unless(
            $penilaianGuru->guru_id == $guru->id,
            403
        );

        $penilaianGuru->load([
            'penempatan.siswa.user',
            'penempatan.siswa.jurusan',
            'penempatan.siswa.kelas',
            'penempatan.perusahaan'
        ]);

        return view(
            'guru.penilaian.edit',
            compact('penilaianGuru')
        );
    }

    /**
     * Update penilaian.
     */
    public function update(
        Request $request,
        PenilaianGuru $penilaianGuru
    ) {
        $guru = Auth::user()->guru;

        abort_unless(
            $penilaianGuru->guru_id == $guru->id,
            403
        );

        $validated = $request->validate([
            'disiplin' => [
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],

            'kerjasama' => [
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],

            'inisiatif' => [
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],

            'tanggung_jawab' => [
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],

            'keterampilan' => [
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],

            'catatan' => [
                'nullable',
                'string'
            ],
        ]);

        $nilaiAkhir = (
            $validated['disiplin'] +
            $validated['kerjasama'] +
            $validated['inisiatif'] +
            $validated['tanggung_jawab'] +
            $validated['keterampilan']
        ) / 5;

        $penilaianGuru->update([
            'disiplin' => $validated['disiplin'],

            'kerjasama' => $validated['kerjasama'],

            'inisiatif' => $validated['inisiatif'],

            'tanggung_jawab' => $validated['tanggung_jawab'],

            'keterampilan' => $validated['keterampilan'],

            'nilai_akhir' => $nilaiAkhir,

            'catatan' => $validated['catatan'] ?? null,
        ]);

        // Generate/update nilai PKL keseluruhan.
        NilaiPKLController::generateNilai(
            $penilaianGuru->penempatan_pkl_id
        );

        return redirect()
            ->route(
                'guru.penilaian.show',
                $penilaianGuru->id
            )
            ->with(
                'success',
                'Penilaian siswa berhasil diperbarui.'
            );
    }
}
