
<div class="well">
	<h2>Logs</h2>
	<table class="table table-hover table-bordered">
		<tr>
			<th style="max-width: 100px;">Name</th>
			<th style="max-width: 100px;">Actions</th>
		</tr>
										
										<?php
										for($i = 0; $i < count(scandir($_SESSION["server"]["path"] . "/logs", SCANDIR_SORT_DESCENDING)); $i ++){
											$scandir = scandir($_SESSION["server"]["path"] . "/logs", SCANDIR_SORT_DESCENDING)[$i];
											if($scandir != "." && $scandir != ".."){
												$path = $_SESSION["server"]["path"] . "/logs/";
												
												$name = $scandir;
												$actions = "view | delete | download | share";
												
												echo "<tr>";
												echo "<td>" . $name . "</td>";
												echo "<td>" . $actions . "</td>";
												echo "</tr>";
											}
										}
										?>
										
										</table>
</div>