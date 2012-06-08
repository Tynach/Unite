<?php

//Turn off magic quotes by force. This can be horrendously slow on servers
//that have it turned on. Yes, this is punishment as well as absolutely
//vital to the scripts to work properly.
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

//These echo paragraphs and lines, respectively. I don't encourage using
//them, but sometimes they're just EASIER to use than manually exiting PHP
//and re-entering PHP.
function printp($string)
{
	echo "<p>$string\n</p>\n";
}

function printl($string)
{
	echo "$string\n";
}

//This helps with going 'back' to the page the user was at before attempting
//to log in or sign up. Title names can be changed and added to the $noprev
//array, of course.
function previous($page)
{
	$noprev = array('Login', 'Sign Up');
	if (!in_array($page->title, $noprev)) {
		$_SESSION['prev'] = $_SERVER['SCRIPT_NAME'];
	}
}

//Function to go back one page. Note that this relies on the 'default'
//closing function above being intact.
function back()
{
	header('Location: '.$_SESSION['prev']);
}

//Function to be called at the end of execution. Put other function calls in
//here.
function closing($page)
{
	previous($page);
}

?>