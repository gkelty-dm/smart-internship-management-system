@extends('layouts.admin')
@section('title', 'Tambah Penilaian Guru')

@section('content')
<section class="section main-section">
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Input Penilaian Guru</h1>
    </div>

    {{-- Notifikasi Error Validasi --}}
    @if ($errors->any())
        <div class="notification red mb-6">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-content">
            <form action="{{ route('penilaian-guru.store') }}" method="POST">
                @csrf

                <h2 class="text-lg font-bold mb-4 text-gray-700">Identitas Penilaian</h2>
                <div class="field">
                    <label class="label">Siswa PKL</label>
                    <div class="control">
                        <div class="select w-full">
                            <select name="penempatan_pkl_id" class="w-full" required>
                                <option value="" disabled selected>-- Pilih Siswa PKL --</option>
                                @foreach($penempatans as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->siswa->user->name }} - {{ $item->perusahaan->nama_perusahaan }} (Guru: {{ $item->guru->user->name }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <hr class="my-6">

                <h2 class="text-lg font-bold mb-4 text-gray-700">Aspek Penilaian (Skala 0-100)</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach(['disiplin', 'kerjasama', 'inisiatif', 'tanggung_jawab', 'keterampilan'] as $aspek)
                        <div class="field">
                            <label class="label">{{ ucwords(str_replace('_', ' ', $aspek)) }}</label>
                            <div class="control">
                                <input type="number" name="{{ $aspek }}" min="0" max="100" class="input w-full" required>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="field mt-6">
                    <label class="label">Catatan Guru</label>
                    <div class="control">
                        <textarea name="catatan" class="textarea w-full" rows="4"></textarea>
                    </div>
                </div>

                <div class="field grouped mt-6">
                    <div class="control">
                        <button type="submit" class="button blue">Simpan Penilaian</button>
                    </div>
                    <div class="control">
                        <a href="{{ route('penilaian-guru.index') }}" class="button light">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection