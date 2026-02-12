<?php

$host = "srv616.hstgr.io";
$user = "u195878744_rekrutmen";
$pass = "RekrutmenHatara111";
$db = "u195878744_rekrutmen";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
  echo "Koneksi Gagal";
}
