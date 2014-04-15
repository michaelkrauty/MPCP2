<div class="well">
	<?php
		$scandir = scandir($_SESSION["server"]["path"]);
		$arr = array_splice($scandir, 2, count($scandir) - 2);
	?>
	<table class="table table-hover table-bordered">
		<tr>
			<th>File</th>
			<th>Actions</th>
		</tr>
		
		<form method="post">
		
		<?php
			function test($asdf){
				echo $asdf;
			}
			
			foreach($arr as $filename){
				echo "
					<tr>
						<td>$filename</td>
						<td>";
						if(
							(substr($filename, strlen($filename) - 4) == ".txt") ||
							(substr($filename, strlen($filename) - 4) == ".yml") ||
							(substr($filename, strlen($filename) - 4) == ".cfg") ||
							(substr($filename, strlen($filename) - 4) == ".xml") ||
							(substr($filename, strlen($filename) - 4) == ".php") ||
							(substr($filename, strlen($filename) - 5) == ".conf") ||
							(substr($filename, strlen($filename) - 5) == ".html") ||
							(substr($filename, strlen($filename) - 11) == ".properties")
						){
							echo "<button name='editfile'>Edit</button> ";
						}echo "
							<button name='renamefile'>Rename</button>
							<button name='movefile'>Move</button>
							<button name='copyfile'>Copy</button>
							<button name='deletefile'>Delete</button>
						</td>
					</tr>
				";
				}
			?>
		</form>
	</table>
</div>									