<?php
require_once '../config/database.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
header("Location: login.php");
exit;
}

$total = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM member"))['total'];


$aktif = mysqli_fetch_assoc(mysqli_query($koneksi, "
    SELECT COUNT(*) as total FROM member 
    WHERE expired >= CURDATE()
"))['total'];


$expired = mysqli_fetch_assoc(mysqli_query($koneksi, "
    SELECT COUNT(*) as total FROM member 
    WHERE expired < CURDATE()
"))['total'];


$data = mysqli_query($koneksi, "SELECT * FROM member ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Gym</title>
<link rel="stylesheet" href="../CSS/style.css">





</head>
<body>

<div class="container">

<h1>Dashboard Gym Membership</h1>
<div class="con-tmbl">
<a class="btn" href="tambah.php">Kelola Member Baru</a>
<a class="btn" href="logout.php">Logout</a>
</div>

<div class="card">

    <div class="box">
        <h2><?= $total ?></h2>
        <p>Total Member</p>
    </div>

    <div class="box">
        <h2><?= $aktif ?></h2>
        <p>Member Aktif</p>
    </div>

    <div class="box">
        <h2><?= $expired ?></h2>
        <p>Member Expired</p>
    </div>

</div>

<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Paket</th>
            <th>Daftar</th>
            <th>Expired</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>

    <?php while($row = mysqli_fetch_assoc($data)) : ?>

        <tr>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['paket'] ?> Bulan</td>
            <td><?= date('d/m/Y', strtotime($row['tanggal_daftar'])) ?></td>
            <td><?= date('d/m/Y', strtotime($row['expired'])) ?></td>
            <td>
                <?php if ($row['expired'] >= date('Y-m-d')) : ?>
                    <span style="color:green;">Aktif</span>
                <?php else : ?>
                    <span style="color:red;">Expired</span>
                <?php endif; ?>
            </td>
        </tr>

    <?php endwhile; ?>

    </tbody>
</table>

</div>

</body>
</html>