<div class="well">
	<?php
	$path = "";
	if(isset($_GET["path"])){
		$scandir = scandir($_SESSION["server"]["path"]."/".$_GET["path"]);
		$path = $_SESSION["server"]["path"]."/".$_GET["path"];
	}else{
		$scandir = scandir($_SESSION["server"]["path"]);
		$path = $_SESSION["server"]["path"];
	}
	$arr = array_splice($scandir, 2, count($scandir) - 2);
	?>
	<form method="post">
		<table class="table table-hover table-bordered">
			<tr>
				<th>File</th>
				<th>Actions</th>
			</tr>
			
			<?php
			function test($asdf){
				echo $asdf;
			}
			$canEdit = array("txt", "yml", "log", "conf", "html", "json", "properties", "props", "cfg", "lang");
			date_default_timezone_set("America/Los_Angeles");
			foreach($arr as $filename){
				echo "
					<tr>
						<td>$filename</td>
						<td>";
					if(in_array(pathinfo($path.$filename, PATHINFO_EXTENSION), $canEdit)){
						echo "<button name='editfile'>Edit</button> ";
					}
					if(is_dir($path.$filename)){
						echo "<button name='changedir'>Enter Directory</button> ";
					}
					echo "
							<button name='renamefile'>Rename</button>
							<button name='movefile'>Move</button>
							<button name='copyfile'>Copy</button>
							<button name='deletefile'>Delete</button>
						</td>
					</tr>
				";
			}
			?>
		</table>
	</form>
</div>
