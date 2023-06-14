<?php

$title = "Data Anggota Kost";
include("../config.php");
include("../templates/header.php");

?>

<link href="<?= base_url(); ?>/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-3 text-gray-800"><?= $title; ?></h1>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <a href="<?= base_url('anggota/tambah.php'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Anggota</a>
    </div>
    <div class="card-body">

      <?php if (isset($_SESSION['msg'])) {
        $message = $_SESSION['msg'];
        unset($_SESSION['msg']);
        echo $message;
      } ?>

      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $data_anggota = show("SELECT * FROM anggota_kost ORDER BY id DESC");
            foreach ($data_anggota as $key => $value) : ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $value['nama']; ?></td>
                <td>
                  <button type="button" class="btn btn-primary" onclick="edit('<?= $value['id']; ?>')"><i class="fas fa-edit"></i> Edit</button>
                  <button type="button" class="btn btn-danger" onclick="hapus('<?= $value['id']; ?>')"><i class="fa fa-trash-alt"></i> Hapus</button>
                </td>
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