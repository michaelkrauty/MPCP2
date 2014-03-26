<?php session_start();?>
<?php
	include_once "inc/db_connect.php";
	include_once "inc/functions.php";
	
	if(login_check()){
?>
<html>
	<head>
		<?php
			$pageName = "register_success";
			$title = "Registration Successful!";
			include_once "inc/head.php";
		?>
	</head>
	<body>
		<div class="jumbotron">
			<center>
				<h1>Welcome to FirstPvP, <?php echo $_SESSION["username"];?>!
				<br>
				<a href="login.php">Back to the website</a>
				</h1>
			</center>
		</div>
	</body>
</html>


<?php
	}else{
		header("Location: login.php");
	}
?>