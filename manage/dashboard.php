<div class="well">
	<?php echo $_SESSION["server"]["id"]["name"];?>
	<div class="statusbar">
		<div id="statusbox"><?php include_once "inc/statusbox.php";?></div>
	</div>
	<h2>
		Server Address: <strong><?php echo $_SESSION["server"]["host"];if($_SESSION["server"]["port"] != "25565"){echo ":".$_SESSION["server"]["port"];}?></strong>
	</h2>
	<div id="buttons">
		<form method="post" action="">
			<button name="start" type="submit" class='btn btn-lg btn-success'>Start</button>
			<button name="stop" type="submit" class='btn btn-lg btn-danger'>Stop</button>
			<button name="restart" type="submit" class='btn btn-lg btn-warning'>Restart</button>
			<button name="reload" type="submit" class='btn btn-lg btn-info'>Reload</button>
		</form>
	</div>
</div>
