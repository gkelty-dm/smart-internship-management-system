@extends('layouts.admin')
@section('title', 'Penilaian Guru')
@section('content')

<section class="section main-section">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Penilaian Guru PKL</h1>
        <a href="{{ route('penilaian-guru.create') }}" class="button blue">
            <span class="icon"><i class="mdi mdi-plus"></i></span>
            <span>Tambah Penilaian</span>
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
                        <th>Guru Pembimbing</th>
                        <th>Nilai Akhir</th>
                        <th>Predikat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penilaians as $item)
                        <tr>
                            <td>{{ $penilaians->firstItem() + $loop->index }}</td>
                            <td>{{ $item->penempatan->siswa->user->name ?? '-' }}</td>
                            <td>{{ $item->penempatan->perusahaan->nama_perusahaan ?? '-' }}</td>
                            <td>{{ $item->guru->user->name ?? '-' }}</td>
                            <td>{{ number_format($item->nilai_akhir, 2) }}</td>
                            <td>
                                @php
                                    $nilai = $item->nilai_akhir;
                                    $badge = 'gray';
                                    $predikat = '-';

                                    if ($nilai >= 90) { $predikat = 'A'; $badge = 'green'; }
                                    elseif ($nilai >= 80) { $predikat = 'B'; $badge = 'blue'; }
                                    elseif ($nilai >= 70) { $predikat = 'C'; $badge = 'yellow'; }
                                    elseif ($nilai >= 60) { $predikat = 'D'; $badge = 'orange'; }
                                    else { $predikat = 'E'; $badge = 'red'; }
                                @endphp
                                <span class="px-2 py-1 bg-{{$badge}}-100 text-{{$badge}}-700 rounded font-bold">
                                    {{ $predikat }}
                                </span>
                            </td>
                            <td class="actions-cell">
                                <div class="buttons right nowrap">
                                    <a href="{{ route('penilaian-guru.edit', $item->id) }}" class="button small blue">
                                        <span class="icon"><i class="mdi mdi-pencil"></i></span>
                                    </a>
                                    <form action="{{ route('penilaian-guru.destroy', $item->id) }}" method="POST" 
                                          onsubmit="return confirm('Yakin hapus data?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="button small red">
                                            <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-6 text-gray-500">Belum ada data penilaian guru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
            <div class="table-pagination mt-4">
                {{ $penilaians->links() }}
            </div>
        </div>
    </div>
</section>
@endsection