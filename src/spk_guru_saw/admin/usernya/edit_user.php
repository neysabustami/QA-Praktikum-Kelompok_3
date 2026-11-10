<?php
session_start();
include '../../config/koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM users WHERE id_user='$id'");
$row = mysqli_fetch_array($data);

if(isset($_POST['update'])){
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    mysqli_query($koneksi, "UPDATE users SET 
        nama='$nama', 
        username='$username', 
        password='$password', 
        role='$role' 
        WHERE id_user='$id'");

    header("Location:user.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <style>
        /* Mengikuti gaya template Anda */
        body{ margin:0; font-family: 'Segoe UI', Tahoma, sans-serif; background: linear-gradient(135deg, #0f172a, #1e293b); color:#fff; }
        .container{ padding:30px; display:flex; justify-content:center; }
        .card{ width:100%; max-width:520px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.08); backdrop-filter: blur(10px); padding:25px; border-radius:15px; box-shadow: 0 10px 25px rgba(0,0,0,0.3); }
        h2{ text-align:center; margin-bottom:20px; color:#38bdf8; }
        label{ display:block; margin:10px 0 5px; font-size:14px; color:#cbd5e1; }
        input, select{ width:100%; padding:10px 12px; border-radius:8px; border:1px solid rgba(255,255,255,0.1); background: rgba(15, 23, 42, 0.7); color:#fff; outline:none; }
        button{ width:100%; margin-top:20px; padding:10px; border:none; border-radius:8px; background:#38bdf8; color:#0f172a; font-weight:bold; cursor:pointer; }
        .btn-kembali{ width:100%; margin-top:10px; padding:10px; border:1px solid #64748b; border-radius:8px; background:transparent; color:#cbd5e1; text-align:center; text-decoration:none; display:block; font-weight:bold; }
        .btn-kembali:hover{ background: rgba(255,255,255,0.05); }
    </style>
</head>
<body>

<?php include '../../template/menu_admin.php'; ?>

<div class="container">
    <div class="card">
        <h2>Edit User</h2>
        <form method="POST">
            <label>Nama</label>
            <input type="text" name="nama" value="<?= $row['nama']; ?>" required>

            <label>Username</label>
            <input type="text" name="username" value="<?= $row['username']; ?>" required>

            <label>Password</label>
            <input type="text" name="password" value="<?= $row['password']; ?>" required>

            <label>Role</label>
            <select name="role" required>
                <option value="admin" <?= $row['role']=="admin" ? "selected" : ""; ?>>Admin</option>
                <option value="penilai" <?= $row['role']=="penilai" ? "selected" : ""; ?>>Penilai</option>
                <option value="kepsek" <?= $row['role']=="kepsek" ? "selected" : ""; ?>>Kepala Sekolah</option>
                <option value="guru" <?= $row['role']=="guru" ? "selected" : ""; ?>>Guru</option>
            </select>

            <button type="submit" name="update">Update</button>
            <a href="user.php" class="btn-kembali">Kembali</a>
        </form>
    </div>
</div>

</body>
</html>