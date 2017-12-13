<?php 
ob_start();
require_once ('../../config/koneksi.php');
require_once ('../../models/database.php');
include "../model/m_data-user.php";

$connection = new Database ($host, $user, $pass, $database);
$user = new dataUser($connection);

$id_user = $_POST['id_user'];
$username =$connection->conn->real_escape_string($_POST['uname']);
$password =$connection->conn->real_escape_string($_POST['pass']);
$level =$connection->conn->real_escape_string($_POST['level']);
$nama =$connection->conn->real_escape_string($_POST['nama']);


$user->edit("UPDATE user SET username = '$username', password = '$password', level = '$level', nama = '$nama'  WHERE id_user = '$id_user'");
echo "<script>window.location='?user';</script>";

 ?>