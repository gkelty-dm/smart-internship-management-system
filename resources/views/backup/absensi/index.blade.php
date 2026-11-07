@extends('layouts.admin')

@section('title', 'Data Absensi')

@section('content')
<section class="section main-section">
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Data Absensi PKL</h1>
    </div>

    @if(session('success'))
        <div class="notification blue mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="card has-table">
        <header class="card-header">
            <p class="card-header-title">
                <span class="icon"><i class="mdi mdi-calendar-check"></i></span>
                Daftar Absensi
            </p>
            <a href="{{ route('absensi.create') }}" class="card-header-icon text-blue-600">
                <span class="icon"><i class="mdi mdi-plus"></i></span>
                Tambah Absensi
            </a>
        </header>

        <div class="card-content">
            <table>
                <thead>
                    <tr>
                        <th class="checkbox-cell text-center">No</th>
                        <th>Siswa</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Status</th>
                        <th class="actions-cell">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($absensis as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->siswa->user->name ?? '-' }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->jam_masuk ?? '-' }}</td>
                        <td>{{ $item->jam_pulang ?? '-' }}</td>
                        <td>
                            <span class="px-2 py-1 text-xs rounded {{ $item->status == 'hadir' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="actions-cell">
                            <div class="buttons right nowrap">
                                <a href="{{ route('absensi.edit', $item->id) }}" class="button small blue">
                                    <span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
                                </a>
                                <form action="{{ route('absensi.destroy', $item->id) }}" method="POST" 
                                      onsubmit="return confirm('Yakin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button small red">
                                        <span class="icon"><i class="mdi mdi-trash-can-outline"></i></span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-6 text-gray-400">
                            Belum ada data absensi.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
            <div class="mt-4">
                {{ $absensis->links() }}
            </div>
        </div>
    </div>
</section>
@endsection