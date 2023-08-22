<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "kampus";

function query($query) {
  global $koneksi;
  $result = mysqli_query($koneksi, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}
// Buat koneksi
$koneksi = mysqli_connect($hostname, $username, $password, $database);

// Periksa koneksi
if (!$koneksi) {
    die("Koneksi Tidak Berhasil: " . mysqli_connect_error());
}
?>