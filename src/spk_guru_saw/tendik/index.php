<?php
session_start();
include '../config/koneksi.php';

// Proteksi: Hanya guru yang boleh akses
if(!isset($_SESSION['role']) || $_SESSION['role'] != "guru"){
    header("Location: ../auth/login.php");
    exit;
}

$id_g = $_SESSION['id_user'];

// ==========================================
// PROSES UPDATE PROFIL (NIP & MAPEL)
// ==========================================
$pesan_sukses = "";
$pesan_error = "";

if(isset($_POST['update_profil'])){
    $nip_baru = mysqli_real_escape_string($koneksi, $_POST['nip']);
    $mapel_baru = mysqli_real_escape_string($koneksi, $_POST['mapel']);
    
    // Update ke tabel guru
    $update = mysqli_query($koneksi, "UPDATE guru SET nip='$nip_baru', mapel='$mapel_baru' WHERE id_user='$id_g'");
    
    if($update){
        $pesan_sukses = "Profil berhasil diperbarui!";
    } else {
        $pesan_error = "Gagal memperbarui profil: " . mysqli_error($koneksi);
    }
}

// ==========================================
// AMBIL DATA GURU
// ==========================================
$q_guru = mysqli_query($koneksi, "SELECT * FROM guru WHERE id_user='$id_g'");
$d_guru = mysqli_fetch_assoc($q_guru);

$id_guru_real = $d_guru['id_guru'] ?? 0;
$nip_guru = $d_guru['nip'] ?? '';
$mapel_guru = $d_guru['mapel'] ?? '';

// Ambil data dokumen
$query_dok = mysqli_query($koneksi, "SELECT * FROM dokumen WHERE id_guru = '$id_g'");

// Cek Pengesahan
$q_pengesahan = mysqli_query($koneksi, "SELECT * FROM pengesahan LIMIT 1");
$pengesahan = mysqli_fetch_assoc($q_pengesahan);
$status_sah = $pengesahan['status'] ?? 'Belum Disahkan';

// Cek Hasil SAW untuk guru ini
$cek_hasil = mysqli_query($koneksi, "SELECT * FROM hasil_saw WHERE id_guru = '$id_g'");
$hasil = mysqli_fetch_assoc($cek_hasil);

// Ambil detail rata-rata nilai per kriteria
$q_detail_nilai = mysqli_query($koneksi, "
    SELECT k.kode_kriteria, k.nama_kriteria, k.bobot, AVG(p.nilai) as rata_nilai
    FROM kriteria k
    JOIN penilaian p ON k.id_kriteria = p.id_kriteria
    WHERE p.id_guru = '$id_guru_real'
    GROUP BY k.id_kriteria
    ORDER BY k.id_kriteria ASC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Guru - SPK SAW</title>
    <style>
        body { 
            margin:0; 
            font-family: 'Segoe UI', Tahoma, sans-serif; 
            background: linear-gradient(135deg, #0f172a, #1e293b); 
            color:#fff; 
            padding:30px; 
            overflow-y: scroll; 
        }
        
        .container { max-width: 1100px; margin: auto; }
        
        /* CARD UTAMA */
        .card { 
            background: rgba(255,255,255,0.06); 
            border: 1px solid rgba(255,255,255,0.08); 
            backdrop-filter: blur(10px); 
            padding:25px; 
            border-radius:15px; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.3); 
            margin-bottom: 25px; 
        }
        
        h2 { color:#38bdf8; margin-top:0; display:flex; justify-content:space-between; align-items:center; }
        .subtitle { font-size: 14px; color: #94a3b8; margin-top: -10px; margin-bottom: 20px; }

        /* HEADER NAV SIMPEL */
        .top-nav { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .top-nav h1 { margin: 0; font-size: 24px; color: #fff; }
        .btn-logout { background: rgba(239, 68, 68, 0.15); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.3); }
        .btn-logout:hover { background: #ef4444; color: #fff; }

        /* BUTTON */
        .btn { display:inline-block; padding:10px 18px; border-radius:8px; text-decoration:none; font-size:14px; font-weight:600; cursor:pointer; border:none; transition:0.3s; }
        .btn-primary { background:#38bdf8; color:#0f172a; }
        .btn-primary:hover { background:#0ea5e9; transform: translateY(-2px); }
        .btn-success { background:#22c55e; color:#fff; }
        .btn-success:hover { background:#16a34a; transform: translateY(-2px); }
        .btn-cancel { background:#64748b; color:#fff; }
        .btn-cancel:hover { background:#475569; transform: translateY(-2px); }

        /* FORM PROFIL */
        .form-row { display: flex; gap: 20px; flex-wrap: wrap; }
        .form-group { flex: 1; min-width: 250px; display: flex; flex-direction: column; }
        .form-group label { font-size: 13px; color: #cbd5e1; margin-bottom: 8px; font-weight: 600; }
        .form-control { 
            padding: 12px 15px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.2); 
            background: rgba(15, 23, 42, 0.5); color: #fff; font-size: 14px; transition: 0.3s; 
        }
        .form-control:focus { outline: none; border-color: #38bdf8; background: rgba(15, 23, 42, 0.8); }
        .readonly { background: rgba(255,255,255,0.03); color: #94a3b8; border-color: transparent; cursor: not-allowed; }

        /* ALERT PESAN */
        .alert-success { background: rgba(34, 197, 94, 0.15); border: 1px solid rgba(34, 197, 94, 0.3); color: #4ade80; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .alert-error { background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3); color: #f87171; padding: 15px; border-radius: 8px; margin-bottom: 20px; }

        /* TABLE & LAINNYA SAMA */
        .table-container { overflow-x:auto; margin-top:15px; }
        table { width:100%; border-collapse:collapse; min-width:600px; background: rgba(15, 23, 42, 0.4); border-radius:10px; overflow:hidden; }
        th, td { padding:12px 15px; text-align:left; border-bottom:1px solid rgba(255,255,255,0.05); }
        th { background: rgba(56, 189, 248, 0.15); color:#cbd5e1; font-weight:600; }
        td { color:#e2e8f0; }
        table tbody tr { transition: background-color 0.15s ease; }
        table tbody tr:hover td { background: rgba(2, 6, 23, 0.95) !important; color:#e2e8f0 !important; }
        
        /* STYLE HASIL */
        .summary-container { display: flex; gap: 20px; margin-bottom: 25px; }
        .summary-box { flex: 1; background: rgba(34, 197, 94, 0.15); border: 1px solid rgba(34, 197, 94, 0.3); padding: 25px; border-radius: 12px; text-align: center; }
        .summary-box h3 { margin: 0 0 10px 0; color: #cbd5e1; font-size: 16px; }
        .summary-box .value { font-size: 40px; font-weight: bold; color: #4ade80; text-shadow: 0 0 10px rgba(74, 222, 128, 0.3); }
        .badge-nilai { background: rgba(56, 189, 248, 0.2); color: #38bdf8; padding: 4px 12px; border-radius: 6px; font-weight: bold; }
        .info-box { background: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.3); color: #fcd34d; padding: 15px; border-radius: 8px; }
    </style>
</head>
<body>

<div class="container">
    
    <div class="top-nav">
        <h1>👋 Selamat Datang, <?= htmlspecialchars($_SESSION['nama']); ?>!</h1>
        <a href="../auth/logout.php" class="btn btn-logout">🚪 Logout</a>
    </div>

    <!-- PESAN NOTIFIKASI -->
    <?php if($pesan_sukses != "") { echo "<div class='alert-success'>✓ $pesan_sukses</div>"; } ?>
    <?php if($pesan_error != "") { echo "<div class='alert-error'>⚠ $pesan_error</div>"; } ?>

    <!-- CARD 1: PROFIL GURU (DENGAN FITUR TOGGLE EDIT) -->
    <div class="card">
        <h2>👤 Profil Guru</h2>
        <div class="subtitle">Perbarui NIP dan Mata Pelajaran Anda agar tersinkronisasi dengan sistem Admin.</div>
        
        <form method="POST" action="">
            <div class="form-row">
                <div class="form-group">
                    <label>Nama Lengkap (Username)</label>
                    <!-- Username selalu readonly mutlak -->
                    <input type="text" value="<?= htmlspecialchars($_SESSION['nama']); ?>" class="form-control readonly" readonly>
                </div>
                <div class="form-group">
                    <label>Nomor Induk Pegawai (NIP)</label>
                    <input type="text" name="nip" id="input-nip" value="<?= htmlspecialchars($nip_guru); ?>" class="form-control readonly" placeholder="Masukkan NIP Anda" required readonly>
                </div>
                <div class="form-group">
                    <label>Mata Pelajaran (Mapel)</label>
                    <input type="text" name="mapel" id="input-mapel" value="<?= htmlspecialchars($mapel_guru); ?>" class="form-control readonly" placeholder="Contoh: Matematika" required readonly>
                </div>
            </div>
            
            <div style="margin-top: 20px; text-align: right;">
                <!-- Tombol Edit (Awalnya Muncul) -->
                <button type="button" id="btn-edit" class="btn btn-primary" onclick="aktifkanEdit()">✏️ Edit Profil</button>
                
                <!-- Tombol Simpan & Batal (Awalnya Sembunyi) -->
                <button type="button" id="btn-batal" class="btn btn-cancel" style="display: none;" onclick="batalkanEdit()">✖ Batal</button>
                <button type="submit" name="update_profil" id="btn-simpan" class="btn btn-success" style="display: none;">💾 Simpan Perubahan</button>
            </div>
        </form>
    </div>

    <!-- CARD 2: KELOLA DOKUMEN -->
    <div class="card">
        <h2>
            📂 Kelola Dokumen
            <a href="upload.php" class="btn btn-primary">+ Upload Baru</a>
        </h2>
        <div class="subtitle">Unggah berkas persyaratan penilaian Anda di sini.</div>

        <div class="table-container">
            <table>
                <tr>
                    <th width="50">No</th>
                    <th>Jenis Dokumen</th>
                    <th>Status</th>
                    <th width="150">Aksi</th>
                </tr>
                <?php 
                $no = 1;
                if(mysqli_num_rows($query_dok) > 0) {
                    while($d = mysqli_fetch_array($query_dok)){ 
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($d['jenis_dokumen']) ?></td>
                    <td>
                        <?php if($d['status'] == 'Pending'){ ?>
                            <span style="color:#facc15; font-weight:bold;">🕒 Pending</span>
                        <?php } else { ?>
                            <span style="color:#22c55e; font-weight:bold;">✓ Diverifikasi</span>
                        <?php } ?>
                    </td>
                    <td>
                        <a href="../uploads/<?= htmlspecialchars($d['nama_file']) ?>" target="_blank" style="color:#38bdf8; text-decoration:none; font-weight:bold; margin-right:15px;">Lihat ↗</a>
                        
                        <?php if($d['status'] == 'Pending') { ?>
                            <a href="hapus_dokumen.php?id=<?=$d['id_dokumen']?>" onclick="return confirm('Yakin ingin menghapus dokumen ini?')" style="color:#f87171; text-decoration:none; font-weight:bold;">Hapus</a>
                        <?php } else { ?>
                            <span style="color:#64748b; font-size:12px;">Terkunci</span>
                        <?php } ?>
                    </td>
                </tr>
                <?php 
                    } 
                } else { 
                ?>
                <tr>
                    <td colspan="4" style="text-align:center; padding:20px; color:#94a3b8;">Belum ada dokumen yang diunggah.</td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>

    <!-- CARD 3: HASIL EVALUASI -->
    <div class="card">
        <h2>📊 Hasil Evaluasi & Perankingan</h2>
        <div class="subtitle">Rincian nilai pencapaian berdasarkan perhitungan sistem SPK.</div>
        
        <?php if($hasil && $status_sah == 'Sudah Disahkan') { ?>
            
            <div class="summary-container">
                <div class="summary-box">
                    <h3>Peringkat Anda</h3>
                    <div class="value">#<?= $hasil['peringkat']; ?></div>
                </div>
                <div class="summary-box">
                    <h3>Nilai Akhir (SAW)</h3>
                    <div class="value"><?= number_format($hasil['nilai_akhir'], 4); ?></div>
                </div>
            </div>

            <div class="table-container">
                <table>
                    <tr>
                        <th width="80">Kode</th>
                        <th>Kriteria / Kompetensi</th>
                        <th width="100">Bobot</th>
                        <th width="150">Nilai Diperoleh</th>
                    </tr>
                    <?php while($dn = mysqli_fetch_array($q_detail_nilai)){ ?>
                    <tr>
                        <td><?= htmlspecialchars($dn['kode_kriteria']); ?></td>
                        <td><?= htmlspecialchars($dn['nama_kriteria']); ?></td>
                        <td><?= htmlspecialchars($dn['bobot']); ?>%</td>
                        <td><span class="badge-nilai"><?= round($dn['rata_nilai'], 2); ?></span></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>

        <?php } elseif ($hasil && $status_sah != 'Sudah Disahkan') { ?>
            <div class="info-box">
                ⏳ Penilaian Anda sudah selesai dihitung oleh sistem, namun <strong>menunggu pengesahan</strong> dari Kepala Sekolah sebelum peringkat dapat ditampilkan.
            </div>
        <?php } else { ?>
            <div class="info-box" style="color:#94a3b8; background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.1);">
                📌 Penilaian Anda sedang dalam proses atau dokumen bukti Anda belum selesai dievaluasi oleh Tim Penilai.
            </div>
        <?php } ?>
    </div>

</div>

<!-- JAVASCRIPT UNTUK FITUR EDIT/SIMPAN -->
<script>
    // Simpan nilai asli awal supaya kalau batal, kembali ke nilai semula
    const nilaiAwalNip = "<?= htmlspecialchars($nip_guru); ?>";
    const nilaiAwalMapel = "<?= htmlspecialchars($mapel_guru); ?>";

    const inputNip = document.getElementById('input-nip');
    const inputMapel = document.getElementById('input-mapel');
    const btnEdit = document.getElementById('btn-edit');
    const btnSimpan = document.getElementById('btn-simpan');
    const btnBatal = document.getElementById('btn-batal');

    function aktifkanEdit() {
        // Hilangkan mode readonly
        inputNip.removeAttribute('readonly');
        inputMapel.removeAttribute('readonly');
        
        // Hilangkan efek CSS gelap
        inputNip.classList.remove('readonly');
        inputMapel.classList.remove('readonly');

        // Ganti Tombol Edit menjadi Simpan & Batal
        btnEdit.style.display = 'none';
        btnSimpan.style.display = 'inline-block';
        btnBatal.style.display = 'inline-block';

        // Fokuskan kursor ke NIP
        inputNip.focus();
    }

    function batalkanEdit() {
        // Kembalikan ke mode readonly
        inputNip.setAttribute('readonly', true);
        inputMapel.setAttribute('readonly', true);
        
        // Kembalikan efek CSS gelap
        inputNip.classList.add('readonly');
        inputMapel.classList.add('readonly');

        // Kembalikan tulisan ke data aslinya (jika sempat diketik lalu dibatalkan)
        inputNip.value = nilaiAwalNip;
        inputMapel.value = nilaiAwalMapel;

        // Ganti Tombol Simpan kembali ke Edit
        btnEdit.style.display = 'inline-block';
        btnSimpan.style.display = 'none';
        btnBatal.style.display = 'none';
    }
</script>

</body>
</html>