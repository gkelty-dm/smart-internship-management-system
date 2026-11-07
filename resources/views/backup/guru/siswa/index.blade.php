@extends('layouts.skydash-guru')

@section('title', 'Siswa Bimbingan')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Siswa Bimbingan</h3>
        <p class="text-muted">Daftar siswa yang berada di bawah bimbingan Anda.</p>
    </div>

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="mdi mdi-account-group text-primary"></i> Data Siswa Bimbingan
                </h4>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Perusahaan</th>
                                <th>Status PKL</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($penempatans as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="font-weight-bold text-dark">{{ $item->siswa->user->name }}</td>
                                <td>{{ $item->perusahaan->nama_perusahaan }}</td>
                                <td>
                                    @if($item->status_pkl == 'aktif')
                                        <label class="badge badge-success">Aktif</label>
                                    @elseif($item->status_pkl == 'selesai')
                                        <label class="badge badge-info">Selesai</label>
                                    @else
                                        <label class="badge badge-warning">{{ ucfirst($item->status_pkl) }}</label>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('guru.siswa.detail', $item->siswa->id) }}" class="btn btn-sm btn-primary" title="Detail">
                                            <i class="mdi mdi-account-card-details"></i>
                                        </a>
                                        <a href="{{ route('guru.siswa.absensi', $item->siswa->id) }}" class="btn btn-sm btn-success" title="Absensi">
                                            <i class="mdi mdi-calendar-check"></i>
                                        </a>
                                        <a href="{{ route('guru.siswa.logbook', $item->siswa->id) }}" class="btn btn-sm btn-warning" title="Logbook">
                                            <i class="mdi mdi-book-open-page-variant"></i>
                                        </a>
                                        <a href="{{ route('guru.siswa.penilaian', $item->siswa->id) }}" class="btn btn-sm btn-info" title="Penilaian">
                                            <i class="mdi mdi-star"></i>
                                        </a>
                                        <a href="{{ route('guru.siswa.laporan', $item->siswa->id) }}" class="btn btn-sm btn-danger" title="PDF Laporan">
                                            <i class="mdi mdi-file-pdf"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada siswa bimbingan</td>
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