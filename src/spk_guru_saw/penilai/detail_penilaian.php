<?php
session_start();

include '../config/koneksi.php';

if($_SESSION['role'] != "penilai"){
    header("Location: ../auth/login.php");
    exit;
}

$id_guru = $_GET['id'];

/* ==========================================
   AMBIL DATA GURU
========================================== */
$guru = mysqli_query(
    $koneksi,
    "SELECT * FROM guru WHERE id_guru='$id_guru'"
);

$data_guru = mysqli_fetch_array($guru);

if(!$data_guru){
    header("Location: hasil_penilaian.php");
    exit;
}

/* ==========================================
   AMBIL DOKUMEN PENDUKUNG TERVERIFIKASI
========================================== */
// Gunakan id_user guru untuk melacak dokumennya di tabel dokumen
$id_user_guru = $data_guru['id_user'];
$dokumen = mysqli_query(
    $koneksi, 
    "SELECT * FROM dokumen WHERE id_guru='$id_user_guru' AND status='Diverifikasi'"
);

/* ==========================================
   DETAIL PENILAIAN
========================================== */
$data = mysqli_query(
    $koneksi,
    "SELECT
        kriteria.nama_kriteria,
        kriteria.kode_kriteria,
        penilaian.nilai
     FROM penilaian
     JOIN kriteria
     ON kriteria.id_kriteria = penilaian.id_kriteria
     WHERE penilaian.id_user='".$_SESSION['id_user']."'
     AND penilaian.id_guru='$id_guru'
     ORDER BY kriteria.id_kriteria ASC"
);
?>

<!DOCTYPE html>
<html>
<head>
<title>Detail Penilaian</title>
<link rel="stylesheet" href="../assets/css/style.css">
<style>
/* =========================
   BASE STYLE
========================= */
body{
    margin:0;
    font-family:'Segoe UI', Tahoma, sans-serif;
    background: linear-gradient(135deg, #0f172a, #1e293b);
    color:#fff;
}

.container{
    padding:30px;
}

.card{
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.08);
    backdrop-filter: blur(10px);
    padding:25px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.3);
    max-width: 900px;
    margin: 0 auto;
}

/* HEADER */
h2{ margin:0 0 15px 0; }
h3{ color:#38bdf8; margin-top: 0; }

/* INFO BOX */
.info-box{
    background: rgba(15, 23, 42, 0.5);
    padding:18px;
    border-radius:10px;
    border:1px solid rgba(255,255,255,0.08);
    margin-bottom:20px;
}
.info-box p { margin: 0 0 10px 0; color: #cbd5e1; font-size: 14px; }
.info-box h4 { margin: 0 0 10px 0; color: #38bdf8; font-size: 15px; }

/* LIST DOKUMEN */
.doc-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.doc-list li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid rgba(255,255,255,0.05);
}
.doc-list li:last-child {
    border-bottom: none;
    padding-bottom: 0;
}
.btn-lihat {
    background: rgba(34, 197, 94, 0.1);
    color: #22c55e;
    padding: 4px 10px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 12px;
    font-weight: bold;
    border: 1px solid rgba(34, 197, 94, 0.3);
    transition: 0.3s;
}
.btn-lihat:hover { background: #22c55e; color: #0f172a; }

/* =========================
   TABLE 
========================= */
table{
    width:100%;
    border-collapse:collapse;
    min-width:600px;
    background: rgba(15, 23, 42, 0.4);
    border-radius:10px;
    overflow:hidden;
}

th{
    padding:12px;
    text-align:left;
    background: rgba(56, 189, 248, 0.15);
    color:#cbd5e1;
}

td{
    padding:12px;
    color:#e2e8f0;
    background: rgba(15, 23, 42, 0.2);
    border-bottom: 1px solid rgba(255,255,255,0.02);
}

/* 🔴 INI BAGIAN PENTING: HAPUS HOVER 100% (FORCE OVERRIDE) */
table tr:hover td,
table tbody tr:hover td,
table tr:hover,
table tbody tr:hover{
    background: rgba(15, 23, 42, 0.2) !important;
    color:#e2e8f0 !important;
    transform:none !important;
    filter:none !important;
    box-shadow:none !important;
}

tr:hover{
    background: transparent !important;
}

/* BUTTON KEMBALI */
.btn{
    display:inline-block;
    margin-top:20px;
    padding:10px 20px;
    border-radius:8px;
    background:#64748b;
    color:#fff;
    text-decoration:none;
    font-size:14px;
    font-weight: bold;
    transition: 0.3s;
}

.btn:hover{
    background: #475569;
}
</style>
</head>

<body>

<?php include '../template/menu_penilai.php'; ?>

<div class="container">
    <div class="card">

        <h2>📄 Detail Penilaian</h2>
        <h3>👨‍🏫 <?= htmlspecialchars($data_guru['nama_guru']); ?></h3>

        <div class="info-box">
            <p>Berikut adalah rincian bukti dokumen yang digunakan sebagai dasar penilaian guru bersangkutan.</p>
            <hr style="border:0; border-top:1px solid rgba(255,255,255,0.1); margin:10px 0;">
            
            <h4>📂 Bukti Dokumen Terverifikasi:</h4>
            <?php if(mysqli_num_rows($dokumen) > 0) { ?>
                <ul class="doc-list">
                    <?php while($d = mysqli_fetch_assoc($dokumen)) { ?>
                        <tr>
                            <li>
                                <span style="color: #fff; font-size: 14px;">- <?= htmlspecialchars($d['jenis_dokumen']); ?></span>
                                <a href="../uploads/<?= htmlspecialchars($d['nama_file']); ?>" target="_blank" class="btn-lihat">📄 Lihat Berkas</a>
                            </li>
                        </tr>
                    <?php } ?>
                </ul>
            <?php } else { ?>
                <div style="background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); padding: 10px; border-radius: 6px; color: #fca5a5; font-size: 13px;">
                    Belum ada dokumen yang diverifikasi untuk guru ini.
                </div>
            <?php } ?>
        </div>

        <table>
            <tr>
                <th width="60">No</th>
                <th>Kriteria Evaluasi</th>
                <th width="150">Nilai Diberikan</th>
            </tr>

            <?php
            $no = 1;
            while($row = mysqli_fetch_array($data)){
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['kode_kriteria']) . ' - ' . htmlspecialchars($row['nama_kriteria']); ?></td>
                <td><strong style="color: #38bdf8;"><?= htmlspecialchars($row['nilai']); ?></strong></td>
            </tr>
            <?php } ?>
        </table>

        <a href="hasil_penilaian.php" class="btn">← Kembali ke Daftar Penilaian</a>

    </div>
</div>

</body>
</html>