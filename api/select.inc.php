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
		$roleplays = Array(
			Array(
				'rp_id' => 58,
				'username' => 'Tynach',
				'name' => 'Observation of CRAYON!',
				'rating' => 'G',
				'created' => '2012-06-25 02:14:20'
			),
			Array(
				'rp_id' => 47,
				'username' => 'Tynach',
				'name' => 'Observation of Reality',
				'rating' => 'PG-13',
				'created' => '2012-06-25 02:05:24'
			)
		);

		return $roleplays;
	}
}

class select_roleplays_user extends connect implements select_roleplays
{
	function latest()
	{
		$roleplays = Array(
			Array(
				'rp_id' => 47,
				'username' => 'Tynach',
				'name' => 'Observation of Reality',
				'rating' => 'PG-13',
				'created' => '2012-06-25 02:05:24'
			)
		);

		return $roleplays;
	}
}

?>