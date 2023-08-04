<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "fit_club";

try {
  $dbh = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conn = mysqli_connect("$host", "$user", "$pass", "$db");
} catch (PDOException $e) {
  die("Koneksi Gagal: " . $e->getMessage());
}

function query($query)
{
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function cekUserLogin()
{
  session_start();
  if (!isset($_SESSION["loginUser"])) {
    header("Location: login.php");
    exit;
  }
}

function cekAdminLogin()
{
  session_start();
  if (!isset($_SESSION["loginAdmin"])) {
    header("Location: ../login.php");
    exit;
  }
}

function uploadGambar($namaGambar)
{
  $namaFile = $_FILES["$namaGambar"]['name'];
  $ukuranFile = $_FILES["$namaGambar"]['size'];
  $error = $_FILES["$namaGambar"]['error'];
  $tmpName = $_FILES["$namaGambar"]['tmp_name'];


  if ($error === 4) {
    echo  "<script>
              alert('Pilih gambar dulu');
          </script>";
    return false;
  }


  $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
  $ekstensiGambar = explode('.', $namaFile);
  $ekstensiGambar = strtolower(end($ekstensiGambar));
  if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
    echo    "<script>
                  alert('yg di upload bukan gambar!');
              </script>";
    return false;
  }

  if ($ukuranFile > 10000000) {
    echo    "<script>
                  alert('Ukuran gambar terlalu besar');
              </script>";
    return false;
  }

  $namaFileBaru = uniqid();
  $namaFileBaru .= '.';
  $namaFileBaru .= $ekstensiGambar;
  move_uploaded_file($tmpName, 'images/pay/' . $namaFileBaru);
  return $namaFileBaru;
}
