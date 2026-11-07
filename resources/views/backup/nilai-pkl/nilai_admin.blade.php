@extends('layouts.skydash-admin')

@section('title', 'Nilai PKL')

@section('content')
<!-- Page Header -->
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center bg-white p-3 rounded-3 shadow-sm">
            <div>
                <h4 class="fw-bold mb-1 text-dark">Rekapitulasi Nilai PKL</h4>
                <p class="text-muted mb-0 small">Pantau dan kelola pencapaian nilai akhir seluruh siswa PKL</p>
            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm px-3">
                <i class="mdi mdi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</div>

<!-- Alert Notifications -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <i class="mdi mdi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <i class="mdi mdi-alert-circle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Summary Metric Cards (Clean & Minimalist) -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-4 col-lg-2">
        <div class="card border-0 shadow-sm h-100 border-start border-4 border-primary">
            <div class="card-body p-3">
                <span class="text-muted small fw-semibold d-block text-uppercase">Total Data</span>
                <h3 class="fw-bold mb-0 mt-1 text-dark">{{ $totalNilai }}</h3>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2">
        <div class="card border-0 shadow-sm h-100 border-start border-4 border-success">
            <div class="card-body p-3">
                <span class="text-success small fw-semibold d-block text-uppercase">Grade A</span>
                <h3 class="fw-bold mb-0 mt-1 text-success">{{ $gradeA }}</h3>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2">
        <div class="card border-0 shadow-sm h-100 border-start border-4 border-info">
            <div class="card-body p-3">
                <span class="text-info small fw-semibold d-block text-uppercase">Grade B</span>
                <h3 class="fw-bold mb-0 mt-1 text-info">{{ $gradeB }}</h3>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2">
        <div class="card border-0 shadow-sm h-100 border-start border-4 border-warning">
            <div class="card-body p-3">
                <span class="text-warning small fw-semibold d-block text-uppercase">Grade C</span>
                <h3 class="fw-bold mb-0 mt-1 text-warning">{{ $gradeC }}</h3>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2">
        <div class="card border-0 shadow-sm h-100 border-start border-4 border-danger">
            <div class="card-body p-3">
                <span class="text-danger small fw-semibold d-block text-uppercase">Grade D</span>
                <h3 class="fw-bold mb-0 mt-1 text-danger">{{ $gradeD }}</h3>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2">
        <div class="card border-0 shadow-sm h-100 border-start border-4 border-dark">
            <div class="card-body p-3">
                <span class="text-secondary small fw-semibold d-block text-uppercase">Grade E</span>
                <h3 class="fw-bold mb-0 mt-1 text-dark">{{ $gradeE }}</h3>
            </div>
        </div>
    </div>
</div>

<!-- Search & Filter Card -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('admin.nilai-pkl') }}">
            <div class="row g-2 align-items-center">
                <div class="col-md-3">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light border-0"><i class="mdi mdi-magnify text-muted"></i></span>
                        <input type="text" name="search" class="form-control bg-light border-0" placeholder="Cari nama siswa..." value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-md-2">
                    <select name="jurusan" class="form-select form-select-sm bg-light border-0">
                        <option value="">Semua Jurusan</option>
                        @foreach($jurusans as $jurusan)
                            <option value="{{ $jurusan->id }}" {{ request('jurusan') == $jurusan->id ? 'selected' : '' }}>
                                {{ $jurusan->nama_jurusan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="kelas" class="form-select form-select-sm bg-light border-0">
                        <option value="">Semua Kelas</option>
                        @foreach($kelas as $itemKelas)
                            <option value="{{ $itemKelas->id }}" {{ request('kelas') == $itemKelas->id ? 'selected' : '' }}>
                                {{ $itemKelas->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <select name="industri" class="form-select form-select-sm bg-light border-0">
                        <option value="">Semua Perusahaan / Industri</option>
                        @foreach($industris as $industri)
                            <option value="{{ $industri->id }}" {{ request('industri') == $industri->id ? 'selected' : '' }}>
                                {{ $industri->user->name ?? '-' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-sm w-100 fw-semibold">
                        Filter Data
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Main Table Card -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light border-bottom">
                    <tr>
                        <th class="ps-4 py-3 text-muted text-uppercase small fw-bold" width="60">No</th>
                        <th class="py-3 text-muted text-uppercase small fw-bold">Siswa</th>
                        <th class="py-3 text-muted text-uppercase small fw-bold">Guru Pembimbing</th>
                        <th class="py-3 text-muted text-uppercase small fw-bold">Perusahaan</th>
                        <th class="py-3 text-muted text-uppercase small fw-bold" width="150">Nilai Guru (40%)</th>
                        <th class="py-3 text-muted text-uppercase small fw-bold" width="150">Nilai Industri (60%)</th>
                        <th class="py-3 text-muted text-uppercase small fw-bold" width="150">Nilai Akhir</th>
                        <th class="text-center py-3 text-muted text-uppercase small fw-bold" width="90">Grade</th>
                        <th class="text-center pe-4 py-3 text-muted text-uppercase small fw-bold" width="80">Aksi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse($nilaiPKL as $nilai)
                        @php
                            switch($nilai->predikat) {
                                case 'A': $badgeBg = 'bg-success-subtle text-success border border-success-subtle'; break;
                                case 'B': $badgeBg = 'bg-primary-subtle text-primary border border-primary-subtle'; break;
                                case 'C': $badgeBg = 'bg-warning-subtle text-warning border border-warning-subtle'; break;
                                case 'D': $badgeBg = 'bg-danger-subtle text-danger border border-danger-subtle'; break;
                                default:  $badgeBg = 'bg-secondary-subtle text-secondary border border-secondary-subtle'; break;
                            }
                        @endphp
                        <tr>
                            <td class="ps-4 text-muted fw-semibold">{{ $loop->iteration + ($nilaiPKL->firstItem() - 1) }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-initial rounded-circle bg-light text-primary fw-bold me-2 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; font-size: 13px;">
                                        {{ strtoupper(substr($nilai->penempatan->siswa->user->name ?? 'S', 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark mb-0">{{ $nilai->penempatan->siswa->user->name ?? '-' }}</div>
                                        <small class="text-muted">NISN: {{ $nilai->penempatan->siswa->nisn ?? '-' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-secondary small">{{ $nilai->penempatan->guru->user->name ?? '-' }}</td>
                            <td class="text-secondary small">{{ $nilai->penempatan->perusahaan->nama_perusahaan ?? '-' }}</td>
                            
                            <!-- Nilai Guru -->
                            <td>
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <span class="small fw-semibold text-dark">{{ number_format($nilai->nilai_guru, 2) }}</span>
                                </div>
                                <div class="progress rounded-pill" style="height: 5px;">
                                    <div class="progress-bar bg-info rounded-pill" role="progressbar" style="width: {{ min($nilai->nilai_guru, 100) }}%;"></div>
                                </div>
                            </td>

                            <!-- Nilai Industri -->
                            <td>
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <span class="small fw-semibold text-dark">{{ number_format($nilai->nilai_industri, 2) }}</span>
                                </div>
                                <div class="progress rounded-pill" style="height: 5px;">
                                    <div class="progress-bar bg-success rounded-pill" role="progressbar" style="width: {{ min($nilai->nilai_industri, 100) }}%;"></div>
                                </div>
                            </td>

                            <!-- Nilai Akhir -->
                            <td>
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <span class="fw-bold text-dark">{{ number_format($nilai->nilai_akhir, 2) }}</span>
                                </div>
                                <div class="progress rounded-pill" style="height: 5px;">
                                    <div class="progress-bar bg-primary rounded-pill" role="progressbar" style="width: {{ min($nilai->nilai_akhir, 100) }}%;"></div>
                                </div>
                            </td>

                            <td class="text-center">
                                <span class="badge {{ $badgeBg }} rounded-pill px-3 py-1 fw-bold">{{ $nilai->predikat }}</span>
                            </td>
                            
                            <td class="text-center pe-4">
                                <button class="btn btn-light btn-sm rounded-circle p-2" data-bs-toggle="modal" data-bs-target="#detail{{ $nilai->id }}" title="Lihat Detail">
                                    <i class="mdi mdi-eye text-primary"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="mdi mdi-folder-open-outline mdi-48px opacity-50"></i>
                                    <h6 class="mt-2 text-secondary">Belum ada data nilai PKL yang ditemukan.</h6>
                                </div>
                            </td>
                        </tr>
                    @endempty
                </tbody>
            </table>
        </div>

        <div class="p-3 border-top d-flex justify-content-end">
            {{ $nilaiPKL->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

{{-- MODAL DETAIL RAPOR --}}
@foreach($nilaiPKL as $nilai)
    @php
        switch($nilai->predikat) {
            case 'A': $theme = 'success'; $predikat = 'Sangat Baik'; break;
            case 'B': $theme = 'primary'; $predikat = 'Baik'; break;
            case 'C': $theme = 'warning'; $predikat = 'Cukup'; break;
            case 'D': $theme = 'danger'; $predikat = 'Kurang'; break;
            default:  $theme = 'secondary'; $predikat = 'Sangat Kurang'; break;
        }
    @endphp

    <div class="modal fade" id="detail{{ $nilai->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-3">

                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold text-dark">
                        <i class="mdi mdi-certificate text-primary me-2"></i> Rapor Hasil PKL
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4">
                    <!-- Top Hero Card -->
                    <div class="card bg-light border-0 rounded-3 mb-4">
                        <div class="card-body p-4 text-center">
                            <span class="text-muted text-uppercase small fw-semibold">Nilai Akhir Keseluruhan</span>
                            <h1 class="display-4 fw-bold text-dark my-1">{{ number_format($nilai->nilai_akhir, 2) }}</h1>
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <span class="badge bg-{{ $theme }} px-3 py-1 fs-6">Grade {{ $nilai->predikat }}</span>
                                <span class="text-muted fw-semibold">• {{ $predikat }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4">
                        <!-- Left Column: Data Siswa -->
                        <div class="col-md-6">
                            <h6 class="fw-bold text-dark mb-3"><i class="mdi mdi-account-outline me-1"></i> Informasi Siswa</h6>
                            <div class="bg-white border rounded-3 p-3">
                                <div class="mb-2 pb-2 border-bottom d-flex justify-content-between">
                                    <span class="text-muted small">Nama Lengkap</span>
                                    <span class="fw-semibold text-dark small">{{ $nilai->penempatan->siswa->user->name ?? '-' }}</span>
                                </div>
                                <div class="mb-2 pb-2 border-bottom d-flex justify-content-between">
                                    <span class="text-muted small">NISN</span>
                                    <span class="fw-semibold text-dark small">{{ $nilai->penempatan->siswa->nisn ?? '-' }}</span>
                                </div>
                                <div class="mb-2 pb-2 border-bottom d-flex justify-content-between">
                                    <span class="text-muted small">Jurusan</span>
                                    <span class="fw-semibold text-dark small">{{ $nilai->penempatan->siswa->jurusan->nama_jurusan ?? '-' }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted small">Kelas</span>
                                    <span class="fw-semibold text-dark small">{{ $nilai->penempatan->siswa->kelas->nama_kelas ?? '-' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Pembimbing & Lokasi -->
                        <div class="col-md-6">
                            <h6 class="fw-bold text-dark mb-3"><i class="mdi mdi-domain me-1"></i> Instansi & Pembimbing</h6>
                            <div class="bg-white border rounded-3 p-3">
                                <div class="mb-2 pb-2 border-bottom d-flex justify-content-between">
                                    <span class="text-muted small">Perusahaan</span>
                                    <span class="fw-semibold text-dark small">{{ $nilai->penempatan->perusahaan->nama_perusahaan ?? '-' }}</span>
                                </div>
                                <div class="mb-2 pb-2 border-bottom d-flex justify-content-between">
                                    <span class="text-muted small">Guru Pembimbing</span>
                                    <span class="fw-semibold text-dark small">{{ $nilai->penempatan->guru->user->name ?? '-' }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted small">Pembimbing Industri</span>
                                    <span class="fw-semibold text-dark small">{{ $nilai->penempatan->industri->user->name ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Komponen Rincian Nilai -->
                    <h6 class="fw-bold text-dark mt-4 mb-3"><i class="mdi mdi-calculator me-1"></i> Rincian Perhitungan Komponen</h6>
                    <div class="border rounded-3 p-3 bg-white">
                        <div class="row align-items-center mb-3">
                            <div class="col-md-5">
                                <span class="fw-semibold text-dark small">Nilai Guru (Bobot 40%)</span>
                            </div>
                            <div class="col-md-7">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="progress flex-grow-1 rounded-pill" style="height: 8px;">
                                        <div class="progress-bar bg-info rounded-pill" style="width: {{ min($nilai->nilai_guru, 100) }}%;"></div>
                                    </div>
                                    <span class="fw-bold small text-dark" style="min-width: 45px; text-align: right;">{{ number_format($nilai->nilai_guru, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <span class="fw-semibold text-dark small">Nilai Industri (Bobot 60%)</span>
                            </div>
                            <div class="col-md-7">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="progress flex-grow-1 rounded-pill" style="height: 8px;">
                                        <div class="progress-bar bg-success rounded-pill" style="width: {{ min($nilai->nilai_industri, 100) }}%;"></div>
                                    </div>
                                    <span class="fw-bold small text-dark" style="min-width: 45px; text-align: right;">{{ number_format($nilai->nilai_industri, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-top-0 pt-0 px-4 pb-4 d-flex justify-content-between">
                    <form action="{{ route('admin.nilai-pkl.destroy', $nilai->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data nilai ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="mdi mdi-trash-can-outline me-1"></i> Hapus Data
                        </button>
                    </form>

                    <button type="button" class="btn btn-secondary btn-sm px-4" data-bs-dismiss="modal">
                        Tutup
                    </button>
                </div>

            </div>
        </div>
    </div>
@endforeach
@endsection