<?php 

class login
{
	private $mysqli;
	function __construct($conn)
	{
		$this->mysqli = $conn;
	}

	public function login($user, $pass)
	{
 		$db = $this->mysqli->conn;
 		// $sql = "SELECT * from user WHERE username = '$user' AND password = '$pass'";
 		// $query = $db->query($sql) or die ($db->error);
		$query = $db->query("SELECT * from user WHERE username = '$user' AND password = '$pass'") or die ($db->error);
		return $query;


	}
}

 ?>