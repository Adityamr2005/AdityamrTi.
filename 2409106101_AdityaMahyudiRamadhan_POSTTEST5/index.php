<?php
session_start();
include 'koneksi.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // 1️⃣ Cek login statis (manual)
    $default_username = "admin";
    $default_password = "123";

    if ($username === $default_username && $password === $default_password) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    }

    // 2️⃣ Cek login lewat database
    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' LIMIT 1");
    $data = mysqli_fetch_assoc($query);

    if ($data && password_verify($password, $data['password'])) {
        $_SESSION['username'] = $data['username'];
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login PT. Ebos Group</title>
    <link rel="stylesheet" href="2409106101_AdityaMahyudiRamadhan_POSTTEST5.css">
</head>
<body>
    <div class="login-container">
        <h2>Login PT. Ebos Group</h2>
        <?php if ($error): ?>
            <p style="color: red; font-weight: bold;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Masukkan username" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan password" required>
            </div>
            <button type="submit">Login</button>
        </form>

        <p style="margin-top: 15px; text-align: center;">
            <small>Gunakan <b>admin / 123</b> untuk login manual</small>
        </p>
    </div>
</body>
</html>