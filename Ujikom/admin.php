<?php
    include "koneksi.php";
    $koneksi = mysqli_connect("localhost", "root", "", "kampus");


if ( isset($_POST["submit"])) {
if( inputDataBeasiswa($_POST) > 0) {
        echo "
        <script>
        alert(' Data Berhasil Ditambahkan! ');
        document.location.href = 'hasil.php';
        </script>
        ";
} else {
        echo "
        <script>
        alert(' data gagal ditambahkan! ');
        document.location.href = 'admin.php';
        </script>
        ";
}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
    </style>
    <title>Kampus</title>
</head>
<body>
  <header>
    <nav class="navbar sticky-top navbar-expand-lg bg-body-tertiary  shadow p-3 mb-3 rounded">
      <div class="container">
        <a class="navbar-brand" href="admin.html">Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav mx-auto">
            <a class="nav-link" aria-current="page" href="beasiswa.php">Pilihan Beasiswa</a>
            <a class="nav-link" href="admin.php">Daftar</a>
            <a class="nav-link" href="hasil.php">Hasil</a>
            </div>
            <div class="profile">
              <a href="logout.php" class="btn align-self-end login"></a>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <main>
        
        
        <?php 
                function inputDataBeasiswa($dataBeasiswa){
                global $koneksi;
                $nama = htmlspecialchars($dataBeasiswa["nama"]);
                $email = htmlspecialchars($dataBeasiswa["email"]);
                $no = htmlspecialchars($dataBeasiswa["no"]);
                $semester = htmlspecialchars($dataBeasiswa["semester"]);
                $ipk = htmlspecialchars($dataBeasiswa["ipk"]);
                $beasiswa = htmlspecialchars($dataBeasiswa["beasiswa"]);
                $status_ajuan = htmlspecialchars($dataBeasiswa["status_ajuan"]);
                $berkas = upload();

                $query = "INSERT INTO `tb_beasiswa` (`id_mhs`, `nama`, `email`, `no`, `semester`, `ipk`, `beasiswa`, `berkas`, `status_ajuan`) VALUES (NULL, '$nama', '$email', '$no', '$semester', '$ipk', '$beasiswa', '$berkas', '$status_ajuan') ";
                mysqli_query($koneksi, $query );

                return mysqli_affected_rows($koneksi);
                }


                    function upload(){
                    
                    $namaFile = $_FILES['berkas']['name'];
                    $ukuranFile = $_FILES['berkas']['size'];
                    $error = $_FILES['berkas']['error'];
                    $tmpName = $_FILES['berkas']['tmp_name'];

                                // cek
                                if($error === 4){
                                echo "<script>alert('pilih file terlebih dahulu')</script>";
                                return false;
                                }
                                        // cek
                                $ekstensifileValid = ['jpg', 'jpeg', 'png'];
                                $ekstensifile = explode('.' , $namaFile);
                                $ekstensifile = strtolower(end($ekstensifile));
                                if ( !in_array($ekstensifile , $ekstensifileValid)){
                                echo "<script>alert('yang anda upload bukan gambar')</script>";
                                return false;
                                }

                                //cek ukuran
                                if ($ukuranFile > 1500000){
                                echo "<script>alert('ukuran file terlalu besar')</script>";
                                return false;
                                }

                                move_uploaded_file($tmpName, 'assets/' . $namaFile);
                                return $namaFile;

                                }


                              
                                //Generate nilai IPK acak antara 2,9 dan 4
                                $nilai_ipk = rand(270, 350) / 100;

                                if ($nilai_ipk > 3) {
                                $background = 'btn-primary';
                                }elseif($nilai_ipk < 3){
                                $background = 'btn-secondary';}
                              
        ?>          


	<div class="container  d-flex justify-content-center">
  <div>
		<div class="col">
			<h4 class="text-center">Daftar Beasiswa</h4>
			<div class="panel panel-success">
				<div class="panel-heading">
				</div>
				<div class="panel-body">
        <form action="" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="nama" class="form-control" placeholder="Nama" id="nama" value="" required>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" class="form-control" placeholder="Email" id="email" value="" required>
					</div>
					<div class="form-group">
						<label>Nomor HP</label>
						<input type="number" name="no" class="form-control" placeholder="Nomor HP" id="no" onKeyPress="if(this.value.length==13) return false;" required>
					</div>
					<div>
						<label>Semester saat ini</label>
                    <select class="form-select" aria-label="Default select example" id="semester" name="semester" required>
                        <option selected style="display:none" value="">Pilih Semester</option>
                        <option value="Semester 1">Semester 1</option>
                        <option value="Semester 2">Semester 2</option>
                        <option value="Semester 3">Semester 3</option>
                        <option value="Semester 4">Semester 4</option>
                        <option value="Semester 5">Semester 5</option>
                        <option value="Semester 6">Semester 6</option>
                        <option value="Semester 7">Semester 7</option>
                        <option value="Semester 8">Semester 8</option>
                    </select>
					</div>
					<div class="form-group">
						<label>IPK Terakhir</label>
					<input type="text" name="ipk" class="form-control" placeholder="IPK Terakhir" id="ipk" value="<?php  echo $nilai_ipk;?>" required readonly>
					</div>
                    <div>
                    <label>Pilihan Beasiswa</label>
                    <select class="form-select mb-3" aria-label="Default select example" id="beasiswa" name="beasiswa" required <?php if($nilai_ipk < 3) echo 'disabled' ; ?> >
                        <option selected style="display:none" value="">Pilih Beasiswa</option>
                    <?php
                        $noBeasiswa = 1;
                        $pilihanBeasiswa = query("SELECT * FROM tb_pilihan_beasiswa WHERE status_beasiswa ='Aktif'");
                        foreach($pilihanBeasiswa as $dataPilihanBeasiswa){
                    ?>
                        <option value="<?php echo $dataPilihanBeasiswa['beasiswa']; ?>"><?php echo $dataPilihanBeasiswa['beasiswa']; ?></option>
                    <?php } ?>
                    </select>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control form-control-lg" type="file" placeholder="Pilih Berkas" name="berkas" id="berkas" required <?php if($nilai_ipk < 3) echo 'disabled' ; ?>>
                    <label for=""> Upload Berkas Syarat </label>
                    </div>
                    <div>
						<input type="hidden" name="status_ajuan" id="status_ajuan" value="Belum di Verifikasi">
					</div>
					<div class="form-group mb-3">
						<button type="submit" name="submit" class="btn <?php echo $background; ?>"  <?php if($nilai_ipk < 3) echo 'disabled' ; ?>> Daftar </button>
					</div>

					<div id="text-info"></div>
				</div>
			</div>
		</div>
    </form>
	</div>

    </main>

<footer class="bg-light text-center py-4">
    <div class="container">
    <p>Hak Cipta &copy; 2023 Nenda Alfadil Seputra. All rights reserved.</p>
    </div>
</footer>
<script src="js/bootstrap.min.js"></script>
</body>
</html>