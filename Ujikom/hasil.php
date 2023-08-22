<?php 
require 'koneksi.php';

?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Kampus</title>
</head>
<header>
    <nav class="navbar sticky-top navbar-expand-lg bg-body-tertiary  shadow p-3 mb-3 rounded">
    <div class="container">
    <a class="navbar-brand" href="admin.php">Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav mx-auto">
            <a class="nav-link" aria-current="page" href="beasiswa.php">Pilihan Beasiswa</a>
            <a class="nav-link" href="admin.php">Daftar</a>
            <a class="nav-link" href="hasil.php">Hasil</a>
        <div class="profile">
        <a href="login.php" class="btn align-self-end login"></a>
        </div>
    </div>
    </div>
    </div>
</nav>
</header>

<body>
<!-- Buku Popular -->

<div class="dataHasil">
<div class="row">
<div class="col">
    <div class="white-box">
    <div class="d-md-flex mb-3">
        <h3 class="box-title ms-5">Data Daftar Mahasiswa</h3>
        <div class="col-md-3 col-sm-4 col-xs-6 ms-auto">
        </div>
        </div>
        <div class="table-responsive">
        <table class="table no-wrap">
        <thead>
            <tr>
            <th class="border-top-0">Id</th>
            <th class="border-top-0">Nama</th>
            <th class="border-top-0">Email</th>
            <th class="border-top-0">No HP</th>
            <th class="border-top-0">Semester</th>
            <th class="border-top-0">IPK</th>
            <th class="border-top-0">Beasiswa</th>
            <th class="border-top-0">Berkas</th>
            <th class="border-top-0">Status Ajuan</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $Yes = "Diterima";
            $No = "Tidak Diterima";

            $no = 1;
            $hasil = query("SELECT * FROM `tb_beasiswa` ORDER BY id_mhs DESC");
            foreach($hasil as $dataHasil){
        ?>
            <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $dataHasil['nama']; ?></td>
            <td><?php echo $dataHasil['email']; ?></td>
            <td><?php echo $dataHasil['no']; ?></td>
            <td><?php echo $dataHasil['semester']; ?></td>
            <td><?php echo $dataHasil['ipk']; ?></td>
            <td><?php echo $dataHasil['beasiswa']; ?></td>
            <td><img src="assets/<?php echo $dataHasil['berkas']; ?>"
                    class="card-img-top"
                    alt="..."
                    style="max-width : 50px; height: auto;"/></td>
            <?php 
                        $status_ajuan = $dataHasil['status_ajuan'];
            $background = "";
            if ($status_ajuan === 'Belum di Verifikasi') {
                $background = 'btn-warning';
            }elseif($status_ajuan === 'Diterima'){
                $background = 'btn-success';
            }elseif($status_ajuan === 'Tidak Diterima'){
                $background = 'btn-danger';
            }
            ?>
            <td> <a data-bs-toggle="modal" data-bs-target="#editModal<?= $no ?>" data-id="<?php echo $status_ajuan; ?>" type="button" class="btn <?php echo $background ?>"><?php echo $dataHasil['status_ajuan'];?></a>
            </td>
            </tr>

            <!-- Modal Hapus -->
                <div class="modal fade" id="deleteModal<?= $no ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Hapus Data Mahasiswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <p>Anda yakin ingin menghapus data ini?</p>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <a href='deleteHasil.php?id_mhs="<?php echo $dataHasil['id_mhs']; ?>"' type="button" class="btn btn-danger">Hapus</a>
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
                    <h5 class="modal-title" id="editModalLabel">KONFIRMASI</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form action="updateHasil.php" method="POST">
                        <div class="">
                        <input type="hidden" name="id_mhs" id="id_mhs" value="<?= $dataHasil['id_mhs']; ?>">
                        </div>
                        <div class="">
                        <label for="status_ajuan" class="form-label">Status Ajuan</label>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="status_ajuan" id="status_ajuan" value="Diterima" checked>
                        <label class="form-check-label" for="status_ajuan">
                            <?php echo $Yes ?>
                        </label>
                        </div>
                        
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="status_ajuan" id="status_ajuan" value="Tidak Diterima">
                        <label class="form-check-label" for="status_ajuan">
                            <?php echo $No ?>
                        </label>
                        </div>

                        <div class="modal-footer">
                        <button name="ubah" type="button" class="btn btn-secondary text-"
                            data-bs-dismiss="modal">Tutup</button>
                        <button data-bs-toggle="modal" data-bs-target="#deleteModal<?= $no ?>" data-id="<?php echo $dataHasil['id_mhs']; ?>" type="button"
                                            class="btn btn-danger">Hapus</button>
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
    </div>
</div>
</div>
</div>


<!-- Akhir Buku Popular -->


<footer class="bg-light text-center py-4">
    <div class="container">
    <p>Hak Cipta &copy; 2023 Nenda Alfadil Seputra. All rights reserved.</p>
    </div>
</footer>
<script src="js/bootstrap.min.js"></script>
</body>

</html>

</body>

</html>