<?php session_start();?>
<?php

include_once "inc/db_connect.php";
include_once "inc/functions.php";

if(! login_check()){
	?>
<!DOCTYPE html>
<html lang="en">
<head>
		<?php
	$pageName = "register";
	$title = "DominationVPS Registration";
	include_once "inc/head.php";
	?>
		<?php
	if(isset($_POST["email"], $_POST["username"], $_POST["password"], $_POST["confirmpassword"])){
		$email = $_POST["email"];
		$username = $_POST["username"];
		$password = $_POST["password"];
		$confirmpassword = $_POST["confirmpassword"];
		
		if($password == $confirmpassword){
			
			$createUser = createUser($email, $username, $password);
			
			if($createUser != "ERROR:USER_EXISTS"){
				
				if($createUser == "SUCCESS"){
					$user = getUser($_POST["username"]);
					$_SESSION["user"]["email"] = $user["email"];
					$_SESSION["user"]["username"] = $user["username"];
					$_SESSION["user"]["password"] = $user["password"];
					header("Location: register_success.php?m=" . $username);
				}else{
					// unknown error
					$_POST["err"] = "Something went wrong. Not sure what :/";
				}
			}else{
				$_POST["err"] = "A user with the email address \"" . $_POST["email"] . "\" already exists!";
			}
		}else{
			// pass and confirmation don't match
			$_POST["err"] = "Password and Password Confirmation do not match!";
		}
	}
	?>
		<?php
	if(isset($_POST["err"])){
		echo "<div style='text-align:center;' class='alert alert-danger'>ERROR: " . $_POST["err"] . "</div>";
	}
	?>
	</head>
<br>
<br>
<br>
<body>
	<div class="container">
		<div class="well">
			<div class="logintitle">Register</div>
			<form action="" method="post">
				Email Address: <br>
				<input type="text" name="email" class="form-control"
					placeholder="Email" required autofocus /> Minecraft Username
				(optional): <br>
				<input type="text" name="username" class="form-control"
					placeholder="Minecraft Username" /> Password: <br>
				<input type="password" name="password" class="form-control"
					placeholder="Password" required /> Confirm Password: <br>
				<input type="password" name="confirmpassword" class="form-control"
					placeholder="Confirm Password" required /> <br>
				<input class="btn btn-lg btn-success btn-block" type="submit"
					value="Register" /> <br>
				<input class="btn btn-lg btn-primary btn-block" type="button"
					value="Back to login" onClick="parent.location='login.php'" />
			</form>
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