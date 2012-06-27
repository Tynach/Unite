<?php

interface selectRoleplays
{
	function latest($db);
}

class selectRoleplaysAnon implements selectRoleplays
{
	function latest($db)
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

class selectRoleplaysUser implements selectRoleplays
{
	function latest($db)
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