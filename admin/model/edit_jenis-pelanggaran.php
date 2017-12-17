<?php 
ob_start();
require_once ('../../config/koneksi.php');
require_once ('../../models/database.php');
include "m_jenis-pelanggaran.php";

$connection = new Database ($host, $user, $pass, $database);
$jenpel = new jenisPelanggaran($connection);

$id = $_POST['idPelanggaran'];
$nama =$connection->conn->real_escape_string($_POST['namapel']);
$poin =$connection->conn->real_escape_string($_POST['poin']);

$jenpel->edit("UPDATE jenispelanggaran SET namaPelanggaran = '$nama',poin = '$poin' WHERE idPelanggaran = '$id'");
echo "<script>window.location='?jenis-pelanggaran';</script>";

 ?>