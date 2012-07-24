<?php

include_once('api/connect.inc.php');

interface select_roleplays
{
	function latest();
}

class select_roleplays_anon extends connect implements select_roleplays
{
	function latest()
	{
		try {
			$prepare = $this->db->query('SELECT rp_id, name, created, r.rating FROM roleplays rp LEFT JOIN ratings r ON (r.rating_id = rp.rating_id) WHERE r.age <= 13 AND rp.public = "yes" ORDER BY rp.rp_id DESC LIMIT 10');
			$prepare->setFetchMode(PDO::FETCH_ASSOC);

			while ($row = $prepare->fetch()) {
				$roleplays[] = $row;
			}
		} catch (PDOException $e) {
			printp("Error: Could not access the database.");
		}

		return $roleplays;
	}
}

class select_roleplays_user extends connect implements select_roleplays
{
	function latest()
	{
		try {
			$data = Array($_SESSION['user_id']);
			$prepare = $this->db->prepare('SELECT rp_id, name, created, r.rating FROM roleplays rp LEFT JOIN rating_settings rs ON (rs.rating_id = rp.rating_id) LEFT JOIN ratings r ON (rs.rating_id = r.rating_id) WHERE rs.user_id = ? AND rp.public = "yes" ORDER BY rp.rp_id DESC LIMIT 10');
			$prepare->execute($data);
			$prepare->setFetchMode(PDO::FETCH_ASSOC);

			while ($row = $prepare->fetch()) {
				$roleplays[] = $row;
			}
		} catch (PDOException $e) {
			printp("Error: Could not access the database.");
		}

		return $roleplays;
	}
}

?>