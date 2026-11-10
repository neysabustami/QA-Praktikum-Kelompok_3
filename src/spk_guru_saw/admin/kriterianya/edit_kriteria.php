<?php
session_start();

include '../../config/koneksi.php';

$id = $_GET['id'];

$data = mysqli_query($koneksi,
"SELECT * FROM kriteria
WHERE id_kriteria='$id'"
);

$row = mysqli_fetch_array($data);

if(isset($_POST['update'])){

    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $bobot = $_POST['bobot'];

    mysqli_query($koneksi,
    "UPDATE kriteria SET
    kode_kriteria='$kode',
    nama_kriteria='$nama',
    bobot='$bobot'
    WHERE id_kriteria='$id'"
    );

    header("Location:kriteria.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Kriteria</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <style>
        body{
            margin:0;
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: linear-gradient(135deg, #0f172a, #1e293b);
            color:#fff;
        }
        .container{
            padding:30px;
            display:flex;
            justify-content:center;
        }
        .card{
            width:100%;
            max-width:520px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.08);
            backdrop-filter: blur(10px);
            padding:25px;
            border-radius:15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }
        h2{
            text-align:center;
            margin:0 0 20px 0;
            font-size:24px;
            color:#38bdf8;
        }
        label{
            display:block;
            margin:10px 0 5px;
            font-size:14px;
            color:#cbd5e1;
        }
        input{
            width:100%;
            padding:10px 12px;
            border-radius:8px;
            border:1px solid rgba(255,255,255,0.1);
            background: rgba(15, 23, 42, 0.7);
            color:#fff;
            outline:none;
            box-sizing:border-box;
        }
        button{
            width:100%;
            margin-top:20px;
            padding:10px;
            border:none;
            border-radius:8px;
            background:#38bdf8;
            color:#0f172a;
            font-weight:bold;
            cursor:pointer;
            transition:0.3s ease;
        }
        button:hover{
            background:#0ea5e9;
            transform: translateY(-2px);
        }
        .btn-kembali{
            display:block;
            width:100%;
            margin-top:10px;
            padding:10px;
            border:1px solid rgba(255,255,255,0.1);
            border-radius:8px;
            background:transparent;
            color:#cbd5e1;
            font-weight:bold;
            text-align:center;
            text-decoration:none;
            transition:0.3s ease;
            box-sizing:border-box;
        }
        .btn-kembali:hover{
            background: rgba(255,255,255,0.05);
            color:#fff;
        }
    </style>
</head>

<body>

<?php include '../../template/menu_admin.php'; ?>

<div class="container">
    <div class="card">
        <h2>Edit Kriteria</h2>
        <form method="POST">
            <label>Kode Kriteria</label>
            <input type="text" name="kode" value="<?= $row['kode_kriteria']; ?>" required>

            <label>Nama Kriteria</label>
            <input type="text" name="nama" value="<?= $row['nama_kriteria']; ?>" required>

            <label>Bobot</label>
            <input type="number" step="0.01" name="bobot" value="<?= $row['bobot']; ?>" required>

            <button type="submit" name="update">Update</button>
            <a href="kriteria.php" class="btn-kembali">Kembali</a>
        </form>
    </div>
</div>

</body>
</html>