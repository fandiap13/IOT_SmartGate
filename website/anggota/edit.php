<?php

include("../config.php");
$id = $_GET['id'];

if (!$id) {
  header("location: " . base_url('anggota'));
}

$cekAnggota = show("SELECT * FROM anggota_kost WHERE id = $id")[0];
if (!$cekAnggota) {
  $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">
              Anggota dengan nama <strong>' . $cekAnggota['nama'] . '</strong> tidak ditemukan!
            </div>';
  header("location: " . base_url('anggota'));
}

if (isset($_POST['simpan'])) {
  $nama = $_POST['nama'];
  $rfid_code = $_POST['rfid_code'];

  $query = mysqli_query($conn, "UPDATE `anggota_kost` SET `rfid_code` = '$rfid_code', `nama` = '$nama' WHERE `anggota_kost`.`id` = '$id'");
  if ($query) {
    $_SESSION['msg'] = '<div class="alert alert-success" role="alert">
              Anggota berhasil diubah
            </div>';
  } else {
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">
              Anggota gagal diubah
            </div>';
  }
  header("location: " . base_url('anggota'));
}


$title = "Edit Anggota Kost";
include("../templates/header.php");

?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-3 text-gray-800"><?= $title; ?></h1>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header">
      <a href="<?= base_url("anggota"); ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body">
      <form action="" method="post">
        <div class="form-group">
          <label for="rfid_code">RFID Scan</label>
          <input type="text" name="rfid_code" id="rfid_code" class="form-control" value="<?= $cekAnggota['rfid_code']; ?>" required autofocus>
        </div>
        <div class="form-group">
          <label for="nama">Nama</label>
          <input type="text" name="nama" id="nama" class="form-control" value="<?= $cekAnggota['nama']; ?>" required>
        </div>
        <div class="form-group">
          <button class="btn btn-block btn-primary" name="simpan"><i class="fas fa-save"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /.container-fluid -->


<?php include('../templates/footer.php'); ?>