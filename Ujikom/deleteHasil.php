<?php 

require 'koneksi.php';

    if(isset($_GET['id_mhs'])){
        $delete = "DELETE FROM tb_beasiswa WHERE id_mhs = " . $_GET['id_mhs'];

        mysqli_query($koneksi, $delete);
        header("location: hasil.php");
    }
?>