@extends('layouts.admin')

@section('title', 'Tambah Absensi')

@section('content')
<section class="section main-section">
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Tambah Absensi PKL</h1>
    </div>

    <div class="card">
        <div class="card-content">
            <form action="{{ route('absensi.store') }}" method="POST">
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

                    <div class="field">
                        <label class="label">Jam Masuk</label>
                        <div class="control">
                            <input type="time" name="jam_masuk" class="input w-full">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Jam Pulang</label>
                        <div class="control">
                            <input type="time" name="jam_pulang" class="input w-full">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Status</label>
                        <div class="control">
                            <div class="select w-full">
                                <select name="status" class="w-full">
                                    <option value="hadir">Hadir</option>
                                    <option value="izin">Izin</option>
                                    <option value="sakit">Sakit</option>
                                    <option value="alpha">Alpha</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Metode Verifikasi</label>
                        <div class="control">
                            <div class="select w-full">
                                <select name="metode_verifikasi" class="w-full">
                                    <option value="manual">Manual</option>
                                    <option value="gps">GPS</option>
                                    <option value="face">Face</option>
                                    <option value="gps_face">GPS + Face</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="field grouped mt-6">
                    <div class="control">
                        <button type="submit" class="button blue">Simpan Data</button>
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