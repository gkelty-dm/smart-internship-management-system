@extends('layouts.skydash-guru')

@section('title', 'Monitoring Absensi')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Monitoring Absensi Siswa</h3>
        <p class="text-muted">Daftar kehadiran harian siswa bimbingan Anda.</p>
    </div>

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="mdi mdi-calendar-clock text-primary"></i> Data Kehadiran
                </h4>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Pulang</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($absensis as $absensi)
                            <tr>
                                <td class="font-weight-bold text-dark">{{ $absensi->siswa->user->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($absensi->tanggal)->format('d M Y') }}</td>
                                <td>{{ $absensi->jam_masuk ?? '-' }}</td>
                                <td>{{ $absensi->jam_pulang ?? '-' }}</td>
                                <td class="text-center">
                                    @php
                                        $statusClass = [
                                            'hadir' => 'badge-success',
                                            'izin'  => 'badge-info',
                                            'sakit' => 'badge-warning',
                                            'alpha' => 'badge-danger'
                                        ];
                                        $class = $statusClass[strtolower($absensi->status)] ?? 'badge-secondary';
                                    @endphp
                                    <label class="badge {{ $class }}">{{ ucfirst($absensi->status) }}</label>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada data absensi yang tercatat.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $absensis->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection