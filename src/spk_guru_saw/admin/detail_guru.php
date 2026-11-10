<?php
session_start();
include '../config/koneksi.php';

// Pastikan hanya admin yang bisa akses
if($_SESSION['role'] != "admin"){
    header("Location: ../auth/login.php");
    exit;
}

// Ambil id_user (yang dikirim sebagai id_guru dari halaman sebelumnya)
$id_user = $_GET['id'];

// Ambil data user
$user = mysqli_query($koneksi, "SELECT * FROM users WHERE id_user = '$id_user'");
$u = mysqli_fetch_array($user);

// Ambil dokumen berdasarkan id_user tersebut
$dok = mysqli_query($koneksi, "SELECT * FROM dokumen WHERE id_guru = '$id_user'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Dokumen Guru - SPK SAW</title>
    
    <link rel="stylesheet" href="../assets/css/style.css">
    
    <style>
        /* TEMA GLOBAL SAMA PERSIS */
        body{
            margin:0;
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: linear-gradient(135deg, #0f172a, #1e293b);
            color:#fff;
            overflow-y: scroll; /* Mengunci layar agar navigasi tidak bergerak */
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
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }

        /* HEADER / JUDUL SAMA PERSIS */
        .page-title{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:15px;
        }

        h2{
            margin:0;
            font-size:24px;
        }

        .subtitle{
            font-size:13px;
            color:#94a3b8;
            margin-top:5px;
        }

        /* BUTTON SAMA PERSIS */
        .btn{
            display:inline-block;
            padding:8px 14px;
            border-radius:8px;
            text-decoration:none;
            font-size:14px;
            transition:0.3s ease;
            border:none;
            cursor:pointer;
            font-weight:600;
        }

        .btn-kembali{
            background:#64748b;
            color:#fff;
        }

        .btn-kembali:hover{
            background:#475569;
            transform: translateY(-2px);
        }

        .btn-verif{
            background:#22c55e;
            color:#fff;
            padding:6px 12px;
            font-size: 13px;
        }

        .btn-verif:hover{
            background:#16a34a;
            transform: translateY(-2px);
        }

        /* TABLE SAMA PERSIS */
        .table-container{
            overflow-x:auto;
            margin-top:15px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            min-width:600px;
            background: rgba(15, 23, 42, 0.4);
            border-radius:10px;
            overflow:hidden;
        }

        th{
            padding:12px 15px;
            text-align:left;
            background: rgba(56, 189, 248, 0.15);
            color:#cbd5e1;
            font-weight:600;
            border-bottom:1px solid rgba(255,255,255,0.1);
        }

        td{
            padding:12px 15px;
            text-align:left;
            color:#e2e8f0;
            border-bottom:1px solid rgba(255,255,255,0.05);
            background: rgba(15, 23, 42, 0.2);
        }

        /* ROW STABIL (FIX GLITCH HOVER) SAMA PERSIS */
        tr{
            transition: background-color 0.15s ease;
        }

        /* HOVER: hanya gelapkan baris, tidak mengubah teks */
        table tbody tr:hover td{
            background: rgba(2, 6, 23, 0.95) !important;
            color:#e2e8f0 !important;
        }

        table tbody tr:hover{
            box-shadow:none;
        }

        /* CUSTOM KHUSUS HALAMAN INI */
        .link-file {
            color: #38bdf8;
            text-decoration: none;
            font-weight: bold;
        }
        
        .link-file:hover {
            color: #0ea5e9;
            text-decoration: underline;
        }

        .status-verified { color: #22c55e; font-weight: bold; font-size: 13px; }
        .status-pending { color: #facc15; font-weight: bold; font-size: 13px; }
    </style>
</head>
<body>

<?php include '../template/menu_admin.php'; ?>

<div class="container">
    <div class="card">
        
        <div class="page-title">
            <div>
                <h2>📂 Dokumen: <?= htmlspecialchars($u['nama'] ?? 'User Tidak Dikenal'); ?></h2>
                <div class="subtitle">Periksa dan verifikasi berkas yang telah dilampirkan oleh guru</div>
            </div>
            
            <!-- Posisi tombol kembali dipindah ke atas kanan sejajar dengan judul -->
            <a href="data_dokumen.php" class="btn btn-kembali">
                ← Kembali
            </a>
        </div>
        
        <div class="table-container">
            <table>
                <tr>
                    <th>Jenis Dokumen</th>
                    <th>Status</th>
                    <th>File</th>
                    <th width="120">Aksi</th>
                </tr>

                <?php 
                if (mysqli_num_rows($dok) > 0) {
                    while($row = mysqli_fetch_array($dok)){ 
                ?>
                <tr>
                    <td><?= htmlspecialchars($row['jenis_dokumen']) ?></td>
                    <td>
                        <?php if($row['status'] == 'Pending') { ?>
                            <span class="status-pending">🕒 Pending</span>
                        <?php } else { ?>
                            <span class="status-verified">✓ Diverifikasi</span>
                        <?php } ?>
                    </td>
                    <td>
                        <a href="../uploads/<?= $row['nama_file'] ?>" target="_blank" class="link-file">
                            Lihat File ↗
                        </a>
                    </td>
                    <td>
                        <?php if($row['status'] == 'Pending') { ?>
                            <a href="proses_verifikasi.php?id=<?= $row['id_dokumen']; ?>&id_user=<?= $id_user; ?>" class="btn btn-verif">
                                Verifikasi
                            </a>
                        <?php } else { ?>
                            <span style="color:#94a3b8; font-size:13px; font-weight:600;">Selesai</span>
                        <?php } ?>
                    </td>
                </tr>
                <?php 
                    } 
                } else { 
                ?>
                <tr>
                    <td colspan="4" style="text-align:center; padding:20px; color:#94a3b8;">
                        Guru ini belum mengunggah dokumen apapun.
                    </td>
                </tr>
                <?php } ?>
                
            </table>
        </div>

    </div>
</div>

</body>
</html>