<?php
session_start();
include '../../config/koneksi.php';

if($_SESSION['role'] != "admin"){
    header("Location: ../../auth/login.php");
    exit;
}

/* ====================================================
   CEK PENGESAHAN KEPALA SEKOLAH
==================================================== */
$q_pengesahan = mysqli_query($koneksi, "SELECT * FROM pengesahan LIMIT 1");
$data_pengesahan = mysqli_fetch_assoc($q_pengesahan);
$status_pengesahan = $data_pengesahan['status'] ?? 'Belum Disahkan';

/* ====================================================
   PERSIAPAN DATA (Kriteria, Max, Penilai, Guru)
==================================================== */
$kriteria = mysqli_query($koneksi, "SELECT * FROM kriteria");
$data_kriteria = [];
while($k = mysqli_fetch_array($kriteria)){ 
    $data_kriteria[] = $k; 
}

$max = [];
foreach($data_kriteria as $k){
    $id_kriteria = $k['id_kriteria'];
    $qmax = mysqli_query($koneksi, "SELECT MAX(nilai) as max_nilai FROM penilaian WHERE id_kriteria='$id_kriteria'");
    $dmax = mysqli_fetch_array($qmax);
    // Mencegah pembagian dengan 0 jika nilai masih kosong
    $max[$id_kriteria] = $dmax['max_nilai'] ?: 1; 
}

$list_penilai = [];
$q_penilai = mysqli_query($koneksi, "SELECT * FROM users WHERE role='penilai' ORDER BY nama ASC");
while($p = mysqli_fetch_assoc($q_penilai)){ 
    $list_penilai[] = $p; 
}

/* ====================================================
   PROSES SAW & CEK KELENGKAPAN PENILAIAN
==================================================== */
$hasil = [];
$monitoring_guru = [];
$guru = mysqli_query($koneksi, "SELECT * FROM guru ORDER BY nama_guru ASC");

while($g = mysqli_fetch_array($guru)){
    $lengkap = true;
    $status_penilai = [];

    // 1. Cek kelengkapan dari semua Tim Penilai
    foreach($list_penilai as $p){
        $cek = mysqli_query($koneksi, "SELECT * FROM submit_penilai WHERE id_user='".$p['id_user']."' AND id_guru='".$g['id_guru']."' AND status='Submitted'");
        if(mysqli_num_rows($cek) > 0){
            $status_penilai[$p['id_user']] = true;
        } else {
            $status_penilai[$p['id_user']] = false;
            $lengkap = false;
        }
    }

    // 2. Cek kelengkapan dari Kepala Sekolah
    $cek_kepsek = mysqli_query($koneksi, "SELECT * FROM submit_kepsek WHERE id_guru='".$g['id_guru']."' AND status='Submitted'");
    $status_kepsek = (mysqli_num_rows($cek_kepsek) > 0);
    if(!$status_kepsek) $lengkap = false;

    // 3. Hitung Total SAW
    $total = 0;
    foreach($data_kriteria as $k){
        $id_kriteria = $k['id_kriteria'];
        $qnilai = mysqli_query($koneksi, "SELECT AVG(nilai) as rata FROM penilaian WHERE id_guru='".$g['id_guru']."' AND id_kriteria='$id_kriteria'");
        $dnilai = mysqli_fetch_array($qnilai);
        $nilai = $dnilai['rata'] ?? 0;

        $normalisasi = $nilai / $max[$id_kriteria];
        $total += $normalisasi * $k['bobot'];
    }

    // 4. Simpan untuk Monitoring Tabel
    $monitoring_guru[] = [
        'nama_guru' => $g['nama_guru'],
        'status_penilai' => $status_penilai,
        'status_kepsek' => $status_kepsek,
        'lengkap' => $lengkap
    ];

    // 5. Masukkan ke hasil ranking HANYA jika penilaian sudah lengkap
    if($lengkap) {
        $hasil[] = [
            'id_guru' => $g['id_user'], // Pakai id_user agar bisa dibaca di dashboard guru
            'nama_guru' => $g['nama_guru'],
            'total' => $total
        ];
    }
}

/* ====================================================
   SORTING RANKING & SINKRONISASI KE DATABASE
==================================================== */
// Urutkan dari nilai tertinggi ke terendah
usort($hasil, function($a,$b){ return $b['total'] <=> $a['total']; });

// Simpan ranking ke database (Agar dashboard guru bisa melihat hasilnya)
mysqli_query($koneksi, "CREATE TABLE IF NOT EXISTS hasil_saw (id INT AUTO_INCREMENT PRIMARY KEY, id_guru INT, nilai_akhir DECIMAL(10,4), peringkat INT)");
mysqli_query($koneksi, "TRUNCATE TABLE hasil_saw"); // Bersihkan data lama tiap kali halaman direfresh

$rank_db = 1;
foreach($hasil as $h) {
    $id_user = $h['id_guru'];
    $nilai_akhir = round($h['total'], 4);
    mysqli_query($koneksi, "INSERT INTO hasil_saw (id_guru, nilai_akhir, peringkat) VALUES ('$id_user', '$nilai_akhir', '$rank_db')");
    $rank_db++;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hasil SAW & Monitoring</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <style>
        /* TEMA DARK MODERN GLASSMORPHISM */
        body { margin:0; font-family: 'Segoe UI', Tahoma, sans-serif; background: linear-gradient(135deg, #0f172a, #1e293b); color:#fff; }
        .container { padding:30px; display:flex; justify-content:center; }
        .card { width:100%; max-width:1000px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.08); backdrop-filter: blur(10px); padding:25px; border-radius:15px; box-shadow: 0 10px 25px rgba(0,0,0,0.3); }
        
        h2 { color: #38bdf8; margin-top: 0; margin-bottom: 15px; }
        
        table { width:100%; border-collapse:collapse; margin-bottom:30px; background: rgba(15, 23, 42, 0.4); border-radius:10px; overflow:hidden; }
        th, td { padding:12px 15px; text-align:left; border-bottom:1px solid rgba(255,255,255,0.05); }
        th { background: rgba(56, 189, 248, 0.15); color:#cbd5e1; font-weight: bold; }
        
        /* OVERRIDE: Menghilangkan efek bercahaya pada tabel saat di hover yang menyebabkan tulisan tidak jelas */
        table tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.05) !important; /* Memberi efek latar belakang abu-abu sangat transparan */
            box-shadow: none !important;
            text-shadow: none !important;
        }
        table td:hover, table th:hover {
            box-shadow: none !important;
            text-shadow: none !important;
        }

        /* Status & Badges */
        .status-yes { color: #22c55e; font-weight: bold; text-align: center; }
        .status-no { color: #ef4444; font-weight: bold; text-align: center; }
        .badge-success { background: rgba(34, 197, 94, 0.15); color: #22c55e; padding: 6px 12px; border-radius: 6px; font-size: 12px; border: 1px solid rgba(34,197,94,0.3); font-weight: bold; display: inline-block;}
        .badge-warning { background: rgba(245, 158, 11, 0.15); color: #fcd34d; padding: 6px 12px; border-radius: 6px; font-size: 12px; border: 1px solid rgba(245,158,11,0.3); font-weight: bold; display: inline-block;}
        
        /* Info Box */
        .warning-box { background: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.3); color: #fcd34d; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; }
        
        /* Button */
        .btn-tambah { display: inline-block; padding: 10px 18px; border-radius: 8px; background: #22c55e; color: #0f172a; text-decoration: none; font-weight: bold; transition: 0.3s; margin-bottom: 15px; border: none; }
        .btn-tambah:hover { background: #16a34a; transform: translateY(-2px); box-shadow: none; text-shadow: none; }
    </style>
</head>
<body>

<?php include '../../template/menu_admin.php'; ?>

<div class="container">
    <div class="card">
        
        <h2>📊 Monitoring Kelengkapan Penilaian</h2>
        <table>
            <tr>
                <th>No</th>
                <th>Nama Guru</th>
                <?php foreach($list_penilai as $p){ echo "<th style='text-align:center;'>{$p['nama']}</th>"; } ?>
                <th style='text-align:center;'>Kepsek</th>
                <th>Status Akhir</th>
            </tr>
            <?php 
            $no = 1;
            foreach($monitoring_guru as $mg){ ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($mg['nama_guru']); ?></td>
                
                <?php foreach($list_penilai as $p){ 
                    echo $mg['status_penilai'][$p['id_user']] ? "<td class='status-yes'>✔</td>" : "<td class='status-no'>✖</td>";
                } ?>
                
                <?= $mg['status_kepsek'] ? "<td class='status-yes'>✔</td>" : "<td class='status-no'>✖</td>"; ?>
                
                <td>
                    <?php if($mg['lengkap']){ ?>
                        <span class="badge-success">Lengkap</span>
                    <?php } else { ?>
                        <span class="badge-warning">Belum Lengkap</span>
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
        </table>

        <hr style="border:0; border-top:1px solid rgba(255,255,255,0.1); margin: 30px 0;">

        <h2>🏆 Hasil Ranking SAW</h2>
        <?php if($status_pengesahan == "Sudah Disahkan"){ ?>
            <a href="cetak_laporan.php" class="btn-tambah">🖨 Cetak Laporan Pengesahan</a>
        <?php } else { ?>
            <div class="warning-box">
                ⚠ Sistem hanya meranking guru dengan penilaian <strong>Lengkap</strong>. Hasil perankingan belum disahkan oleh Kepala Sekolah sehingga laporan tidak dapat dicetak.
            </div>
        <?php } ?>

        <table>
            <tr>
                <th width="80">Ranking</th>
                <th>Nama Guru</th>
                <th width="150">Nilai Akhir</th>
            </tr>
            <?php
            $rank = 1;
            if(count($hasil) > 0) {
                foreach($hasil as $h){ ?>
                <tr>
                    <td><strong style="color:#fff; font-size:16px;">#<?= $rank++; ?></strong></td>
                    <td><?= htmlspecialchars($h['nama_guru']); ?></td>
                    <td><strong style="color:#38bdf8; font-size:16px;"><?= round($h['total'], 4); ?></strong></td>
                </tr>
                <?php } 
            } else { ?>
                <tr>
                    <td colspan="3" style="text-align:center; color:#94a3b8; padding:20px;">
                        Belum ada guru dengan status penilaian lengkap.
                    </td>
                </tr>
            <?php } ?>
        </table>

    </div>
</div>

</body>
</html>