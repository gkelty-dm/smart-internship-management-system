@extends('layouts.skydash-siswa')

@section('title', 'Riwayat Absensi')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Riwayat Absensi</h3>
        <p class="text-muted">Daftar lengkap catatan kehadiran harian Anda.</p>
    </div>

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><i class="mdi mdi-history"></i> Log Absensi</h4>

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Pulang</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($absensis as $item)
                            <tr>
                                <td class="font-weight-bold text-primary">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                </td>
                                <td>{{ $item->jam_masuk ?? '-' }}</td>
                                <td>{{ $item->jam_pulang ?? '-' }}</td>
                                <td>
                                    @php
                                    $badgeClass = match($item->status) {
                                    'hadir' => 'badge-success',
                                    'izin' => 'badge-warning',
                                    'alpha' => 'badge-danger',
                                    default => 'badge-info'
                                    };
                                    @endphp
                                    <label class="badge {{ $badgeClass }}">
                                        {{ ucfirst($item->status) }}
                                    </label>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted font-italic">
                                    Belum ada data absensi yang ditemukan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-4">
                    {{ $absensis->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection