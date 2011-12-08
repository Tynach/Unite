<?php

//error_reporting(0);

//This sets '$myPath' to the directory (as seen by the browser) of the current page.
$myPath = dirname($_SERVER['SCRIPT_NAME']);
if (substr($myPath, -1) != '/') {
	$myPath = $myPath.'/';
}

//Whee, setting up sessions.
session_set_cookie_params(1209600, $myPath);
session_start();
session_regenerate_id();

//Turn off magic quotes by force. This can be horrendously slow on servers that have it turned on. Yes, this is punishment as well as absolutely vital to the scripts to work properly.
if (get_magic_quotes_gpc()) {
	$process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
	while (list($key, $val) = each($process)) {
		foreach ($val as $k => $v) {
			unset($process[$key][$k]);
			if (is_array($v)) {
				$process[$key][stripslashes($k)] = $v;
				$process[] = &$process[$key][stripslashes($k)];
			} else {
				$process[$key][stripslashes($k)] = stripslashes($v);
			}
		}
	}
	unset($process);
}


//These echo paragraphs and lines, respectively. I don't encourage using them, but sometimes they're just EASIER to use than manually exiting PHP and re-entering PHP.

function printp($string)
{
	echo "<p>$string\n</p>\n";
}

function printl($string)
{
	echo "$string\n";
}

?>