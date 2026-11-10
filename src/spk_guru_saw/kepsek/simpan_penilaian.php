<?php
session_start();
include '../config/koneksi.php';

/* =====================================================
   VALIDASI LOGIN
===================================================== */
if(
    !isset($_SESSION['role']) ||
    $_SESSION['role'] != "kepsek"
){
    header("Location: ../auth/login.php");
    exit;
}

/* =====================================================
   VALIDASI DATA POST
===================================================== */
if(
    !isset($_POST['id_guru']) ||
    !isset($_POST['nilai'])
){
    header("Location: penilaian.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$id_guru = $_POST['id_guru'];
$nilai   = $_POST['nilai'];

/* =====================================================
   CEK DUPLIKAT PENILAIAN
===================================================== */
$cek = mysqli_query(
    $koneksi,
    "SELECT id_penilaian
     FROM penilaian
     WHERE id_user='$id_user'
     AND id_guru='$id_guru'
     LIMIT 1"
);

if(mysqli_num_rows($cek) > 0){
    echo "
    <script>
        alert('Guru ini sudah pernah dinilai oleh Kepala Sekolah.');
        window.location='penilaian.php';
    </script>
    ";
    exit;
}

/* =====================================================
   SIMPAN PENILAIAN
===================================================== */
foreach($nilai as $id_kriteria => $n){
    mysqli_query(
        $koneksi,
        "INSERT INTO penilaian
        (
            id_user,
            id_guru,
            id_kriteria,
            nilai
        )
        VALUES
        (
            '$id_user',
            '$id_guru',
            '$id_kriteria',
            '$n'
        )"
    );
}

/* =====================================================
   UPDATE STATUS SUBMIT (Agar terbaca di Monitoring Admin)
===================================================== */
$cek_submit = mysqli_query($koneksi, "SELECT * FROM submit_kepsek WHERE id_guru='$id_guru'");
if(mysqli_num_rows($cek_submit) == 0){
    mysqli_query($koneksi, "INSERT INTO submit_kepsek (id_guru, status) VALUES ('$id_guru', 'Submitted')");
} else {
    mysqli_query($koneksi, "UPDATE submit_kepsek SET status='Submitted' WHERE id_guru='$id_guru'");
}

/* =====================================================
   RESET PENGESAHAN (Kondisi ada data baru masuk)
===================================================== */
mysqli_query(
    $koneksi,
    "UPDATE pengesahan
     SET
     status='Belum Disahkan',
     tanggal=NULL,
     id_kepsek=NULL"
);

/* =====================================================
   REDIRECT
===================================================== */
echo "
<script>
    alert('Penilaian berhasil disimpan dan status pengesahan di-reset.');
    window.location='hasil_penilaian.php';
</script>
";
exit;
?>