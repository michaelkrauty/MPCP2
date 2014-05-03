<?php session_start();?>
<?php

include_once "inc/db_connect.php";
include_once "inc/functions.php";
include_once "inc/mc_connect.php";

if(login_check()){
	$auth = false;
	if(isset($_GET["server"])){
		for($i = 0; $i < count(getUserServers($_SESSION["user"]["id"])); $i ++){
			if(getUserServers($_SESSION["user"]["id"])[$i]["id"] == $_GET["server"]){
				
				$temp = getServer($_GET["server"]);
				
				$_SESSION["server"]["id"] = $temp["id"];
				$_SESSION["server"]["name"] = $temp["name"];
				$_SESSION["server"]["owner"] = $temp["ownerid"];
				$_SESSION["server"]["host"] = $temp["host"];
				$_SESSION["server"]["port"] = $temp["port"];
				$_SESSION["server"]["memory"] = $temp["memory"];
				$_SESSION["server"]["jarid"] = $temp["jarid"];
				$_SESSION["server"]["suspended"] = $temp["suspended"];
				$getJar = getJar((int) $_SESSION["server"]["jarid"]);
				$_SESSION["server"]["jarlocation"] = $getJar["location"];
				$_SESSION["server"]["path"] = "/var/mpcp2/servers/" . $_SESSION["server"]["id"] . "/";
				
				$auth = true;
			}
		}
	}
	if(isset($_POST["start"])){
		$serverId = $_SESSION["server"]["id"];
		$memory = $_SESSION["server"]["memory"];
		$jar_path = $_SESSION["server"]["jarlocation"];
		$host = $_SESSION["server"]["host"];
		$port = $_SESSION["server"]["port"];
		startServer($serverId, $memory, $jar_path, $host, $port);
	}
	if(isset($_POST["stop"])){
		stopServer($_SESSION["server"]["id"]);
	}
	if(isset($_POST["restart"])){
		restartServer($_SESSION["server"]["id"]);
	}
	if(isset($_POST["reload"])){
		reloadServer($_SESSION["server"]["id"]);
	}
	?>
<html>
<head>
	<?php
	$title = "DominationVPS Manage";
	$pageName = "manage";
	include_once "inc/head.php";
	?>
</head>
<body>
	<?php include_once "inc/header.php";?>
		<div class="body">
		<div class="main">
			<?php if($auth){?>
				<div class="container-fluid">
				<div class="row">
						<?php include_once "inc/managesidebar.php"; ?>
						<div
						class="col-sm-9 col-sm-offset-4 col-md-8 col-md-offset-0 main"
						style="margin-right: 0px; padding-right: 0px; margin-top: 0px;">
						<div class="bar1"
							style='padding-bottom: 10px; margin-bottom: 0px;'>
								<?php
		if(isset($_GET["page"])){
			if(include_once "manage/" . $_GET["page"] . ".php"){
			}else{
				echo "Page not found.";
			}
		}else{
			include_once "manage/dashboard.php";
			?>
								</div>
						<div class="bar2">
							<!-- things below start/stop buttons here -->
						</div>
						<div class="status-header" id="status"></div>
					</div>
				</div>
			</div>
					<?php
		}
	}else{
		?>
				<div class="serverlist">
				<div class="well">
					<table class="table table-hover table-bordered">
						<tr>
							<th style="max-width: 100px;">Server</th>
							<th style="max-width: 100px;">IP</th>
							<th style="max-width: 50px;">Memory (RAM)</th>
							<th style="max-width: 100px;">Jar File</th>
							<th style="max-width: 50px;">Manage</th>
							<th style="max-width: 50px;">Online?</th>
						</tr>
						<?php
		$userServers = getUserServers($_SESSION["user"]["id"]);
		if($userServers != "ERROR:USER_HAS_NO_SERVERS"){
			for($i = 0; $i < count($userServers); $i ++){
				$temp["name"] = $userServers[$i]["name"];
				$temp["host"] = $userServers[$i]["host"];
				$temp["port"] = $userServers[$i]["port"];
				$temp["jar"] = $userServers[$i]["jar"];
				$temp["jarname"] = getJar((int) $temp["jar"])["name"];
				$temp["id"] = $userServers[$i]["id"];
				$temp["memory"] = $userServers[$i]["memory"];
				$temp["suspended"] = $userServers[$i]["suspended"];
				if(serverOnline($temp["id"])){
					$temp["online"] = "<span class=\"glyphicon glyphicon-ok\" /";
				}
				if(! serverOnline($temp["id"])){
					$temp["online"] = "<span class=\"glyphicon glyphicon-remove\" /";
				}
				
				echo "<tr>";
				echo "<td style=\"max-width:100px;\">" . $temp["name"] . "</td>";
				echo "<td style=\"max-width:100px;\">" . $temp["host"] . ":" . $temp["port"] . "</td>";
				echo "<td style=\"max-width:50px;\">" . round(($temp["memory"] / 1024), 2) . "GB</td>";
				echo "<td style=\"max-width:100px;\">" . $temp["jarname"] . "</td>";
				echo "<td style=\"max-width:50px;\"><button onClick=\"parent.location='manage.php?server=" . $temp["id"] . "'\" class='btn btn-info'>Manage</button></td>";
				echo "<td style=\"max-width:50px;\">" . $temp["online"] . "</td>";
				echo "</tr>";
			}
		}else{
			?>
								
								<tr>
							<td style="max-width: 100px;">Demo Server</td>
							<td style="max-width: 100px;">dominationvps.com:PORTHERE</td>
							<td style="max-width: 50px;">0.5GB</td>
							<td style="max-width: 100px;"><?php echo getJar(1)["name"];?></td>
							<td><button name="start" class='btn btn-small btn-success'>Start</button>
								<button name="stop" class='btn btn-small btn-danger'>Stop</button>
								<button name="restart" class='btn btn-small btn-warning'>Restart</button>
								<button name="reload" class='btn btn-small btn-info'>Reload</button></td>
						</tr>
								
							<?php }?>
						</table>
				</div>
			</div>
				<?php }?>
				
				
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