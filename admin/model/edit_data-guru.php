<?php 
ob_start();
require_once ('../../config/koneksi.php');
require_once ('../../models/database.php');
include "../model/m_data-guru.php";

$connection = new Database ($host, $user, $pass, $database);
$guru = new dataGuru($connection);

$nip = $_POST['induk'];
$nama =$connection->conn->real_escape_string($_POST['namaGuru']);
$jenkel =$connection->conn->real_escape_string($_POST['jenkel']);
$alamat =$connection->conn->real_escape_string($_POST['alamat']);
$telepon =$connection->conn->real_escape_string($_POST['telepon']);
// $namaortu =$connection->conn->real_escape_string($_POST['ortu']);
// $pekerjaan =$connection->conn->real_escape_string($_POST['pkj']);
// $alamat =$connection->conn->real_escape_string($_POST['almt']);
// $telepon =$connection->conn->real_escape_string($_POST['tlp']);

$guru->edit("UPDATE guru SET namaGuru = '$nama', jenisKelamin = '$jenkel', alamat = '$alamat', telepon = '$telepon' WHERE NIP = '$nip'");
echo "<script>window.location='?data-guru';</script>";

 ?>