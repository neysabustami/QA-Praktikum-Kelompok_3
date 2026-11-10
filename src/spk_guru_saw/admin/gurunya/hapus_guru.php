<?php

session_start();

include '../../config/koneksi.php';

if($_SESSION['role'] != "admin"){

    header("Location: ../../auth/login.php");
    exit;

}

if(!isset($_GET['id'])){

    echo "
    <script>
        alert('ID Guru tidak ditemukan');
        window.location='guru.php';
    </script>
    ";
    exit;

}

$id = $_GET['id'];

/*
HAPUS DATA PENILAIAN GURU
*/

mysqli_query(
    $koneksi,
    "DELETE FROM penilaian
    WHERE id_guru='$id'"
);

/*
HAPUS DATA GURU
*/

mysqli_query(
    $koneksi,
    "DELETE FROM guru
    WHERE id_guru='$id'"
);

/*
RESET PENGESAHAN
*/

mysqli_query(
    $koneksi,
    "UPDATE pengesahan
    SET
    status='Belum Disahkan',
    tanggal=NULL"
);

/*
KEMBALI KE HALAMAN GURU
*/

echo "
<script>
    alert('Data guru berhasil dihapus');
    window.location='guru.php';
</script>
";

exit;

?>