<div class="well">
	<?php
	
$scandir = scandir($_SESSION["server"]["path"] . "/plugins");
	var_dump(array_splice($scandir, 2));
	var_dump($_SESSION["server"]);
	var_dump(md5_file($_SESSION["server"]["path"]));
	var_dump(md5_file($_SESSION["server"]["path"] . "/logs/latest.log"));
	?>
</div>