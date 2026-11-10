<?php
session_start();
include '../config/koneksi.php';

// Proteksi akses
if(!isset($_SESSION['role']) || $_SESSION['role'] != "guru"){
    header("Location: ../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Dokumen</title>
    <style>
        body { margin:0; font-family: 'Segoe UI', sans-serif; background: linear-gradient(135deg, #0f172a, #1e293b); color:#fff; padding:30px; display:flex; justify-content:center; }
        .card { width:100%; max-width:500px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.08); backdrop-filter: blur(10px); padding:25px; border-radius:15px; box-shadow: 0 10px 25px rgba(0,0,0,0.3); }
        h2 { color:#38bdf8; margin-top:0; margin-bottom: 20px; }
        label { display:block; margin:15px 0 5px; color:#cbd5e1; font-size:14px; }
        select, input { width:100%; padding:10px; border-radius:8px; border:1px solid rgba(255,255,255,0.1); background: rgba(15, 23, 42, 0.7); color:#fff; outline:none; box-sizing:border-box; }
        button { width:100%; margin-top:20px; padding:10px; border:none; border-radius:8px; background:#38bdf8; color:#0f172a; font-weight:bold; cursor:pointer; transition:0.3s; }
        button:hover { background:#0ea5e9; transform: translateY(-2px); }
        .btn-kembali { display:block; text-align:center; margin-top:10px; color:#94a3b8; text-decoration:none; font-size:13px; }
        .btn-kembali:hover { color:#fff; }
    </style>
</head>
<body>

<div class="card">
    <h2>📂 Upload Dokumen</h2>
    <form action="proses_upload.php" method="POST" enctype="multipart/form-data">
        <label>Jenis Dokumen</label>
        <select name="jenis_dokumen" required>
            <option value="Modul Ajar">Modul Ajar</option>
            <option value="Artikel">Artikel</option>
            <option value="Sertifikat">Sertifikat</option>
            <option value="Piagam Penghargaan">Piagam Penghargaan</option>
        </select>

        <label>Pilih File (PDF/JPG/PNG)</label>
        <input type="file" name="file_dokumen" required>

        <button type="submit">Upload Dokumen</button>
    </form>
    <a href="index.php" class="btn-kembali">Kembali ke Dashboard</a>
</div>

</body>
</html>