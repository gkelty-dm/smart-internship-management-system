@extends('layouts.skydash-admin')

@section('title', 'Edit Penempatan PKL')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Penempatan PKL</h4>
                <p class="card-description">Ubah data penempatan siswa.</p>

                <form class="forms-sample" action="{{ route('penempatan-pkl.update', $penempatan_pkl->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="siswa_id">Siswa</label>
                                <select name="siswa_id" id="siswa_id" class="form-control" required>
                                    @foreach($siswas as $siswa)
                                        <option value="{{ $siswa->id }}" {{ $penempatan_pkl->siswa_id == $siswa->id ? 'selected' : '' }}>
                                            {{ $siswa->user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="guru_id">Guru Pembimbing</label>
                                <select name="guru_id" id="guru_id" class="form-control" required>
                                    @foreach($gurus as $guru)
                                        <option value="{{ $guru->id }}" {{ $penempatan_pkl->guru_id == $guru->id ? 'selected' : '' }}>
                                            {{ $guru->user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="perusahaan_id">Perusahaan</label>
                                <select name="perusahaan_id" id="perusahaan_id" class="form-control" required>
                                    @foreach($perusahaans as $perusahaan)
                                        <option value="{{ $perusahaan->id }}" {{ $penempatan_pkl->perusahaan_id == $perusahaan->id ? 'selected' : '' }}>
                                            {{ $perusahaan->nama_perusahaan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="industri_id">Pembimbing Industri</label>
                                <select name="industri_id" id="industri_id" class="form-control" required>
                                    <option value="">-- Pilih Pembimbing Industri --</option>
                                    @foreach($industris as $industri)
                                        <option value="{{ $industri->id }}" {{ $penempatan_pkl->industri_id == $industri->id ? 'selected' : '' }}>
                                            {{ $industri->user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tanggal_mulai">Tanggal Mulai</label>
                                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" 
                                       value="{{ $penempatan_pkl->tanggal_mulai }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tanggal_selesai">Tanggal Selesai</label>
                                <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" 
                                       value="{{ $penempatan_pkl->tanggal_selesai }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status_pkl">Status PKL</label>
                                <select name="status_pkl" id="status_pkl" class="form-control">
                                    <option value="pending" {{ $penempatan_pkl->status_pkl == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="aktif" {{ $penempatan_pkl->status_pkl == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="selesai" {{ $penempatan_pkl->status_pkl == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="dibatalkan" {{ $penempatan_pkl->status_pkl == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-2">Update Data</button>
                        <a href="{{ route('penempatan-pkl.index') }}" class="btn btn-light">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const industriData = @json($industris);
    const perusahaanSelect = document.getElementById('perusahaan_id');
    const industriSelect = document.getElementById('industri_id');

    perusahaanSelect.addEventListener('change', function () {
        const perusahaanId = this.value;
        // Simpan nilai ID industri saat ini untuk mempertahankan pilihan jika ada
        const currentIndustriId = "{{ $penempatan_pkl->industri_id }}";

        industriSelect.innerHTML = '<option value="">-- Pilih Pembimbing Industri --</option>';

        const filtered = industriData.filter(industri => industri.perusahaan_id == perusahaanId);

        filtered.forEach(industri => {
            const isSelected = industri.id == currentIndustriId ? 'selected' : '';
            industriSelect.innerHTML += `<option value="${industri.id}" ${isSelected}>${industri.user.name}</option>`;
        });
    });
});
</script>
@endsection