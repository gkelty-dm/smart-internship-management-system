@extends('layouts.skydash-admin')

@section('title', 'Riwayat Absensi Siswa')

@section('content')

<div class="row">

    <div class="col-lg-12">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>

                        <h4 class="card-title mb-1">
                            Riwayat Absensi Siswa
                        </h4>

                        <p class="text-muted mb-0">
                            Menampilkan seluruh riwayat absensi siswa.
                        </p>

                    </div>

                    <a href="{{ route('siswa.index') }}"
                       class="btn btn-secondary">

                        <i class="mdi mdi-arrow-left"></i>

                        Kembali

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>


<div class="row mt-3">

    <div class="col-lg-4">

        <div class="card">

            <div class="card-body">

                <h5 class="mb-4">

                    Informasi Siswa

                </h5>

                <table class="table table-borderless">

                    <tr>

                        <th width="35%">Nama</th>

                        <td>{{ $siswa->user->name }}</td>

                    </tr>

                    <tr>

                        <th>NISN</th>

                        <td>{{ $siswa->nisn }}</td>

                    </tr>

                    <tr>

                        <th>Jurusan</th>

                        <td>{{ $siswa->jurusan->nama_jurusan ?? '-' }}</td>

                    </tr>

                    <tr>

                        <th>Kelas</th>

                        <td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td>

                    </tr>

                    <tr>

                        <th>No HP</th>

                        <td>{{ $siswa->no_hp }}</td>

                    </tr>

                </table>

            </div>

        </div>

    </div>


    <div class="col-lg-8">

        <div class="card">

            <div class="card-body">

                <h5 class="mb-4">

                    Riwayat Absensi

                </h5>

                <div class="table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead class="table-light">

                            <tr>

                                <th>No</th>

                                <th>Tanggal</th>

                                <th>Masuk</th>

                                <th>Pulang</th>

                                <th>Status</th>

                                <th>Verifikasi</th>

                                <th class="text-center">

                                    Detail

                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($absensis as $absensi)

                                <tr>

                                    <td>

                                        {{ $loop->iteration }}

                                    </td>

                                    <td>

                                        {{ \Carbon\Carbon::parse($absensi->tanggal)->format('d-m-Y') }}

                                    </td>

                                    <td>

                                        {{ $absensi->jam_masuk ?? '-' }}

                                    </td>

                                    <td>

                                        {{ $absensi->jam_pulang ?? '-' }}

                                    </td>

                                    <td>

                                        @switch($absensi->status)

                                            @case('hadir')

                                                <span class="badge badge-success">

                                                    Hadir

                                                </span>

                                            @break

                                            @case('izin')

                                                <span class="badge badge-warning">

                                                    Izin

                                                </span>

                                            @break

                                            @case('sakit')

                                                <span class="badge badge-info">

                                                    Sakit

                                                </span>

                                            @break

                                            @default

                                                <span class="badge badge-danger">

                                                    Alpha

                                                </span>

                                        @endswitch

                                    </td>

                                    <td>

                                        {{ strtoupper(str_replace('_',' + ',$absensi->metode_verifikasi)) }}

                                    </td>

                                    <td class="text-center">

                                        <button
                                            class="btn btn-outline-primary btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#detail{{ $absensi->id }}">

                                            <i class="mdi mdi-eye"></i>

                                        </button>

                                    </td>

                                </tr>


                                {{-- Modal Detail --}}

                                <div
                                    class="modal fade"
                                    id="detail{{ $absensi->id }}"
                                    tabindex="-1">

                                    <div class="modal-dialog modal-lg">

                                        <div class="modal-content">

                                            <div class="modal-header">

                                                <h5>

                                                    Detail Absensi

                                                </h5>

                                                <button
                                                    type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal">

                                                </button>

                                            </div>

                                            <div class="modal-body">

                                                <div class="row">

                                                    <div class="col-md-6">

                                                        <h6>Foto Masuk</h6>

                                                        @if($absensi->foto_masuk)

                                                            <img
                                                                src="{{ asset('storage/'.$absensi->foto_masuk) }}"
                                                                class="img-fluid rounded border">

                                                        @else

                                                            <div class="alert alert-secondary">

                                                                Tidak ada foto.

                                                            </div>

                                                        @endif

                                                    </div>

                                                    <div class="col-md-6">

                                                        <h6>Foto Pulang</h6>

                                                        @if($absensi->foto_pulang)

                                                            <img
                                                                src="{{ asset('storage/'.$absensi->foto_pulang) }}"
                                                                class="img-fluid rounded border">

                                                        @else

                                                            <div class="alert alert-secondary">

                                                                Tidak ada foto.

                                                            </div>

                                                        @endif

                                                    </div>

                                                </div>

                                                <hr>

                                                <table class="table table-bordered">

                                                    <tr>

                                                        <th width="35%">

                                                            Metode Verifikasi

                                                        </th>

                                                        <td>

                                                            {{ strtoupper(str_replace('_',' + ',$absensi->metode_verifikasi)) }}

                                                        </td>

                                                    </tr>

                                                    <tr>

                                                        <th>Status</th>

                                                        <td>{{ ucfirst($absensi->status) }}</td>

                                                    </tr>

                                                    <tr>

                                                        <th>Latitude Masuk</th>

                                                        <td>

                                                            {{ $absensi->latitude_masuk }}

                                                        </td>

                                                    </tr>

                                                    <tr>

                                                        <th>Longitude Masuk</th>

                                                        <td>

                                                            {{ $absensi->longitude_masuk }}

                                                        </td>

                                                    </tr>

                                                    <tr>

                                                        <th>Latitude Pulang</th>

                                                        <td>

                                                            {{ $absensi->latitude_pulang }}

                                                        </td>

                                                    </tr>

                                                    <tr>

                                                        <th>Longitude Pulang</th>

                                                        <td>

                                                            {{ $absensi->longitude_pulang }}

                                                        </td>

                                                    </tr>

                                                    <tr>

                                                        <th>IP Address</th>

                                                        <td>

                                                            {{ $absensi->ip_address }}

                                                        </td>

                                                    </tr>

                                                    <tr>

                                                        <th>Device</th>

                                                        <td>

                                                            {{ $absensi->device_info }}

                                                        </td>

                                                    </tr>

                                                </table>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @empty

                                <tr>

                                    <td colspan="7" class="text-center">

                                        Belum ada data absensi.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="mt-4">

                    {{ $absensis->links('pagination::bootstrap-5') }}

                </div>

            </div>

        </div>

    </div>

</div>

@endsection