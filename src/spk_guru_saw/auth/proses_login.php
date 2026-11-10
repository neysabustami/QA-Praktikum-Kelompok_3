<?php
session_start();
include '../config/koneksi.php';

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = mysqli_real_escape_string($koneksi, $_POST['password']);

$query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
$data = mysqli_fetch_array($query);

if($data){
    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['nama']    = $data['nama'];
    $_SESSION['role']    = $data['role'];

    // Pengalihan berdasarkan role
    if($data['role'] == "admin"){
        header("Location: ../admin/dashboard.php");
    } elseif($data['role'] == "penilai"){
        header("Location: ../penilai/dashboard.php");
    } elseif($data['role'] == "kepsek"){
        header("Location: ../kepsek/dashboard.php");
    } elseif($data['role'] == "guru"){
        header("Location: ../tendik/index.php"); // Arahkan ke dashboard guru
    } else {
        // Role tidak dikenali
        echo "<script>alert('Role tidak dikenali!'); window.location='login.php';</script>";
    }
} else {
    echo "
    <script>
    alert('Login gagal');
    window.location='login.php';
    </script>
    ";
}
?>