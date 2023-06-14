<?php

include "../config.php";

$id = $_GET['id'];

if ($id) {
  $cekAnggota = show("SELECT * FROM anggota_kost WHERE id = $id")[0];
  if (!$cekAnggota) {
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">
              Anggota dengan nama <strong>' . $cekAnggota['nama'] . '</strong> tidak ditemukan!
            </div>';
    header("location: " . base_url('anggota'));
  }

  $query = mysqli_query($conn, "DELETE FROM anggota_kost WHERE id ='$id'");
  if (!$query) {
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">
              Anggota dengan nama <strong>' . $cekAnggota['nama'] . '</strong> gagal dihapus!
            </div>';
  } else {
    $_SESSION['msg'] = '<div class="alert alert-success" role="alert">
              Anggota dengan nama <strong>' . $cekAnggota['nama'] . '</strong> berhasil dihapus!
            </div>';
  }
  header("location: " . base_url('anggota'));
} else {
  header("location: " . base_url('anggota'));
}
