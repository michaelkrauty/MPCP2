<?php session_start();?>
<?php

include_once "inc/db_connect.php";
include_once "inc/functions.php";

if(login_check()){
	?>
<html>
<head>
		<?php
	$title = "DominationVPS Account Settings";
	$pageName = "settings";
	include_once "inc/head.php";
	?>
	</head>
<body>
	<?php include_once "inc/header.php";?>
		<?php
	if(isset($_POST["email"]) || isset($_POST["password"])){
		if(isset($_POST["email"]) && $_POST["email"] != "" && $_POST["email"] != $_SESSION["user"]["email"]){
			$_SESSION["user"]["email"] = $_POST["email"];
			// make changes in DB
		}
		if(isset($_POST["username"]) && $_POST["username"] != "" && $_POST["username"] != $_SESSION["user"]["username"]){
			$_SESSION["user"]["username"] = $_POST["username"];
			// make changes in DB
		}
		if(isset($_POST["password"]) && $_POST["password"] != "" && $_POST["password"] != $_SESSION["user"]["password"]){
			$_SESSION["user"]["password"] = $_POST["password"];
			// make changes in DB
		}
	}
	?>
		<div class="body">
		<div class="main">
			<div class="header">
				<div class="well">
					<h1>Account Settings</h1>
				</div>
			</div>
			<div class="content">
				<form method="post">
					<div class="emailcontainer">
						<div class="input-group">
							<span class="input-group-addon">Email:</span> <input name="email"
								type="text" class="form-control"
								placeholder="<?php echo $_SESSION["user"]['email'];?>" autofocus />
						</div>
					</div>
					<div class="usernamecontainer" style="margin-top: 10px;">
						<div class="input-group">
							<span class="input-group-addon">Username:</span> <input
								name="username" type="text" class="form-control"
								placeholder="<?php echo $_SESSION["user"]['username'];?>" />
						</div>
					</div>
					<div class="passwordcontainer">
						<div class="input-group">
							<span class="input-group-addon">Password:</span> <input
								name="password" type="password" class="form-control"
								placeholder="<?php for($i = 0; $i < strlen($_SESSION["user"]['password']); $i++){echo "*";} ?>" />
						</div>
					</div>
					<div class="submit">
						<button class="btn btn-lg btn-info" action="submit">Submit Changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
<?php include_once "inc/script.php";?>
<?php
}else{
	header("Location: login.php");
}
?>