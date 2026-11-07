@extends('layouts.skydash-industri')

@section('title', 'Siswa PKL')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Siswa PKL</h3>
        <p class="text-muted">Daftar siswa yang ditempatkan di perusahaan Anda.</p>
    </div>

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Siswa Bimbingan</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Guru Pembimbing</th>
                                <th>Perusahaan</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($penempatans as $item)
                            <tr>
                                <td class="font-weight-bold">{{ $item->siswa->user->name }}</td>
                                <td>{{ $item->guru->user->name }}</td>
                                <td>{{ $item->perusahaan->nama_perusahaan }}</td>
                                <td>
                                    <label class="badge badge-{{ $item->status_pkl == 'aktif' ? 'success' : 'warning' }}">
                                        {{ ucfirst($item->status_pkl) }}
                                    </label>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('industri.siswa.detail', $item->siswa->id) }}" class="btn btn-sm btn-primary" title="Detail">
                                            <i class="mdi mdi-account-card-details"></i>
                                        </a>
                                        <a href="{{ route('industri.siswa.absensi', $item->siswa->id) }}" class="btn btn-sm btn-success" title="Absensi">
                                            <i class="mdi mdi-calendar-check"></i>
                                        </a>
                                        <a href="{{ route('industri.siswa.logbook', $item->siswa->id) }}" class="btn btn-sm btn-warning" title="Logbook">
                                            <i class="mdi mdi-book-open"></i>
                                        </a>
                                        <a href="{{ route('industri.siswa.penilaian', $item->siswa->id) }}" class="btn btn-sm btn-info" title="Penilaian">
                                            <i class="mdi mdi-star"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada siswa PKL</td>
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