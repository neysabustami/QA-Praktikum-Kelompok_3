<?php

session_start();

include '../config/koneksi.php';

$id_user = $_SESSION['id_user'];

$id_guru = $_GET['id'];

$cek = mysqli_query(

$koneksi,

"SELECT *

FROM submit_penilai

WHERE

id_user='$id_user'

AND

id_guru='$id_guru'"

);

if(mysqli_num_rows($cek)==0){

mysqli_query(

$koneksi,

"INSERT INTO submit_penilai

(id_user,id_guru,status)

VALUES

('$id_user','$id_guru','Submitted')"

);

}else{

mysqli_query(

$koneksi,

"UPDATE submit_penilai

SET status='Submitted'

WHERE

id_user='$id_user'

AND

id_guru='$id_guru'"

);

}

header("Location: hasil_penilaian.php");

?>