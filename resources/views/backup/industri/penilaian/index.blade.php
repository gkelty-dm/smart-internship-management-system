@extends('layouts.skydash-industri')

@section('title', 'Penilaian Siswa PKL')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Penilaian Siswa PKL</h3>
        <p class="text-muted">Kelola data penilaian untuk siswa yang sedang magang.</p>
    </div>

    @if(session('success'))
    <div class="col-12">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    @endif

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Siswa</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Siswa</th>
                                <th>Perusahaan</th>
                                <th>Status</th>
                                <th>Nilai Akhir</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($penempatans as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="font-weight-bold">{{ $item->siswa->user->name }}</td>
                                <td>{{ $item->perusahaan->nama_perusahaan }}</td>
                                <td>
                                    @if($item->penilaianIndustri)
                                        <label class="badge badge-success">Sudah Dinilai</label>
                                    @else
                                        <label class="badge badge-warning">Belum Dinilai</label>
                                    @endif
                                </td>
                                <td>{{ $item->penilaianIndustri->nilai_akhir ?? '-' }}</td>
                                <td class="text-center">
                                    @if($item->penilaianIndustri)
                                        <a href="{{ route('industri.penilaian.edit', $item->penilaianIndustri->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="mdi mdi-pencil"></i> Edit
                                        </a>
                                    @else
                                        <a href="{{ route('industri.penilaian.create', $item->id) }}" class="btn btn-sm btn-primary">
                                            <i class="mdi mdi-plus"></i> Beri Nilai
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Tidak ada data siswa PKL</td>
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