<?php
	header("Refresh: 1");
	echo str_replace("\n", "<br>", shell_exec("tail -n 100 /var/mpcp2/servers/1/logs/latest.log"));
?>