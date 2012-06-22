<?php

global $myPath;
$navArray = array(
	'Home' => $myPath,
	'Roleplays' => $myPath.'roleplays.php',
	'Characters' => $myPath.'characters.php',
	'Universes' => $myPath.'universes.php'
);

?>
<ul>
<?php
foreach ($navArray as $name => $link) {
	if ($_SERVER['SCRIPT_NAME'] == $link || ($_SERVER['SCRIPT_NAME'] == $myPath.'index.php' && $link == $myPath)) {
		$current = TRUE;
	} else {
		$current = FALSE;
	}
	if ($current) {
?>
	<li id="current"><?php echo $name; ?></li><?php
	} else {
?>
	<a href="<?php echo $link; ?>">
		<li><?php echo $name; ?></li>
	</a><?php
	}
?>

<?php } ?>
</ul>