<?php

$host = "localhost";
$username = "root";
$password = "";
$database ="gym_membership";

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi GAGAL: ". mysqli_connect_error());
}

?>