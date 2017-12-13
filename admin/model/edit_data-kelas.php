<?php 
ob_start();
require_once ('../../config/koneksi.php');
require_once ('../../models/database.php');
include "../model/m_data-kelas.php";

$connection = new Database ($host, $user, $pass, $database);
$kelas = new dataKelas($connection);

$idKelas = $_POST['idkelas'];
$namakelas =$connection->conn->real_escape_string($_POST['namkel']);
$jumlahsiswa =$connection->conn->real_escape_string($_POST['jumlahsiswa']);

$kelas->edit("UPDATE kelas SET namaKelas = '$namakelas', jumlahSiswa = '$jumlahsiswa' WHERE idKelas = '$idKelas'");
echo "<script>window.location='?kelas';</script>";

 ?>