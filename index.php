<?php

include('unite.inc.php');
//Note: Again, page setup is similar to module setup (and internally, page content is treated as a special module), so the '4' is how many indents, and the '\t' is what to use for indents.
$page = new page('styles/main.htmt', 3, "\t");
$page->title = 'Home';

?>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in velit nibh. Praesent rutrum urna non libero porta nec egestas magna dapibus. Sed vitae diam vel felis molestie viverra. Integer vel quam ut quam convallis pharetra. Suspendisse leo tellus, blandit quis scelerisque nec, viverra dictum magna. Proin turpis turpis, facilisis ut bibendum sit amet, convallis sit amet mi. Sed ut magna velit, vel lobortis lectus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
</p>
<p>This is basically the content of your page. Other PHP stuff can go in here - the title set above can be set anywhere within this page (even the bottom of it), and it'll still work. The lorem ipsum stuff above? Dummy text. Gotta love it.
</p>