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
				$updateEmail = $_SESSION["email"];
				$updatePassword = $_SESSION["password"];
				if(isset($_POST["email"]) && $_POST["email"] != "" && $_POST["email"] != $_SESSION["email"]){
					$updateEmail = $_POST["email"];
					$_SESSION["email"] = $updateEmail;
				}
				if(isset($_POST["password"]) && $_POST["password"] != "" && $_POST["password"] != $_SESSION["password"]){
					$updatePassword = $_POST["password"];
					$_SESSION["password"] = $updatePassword;
				}
				editUser($_SESSION["username"], $updateEmail, $_SESSION["key"], $updatePassword);
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
								<span class="input-group-addon">Email:</span>
								<input name="email" type="text" class="form-control" placeholder="<?php echo $_SESSION['email'];?>" autofocus />
							</div>
						</div>
						<div class="passwordcontainer">
							<div class="input-group">
								<span class="input-group-addon">Password:</span>
								<input name="password" type="password" class="form-control" placeholder="<?php for($i = 0; $i < strlen($_SESSION['password']); $i++){echo "*";} ?>" />
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