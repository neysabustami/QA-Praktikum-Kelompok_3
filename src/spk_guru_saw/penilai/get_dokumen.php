<?php
session_start();
include '../config/koneksi.php';

// Proteksi akses khusus untuk penilai
if(!isset($_SESSION['role']) || $_SESSION['role'] != "penilai"){
    exit;
}

if(isset($_GET['id_guru']) && !empty($_GET['id_guru'])) {
    $id_guru = mysqli_real_escape_string($koneksi, $_GET['id_guru']);

    // 1. Cari id_user dari guru yang dipilih
    $query_user = mysqli_query($koneksi, "SELECT id_user FROM guru WHERE id_guru = '$id_guru'");
    $data_user = mysqli_fetch_assoc($query_user);
    
    if($data_user) {
        $id_user_guru = $data_user['id_user'];

        // 2. Cari dokumen yang berstatus 'Diverifikasi' berdasarkan id_user
        $dokumen = mysqli_query($koneksi, "SELECT * FROM dokumen WHERE id_guru = '$id_user_guru' AND status = 'Diverifikasi'");

        if(mysqli_num_rows($dokumen) > 0) {
            echo "<h4 style='margin-top:0; color:#cbd5e1; margin-bottom:10px;'>📂 Bukti Dokumen Terverifikasi:</h4>";
            echo "<table style='width:100%; border-collapse:collapse;'>";
            
            while($d = mysqli_fetch_assoc($dokumen)) {
                echo "<tr>";
                echo "<td style='padding:8px 0; border-bottom:1px solid rgba(255,255,255,0.05); color:#fff;'> - " . htmlspecialchars($d['jenis_dokumen']) . "</td>";
                echo "<td style='padding:8px 0; border-bottom:1px solid rgba(255,255,255,0.05); text-align:right;'>";
                echo "<a href='../uploads/" . htmlspecialchars($d['nama_file']) . "' target='_blank' style='color:#22c55e; text-decoration:none; font-weight:bold; font-size:13px;'>📄 Lihat</a>";
                echo "</td>";
                echo "</tr>";
            }
            
            echo "</table>";
        } else {
            echo "<span style='color:#fca5a5;'>Guru ini belum memiliki dokumen yang diverifikasi.</span>";
        }
    } else {
        echo "<span style='color:#fca5a5;'>Data profil guru tidak ditemukan.</span>";
    }
}
?>