<?php session_start();?>
<?php
	include_once "inc/db_connect.php";
	include_once "inc/functions.php";
?>
<html>
	<head>
		<?php
			$title = "DominationVPS Shop";
			$pageName = "shop";
			include_once "inc/head.php";
		?>
	</head>
	<body>
	<?php include_once "inc/header.php";?>
		<div class="body">
			<div class="main">
				
				<div class="alert-warning" style="padding-top:10px;padding-bottom:10px;"><h2>The webstore is under construction! You have been warned.</h2></div>
				<br><br>
				
				<div class="well" style="margin-right:30%;margin-left:30%;">
				<div class="well">
					Popular Packages:<br>
					packages here
				</div>
				<div class="well">
					Custom Package:<br>
					<input type="text" placeholder="RAM" /> <select><option value=1>1</option><option value=2>2</option></select>
				</div>
				</div>
				
			</div>
		</div>
	</body>
</html>
<?php include_once "inc/script.php";?>