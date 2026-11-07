@extends('layouts.skydash-industri')

@section('title', 'Detail Absensi Siswa')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <h3 class="font-weight-bold">Absensi Siswa</h3>
        <p class="text-muted">Daftar rekaman kehadiran untuk siswa: <strong>{{ $siswa->user->name }}</strong></p>
    </div>

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Riwayat Absensi</h4>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Pulang</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
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
                                    @php
                                        $badgeClass = ($absensi->status == 'hadir') ? 'success' : 'warning';
                                    @endphp
                                    <label class="badge badge-{{ $badgeClass }}">{{ ucfirst($absensi->status) }}</label>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('industri.absensi.show', $absensi->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="mdi mdi-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Tidak ada data absensi ditemukan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-4">
                    {{ $absensis->links('pagination::bootstrap-4') }}
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