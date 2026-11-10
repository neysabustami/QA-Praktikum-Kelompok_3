<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_spk_final"; // Menggunakan database baru yang menggunakan engine MyISAM

$koneksi = mysqli_connect(
    $host,
    $user,
    $pass,
    $db
);

if(!$koneksi){
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>