	<form method="post">
		<table class="table table-hover table-bordered">
			<tr>
				<th>File</th>
				<th>Actions</th>
			</tr>
			
			<?php
			$scandir = scandir("/var/test");
			$arr = array_splice($scandir, 2, count($scandir) - 2);
			foreach($arr as $filename){
				echo "
					<tr>
						<td>$filename</td>
						<td>
							<button name='editfile'>Edit</button>
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