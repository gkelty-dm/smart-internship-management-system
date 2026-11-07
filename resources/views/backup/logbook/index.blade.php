@extends('layouts.admin')

@section('title', 'Data Logbook PKL')

@section('content')
<section class="section main-section">
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Data Logbook PKL</h1>
    </div>

    @if(session('success'))
        <div class="notification blue mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="card has-table">
        <header class="card-header">
            <p class="card-header-title">
                <span class="icon"><i class="mdi mdi-book-open-page-variant"></i></span>
                Daftar Logbook Siswa
            </p>
            <a href="{{ route('logbook.create') }}" class="card-header-icon text-blue-600">
                <span class="icon"><i class="mdi mdi-plus"></i></span>
                Tambah Logbook
            </a>
        </header>

        <div class="card-content">
            <table>
                <thead>
                    <tr>
                        <th class="checkbox-cell text-center">No</th>
                        <th>Siswa</th>
                        <th>Tanggal</th>
                        <th>Kegiatan</th>
                        <th>Foto</th>
                        <th>Status</th>
                        <th class="actions-cell">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logbooks as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->siswa->user->name ?? '-' }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ Str::limit($item->kegiatan, 40) }}</td>
                        <td>
                            <span class="text-sm text-gray-500">
                                {{ $item->fotos->count() }} Foto
                            </span>
                        </td>
                        <td>
                            @php
                                $statusClass = [
                                    'pending'   => 'bg-yellow-100 text-yellow-700',
                                    'disetujui' => 'bg-green-100 text-green-700',
                                    'ditolak'   => 'bg-red-100 text-red-700'
                                ][$item->status_validasi] ?? 'bg-gray-100';
                            @endphp
                            <span class="px-2 py-1 text-xs rounded {{ $statusClass }}">
                                {{ ucfirst($item->status_validasi) }}
                            </span>
                        </td>
                        <td class="actions-cell">
                            <div class="buttons right nowrap">
                                <a href="{{ route('logbook.edit', $item->id) }}" class="button small blue">
                                    <span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
                                </a>
                                <form action="{{ route('logbook.destroy', $item->id) }}" method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus data logbook ini?')">
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
                            Belum ada data logbook.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
            <div class="mt-4">
                {{ $logbooks->links() }}
            </div>
        </div>
    </div>
</section>
@endsection