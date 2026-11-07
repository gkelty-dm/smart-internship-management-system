@extends('layouts.skydash-admin')

@section('title', 'Detail Siswa')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title">Detail Siswa: {{ $siswa->user->name }}</h4>
                    <a href="{{ route('siswa.index') }}" class="btn btn-secondary btn-sm">
                        <i class="mdi mdi-arrow-left"></i> Kembali
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th style="width: 200px;">Nama</th>
                                <td>{{ $siswa->user->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $siswa->user->email }}</td>
                            </tr>
                           <tr>
                                <th>NISN</th>
                                <td>{{ $siswa->nisn ?? '-' }}</td>
                            </tr>
                           <tr>
                                <th>Kelas</th>
                                <td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Jurusan</th>
                                <td>{{ $siswa->jurusan->nama_jurusan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Status Registrasi Wajah</th>
                                <td>
                                    @if($siswa->faceProfile && $siswa->faceProfile->is_registered)
                                        <label class="badge badge-success">Sudah Registrasi</label>
                                    @else
                                        <label class="badge badge-danger">Belum Registrasi</label>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Foto Registrasi Wajah</h4>
                <div class="row">
                    @forelse($siswa->faceProfile?->images ?? [] as $foto)
                        <div class="col-md-3 mb-3">
                            <img src="{{ asset('storage/' . $foto->file_path) }}"
                                 class="img-fluid rounded border"
                                 alt="Face Photo">
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-warning" role="alert">
                                <i class="mdi mdi-alert-outline"></i> Belum ada foto registrasi.
                            </div>
                        </div>
                    @endforelse
                </div>

                <hr class="my-4">

                <h4 class="card-title mb-3">
                    Upload Foto Registrasi
                </h4>

                {{-- LANGKAH 4: Tampilkan Progress --}}
                <div class="alert alert-info mt-3">
                    <strong>Progress Registrasi :</strong>
                    {{ $jumlahFoto }} / 5 Foto
                </div>

                {{-- LANGKAH 5: Setelah 5 Foto --}}
                @if($jumlahFoto >= 5)
                <div class="alert alert-success mt-3">
                    <i class="mdi mdi-check-circle"></i>
                    Registrasi wajah telah selesai.
                </div>
                @endif

                <form
                    action="{{ route('siswa.upload-face', $siswa->id) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="mt-3">

                    @csrf

                    <div class="row align-items-center">
                        <div class="col-md-8 mb-2 mb-md-0">
                            <input
                                type="file"
                                name="foto[]"
                                class="form-control"
                                accept=".jpg,.jpeg,.png"
                                multiple
                                required>
                        </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success btn-block">
                                <i class="mdi mdi-upload"></i> Upload Foto
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection