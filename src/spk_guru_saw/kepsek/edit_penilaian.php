<?php
session_start();
include '../config/koneksi.php';

if($_SESSION['role'] != "kepsek"){
    header("Location: ../auth/login.php");
    exit;
}

// Mengambil ID Guru yang akan diedit nilainya dari parameter URL
if(!isset($_GET['id'])) {
    header("Location: hasil_penilaian.php");
    exit;
}
$id_guru = mysqli_real_escape_string($koneksi, $_GET['id']);

/* ==================================================================
   DATA GURU & DOKUMEN PENDUKUNG
   ================================================================== */
$query_guru = mysqli_query($koneksi, "SELECT * FROM guru WHERE id_guru='$id_guru'");
$data_guru = mysqli_fetch_assoc($query_guru);

if(!$data_guru) {
    echo "<script>alert('Data guru tidak ditemukan'); window.location='hasil_penilaian.php';</script>";
    exit;
}

// Mengambil dokumen terverifikasi berdasarkan id_user dari guru tersebut
$id_user_guru = $data_guru['id_user'];
$dokumen = mysqli_query($koneksi, "SELECT * FROM dokumen WHERE id_guru='$id_user_guru' AND status='Diverifikasi'");

/* ==================================================================
   PROSES UPDATE PENILAIAN
   ================================================================== */
if(isset($_POST['update'])){
    foreach($_POST['nilai'] as $id_penilaian => $nilai_baru){
        mysqli_query(
            $koneksi,
            "UPDATE penilaian 
             SET nilai='$nilai_baru' 
             WHERE id_penilaian='$id_penilaian' 
             AND id_user='".$_SESSION['id_user']."'"
        );
    }

    // Reset status pengesahan akhir karena ada perubahan komponen nilai
    mysqli_query($koneksi, "UPDATE pengesahan SET status='Belum Disahkan', tanggal=NULL");

    echo "
    <script>
        alert('Data perubahan penilaian berhasil diperbarui!');
        window.location='hasil_penilaian.php';
    </script>
    ";
    exit;
}

/* ==================================================================
   DATA PENILAIAN YANG SUDAH ADA
   ================================================================== */
$data_penilaian = mysqli_query(
    $koneksi,
    "SELECT p.id_penilaian, p.nilai, k.nama_kriteria, k.kode_kriteria 
     FROM penilaian p
     JOIN kriteria k ON k.id_kriteria = p.id_kriteria
     WHERE p.id_user='".$_SESSION['id_user']."' 
     AND p.id_guru='$id_guru'
     ORDER BY k.id_kriteria ASC"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Penilaian Kepala Sekolah</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body{ margin:0; font-family:'Segoe UI', Tahoma, sans-serif; background: linear-gradient(135deg, #0f172a, #1e293b); color:#fff; padding:30px; }
        .container{ display:flex; justify-content:center; }
        .card{ width:100%; max-width:850px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.08); backdrop-filter: blur(10px); padding:25px; border-radius:15px; box-shadow: 0 10px 25px rgba(0,0,0,0.3); }
        h2{ margin:0 0 5px 0; color: #38bdf8; }
        p.subtitle{ color:#cbd5e1; font-size:14px; margin-bottom: 20px; }
        .form-group{ margin-bottom:20px; }
        label{ display:block; margin-bottom:8px; color:#38bdf8; font-size:14px; font-weight: bold; }
        select{ width:100%; padding:10px 12px; border-radius:8px; border:1px solid rgba(255,255,255,0.1); background: rgba(15, 23, 42, 0.7); color:#fff; outline:none; box-sizing: border-box; cursor: pointer; }
        select:focus{ border-color:#38bdf8; }
        
        /* Box Informasi Profil & Dokumen */
        .info-box{ background: rgba(15, 23, 42, 0.5); padding: 18px; border-radius: 10px; margin-bottom: 25px; border: 1px solid rgba(255,255,255,0.05); }
        .info-box h3{ margin: 0 0 10px 0; color: #fff; font-size: 18px; }
        .info-box table { width:100%; border-collapse:collapse; margin-top:10px; }
        .info-box td { padding: 8px 0; border-bottom: 1px solid rgba(255,255,255,0.05); }
        
        .btn-container { display: flex; gap: 12px; margin-top: 25px; }
        .btn-update{ flex: 2; padding:12px; border:none; border-radius:8px; background:#38bdf8; color:#0f172a; font-weight:bold; cursor:pointer; transition:0.25s ease; }
        .btn-update:hover{ background:#0ea5e9; transform: translateY(-2px); }
        .btn-kembali{ flex: 1; padding:12px; border:1px solid rgba(255,255,255,0.2); border-radius:8px; background: transparent; color:#fff; font-weight:bold; text-align:center; text-decoration:none; transition:0.25s ease; box-sizing: border-box; }
        .btn-kembali:hover{ background: rgba(255,255,255,0.05); }
        hr{ border:0; border-top:1px solid rgba(255,255,255,0.1); margin:20px 0; }
    </style>
</head>
<body>

<?php include '../template/menu_kepsek.php'; ?>

<div class="container">
    <div class="card">
        <h2>✏️ Edit Penilaian Guru</h2>
        <p class="subtitle">Perbarui nilai komponen kriteria di bawah ini berdasarkan kesesuaian bukti dokumen terbaru.</p>
        
        <div class="info-box">
            <h3>👨‍🏫 Profil Guru: <?= htmlspecialchars($data_guru['nama_guru']); ?></h3>
            <span style="color: #cbd5e1; font-size: 13px;">NIP: <?= htmlspecialchars($data_guru['nip']); ?> | Mata Pelajaran: <?= htmlspecialchars($data_guru['mapel']); ?></span>
            
            <hr style="margin: 12px 0;">
            <h4 style="margin: 0 0 5px 0; color: #38bdf8;">📂 Bukti Dokumen Terverifikasi:</h4>
            
            <?php if(mysqli_num_rows($dokumen) > 0) { ?>
                <table>
                    <?php while($d = mysqli_fetch_assoc($dokumen)) { ?>
                        <tr>
                            <td style="color:#fff;"> - <?= htmlspecialchars($d['jenis_dokumen']); ?></td>
                            <td style="text-align:right;">
                                <a href="../uploads/<?= htmlspecialchars($d['nama_file']); ?>" target="_blank" style="color:#22c55e; text-decoration:none; font-weight:bold; font-size:13px;">📄 Lihat Berkas</a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } else { ?>
                <span style="color:#fca5a5; font-size: 13px; display:block; margin-top:5px;">Belum ada berkas dokumen yang tervalidasi oleh sistem admin.</span>
            <?php } ?>
        </div>

        <form method="POST">
            <h3 style="color: #38bdf8; margin-bottom: 15px;">Komponen Nilai Kriteria</h3>
            
            <?php 
            if(mysqli_num_rows($data_penilaian) > 0) {
                while($row = mysqli_fetch_assoc($data_penilaian)){ 
                    $kode = $row['kode_kriteria'];
                    $n = $row['nilai']; 
            ?>
            <div class="form-group">
                <label><?= $kode; ?> - <?= htmlspecialchars($row['nama_kriteria']); ?></label>
                
                <select name="nilai[<?= $row['id_penilaian']; ?>]" required>
                    <option value="">-- Pilih Nilai Sesuai Bukti --</option>
                    
                    <?php if($kode == 'C2') { ?>
                        <option value="20" <?= ($n == 20) ? 'selected' : ''; ?>>Tidak Ada Sertifikat</option>
                        <option value="40" <?= ($n == 40) ? 'selected' : ''; ?>>1 Sertifikat Pelatihan/Seminar</option>
                        <option value="60" <?= ($n == 60) ? 'selected' : ''; ?>>2 Sertifikat Pelatihan/Seminar</option>
                        <option value="80" <?= ($n == 80) ? 'selected' : ''; ?>>3 Sertifikat Pelatihan/Seminar</option>
                        <option value="100" <?= ($n == 100) ? 'selected' : ''; ?>>Lebih dari 3 Sertifikat</option>
                        
                    <?php } elseif($kode == 'C6') { ?>
                        <option value="20" <?= ($n == 20) ? 'selected' : ''; ?>>Tidak Ada Karya/Prestasi</option>
                        <option value="40" <?= ($n == 40) ? 'selected' : ''; ?>>Tingkat Sekolah</option>
                        <option value="60" <?= ($n == 60) ? 'selected' : ''; ?>>Tingkat Kecamatan</option>
                        <option value="80" <?= ($n == 80) ? 'selected' : ''; ?>>Tingkat Kabupaten</option>
                        <option value="90" <?= ($n == 90) ? 'selected' : ''; ?>>Tingkat Provinsi</option>
                        <option value="100" <?= ($n == 100) ? 'selected' : ''; ?>>Tingkat Nasional / Internasional</option>
                        
                    <?php } else { ?>
                        <option value="20" <?= ($n == 20) ? 'selected' : ''; ?>>Sangat Kurang (20)</option>
                        <option value="40" <?= ($n == 40) ? 'selected' : ''; ?>>Kurang (40)</option>
                        <option value="60" <?= ($n == 60) ? 'selected' : ''; ?>>Cukup (60)</option>
                        <option value="80" <?= ($n == 80) ? 'selected' : ''; ?>>Baik (80)</option>
                        <option value="100" <?= ($n == 100) ? 'selected' : ''; ?>>Sangat Baik (100)</option>
                    <?php } ?>
                </select>
            </div>
            <?php 
                }
            } else { 
            ?>
                <div style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3); padding: 15px; border-radius: 8px; text-align: center; color: #fca5a5;">
                    Belum ada rekaman data penilaian awal untuk entitas guru ini.
                </div>
            <?php } ?>

            <div class="btn-container">
                <button type="submit" name="update" class="btn-update">💾 Perbarui Hasil Penilaian</button>
                <a href="hasil_penilaian.php" class="btn-kembali">↩ Kembali</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>