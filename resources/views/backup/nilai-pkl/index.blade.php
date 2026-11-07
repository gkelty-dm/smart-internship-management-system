@extends('layouts.admin')

@section('title','Nilai PKL')

@section('content')

<section class="section main-section">

    <div class="level mb-6">

        <div class="level-left">

            <div>

                <h1 class="title">
                    Nilai PKL
                </h1>

            </div>

        </div>

        <div class="level-right">

            <a
                href="{{ route('nilai-pkl.create') }}"
                class="button blue"
            >

                <span class="icon">
                    <i class="mdi mdi-plus"></i>
                </span>

                <span>
                    Generate Nilai
                </span>

            </a>

        </div>

    </div>

    <div class="card has-table">

        <div class="card-content">

            <table>

                <thead>

                    <tr>

                        <th>Siswa</th>

                        <th>Perusahaan</th>

                        <th>Nilai Guru</th>

                        <th>Nilai Industri</th>

                        <th>Nilai Akhir</th>

                        <th>Predikat</th>

                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($nilaiPKL as $item)

                    <tr>

                        <td>

                            {{ $item->penempatan->siswa->user->name }}

                        </td>

                        <td>

                            {{ $item->penempatan->perusahaan->nama_perusahaan }}

                        </td>

                        <td>

                            {{ $item->nilai_guru }}

                        </td>

                        <td>

                            {{ $item->nilai_industri }}

                        </td>

                        <td>

                            <strong>
                                {{ $item->nilai_akhir }}
                            </strong>

                        </td>

                        <td>

                            <span class="tag is-success">

                                {{ $item->predikat }}

                            </span>

                        </td>

                        <td>

                            <form
                                action="{{ route('nilai-pkl.destroy',$item->id) }}"
                                method="POST"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    class="button small red"
                                    onclick="return confirm('Hapus data?')"
                                >

                                    Hapus

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="7">

                            Belum ada data nilai PKL

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

            <div class="mt-4">

                {{ $nilaiPKL->links() }}

            </div>

        </div>

    </div>

</section>

@endsection