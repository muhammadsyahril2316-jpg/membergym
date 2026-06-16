<?php
require_once '../config/database.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
header("Location: login.php");
exit;
}

$id = $_GET['id'];

$data = mysqli_query($koneksi, "SELECT * FROM member WHERE id=$id");
$row = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $nama = $_POST['nama'];
    $paket = $_POST['paket'];

    $expired = date('Y-m-d', strtotime("+$paket month"));

    mysqli_query($koneksi, "
        UPDATE member SET
        nama='$nama',
        paket='$paket',
        expired='$expired'
        WHERE id=$id
    ");

    header("Location: ../index.php");
}
?>


<div class="tmb-d">
<form method="POST">
<h2>Edit Member</h2>
    <input type="text" name="nama" value="<?= $row['nama'] ?>">
    <link rel="stylesheet" href="../CSS/style.css">

    <select name="paket">
        <option value="1">1 Bulan</option>
        <option value="3">3 Bulan</option>
        <option value="6">6 Bulan</option>
        <option value="12">12 Bulan</option>
    </select>

    <button type="submit" name="update">Update</button>
    <a href="../index.php">Kembali Ke Awal</a>
    


</form>
</div>