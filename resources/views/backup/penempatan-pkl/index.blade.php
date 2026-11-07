@extends('layouts.skydash-admin')

@section('title', 'Data Penempatan PKL')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title">Data Penempatan PKL</h4>
                    <a href="{{ route('penempatan-pkl.create') }}" class="btn btn-primary btn-icon-text">
                        <i class="mdi mdi-plus btn-icon-prepend"></i> Tambah Penempatan
                    </a>
                </div>

                {{-- Form Import Excel (Desain Terintegrasi) --}}
                <div class="card mb-4 shadow-none border">
                    <div class="card-body py-3">
                        <form action="{{ route('penempatan-pkl.import') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center">
                            @csrf
                            <div class="form-group mb-0 mr-3">
                                <input type="file" name="file" class="form-control form-control-sm" required>
                            </div>
                            <button type="submit" class="btn btn-success btn-sm btn-icon-text">
                                <i class="mdi mdi-file-excel btn-icon-prepend"></i> Import Excel
                            </button>
                        </form>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="mdi mdi-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Siswa</th>
                                <th>Perusahaan</th>
                                <th>Pembimbing Industri</th>
                                <th>Guru Pembimbing</th>
                                <th>Mulai</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($penempatans as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->siswa->user->name }}</td>
                                <td>{{ $item->perusahaan->nama_perusahaan }}</td>
                                <td>{{ $item->industri->user->name ?? '-' }}</td>
                                <td>{{ $item->guru->user->name ?? '-' }}</td>
                                <td>{{ $item->tanggal_mulai }}</td>
                                <td>
                                    <label class="badge {{ $item->status_pkl == 'aktif' ? 'badge-success' : 'badge-secondary' }}">
                                        {{ ucfirst($item->status_pkl) }}
                                    </label>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('penempatan-pkl.edit', $item->id) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="mdi mdi-square-edit-outline"></i>
                                        </a>
                                        <form action="{{ route('penempatan-pkl.destroy', $item->id) }}" method="POST" 
                                              onsubmit="return confirm('Yakin hapus data penempatan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="mdi mdi-trash-can-outline"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">Belum ada data penempatan PKL.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $penempatans->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection