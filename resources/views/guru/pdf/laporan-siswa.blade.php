<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>
        Laporan PKL - {{ $siswa->user->name ?? 'Siswa' }}
    </title>

    <style>
        @page {
            margin: 25px 30px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #222;
            line-height: 1.5;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .header {
            width: 100%;
            margin-bottom: 10px;
        }

        .header td {
            border: none;
            vertical-align: middle;
        }

        .header-title {
            text-align: center;
        }

        .header-title h2 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }

        .header-title h3 {
            margin: 3px 0;
            font-size: 14px;
            font-weight: bold;
        }

        .header-title p {
            margin: 0;
            font-size: 10px;
        }

        .line {
            border-top: 2px solid #222;
            margin-top: 8px;
            margin-bottom: 15px;
        }

        .section-title {
            background: #eeeeee;
            border: 1px solid #999;
            padding: 7px 9px;
            font-size: 12px;
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 7px;
        }

        .info-table td {
            border: 1px solid #999;
            padding: 6px 8px;
        }

        .info-label {
            width: 25%;
            font-weight: bold;
            background: #f5f5f5;
        }

        .info-value {
            width: 25%;
        }

        .summary-table {
            margin-top: 5px;
        }

        .summary-table td {
            border: 1px solid #999;
            text-align: center;
            padding: 8px;
        }

        .summary-number {
            font-size: 16px;
            font-weight: bold;
        }

        .data-table th {
            border: 1px solid #777;
            background: #eeeeee;
            padding: 6px;
            text-align: center;
            font-weight: bold;
        }

        .data-table td {
            border: 1px solid #999;
            padding: 5px 6px;
            vertical-align: top;
        }

        .text-center {
            text-align: center;
        }

        .nilai-box {
            border: 1px solid #777;
            padding: 12px;
            text-align: center;
            margin-top: 10px;
        }

        .nilai-box .label {
            font-size: 11px;
        }

        .nilai-box .nilai {
            font-size: 25px;
            font-weight: bold;
            margin-top: 3px;
        }

        .catatan {
            border: 1px solid #999;
            padding: 8px;
            min-height: 50px;
        }

        .signature-table {
            margin-top: 45px;
        }

        .signature-table td {
            border: none;
            width: 33.33%;
            text-align: center;
            vertical-align: top;
        }

        .signature-space {
            height: 65px;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 9px;
            color: #777;
        }

        .page-break {
            page-break-before: always;
        }

        .small {
            font-size: 9px;
        }
    </style>

</head>

<body>

    <table class="header">

        <tr>

            <td width="20%"></td>

            <td width="60%" class="header-title">

                <h2>
                    LAPORAN KEGIATAN
                </h2>

                <h3>
                    PRAKTIK KERJA LAPANGAN (PKL)
                </h3>

                <p>
                    Sistem Informasi Manajemen Praktik Kerja Lapangan
                </p>

            </td>

            <td width="20%"></td>

        </tr>

    </table>

    <div class="line"></div>


    {{-- IDENTITAS SISWA --}}

    <div class="section-title">
        A. IDENTITAS SISWA
    </div>

    <table class="info-table">

        <tr>

            <td class="info-label">
                Nama Siswa
            </td>

            <td class="info-value">
                {{ $siswa->user->name ?? '-' }}
            </td>

            <td class="info-label">
                NISN
            </td>

            <td class="info-value">
                {{ $siswa->nisn ?? '-' }}
            </td>

        </tr>

        <tr>

            <td class="info-label">
                Jenis Kelamin
            </td>

            <td class="info-value">
                {{ $siswa->jenis_kelamin ?? '-' }}
            </td>

            <td class="info-label">
                Kelas
            </td>

            <td class="info-value">
                {{ $siswa->kelas->nama_kelas ?? '-' }}
            </td>

        </tr>

        <tr>

            <td class="info-label">
                Jurusan
            </td>

            <td class="info-value">
                {{ $siswa->jurusan->nama_jurusan ?? '-' }}
            </td>

            <td class="info-label">
                No. HP
            </td>

            <td class="info-value">
                {{ $siswa->no_hp ?? '-' }}
            </td>

        </tr>

        <tr>

            <td class="info-label">
                Tempat, Tanggal Lahir
            </td>

            <td class="info-value">

                {{ $siswa->tempat_lahir ?? '-' }}

                @if($siswa->tanggal_lahir)
                ,
                {{ \Carbon\Carbon::parse(
                    $siswa->tanggal_lahir
                )->translatedFormat('d F Y') }}
                @endif

            </td>

            <td class="info-label">
                Alamat
            </td>

            <td class="info-value">
                {{ $siswa->alamat ?? '-' }}
            </td>

        </tr>

    </table>


    {{-- PENEMPATAN --}}

    <div class="section-title">
        B. DATA PENEMPATAN PKL
    </div>

    <table class="info-table">

        <tr>

            <td class="info-label">
                Perusahaan
            </td>

            <td colspan="3">
                {{ $penempatan->perusahaan->nama_perusahaan ?? '-' }}
            </td>

        </tr>

        <tr>

            <td class="info-label">
                Pembimbing Guru
            </td>

            <td>
                {{ $penempatan->guru->user->name ?? '-' }}
            </td>

            <td class="info-label">
                Pembimbing Industri
            </td>

            <td>
                {{ $penempatan->industri->user->name ?? '-' }}
            </td>

        </tr>

        <tr>

            <td class="info-label">
                Tanggal Mulai
            </td>

            <td>

                @if($penempatan->tanggal_mulai)

                {{ \Carbon\Carbon::parse(
                    $penempatan->tanggal_mulai
                )->translatedFormat('d F Y') }}

                @else

                -

                @endif

            </td>

            <td class="info-label">
                Tanggal Selesai
            </td>

            <td>

                @if($penempatan->tanggal_selesai)

                {{ \Carbon\Carbon::parse(
                    $penempatan->tanggal_selesai
                )->translatedFormat('d F Y') }}

                @else

                -

                @endif

            </td>

        </tr>

        <tr>

            <td class="info-label">
                Status PKL
            </td>

            <td colspan="3">
                {{ ucfirst($penempatan->status_pkl ?? '-') }}
            </td>

        </tr>

    </table>


    {{-- ABSENSI --}}

    <div class="section-title">
        C. REKAPITULASI KEHADIRAN
    </div>

    <table class="summary-table">

        <tr>

            <td>

                <div class="summary-number">
                    {{ $totalAbsensi }}
                </div>

                <div>
                    Total
                </div>

            </td>

            <td>

                <div class="summary-number">
                    {{ $hadir }}
                </div>

                <div>
                    Hadir
                </div>

            </td>

            <td>

                <div class="summary-number">
                    {{ $izin }}
                </div>

                <div>
                    Izin
                </div>

            </td>

            <td>

                <div class="summary-number">
                    {{ $sakit }}
                </div>

                <div>
                    Sakit
                </div>

            </td>

            <td>

                <div class="summary-number">
                    {{ $alpha }}
                </div>

                <div>
                    Alpha
                </div>

            </td>

        </tr>

    </table>

    <br>

    @if($absensis->count())

    <table class="data-table">

        <thead>

            <tr>

                <th width="5%">
                    No
                </th>

                <th width="18%">
                    Tanggal
                </th>

                <th width="13%">
                    Masuk
                </th>

                <th width="13%">
                    Pulang
                </th>

                <th width="15%">
                    Status
                </th>

                <th width="20%">
                    Metode
                </th>

            </tr>

        </thead>

        <tbody>

            @foreach($absensis as $index => $absensi)

            <tr>

                <td class="text-center">
                    {{ $index + 1 }}
                </td>

                <td>

                    @if($absensi->tanggal)

                    {{ \Carbon\Carbon::parse(
                        $absensi->tanggal
                    )->translatedFormat('d F Y') }}

                    @else

                    -

                    @endif

                </td>

                <td class="text-center">
                    {{ $absensi->jam_masuk ?? '-' }}
                </td>

                <td class="text-center">
                    {{ $absensi->jam_pulang ?? '-' }}
                </td>

                <td class="text-center">
                    {{ ucfirst($absensi->status ?? '-') }}
                </td>

                <td class="text-center">
                    {{ $absensi->metode_verifikasi ?? '-' }}
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

    @else

    <p class="small">
        Belum terdapat data absensi.
    </p>

    @endif


    {{-- LOGBOOK --}}

    <div class="section-title">
        D. REKAPITULASI LOGBOOK
    </div>

    <table class="summary-table">

        <tr>

            <td>

                <div class="summary-number">
                    {{ $jumlahLogbook }}
                </div>

                <div>
                    Total Logbook
                </div>

            </td>

            <td>

                <div class="summary-number">
                    {{ $logbookValid }}
                </div>

                <div>
                    Valid
                </div>

            </td>

            <td>

                <div class="summary-number">
                    {{ $logbookPending }}
                </div>

                <div>
                    Pending
                </div>

            </td>

            <td>

                <div class="summary-number">
                    {{ $logbookDitolak }}
                </div>

                <div>
                    Ditolak
                </div>

            </td>

        </tr>

    </table>

    <br>

    @if($logbooks->count())

    <table class="data-table">

        <thead>

            <tr>

                <th width="5%">
                    No
                </th>

                <th width="15%">
                    Tanggal
                </th>

                <th width="35%">
                    Kegiatan
                </th>

                <th width="25%">
                    Kendala
                </th>

                <th width="20%">
                    Status
                </th>

            </tr>

        </thead>

        <tbody>

            @foreach($logbooks as $index => $logbook)

            <tr>

                <td class="text-center">
                    {{ $index + 1 }}
                </td>

                <td>

                    @if($logbook->tanggal)

                    {{ \Carbon\Carbon::parse(
                        $logbook->tanggal
                    )->translatedFormat('d F Y') }}

                    @else

                    -

                    @endif

                </td>

                <td>
                    {{ $logbook->kegiatan ?? '-' }}
                </td>

                <td>
                    {{ $logbook->kendala ?? '-' }}
                </td>

                <td class="text-center">
                    {{ ucfirst($logbook->status_validasi ?? '-') }}
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

    @else

    <p class="small">
        Belum terdapat data logbook.
    </p>

    @endif


    <div class="page-break"></div>


    {{-- PENILAIAN --}}

    <div class="section-title">
        E. PENILAIAN PKL
    </div>

    @if($penilaianGuru)

    <table class="data-table">

        <thead>

            <tr>

                <th>
                    Aspek Penilaian
                </th>

                <th width="30%">
                    Nilai
                </th>

            </tr>

        </thead>

        <tbody>

            @foreach($penilaianGuru->getAttributes() as $key => $value)

            @if(
            !in_array(
            $key,
            [
            'id',
            'penempatan_pkl_id',
            'created_at',
            'updated_at'
            ]
            )
            &&
            is_numeric($value)
            )

            <tr>

                <td>

                    {{ ucwords(
                        str_replace(
                            '_',
                            ' ',
                            $key
                        )
                    ) }}

                </td>

                <td class="text-center">

                    {{ number_format(
                        $value,
                        2
                    ) }}

                </td>

            </tr>

            @endif

            @endforeach

        </tbody>

    </table>

    @else

    <p class="small">
        Belum ada penilaian dari guru pembimbing.
    </p>

    @endif


    {{-- PENILAIAN INDUSTRI --}}

    @if($penilaianIndustri)

    <br>

    <table class="data-table">

        <thead>

            <tr>

                <th>
                    Aspek Penilaian Industri
                </th>

                <th width="30%">
                    Nilai
                </th>

            </tr>

        </thead>

        <tbody>

            @foreach($penilaianIndustri->getAttributes() as $key => $value)

            @if(
            !in_array(
            $key,
            [
            'id',
            'penempatan_pkl_id',
            'created_at',
            'updated_at'
            ]
            )
            &&
            is_numeric($value)
            )

            <tr>

                <td>

                    {{ ucwords(
                        str_replace(
                            '_',
                            ' ',
                            $key
                        )
                    ) }}

                </td>

                <td class="text-center">

                    {{ number_format(
                        $value,
                        2
                    ) }}

                </td>

            </tr>

            @endif

            @endforeach

        </tbody>

    </table>

    @endif


    {{-- NILAI AKHIR --}}

    @if($nilaiPKL)

    <div class="nilai-box">

        <div class="label">
            NILAI AKHIR PKL
        </div>

        <div class="nilai">

            {{ number_format(
            $nilaiPKL->nilai_akhir ?? 0,
            2
        ) }}

        </div>

    </div>

    @endif


    {{-- CATATAN --}}

    @if($penilaianGuru && $penilaianGuru->catatan)

    <div class="section-title">
        F. CATATAN GURU PEMBIMBING
    </div>

    <div class="catatan">

        {{ $penilaianGuru->catatan }}

    </div>

    @endif


    {{-- TANDA TANGAN --}}

    <table class="signature-table">

        <tr>

            <td>

                Mengetahui,<br>
                Pembimbing Industri

                <div class="signature-space"></div>

                <strong>

                    {{ $penempatan->industri->user->name ?? '.................................' }}

                </strong>

            </td>

            <td>

                Mengetahui,<br>
                Guru Pembimbing

                <div class="signature-space"></div>

                <strong>

                    {{ $penempatan->guru->user->name ?? '.................................' }}

                </strong>

            </td>

            <td>

                Siswa

                <div class="signature-space"></div>

                <strong>

                    {{ $siswa->user->name ?? '.................................' }}

                </strong>

            </td>

        </tr>

    </table>


    <div class="footer">

        Laporan ini dibuat melalui Sistem Informasi Manajemen
        Praktik Kerja Lapangan (SIMPKL).

    </div>


</body>

</html>