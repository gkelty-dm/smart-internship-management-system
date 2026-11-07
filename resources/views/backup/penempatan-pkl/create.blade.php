@extends('layouts.skydash-admin')

@section('title', 'Tambah Penempatan PKL')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Penempatan PKL</h4>
                <p class="card-description">Silakan isi data penempatan siswa ke perusahaan mitra.</p>

                <form class="forms-sample" action="{{ route('penempatan-pkl.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="siswa_id">Siswa</label>
                                <select name="siswa_id" id="siswa_id" class="form-control" required>
                                    <option value="">-- Pilih Siswa --</option>
                                    @foreach($siswas as $siswa)
                                        <option value="{{ $siswa->id }}">{{ $siswa->user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="guru_id">Guru Pembimbing</label>
                                <select name="guru_id" id="guru_id" class="form-control" required>
                                    <option value="">-- Pilih Guru --</option>
                                    @foreach($gurus as $guru)
                                        <option value="{{ $guru->id }}">{{ $guru->user->name }}</option>
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
                                    <option value="">-- Pilih Perusahaan --</option>
                                    @foreach($perusahaans as $perusahaan)
                                        <option value="{{ $perusahaan->id }}">{{ $perusahaan->nama_perusahaan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="industri_id">Pembimbing Industri</label>
                                <select name="industri_id" id="industri_id" class="form-control" required>
                                    <option value="">-- Pilih Perusahaan Dulu --</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tanggal_mulai">Tanggal Mulai</label>
                                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tanggal_selesai">Tanggal Selesai</label>
                                <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status_pkl">Status PKL</label>
                                <select name="status_pkl" id="status_pkl" class="form-control">
                                    <option value="pending">Pending</option>
                                    <option value="aktif">Aktif</option>
                                    <option value="selesai">Selesai</option>
                                    <option value="dibatalkan">Dibatalkan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-2">Simpan Data</button>
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
        industriSelect.innerHTML = '<option value="">-- Pilih Pembimbing Industri --</option>';

        const filtered = industriData.filter(industri => industri.perusahaan_id == perusahaanId);

        filtered.forEach(industri => {
            industriSelect.innerHTML += `<option value="${industri.id}">${industri.user.name}</option>`;
        });
    });
});
</script>
@endsection