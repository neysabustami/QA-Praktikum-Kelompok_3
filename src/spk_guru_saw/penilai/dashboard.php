<?php
session_start();

if($_SESSION['role'] != "penilai"){
    header("Location: ../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Dashboard Penilai</title>

<link rel="stylesheet"
href="../assets/css/style.css">

<style>
body{
    margin:0;
    font-family: 'Segoe UI', Tahoma, sans-serif;
    background: linear-gradient(135deg, #0f172a, #1e293b);
    color:#e2e8f0;
}

/* CONTAINER */
.container{
    padding:30px;
}

/* CARD UTAMA */
.card{
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.08);
    backdrop-filter: blur(10px);
    padding:25px;
    border-radius:15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
}

/* TITLE */
h2{
    margin:0 0 10px 0;
    font-size:26px;
    color:#f1f5f9;
}

/* GRID DASHBOARD */
.dashboard-grid{
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap:15px;
    margin-top:20px;
}

/* CARD MENU */
.dashboard-card{
    background: rgba(15, 23, 42, 0.6);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius:12px;
    padding:20px;
    transition:0.25s ease;
}

/* HOVER TIDAK MENYILAUKAN */
.dashboard-card:hover{
    background: rgba(2, 6, 23, 0.9);
    transform: translateY(-3px);
    border: 1px solid rgba(56, 189, 248, 0.25);
}

/* TEXT */
.dashboard-card h3{
    margin:0 0 8px 0;
    color:#38bdf8;
}

.dashboard-card p{
    margin:0;
    color:#cbd5e1;
    font-size:14px;
}

/* USER NAME */
b{
    color:#38bdf8;
}
</style>

</head>

<body>

<?php include '../template/menu_penilai.php'; ?>

<div class="container">

<div class="card">

<h2>Dashboard Penilai</h2>

<p>
Selamat datang,
<b>
<?php echo $_SESSION['nama']; ?>
</b>
</p>

<div class="dashboard-grid">

<div class="dashboard-card">
<h3>📊 Input Penilaian</h3>
<p>Memberikan penilaian kepada guru.</p>
</div>

<div class="dashboard-card">
<h3>📈 Hasil Ranking</h3>
<p>Melihat hasil ranking guru berprestasi.</p>
</div>

</div>

</div>

</div>

</body>

</html>