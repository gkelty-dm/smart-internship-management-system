@extends('layouts.admin')

@section('title', 'Tambah Logbook')

@section('content')
<section class="section main-section">
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Tambah Logbook PKL</h1>
    </div>

    <div class="card">
        <div class="card-content">
            <form action="{{ route('logbook.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="field">
                        <label class="label">Siswa</label>
                        <div class="control">
                            <div class="select w-full">
                                <select name="siswa_id" class="w-full" required>
                                    <option value="" disabled selected>-- Pilih Siswa --</option>
                                    @foreach($siswas as $siswa)
                                        <option value="{{ $siswa->id }}">{{ $siswa->user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Tanggal</label>
                        <div class="control">
                            <input type="date" name="tanggal" required class="input w-full">
                        </div>
                    </div>
                </div>

                <div class="field mt-4">
                    <label class="label">Kegiatan</label>
                    <div class="control">
                        <textarea name="kegiatan" class="textarea w-full" rows="3" required placeholder="Jelaskan kegiatan hari ini..."></textarea>
                    </div>
                </div>

                <div class="field mt-4">
                    <label class="label">Kendala</label>
                    <div class="control">
                        <textarea name="kendala" class="textarea w-full" rows="2" placeholder="Sebutkan kendala jika ada..."></textarea>
                    </div>
                </div>

                <div class="field mt-4">
                    <label class="label">Solusi</label>
                    <div class="control">
                        <textarea name="solusi" class="textarea w-full" rows="2" placeholder="Sebutkan solusi yang dilakukan..."></textarea>
                    </div>
                </div>

                <div class="field mt-4">
                    <label class="label">Foto Kegiatan (Maks 5 file)</label>
                    <div class="control">
                        <input type="file" name="fotos[]" multiple accept="image/*" class="input w-full">
                        <p class="help text-gray-500">Format: JPG, PNG. Maksimal 5 foto.</p>
                    </div>
                </div>

                <div class="field grouped mt-6">
                    <div class="control">
                        <button type="submit" class="button blue">Simpan Logbook</button>
                    </div>
                    <div class="control">
                        <a href="{{ route('logbook.index') }}" class="button light">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection