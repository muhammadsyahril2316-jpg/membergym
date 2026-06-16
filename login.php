<?php

session_start();

if(isset($_SESSION['admin_id'])) {
    header("Location: dashboard.php");
    exit;
}

require_once '../config/database.php';


$eror = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($koneksi, $query);
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_nama'] = $user['nama'];
        
        header("Location: dashboard.php");
        exit;
        } else {
            $error = " Username atau password salah!";        
            }
    }
    ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <main>
    <div style="max-width:400px;margin:80px auto;backrground:#1e293b;padding:40px;border-radius:16px;border:2px solid #000000;text-align:center;">
        <div style="font-size:3rem;" ></div>
        <h1 style="color:black;font-size:1.5rem;">Login Admin</h1>

        <?php if ($error =" ") : ?>
            <div style="background:#ff0000;color:white;padding:10px;border-radius:8px;margin-bottom:15px;font-size:.85rem;">
                <?php echo $error; ?>
            </div>
            <?php endif ; ?>

            <form method="POST" style="text-align:left;">
                <label>Username:</label>
                <input type="text" name="username" placeholder="admin" required>
                <label> Password:</label>
                <input type="password" name="password" placeholder="......" required>
                <button type="submit" style="width:100%;margin-top:20px;">Masuk</button>
        </form>
        </div>  
  </main>  
</body></html>