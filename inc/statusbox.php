<?php // if(session_id() == null){
//	session_start();
//}?>
<?php if(isset($_SESSION["server"]["id"])){?>
<?php include_once "mc_connect.php";
	$temp["screen"] = false;
	$temp["server"] = false;
	if(screenStat($_SESSION["server"]["id"])){
		$temp["screen"] = true;
	}
	if(serverOnline($_SESSION["server"]["id"])){
		$temp["server"] = true;
	}
	if(!$temp["screen"] && !$temp["server"]){
		echo "<div class=\"alert alert-danger\">Server is Offline!</div>";
	}
	if($temp["screen"] && !$temp["server"]){
		echo "<div class=\"alert alert-warning\">Server is Restarting!</div>";
	}
	if($temp["screen"] && $temp["server"]){
		echo "<div class=\"alert alert-success\">Server is Online!</div>";
	}
?>
<?php }?>