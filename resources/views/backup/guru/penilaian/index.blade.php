@extends('layouts.skydash-guru')

@section('title', 'Penilaian Siswa')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Penilaian Siswa PKL</h3>
        <p class="text-muted">Daftar dan kelola nilai akhir untuk seluruh siswa bimbingan Anda.</p>
    </div>

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="mdi mdi-school text-primary"></i> Daftar Siswa Bimbingan
                </h4>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Perusahaan</th>
                                <th class="text-center">Nilai Akhir</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($penempatans as $item)
                            <tr>
                                <td class="font-weight-bold text-dark">{{ $item->siswa->user->name }}</td>
                                <td>{{ $item->perusahaan->nama_perusahaan }}</td>
                                <td class="text-center">
                                    @if($item->penilaianGuru)
                                        <label class="badge badge-success">{{ $item->penilaianGuru->nilai_akhir }}</label>
                                    @else
                                        <label class="badge badge-secondary">Belum dinilai</label>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($item->penilaianGuru)
                                        <a href="{{ route('guru.penilaian.edit', $item->penilaianGuru->id) }}" class="btn btn-sm btn-light">
                                            <i class="mdi mdi-pencil-outline"></i> Edit
                                        </a>
                                    @else
                                        <a href="{{ route('guru.penilaian.create', $item->id) }}" class="btn btn-sm btn-primary">
                                            <i class="mdi mdi-plus"></i> Nilai
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    <i class="mdi mdi-account-off d-block h2"></i> Belum ada data siswa bimbingan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection