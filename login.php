<?php

include('unite.inc.php');
$page = new page('templates/main.htmt');
$page->title = 'Login';

//Just a silly login page that only accepts 'username' and 'password'.
//Demonstrates 'back()' functionality.

if ($_POST['username'] == 'username' AND $_POST['password'] == 'password') {
	back();
}

include('fragments/login.htmf');

?>