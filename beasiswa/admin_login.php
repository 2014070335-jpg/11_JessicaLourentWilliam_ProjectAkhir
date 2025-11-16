<?php
session_start();
include "koneksi.php";

$error = "";

if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $pass  = trim($_POST['password']);

    $sql = "SELECT * FROM admin WHERE email=? AND password=?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ss", $email, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows===1) {
        $_SESSION['admin'] = $email;
        header("Location: datamember.php");
        exit;
    } else {
        $error = "Email atau password salah!";
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Login Admin</title>

<style>
:root{--bg1:#071129;--bg2:#0f2949;--accent:#ff7a59;--muted:#cbd5e1}
*{box-sizing:border-box}
body{margin:0;font-family:'Poppins',sans-serif;background:linear-gradient(135deg,var(--bg1),var(--bg2));color:var(--muted);min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px}
.card{width:100%;max-width:420px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.06);backdrop-filter:blur(6px);border-radius:14px;padding:28px;box-shadow:0 12px 40px rgba(3,10,30,0.5)}
h1{text-align:center;color:#fff;font-size:22px;margin-bottom:12px}
label{display:block;margin-top:12px;margin-bottom:6px;color:#e8f0ff}
input{width:100%;padding:10px;
    border-radius:8px;background:rgba(0,0,0,0.18);
    border:1px solid rgba(255,255,255,0.06);
    color:white}
input:focus{border-color:var(--accent)}
.btn{width:100%;
    margin-top:20px;
    padding:12px;border:none;
    border-radius:10px;background:linear-gradient(90deg,var(--accent),#ffb085);
    color:#082033;
    font-weight:700;
    cursor:pointer}
.alert{padding:12px;background:rgba(255,0,0,0.15);color:#ff6b6b;border-radius:10px;margin-bottom:10px}
.center{text-align:center;margin-top:12px}
a{text-decoration:none;color:var(--accent);font-weight:600}
</style>

</head>
<body>

<div class="card">

<h1>Login Admin</h1>

<?php if($error): ?>
    <div class="alert"><?= $error ?></div>
<?php endif; ?>

<form method="POST">

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <button class="btn" name="login">Masuk</button>

</form>

<div class="center">
    <a href="admin_regist.php">Buat akun admin</a>
</div>

</div>

</body>
</html>


