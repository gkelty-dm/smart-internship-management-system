<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Guru;
use App\Models\PenempatanPKL;
use Illuminate\Http\Request;

class PenilaianGuru extends Model
{
    protected $table = 'penilaian_guru';

    protected $fillable = [
        'penempatan_pkl_id',
        'guru_id',
        'disiplin',
        'kerjasama',
        'inisiatif',
        'tanggung_jawab',
        'keterampilan',
        'nilai_akhir',
        'catatan'
    ];

    public function penempatan()
    {
        return $this->belongsTo(
            PenempatanPKL::class,
            'penempatan_pkl_id'
        );
    }

    public function guru()
    {
        return $this->belongsTo(
            Guru::class
        );
    }

    public function guruIndex()
    {
        $guru = Auth::user()->guru;

        $penempatans = PenempatanPKL::with([
            'siswa.user',
            'perusahaan',
            'penilaianGuru'
        ])
            ->where(
                'guru_id',
                $guru->id
            )
            ->get();

        return view(
            'guru.penilaian.index',
            compact('penempatans')
        );
    }

    public function guruCreate(
        PenempatanPKL $penempatan
    ) {
        return view(
            'guru.penilaian.create',
            compact('penempatan')
        );
    }

    public function guruStore(
        Request $request,
        PenempatanPKL $penempatan
    ) {
        $request->validate([

            'disiplin' => 'required|numeric',

            'kerjasama' => 'required|numeric',

            'inisiatif' => 'required|numeric',

            'tanggung_jawab' => 'required|numeric',

            'keterampilan' => 'required|numeric',

        ]);

        $nilaiAkhir = (

            $request->disiplin +

            $request->kerjasama +

            $request->inisiatif +

            $request->tanggung_jawab +

            $request->keterampilan

        ) / 5;

        \App\Models\PenilaianGuru::updateOrCreate(

            [
                'penempatan_pkl_id' =>
                $penempatan->id
            ],

            [

                'guru_id' =>
                Auth::user()->guru->id,

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

            ]

        );

        return redirect()
            ->route(
                'guru.penilaian'
            )
            ->with(
                'success',
                'Penilaian berhasil disimpan'
            );
    }
}
