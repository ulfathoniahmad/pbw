<?php 
ob_start();
require_once ('../../config/koneksi.php');
require_once ('../../models/database.php');
include "../model/m_data-siswa.php";

$connection = new Database ($host, $user, $pass, $database);
$ssw = new dataSiswa($connection);

$nis = $_POST['induk'];
$nama =$connection->conn->real_escape_string($_POST['nama']);
$jenkel =$connection->conn->real_escape_string($_POST['jenkel']);
$tempat =$connection->conn->real_escape_string($_POST['tpt']);
$tgl =$connection->conn->real_escape_string($_POST['tgl']);

$ssw->edit("UPDATE siswa SET nama = '$nama', kelamin = '$jenkel', tempatLahir = '$tempat', tglLahir = '$tgl' WHERE NIS = '$nis'");
echo "<script>window.location='?data-siswa';</script>";

 ?>