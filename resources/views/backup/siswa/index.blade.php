@extends('layouts.skydash-admin')

@section('title', 'Data Siswa')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title">Manajemen Data Siswa</h4>
                    <a href="{{ route('siswa.create') }}" class="btn btn-primary btn-icon-text">
                        <i class="mdi mdi-plus btn-icon-prepend"></i> Tambah Siswa
                    </a>
                </div>

                {{-- Form Pencarian & Import Excel --}}
                <div class="row mb-4">
                    {{-- Form Search --}}
                    <div class="col-md-7 mb-3 mb-md-0">
                        <form action="{{ route('siswa.index') }}" method="GET" class="d-flex">
                            <input 
                                type="text" 
                                name="search" 
                                class="form-control form-control-sm me-2" 
                                placeholder="Cari Nama / NISN..." 
                                value="{{ request('search') }}">

                            <select 
                                name="face_status" 
                                class="form-select form-select-sm me-2" 
                                style="max-width:220px;">
                                <option value="">Semua Status</option>
                                <option value="registered" {{ request('face_status') == 'registered' ? 'selected' : '' }}>
                                    Sudah Registrasi
                                </option>
                                <option value="not_registered" {{ request('face_status') == 'not_registered' ? 'selected' : '' }}>
                                    Belum Registrasi
                                </option>
                            </select>

                            <select
    name="jurusan"
    class="form-select form-select-sm me-2"
    style="max-width:220px;">

    <option value="">

        Semua Jurusan

    </option>

    @foreach($jurusans as $jurusan)

        <option
            value="{{ $jurusan->id }}"
            {{ request('jurusan') == $jurusan->id ? 'selected' : '' }}>

            {{ $jurusan->nama_jurusan }}

        </option>

    @endforeach

</select>

                            <button class="btn btn-primary btn-sm btn-icon-text me-2" type="submit">
                                <i class="mdi mdi-magnify btn-icon-prepend"></i> Cari
                            </button>

                           @if(
    request('search') ||
    request('face_status') ||
    request('jurusan')
)
                                <a href="{{ route('siswa.index') }}" class="btn btn-secondary btn-sm">
                                    Reset
                                </a>
                            @endif
                        </form>
                    </div>

                    {{-- Form Import Excel --}}
                    <div class="col-md-5 text-md-end">
                        <form action="{{ route('siswa.import') }}" method="POST" enctype="multipart/form-data" class="d-inline-flex align-items-center justify-content-md-end">
                            @csrf
                            <div class="form-group mb-0 me-2">
                                <input type="file" name="file" class="form-control form-control-sm" required>
                            </div>
                            <button type="submit" class="btn btn-success btn-sm btn-icon-text">
                                <i class="mdi mdi-file-excel btn-icon-prepend"></i> Import
                            </button>
                        </form>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success mb-4">
                        <i class="mdi mdi-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                {{-- Card Statistik --}}
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card border-left-primary shadow-sm">
                            <div class="card-body">
                                <h6 class="text-muted mb-2">Total Siswa</h6>
                                <h3 class="font-weight-bold text-primary mb-0">
                                    {{ $totalSiswa }}
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-left-success shadow-sm">
                            <div class="card-body">
                                <h6 class="text-muted mb-2">Sudah Registrasi Wajah</h6>
                                <h3 class="font-weight-bold text-success mb-0">
                                    {{ $totalRegistered }}
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-left-danger shadow-sm">
                            <div class="card-body">
                                <h6 class="text-muted mb-2">Belum Registrasi Wajah</h6>
                                <h3 class="font-weight-bold text-danger mb-0">
                                    {{ $totalNotRegistered }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NISN</th>
                                <th>Jurusan</th>
                                <th>Kelas</th>
                                <th>No HP</th>
                                <th class="text-center">Status Wajah</th>
                                <th class="text-center">Aksi</th>
                                <th class="text-center">Reset Wajah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($siswas as $siswa)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <h6 class="font-weight-bold mb-0">{{ $siswa->user->name }}</h6>
                                    <small class="text-muted">{{ $siswa->user->email }}</small>
                                </td>
                                <td>{{ $siswa->nisn }}</td>
                                <td>
                                    <label class="badge badge-info">{{ $siswa->jurusan->nama_jurusan ?? '-' }}</label>
                                </td>
                                <td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                                <td>{{ $siswa->no_hp }}</td>
                                
                                <td class="text-center">
                                    @if($siswa->faceProfile && $siswa->faceProfile->is_registered)
                                        <span class="badge badge-success">
                                            <i class="mdi mdi-check-circle"></i> Sudah Registrasi
                                        </span>
                                    @else
                                        <span class="badge badge-danger">
                                            <i class="mdi mdi-close-circle"></i> Belum Registrasi
                                        </span>
                                    @endif
                                </td>

                                {{-- Kolom Aksi yang diperbarui --}}
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        {{-- Detail --}}
                                        <a href="{{ route('siswa.show', $siswa->id) }}" 
                                           class="btn btn-outline-info btn-sm" 
                                           title="Detail Siswa">
                                            <i class="mdi mdi-eye"></i>
                                        </a>

                                        {{-- Edit --}}
                                        <a href="{{ route('siswa.edit', $siswa->id) }}" 
                                           class="btn btn-outline-primary btn-sm" 
                                           title="Edit">
                                            <i class="mdi mdi-square-edit-outline"></i>
                                        </a>

                                        {{-- Riwayat Absensi --}}
                                        <a href="{{ route('siswa.riwayat-absensi', $siswa->id) }}" 
                                           class="btn btn-outline-success btn-sm" 
                                           title="Riwayat Absensi">
                                            <i class="mdi mdi-calendar-clock"></i>
                                        </a>

                                        {{-- Hapus --}}
                                        <form action="{{ route('siswa.destroy', $siswa->id) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Yakin hapus data siswa ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-outline-danger btn-sm" 
                                                    title="Hapus">
                                                <i class="mdi mdi-trash-can-outline"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <form action="{{ route('siswa.reset-face', $siswa->id) }}" method="POST" onsubmit="return confirm('Yakin ingin mereset registrasi wajah siswa ini?')">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-warning btn-sm" title="Reset Registrasi Wajah">
                                            <i class="mdi mdi-face-recognition"></i> Reset
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center">Belum ada data siswa.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $siswas->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection