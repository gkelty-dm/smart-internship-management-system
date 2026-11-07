@extends('layouts.admin')

@section('title', 'Edit Logbook')

@section('content')
<section class="section main-section">
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Edit Logbook PKL</h1>
    </div>

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
            <form action="{{ route('logbook.update', $logbook->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="field">
                        <label class="label">Siswa</label>
                        <div class="control">
                            <div class="select w-full">
                                <select name="siswa_id" class="w-full" required>
                                    @foreach($siswas as $siswa)
                                        <option value="{{ $siswa->id }}" {{ $logbook->siswa_id == $siswa->id ? 'selected' : '' }}>
                                            {{ $siswa->user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Tanggal</label>
                        <div class="control">
                            <input type="date" name="tanggal" value="{{ old('tanggal', $logbook->tanggal) }}" required class="input w-full">
                        </div>
                    </div>
                </div>

                <div class="field mt-4">
                    <label class="label">Kegiatan</label>
                    <div class="control">
                        <textarea name="kegiatan" class="textarea w-full" rows="3" required>{{ old('kegiatan', $logbook->kegiatan) }}</textarea>
                    </div>
                </div>

                <div class="field mt-4">
                    <label class="label">Kendala</label>
                    <div class="control">
                        <textarea name="kendala" class="textarea w-full" rows="2">{{ old('kendala', $logbook->kendala) }}</textarea>
                    </div>
                </div>

                <div class="field mt-4">
                    <label class="label">Solusi</label>
                    <div class="control">
                        <textarea name="solusi" class="textarea w-full" rows="2">{{ old('solusi', $logbook->solusi) }}</textarea>
                    </div>
                </div>

                <div class="field grouped mt-6">
                    <div class="control">
                        <button type="submit" class="button blue">Update Data</button>
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