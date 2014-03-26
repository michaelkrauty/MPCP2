<?php session_start();?>
<?php
	include_once "inc/db_connect.php";
	include_once "inc/functions.php";
	
	if(login_check() && $_SESSION["username"] = "mi16"){
?>
<html>
	<head>
		<?php
			$title = "Admin ";
			$pageName = "admin";
			include_once "inc/head.php";
		?>
	</head>
	<body>
	<?php include_once "inc/header.php";?>
		<div class="body">
		
		
			<div class="main">
				
			</div>
			
			
		</div>
	</body>
</html>
<?php include_once "inc/script.php";?>
<?php
}else{
	header("Location: index.php");
}
?>