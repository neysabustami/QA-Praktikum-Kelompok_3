<?php
session_start();
include '../config/koneksi.php';

$jml_guru = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM guru"));
$jml_kriteria = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kriteria"));
$jml_user = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM users"));
$jml_penilaian = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM penilaian"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>

    <link rel="stylesheet" href="../assets/css/style.css">

    <style>
        body{
            margin:0;
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: linear-gradient(135deg, #0f172a, #1e293b);
            color:#fff;
        }

        .container{
            padding:30px;
        }

        h2{
            margin-bottom:25px;
            font-size:28px;
            font-weight:600;
            letter-spacing:0.5px;
        }

        .dashboard-grid{
            display:grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap:20px;
        }

        .dashboard-card{
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            padding:25px;
            border-radius:15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
            position:relative;
            overflow:hidden;
        }

        .dashboard-card:hover{
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.5);
            border-color: rgba(255,255,255,0.3);
        }

        .dashboard-card h3{
            margin:0;
            font-size:16px;
            font-weight:500;
            color:#cbd5e1;
        }

        .dashboard-card p{
            margin-top:10px;
            font-size:32px;
            font-weight:bold;
            color:#ffffff;
        }

        /* warna aksen tiap card */
        .dashboard-card:nth-child(1){
            border-left:5px solid #38bdf8;
        }

        .dashboard-card:nth-child(2){
            border-left:5px solid #34d399;
        }

        .dashboard-card:nth-child(3){
            border-left:5px solid #fbbf24;
        }

        .dashboard-card:nth-child(4){
            border-left:5px solid #f87171;
        }

        /* header menu kalau ada */
        nav{
            background:#0b1220;
            padding:15px 30px;
            border-bottom:1px solid rgba(255,255,255,0.1);
        }
    </style>
</head>

<body>

<?php include '../template/menu_admin.php'; ?>

<div class="container">
    <h2>📊 Dashboard Admin SPK SAW</h2>

    <div class="dashboard-grid">

        <div class="dashboard-card">
            <h3>Total Guru</h3>
            <p><?= $jml_guru; ?></p>
        </div>

        <div class="dashboard-card">
            <h3>Total Kriteria</h3>
            <p><?= $jml_kriteria; ?></p>
        </div>

        <div class="dashboard-card">
            <h3>Total User</h3>
            <p><?= $jml_user; ?></p>
        </div>

        <div class="dashboard-card">
            <h3>Total Penilaian</h3>
            <p><?= $jml_penilaian; ?></p>
        </div>

    </div>
</div>

</body>
</html>