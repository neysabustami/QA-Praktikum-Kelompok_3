<?php
session_start();
include '../config/koneksi.php';

// Pastikan hanya admin yang bisa melakukan aksi ini
if($_SESSION['role'] != "admin"){
    header("Location: ../auth/login.php");
    exit;
}

// Tangkap ID User (Guru) dari URL
if(isset($_GET['id'])) {
    $id_guru = mysqli_real_escape_string($koneksi, $_GET['id']);

    // 1. Ambil semua data dokumen milik guru tersebut untuk menghapus file fisiknya
    $query_dokumen = mysqli_query($koneksi, "SELECT nama_file FROM dokumen WHERE id_guru = '$id_guru'");
    
    while($row = mysqli_fetch_array($query_dokumen)) {
        $file_path = "../uploads/" . $row['nama_file'];
        
        // Jika file fisiknya ada di folder uploads, maka hapus filenya
        if(file_exists($file_path) && is_file($file_path)) {
            unlink($file_path);
        }
    }

    // 2. Hapus data dokumen dari database
    mysqli_query($koneksi, "DELETE FROM dokumen WHERE id_guru = '$id_guru'");

    // 3. RESET PENGESAHAN: Karena dokumen bukti dihapus, laporan menjadi tidak valid dan harus dicek ulang
    mysqli_query($koneksi, "UPDATE pengesahan SET status='Belum Disahkan', tanggal=NULL, id_kepsek=NULL");

    // (Opsional) 4. Jika Anda juga ingin menghapus data profil guru-nya sekaligus, hilangkan komentar di bawah ini:
    // mysqli_query($koneksi, "DELETE FROM guru WHERE id_user = '$id_guru'");
    // mysqli_query($koneksi, "DELETE FROM penilaian WHERE id_guru = (SELECT id_guru FROM guru WHERE id_user='$id_guru')");
    
    // Redirect kembali ke halaman data dokumen dengan alert sukses
    echo "
    <script>
        alert('Semua dokumen milik guru tersebut berhasil dihapus, dan status Pengesahan telah di-reset!');
        window.location.href = 'data_dokumen.php';
    </script>
    ";
} else {
    // Jika tidak ada ID yang dikirim
    header("Location: data_dokumen.php");
}
?>