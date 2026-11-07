@extends('layouts.skydash-admin')

@section('title', 'Data Logbook Siswa')

@section('content')
<div class="container-fluid px-0">

    {{-- Header Banner --}}
    <div class="card border-0 shadow-sm rounded-3 mb-4 bg-white">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 bg-primary bg-opacity-10 text-primary rounded-3 d-none d-sm-block">
                        <i class="mdi mdi-notebook-check-outline fs-2 lh-1"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold text-dark mb-1">Data Logbook Siswa</h4>
                        <p class="text-muted mb-0 small">Monitoring, rekapitulasi, dan validasi seluruh aktivitas kegiatan siswa PKL.</p>
                    </div>
                </div>
                <div>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm px-3 py-2 fw-medium rounded-2">
                        <i class="mdi mdi-arrow-left me-1"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Alert Notifications --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="mdi mdi-check-circle fs-4 me-2"></i>
                <div>{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="mdi mdi-alert-circle fs-4 me-2"></i>
                <div>{{ session('error') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Statistics Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 border-start border-primary border-4 shadow-sm rounded-3 bg-white h-100">
                <div class="card-body p-3.5 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted text-uppercase fw-semibold tracking-wider" style="font-size: 0.75rem;">Total Logbook</span>
                        <h3 class="fw-bold mb-0 text-dark mt-1">{{ number_format($totalLogbook) }}</h3>
                    </div>
                    <div class="rounded-3 p-3 bg-primary bg-opacity-10 text-primary">
                        <i class="mdi mdi-notebook-outline fs-3 lh-1"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 border-start border-warning border-4 shadow-sm rounded-3 bg-white h-100">
                <div class="card-body p-3.5 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted text-uppercase fw-semibold tracking-wider" style="font-size: 0.75rem;">Menunggu Validasi</span>
                        <h3 class="fw-bold mb-0 text-dark mt-1">{{ number_format($pending) }}</h3>
                    </div>
                    <div class="rounded-3 p-3 bg-warning bg-opacity-10 text-warning">
                        <i class="mdi mdi-clock-alert-outline fs-3 lh-1"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 border-start border-success border-4 shadow-sm rounded-3 bg-white h-100">
                <div class="card-body p-3.5 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted text-uppercase fw-semibold tracking-wider" style="font-size: 0.75rem;">Disetujui</span>
                        <h3 class="fw-bold mb-0 text-dark mt-1">{{ number_format($disetujui) }}</h3>
                    </div>
                    <div class="rounded-3 p-3 bg-success bg-opacity-10 text-success">
                        <i class="mdi mdi-check-circle-outline fs-3 lh-1"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 border-start border-danger border-4 shadow-sm rounded-3 bg-white h-100">
                <div class="card-body p-3.5 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted text-uppercase fw-semibold tracking-wider" style="font-size: 0.75rem;">Ditolak</span>
                        <h3 class="fw-bold mb-0 text-dark mt-1">{{ number_format($ditolak) }}</h3>
                    </div>
                    <div class="rounded-3 p-3 bg-danger bg-opacity-10 text-danger">
                        <i class="mdi mdi-close-circle-outline fs-3 lh-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter Panel --}}
    <div class="card border-0 shadow-sm rounded-3 mb-4 bg-white">
        <div class="card-body p-4">
            <div class="d-flex align-items-center mb-3">
                <i class="mdi mdi-filter-variant fs-5 text-primary me-2"></i>
                <h6 class="fw-bold text-dark mb-0">Filter & Pencarian Data</h6>
            </div>
            <form action="{{ route('admin.logbook') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label small text-muted fw-medium">Nama / Email Siswa</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text bg-light border-end-0 text-muted"><i class="mdi mdi-magnify"></i></span>
                            <input type="text" class="form-control bg-light border-start-0" name="search" value="{{ request('search') }}" placeholder="Cari siswa...">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small text-muted fw-medium">Tanggal</label>
                        <input type="date" class="form-control bg-light" name="tanggal" value="{{ request('tanggal') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small text-muted fw-medium">Jurusan</label>
                        <select class="form-select bg-light" name="jurusan">
                            <option value="">Semua Jurusan</option>
                            @foreach($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}" {{ request('jurusan') == $jurusan->id ? 'selected' : '' }}>
                                    {{ $jurusan->nama_jurusan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small text-muted fw-medium">Kelas</label>
                        <select class="form-select bg-light" name="kelas">
                            <option value="">Semua Kelas</option>
                            @foreach($kelas as $item)
                                <option value="{{ $item->id }}" {{ request('kelas') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small text-muted fw-medium">Status</label>
                        <select class="form-select bg-light" name="status">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                    <div class="col-md-1 d-flex align-items-end gap-1">
                        <button type="submit" class="btn btn-primary w-100 py-2" title="Terapkan Filter">
                            <i class="mdi mdi-magnify"></i>
                        </button>
                        @if(request()->hasAny(['search', 'tanggal', 'jurusan', 'kelas', 'status']))
                            <a href="{{ route('admin.logbook') }}" class="btn btn-light border w-100 py-2" title="Reset Filter">
                                <i class="mdi mdi-refresh text-muted"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Main Table Card --}}
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden bg-white">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light border-bottom">
                    <tr>
                        <th class="ps-4 py-3 text-muted text-uppercase small fw-bold" style="width: 50px;">No</th>
                        <th class="py-3 text-muted text-uppercase small fw-bold" style="width: 130px;">Tanggal</th>
                        <th class="py-3 text-muted text-uppercase small fw-bold">Siswa</th>
                        <th class="py-3 text-muted text-uppercase small fw-bold">Kelas & Jurusan</th>
                        <th class="py-3 text-muted text-uppercase small fw-bold">Ringkasan Kegiatan</th>
                        <th class="py-3 text-muted text-uppercase small fw-bold text-center">Status</th>
                        <th class="py-3 text-muted text-uppercase small fw-bold text-center">Dokumentasi</th>
                        <th class="pe-4 py-3 text-muted text-uppercase small fw-bold text-center" style="width: 90px;">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($logbooks as $logbook)
                        <tr>
                            <td class="ps-4 fw-medium text-muted small">
                                {{ $loop->iteration + ($logbooks->firstItem() - 1) }}
                            </td>
                            <td class="text-nowrap">
                                <div class="fw-semibold text-dark">{{ \Carbon\Carbon::parse($logbook->tanggal)->translatedFormat('d M Y') }}</div>
                                <span class="text-muted fs-8 d-block">{{ \Carbon\Carbon::parse($logbook->tanggal)->diffForHumans() }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-initial rounded-circle bg-primary bg-opacity-10 text-primary fw-bold me-2.5 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 0.85rem;">
                                        {{ strtoupper(substr($logbook->siswa->user->name ?? 'S', 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-semibold text-dark">{{ $logbook->siswa->user->name ?? '-' }}</div>
                                        <div class="text-muted small fs-8">{{ $logbook->siswa->user->email ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    <span class="badge bg-light text-dark border fw-normal">
                                        {{ $logbook->siswa->kelas->nama_kelas ?? '-' }}
                                    </span>
                                    <span class="badge bg-info bg-opacity-10 text-info fw-normal">
                                        {{ $logbook->siswa->jurusan->nama_jurusan ?? '-' }}
                                    </span>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0 text-secondary text-truncate small" style="max-width: 260px;" title="{{ $logbook->kegiatan }}">
                                    {{ $logbook->kegiatan }}
                                </p>
                            </td>
                            <td class="text-center">
                                @switch($logbook->status_validasi)
                                    @case('pending')
                                        <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-1.5 rounded-pill fw-medium">Pending</span>
                                        @break
                                    @case('disetujui')
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-1.5 rounded-pill fw-medium">Disetujui</span>
                                        @break
                                    @case('ditolak')
                                        <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-1.5 rounded-pill fw-medium">Ditolak</span>
                                        @break
                                @endswitch
                            </td>
                            <td class="text-center">
                                @if($logbook->fotos->count())
                                    <div class="position-relative d-inline-block">
                                        <img src="{{ asset('storage/'.$logbook->fotos->first()->foto) }}" class="rounded-2 shadow-sm border" width="42" height="42" style="object-fit: cover;">
                                        @if($logbook->fotos->count() > 1)
                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark border border-light fs-8">
                                                +{{ $logbook->fotos->count() - 1 }}
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-muted small"><i class="mdi mdi-image-off me-1"></i> -</span>
                                @endif
                            </td>
                            <td class="pe-4 text-center">
                                <button class="btn btn-sm btn-light border text-primary rounded-2 px-2.5 py-1.5" data-bs-toggle="modal" data-bs-target="#detail{{ $logbook->id }}" title="Lihat Detail & Validasi">
                                    <i class="mdi mdi-eye fs-6"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="py-4">
                                    <div class="avatar bg-light text-muted rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                                        <i class="mdi mdi-notebook-remove fs-1"></i>
                                    </div>
                                    <h6 class="fw-bold text-dark mb-1">Belum Ada Data Logbook</h6>
                                    <p class="text-muted small mb-0">Silakan sesuaikan filter pencarian untuk menemukan data yang dicari.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($logbooks->hasPages())
            <div class="px-4 py-3 bg-light border-top d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                <div class="small text-muted">
                    Menampilkan <strong>{{ $logbooks->firstItem() }}</strong> - <strong>{{ $logbooks->lastItem() }}</strong> dari <strong>{{ $logbooks->total() }}</strong> data
                </div>
                <div>
                    {{ $logbooks->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
</div>

{{-- MODAL DETAIL LOGBOOK --}}
@foreach($logbooks as $logbook)
<div class="modal fade" id="detail{{ $logbook->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <div class="modal-header bg-dark text-white p-3.5">
                <div class="d-flex align-items-center">
                    <i class="mdi mdi-notebook-edit me-2 fs-5"></i>
                    <h6 class="modal-title fw-bold mb-0">Detail Logbook Siswa</h6>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body p-4 bg-light">
                {{-- Info Overview Grid --}}
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-3 h-100 bg-white">
                            <div class="card-body p-3.5">
                                <span class="text-uppercase text-muted fw-bold fs-8 d-block mb-3">Informasi Siswa</span>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar bg-primary bg-opacity-10 text-primary rounded-circle me-3 d-flex align-items-center justify-content-center fw-bold fs-5" style="width: 48px; height: 48px;">
                                        {{ strtoupper(substr($logbook->siswa->user->name ?? 'S', 0, 1)) }}
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold text-dark">{{ $logbook->siswa->user->name ?? '-' }}</h6>
                                        <span class="text-muted small">{{ $logbook->siswa->user->email ?? '-' }}</span>
                                    </div>
                                </div>
                                <div class="row g-2 border-top pt-3">
                                    <div class="col-6">
                                        <small class="text-muted d-block fs-8">NISN</small>
                                        <span class="fw-semibold text-dark small">{{ $logbook->siswa->nisn ?? '-' }}</span>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block fs-8">Kelas / Jurusan</small>
                                        <span class="fw-semibold text-dark small">
                                            {{ $logbook->siswa->kelas->nama_kelas ?? '-' }} / {{ $logbook->siswa->jurusan->nama_jurusan ?? '-' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-3 h-100 bg-white">
                            <div class="card-body p-3.5">
                                <span class="text-uppercase text-muted fw-bold fs-8 d-block mb-3">Metadata Aktivitas</span>
                                <div class="row g-3">
                                    <div class="col-6">
                                        <small class="text-muted d-block fs-8">Tanggal Aktivitas</small>
                                        <span class="fw-bold text-dark small">{{ \Carbon\Carbon::parse($logbook->tanggal)->translatedFormat('l, d F Y') }}</span>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block fs-8">Status Validasi</small>
                                        @switch($logbook->status_validasi)
                                            @case('pending')
                                                <span class="badge bg-warning text-dark px-2.5 py-1 fs-8">Pending</span>
                                                @break
                                            @case('disetujui')
                                                <span class="badge bg-success px-2.5 py-1 fs-8">Disetujui</span>
                                                @break
                                            @case('ditolak')
                                                <span class="badge bg-danger px-2.5 py-1 fs-8">Ditolak</span>
                                                @break
                                        @endswitch
                                    </div>
                                    <div class="col-6 border-top pt-2">
                                        <small class="text-muted d-block fs-8">Tanggal Input</small>
                                        <span class="small text-dark">{{ $logbook->created_at ? $logbook->created_at->format('d/m/Y H:i') : '-' }}</span>
                                    </div>
                                    <div class="col-6 border-top pt-2">
                                        <small class="text-muted d-block fs-8">Pembaruan Terakhir</small>
                                        <span class="small text-dark">{{ $logbook->updated_at ? $logbook->updated_at->format('d/m/Y H:i') : '-' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Deskripsi Kegiatan --}}
                <div class="card border-0 shadow-sm rounded-3 mb-4 bg-white">
                    <div class="card-body p-4">
                        <span class="text-uppercase text-muted fw-bold fs-8 d-block mb-2">Deskripsi Kegiatan</span>
                        <p class="text-dark mb-0 lh-lg small" style="white-space: pre-line;">{{ $logbook->kegiatan }}</p>
                    </div>
                </div>

                {{-- Kendala & Solusi --}}
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-3 h-100 bg-white">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="mdi mdi-alert-circle-outline text-warning fs-5 me-1.5"></i>
                                    <span class="text-uppercase text-warning fw-bold fs-8">Kendala Dihadapi</span>
                                </div>
                                <p class="text-dark mb-0 small lh-base" style="white-space: pre-line;">{{ $logbook->kendala ?: 'Tidak ada kendala yang dilaporkan.' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-3 h-100 bg-white">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="mdi mdi-lightbulb-on-outline text-success fs-5 me-1.5"></i>
                                    <span class="text-uppercase text-success fw-bold fs-8">Solusi / Penanganan</span>
                                </div>
                                <p class="text-dark mb-0 small lh-base" style="white-space: pre-line;">{{ $logbook->solusi ?: 'Belum ada penjelasan solusi.' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Galeri Foto --}}
                <div class="card border-0 shadow-sm rounded-3 mb-4 bg-white">
                    <div class="card-body p-4">
                        <span class="text-uppercase text-muted fw-bold fs-8 d-block mb-3">Dokumentasi Foto</span>
                        <div class="row g-3">
                            @forelse($logbook->fotos as $foto)
                                <div class="col-6 col-md-3">
                                    <a href="{{ asset('storage/'.$foto->foto) }}" target="_blank" class="d-block overflow-hidden rounded-3 shadow-sm border position-relative group">
                                        <img src="{{ asset('storage/'.$foto->foto) }}" class="img-fluid w-100" style="height: 140px; object-fit: cover;">
                                    </a>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="p-3 bg-light text-muted text-center rounded-3 border border-dashed">
                                        <small>Tidak ada foto dokumentasi yang diunggah.</small>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Form Validasi --}}
                <div class="card border-0 shadow-sm rounded-3 bg-white">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="mdi mdi-shield-check-outline text-primary fs-5 me-2"></i>
                            <h6 class="fw-bold text-dark mb-0">Form Validasi Pembimbing</h6>
                        </div>
                        <form action="{{ route('guru.logbook.validasi', $logbook->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label small fw-semibold">Status Verifikasi</label>
                                    <select name="status_validasi" class="form-select bg-light">
                                        <option value="pending" {{ $logbook->status_validasi == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="disetujui" {{ $logbook->status_validasi == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                        <option value="ditolak" {{ $logbook->status_validasi == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label small fw-semibold">Catatan Pembimbing</label>
                                    <textarea name="catatan_guru" rows="3" class="form-control bg-light" placeholder="Berikan arahan atau alasan penolakan/persetujuan...">{{ $logbook->catatan_guru }}</textarea>
                                </div>
                            </div>
                            <div class="text-end mt-3">
                                <button type="submit" class="btn btn-success px-4 rounded-2">
                                    <i class="mdi mdi-content-save me-1"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="modal-footer bg-light p-3">
                <button type="button" class="btn btn-secondary btn-sm px-4 rounded-2" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection