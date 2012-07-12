<?php global $myPath; ?>
<a href="<?php echo $myPath; ?>">
	<img src="styles/logo.png" alt="Dimentions" />
</a>
<?php if ($_SESSION['username'] != '') {?>
<div id="login">
	<p>
		Welcome, <?php echo $_SESSION['username']; ?>! <a href="logout.php">Log out</a>
	</p>
</div><?php } else { ?>
<div id="login">
	<form method="post" action="login.php">
		<p>
			<label>Username</label>
			<input type="text" name="username" />
		</p>
		<p>
			<label>Password</label>
			<input type="password" name="password" />
		</p>
		<p>
			<input type="submit" value="Log in" />
		</p>
	</form>
</div><?php } ?>