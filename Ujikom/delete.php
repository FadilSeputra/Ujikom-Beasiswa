<?php 

require 'koneksi.php';

    if(isset($_GET['id_beasiswa'])){
        $delete = "DELETE FROM tb_pilihan_beasiswa WHERE id_beasiswa = " . $_GET['id_beasiswa'];

        mysqli_query($koneksi, $delete);
        header("location: beasiswa.php");
    }
?>