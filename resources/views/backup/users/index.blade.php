@extends('layouts.skydash-admin')

@section('title', 'Manage User')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="font-weight-bold">Manage User</h3>
                <p class="text-muted">Kelola seluruh akun pengguna sistem</p>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="mdi mdi-check-circle"></i> {{ session('success') }}
    </div>
@endif

{{-- Stats Cards --}}
<div class="row">
    @foreach(['Admin' => [$admins, 'primary'], 'Guru' => [$gurus, 'info'], 'Siswa' => [$siswas, 'success'], 'Industri' => [$industris, 'warning']] as $label => $data)
        <div class="col-md-3 grid-margin stretch-card">
            <div class="card card-tale bg-{{ $data[1] }} text-white">
                <div class="card-body text-center">
                    <p class="mb-2">{{ $label }}</p>
                    <h2 class="font-weight-bold">{{ $data[0]->count() }}</h2>
                </div>
            </div>
        </div>
    @endforeach
</div>

{{-- Table Sections --}}
@foreach(['Admin' => $admins, 'Guru' => $gurus, 'Siswa' => $siswas, 'Industri' => $industris] as $title => $users)
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title">Data {{ $title }}</h4>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <label class="badge {{ $user->is_active ? 'badge-success' : 'badge-danger' }}">
                                        {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </label>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        
                                        <form action="{{ route('users.reset-password', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-warning" onclick="return confirm('Reset password user ini?')">Reset</button>
                                        </form>

                                        <form action="{{ route($user->is_active ? 'users.nonaktif' : 'users.aktif', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-{{ $user->is_active ? 'danger' : 'success' }}" onclick="return confirm('{{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }} akun ini?')">
                                                {{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Data tidak tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endforeach
@endsection