<?php
session_start();

include '../../config/koneksi.php';

if($_SESSION['role'] != "admin"){
    header("Location: ../auth/login.php");
}

$data = mysqli_query($koneksi, "SELECT * FROM guru");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Guru - SPK SAW</title>

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

        h2{
            margin:0 0 15px 0;
            font-size:26px;
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

        table{
            width:100%;
            border-collapse:collapse;
            min-width:600px;
        }

        th, td{
            padding:12px 15px;
            text-align:left;
        }

        th{
            background: rgba(56, 189, 248, 0.15);
            color:#cbd5e1;
            font-weight:600;
            border-bottom:1px solid rgba(255,255,255,0.1);
        }

        td{
            border-bottom:1px solid rgba(255,255,255,0.05);
            color:#e2e8f0;
        }

        /* biar hover stabil */
table tbody tr{
    transition: background-color 0.2s ease;
}

/* hover hanya gelapkan BARIS, bukan bikin glow */
table tbody tr:hover{
    background-color: rgba(15, 23, 42, 0.95); /* gelap solid */
}

/* teks TIDAK berubah jadi putih (ini biang masalah sebelumnya) */
table tbody tr:hover td{
    color: #e2e8f0; /* tetap soft, tidak silau */
}

        /* TITLE AREA */
        .page-title{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:15px;
        }

        .subtitle{
            font-size:14px;
            color:#94a3b8;
            margin-top:5px;
        }
    </style>
</head>

<body>

<?php include '../../template/menu_admin.php'; ?>

<div class="container">

    <div class="card">

        <div class="page-title">
            <div>
                <h2>📚 Data Guru</h2>
                <div class="subtitle">Kelola data guru pada sistem SPK Guru Berprestasi</div>
            </div>

            <a href="tambah_guru.php" class="btn btn-tambah">
                + Tambah Guru
            </a>
        </div>

        <div class="table-container">

            <table>

                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama Guru</th>
                    <th>Mata Pelajaran</th>
                    <th>Aksi</th>
                </tr>

                <?php
                $no = 1;
                while($row = mysqli_fetch_array($data)){
                ?>

                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['nip']; ?></td>
                    <td><?= $row['nama_guru']; ?></td>
                    <td><?= $row['mapel']; ?></td>
                    <td>
                        <a href="edit_guru.php?id=<?= $row['id_guru']; ?>"
                           class="btn btn-edit">
                            Edit
                        </a>

                        <a href="hapus_guru.php?id=<?= $row['id_guru']; ?>"
                           class="btn btn-hapus"
                           onclick="return confirm('Yakin ingin menghapus data guru ini?')">
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