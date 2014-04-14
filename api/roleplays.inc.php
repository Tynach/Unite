<?php

include_once('api/query.inc.php');

class roleplays extends query
{
	public function latest($num_roleplays)
	{
		if (!is_int($num_roleplays)) {
			printp('Go away. You\'re using this wrong.');
		}

		if (isset($_SESSION['username'])) {
			$query = "SELECT rp_id, name, created, r.rating FROM roleplays rp LEFT JOIN rating_settings rs ON (rs.rating_id = rp.rating_id) LEFT JOIN ratings r ON (rs.rating_id = r.rating_id) WHERE rs.user_id = ? AND rp.public = \"yes\" ORDER BY rp.rp_id DESC LIMIT $num_roleplays";
		} else {
			$query = "SELECT rp_id, name, created, r.rating FROM roleplays rp LEFT JOIN ratings r ON (r.rating_id = rp.rating_id) WHERE r.age <= 13 AND rp.public = \"yes\" ORDER BY rp.rp_id DESC LIMIT $num_roleplays";
		}
	}
}

?>