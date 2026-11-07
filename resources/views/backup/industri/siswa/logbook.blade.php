@extends('layouts.skydash-industri')

@section('title', 'Logbook Siswa')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Logbook Siswa</h3>
        <p class="text-muted">Daftar laporan kegiatan harian siswa: <strong>{{ $siswa->user->name }}</strong></p>
    </div>

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Riwayat Logbook</h4>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logbooks as $logbook)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $logbook->tanggal }}</td>
                                <td>
                                    @php
                                        $statusClass = [
                                            'pending'   => 'warning',
                                            'disetujui' => 'success',
                                            'ditolak'   => 'danger'
                                        ];
                                    @endphp
                                    <label class="badge badge-{{ $statusClass[$logbook->status_validasi] ?? 'secondary' }}">
                                        {{ ucfirst($logbook->status_validasi) }}
                                    </label>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('industri.logbook.show', $logbook->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="mdi mdi-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada data logbook</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-4">
                    {{ $logbooks->links('pagination::bootstrap-4') }}
                </div>

                <div class="mt-4">
                    <a href="{{ route('industri.siswa') }}" class="btn btn-light">
                        <i class="mdi mdi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection