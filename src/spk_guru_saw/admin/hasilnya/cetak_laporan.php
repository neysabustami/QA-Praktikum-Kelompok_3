<?php
session_start();
include '../../config/koneksi.php';

// Ambil bulan dan tahun saat ini dalam format bahasa Indonesia
$bulan_indo = array(
    1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
);
$tanggal_cetak = date('d') . ' ' . $bulan_indo[(int)date('m')] . ' ' . date('Y');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cetak Laporan SPK SAW</title>
    <style>
        /* =========================
           SCREEN STYLE (VIEW PADA BROWSER)
        ========================= */
        body {
            font-family: 'Times New Roman', Times, serif;
            background: #e2e8f0;
            margin: 0;
            padding: 20px;
            color: #000;
        }

        /* Kontainer bergaya kertas A4 */
        .paper-container {
            background: #fff;
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            padding: 20mm;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            border-radius: 5px;
            box-sizing: border-box;
        }

        /* Tombol Kontrol */
        .control-area {
            text-align: center;
            margin-bottom: 20px;
        }
        .btn {
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
            display: inline-block;
            font-weight: bold;
            font-family: Arial, sans-serif;
            transition: 0.3s;
        }
        .btn-print { background: #2563eb; color: #fff; border: none; cursor: pointer; }
        .btn-print:hover { background: #1d4ed8; }
        .btn-back { background: #64748b; color: #fff; margin-left: 10px; }
        .btn-back:hover { background: #475569; }

        /* =========================
           STYLING KOP SURAT
        ========================= */
        .kop-surat { text-align: center; margin-bottom: 20px; }
        .kop-surat h1 { font-size: 16px; margin: 2px 0; font-weight: normal; letter-spacing: 1px; }
        .kop-surat h2 { font-size: 20px; margin: 2px 0; font-weight: bold; }
        .kop-surat h3 { font-size: 24px; margin: 2px 0; font-weight: bold; }
        .kop-surat p { font-size: 12px; margin: 4px 0; }
        .garis-ganda { border-top: 3px solid #000; border-bottom: 1px solid #000; height: 2px; margin-top: 15px; margin-bottom: 20px; }

        /* =========================
           STYLING KONTEN & TABEL
        ========================= */
        .judul-laporan { text-align: center; margin-bottom: 20px; }
        .judul-laporan h4 { font-size: 16px; margin: 0; text-decoration: underline; }
        .judul-laporan p { margin: 5px 0 0 0; font-size: 14px; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px 12px;
            text-align: center;
            font-size: 14px;
        }
        td:nth-child(2) { text-align: left; } /* Nama guru rata kiri */
        th { background: #f3f4f6; font-weight: bold; }

        /* Matikan Hover */
        tr:hover, td:hover { background: transparent !important; }

        /* =========================
           STYLING TANDA TANGAN
        ========================= */
        .ttd-area {
            margin-top: 40px;
            width: 100%;
            display: flex;
            justify-content: flex-end;
        }
        .ttd-box {
            text-align: center;
            width: 250px;
            font-size: 14px;
        }
        .ttd-box p { margin: 5px 0; }
        .nama-kepsek { margin-top: 70px !important; font-weight: bold; text-decoration: underline; }

        /* =========================
           PRINT MODE SETTINGS
        ========================= */
        @media print {
            body { background: #fff; margin: 0; padding: 0; }
            .control-area { display: none !important; }
            .paper-container { box-shadow: none; padding: 0; width: 100%; height: auto; }
            table { width: 100%; }
            th { background: #e5e7eb !important; -webkit-print-color-adjust: exact; }
        }
    </style>
</head>
<body>

<div class="control-area">
    <button class="btn btn-print" onclick="window.print()">🖨 Cetak Laporan</button>
    <a href="hasil.php" class="btn btn-back">⬅ Kembali</a>
</div>

<div class="paper-container">
    
    <div class="kop-surat">
        <h1>PEMERINTAH PROVINSI SUMATERA BARAT</h1>
        <h2>DINAS PENDIDIKAN</h2>
        <h3>SMP NEGERI 7 KOTA PADANG</h3>
        <p>Jl. S. Parman, Kelurahan Lolong Belanti, Kecamatan Padang Utara, Kota Padang, Sumatera Barat</p>
        <p>Email: admin@smpn7padang.sch.id | Website: www.smpn7padang.sch.id</p>
        <div class="garis-ganda"></div>
    </div>

    <div class="judul-laporan">
        <h4>LAPORAN HASIL EVALUASI GURU BERPRESTASI</h4>
        <p>Berdasarkan Sistem Pendukung Keputusan (Metode SAW)</p>
    </div>

    <table>
        <tr>
            <th width="10%">Peringkat</th>
            <th>Nama Lengkap Guru</th>
            <th width="25%">Nilai Akhir (Preferensi)</th>
        </tr>

        <?php
        $guru = mysqli_query($koneksi, "SELECT * FROM guru");
        $kriteria = mysqli_query($koneksi, "SELECT * FROM kriteria");

        $data_kriteria = [];
        while($k = mysqli_fetch_array($kriteria)){
            $data_kriteria[] = $k;
        }

        $max = [];
        foreach($data_kriteria as $k){
            $id_kriteria = $k['id_kriteria'];
            $qmax = mysqli_query($koneksi, "SELECT MAX(nilai) as max_nilai FROM penilaian WHERE id_kriteria='$id_kriteria'");
            $dmax = mysqli_fetch_array($qmax);
            $max[$id_kriteria] = $dmax['max_nilai'];
        }

        $hasil = [];
        while($g = mysqli_fetch_array($guru)){
            $total = 0;
            foreach($data_kriteria as $k){
                $id_kriteria = $k['id_kriteria'];
                $qnilai = mysqli_query($koneksi, "SELECT AVG(nilai) as rata FROM penilaian WHERE id_guru='".$g['id_guru']."' AND id_kriteria='$id_kriteria'");
                $dnilai = mysqli_fetch_array($qnilai);
                $nilai = $dnilai['rata'];

                if($max[$id_kriteria] != 0){
                    $normalisasi = $nilai / $max[$id_kriteria];
                }else{
                    $normalisasi = 0;
                }
                $total += $normalisasi * $k['bobot'];
            }
            $hasil[] = [
                'nama_guru' => $g['nama_guru'],
                'total' => $total
            ];
        }

        usort($hasil, function($a,$b){
            return $b['total'] <=> $a['total'];
        });

        $rank = 1;
        foreach($hasil as $h){
        ?>
        <tr>
            <td><strong><?= $rank++; ?></strong></td>
            <td><?= htmlspecialchars($h['nama_guru']); ?></td>
            <td><?= round($h['total'], 4); ?></td>
        </tr>
        <?php } ?>
    </table>

    <div class="ttd-area">
        <div class="ttd-box">
            <p>Koto Padang, <?= $tanggal_cetak; ?></p>
            <p>Kepala Sekolah,</p>
            <p class="nama-kepsek">Fitria Yenira, S.si</p>
            <p>NIP. 19750907 200902 2 001</p>
        </div>
    </div>

</div>

<script>
    // Fitur auto-print opsional jika ingin langsung dialog print terbuka saat di-klik dari menu
    // window.onload = function() { window.print(); }
</script>

</body>
</html>