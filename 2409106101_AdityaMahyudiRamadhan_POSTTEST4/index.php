<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Tangkap pesan dari URL jika ada
$message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard PT. Ebos Group</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef1f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .container {
            margin: 30px auto;
            max-width: 600px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .message {
            color: green;
            text-align: center;
            margin-bottom: 15px;
        }
        .logout {
            text-align: center;
            margin-top: 20px;
        }
        .logout a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #f44336;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }
        .logout a:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
     <div class="login-container">
     <h2>Login PT. Ebos Group</h2>
     <?php if ($error): ?>
        <p class="error"><?php echo $error; ?></p>
     <?php endif; ?>
        
     <form method="POST" action="login.php">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>

<header>
    <h1>Selamat Datang di PT. Ebos Group</h1>
</header>

<div class="container">
    <?php if ($message): ?>
        <p class="message"><?= $message; ?></p>
    <?php endif; ?>

    <h2>Halo, <?= htmlspecialchars($_SESSION['username']); ?>!</h2>
    <p>Anda sekarang berada di halaman Dashboard utama.  
    Silakan gunakan menu yang tersedia untuk mengelola data atau melakukan aktivitas lainnya.</p>

    <div class="logout">
        <a href="logout.php">Logout</a>
    </div>
</div>

</body>
</html>
