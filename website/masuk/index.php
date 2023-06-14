<?php

$title = "Data Masuk Kost";
include("../config.php");
include("../templates/header.php");

$tanggal = "";
$data = show("SELECT a.nama, m.tanggal FROM anggota_kost as a JOIN masuk_kost as m ON a.id=m.anggotaid ORDER BY m.tanggal DESC");

if (isset($_POST['cari'])) {
  $tanggal = $_POST['tanggal'];
  $data = show("SELECT a.nama, m.tanggal FROM anggota_kost as a JOIN masuk_kost as m ON a.id=m.anggotaid WHERE DATE_FORMAT(m.tanggal, '%Y-%m-%d') = '$tanggal' ORDER BY m.tanggal DESC");
}

cek_login();
?>

<link href="<?= base_url(); ?>/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-3 text-gray-800"><?= $title; ?></h1>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header">
      <form action="" method="post">
        <div class="input-group">
          <input type="date" class="form-control" name="tanggal" value="<?= $tanggal; ?>" required>
          <div class="input-group-append">
            <button class="btn btn-primary" type="submit" name="cari"><i class="fa fa-search"></i> Tampilkan</button>
          </div>
        </div>
      </form>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Tanggal</th>
              <th>Nama</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($data as $key => $value) : ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= date('d F Y H:i:s', strtotime($value['tanggal'])); ?> </td>
                <td><?= $value['nama']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->


<!-- Page level custom scripts -->
<script src="<?= base_url(); ?>/assets/js/demo/datatables-demo.js"></script>
<!-- Page level plugins -->
<script src="<?= base_url(); ?>/assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>


<script>
  function hapus(id) {
    $confirm = confirm("Apakah anda yakin menghapus data ini ?");
    if ($confirm) {
      window.location.href = "<?= base_url('anggota/hapus.php?id='); ?>" + id;
    }
  }

  function edit(id) {
    window.location.href = "<?= base_url('anggota/edit.php?id='); ?>" + id;
  }
</script>

<?php include('../templates/footer.php'); ?>