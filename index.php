<?php
require_once 'config/database.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
header("Location: admin/login.php");
exit;
}

$data = mysqli_query($koneksi, "SELECT * FROM member ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Gym Membership</title>
<link rel="stylesheet" href="CSS/style.css">



</head>
<body>

<div class="container">

<h1>Gym Membership</h1>
<div class="con-tmbl">
<a class="tambah" href="admin/dashboard.php">Dashboard</a><br>
<a class="tambah" href="admin/tambah.php">+ Tambah Member</a>
</div>

<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Paket</th>
            <th>Tanggal Daftar</th>
            <th>Expired</th>
            <th>Aksi</th>
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
                <a class="edit" href="admin/edit.php?id=<?= $row['id'] ?>">Edit</a>
                <a class="hapus" href="admin/hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Hapus data?')">Hapus</a>
            </td>
        </tr>

    <?php endwhile; ?>

    </tbody>
</table>

</div>

</body>
</html>