<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
?>

<style>
/* Reset khusus area menu */
.menu * {
    box-sizing: border-box;
}

/* NAVBAR MODERN DARK */
.menu {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 30px;
    background: rgba(15, 23, 42, 0.85);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    position: sticky;
    top: 0;
    z-index: 1000;
}

/* LOGO */
.logo {
    font-size: 18px;
    font-weight: bold;
    color: #38bdf8;
    letter-spacing: 0.5px;
    display: flex;
    align-items: center;
}

/* MENU LINK */
.menu-link {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.menu-link a {
    text-decoration: none;
    color: #cbd5e1;
    padding: 8px 14px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s ease;
    border: 1px solid transparent;
    text-align: center;
}

/* HOVER UMUM UNTUK SEMUA TOMBOL */
.menu-link a:hover {
    background: rgba(56, 189, 248, 0.15);
    color: #ffffff;
    border: 1px solid rgba(56, 189, 248, 0.3);
    transform: translateY(-2px);
}

/* RESPONSIVE */
@media (max-width: 850px) {
    .menu {
        flex-direction: column;
        gap: 15px;
        padding: 15px 20px;
    }
    
    .menu-link {
        width: 100%;
        justify-content: center;
    }
    
    .menu-link a {
        /* Membuat menu menjadi 2 kolom rapi di layar tablet/HP besar */
        flex: 1 1 calc(50% - 12px); 
        padding: 10px;
    }
}

@media (max-width: 480px) {
    .menu-link a {
        /* Jika layar HP sangat kecil, baru dibuat 1 kolom memanjang kebawah */
        flex: 1 1 100%; 
    }
}
</style>

<nav class="menu">
    <div class="logo">
        📊 SPK Guru Berprestasi
    </div>

    <div class="menu-link">
        <a href="/spk_guru_saw/admin/dashboard.php">Dashboard</a>
        <a href="/spk_guru_saw/admin/gurunya/guru.php">Data Guru</a>
        <a href="/spk_guru_saw/admin/data_dokumen.php">Verifikasi Dokumen</a>
        <a href="/spk_guru_saw/admin/kriterianya/kriteria.php">Kriteria</a>
        <a href="/spk_guru_saw/admin/usernya/user.php">Data User</a>
        <a href="/spk_guru_saw/admin/hasilnya/hasil.php">Hasil Ranking</a>
        <a href="/spk_guru_saw/auth/logout.php">Logout</a>
    </div>
</nav>