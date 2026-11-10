<?php
session_start();

include '../config/koneksi.php';

if($_SESSION['role'] != "penilai"){
    header("Location: ../auth/login.php");
    exit;
}

$data = mysqli_query(
$koneksi,
"SELECT
guru.id_guru,
guru.nama_guru,
AVG(penilaian.nilai) AS rata_rata,
COALESCE(submit_penilai.status,'Draft') AS status_submit

FROM penilaian

JOIN guru
ON guru.id_guru = penilaian.id_guru

LEFT JOIN submit_penilai
ON submit_penilai.id_guru = guru.id_guru
AND submit_penilai.id_user='".$_SESSION['id_user']."'

WHERE penilaian.id_user='".$_SESSION['id_user']."'

GROUP BY guru.id_guru
ORDER BY guru.nama_guru ASC"
);
?>

<!DOCTYPE html>
<html>
<head>

<title>Hasil Penilaian Saya</title>

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
    margin:0 0 5px 0;
}

.subtitle{
    color:#94a3b8;
    font-size:14px;
    margin-bottom:15px;
}

/* TABLE WRAPPER */
.table-container{
    overflow-x:auto;
}

/* TABLE (SAMAKAN KE KEPSEK) */
table{
    width:100%;
    border-collapse:collapse;
    min-width:700px;
    background: rgba(15, 23, 42, 0.4);
    border-radius:10px;
    overflow:hidden;
}

/* HEADER */
th{
    padding:12px;
    text-align:left;
    background: rgba(56, 189, 248, 0.15);
    color:#cbd5e1;
}

/* CELL */
td{
    padding:12px;
    color:#e2e8f0;
    background: rgba(15, 23, 42, 0.2);
}

/* ================================
   HOVER DIMATIKAN TOTAL (SAMA KEPSEK)
================================ */
tr:hover td{
    background: rgba(2, 6, 23, 0.9) !important;
    color:#e2e8f0 !important;
}

/* BADGE */
.badge-success{
    background:#22c55e;
    color:#0f172a;
    padding:5px 10px;
    border-radius:6px;
    font-size:12px;
    font-weight:bold;
}

.badge-warning{
    background:#f59e0b;
    color:#0f172a;
    padding:5px 10px;
    border-radius:6px;
    font-size:12px;
    font-weight:bold;
}

/* BUTTON */
a{
    text-decoration:none;
    font-size:13px;
}

.btn-detail{
    background:#64748b;
    color:#fff;
    padding:6px 10px;
    border-radius:6px;
    margin-right:5px;
    display:inline-block;
}

.btn-edit{
    background:#fbbf24;
    color:#0f172a;
    padding:6px 10px;
    border-radius:6px;
    margin-right:5px;
    display:inline-block;
}

.btn-submit{
    background:#38bdf8;
    color:#0f172a;
    padding:6px 10px;
    border-radius:6px;
    display:inline-block;
}

/* BUTTON HOVER */
.btn-detail:hover,
.btn-edit:hover,
.btn-submit:hover{
    transform: translateY(-2px);
    opacity:0.9;
}

</style>

</head>

<body>

<?php include '../template/menu_penilai.php'; ?>

<div class="container">

<div class="card">

    <h2>📊 Hasil Penilaian Saya</h2>

    <p class="subtitle">
        Daftar hasil penilaian guru yang telah Anda lakukan.
    </p>

    <div class="table-container">

    <table>

        <tr>
            <th>No</th>
            <th>Nama Guru</th>
            <th>Rata-rata Nilai</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        while($row=mysqli_fetch_array($data)){
        ?>

        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nama_guru']; ?></td>
            <td><?= round($row['rata_rata'],2); ?></td>
            <td>

                <?php if($row['status_submit']=="Submitted"){ ?>
                    <span class="badge-success">✔ Submitted</span>
                <?php } else { ?>
                    <span class="badge-warning">📝 Draft</span>
                <?php } ?>

            </td>

            <td>

                <a href="detail_penilaian.php?id=<?= $row['id_guru']; ?>"
                   class="btn-detail">
                    📄 Detail
                </a>

                <?php if($row['status_submit']!="Submitted"){ ?>

                <a href="edit_penilaian.php?id=<?= $row['id_guru']; ?>"
                   class="btn-edit">
                    ✏ Edit
                </a>

                <a href="submit_penilaian.php?id=<?= $row['id_guru']; ?>"
                   class="btn-submit"
                   onclick="return confirm('Setelah submit tidak bisa diedit lagi. Lanjutkan?')">
                    ✔ Submit
                </a>

                <?php } ?>

            </td>
        </tr>

        <?php } ?>

    </table>

    </div>

</div>

</div>

</body>
</html>