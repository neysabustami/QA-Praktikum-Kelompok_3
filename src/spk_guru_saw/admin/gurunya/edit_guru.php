<?php

session_start();

include '../../config/koneksi.php';

if($_SESSION['role'] != "admin"){

    header("Location: ../../auth/login.php");
    exit;

}

$id = $_GET['id'];

$data = mysqli_query(
    $koneksi,
    "SELECT *
    FROM guru
    WHERE id_guru='$id'"
);

$row = mysqli_fetch_array($data);

if(isset($_POST['update'])){

    $nip = mysqli_real_escape_string(
        $koneksi,
        $_POST['nip']
    );

    $nama = mysqli_real_escape_string(
        $koneksi,
        $_POST['nama_guru']
    );

    $mapel = mysqli_real_escape_string(
        $koneksi,
        $_POST['mapel']
    );

    /*
    UPDATE GURU
    */

    try{

    $sql = "
    UPDATE guru
    SET
        nip='$nip',
        nama_guru='$nama',
        mapel='$mapel'
    WHERE id_guru='$id'
    ";

    mysqli_query($koneksi,$sql);

    echo "UPDATE BERHASIL";
    exit;

}catch(Exception $e){

    die($e->getMessage());

}

    /*
    RESET PENGESAHAN
    */

    mysqli_query(
        $koneksi,
        "UPDATE pengesahan
        SET
        status='Belum Disahkan',
        tanggal=NULL"
    );

    echo "
    <script>
        alert('Data guru berhasil diperbarui');
        window.location='guru.php';
    </script>
    ";

    exit;
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Guru - SPK SAW</title>

<link rel="stylesheet"
href="../../assets/css/style.css">

<style>

body{
    margin:0;
    font-family:'Segoe UI',Tahoma,sans-serif;
    background:linear-gradient(
        135deg,
        #0f172a,
        #1e293b
    );
    color:#fff;
}

.container{
    padding:30px;
    display:flex;
    justify-content:center;
}

.card{
    width:100%;
    max-width:550px;
    background:rgba(255,255,255,0.06);
    border:1px solid rgba(255,255,255,0.08);
    backdrop-filter:blur(10px);
    padding:30px;
    border-radius:15px;
    box-shadow:
    0 10px 25px rgba(0,0,0,0.3);
}

h2{
    text-align:center;
    margin:0;
    margin-bottom:10px;
}

.subtitle{
    text-align:center;
    color:#94a3b8;
    margin-bottom:25px;
    font-size:14px;
}

label{
    display:block;
    margin-top:15px;
    margin-bottom:6px;
    color:#cbd5e1;
}

input{
    width:100%;
    padding:12px;
    border-radius:8px;
    border:1px solid rgba(255,255,255,0.1);
    background:rgba(15,23,42,0.7);
    color:white;
    box-sizing:border-box;
}

input:focus{
    outline:none;
    border-color:#38bdf8;
}

.btn-group{
    display:flex;
    gap:10px;
    margin-top:25px;
}

.btn-back{
    flex:1;
    padding:12px;
    border-radius:8px;
    background:#ef4444;
    color:white;
    text-decoration:none;
    text-align:center;
    font-weight:bold;
    transition:0.3s;
}

.btn-back:hover{
    background:#dc2626;
    transform:translateY(-2px);
}

.btn-update{
    flex:1;
    padding:12px;
    border:none;
    border-radius:8px;
    background:#38bdf8;
    color:#0f172a;
    font-weight:bold;
    cursor:pointer;
    transition:0.3s;
}

.btn-update:hover{
    background:#0ea5e9;
    transform:translateY(-2px);
}

</style>

</head>

<body>

<?php include '../../template/menu_admin.php'; ?>

<div class="container">

<div class="card">

<h2>✏️ Edit Data Guru</h2>

<div class="subtitle">
Perbarui data guru dengan benar
</div>

<form method="POST">

<label>NIP</label>

<input
type="text"
name="nip"
value="<?= $row['nip']; ?>"
required>

<label>Nama Guru</label>

<input
type="text"
name="nama_guru"
value="<?= $row['nama_guru']; ?>"
required>

<label>Mata Pelajaran</label>

<input
type="text"
name="mapel"
value="<?= $row['mapel']; ?>"
required>

<div class="btn-group">

<a
href="guru.php"
class="btn-back">

← Kembali

</a>

<button
type="submit"
name="update"
class="btn-update">

💾 Update Data

</button>

</div>

</form>

</div>

</div>

</body>

</html>