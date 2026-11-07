@extends('layouts.skydash-admin')

@section('title', 'Penilaian Guru Pembimbing')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="icon-box bg-primary text-white rounded p-3 me-3">
                            <i class="mdi mdi-school mdi-24px"></i>
                        </div>
                        <div>
                            <h4 class="card-title mb-1 font-weight-bold">Penilaian Guru Pembimbing</h4>
                            <p class="text-muted mb-0">Monitoring dan pengelolaan seluruh hasil penilaian dari guru pembimbing sekolah.</p>
                        </div>
                    </div>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-icon-text">
                        <i class="mdi mdi-arrow-left btn-icon-prepend"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Alert Messages --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3 border-0 shadow-sm" role="alert">
        <i class="mdi mdi-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-3 border-0 shadow-sm" role="alert">
        <i class="mdi mdi-alert-circle me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Ringkasan Statistik -->
<div class="row mt-4">
    <div class="col-md-4 col-lg-2-4 mb-3">
        <div class="card border-0 shadow-sm bg-primary text-white h-100">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-white-50 text-uppercase fs-7 mb-1">Total penilaian</h6>
                    <h3 class="mb-0 font-weight-bold">{{ $totalPenilaian ?? 0 }}</h3>
                </div>
                <i class="mdi mdi-clipboard-text-outline mdi-36px opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-2-4 mb-3">
        <div class="card border-0 shadow-sm bg-success text-white h-100">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-white-50 text-uppercase fs-7 mb-1">Nilai A</h6>
                    <h3 class="mb-0 font-weight-bold">{{ $nilaiA ?? 0 }}</h3>
                </div>
                <i class="mdi mdi-alpha-a-circle-outline mdi-36px opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-2-4 mb-3">
        <div class="card border-0 shadow-sm bg-info text-white h-100">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-white-50 text-uppercase fs-7 mb-1">Nilai B</h6>
                    <h3 class="mb-0 font-weight-bold">{{ $nilaiB ?? 0 }}</h3>
                </div>
                <i class="mdi mdi-alpha-b-circle-outline mdi-36px opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-2-4 mb-3">
        <div class="card border-0 shadow-sm bg-warning text-dark h-100">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-dark-50 text-uppercase fs-7 mb-1">Nilai C</h6>
                    <h3 class="mb-0 font-weight-bold">{{ $nilaiC ?? 0 }}</h3>
                </div>
                <i class="mdi mdi-alpha-c-circle-outline mdi-36px opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-2-4 mb-3">
        <div class="card border-0 shadow-sm bg-danger text-white h-100">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-white-50 text-uppercase fs-7 mb-1">Nilai D</h6>
                    <h3 class="mb-0 font-weight-bold">{{ $nilaiD ?? 0 }}</h3>
                </div>
                <i class="mdi mdi-alpha-d-circle-outline mdi-36px opacity-50"></i>
            </div>
        </div>
    </div>
</div>

<!-- Filter & Search Card -->
<div class="card border-0 shadow-sm mt-2">
    <div class="card-body">
        <h6 class="card-title mb-3"><i class="mdi mdi-filter-variant me-1"></i> Filter Data</h6>
        <form method="GET" action="{{ route('admin.penilaian-guru') }}">
            <div class="row align-items-end g-3">
                <div class="col-md-3">
                    <label class="form-label text-muted small fw-bold">NAMA SISWA</label>
                    <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Cari nama / NISN...">
                </div>

                <div class="col-md-2">
                    <label class="form-label text-muted small fw-bold">JURUSAN</label>
                    <select class="form-select form-control" name="jurusan">
                        <option value="">Semua Jurusan</option>
                        @foreach($jurusans as $jurusan)
                            <option value="{{ $jurusan->id }}" {{ request('jurusan') == $jurusan->id ? 'selected' : '' }}>
                                {{ $jurusan->nama_jurusan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label text-muted small fw-bold">KELAS</label>
                    <select class="form-select form-control" name="kelas">
                        <option value="">Semua Kelas</option>
                        @foreach($kelas as $itemKelas)
                            <option value="{{ $itemKelas->id }}" {{ request('kelas') == $itemKelas->id ? 'selected' : '' }}>
                                {{ $itemKelas->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label text-muted small fw-bold">GURU PEMBIMBING</label>
                    <select class="form-select form-control" name="guru">
                        <option value="">Semua Guru</option>
                        @foreach($gurus as $guru)
                            <option value="{{ $guru->id }}" {{ request('guru') == $guru->id ? 'selected' : '' }}>
                                {{ $guru->user->name ?? '-' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="mdi mdi-magnify me-1"></i> Cari
                    </button>
                    @if(request()->anyFilled(['search', 'jurusan', 'kelas', 'guru']))
                        <a href="{{ route('admin.penilaian-guru') }}" class="btn btn-light" title="Reset Filter">
                            <i class="mdi mdi-refresh"></i>
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Tabel Data Penilaian -->
<div class="card border-0 shadow-sm mt-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title mb-0">Daftar Penilaian Guru Pembimbing</h5>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light text-uppercase fs-7">
                    <tr>
                        <th width="50" class="text-center">No</th>
                        <th>Siswa</th>
                        <th>Guru Pembimbing</th>
                        <th>Perusahaan / Tempat PKL</th>
                        <th width="200">Nilai Akhir</th>
                        <th width="80" class="text-center">Grade</th>
                        <th width="100" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penilaians as $penilaian)
                        @php
                            $nilai = $penilaian->nilai_akhir;
                            if ($nilai >= 90) {
                                $grade = 'A'; $badge = 'success';
                            } elseif ($nilai >= 80) {
                                $grade = 'B'; $badge = 'primary';
                            } elseif ($nilai >= 70) {
                                $grade = 'C'; $badge = 'warning';
                            } else {
                                $grade = 'D'; $badge = 'danger';
                            }
                        @endphp
                        <tr>
                            <td class="text-center fw-bold">{{ $loop->iteration + ($penilaians->firstItem() - 1) }}</td>
                            <td>
                                <div class="fw-bold text-dark">{{ $penilaian->penempatan->siswa->user->name ?? '-' }}</div>
                                <small class="text-muted"><i class="mdi mdi-card-account-details-outline me-1"></i>{{ $penilaian->penempatan->siswa->nisn ?? '-' }}</small>
                            </td>
                            <td>
                                <span class="fw-semibold text-dark">{{ $penilaian->guru->user->name ?? '-' }}</span>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">{{ $penilaian->penempatan->perusahaan->nama_perusahaan ?? '-' }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="progress flex-grow-1" style="height: 8px; border-radius: 4px;">
                                        <div class="progress-bar bg-{{ $badge }}" role="progressbar" style="width: {{ min($nilai, 100) }}%;"></div>
                                    </div>
                                    <span class="fw-bold small">{{ number_format($nilai, 2) }}</span>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-{{ $badge }} rounded-pill">{{ $grade }}</span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary btn-icon-text" data-bs-toggle="modal" data-bs-target="#detailGuru{{ $penilaian->id }}">
                                    <i class="mdi mdi-eye"></i> Detail
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="text-center py-5">
                                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486754.png" width="80" alt="Empty" class="opacity-50 mb-3">
                                    <h6 class="text-muted">Belum ada data penilaian dari guru pembimbing.</h6>
                                </div>
                            </td>
                        </tr>
                    @endempty
                </tbody>
            </table>
        </div>

        <div class="mt-4 d-flex justify-content-between align-items-center">
            <small class="text-muted">Menampilkan {{ $penilaians->firstItem() ?? 0 }} - {{ $penilaians->lastItem() ?? 0 }} dari {{ $penilaians->total() }} data</small>
            <div>
                {{ $penilaians->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

{{-- MODAL DETAIL & EDIT PENILAIAN GURU --}}
@foreach($penilaians as $penilaian)
    @php
        $nilai = $penilaian->nilai_akhir;
        if ($nilai >= 90) {
            $grade = 'A'; $predikat = 'Sangat Baik'; $warna = 'success';
        } elseif ($nilai >= 80) {
            $grade = 'B'; $predikat = 'Baik'; $warna = 'primary';
        } elseif ($nilai >= 70) {
            $grade = 'C'; $predikat = 'Cukup'; $warna = 'warning';
        } else {
            $grade = 'D'; $predikat = 'Kurang'; $warna = 'danger';
        }
    @endphp

    <div class="modal fade" id="detailGuru{{ $penilaian->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content border-0 shadow">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold">
                        <i class="mdi mdi-school me-1"></i> Detail Penilaian Guru Pembimbing
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4">
                    <div class="row g-3">
                        <!-- Informasi Siswa -->
                        <div class="col-md-7">
                            <div class="card border-0 shadow-sm h-100 bg-light">
                                <div class="card-body">
                                    <h6 class="card-title text-primary font-weight-bold mb-3">
                                        <i class="mdi mdi-account-card-details me-1"></i> Informasi Siswa & Instansi
                                    </h6>
                                    <table class="table table-borderless table-sm">
                                        <tr>
                                            <td width="35%" class="text-muted">Nama Siswa</td>
                                            <td class="fw-bold text-dark">: {{ $penilaian->penempatan->siswa->user->name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">NISN</td>
                                            <td>: {{ $penilaian->penempatan->siswa->nisn ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Jurusan / Kelas</td>
                                            <td>: {{ $penilaian->penempatan->siswa->jurusan->nama_jurusan ?? '-' }} ({{ $penilaian->penempatan->siswa->kelas->nama_kelas ?? '-' }})</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Perusahaan / DUDI</td>
                                            <td>: {{ $penilaian->penempatan->perusahaan->nama_perusahaan ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Guru Pembimbing</td>
                                            <td>: {{ $penilaian->guru->user->name ?? '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Ringkasan Nilai Akhir -->
                        <div class="col-md-5">
                            <div class="card border-0 shadow-sm bg-{{ $warna }} text-white h-100 text-center d-flex flex-column justify-content-center p-3">
                                <h6 class="text-white-50 text-uppercase mb-1">Nilai Akhir</h6>
                                <h1 class="display-3 font-weight-bold mb-0">{{ number_format($penilaian->nilai_akhir, 2) }}</h1>
                                <div>
                                    <span class="badge bg-white text-{{ $warna }} px-3 py-2 rounded-pill mt-2 font-weight-bold">Grade {{ $grade }} ({{ $predikat }})</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Komponen Penilaian -->
                    <div class="card border-0 shadow-sm mt-4">
                        <div class="card-header bg-white font-weight-bold border-bottom">
                            <i class="mdi mdi-format-list-checks me-1"></i> Detail Komponen Penilaian Guru
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Indikator Assessment</th>
                                            <th width="150" class="text-center">Skor (0-100)</th>
                                            <th width="35%">Visualisasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Sikap & Perilaku</td>
                                            <td class="text-center fw-bold">{{ $penilaian->sikap }}</td>
                                            <td>
                                                <div class="progress" style="height: 10px;">
                                                    <div class="progress-bar bg-success" style="width: {{ min($penilaian->sikap, 100) }}%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Laporan PKL</td>
                                            <td class="text-center fw-bold">{{ $penilaian->laporan }}</td>
                                            <td>
                                                <div class="progress" style="height: 10px;">
                                                    <div class="progress-bar bg-info" style="width: {{ min($penilaian->laporan, 100) }}%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Presentasi & Ujian PKL</td>
                                            <td class="text-center fw-bold">{{ $penilaian->presentasi }}</td>
                                            <td>
                                                <div class="progress" style="height: 10px;">
                                                    <div class="progress-bar bg-warning" style="width: {{ min($penilaian->presentasi, 100) }}%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Catatan Pembimbing -->
                    <div class="card border-0 shadow-sm mt-3 bg-light">
                        <div class="card-body">
                            <h6 class="card-title font-weight-bold text-muted mb-2">
                                <i class="mdi mdi-comment-text-outline me-1"></i> Catatan Guru Pembimbing
                            </h6>
                            <p class="card-text text-dark fst-italic mb-0">
                                {{ $penilaian->catatan ?: 'Belum ada catatan dari guru pembimbing.' }}
                            </p>
                        </div>
                    </div>

                    <!-- Form Edit Penilaian -->
                    <div class="card border-0 shadow-sm mt-4 border-top border-warning border-3">
                        <div class="card-header bg-white font-weight-bold">
                            <i class="mdi mdi-pencil-box-outline me-1 text-warning"></i> Form Edit Penilaian Guru
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.penilaian-guru.update', $penilaian->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label small font-weight-bold">Nilai Sikap</label>
                                        <input type="number" name="sikap" class="form-control" min="0" max="100" value="{{ $penilaian->sikap }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small font-weight-bold">Nilai Laporan</label>
                                        <input type="number" name="laporan" class="form-control" min="0" max="100" value="{{ $penilaian->laporan }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small font-weight-bold">Nilai Presentasi</label>
                                        <input type="number" name="presentasi" class="form-control" min="0" max="100" value="{{ $penilaian->presentasi }}" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label small font-weight-bold">Catatan Guru Pembimbing</label>
                                        <textarea class="form-control" rows="3" name="catatan" placeholder="Tambahkan catatan masukan/evaluasi...">{{ $penilaian->catatan }}</textarea>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="if(confirm('Yakin ingin menghapus penilaian ini?')) document.getElementById('delete-guru-form-{{ $penilaian->id }}').submit();">
                                        <i class="mdi mdi-delete me-1"></i> Hapus Penilaian
                                    </button>

                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-success">
                                            <i class="mdi mdi-content-save me-1"></i> Simpan Perubahan
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <form id="delete-guru-form-{{ $penilaian->id }}" action="{{ route('admin.penilaian-guru.destroy', $penilaian->id) }}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endforeach
@endsection