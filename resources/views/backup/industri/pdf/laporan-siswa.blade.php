<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
    body {
        font-family: 'DejaVu Sans', sans-serif;
        font-size: 12px;
        line-height: 1.5;
        color: #333;
    }
    h2 {
        text-align: center;
        text-transform: uppercase;
        margin-bottom: 30px;
    }
    h4 {
        background-color: #f2f2f2;
        padding: 8px;
        margin-top: 25px;
        border-left: 5px solid #333;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 10px;
    }
    table, th, td {
        border: 1px solid #ccc;
    }
    th {
        background-color: #f8f8f8;
        text-align: center;
        padding: 8px;
    }
    td {
        padding: 8px;
    }
    .label {
        width: 30%;
        font-weight: bold;
        background-color: #fafafa;
    }
</style>
</head>

<body>

<h2>LAPORAN HASIL PKL SISWA</h2>

<h4>Data Siswa</h4>
<table>
    <tr>
        <td class="label">Nama Lengkap</td>
        <td>{{ $siswa->user->name }}</td>
    </tr>
    <tr>
        <td class="label">NISN</td>
        <td>{{ $siswa->nisn }}</td>
    </tr>
    <tr>
        <td class="label">Jurusan</td>
        <td>{{ $siswa->jurusan->nama_jurusan ?? '-' }}</td>
    </tr>
    <tr>
        <td class="label">Kelas</td>
        <td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
    </tr>
</table>

<h4>Data Penempatan PKL</h4>
<table>
    <tr>
        <td class="label">Perusahaan</td>
        <td>{{ $penempatan->perusahaan->nama_perusahaan ?? '-' }}</td>
    </tr>
    <tr>
        <td class="label">Pembimbing Industri</td>
        <td>{{ $penempatan->industri->user->name ?? '-' }}</td>
    </tr>
    <tr>
        <td class="label">Guru Pembimbing</td>
        <td>{{ $penempatan->guru->user->name ?? '-' }}</td>
    </tr>
    <tr>
        <td class="label">Status PKL</td>
        <td>{{ $penempatan->status_pkl ?? '-' }}</td>
    </tr>
</table>

<h4>Rekap Absensi</h4>
<table>
    <tr>
        <th>Hadir</th>
        <th>Izin</th>
        <th>Sakit</th>
        <th>Alpha</th>
    </tr>
    <tr>
        <td style="text-align: center;">{{ $hadir }}</td>
        <td style="text-align: center;">{{ $izin }}</td>
        <td style="text-align: center;">{{ $sakit }}</td>
        <td style="text-align: center;">{{ $alpha }}</td>
    </tr>
</table>

<h4>Rekap Logbook</h4>
<table>
    <tr>
        <th>Total Input</th>
        <th>Disetujui</th>
        <th>Pending</th>
    </tr>
    <tr>
        <td style="text-align: center;">{{ $totalLogbook }}</td>
        <td style="text-align: center;">{{ $logbookValid }}</td>
        <td style="text-align: center;">{{ $logbookPending }}</td>
    </tr>
</table>

<h4>Penilaian Akhir PKL</h4>
<table>
    <tr>
        <td class="label">Nilai Industri</td>
        <td>{{ $penempatan->nilaiPKL->nilai_industri ?? '-' }}</td>
    </tr>
    <tr>
        <td class="label">Nilai Guru</td>
        <td>{{ $penempatan->nilaiPKL->nilai_guru ?? '-' }}</td>
    </tr>
    <tr>
        <td class="label" style="background-color: #e9ecef;">Nilai Akhir</td>
        <td style="font-weight: bold;">{{ $penempatan->nilaiPKL->nilai_akhir ?? '-' }}</td>
    </tr>
    <tr>
        <td class="label">Predikat</td>
        <td>{{ $penempatan->nilaiPKL->predikat ?? '-' }}</td>
    </tr>
</table>

</body>
</html>