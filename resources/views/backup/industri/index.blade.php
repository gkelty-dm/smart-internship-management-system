@extends('layouts.skydash-admin')

@section('title', 'Data Industri')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title">Manajemen Data Industri</h4>
                    <a href="{{ route('industri.create') }}" class="btn btn-primary btn-icon-text">
                        <i class="mdi mdi-plus btn-icon-prepend"></i> Tambah Industri
                    </a>
                </div>

                {{-- Form Import Excel (Desain Konsisten) --}}
                <div class="card mb-4 shadow-none border">
                    <div class="card-body py-3">
                        <form action="{{ route('industri.import') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center">
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
                                <th>Nama Pembimbing</th>
                                <th>Perusahaan</th>
                                <th>Jabatan</th>
                                <th>No HP</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($industris as $industri)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <h6 class="font-weight-bold mb-0">{{ $industri->nama_pembimbing }}</h6>
                                    <small class="text-muted">{{ $industri->user->name ?? '-' }}</small>
                                </td>
                                <td>{{ $industri->perusahaan->nama_perusahaan ?? '-' }}</td>
                                <td>
                                    <label class="badge badge-secondary">{{ $industri->jabatan }}</label>
                                </td>
                                <td>{{ $industri->no_hp }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('industri.edit', $industri->id) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="mdi mdi-square-edit-outline"></i>
                                        </a>
                                        <form action="{{ route('industri.destroy', $industri->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data industri ini?')">
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
                                <td colspan="6" class="text-center">Belum ada data industri.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection