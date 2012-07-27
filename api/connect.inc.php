<?php

abstract class connect
{
	function __construct($db)
	{
		if (isset($db)) {
			$this->db = $db;
		} else {
			throw new Exception('Could not connect to database.');
		}
	}
}

?>