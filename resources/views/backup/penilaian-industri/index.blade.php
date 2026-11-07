@extends('layouts.admin')
@section('title', 'Penilaian Industri')

@section('content')
<section class="section main-section">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Penilaian Industri</h1>
        <a href="{{ route('penilaian-industri.create') }}" class="button blue">
            <span class="icon"><i class="mdi mdi-plus"></i></span>
            <span>Tambah</span>
        </a>
    </div>

    @if(session('success'))
        <div class="notification green mb-6">
            <span class="icon"><i class="mdi mdi-check-circle"></i></span>
            {{ session('success') }}
        </div>
    @endif

    <div class="card has-table">
        <div class="card-content">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Siswa</th>
                        <th>Perusahaan</th>
                        <th>Nilai Rata-rata</th>
                        <th>Predikat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penilaians as $item)
                        @php
    $nilai = $item->nilai_akhir;

    $predikat = ($nilai >= 90)
        ? 'A'
        : (($nilai >= 80)
            ? 'B'
            : (($nilai >= 70)
                ? 'C'
                : (($nilai >= 60)
                    ? 'D'
                    : 'E')));

    $badge = match($predikat) {
        'A' => 'green',
        'B' => 'blue',
        'C' => 'yellow',
        'D' => 'orange',
        default => 'red'
    };
@endphp
                        <tr>
                            <td>{{ $penilaians->firstItem() + $loop->index }}</td>
                            <td>{{ $item->penempatan->siswa->user->name ?? '-' }}</td>
                            <td>{{ $item->penempatan->perusahaan->nama_perusahaan ?? '-' }}</td>
                            <td>{{ number_format($nilai, 2) }}</td>
                            <td>
                                <span class="px-2 py-1 bg-{{$badge}}-100 text-{{$badge}}-700 rounded font-bold text-xs">
                                    {{ $predikat }}
                                </span>
                            </td>
                            <td class="actions-cell">
                                <div class="buttons right nowrap">
                                    <a href="{{ route('penilaian-industri.edit', $item->id) }}" class="button small blue"><span class="icon"><i class="mdi mdi-pencil"></i></span></a>
                                    <form action="{{ route('penilaian-industri.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="button small red"><span class="icon"><i class="mdi mdi-trash-can"></i></span></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-6 text-gray-500">Belum ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
            <div class="table-pagination mt-4">{{ $penilaians->links() }}</div>
        </div>
    </div>
</section>
@endsection