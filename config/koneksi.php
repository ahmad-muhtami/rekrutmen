<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "db_rekrutmen";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
  echo "Koneksi Gagal";
}
