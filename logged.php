<?php session_start();?>
<?php
	include_once "inc/functions.php";
	
	if(login_check()){
		$logged = "in";
	}else{
		$logged = "out";
	}
	echo $logged;
?>