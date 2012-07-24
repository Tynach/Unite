<?php

include_once('api/connect.inc.php');

class auth extends connect
{
	function check_auth($username, $password)
	{
		try {
			$data = Array($username, $password);
			$prepare = $this->db->prepare('SELECT u.username `username`, u.user_id `user_id` FROM logins l LEFT JOIN users u ON (l.user_id = u.user_id) WHERE u.username = ? AND l.password = SHA1(?)');
			$prepare->execute($data);
			$prepare->setFetchMode(PDO::FETCH_ASSOC);

			$row = $prepare->fetch();
		} catch (PDOException $e) {
			printp("Error: Could not access the database.");
		}

		if ($row['username'] != '') {
			$_SESSION['username'] = $row['username'];
			$_SESSION['user_id'] = $row['user_id'];
			unset($_SESSION['untry']);
			unset($_SESSION['pwtry']);
		} else {
			$_SESSION['untry'] = $username;
			$_SESSION['pwtry'] = $password;
		}

		back();
	}
}

?>