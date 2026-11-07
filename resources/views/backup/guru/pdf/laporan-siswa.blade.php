<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 13px; color: #333; }
        h2 { text-align: center; color: #000; text-transform: uppercase; margin-bottom: 20px; }
        h3 { background-color: #f4f4f4; padding: 8px; border-left: 5px solid #4B49AC; font-size: 15px; margin-top: 20px; }
        
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        th { background-color: #f8f9fa; color: #333; font-weight: bold; }
        th, td { border: 1px solid #dee2e6; padding: 8px; text-align: left; }
        
        .text-center { text-align: center; }
        .label { font-weight: bold; width: 35%; color: #555; }
        .info-box { border: 1px solid #dee2e6; padding: 10px; border-radius: 4px; }
    </style>
</head>
<body>

    <h2>LAPORAN PKL SISWA</h2>

    <h3>Data Siswa</h3>
    <table>
        <tr><td class="label">Nama</td><td>{{ $siswa->user->name }}</td></tr>
        <tr><td class="label">NISN</td><td>{{ $siswa->nisn }}</td></tr>
        <tr><td class="label">Jurusan</td><td>{{ $siswa->jurusan->nama_jurusan ?? '-' }}</td></tr>
        <tr><td class="label">Kelas</td><td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td></tr>
    </table>

    <h3>Data PKL</h3>
    <table>
        <tr><td class="label">Perusahaan</td><td>{{ $penempatan->perusahaan->nama_perusahaan ?? '-' }}</td></tr>
        <tr><td class="label">Guru Pembimbing</td><td>{{ $penempatan->guru->user->name ?? '-' }}</td></tr>
        <tr><td class="label">Pembimbing Industri</td><td>{{ $penempatan->industri->user->name ?? '-' }}</td></tr>
        <tr><td class="label">Status PKL</td><td>{{ ucfirst($penempatan->status_pkl ?? '-') }}</td></tr>
    </table>

    <h3>Rekap Absensi</h3>
    <table>
        <tr>
            <th class="text-center">Hadir</th>
            <th class="text-center">Izin</th>
            <th class="text-center">Sakit</th>
            <th class="text-center">Alpha</th>
        </tr>
        <tr>
            <td class="text-center">{{ $hadir }}</td>
            <td class="text-center">{{ $izin }}</td>
            <td class="text-center">{{ $sakit }}</td>
            <td class="text-center">{{ $alpha }}</td>
        </tr>
    </table>

    <h3>Statistik Logbook</h3>
    <table>
        <tr><td>Total Logbook yang telah divalidasi</td><td class="text-center"><strong>{{ $jumlahLogbook }}</strong></td></tr>
    </table>

    <h3>Nilai PKL</h3>
    @if($penempatan && $penempatan->nilaiPKL)
    <table>
        <tr><td class="label">Nilai Industri</td><td>{{ $penempatan->nilaiPKL->nilai_industri }}</td></tr>
        <tr><td class="label">Nilai Guru</td><td>{{ $penempatan->nilaiPKL->nilai_guru }}</td></tr>
        <tr><td class="label">Nilai Akhir</td><td><strong>{{ $penempatan->nilaiPKL->nilai_akhir }}</strong></td></tr>
        <tr><td class="label">Predikat</td><td>{{ $penempatan->nilaiPKL->predikat }}</td></tr>
    </table>
    @else
    <p><em>Nilai PKL belum tersedia karena penilaian belum lengkap.</em></p>
    @endif

</body>
</html>