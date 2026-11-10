<?php
session_start();
include '../config/koneksi.php';

if($_SESSION['role'] != "admin"){ exit; }

$id_dok = $_GET['id'];
$id_user = $_GET['id_user']; // ID untuk kembali ke halaman detail

// Update status dokumen menjadi Diverifikasi
mysqli_query($koneksi, "UPDATE dokumen SET status = 'Diverifikasi' WHERE id_dokumen = '$id_dok'");

// Redirect kembali ke detail guru
header("Location: detail_guru.php?id=$id_user");
?>