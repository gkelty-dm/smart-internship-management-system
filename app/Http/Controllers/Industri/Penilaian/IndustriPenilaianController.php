<?php

namespace App\Http\Controllers\Industri\Penilaian;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NilaiPKLController;
use App\Models\PenilaianIndustri;
use App\Models\PenempatanPKL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndustriPenilaianController extends Controller
{
    /**
     * Menampilkan seluruh penilaian siswa
     * yang berada pada industri yang sedang login.
     */
    public function index()
    {
        $industri = Auth::user()->industri;

        if (!$industri) {
            abort(403, 'Data industri belum tersedia.');
        }

        $penempatans = PenempatanPKL::with([
            'siswa.user',
            'siswa.jurusan',
            'siswa.kelas',
            'perusahaan',
            'penilaianIndustri'
        ])
            ->where(
                'industri_id',
                $industri->id
            )
            ->latest()
            ->paginate(10);

        return view(
            'industri.penilaian.index',
            compact('penempatans')
        );
    }


    /**
     * Form tambah penilaian.
     */
    public function create(
        PenempatanPKL $penempatan
    ) {
        $industri = Auth::user()->industri;

        if (!$industri) {
            abort(403, 'Data industri belum tersedia.');
        }

        /*
        |--------------------------------------------------------------------------
        | Pastikan penempatan milik industri yang login
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $penempatan->industri_id == $industri->id,
            403
        );


        $penempatan->load([
            'siswa.user',
            'siswa.jurusan',
            'siswa.kelas',
            'perusahaan',
            'penilaianIndustri'
        ]);


        /*
        |--------------------------------------------------------------------------
        | Jika sudah ada penilaian,
        | arahkan ke edit agar tidak membuat data ganda.
        |--------------------------------------------------------------------------
        */

        if ($penempatan->penilaianIndustri) {

            return redirect()
                ->route(
                    'industri.penilaian.edit',
                    $penempatan->penilaianIndustri->id
                );
        }


        return view(
            'industri.penilaian.create',
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
        $industri = Auth::user()->industri;

        if (!$industri) {
            abort(403, 'Data industri belum tersedia.');
        }


        /*
        |--------------------------------------------------------------------------
        | Pastikan penempatan milik industri yang login
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $penempatan->industri_id == $industri->id,
            403
        );


        /*
        |--------------------------------------------------------------------------
        | Validasi
        |--------------------------------------------------------------------------
        */

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


        /*
        |--------------------------------------------------------------------------
        | Cegah penilaian ganda
        |--------------------------------------------------------------------------
        */

        $sudahAda = PenilaianIndustri::where(
            'penempatan_pkl_id',
            $penempatan->id
        )->exists();


        if ($sudahAda) {

            return redirect()
                ->route(
                    'industri.penilaian.index'
                )
                ->with(
                    'error',
                    'Siswa tersebut sudah memiliki penilaian industri.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Hitung nilai akhir
        |--------------------------------------------------------------------------
        */

        $nilaiAkhir = (
            $validated['disiplin'] +
            $validated['kerjasama'] +
            $validated['inisiatif'] +
            $validated['tanggung_jawab'] +
            $validated['keterampilan']
        ) / 5;


        /*
        |--------------------------------------------------------------------------
        | Simpan penilaian industri
        |--------------------------------------------------------------------------
        */

        $penilaianIndustri = PenilaianIndustri::create([

            'penempatan_pkl_id' =>
            $penempatan->id,

            'industri_id' =>
            $industri->id,

            'disiplin' =>
            $validated['disiplin'],

            'kerjasama' =>
            $validated['kerjasama'],

            'inisiatif' =>
            $validated['inisiatif'],

            'tanggung_jawab' =>
            $validated['tanggung_jawab'],

            'keterampilan' =>
            $validated['keterampilan'],

            'nilai_akhir' =>
            $nilaiAkhir,

            'catatan' =>
            $validated['catatan'] ?? null,

        ]);


        /*
        |--------------------------------------------------------------------------
        | Generate / update nilai PKL keseluruhan
        |--------------------------------------------------------------------------
        */

        NilaiPKLController::generateNilai(
            $penempatan->id
        );


        return redirect()
            ->route(
                'industri.penilaian.show',
                $penilaianIndustri->id
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
        PenilaianIndustri $penilaianIndustri
    ) {
        $industri = Auth::user()->industri;

        if (!$industri) {
            abort(403, 'Data industri belum tersedia.');
        }


        /*
        |--------------------------------------------------------------------------
        | Pastikan penilaian milik industri yang login
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $penilaianIndustri->industri_id == $industri->id,
            403
        );


        $penilaianIndustri->load([
            'penempatan.siswa.user',
            'penempatan.siswa.jurusan',
            'penempatan.siswa.kelas',
            'penempatan.perusahaan',
            'industri.user'
        ]);


        return view(
            'industri.penilaian.show',
            compact('penilaianIndustri')
        );
    }


    /**
     * Form edit penilaian.
     */
    public function edit(
        PenilaianIndustri $penilaianIndustri
    ) {
        $industri = Auth::user()->industri;

        if (!$industri) {
            abort(403, 'Data industri belum tersedia.');
        }


        abort_unless(
            $penilaianIndustri->industri_id == $industri->id,
            403
        );


        $penilaianIndustri->load([
            'penempatan.siswa.user',
            'penempatan.siswa.jurusan',
            'penempatan.siswa.kelas',
            'penempatan.perusahaan'
        ]);


        return view(
            'industri.penilaian.edit',
            compact('penilaianIndustri')
        );
    }


    /**
     * Update penilaian.
     */
    public function update(
        Request $request,
        PenilaianIndustri $penilaianIndustri
    ) {
        $industri = Auth::user()->industri;

        if (!$industri) {
            abort(403, 'Data industri belum tersedia.');
        }


        /*
        |--------------------------------------------------------------------------
        | Pastikan penilaian milik industri yang login
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $penilaianIndustri->industri_id == $industri->id,
            403
        );


        /*
        |--------------------------------------------------------------------------
        | Validasi
        |--------------------------------------------------------------------------
        */

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


        /*
        |--------------------------------------------------------------------------
        | Hitung nilai akhir
        |--------------------------------------------------------------------------
        */

        $nilaiAkhir = (
            $validated['disiplin'] +
            $validated['kerjasama'] +
            $validated['inisiatif'] +
            $validated['tanggung_jawab'] +
            $validated['keterampilan']
        ) / 5;


        /*
        |--------------------------------------------------------------------------
        | Update penilaian
        |--------------------------------------------------------------------------
        */

        $penilaianIndustri->update([

            'disiplin' =>
            $validated['disiplin'],

            'kerjasama' =>
            $validated['kerjasama'],

            'inisiatif' =>
            $validated['inisiatif'],

            'tanggung_jawab' =>
            $validated['tanggung_jawab'],

            'keterampilan' =>
            $validated['keterampilan'],

            'nilai_akhir' =>
            $nilaiAkhir,

            'catatan' =>
            $validated['catatan'] ?? null,

        ]);


        /*
        |--------------------------------------------------------------------------
        | Generate / update nilai PKL keseluruhan
        |--------------------------------------------------------------------------
        */

        NilaiPKLController::generateNilai(
            $penilaianIndustri->penempatan_pkl_id
        );


        return redirect()
            ->route(
                'industri.penilaian.show',
                $penilaianIndustri->id
            )
            ->with(
                'success',
                'Penilaian siswa berhasil diperbarui.'
            );
    }
}
