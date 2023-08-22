<!-- UPDATE HASIL --!>

<?php
include "koneksi.php";
if ($_SERVER["REQUEST_METHOD"] === "POST")  {
  // Mendapatkan data yang dikirim melalui metode POST
$id_mhs = $_POST['id_mhs'];
$status_ajuan = $_POST['status_ajuan'];
// Mengeksekusi query untuk memperbarui data buku

$sql_update = "UPDATE tb_beasiswa SET status_ajuan = '$status_ajuan' WHERE id_mhs = '$id_mhs'";
$result = mysqli_query($koneksi, $sql_update);
header("Location: hasil.php");
exit;
}
?>

<!-- AKHIR UPDATE HASIL --!>