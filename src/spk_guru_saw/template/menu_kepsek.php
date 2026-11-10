<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
?>

<style>
/* =========================
   NAVBAR MODERN DARK GLASS
========================= */

.menu{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:15px 30px;
    background: rgba(15, 23, 42, 0.85);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(255,255,255,0.08);
    position: sticky;
    top: 0;
    z-index: 1000;
}

/* LOGO */
.logo{
    font-size:18px;
    font-weight:bold;
    color:#38bdf8;
    letter-spacing:0.5px;
}

/* MENU LINK */
.menu-link{
    display:flex;
    gap:12px;
    flex-wrap:wrap;
}

.menu-link a{
    text-decoration:none;
    color:#cbd5e1;
    padding:8px 14px;
    border-radius:8px;
    font-size:14px;
    transition:0.25s ease;
    border:1px solid transparent;
}

/* HOVER (HALUS, TIDAK MENYILAUKAN) */
.menu-link a:hover{
    background: rgba(2, 6, 23, 0.9);
    color:#ffffff;
    border:1px solid rgba(56, 189, 248, 0.25);
    transform: translateY(-1px);
}

/* ACTIVE */
.menu-link a.active{
    background:#38bdf8;
    color:#0f172a;
    font-weight:600;
}

/* RESPONSIVE */
@media (max-width:768px){
    .menu{
        flex-direction:column;
        align-items:flex-start;
        gap:10px;
    }

    .menu-link{
        flex-direction:column;
        width:100%;
    }

    .menu-link a{
        width:100%;
    }
}
</style>

<div class="menu">

    <div class="logo">
        📊 SPK Guru Berprestasi
    </div>

    <div class="menu-link">

        <a href="/spk_guru_saw/kepsek/dashboard.php">
            Dashboard
        </a>

        <a href="/spk_guru_saw/kepsek/penilaian.php">
            Input Penilaian
        </a>

        <a href="/spk_guru_saw/kepsek/hasil_penilaian.php">
            Hasil Penilaian
        </a>

        <a href="/spk_guru_saw/kepsek/pengesahan.php">
            Pengesahan
        </a>

        <a href="/spk_guru_saw/auth/logout.php">
            Logout
        </a>

    </div>

</div>