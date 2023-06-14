<?php

include "config.php";

if (isset($_POST['rfid_code'])) {
  $rfid_code = $_POST['rfid_code'];
  $cekAnggota = show("SELECT * FROM anggota_kost WHERE rfid_code='$rfid_code'");
  if (!$cekAnggota) {
    header('Content-Type: application/json');
    http_response_code(401);
    exit(json_encode([
      'error' => "Anda belum terdaftar!"
    ]));
  }

  // insert data
  $tanggal = date('Y-m-d H:i:s');
  $id = $cekAnggota[0]['id'];
  $query = "INSERT INTO `masuk_kost` (`id`, `anggotaid`, `tanggal`) VALUES (NULL, '$id', '$tanggal')";
  $conn->query($query);

  header('Content-Type: application/json');
  http_response_code(200);
  echo json_encode([
    'message' => "Anda berhasil masuk"
  ]);
} else {
  header('Content-Type: application/json');
  http_response_code(400);
  echo json_encode([
    'error' => "Rfid code kosong!"
  ]);
}

$conn->close();
