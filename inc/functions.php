<?php
	include_once "db_connect.php";
	
	function login_check(){
		if(isset($_SESSION["user"]["email"], $_SESSION["user"]["password"])){
			if($_SESSION["user"]["email"] != ""){
				if($_SESSION["user"]["password"] != ""){
					$dbuser = getUser($_SESSION["user"]["email"]);
					if($dbuser != "ERROR:USER_DOES_NOT_EXIST"){
						if(($dbuser["email"] == $_SESSION["user"]["email"]) && ($dbuser["password"] == $_SESSION["user"]["password"])){
							return true;
						}else{
							return false;
						}
					}else{
						return false;
					}
				}else{
					return false;
				}
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
?>