@extends('layouts.skydash-guru')

@section('title', 'Detail Logbook Siswa')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Detail Logbook</h3>
        <p class="text-muted">Riwayat logbook kegiatan untuk siswa: <strong>{{ $siswa->user->name }}</strong></p>
    </div>

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="mdi mdi-book-open-page-variant text-primary"></i> Data Logbook Kegiatan
                </h4>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kegiatan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logbooks as $logbook)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $logbook->tanggal }}</td>
                                <td>{{ Str::limit($logbook->kegiatan, 60) }}</td>
                                <td>
                                    @if($logbook->status_validasi == 'disetujui')
                                        <label class="badge badge-success">Disetujui</label>
                                    @elseif($logbook->status_validasi == 'ditolak')
                                        <label class="badge badge-danger">Ditolak</label>
                                    @else
                                        <label class="badge badge-warning">Pending</label>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data logbook</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $logbooks->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection