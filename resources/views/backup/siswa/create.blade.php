@extends('layouts.skydash-admin')

@section('title', 'Tambah Siswa')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data Siswa</h4>
                <p class="card-description">Isi formulir di bawah ini untuk menambahkan siswa baru.</p>

                <form class="forms-sample" action="{{ route('siswa.store') }}" method="POST">
                    @csrf

                    <h5 class="text-primary mt-4 mb-3"><i class="mdi mdi-account-circle"></i> Informasi Akun</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" placeholder="Nama lengkap siswa" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="email@siswa.com" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="********" required>
                    </div>

                    <h5 class="text-primary mt-4 mb-3"><i class="mdi mdi-clipboard-text"></i> Data Siswa</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>NISN</label>
                                <input type="text" name="nisn" class="form-control" placeholder="Masukkan NISN" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control">
                                    <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control" placeholder="Contoh: Medan">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>No HP</label>
                                <input type="text" name="no_hp" class="form-control" placeholder="08xxxxxxxxxx">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jurusan</label>
                                <select name="jurusan_id" id="jurusan_id" class="form-control">
                                    <option value="" disabled selected>-- Pilih Jurusan --</option>
                                    @foreach($jurusans as $jurusan)
                                    <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kelas</label>
                                <select name="kelas_id" id="kelas_id" class="form-control">
                                    <option value="" disabled selected>-- Pilih Kelas --</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat lengkap"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary me-2">Simpan</button>
                    <a href="{{ route('siswa.index') }}" class="btn btn-light">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('jurusan_id').addEventListener('change', function() {
        let jurusanId = this.value;
        let kelasSelect = document.getElementById('kelas_id');

        kelasSelect.innerHTML = '<option value="">Loading...</option>';

        fetch('/admin/get-kelas/' + jurusanId)
            .then(response => response.json())
            .then(data => {
                kelasSelect.innerHTML = '<option value="" disabled selected>-- Pilih Kelas --</option>';
                data.forEach(function(kelas) {
                    kelasSelect.innerHTML += `<option value="${kelas.id}">${kelas.nama_kelas}</option>`;
                });
            });
    });
</script>
@endpush