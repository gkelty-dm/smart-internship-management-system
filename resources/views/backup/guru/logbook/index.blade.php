@extends('layouts.skydash-guru')

@section('title', 'Monitoring Logbook')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Monitoring Logbook Siswa</h3>
        <p class="text-muted">Tinjau dan validasi logbook harian siswa bimbingan Anda.</p>
    </div>

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="mdi mdi-book-search text-primary"></i> Daftar Logbook Perlu Validasi
                </h4>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Tanggal</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logbooks as $logbook)
                            <tr>
                                <td class="font-weight-bold text-dark">{{ $logbook->siswa->user->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($logbook->tanggal)->format('d M Y') }}</td>
                                <td class="text-center">
                                    @if($logbook->status_validasi == 'pending')
                                        <label class="badge badge-warning">Pending</label>
                                    @elseif($logbook->status_validasi == 'disetujui')
                                        <label class="badge badge-success">Disetujui</label>
                                    @else
                                        <label class="badge badge-danger">Ditolak</label>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('guru.logbook.show', $logbook->id) }}" class="btn btn-sm btn-info">
                                        <i class="mdi mdi-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada logbook yang ditemukan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if(method_exists($logbooks, 'links'))
                    <div class="mt-4">
                        {{ $logbooks->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection