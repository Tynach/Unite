<?php

//Woo, filtering! This is actually a fairly robust class. You can define filters and regular expressions to go with them in the '$types' array, then it has a few generic methods that you use to check to see if a string validates based on those filters. It also keeps track of 'errors' (when things don't validate), so you can print out and tell people what it is they did horribly wrong.
class filter
{
	private $types = array();
	public $errors = array();
	public $vars = array();

	public function add_filters($array)
	{
		$this->types = array_merge($this->types, (array)$array);
	}

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

/*Example filter adding, where $filter is the object of the filter class
$filter->add_filters(array(
	'username' => "/[a-z0-9.\-_]{1,20}/i",
	'email' => '/.+@.+/i',
	'password' => "/[a-z0-9\-_' ?!.@&%\^]{6,64}/i"
));
*/

?>