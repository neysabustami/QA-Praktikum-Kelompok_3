<!DOCTYPE html>
<html>

<head>
<title>Login SPK Guru</title>

<style>

body {
    margin: 0;
    font-family: 'Segoe UI', Tahoma, sans-serif;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #0f172a, #1e293b);
    overflow: hidden;
}

/* decorative glow */
body::before,
body::after {
    content: "";
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    z-index: 0;
}

body::before {
    width: 420px;
    height: 420px;
    background: rgba(56, 189, 248, 0.15);
    top: -120px;
    left: -120px;
}

body::after {
    width: 350px;
    height: 350px;
    background: rgba(99, 102, 241, 0.12);
    bottom: -120px;
    right: -120px;
}

/* LOGIN BOX */
.login-box {
    width: 380px;
    background: rgba(255, 255, 255, 0.06);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    padding: 40px;
    border-radius: 16px;
    border: 1px solid rgba(255,255,255,0.08);
    box-shadow: 0 15px 40px rgba(0,0,0,0.4);
    color: #e2e8f0;
    position: relative;
    z-index: 2;
}

/* TITLE */
.login-box h2 {
    text-align: center;
    margin-bottom: 25px;
    font-size: 22px;
    color: #38bdf8;
    font-weight: 700;
}

/* LABEL */
label {
    display: block;
    margin-top: 15px;
    font-size: 13px;
    color: #cbd5e1;
}

/* INPUT BOX */
.input-box {
    position: relative;
    width: 100%;
}

/* INPUT */
input {
    width: 100%;
    padding: 12px;
    margin-top: 6px;
    border-radius: 10px;
    border: 1px solid rgba(255,255,255,0.08);
    outline: none;
    font-size: 14px;
    background: rgba(15, 23, 42, 0.7);
    color: #fff;
    box-sizing: border-box;
}

/* FOCUS */
input:focus {
    border-color: #38bdf8;
}

/* TOGGLE PASSWORD */
.toggle-password {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 16px;
    color: #94a3b8;
}

/* BUTTON */
button {
    width: 100%;
    margin-top: 25px;
    padding: 12px;
    border: none;
    border-radius: 10px;
    background: #38bdf8;
    color: #0f172a;
    font-size: 15px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.2s ease;
}

/* HOVER TIDAK BERLEBIHAN */
button:hover {
    transform: translateY(-1px);
    opacity: 0.9;
}

/* FOOTER */
.footer-text {
    text-align: center;
    margin-top: 18px;
    font-size: 12px;
    color: #94a3b8;
}

</style>

</head>

<body>

<div class="login-box">

<h2>🔐 SPK Guru Login</h2>

<form action="proses_login.php" method="POST">

<label>Username</label>
<div class="input-box">
    <input type="text" name="username" required>
</div>

<label>Password</label>
<div class="input-box">
    <input type="password" id="password" name="password" required>
    <span class="toggle-password" onclick="togglePassword()">👁️</span>
</div>

<button type="submit">Masuk</button>

</form>

<div class="footer-text">
Sistem Pendukung Keputusan • SAW Method
</div>

</div>

<script>
function togglePassword() {
    var pass = document.getElementById("password");
    pass.type = (pass.type === "password") ? "text" : "password";
}
</script>

</body>

</html>