<?php session_start();?>
<?php

include_once "inc/db_connect.php";
include_once "inc/functions.php";

if(login_check() && $_SESSION["username"] = "mi16"){
	?>
<html>
<head>
		<?php
	$title = "Admin";
	$pageName = "admin";
	include_once "inc/head.php";
	?>
	</head>
<body>
	<?php include_once "inc/header.php";?>
	<?php
	
	if(isset($_POST["adduser_email"], $_POST["adduser_username"], $_POST["adduser_password"])){
		createUser($_POST["adduser_email"], $_POST["adduser_username"], $_POST["adduser_password"]);
	}
	if(isset($_POST["deleteuser_?"])){
		// ?
	}
	
	?>
	
		<div class="body">

		<div class="main">


			<div class="well">
				<div class="well">
					Add user
					<form method="post">
						<input name="adduser_email" type="text" placeholder="Email" /> <input
							name="adduser_username" type="text" placeholder="Username" /> <input
							name="adduser_password" type="text" placeholder="Password" />
					</form>
				</div>
				<div class="well">
					Delete User
					<form method="post">
						<input name="deleteuser_?" type="text" placeholder="?" />
					</form>
				</div>
				<div class="well">
					Add Server
					<form method="post">
						<input name="addserver_?" type="text" placeholder="?" />
					</form>
				</div>
				<div class="well">
					Delete Server
					<form method="post">
						<input name="deleteserver_?" type="text" placeholder="?" />
					</form>
				</div>
				<div class="well">
					Suspend Server
					<form method="post">
						<input name="suspendserver_?" type="text" placeholder="?" />
					</form>
				</div>
				<div class="well">
					Unsuspend Server
					<form method="post">
						<input name="unsuspendserver_?" type="text" placeholder="?" />
					</form>
				</div>
			</div>


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