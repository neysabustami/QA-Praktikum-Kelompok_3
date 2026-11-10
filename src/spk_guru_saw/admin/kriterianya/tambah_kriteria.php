<?php
session_start();

include '../../config/koneksi.php';

if(isset($_POST['simpan'])){

    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $bobot = $_POST['bobot'];

    mysqli_query($koneksi,
    "INSERT INTO kriteria (kode_kriteria,nama_kriteria,bobot)
     VALUES ('$kode','$nama','$bobot')"
    );

    header("Location:kriteria.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kriteria - SPK SAW</title>

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
            margin:0 0 5px 0;
            font-size:24px;
        }

        .subtitle{
            text-align:center;
            font-size:13px;
            color:#94a3b8;
            margin-bottom:20px;
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
            transition:0.2s ease;
        }

        /* FIX: jangan bikin “glow” berlebihan */
        input:focus{
            border-color:#38bdf8;
            box-shadow:none;
        }

        /* BUTTON */
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
    </style>
</head>

<body>

<?php include '../../template/menu_admin.php'; ?>

<div class="container">

    <div class="card">

        <h2>📊 Tambah Kriteria</h2>
        <div class="subtitle">Masukkan data kriteria penilaian SPK SAW</div>

        <form method="POST">

            <label>Kode Kriteria</label>
            <input type="text" name="kode" placeholder="Contoh: C1" required>

            <label>Nama Kriteria</label>
            <input type="text" name="nama" placeholder="Contoh: Kedisiplinan" required>

            <label>Bobot</label>
            <input type="number" step="0.01" name="bobot" placeholder="Contoh: 0.25" required>

            <button type="submit" name="simpan">
                Simpan Data
            </button>

        </form>

    </div>

</div>

</body>
</html>