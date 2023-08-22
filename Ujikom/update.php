<!-- UPDATE PILIHAN BEASISWA --!>
<?php
include "koneksi.php";
if ($_SERVER["REQUEST_METHOD"] === "POST")  {
  // Mendapatkan data yang dikirim melalui metode POST
$id_beasiswa = $_POST['id_beasiswa'];
$beasiswa = $_POST['beasiswa'];
$status_beasiswa = $_POST['status_beasiswa'];
// Mengeksekusi query untuk memperbarui data buku

$sql_update = "UPDATE tb_pilihan_beasiswa SET beasiswa = '$beasiswa', status_beasiswa = '$status_beasiswa' WHERE id_beasiswa = '$id_beasiswa'";
$result = mysqli_query($koneksi, $sql_update);
header("Location: beasiswa.php");
exit;
}
?>
<!-- AKHIR UPDATE PILIHAN BEASISWA --!>

