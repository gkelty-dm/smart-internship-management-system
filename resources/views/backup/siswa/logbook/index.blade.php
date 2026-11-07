@extends('layouts.skydash-siswa')
@section('title', 'Logbook PKL')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="font-weight-bold">Logbook PKL</h3>
                <p class="text-muted">Daftar catatan kegiatan harian selama masa PKL</p>
            </div>
            @if(auth()->user()->siswa->penempatanPKL && auth()->user()->siswa->penempatanPKL->status_pkl == 'aktif')
                <a href="{{ route('siswa.logbook.create') }}" class="btn btn-primary">
                    <i class="mdi mdi-plus"></i> Tambah Logbook
                </a>
            @else
                <button class="btn btn-secondary" disabled>PKL Belum Aktif</button>
            @endif
        </div>
    </div>

    @if(session('success'))
    <div class="col-12">
        <div class="alert alert-success">
            <i class="mdi mdi-check-circle"></i> {{ session('success') }}
        </div>
    </div>
    @endif

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><i class="mdi mdi-book-edit"></i> Riwayat Logbook</h4>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Kegiatan</th>
                                <th>Kendala</th>
                                <th>Solusi</th>
                                <th class="text-center">Foto</th>
                                <th class="text-center">Status</th>
                                <th>Catatan Guru</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logbooks as $logbook)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($logbook->tanggal)->format('d M Y') }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($logbook->kegiatan, 30) }}</td>
                                <td>{{ $logbook->kendala ?? '-' }}</td>
                                <td>{{ $logbook->solusi ?? '-' }}</td>
                                <td class="text-center">
                                    <span class="badge badge-info">{{ $logbook->fotos->count() }} Foto</span>
                                </td>
                                <td class="text-center">
                                    @php
                                        $statusClass = [
                                            'pending' => 'badge-warning',
                                            'disetujui' => 'badge-success',
                                            'ditolak' => 'badge-danger'
                                        ][$logbook->status_validasi] ?? 'badge-secondary';
                                    @endphp
                                    <label class="badge {{ $statusClass }} text-uppercase">
                                        {{ $logbook->status_validasi }}
                                    </label>
                                </td>
                                <td class="text-muted font-italic">{{ $logbook->catatan_guru ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted font-italic">
                                    Belum ada data logbook yang diinput.
                                </td>
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