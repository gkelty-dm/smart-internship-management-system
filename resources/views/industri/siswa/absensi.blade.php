@extends('layouts.skydash-industri')

@section('title', 'Absensi Siswa')

@section('content')

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center flex-wrap">

                    <div class="d-flex align-items-center">

                        <div
                            class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3"
                            style="width:46px;height:46px;">

                            <i
                                class="mdi mdi-calendar-check-outline text-white"
                                style="font-size:23px;">
                            </i>

                        </div>

                        <div>

                            <h4 class="font-weight-bold mb-1">
                                Absensi Siswa
                            </h4>

                            <p class="text-muted mb-0 small">
                                Riwayat kehadiran siswa PKL.
                            </p>

                        </div>

                    </div>

                    <a
                        href="{{ route('industri.siswa.show', $siswa->id) }}"
                        class="btn btn-light btn-sm mt-3 mt-md-0">

                        <i class="mdi mdi-arrow-left me-1"></i>

                        Kembali

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>


<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center flex-wrap">

                    <div class="d-flex align-items-center">

                        @if(
                        $siswa->user &&
                        $siswa->user->foto_profil
                        )

                        <img
                            src="{{ $siswa->user->foto_profil }}"
                            width="55"
                            height="55"
                            class="rounded-circle me-3"
                            style="object-fit:cover;"
                            alt="Foto {{ $siswa->user->name }}">

                        @else

                        <div
                            class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3"
                            style="width:55px;height:55px;">

                            <i
                                class="mdi mdi-account-outline text-muted"
                                style="font-size:28px;">
                            </i>

                        </div>

                        @endif

                        <div>

                            <h5 class="font-weight-bold mb-1">

                                {{ $siswa->user->name ?? '-' }}

                            </h5>

                            <div class="d-flex align-items-center flex-wrap gap-2">

                                <small class="text-muted">

                                    <i class="mdi mdi-card-account-details-outline me-1"></i>

                                    NISN:
                                    {{ $siswa->nisn ?? '-' }}

                                </small>

                                @if($siswa->kelas)

                                <span class="badge bg-light text-primary border">

                                    <i class="mdi mdi-google-classroom me-1"></i>

                                    {{ $siswa->kelas->nama_kelas }}

                                </span>

                                @endif

                            </div>

                        </div>

                    </div>

                    <div class="mt-3 mt-md-0">

                        <span class="badge bg-primary px-3 py-2">

                            <i class="mdi mdi-calendar-check-outline me-1"></i>

                            {{ $absensis->total() }} Data Absensi

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<div class="row">

    <div class="col-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">

                    <div>

                        <h5 class="card-title mb-1">
                            Riwayat Kehadiran
                        </h5>

                        <p class="text-muted small mb-0">
                            Daftar absensi siswa selama mengikuti kegiatan PKL.
                        </p>

                    </div>

                </div>

                @if($absensis->count())

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead>

                            <tr>

                                <th width="50">#</th>

                                <th>Tanggal</th>

                                <th>Jam Masuk</th>

                                <th>Jam Pulang</th>

                                <th>Status</th>

                                <th>Metode</th>

                                <th class="text-center">Foto</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($absensis as $index => $absensi)

                            <tr>

                                <td>

                                    <span class="text-muted">
                                        {{ $absensis->firstItem() + $index }}
                                    </span>

                                </td>

                                <td>

                                    <div class="d-flex align-items-center">

                                        <div
                                            class="bg-light rounded d-flex align-items-center justify-content-center me-2"
                                            style="width:34px;height:34px;">

                                            <i class="mdi mdi-calendar-outline text-primary"></i>

                                        </div>

                                        <span class="font-weight-medium">

                                            {{ \Carbon\Carbon::parse($absensi->tanggal)->translatedFormat('d F Y') }}

                                        </span>

                                    </div>

                                </td>

                                <td>

                                    @if($absensi->jam_masuk)

                                    <span class="text-success">

                                        <i class="mdi mdi-login me-1"></i>

                                        {{ $absensi->jam_masuk }}

                                    </span>

                                    @else

                                    <span class="text-muted">-</span>

                                    @endif

                                </td>

                                <td>

                                    @if($absensi->jam_pulang)

                                    <span class="text-danger">

                                        <i class="mdi mdi-logout me-1"></i>

                                        {{ $absensi->jam_pulang }}

                                    </span>

                                    @else

                                    <span class="text-muted">-</span>

                                    @endif

                                </td>

                                <td>

                                    @if($absensi->status === 'hadir')

                                    <span class="badge bg-success">
                                        <i class="mdi mdi-check-circle-outline me-1"></i>
                                        Hadir
                                    </span>

                                    @elseif($absensi->status === 'izin')

                                    <span class="badge bg-warning text-dark">
                                        <i class="mdi mdi-information-outline me-1"></i>
                                        Izin
                                    </span>

                                    @elseif($absensi->status === 'sakit')

                                    <span class="badge bg-info">
                                        <i class="mdi mdi-hospital-box-outline me-1"></i>
                                        Sakit
                                    </span>

                                    @elseif($absensi->status === 'alpha')

                                    <span class="badge bg-danger">
                                        <i class="mdi mdi-close-circle-outline me-1"></i>
                                        Alpha
                                    </span>

                                    @else

                                    <span class="badge bg-secondary">
                                        {{ ucfirst($absensi->status ?? '-') }}
                                    </span>

                                    @endif

                                </td>

                                <td>

                                    @if($absensi->metode_verifikasi)

                                    <span class="text-muted">

                                        <i class="mdi mdi-shield-check-outline text-primary me-1"></i>

                                        {{ $absensi->metode_verifikasi }}

                                    </span>

                                    @else

                                    <span class="text-muted">-</span>

                                    @endif

                                </td>

                                <td class="text-center">

                                    <div class="d-flex justify-content-center gap-1">

                                        @if($absensi->foto_masuk)

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-outline-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalFotoMasuk{{ $absensi->id }}">

                                            <i class="mdi mdi-login"></i>

                                        </button>

                                        @endif

                                        @if($absensi->foto_pulang)

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-outline-success"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalFotoPulang{{ $absensi->id }}">

                                            <i class="mdi mdi-logout"></i>

                                        </button>

                                        @endif

                                        @if(!$absensi->foto_masuk && !$absensi->foto_pulang)

                                        <span class="text-muted">-</span>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                @foreach($absensis as $absensi)

                @if($absensi->foto_masuk)

                <div
                    class="modal fade"
                    id="modalFotoMasuk{{ $absensi->id }}"
                    tabindex="-1"
                    aria-hidden="true">

                    <div class="modal-dialog modal-dialog-centered modal-lg">

                        <div class="modal-content">

                            <div class="modal-header">

                                <h5 class="modal-title">

                                    <i class="mdi mdi-login text-primary me-1"></i>

                                    Foto Absensi Masuk

                                </h5>

                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal">
                                </button>

                            </div>

                            <div class="modal-body text-center">

                                <img
                                    src="{{ asset('storage/' . $absensi->foto_masuk) }}"
                                    class="img-fluid rounded"
                                    style="max-height:550px;"
                                    alt="Foto absensi masuk">

                                <div class="mt-3">

                                    <h6 class="font-weight-bold mb-1">

                                        {{ $siswa->user->name ?? '-' }}

                                    </h6>

                                    <small class="text-muted">

                                        {{ \Carbon\Carbon::parse($absensi->tanggal)->translatedFormat('d F Y') }}

                                        &nbsp;•&nbsp;

                                        {{ $absensi->jam_masuk ?? '-' }}

                                    </small>

                                </div>

                            </div>

                            <div class="modal-footer">

                                <button
                                    type="button"
                                    class="btn btn-light"
                                    data-bs-dismiss="modal">

                                    Tutup

                                </button>

                            </div>

                        </div>

                    </div>

                </div>

                @endif


                @if($absensi->foto_pulang)

                <div
                    class="modal fade"
                    id="modalFotoPulang{{ $absensi->id }}"
                    tabindex="-1"
                    aria-hidden="true">

                    <div class="modal-dialog modal-dialog-centered modal-lg">

                        <div class="modal-content">

                            <div class="modal-header">

                                <h5 class="modal-title">

                                    <i class="mdi mdi-logout text-success me-1"></i>

                                    Foto Absensi Pulang

                                </h5>

                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal">
                                </button>

                            </div>

                            <div class="modal-body text-center">

                                <img
                                    src="{{ asset('storage/' . $absensi->foto_pulang) }}"
                                    class="img-fluid rounded"
                                    style="max-height:550px;"
                                    alt="Foto absensi pulang">

                                <div class="mt-3">

                                    <h6 class="font-weight-bold mb-1">

                                        {{ $siswa->user->name ?? '-' }}

                                    </h6>

                                    <small class="text-muted">

                                        {{ \Carbon\Carbon::parse($absensi->tanggal)->translatedFormat('d F Y') }}

                                        &nbsp;•&nbsp;

                                        {{ $absensi->jam_pulang ?? '-' }}

                                    </small>

                                </div>

                            </div>

                            <div class="modal-footer">

                                <button
                                    type="button"
                                    class="btn btn-light"
                                    data-bs-dismiss="modal">

                                    Tutup

                                </button>

                            </div>

                        </div>

                    </div>

                </div>

                @endif

                @endforeach


                @if($absensis->hasPages())

                <div class="d-flex justify-content-between align-items-center flex-wrap mt-4 pt-3 border-top">

                    <small class="text-muted mb-2 mb-md-0">

                        Menampilkan

                        <strong>{{ $absensis->firstItem() }}</strong>

                        sampai

                        <strong>{{ $absensis->lastItem() }}</strong>

                        dari

                        <strong>{{ $absensis->total() }}</strong>

                        data

                    </small>

                    <div class="mt-2 mt-md-0">

                        {{ $absensis->onEachSide(1)->links('pagination::bootstrap-5') }}

                    </div>

                </div>

                @endif

                @else

                <div class="text-center py-5">

                    <div
                        class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                        style="width:80px;height:80px;">

                        <i
                            class="mdi mdi-calendar-remove-outline text-muted"
                            style="font-size:40px;">
                        </i>

                    </div>

                    <h5 class="font-weight-bold mb-2">
                        Belum Ada Data Absensi
                    </h5>

                    <p class="text-muted small mb-0">
                        Siswa belum memiliki riwayat absensi dalam sistem.
                    </p>

                </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection