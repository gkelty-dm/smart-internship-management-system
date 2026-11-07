@extends('layouts.skydash-admin')

@section('title', 'Data Jurusan')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title">Manajemen Jurusan</h4>
                    <a href="{{ route('jurusan.create') }}" class="btn btn-primary btn-icon-text">
                        <i class="mdi mdi-plus btn-icon-prepend"></i> Tambah Jurusan
                    </a>
                </div>

                {{-- Form Import --}}
                <div class="mb-4 p-3 border rounded bg-light">
                    <form action="{{ route('jurusan.import') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center">
                        @csrf
                        <div class="form-group mb-0 mr-3">
                            <input type="file" name="file" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success btn-icon-text">
                            <i class="mdi mdi-file-excel btn-icon-prepend"></i> Import Excel
                        </button>
                    </form>
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
                                <th>Nama Jurusan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jurusans as $jurusan)
                            <tr>
                                <td class="py-1">{{ $loop->iteration }}</td>
                                <td>{{ $jurusan->nama_jurusan }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('jurusan.edit', $jurusan->id) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="mdi mdi-square-edit-outline"></i>
                                        </a>
                                        <form action="{{ route('jurusan.destroy', $jurusan->id) }}" method="POST" onsubmit="return confirm('Yakin hapus jurusan ini?')">
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
                                <td colspan="3" class="text-center">Belum ada data jurusan.</td>
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