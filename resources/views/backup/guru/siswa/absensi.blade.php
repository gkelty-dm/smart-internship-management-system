@extends('layouts.skydash-guru')

@section('title', 'Detail Absensi Siswa')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Detail Absensi</h3>
        <p class="text-muted">Data absensi harian untuk siswa: <strong>{{ $siswa->user->name }}</strong></p>
    </div>

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="mdi mdi-calendar-check text-primary"></i> Riwayat Absensi
                </h4>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Pulang</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($absensis as $absensi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $absensi->tanggal }}</td>
                                <td>{{ $absensi->jam_masuk ?? '-' }}</td>
                                <td>{{ $absensi->jam_pulang ?? '-' }}</td>
                                <td>
                                    @if($absensi->status == 'hadir')
                                        <label class="badge badge-success">Hadir</label>
                                    @elseif($absensi->status == 'izin')
                                        <label class="badge badge-warning">Izin</label>
                                    @elseif($absensi->status == 'sakit')
                                        <label class="badge badge-danger">Sakit</label>
                                    @else
                                        <label class="badge badge-info">{{ ucfirst($absensi->status) }}</label>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data absensi</td>
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