<?php session_start();?>
<?php
	include_once "inc/db_connect.php";
	include_once "inc/functions.php";
?>
<html>
	<head>
		<?php
			$title = "DominationVPS Home";
			$pageName = "index";
			include_once "inc/head.php";
		?>
	</head>
	<body>
	<?php include_once "inc/header.php";?>
		<div class="body">
			<div class="main">
				
				<div class="well">
					Welcome to the DominationVPS website!<br>
					If you're looking to rent a minecraft server, please go to the "Shop" tab.<br>
					If you already have a server & want to manage it, go to the "My Servers" tab.<br>
					Will add more content to this page in the next day or so
				</div>
				
			</div>
		</div>
	</body>
</html>
<?php include_once "inc/script.php";?>