<?php
session_start();
include '../config/koneksi.php';

// Pastikan hanya penilai yang bisa akses
if($_SESSION['role'] != "penilai"){
    header("Location: ../auth/login.php");
    exit;
}

/*
|------------------------------------------------------------------
| Guru yang belum dinilai DAN Dokumen sudah Diverifikasi
|------------------------------------------------------------------
*/
$guru = mysqli_query($koneksi,
    "SELECT * FROM guru 
     WHERE id_guru NOT IN (
        SELECT DISTINCT id_guru FROM penilaian WHERE id_user='".$_SESSION['id_user']."'
     )
     AND id_user IN (
        SELECT DISTINCT id_guru FROM dokumen WHERE status='Diverifikasi'
     )
     ORDER BY nama_guru ASC"
);

$jml_guru_belum = mysqli_num_rows($guru);

/*
|------------------------------------------------------------------
| Kriteria
|------------------------------------------------------------------
*/
$kriteria = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY id_kriteria ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Input Penilaian Guru - SPK SAW</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body{ margin:0; font-family:'Segoe UI', Tahoma, sans-serif; background: linear-gradient(135deg, #0f172a, #1e293b); color:#fff; overflow-y: scroll; }
        .container{ padding:30px; display:flex; justify-content:center; }
        .card{ width:100%; max-width:800px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.08); backdrop-filter: blur(10px); padding:25px; border-radius:15px; box-shadow: 0 10px 25px rgba(0,0,0,0.3); margin-bottom: 30px; }
        h2{ margin:0 0 10px 0; color: #38bdf8; }
        p{ color:#cbd5e1; font-size:14px; }
        .form-group{ margin-bottom:15px; }
        label{ display:block; margin-bottom:6px; color:#38bdf8; font-size:14px; font-weight: bold; }
        select{ width:100%; padding:10px 12px; border-radius:8px; border:1px solid rgba(255,255,255,0.1); background: rgba(15, 23, 42, 0.7); color:#fff; outline:none; box-sizing: border-box; cursor: pointer; font-size: 14px; }
        select:focus{ border-color:#38bdf8; }
        
        .btn-simpan{ width:100%; padding:12px; border:none; border-radius:8px; background: linear-gradient(135deg, #38bdf8 0%, #0284c7 100%); color:#fff; font-weight:bold; cursor:pointer; transition:0.3s ease; margin-top: 15px; font-size: 15px; box-shadow: 0 4px 10px rgba(56,189,248,0.25); }
        .btn-simpan:hover{ transform: translateY(-3px); box-shadow: 0 6px 15px rgba(56,189,248,0.4); }
        
        .alert-success{ background: rgba(34, 197, 94, 0.15); border: 1px solid rgba(34, 197, 94, 0.3); padding:20px; border-radius:10px; text-align:center; }
        .alert-success h3{ margin:0 0 10px 0; color:#22c55e; }
        .alert-success p{ color:#cbd5e1; }
        hr{ border:0; border-top:1px solid rgba(255,255,255,0.1); margin:20px 0; }
        
        /* BOX INFO GURU */
        #info-guru-area { 
            display: none; 
            margin-top: 15px; 
            padding: 18px 20px; 
            background: rgba(15, 23, 42, 0.6); 
            border: 1px solid rgba(56, 189, 248, 0.4); 
            border-left: 5px solid #38bdf8;
            border-radius: 8px; 
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
        #info-guru-area h4 { margin: 0 0 10px 0; color: #38bdf8; font-size: 15px; border-bottom: 1px dashed rgba(255,255,255,0.1); padding-bottom: 8px; }
        #info-guru-area table { width: 100%; border-collapse: collapse; }
        #info-guru-area td { padding: 6px 0; color: #e2e8f0; font-size: 14px; border: none; background: transparent; }
        #info-guru-area td.label-info { width: 140px; color: #94a3b8; font-weight: 600; }
        
        /* AREA DOKUMEN */
        #dokumen-area { margin-top: 15px; padding: 15px; background: rgba(0,0,0,0.2); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05); }

        /* ========================================================
           OVERRIDE MUTLAK: MEMATIKAN SEMUA EFEK GLOW / BERCAHAYA 
           ======================================================== */
        table *, tr *, td *, th *, a *, input *, select * {
            text-shadow: none !important;
            box-shadow: none !important;
        }

        table tbody tr {
            transition: background-color 0.15s ease !important;
        }

        table tbody tr:hover, 
        table tbody tr:hover td, 
        table tbody tr:hover th {
            background-color: rgba(15, 23, 42, 0.95) !important;
            color: #e2e8f0 !important;
            text-shadow: none !important;
            box-shadow: none !important;
        }
    </style>
</head>
<body>

<?php include '../template/menu_penilai.php'; ?>

<div class="container">
    <div class="card">
        <h2>📝 Input Penilaian Guru</h2>
        <p>Hanya guru dengan dokumen berstatus <strong>Diverifikasi</strong> yang dapat dinilai.</p>
        <hr>

        <?php if($jml_guru_belum > 0){ ?>
        <form action="simpan_penilaian.php" method="POST">
            <div class="form-group">
                <label>Pilih Guru yang Akan Dinilai</label>
                
                <select name="id_guru" id="id_guru" required>
                    <option value="">-- Silakan Pilih Guru --</option>
                    <?php while($g = mysqli_fetch_array($guru)){ ?>
                        <!-- Menyisipkan data-nama, data-nip, dan data-mapel -->
                        <option value="<?= $g['id_guru']; ?>" 
                                data-nama="<?= htmlspecialchars($g['nama_guru']); ?>"
                                data-nip="<?= htmlspecialchars($g['nip'] ?: '-'); ?>" 
                                data-mapel="<?= htmlspecialchars($g['mapel'] ?: '-'); ?>">
                            <?= htmlspecialchars($g['nama_guru']); ?>
                        </option>
                    <?php } ?>
                </select>

                <!-- Tempat memunculkan Detail Profil Guru -->
                <div id="info-guru-area"></div>

                <!-- Tempat memunculkan Daftar Dokumen -->
                <div id="dokumen-area" style="display:none;"></div>
            </div>

            <br>
            <h3>📋 Indikator Penilaian (Berdasarkan Bukti Dokumen)</h3>
            <hr>

            <?php 
            mysqli_data_seek($kriteria, 0); // Reset pointer kriteria
            while($k = mysqli_fetch_array($kriteria)){ 
                $kode =$k['kode_kriteria'];
            ?>
            <div class="form-group">
                <label><?= $kode; ?> - <?= htmlspecialchars($k['nama_kriteria']); ?></label>
                
                <select name="nilai[<?= $k['id_kriteria']; ?>]" required>
                    <option value="">-- Pilih Nilai --</option>
                    
                    <?php if($kode == 'C2') { ?>                         <option value="20">Tidak Ada Sertifikat</option>                         <option value="40">1 Sertifikat Pelatihan/Seminar</option>                         <option value="60">2 Sertifikat Pelatihan/Seminar</option>                         <option value="80">3 Sertifikat Pelatihan/Seminar</option>                         <option value="100">Lebih dari 3 Sertifikat</option>                                              <?php } elseif($kode == 'C6') { ?>
                        <option value="20">Tidak Ada Karya/Prestasi</option>
                        <option value="40">Tingkat Sekolah</option>
                        <option value="60">Tingkat Kecamatan</option>
                        <option value="80">Tingkat Kabupaten</option>
                        <option value="90">Tingkat Provinsi</option>
                        <option value="100">Tingkat Nasional / Internasional</option>
                        
                    <?php } else { ?>
                        <option value="20">Sangat Kurang (20)</option>
                        <option value="40">Kurang (40)</option>
                        <option value="60">Cukup (60)</option>
                        <option value="80">Baik (80)</option>
                        <option value="100">Sangat Baik (100)</option>
                    <?php } ?>
                </select>
            </div>
            <?php } ?>

            <button type="submit" class="btn-simpan">💾 Simpan Hasil Penilaian</button>
        </form>

        <?php } else { ?>
        <div class="alert-success">
            <h3>✓ Tugas Selesai</h3>
            <p>Semua guru yang dokumennya valid telah dinilai, atau belum ada dokumen guru baru yang diverifikasi oleh Admin.</p>
        </div>
        <?php } ?>

    </div>
</div>

<script>
document.getElementById('id_guru').addEventListener('change', function() {
    var id_guru = this.value;
    var docArea = document.getElementById('dokumen-area');
    var infoArea = document.getElementById('info-guru-area');
    
    if(id_guru !== "") {
        // 1. Ambil data dari atribut option yang dipilih
        var selectedOption = this.options[this.selectedIndex];
        var nama_guru = selectedOption.getAttribute('data-nama');
        var nip_guru = selectedOption.getAttribute('data-nip');
        var mapel_guru = selectedOption.getAttribute('data-mapel');

        // 2. Tampilkan Box Info Guru
        infoArea.style.display = 'block';
        infoArea.innerHTML = `
            <h4>👤 Informasi Guru</h4>
            <table>
                <tr><td class="label-info">Nama Lengkap</td><td>: <strong style="color: #fff;">${nama_guru}</strong></td></tr>
                <tr><td class="label-info">NIP</td><td>: <strong style="color: #fff;">${nip_guru}</strong></td></tr>
                <tr><td class="label-info">Mata Pelajaran</td><td>: <strong style="color: #fff;">${mapel_guru}</strong></td></tr>
            </table>
        `;

        // 3. Proses Ajax untuk Dokumen (Muncul tepat di bawah Info Guru)
        docArea.style.display = 'block';
        docArea.innerHTML = '<span style="color:#38bdf8;">⏳ Sedang memuat dokumen lampiran...</span>';
        
        fetch("get_dokumen.php?id_guru=" + id_guru)
            .then(response => response.text())
            .then(data => {
                docArea.innerHTML = data;
            })
            .catch(error => {
                docArea.innerHTML = '<span style="color:#ef4444;">⚠ Gagal memuat dokumen. Periksa koneksi atau file get_dokumen.php.</span>';
            });
            
    } else {
        // Sembunyikan semua jika pilihan kembali ke posisi "-- Silakan Pilih Guru --"
        infoArea.style.display = 'none';
        infoArea.innerHTML = '';
        docArea.style.display = 'none';
        docArea.innerHTML = '';
    }
});
</script>

</body>
</html>