<?php

include_once('security.inc.php');
include_once('session.inc.php');
include_once('general.inc.php');
include_once('api/auth.inc.php');

$auth = new auth($db);
$auth->check_auth($_POST['username'], $_POST['password']);

?>