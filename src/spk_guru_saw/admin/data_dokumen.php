<?php
session_start();

include '../config/koneksi.php';

if($_SESSION['role'] != "admin"){
    header("Location: ../auth/login.php");
    exit;
}

// Tambahkan logika penghitungan status 'Pending' menggunakan SUM(CASE WHEN ...)
// Guru yang memiliki dokumen pending akan diurutkan paling atas (pending_count DESC)
$query = mysqli_query($koneksi, "
    SELECT 
        u.id_user as id_guru, 
        u.nama as nama_guru, 
        GROUP_CONCAT(d.jenis_dokumen SEPARATOR ', ') as daftar_dokumen,
        SUM(CASE WHEN d.status = 'Pending' THEN 1 ELSE 0 END) as pending_count
    FROM users u
    JOIN dokumen d ON u.id_user = d.id_guru
    GROUP BY u.id_user
    ORDER BY pending_count DESC, u.nama ASC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi Dokumen - SPK SAW</title>

    <link rel="stylesheet" href="../assets/css/style.css">

    <style>
        body{
            margin:0;
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: linear-gradient(135deg, #0f172a, #1e293b);
            color:#fff;
            overflow-y: scroll;
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

        /* HEADER */
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

        /* BUTTON */
        .btn{
            display:inline-block;
            padding:8px 14px;
            border-radius:8px;
            text-decoration:none;
            font-size:14px;
            transition:0.3s ease;
            border:none;
            cursor:pointer;
        }

        .btn-detail{
            background:#38bdf8;
            color:#0f172a;
            font-weight:600;
            margin-right:5px;
        }

        .btn-detail:hover{
            background:#0ea5e9;
            transform: translateY(-2px);
        }

        .btn-hapus{
            background:#f87171;
            color:#fff;
        }

        .btn-hapus:hover{
            background:#ef4444;
            transform: translateY(-2px);
        }

        /* TABLE WRAPPER */
        .table-container{
            overflow-x:auto;
            margin-top:15px;
        }

        /* TABLE BASE */
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

        tr{
            transition: background-color 0.15s ease;
        }

        table tbody tr:hover td{
            background: rgba(2, 6, 23, 0.95) !important;
            color:#e2e8f0 !important;
        }

        table tbody tr:hover{
            box-shadow:none;
        }

        /* BADGE STATUS CUSTOM */
        .badge-pending {
            background: rgba(245, 158, 11, 0.15);
            color: #facc15;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: bold;
            border: 1px solid rgba(245, 158, 11, 0.3);
            display: inline-block;
        }

        .badge-verified {
            background: rgba(34, 197, 94, 0.15);
            color: #4ade80;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: bold;
            border: 1px solid rgba(34, 197, 94, 0.3);
            display: inline-block;
        }
    </style>
</head>

<body>

<?php include '../template/menu_admin.php'; ?>

<div class="container">

    <div class="card">

        <div class="page-title">
            <div>
                <h2>📋 Verifikasi Dokumen Guru</h2>
                <div class="subtitle">Daftar dokumen yang telah diupload oleh guru untuk proses verifikasi</div>
            </div>
        </div>

        <div class="table-container">

            <table>
                <tr>
                    <th width="50">No</th>
                    <th>Nama Guru</th>
                    <th>Dokumen yang Diupload</th>
                    <!-- Tambah Kolom Status -->
                    <th>Status</th>
                    <th width="150">Aksi</th>
                </tr>

                <?php
                $no = 1;
                if (mysqli_num_rows($query) > 0) {
                    while($d = mysqli_fetch_array($query)){
                ?>

                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($d['nama_guru']); ?></td>
                    <td><?= htmlspecialchars($d['daftar_dokumen']); ?></td>
                    <td>
                        <!-- Logika Penentuan Status -->
                        <?php if($d['pending_count'] > 0){ ?>
                            <span class="badge-pending">⏳ <?= $d['pending_count']; ?> Belum Diverifikasi</span>
                        <?php } else { ?>
                            <span class="badge-verified">✓ Semua Terverifikasi</span>
                        <?php } ?>
                    </td>
                    <td>
                        <a href="detail_guru.php?id=<?= $d['id_guru']; ?>" class="btn btn-detail">
                            Detail
                        </a>

                        <a href="hapus_dokumen_guru.php?id=<?= $d['id_guru']; ?>" class="btn btn-hapus" onclick="return confirm('Yakin ingin menghapus semua dokumen milik <?= addslashes($d['nama_guru']); ?>?')">
                            Hapus
                        </a>
                    </td>
                </tr>

                <?php } } else { ?>

                <tr>
                    <td colspan="5" style="text-align:center; padding:20px; color:#94a3b8;">
                        Belum ada dokumen yang diupload oleh guru.
                    </td>
                </tr>

                <?php } ?>

            </table>

        </div>

    </div>

</div>

</body>
</html>