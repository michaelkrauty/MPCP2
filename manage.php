<?php session_start();?>
<?php
	include_once "inc/db_connect.php";
	include_once "inc/functions.php";
	include_once "inc/mc_connect.php";
	
	if(login_check()){
		$auth = false;
		if(isset($_GET["server"])){
			for($i = 0; $i < count(getUserServers($_SESSION["user"]["id"])); $i++){
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
					$getJar = getJar( (int) $_SESSION["server"]["jarid"]);
					$_SESSION["server"]["jarlocation"] = $getJar["location"];
					$_SESSION["server"]["path"] = "/var/mpcp2/servers/".$_SESSION["server"]["id"]."/";
					
					
					
					$auth = true;
				}
			}
		}
		if(isset($_POST['start'])){
			$serverId = $_SESSION["server"]["id"];
			$memory = $_SESSION["server"]["memory"];
			$jar_path = $_SESSION["server"]["jarlocation"];
			$host = $_SESSION["server"]["host"];
			$port = $_SESSION["server"]["port"];
			startServer($serverId, $memory, $jar_path, $host, $port);
		}
		if(isset($_POST['stop'])){
			stopServer($_SESSION["server"]["id"]);
		}
		if(isset($_POST['restart'])){
			restartServer($_SESSION["server"]["id"]);
		}
		if(isset($_POST['reload'])){
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
						<div class="col-sm-9 col-sm-offset-4 col-md-8 col-md-offset-0 main">
							<div class="bar1">
								<?php if(isset($_GET["page"])){?>
									<?php if($_GET["page"] == "jar"){
										
									}
									
									if($_GET["page"] == "config"){
										echo "<div class=\"well\">";
										if(file_exists("/var/mpcp2/servers/".$_SESSION["server"]["id"]."/server.properties")){
											$file = "/var/mpcp2/servers/".$_SESSION["server"]["id"]."/server.properties";?>
											
											
											
											
											<select>
												<option value=0>Survival</option>
												<option value=1>Creative</option>
												<option value=2>Adventure</option>
											</select>
											<br>
											
											
											
											
											
											<?php
											if(false){
												$lines = file($file);
												foreach($lines as &$line){
													if(substr($line, 0, 9) == "gamemode="){
														$line = "gamemode=0\n";
														break;
													}
												}
												file_put_contents($file, $lines);
											}
											
											
											
											
											
											
											echo str_replace("\n", "<br>", file_get_contents($file));
										}
										
										echo "</div>";
									
									
									
									}
									if($_GET["page"] == "files"){?>
									
									<div class="well">
									<?php
									$scandir = scandir($_SESSION["server"]["path"]);
									$arr = array_splice($scandir, 2, count($scandir) - 2);
										var_dump($arr);
										?>
									</div>
									
									
									<?php }
									if($_GET["page"] == "tasks"){?>
									
									tasks
									
									
									<?php }
									if($_GET["page"] == "backup"){?>
									
									backup
									
									
									<?php }
									if($_GET["page"] == "plugins"){?>
									
									<div class="well">
									<?php $scandir = scandir($_SESSION["server"]["path"]."/plugins");
										var_dump(array_splice($scandir, 2));
										var_dump($_SESSION["server"]);
										
										var_dump(md5_file($_SESSION["server"]["path"]));
										var_dump(md5_file($_SESSION["server"]["path"]."/logs/latest.log"))
										
									?>
									</div>
									
									
									<?php }
									if($_GET["page"] == "support"){?>
									
									support
									
									
									<?php }
									if($_GET["page"] == "logs"){?>
										<div class="well">
											<table class="table table-hover table-bordered">
												<tr>
													<th style="max-width:100px;">Name</th>
													<th style="max-width:100px;">Date</th>
													<th style="max-width:100px;">Format</th>
													<th style="max-width:100px;">Actions</th>
												</tr>
										
										<?php
										$scandir = scandir($_SESSION["server"]["path"]."/logs", SCANDIR_SORT_DESCENDING)[$i];
										for($i = 0; $i < count(scandir($_SESSION["server"]["path"]."/logs", SCANDIR_SORT_DESCENDING)); $i++){
											if(scandir($_SESSION["server"]["path"]."/logs", SCANDIR_SORT_DESCENDING)[$i] != "." &&
											scandir($_SESSION["server"]["path"]."/logs", SCANDIR_SORT_DESCENDING)[$i] != ".."){
												
												$temp["test"] = null;
												
												
												$name = null;
												$date = null;
												$format = null;
												$actions = null;
												
												
												
												echo "<tr>";
												echo "<td stuff>";
												echo "<td stuff>";
												echo "<td stuff>";
												echo "<td stuff>";
												echo "</tr>";
												
												echo $scandir."<br>";
												
												
												
											}
										}									
										?>
										
										</table>
										</div>
										<?php
									}
								}else{?>
								<div class="well">
								<?php echo $_SESSION["server"]["id"]["name"];?>
								<div class="statusbar">
									<div id="statusbox"><?php include_once "inc/statusbox.php";?></div>
								</div>
									<h2>Server Address: <strong><?php echo $_SESSION["server"]["host"];if($_SESSION["server"]["port"] != "25565"){echo ":".$_SESSION["server"]["port"];}?></strong></h2>
										<div id="buttons">
											
											<form method="post" action="">
												<button name="start" type="submit" class='btn btn-lg btn-success' >Start</button>
												<button name="stop" type="submit" class='btn btn-lg btn-danger' >Stop</button>
												<button name="restart" type="submit" class='btn btn-lg btn-warning' >Restart</button>
												<button name="reload" type="submit" class='btn btn-lg btn-info' >Reload</button>
											</form>
										</div>
									</div>
									<div class="well">
										<h2>Console</h2>
										<div class="well" style="text-align:left;">
											<script type="text/javascript">
												var auto_refresh = setInterval(
												function (){
													$('#load').load('inc/log.php');
													$('#statusbox').load('inc/statusbox.php');
												}, 2000);
											</script>
											<div id="load" style="min-width:100%;min-height:500px;"><?php include_once "inc/log.php";?></div>
											
										</div>
										<input type="text" style="float:left;" class="form-control" placeholder="Enter a command here..." /><input value="Send Command" style="max-width:120px;" class="btn btn btn-primary btn-block" type="submit" />
									</div>
								</div>
								<div class="bar2">
									
								</div>
								<div class="status-header" id="status"></div>
							</div>
						</div>
					</div>
					
					
					
					
					
					
					
					<?php }?>
			<?php }else{?>
				
				
				<div class="serverlist">
					<div class="well">
						<table class="table table-hover table-bordered">
							<tr>
								<th style="max-width:100px;">Server</th>
								<th style="max-width:100px;">IP</th>
								<th style="max-width:50px;">Memory (RAM)</th>
								<th style="max-width:100px;">Jar File</th>
								<th style="max-width:50px;">Manage</th>
								<th style="max-width:50px;">Online?</th>
							</tr>
						<?php
							$userServers = getUserServers($_SESSION["user"]["id"]);
							if($userServers != "ERROR:USER_HAS_NO_SERVERS"){
								for($i = 0; $i < count($userServers); $i++){
									$temp["name"] = $userServers[$i]["name"];
									$temp["host"] = $userServers[$i]["host"];
									$temp["port"] = $userServers[$i]["port"];
									$temp["jar"] = $userServers[$i]["jar"];
									$temp["jarname"] = getJar( (int) $temp["jar"])["name"];
									$temp["id"] = $userServers[$i]["id"];
									$temp["memory"] = $userServers[$i]["memory"];
									$temp["suspended"] = $userServers[$i]["suspended"];
									if(serverOnline($temp["id"])){
										$temp["online"] = "<span class=\"glyphicon glyphicon-ok\" /";
									}
									if(!serverOnline($temp["id"])){
										$temp["online"] = "<span class=\"glyphicon glyphicon-remove\" /";
									}
									
									echo "<tr>";
									echo "<td style=\"max-width:100px;\">".$temp["name"]."</td>";
									echo "<td style=\"max-width:100px;\">".$temp["host"].":".$temp["port"]."</td>";
									echo "<td style=\"max-width:50px;\">".round(($temp["memory"] / 1024), 2)."GB</td>";
									echo "<td style=\"max-width:100px;\">".$temp["jarname"]."</td>";
									echo "<td style=\"max-width:50px;\"><button onClick=\"parent.location='manage.php?server=".$temp["id"]."'\" class='btn btn-info'>Manage</button></td>";
									echo "<td style=\"max-width:50px;\">".$temp["online"]."</td>";
									echo "</tr>";
								}
							}else{?>
								
								<tr>
								<td style="max-width:100px;">Demo Server</td>
									<td style="max-width:100px;">dominationvps.com:PORTHERE</td>
									<td style="max-width:50px;">0.5GB</td>
									<td style="max-width:100px;"><?php echo getJar(1)["name"];?></td>
									<td><button name="start" class='btn btn-small btn-success'>Start</button> <button name="stop" class='btn btn-small btn-danger'>Stop</button>
                					<button name="restart" class='btn btn-small btn-warning'>Restart</button> <button name="reload" class='btn btn-small btn-info'>Reload</button></td>
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