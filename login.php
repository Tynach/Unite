<?php

include('unite.inc.php');
$page = new page('styles/main.htmt');
$page->title = 'Login';

if ($_POST['username'] == 'username' AND $_POST['password'] == 'password') {
	back();
}

?>
<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
	<p>
		<label>Username</label>
		<input type="text" name="username">
	</p>
	<p>
		<label>Password</label>
		<input type="password" name="password">
	</p>
	<p>
		<input type="submit" value="Log In">
		<input type="reset" value="Reset">
	</p>
</form>