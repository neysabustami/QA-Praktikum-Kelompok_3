<?php
session_start();
include '../../config/koneksi.php';

if($_SESSION['role'] != "admin"){
    header("Location: ../../auth/login.php");
    exit;
}

if(isset($_POST['simpan'])){
    $id_user = mysqli_real_escape_string($koneksi, $_POST['id_user']);
    $nip = mysqli_real_escape_string($koneksi, $_POST['nip']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_guru']);
    $mapel = mysqli_real_escape_string($koneksi, $_POST['mapel']);

    // SIMPAN GURU dengan id_user yang dipilih
    mysqli_query($koneksi,
        "INSERT INTO guru (id_user, nip, nama_guru, mapel) 
         VALUES ('$id_user', '$nip', '$nama', '$mapel')"
    );

    // RESET PENGESAHAN
    mysqli_query($koneksi, "UPDATE pengesahan SET status='Belum Disahkan', tanggal=NULL");

    echo "<script>alert('Data guru berhasil ditambahkan'); window.location='guru.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Guru - SPK SAW</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <style>
        body{ margin:0; font-family:'Segoe UI',Tahoma,sans-serif; background:linear-gradient(135deg, #0f172a, #1e293b); color:#fff; }
        .container{ padding:30px; display:flex; justify-content:center; }
        .card{ width:100%; max-width:550px; background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.08); backdrop-filter:blur(10px); padding:30px; border-radius:15px; box-shadow: 0 10px 25px rgba(0,0,0,0.3); }
        h2{ margin:0; text-align:center; margin-bottom:10px; }
        .subtitle{ text-align:center; color:#94a3b8; margin-bottom:25px; font-size:14px; }
        label{ display:block; margin-bottom:6px; margin-top:15px; color:#cbd5e1; }
        input, select{ width:100%; padding:12px; border-radius:8px; border:1px solid rgba(255,255,255,0.1); background:rgba(15,23,42,0.7); color:white; box-sizing:border-box; }
        button{ width:100%; margin-top:25px; padding:12px; border:none; border-radius:8px; background:#38bdf8; color:#0f172a; font-weight:bold; cursor:pointer; }
        button:hover{ background:#0ea5e9; transform:translateY(-2px); }
    </style>
</head>
<body>

<?php include '../../template/menu_admin.php'; ?>

<div class="container">
    <div class="card">
        <h2>➕ Tambah Data Guru</h2>
        <div class="subtitle">Masukkan data guru dan pilih akun user-nya</div>

        <form method="POST">
            <label>Pilih Akun Login (User Role Guru)</label>
            <select name="id_user" required>
                <option value="">-- Pilih User --</option>
                <?php
                $users = mysqli_query($koneksi, "SELECT * FROM users WHERE role='guru'");
                while($u = mysqli_fetch_array($users)){
                    echo "<option value='".$u['id_user']."'>".$u['nama']." (".$u['username'].")</option>";
                }
                ?>
            </select>

            <label>NIP</label>
            <input type="text" name="nip" placeholder="Masukkan NIP Guru" required>

            <label>Nama Guru</label>
            <input type="text" name="nama_guru" placeholder="Masukkan Nama Guru" required>

            <label>Mata Pelajaran</label>
            <input type="text" name="mapel" placeholder="Contoh: Matematika" required>

            <button type="submit" name="simpan">💾 Simpan Data Guru</button>
        </form>
    </div>
</div>

</body>
</html>