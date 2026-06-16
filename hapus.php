<?php
require_once '../config/database.php';

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM member WHERE id=$id");

header("Location: ../index.php");