<?php

//Woo, filtering! This is actually a fairly robust class. You can define filters and regular expressions to go with them in the '$types' array, then it has a few generic methods that you use to check to see if a string validates based on those filters. It also keeps track of 'errors' (when things don't validate), so you can print out and tell people what it is they did horribly wrong.
class filter
{
	private $types = array(
		'username' => "/[a-z0-9.\-_]{1,20}/i",
		'email' => '/.+@.+/i',
		'password' => "/[a-z0-9\-_' ?!.@&%\^]{6,64}/i"
	);
	public $errors = array();
	public $vars = array();

	public function print_errors()
	{
		foreach ($this->errors as $error) {
			printp("Error: $error");
		}

		if (sizeof($this->errors) == 0) {
			return false;
		} else {
			return true;
		}
	}

	public function print_vars()
	{
		foreach ($this->vars as $variable) {
			printp($variable.": ".$this->$variable);
		}

		if (sizeof($this->vars) == 0) {
			return false;
		} else {
			return true;
		}
	}

	public function check($name, $type, $value, $error = NULL)
	{
		preg_match($this->types[$type], $value, $match);
		if ($match[0] == $value && $value != '') {
			$this->vars[] = $name;
			$this->$name = $match[0];
			return true;
		} else {
			if ($error == NULL) {
				$this->errors[] = "$name is invalid.";
			} else {
				$this->errors[] = $error;
			}
			return false;
		}
	}
}

//This is the basic connection class for the database. I initially had every single database call as a method in this class/object, but that was getting a bit... Big. It didn't work out too sell, so instead I'm just sorta using it for error handling and auto-closing of the database.
class connection
{
	private $errors = array();
	public $db;

	function __construct()
	{
		include('../dba/dba.txt');
		$this->db = new mysqli('localhost', 'tynach', $this->password, 'dimentions');

		$failed = mysqli_connect_errno();
		if ($failed) {
			$this->errors[] = $failed.': '.mysqli_connect_error();
		}
	}

	function error()
	{
		$errno = $this->db->errno;
		$error = $errno.': '.$this->db->error.'.';
		if ($errno != 0) {
			$this->errors[] = $error;
			return true;
		} else {
			return false;
		}
	}

	function print_errors()
	{
		foreach ($this->errors as $error) {
			printp("Error $error");
		}
	}

	function __destruct()
	{
		$test = $this->db->close();
	}
}

$db = new connection;

?>