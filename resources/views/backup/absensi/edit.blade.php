@extends('layouts.admin')

@section('title', 'Edit Absensi')

@section('content')
<section class="section main-section">
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Edit Absensi</h1>
    </div>

    <div class="card">
        <div class="card-content">
            <form action="{{ route('absensi.update', $absensi->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="field">
                        <label class="label">Siswa</label>
                        <div class="control">
                            <div class="select w-full">
                                <select name="siswa_id" class="w-full" required>
                                    @foreach($siswas as $siswa)
                                        <option value="{{ $siswa->id }}" {{ $absensi->siswa_id == $siswa->id ? 'selected' : '' }}>
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
                            <input type="date" name="tanggal" value="{{ $absensi->tanggal }}" required class="input w-full">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Jam Masuk</label>
                        <div class="control">
                            <input type="time" name="jam_masuk" value="{{ $absensi->jam_masuk }}" class="input w-full">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Jam Pulang</label>
                        <div class="control">
                            <input type="time" name="jam_pulang" value="{{ $absensi->jam_pulang }}" class="input w-full">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Status</label>
                        <div class="control">
                            <div class="select w-full">
                                <select name="status" class="w-full">
                                    <option value="hadir" {{ $absensi->status == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                    <option value="izin" {{ $absensi->status == 'izin' ? 'selected' : '' }}>Izin</option>
                                    <option value="sakit" {{ $absensi->status == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                    <option value="alpha" {{ $absensi->status == 'alpha' ? 'selected' : '' }}>Alpha</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Metode Verifikasi</label>
                        <div class="control">
                            <div class="select w-full">
                                <select name="metode_verifikasi" class="w-full">
                                    <option value="manual" {{ $absensi->metode_verifikasi == 'manual' ? 'selected' : '' }}>Manual</option>
                                    <option value="gps" {{ $absensi->metode_verifikasi == 'gps' ? 'selected' : '' }}>GPS</option>
                                    <option value="face" {{ $absensi->metode_verifikasi == 'face' ? 'selected' : '' }}>Face</option>
                                    <option value="gps_face" {{ $absensi->metode_verifikasi == 'gps_face' ? 'selected' : '' }}>GPS + Face</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="field grouped mt-6">
                    <div class="control">
                        <button type="submit" class="button blue">Update Data</button>
                    </div>
                    <div class="control">
                        <a href="{{ route('absensi.index') }}" class="button light">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection