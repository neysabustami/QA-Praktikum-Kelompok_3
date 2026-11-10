<?php
session_start();

include '../config/koneksi.php';

if($_SESSION['role'] != "kepsek"){
    header("Location: ../auth/login.php");
    exit;
}

if(!isset($_GET['id'])){
    header("Location: hasil_penilaian.php");
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
$id_user_guru = $data_guru['id_user'];
$dokumen = mysqli_query(
    $koneksi, 
    "SELECT * FROM dokumen WHERE id_guru='$id_user_guru' AND status='Diverifikasi'"
);

/* ==========================================
   CEK PENGESAHAN (Untuk Kunci Edit)
========================================== */
$cek_pengesahan = mysqli_query(
    $koneksi,
    "SELECT * FROM pengesahan LIMIT 1"
);
$pengesahan = mysqli_fetch_array($cek_pengesahan);

/* ==========================================
   DETAIL PENILAIAN
========================================== */
$data = mysqli_query(
    $koneksi,
    "SELECT
        penilaian.id_penilaian,
        kriteria.kode_kriteria,
        kriteria.nama_kriteria,
        kriteria.bobot,
        penilaian.nilai
     FROM penilaian
     JOIN kriteria
     ON penilaian.id_kriteria = kriteria.id_kriteria
     WHERE penilaian.id_user='".$_SESSION['id_user']."'
     AND penilaian.id_guru='$id_guru'
     ORDER BY kriteria.id_kriteria ASC"
);
?>

<!DOCTYPE html>
<html>
<head>
<title>Detail Penilaian Guru</title>
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

.container{ padding:30px; }

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

h2{ margin:0 0 15px 0; }
h3{ color:#38bdf8; margin-top: 0; }
hr{ border:0; border-top:1px solid rgba(255,255,255,0.1); margin:15px 0; }

/* =========================
   INFO BOX & DOKUMEN
========================= */
.info-box{
    background: rgba(15, 23, 42, 0.5);
    padding:18px;
    border-radius:10px;
    border:1px solid rgba(255,255,255,0.08);
    margin-bottom:20px;
}
.info-box p { margin: 0 0 10px 0; color: #cbd5e1; font-size: 15px; }
.info-box h4 { margin: 0 0 10px 0; color: #38bdf8; font-size: 15px; }

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
.doc-list li:last-child { border-bottom: none; padding-bottom: 0; }
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

/* Hapus Hover Glow */
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
tr:hover{ background: transparent !important; }

/* =========================
   BUTTONS
========================= */
.btn-group {
    display: flex;
    gap: 10px;
    margin-top: 20px;
}

.btn{
    display:inline-block;
    padding:10px 20px;
    border-radius:8px;
    text-decoration:none;
    background:#64748b;
    color:#fff;
    font-weight: bold;
    font-size:14px;
    transition: 0.3s;
}
.btn:hover{ background: #475569; }

.btn-edit{
    background:#fbbf24;
    color:#0f172a;
}
.btn-edit:hover{ background: #f59e0b; }

.btn-locked{
    background:#ef4444;
    color:#fff;
    cursor: not-allowed;
    pointer-events: none;
}
</style>
</head>

<body>

<?php include '../template/menu_kepsek.php'; ?>

<div class="container">
    <div class="card">

        <h2>📄 Detail Penilaian Guru</h2>
        <hr>

        <div class="info-box">
            <p>Nama Guru: <strong style="color:#fff; font-size:18px;"><?= htmlspecialchars($data_guru['nama_guru']); ?></strong></p>
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
                <th>Kriteria</th>
                <th width="100">Bobot</th>
                <th width="150">Nilai Diberikan</th>
            </tr>

            <?php
            $no = 1;
            while($row = mysqli_fetch_array($data)){
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['kode_kriteria']) . ' - ' . htmlspecialchars($row['nama_kriteria']); ?></td>
                <td><?= htmlspecialchars($row['bobot']); ?>%</td>
                <td><strong style="color: #38bdf8;"><?= htmlspecialchars($row['nilai']); ?></strong></td>
            </tr>
            <?php } ?>
        </table>

        <div class="btn-group">
            <a href="hasil_penilaian.php" class="btn">← Kembali</a>

            <?php if(!$pengesahan || $pengesahan['status'] != "Disahkan"){ ?>
                <a href="edit_penilaian.php?id=<?= $id_guru; ?>" class="btn btn-edit">✏️ Edit Penilaian</a>
            <?php } else { ?>
                <a href="#" class="btn btn-locked">🔒 Terkunci (Disahkan)</a>
            <?php } ?>
        </div>

    </div>
</div>

</body>
</html>