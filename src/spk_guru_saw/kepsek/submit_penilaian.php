<?php

session_start();

include '../config/koneksi.php';

if($_SESSION['role'] != "kepsek"){

    header("Location: ../auth/login.php");
    exit;

}

$id_user = $_SESSION['id_user'];

$id_guru = $_GET['id'];

$cek = mysqli_query(

    $koneksi,

    "SELECT *

    FROM submit_kepsek

    WHERE

    id_user='$id_user'

    AND

    id_guru='$id_guru'"

);

if(mysqli_num_rows($cek) == 0){

    mysqli_query(

        $koneksi,

        "INSERT INTO submit_kepsek

        (id_user,id_guru,status)

        VALUES

        ('$id_user','$id_guru','Submitted')"

    );

}else{

    mysqli_query(

        $koneksi,

        "UPDATE submit_kepsek

        SET status='Submitted'

        WHERE

        id_user='$id_user'

        AND

        id_guru='$id_guru'"

    );

}

echo "

<script>

alert('Penilaian berhasil disubmit');

window.location='hasil_penilaian.php';

</script>

";

?>