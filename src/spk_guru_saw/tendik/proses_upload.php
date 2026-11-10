<?php
session_start();
include '../config/koneksi.php';
$id_g = $_SESSION['id_user'];
$jenis = $_POST['jenis_dokumen'];
$nama = time()."_".$_FILES['file_dokumen']['name'];
move_uploaded_file($_FILES['file_dokumen']['tmp_name'], "../uploads/".$nama);

mysqli_query($koneksi, "INSERT INTO dokumen (id_guru, jenis_dokumen, nama_file) VALUES ('$id_g', '$jenis', '$nama')");
header("Location: index.php");
?>