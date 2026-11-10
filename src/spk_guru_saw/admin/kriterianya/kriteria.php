<?php
session_start();

include '../../config/koneksi.php';

if($_SESSION['role'] != "admin"){
    header("Location: ../../auth/login.php");
}

$data = mysqli_query($koneksi, "SELECT * FROM kriteria");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Kriteria - SPK SAW</title>

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
        }

        .card{
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.08);
            backdrop-filter: blur(10px);
            padding:25px;
            border-radius:15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }

        /* HEADER AREA */
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

        .btn-tambah{
            background:#38bdf8;
            color:#0f172a;
            font-weight:600;
        }

        .btn-tambah:hover{
            background:#0ea5e9;
            transform: translateY(-2px);
        }

        .btn-edit{
            background:#fbbf24;
            color:#0f172a;
            margin-right:5px;
        }

        .btn-edit:hover{
            background:#f59e0b;
        }

        .btn-hapus{
            background:#f87171;
            color:#fff;
        }

        .btn-hapus:hover{
            background:#ef4444;
        }

        /* TABLE */
        .table-container{
    overflow-x:auto;
    margin-top:15px;
}

/* TABLE BASE */
table{
    width:100%;
    border-collapse:collapse;
    min-width:600px;
    background: rgba(15, 23, 42, 0.4); /* penting: kasih base background */
    border-radius:10px;
    overflow:hidden;
}

/* HEADER */
th{
    padding:12px 15px;
    text-align:left;
    background: rgba(56, 189, 248, 0.15);
    color:#cbd5e1;
    font-weight:600;
    border-bottom:1px solid rgba(255,255,255,0.1);
}

/* CELL */
td{
    padding:12px 15px;
    text-align:left;
    color:#e2e8f0;
    border-bottom:1px solid rgba(255,255,255,0.05);
    background: rgba(15, 23, 42, 0.2); /* FIX utama: jangan transparan total */
}

/* ROW NORMAL */
tr{
    transition: background-color 0.15s ease;
}

/* HOVER: hanya gelapkan BARIS */
table tbody tr:hover td{
    background: rgba(2, 6, 23, 0.95) !important; /* gelap solid */
    color:#e2e8f0 !important; /* kunci warna */
}

/* jangan ada efek glow sama sekali */
table tbody tr:hover{
    box-shadow:none;
}
    </style>
</head>

<body>

<?php include '../../template/menu_admin.php'; ?>

<div class="container">

    <div class="card">

        <div class="page-title">
            <div>
                <h2>📊 Data Kriteria</h2>
                <div class="subtitle">Pengaturan bobot dan parameter penilaian SPK SAW</div>
            </div>

            <a href="tambah_kriteria.php" class="btn btn-tambah">
                + Tambah Kriteria
            </a>
        </div>

        <div class="table-container">

            <table>

                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Kriteria</th>
                    <th>Bobot</th>
                    <th>Aksi</th>
                </tr>

                <?php
                $no = 1;
                while($row = mysqli_fetch_array($data)){
                ?>

                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['kode_kriteria']; ?></td>
                    <td><?= $row['nama_kriteria']; ?></td>
                    <td><?= $row['bobot']; ?></td>
                    <td>
                        <a href="edit_kriteria.php?id=<?= $row['id_kriteria']; ?>"
                           class="btn btn-edit">
                            Edit
                        </a>

                        <a href="hapus_kriteria.php?id=<?= $row['id_kriteria']; ?>"
                           class="btn btn-hapus"
                           onclick="return confirm('Yakin ingin menghapus data kriteria ini?')">
                            Hapus
                        </a>
                    </td>
                </tr>

                <?php } ?>

            </table>

        </div>

    </div>

</div>

</body>
</html>