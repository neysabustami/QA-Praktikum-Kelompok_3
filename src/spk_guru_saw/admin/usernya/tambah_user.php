<?php
session_start();

include '../../config/koneksi.php';

if(isset($_POST['simpan'])){

    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Insert user baru ke database
    mysqli_query($koneksi,
    "INSERT INTO users (nama,username,password,role)
     VALUES ('$nama','$username','$password','$role')"
    );

    header("Location:user.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah User - SPK SAW</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <style>
        body{
            margin:0;
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: linear-gradient(135deg, #0f172a, #1e293b);
            color:#fff;
        }

        .container{
            padding:30px;
            display:flex;
            justify-content:center;
        }

        .card{
            width:100%;
            max-width:520px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.08);
            backdrop-filter: blur(10px);
            padding:25px;
            border-radius:15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }

        h2{
            text-align:center;
            margin:0 0 5px 0;
            font-size:24px;
        }

        .subtitle{
            text-align:center;
            font-size:13px;
            color:#94a3b8;
            margin-bottom:20px;
        }

        label{
            display:block;
            margin:10px 0 5px;
            font-size:14px;
            color:#cbd5e1;
        }

        input, select{
            width:100%;
            padding:10px 12px;
            border-radius:8px;
            border:1px solid rgba(255,255,255,0.1);
            background: rgba(15, 23, 42, 0.7);
            color:#fff;
            outline:none;
        }

        .password-box{
            position:relative;
        }

        .toggle-pass{
            position:absolute;
            right:10px;
            top:50%;
            transform:translateY(-50%);
            cursor:pointer;
            font-size:12px;
            color:#38bdf8;
            user-select:none;
        }

        button{
            width:100%;
            margin-top:20px;
            padding:10px;
            border:none;
            border-radius:8px;
            background:#38bdf8;
            color:#0f172a;
            font-weight:bold;
            cursor:pointer;
            transition:0.3s ease;
        }

        button:hover{
            background:#0ea5e9;
            transform: translateY(-2px);
        }

        /* TOMBOL KEMBALI */
        .btn-kembali{
            display:block;
            width:100%;
            margin-top:10px;
            padding:10px;
            border:1px solid rgba(255,255,255,0.1);
            border-radius:8px;
            background:transparent;
            color:#cbd5e1;
            font-weight:bold;
            text-align:center;
            text-decoration:none;
            transition:0.3s ease;
        }

        .btn-kembali:hover{
            background: rgba(255,255,255,0.05);
            color:#fff;
        }
    </style>
</head>

<body>

<?php include '../../template/menu_admin.php'; ?>

<div class="container">
    <div class="card">
        <h2>👤 Tambah User</h2>
        <div class="subtitle">Buat akun pengguna sistem SPK SAW</div>

        <form method="POST">
            <label>Nama</label>
            <input type="text" name="nama" required>

            <label>Username</label>
            <input type="text" name="username" required>

            <label>Password</label>
            <div class="password-box">
                <input type="password" name="password" id="password" required>
                <span class="toggle-pass" onclick="togglePassword()">lihat</span>
            </div>

            <label>Role</label>
            <select name="role" required>
                <option value="">-- Pilih Role --</option>
                <option value="admin">Admin</option>
                <option value="penilai">Penilai</option>
                <option value="kepsek">Kepala Sekolah</option>
                <option value="guru">Guru</option>
            </select>

            <button type="submit" name="simpan">
                Simpan User
            </button>
            
            <a href="user.php" class="btn-kembali">Kembali</a>
        </form>
    </div>
</div>

<script>
function togglePassword(){
    let pass = document.getElementById("password");
    let toggle = document.querySelector(".toggle-pass");

    if(pass.type === "password"){
        pass.type = "text";
        toggle.innerText = "sembunyi";
    }else{
        pass.type = "password";
        toggle.innerText = "lihat";
    }
}
</script>

</body>
</html>