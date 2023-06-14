<?php

session_start();

$dbName = "db_kemanan_kost";
$dbUsername = "root";
$dbPassword = "";
$dbHost = "localhost";

$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

date_default_timezone_set('Asia/Jakarta');

function base_url($url = null)
{
  if ($url != null) {
    return "http://localhost/keamanan-kost/" . $url;
  }
  return "http://localhost/keamanan-kost/";
}

function show($data)
{
  global $conn;
  $query = mysqli_query($conn, $data);
  $rows = [];
  while ($row = mysqli_fetch_assoc($query)) {
    $rows[] = $row;
  }
  return $rows;
}

function cek_login()
{
  if (empty($_SESSION['is_login']) || !$_SESSION['is_login']) {
    header("location: " . base_url('login.php'));
  }
}
