<?php 

class login
{
	private $mysqli;
	function __construct(argument)
	{
		$this->mysqli = $conn;
	}

	public function login($username, $password)
	{
 		$db = $this->mysqli->conn;
 		$sql = "SELECT * from user";
 		$query = $db->query($sql) or die ($db->error);
		return $query;
	}
}

 ?>