<?php
session_start();
include '../config/koneksi.php';

// Pastikan hanya guru yang akses
if(!isset($_SESSION['role']) || $_SESSION['role'] != "guru"){ exit; }

$id = $_GET['id'];
$id_g = $_SESSION['id_user'];

// Ambil nama file sebelum dihapus agar kita bisa hapus fisik filenya
$query = mysqli_query($koneksi, "SELECT * FROM dokumen WHERE id_dokumen='$id' AND id_guru='$id_g'");
$d = mysqli_fetch_array($query);

if($d) {
    // 1. Hapus file fisik dari folder uploads
    $file_path = "../uploads/" . $d['nama_file'];
    if(file_exists($file_path)){
        unlink($file_path);
    }
    
    // 2. Hapus data dari database
    mysqli_query($koneksi, "DELETE FROM dokumen WHERE id_dokumen='$id'");
    
    $_SESSION['pesan'] = "Dokumen berhasil dihapus.";
}

header("Location: index.php");
?>