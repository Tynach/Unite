<?php

class connection
{
	private $db;

	public function __construct($host, $database, $user, $password)
	{
		try {
			$this->db = new PDO("mysql:host=$host;dbname=$database", $user, $password);
		} catch (PDOException $e) {
			printp($e->getMessage());
			exit();
		}
	}
}

?>