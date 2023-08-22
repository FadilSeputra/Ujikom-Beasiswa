<?php
    include "koneksi.php";
    $koneksi = mysqli_connect("localhost", "root", "", "kampus");


if ( isset($_POST["submit"])) {
if( inputDataBeasiswa($_POST) > 0) {
  echo "
  <script>
  alert(' Data Berhasil Ditambahkan! ');
  document.location.href = 'beasiswa.php';
  </script>
  ";
} else {
  echo "
  <script>
  alert(' data gagal ditambahkan! ');
  document.location.href = 'beasiswa.php';
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
                $beasiswa = htmlspecialchars($dataBeasiswa["beasiswa"]);
                $status_beasiswa = htmlspecialchars($dataBeasiswa["status_beasiswa"]);
                $sql = mysqli_query($koneksi, "SELECT * FROM tb_pilihan_beasiswa WHERE beasiswa = '$beasiswa'");
                if(mysqli_fetch_assoc($sql)){
                  echo "
                  <script>
                  alert(' Beasiswa Sudah Tersedia ');
                  document.location.href = 'beasiswa.php';
                  </script>
                  ";
                  return false;
                }
                $query = "INSERT INTO `tb_pilihan_beasiswa` (`id_beasiswa`, `beasiswa`, `status_beasiswa`) VALUES (NULL, '$beasiswa', '$status_beasiswa') ";
                mysqli_query($koneksi, $query );

                return mysqli_affected_rows($koneksi);
                }
        ?>      
<div>    

<div class="row justify-content-around">
    <div class="col-4">
        <h4 class="text-center">Daftar Beasiswa</h4>
        <table class="table">
<thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Beasiswa</th>
        <th scope="col">Status Beasiswa</th>
        <th scope="col" colspan="2">Action</th>
    </tr>
</thead>
    <tbody>
    <?php
            $no = 1;
            $pilihanBeasiswa = query("SELECT * FROM `tb_pilihan_beasiswa`");
            foreach($pilihanBeasiswa as $dataPilihanBeasiswa){
        ?>
            <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $dataPilihanBeasiswa['beasiswa']; ?></td>
            <td><?php echo $dataPilihanBeasiswa['status_beasiswa']; ?></td>
            <td>
            <a data-bs-toggle="modal" data-bs-target="#editModal<?= $no ?>" data-id="<?php echo $dataPilihanBeasiswa['id_beasiswa']; ?>" type="button"
                    class="btn btn-primary">Edit</a>
            </td>
            
            <td>
            <a data-bs-toggle="modal" data-bs-target="#deleteModal<?= $no ?>" data-id="<?php echo $dataPilihanBeasiswa['id_beasiswa']; ?>" type="button"
                    class="btn btn-danger">Hapus</a>
            </tr>



              <!-- Modal Hapus -->
                <div class="modal fade" id="deleteModal<?= $no ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Hapus Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <p>Anda yakin ingin menghapus buku ini?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <a href='delete.php?id_beasiswa="<?php echo $dataPilihanBeasiswa['id_beasiswa']; ?>"' type="button" class="btn btn-danger">Hapus</a>
                      </div>
                    </div>
                  </div>
                </div>

                        <!-- Awal Modal Edit -->
              <div class="modal fade" id="editModal<?= $no ?>" tabindex="-1" aria-labelledby="editModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="editModalLabel">Edit Buku</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="update.php" method="POST">
                        <div class="mb-3">
                          <input type="hidden" name="id_beasiswa" id="id_beasiswa" value="<?= $dataPilihanBeasiswa['id_beasiswa']; ?>">
                          <label for="beasiswa" class="form-label">Judul</label>
                          <input type="text" class="form-control" id="beasiswa" name="beasiswa"
                            value="<?php echo $dataPilihanBeasiswa['beasiswa']; ?>">
                        </div>
                        <div class="mb-3">
                        <label for="status_beasiswa" class="form-label">Deskripsi</label>
                          <div class="form-check">
                          <input class="form-check-input" type="radio" name="status_beasiswa" id="status_beasiswa" value="Aktif" checked>
                          <label class="form-check-label" for="status_beasiswa">
                            Aktif
                          </label>
                          </div>
                          
                          <div class="form-check">
                          <input class="form-check-input" type="radio" name="status_beasiswa" id="status_beasiswa" value="Tidak Aktif">
                          <label class="form-check-label" for="status_beasiswa">
                            Tidak Aktif
                          </label>
                          </div>

                        <div class="modal-footer">
                          <button name="ubah" type="button" class="btn btn-secondary text-"
                            data-bs-dismiss="modal">Tutup</button>
                          <button class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal Edit Akhir -->




            <?php } ?>
    </tbody>
</table>

    </div>

    <div class="col-4">
    <h4 class="text-center">Daftar Beasiswa</h4>
<div class="panel panel-success">
	<div class="panel-heading">
				</div>
				<div class="panel-body">
        <form action="" method="post" enctype="multipart/form-data">
					<div class="form-group mb-3">
						<label>Nama Beasiswa</label>
						<input type="text" name="beasiswa" class="form-control" placeholder="Nama" id="beasiswa" value="" required>
					</div>
						<input type="hidden" name="status_beasiswa" id="status_beasiswa" value="Aktif">
					</div>
					<div class="form-group">
						<button type="submit" name="submit" class="btn btn-primary send"> Tambah Data </button>
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