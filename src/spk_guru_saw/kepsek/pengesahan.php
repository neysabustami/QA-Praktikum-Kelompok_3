<?php
session_start();

include '../config/koneksi.php';

if($_SESSION['role'] != "kepsek"){
    header("Location: ../auth/login.php");
    exit;
}

/* PENILAI */
$q_penilai = mysqli_query($koneksi,
"SELECT COUNT(*) AS total FROM users WHERE role='penilai'");
$d_penilai = mysqli_fetch_assoc($q_penilai);
$total_penilai = $d_penilai['total'];

/* SUBMIT PENILAI */
$q_submit_penilai = mysqli_query($koneksi,
"SELECT COUNT(DISTINCT id_user) AS total
FROM submit_penilai
WHERE status='Submitted'");
$d_submit_penilai = mysqli_fetch_assoc($q_submit_penilai);
$total_submit_penilai = $d_submit_penilai['total'];

/* SUBMIT KEPSEK */
$q_submit_kepsek = mysqli_query($koneksi,
"SELECT COUNT(*) AS total
FROM submit_kepsek
WHERE status='Submitted'");
$d_submit_kepsek = mysqli_fetch_assoc($q_submit_kepsek);
$total_submit_kepsek = $d_submit_kepsek['total'];

/* BOLEH SAHKAN */
$boleh_sahkan = ($total_penilai == $total_submit_penilai && $total_submit_kepsek > 0);

/* PENGESAHAN */
$cek = mysqli_query($koneksi,"SELECT * FROM pengesahan LIMIT 1");

if(mysqli_num_rows($cek)==0){
    mysqli_query($koneksi,
    "INSERT INTO pengesahan(status) VALUES('Belum Disahkan')");
}

$data = mysqli_query($koneksi,"SELECT * FROM pengesahan LIMIT 1");
$row = mysqli_fetch_assoc($data);

/* LIST PENILAI */
$daftar_penilai = [];

$q_list_penilai = mysqli_query($koneksi,
"SELECT * FROM users WHERE role='penilai' ORDER BY nama ASC");

while($p = mysqli_fetch_assoc($q_list_penilai)){
    $daftar_penilai[] = $p;
}

/* PROSES SAHKAN */
if(isset($_POST['sahkan']) && $boleh_sahkan){

    $tanggal = date('Y-m-d H:i:s');

    mysqli_query($koneksi,
    "UPDATE pengesahan
     SET status='Sudah Disahkan',
     tanggal='$tanggal',
     id_kepsek='".$_SESSION['id_user']."'
     WHERE id_pengesahan='".$row['id_pengesahan']."'");

    echo "<script>
        alert('Hasil berhasil disahkan');
        window.location='pengesahan.php';
    </script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Pengesahan Hasil</title>

<link rel="stylesheet" href="../assets/css/style.css">

<style>

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
}

h2{
    margin:0 0 10px 0;
}

.subtitle{
    color:#94a3b8;
    font-size:14px;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    background: rgba(15, 23, 42, 0.4);
    border-radius:10px;
    overflow:hidden;
}

th{
    padding:12px;
    background: rgba(56, 189, 248, 0.15);
    color:#cbd5e1;
}

td{
    padding:12px;
    color:#e2e8f0;
    background: rgba(15, 23, 42, 0.2);
}

/* HAPUS HOVER EFFECT */
tr:hover td{
    background: rgba(2, 6, 23, 0.9) !important;
}

/* STATUS */
.status-yes{
    color:#22c55e;
    font-weight:bold;
}

.status-no{
    color:#ef4444;
    font-weight:bold;
}

/* BOX */
.info-box,
.success-box,
.warning-box{
    padding:15px;
    border-radius:10px;
    margin-top:10px;
}

.info-box{
    background: rgba(59,130,246,0.15);
    border:1px solid rgba(59,130,246,0.3);
}

.success-box{
    background: rgba(34,197,94,0.15);
    border:1px solid rgba(34,197,94,0.3);
}

.warning-box{
    background: rgba(245,158,11,0.15);
    border:1px solid rgba(245,158,11,0.3);
}

/* BUTTON */
.btn-simpan{
    padding:10px 15px;
    border:none;
    border-radius:8px;
    background:#38bdf8;
    color:#0f172a;
    font-weight:bold;
    cursor:pointer;
    transition:0.25s;
}

.btn-simpan:hover{
    background:#0ea5e9;
    transform: translateY(-2px);
}

</style>

</head>

<body>

<?php include '../template/menu_kepsek.php'; ?>

<div class="container">

<div class="card">

<h2>📌 Pengesahan Hasil Guru Berprestasi</h2>

<p class="subtitle">
Pengesahan dilakukan setelah seluruh penilai dan kepala sekolah menyelesaikan submit.
</p>

<br>

<table>

<tr>
<td>Status</td>
<td><?= $row['status']; ?></td>
</tr>

<tr>
<td>Penilai</td>
<td><?= $total_penilai; ?></td>
</tr>

<tr>
<td>Sudah Submit Penilai</td>
<td><?= $total_submit_penilai; ?></td>
</tr>

<tr>
<td>Submit Kepsek</td>
<td><?= $total_submit_kepsek; ?></td>
</tr>

</table>

<br>

<h3>Monitoring Submit</h3>

<table>

<tr>
<th>No</th>
<th>Guru</th>

<?php foreach($daftar_penilai as $p){ ?>
<th><?= $p['nama']; ?></th>
<?php } ?>

<th>Kepsek</th>
<th>Status</th>
</tr>

<?php
$no=1;
$q_guru = mysqli_query($koneksi,"SELECT * FROM guru ORDER BY nama_guru ASC");

while($guru = mysqli_fetch_assoc($q_guru)){

$lengkap = true;
?>

<tr>

<td><?= $no++; ?></td>
<td><?= $guru['nama_guru']; ?></td>

<?php foreach($daftar_penilai as $p){

$cek_submit = mysqli_query($koneksi,
"SELECT * FROM submit_penilai
WHERE id_user='".$p['id_user']."'
AND id_guru='".$guru['id_guru']."'
AND status='Submitted'");

if(mysqli_num_rows($cek_submit)>0){
    echo "<td class='status-yes'>✔</td>";
}else{
    echo "<td class='status-no'>✖</td>";
    $lengkap = false;
}

} ?>

<?php
$cek_kepsek = mysqli_query($koneksi,
"SELECT * FROM submit_kepsek
WHERE id_guru='".$guru['id_guru']."'
AND status='Submitted'");

if(mysqli_num_rows($cek_kepsek)>0){
    echo "<td class='status-yes'>✔</td>";
}else{
    echo "<td class='status-no'>✖</td>";
    $lengkap = false;
}
?>

<td>
<?php if($lengkap){ ?>
<span class="status-yes">✔ Lengkap</span>
<?php }else{ ?>
<span class="status-no">⚠ Belum</span>
<?php } ?>
</td>

</tr>

<?php } ?>

</table>

<br>

<?php
$total_guru = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM guru"));
?>

<div class="info-box">
<b>Total Guru:</b> <?= $total_guru; ?><br>
<b>Total Penilai:</b> <?= $total_penilai; ?>
</div>

<br>

<?php if($row['status']=="Belum Disahkan"){ ?>

    <?php if($boleh_sahkan){ ?>

        <div class="success-box">
        ✔ Semua data lengkap, siap disahkan
        </div>

        <br>

        <form method="POST">
            <button type="submit" name="sahkan" class="btn-simpan">
                ✔ Sahkan Hasil
            </button>
        </form>

    <?php }else{ ?>

        <div class="warning-box">
        ⚠ Belum bisa disahkan. Data belum lengkap.
        </div>

    <?php } ?>

<?php }else{ ?>

<div class="success-box">
✔ Hasil sudah disahkan
</div>

<?php } ?>

</div>

</div>

</body>
</html>