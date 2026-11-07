@extends('layouts.skydash-admin')

@section('title', 'Detail Nilai PKL')

@section('content')

<style>
    .page-card {
        border: 0;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .035);
    }

    .page-header {
        padding: 20px 22px;
    }

    .page-header-icon {
        width: 46px;
        height: 46px;
        border-radius: 8px;
        background: rgba(75, 73, 172, .10);
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .page-header-icon i {
        font-size: 23px;
    }

    .page-title {
        font-size: 18px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 3px;
    }

    .page-subtitle {
        font-size: 11px;
        color: #9a9aa5;
        margin: 0;
    }

    .page-header .btn {
        font-size: 10px;
        border-radius: 7px;
        padding: 8px 14px;
    }

    .content-card {
        border: 0;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .035);
    }

    .content-card .card-body {
        padding: 22px;
    }

    .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .section-icon {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        background: rgba(75, 73, 172, .10);
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
        flex-shrink: 0;
    }

    .section-icon i {
        font-size: 19px;
    }

    .section-title {
        font-size: 14px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 2px;
    }

    .section-subtitle {
        font-size: 10px;
        color: #9a9aa5;
        margin: 0;
    }

    .student-hero {
        border: 1px solid #eeeeee;
        border-radius: 9px;
        padding: 18px;
        background: #fafaff;
    }

    .student-avatar {
        width: 58px;
        height: 58px;
        border-radius: 50%;
        background: rgba(75, 73, 172, .10);
        color: #4b49ac;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .student-avatar i {
        font-size: 30px;
    }

    .student-name {
        font-size: 15px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 3px;
    }

    .student-nis {
        font-size: 9px;
        color: #9a9aa5;
    }

    .info-item {
        border: 1px solid #eeeeee;
        border-radius: 8px;
        padding: 12px 14px;
        height: 100%;
        background: #fff;
    }

    .info-label {
        display: block;
        font-size: 9px;
        color: #9a9aa5;
        margin-bottom: 5px;
    }

    .info-value {
        font-size: 10px;
        font-weight: 600;
        color: #343a40;
        line-height: 1.5;
    }

    .assessment-card {
        border: 1px solid #eeeeee;
        border-radius: 9px;
        overflow: hidden;
        height: 100%;
    }

    .assessment-header {
        padding: 17px 18px;
        border-bottom: 1px solid #eeeeee;
    }

    .assessment-guru {
        background: rgba(75, 73, 172, .035);
    }

    .assessment-industri {
        background: rgba(40, 167, 69, .035);
    }

    .assessment-title {
        font-size: 13px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 3px;
    }

    .assessment-description {
        font-size: 9px;
        color: #9a9aa5;
        margin: 0;
    }

    .score-header {
        min-width: 58px;
        padding: 7px 9px;
        border-radius: 6px;
        text-align: center;
        font-size: 10px;
        font-weight: 600;
    }

    .score-primary {
        background: rgba(75, 73, 172, .10);
        color: #4b49ac;
    }

    .score-success {
        background: rgba(40, 167, 69, .10);
        color: #28a745;
    }

    .assessment-body {
        padding: 18px;
    }

    .score-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f2;
    }

    .score-row:last-child {
        border-bottom: 0;
    }

    .score-label {
        font-size: 10px;
        color: #666;
    }

    .score-value {
        font-size: 11px;
        font-weight: 600;
        color: #343a40;
    }

    .final-score {
        margin-top: 15px;
        padding: 13px 14px;
        border-radius: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .final-score-primary {
        background: rgba(75, 73, 172, .08);
    }

    .final-score-success {
        background: rgba(40, 167, 69, .08);
    }

    .final-label {
        font-size: 10px;
        font-weight: 600;
        color: #555;
    }

    .final-value {
        font-size: 20px;
        font-weight: 600;
        margin: 0;
    }

    .text-primary-custom {
        color: #4b49ac !important;
    }

    .text-success-custom {
        color: #28a745 !important;
    }

    .note-box {
        margin-top: 15px;
        padding: 12px 13px;
        border: 1px solid #eeeeee;
        border-radius: 7px;
        background: #fff;
    }

    .note-label {
        display: block;
        font-size: 9px;
        font-weight: 600;
        color: #555;
        margin-bottom: 5px;
    }

    .note-text {
        font-size: 10px;
        color: #777;
        line-height: 1.6;
        margin: 0;
    }

    .empty-state {
        padding: 45px 15px;
        text-align: center;
    }

    .empty-state i {
        font-size: 42px;
        color: #c8c8d0;
    }

    .empty-state h6 {
        font-size: 11px;
        color: #555;
        margin-top: 10px;
        margin-bottom: 5px;
    }

    .empty-state p {
        font-size: 9px;
        color: #9a9aa5;
        margin: 0;
    }

    .summary-card {
        border: 1px solid #eeeeee;
        border-radius: 9px;
        padding: 20px 15px;
        text-align: center;
        height: 100%;
    }

    .summary-label {
        font-size: 9px;
        color: #9a9aa5;
        margin-bottom: 8px;
    }

    .summary-value {
        font-size: 24px;
        font-weight: 600;
        margin: 0;
    }

    .summary-primary {
        color: #4b49ac;
    }

    .summary-success {
        color: #28a745;
    }

    .summary-dark {
        color: #343a40;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 10px;
        border-radius: 5px;
        font-size: 8px;
        font-weight: 600;
    }

    .status-complete {
        background: rgba(40, 167, 69, .10);
        color: #28a745;
    }

    .status-partial {
        background: rgba(255, 193, 7, .13);
        color: #b38600;
    }

    .status-empty {
        background: #f1f1f4;
        color: #777;
    }

    .back-btn {
        font-size: 10px;
        border-radius: 7px;
        padding: 8px 14px;
    }

    @media (max-width: 767.98px) {

        .page-header {
            padding: 17px;
        }

        .page-header-actions {
            margin-top: 15px;
            width: 100%;
        }

        .page-header-actions .btn {
            width: 100%;
        }

        .content-card .card-body {
            padding: 17px;
        }

        .student-hero {
            text-align: center;
        }

        .student-avatar {
            margin: 0 auto 12px;
        }
    }
</style>


{{-- =========================================================
     HEADER
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card page-card">

            <div class="page-header">

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <div class="d-flex align-items-center">

                            <div class="page-header-icon me-3">

                                <i class="mdi mdi-star-check-outline"></i>

                            </div>

                            <div>

                                <h4 class="page-title">
                                    Detail Nilai PKL
                                </h4>

                                <p class="page-subtitle">
                                    Rincian penilaian siswa dari Guru Pembimbing dan Pembimbing Industri.
                                </p>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="d-flex justify-content-md-end page-header-actions">

                            <a
                                href="{{ route('admin.nilai.index') }}"
                                class="btn btn-light">

                                <i class="mdi mdi-arrow-left me-1"></i>

                                Kembali

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     INFORMASI SISWA
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card content-card">

            <div class="card-body">

                <div class="section-header">

                    <div class="section-icon">

                        <i class="mdi mdi-account-school-outline"></i>

                    </div>

                    <div>

                        <h5 class="section-title">
                            Informasi Siswa
                        </h5>

                        <p class="section-subtitle">
                            Informasi siswa dan penempatan PKL.
                        </p>

                    </div>

                </div>


                {{-- IDENTITAS UTAMA --}}

                <div class="student-hero mb-3">

                    <div class="d-flex align-items-center">

                        <div class="student-avatar me-3">

                            <i class="mdi mdi-account-school-outline"></i>

                        </div>

                        <div>

                            <div class="student-name">

                                {{
                                    $penempatan->siswa->user->name
                                    ?? '-'
                                }}

                            </div>

                            <div class="student-nis">

                                NIS:
                                {{
                                    $penempatan->siswa->nis
                                    ?? '-'
                                }}

                            </div>

                        </div>

                    </div>

                </div>


                {{-- DETAIL SISWA --}}

                <div class="row">

                    <div class="col-md-6 col-lg-3 mb-3">

                        <div class="info-item">

                            <span class="info-label">
                                Jurusan
                            </span>

                            <span class="info-value">

                                {{
                                    $penempatan->siswa->jurusan->nama_jurusan
                                    ?? '-'
                                }}

                            </span>

                        </div>

                    </div>


                    <div class="col-md-6 col-lg-3 mb-3">

                        <div class="info-item">

                            <span class="info-label">
                                Kelas
                            </span>

                            <span class="info-value">

                                {{
                                    $penempatan->siswa->kelas->nama_kelas
                                    ?? '-'
                                }}

                            </span>

                        </div>

                    </div>


                    <div class="col-md-6 col-lg-3 mb-3">

                        <div class="info-item">

                            <span class="info-label">
                                Perusahaan / DUDI
                            </span>

                            <span class="info-value">

                                {{
                                    $penempatan->perusahaan->nama_perusahaan
                                    ?? '-'
                                }}

                            </span>

                        </div>

                    </div>


                    <div class="col-md-6 col-lg-3 mb-3">

                        <div class="info-item">

                            <span class="info-label">
                                Guru Pembimbing
                            </span>

                            <span class="info-value">

                                {{
                                    $penempatan->guru->user->name
                                    ?? '-'
                                }}

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     PENILAIAN GURU DAN INDUSTRI
========================================================= --}}

<div class="row">

    {{-- PENILAIAN GURU --}}

    <div class="col-lg-6 grid-margin stretch-card">

        <div class="card content-card">

            <div class="assessment-card">

                <div class="assessment-header assessment-guru">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <h5 class="assessment-title">
                                Penilaian Guru Pembimbing
                            </h5>

                            <p class="assessment-description">
                                Penilaian dari guru pembimbing sekolah.
                            </p>

                        </div>


                        @if($penempatan->penilaianGuru)

                        <span class="score-header score-primary">

                            {{
                                    number_format(
                                        $penempatan->penilaianGuru->nilai_akhir,
                                        2
                                    )
                                }}

                        </span>

                        @else

                        <span class="status-badge status-empty">

                            Belum Dinilai

                        </span>

                        @endif

                    </div>

                </div>


                @if($penempatan->penilaianGuru)

                <div class="assessment-body">

                    <div class="score-row">

                        <span class="score-label">
                            Disiplin
                        </span>

                        <span class="score-value">

                            {{ $penempatan->penilaianGuru->disiplin }}

                        </span>

                    </div>


                    <div class="score-row">

                        <span class="score-label">
                            Kerjasama
                        </span>

                        <span class="score-value">

                            {{ $penempatan->penilaianGuru->kerjasama }}

                        </span>

                    </div>


                    <div class="score-row">

                        <span class="score-label">
                            Inisiatif
                        </span>

                        <span class="score-value">

                            {{ $penempatan->penilaianGuru->inisiatif }}

                        </span>

                    </div>


                    <div class="score-row">

                        <span class="score-label">
                            Tanggung Jawab
                        </span>

                        <span class="score-value">

                            {{ $penempatan->penilaianGuru->tanggung_jawab }}

                        </span>

                    </div>


                    <div class="score-row">

                        <span class="score-label">
                            Keterampilan
                        </span>

                        <span class="score-value">

                            {{ $penempatan->penilaianGuru->keterampilan }}

                        </span>

                    </div>


                    <div class="final-score final-score-primary">

                        <span class="final-label">
                            Nilai Akhir
                        </span>

                        <h4 class="final-value text-primary-custom">

                            {{
                                    number_format(
                                        $penempatan->penilaianGuru->nilai_akhir,
                                        2
                                    )
                                }}

                        </h4>

                    </div>


                    <div class="note-box">

                        <span class="note-label">
                            Catatan Guru
                        </span>

                        <p class="note-text">

                            {{
                                    $penempatan->penilaianGuru->catatan
                                    ?? '-'
                                }}

                        </p>

                    </div>

                </div>

                @else

                <div class="empty-state">

                    <i class="mdi mdi-star-off-outline"></i>

                    <h6>
                        Belum Ada Penilaian
                    </h6>

                    <p>
                        Guru pembimbing belum memberikan penilaian.
                    </p>

                </div>

                @endif

            </div>

        </div>

    </div>


    {{-- PENILAIAN INDUSTRI --}}

    <div class="col-lg-6 grid-margin stretch-card">

        <div class="card content-card">

            <div class="assessment-card">

                <div class="assessment-header assessment-industri">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <h5 class="assessment-title">
                                Penilaian Pembimbing Industri
                            </h5>

                            <p class="assessment-description">
                                Penilaian dari pihak industri.
                            </p>

                        </div>


                        @if($penempatan->penilaianIndustri)

                        <span class="score-header score-success">

                            {{
                                    number_format(
                                        $penempatan->penilaianIndustri->nilai_akhir,
                                        2
                                    )
                                }}

                        </span>

                        @else

                        <span class="status-badge status-empty">

                            Belum Dinilai

                        </span>

                        @endif

                    </div>

                </div>


                @if($penempatan->penilaianIndustri)

                <div class="assessment-body">

                    <div class="score-row">

                        <span class="score-label">
                            Disiplin
                        </span>

                        <span class="score-value">

                            {{ $penempatan->penilaianIndustri->disiplin }}

                        </span>

                    </div>


                    <div class="score-row">

                        <span class="score-label">
                            Kerjasama
                        </span>

                        <span class="score-value">

                            {{ $penempatan->penilaianIndustri->kerjasama }}

                        </span>

                    </div>


                    <div class="score-row">

                        <span class="score-label">
                            Inisiatif
                        </span>

                        <span class="score-value">

                            {{ $penempatan->penilaianIndustri->inisiatif }}

                        </span>

                    </div>


                    <div class="score-row">

                        <span class="score-label">
                            Tanggung Jawab
                        </span>

                        <span class="score-value">

                            {{ $penempatan->penilaianIndustri->tanggung_jawab }}

                        </span>

                    </div>


                    <div class="score-row">

                        <span class="score-label">
                            Keterampilan
                        </span>

                        <span class="score-value">

                            {{ $penempatan->penilaianIndustri->keterampilan }}

                        </span>

                    </div>


                    <div class="final-score final-score-success">

                        <span class="final-label">
                            Nilai Akhir
                        </span>

                        <h4 class="final-value text-success-custom">

                            {{
                                    number_format(
                                        $penempatan->penilaianIndustri->nilai_akhir,
                                        2
                                    )
                                }}

                        </h4>

                    </div>


                    <div class="note-box">

                        <span class="note-label">
                            Catatan Pembimbing Industri
                        </span>

                        <p class="note-text">

                            {{
                                    $penempatan->penilaianIndustri->catatan
                                    ?? '-'
                                }}

                        </p>

                    </div>

                </div>

                @else

                <div class="empty-state">

                    <i class="mdi mdi-star-off-outline"></i>

                    <h6>
                        Belum Ada Penilaian
                    </h6>

                    <p>
                        Pembimbing industri belum memberikan penilaian.
                    </p>

                </div>

                @endif

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     RINGKASAN NILAI
========================================================= --}}

<div class="row">

    <div class="col-12 grid-margin">

        <div class="card content-card">

            <div class="card-body">

                <div class="section-header">

                    <div class="section-icon">

                        <i class="mdi mdi-chart-box-outline"></i>

                    </div>

                    <div>

                        <h5 class="section-title">
                            Ringkasan Nilai
                        </h5>

                        <p class="section-subtitle">
                            Rekapitulasi nilai akhir dari seluruh penilai.
                        </p>

                    </div>

                </div>


                @php

                $nilaiGuru =
                $penempatan->penilaianGuru?->nilai_akhir;

                $nilaiIndustri =
                $penempatan->penilaianIndustri?->nilai_akhir;

                $jumlahNilai = 0;

                $jumlahPenilai = 0;

                if ($nilaiGuru !== null) {

                $jumlahNilai += $nilaiGuru;

                $jumlahPenilai++;

                }

                if ($nilaiIndustri !== null) {

                $jumlahNilai += $nilaiIndustri;

                $jumlahPenilai++;

                }

                $nilaiRataRata =
                $jumlahPenilai > 0
                ? $jumlahNilai / $jumlahPenilai
                : null;

                @endphp


                <div class="row">

                    {{-- NILAI GURU --}}

                    <div class="col-md-4 mb-3 mb-md-0">

                        <div class="summary-card">

                            <div class="summary-label">
                                Nilai Guru
                            </div>

                            @if($nilaiGuru !== null)

                            <h2 class="summary-value summary-primary">

                                {{
                                        number_format(
                                            $nilaiGuru,
                                            2
                                        )
                                    }}

                            </h2>

                            @else

                            <div class="text-muted small">
                                Belum Dinilai
                            </div>

                            @endif

                        </div>

                    </div>


                    {{-- NILAI INDUSTRI --}}

                    <div class="col-md-4 mb-3 mb-md-0">

                        <div class="summary-card">

                            <div class="summary-label">
                                Nilai Industri
                            </div>

                            @if($nilaiIndustri !== null)

                            <h2 class="summary-value summary-success">

                                {{
                                        number_format(
                                            $nilaiIndustri,
                                            2
                                        )
                                    }}

                            </h2>

                            @else

                            <div class="text-muted small">
                                Belum Dinilai
                            </div>

                            @endif

                        </div>

                    </div>


                    {{-- RATA-RATA --}}

                    <div class="col-md-4">

                        <div class="summary-card">

                            <div class="summary-label">
                                Rata-rata Penilaian
                            </div>

                            @if($nilaiRataRata !== null)

                            <h2 class="summary-value summary-dark">

                                {{
                                        number_format(
                                            $nilaiRataRata,
                                            2
                                        )
                                    }}

                            </h2>

                            @else

                            <div class="text-muted small">
                                Belum Ada Nilai
                            </div>

                            @endif

                        </div>

                    </div>

                </div>


                <div class="text-center mt-4">

                    @if(
                    $nilaiGuru !== null &&
                    $nilaiIndustri !== null
                    )

                    <span class="status-badge status-complete">

                        <i class="mdi mdi-check-circle-outline me-1"></i>

                        Penilaian Lengkap

                    </span>

                    @elseif(
                    $nilaiGuru !== null ||
                    $nilaiIndustri !== null
                    )

                    <span class="status-badge status-partial">

                        <i class="mdi mdi-progress-clock me-1"></i>

                        Penilaian Sebagian

                    </span>

                    @else

                    <span class="status-badge status-empty">

                        Belum Dinilai

                    </span>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     FOOTER ACTION
========================================================= --}}

<div class="row">

    <div class="col-12">

        <a
            href="{{ route('admin.nilai.index') }}"
            class="btn btn-light back-btn">

            <i class="mdi mdi-arrow-left me-1"></i>

            Kembali ke Daftar Nilai

        </a>

    </div>

</div>

@endsection