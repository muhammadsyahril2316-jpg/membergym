<?php
require_once '../config/database.php';

session_start();
// Nyalakan mesin gelang
// Cek: punya gelang VIP? Kalau tidak, tendang ke login!
if (!isset($_SESSION['admin_id'])) {
header("Location: login.php");
exit;
}

if(isset($_POST['simpan'])){

    $nama = $_POST['nama'];
    $paket = $_POST['paket'];

    $tanggal_daftar = date('Y-m-d');
    $expired = date('Y-m-d', strtotime("+$paket month"));

    mysqli_query($koneksi, "
        INSERT INTO member (nama, paket, tanggal_daftar, expired)
        VALUES ('$nama', '$paket', '$tanggal_daftar', '$expired')
    ");

    header("Location: ../index.php");
}
?>

<div class="tmb-d">
<form method="POST">
    <h2>Tambah Member</h2>
    <input type="text" name="nama" placeholder="Nama" required>
    <link rel="stylesheet" href="../css/style.css">

    <select name="paket">
        <option value="1">1 Bulan</option>
        <option value="3">3 Bulan</option>
        <option value="6">6 Bulan</option>
        <option value="12">12 Bulan</option>
    </select>

    <button type="submit" name="simpan">Simpan</button>
    <a href="../index.php">Kembali Ke Awal</a>
</form>
</div>