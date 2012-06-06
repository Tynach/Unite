<?php

//error_reporting(0);

//These are basically the main include files necessary for this system to work. This is so that new pages only have to include one file... You could include each of these files individually, if you find you only need one or two. For example, if your page does not need templates or security, and only needs sessions, you can include only 'general.inc.php' and not worry about the bloat of the others.

include_once('session.inc.php');
include_once('general.inc.php');
include_once('template.inc.php');
include_once('security.inc.php');
?>