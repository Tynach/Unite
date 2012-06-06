<?php
//This sets '$myPath' to the directory (as seen by the browser) of the current page.
$myPath = dirname($_SERVER['SCRIPT_NAME']);
if (substr($myPath, -1) != '/') {
	$myPath = $myPath.'/';
}

//Whee, setting up sessions.
session_set_cookie_params(1209600, $myPath);
session_start();
session_regenerate_id();
?>