<?php
function screenStat($serverId){
	return exec('screen -list | grep mpcp2_' . $serverId . ' | cut -f1 -d\'.\' | sed \'s/\W//g\'');
}
function serverOnline($serverId){
	$temp = getServer($serverId);
	$serverIp = $temp["host"];
	$serverPort = $temp["port"];
	include_once "inc/status.class.php";
	$status = new MinecraftServerStatus();
	return $status->online($serverIp, $serverPort);
}
function startServer($serverId, $memory, $jar, $host, $port){
	exec("screen -wipe");
	if(! file_exists("/var/mpcp2/servers/$serverId")){
		exec("mkdir /var/mpcp2/servers/$serverId");
	}
	if(screenStat($serverId) == ""){
		if(! serverOnline($serverId)){
			exec("cd /var/mpcp2/servers/$serverId && screen -dmS mpcp2_$serverId java -Xmx$memory\M -jar $jar nogui --host $host --port $port");
		}
	}
	return screenStat($serverId);
}
function stopServer($serverId){
	exec("screen -p 0 -S mpcp2_$serverId -X eval \"stuff 'stop'\015\"");
}
function restartServer($serverId){
	$getServer = getServer($serverId);
	$temp["memory"] = $getServer["memory"];
	$temp["jarid"] = $getServer["jarid"];
	$getJar = getJar((int) $temp["jarid"]);
	$temp["jarlocation"] = $getJar["location"];
	$temp["host"] = $getServer["host"];
	$temp["port"] = $getServer["port"];
	stopServer($serverId);
	while(screenStat($serverId) != ""){
		sleep(0);
	}
	startServer($serverId, $temp["memory"], $temp["jarlocation"], $temp["host"], $temp["port"]);
}
function reloadServer($serverId){
	if(screenStat($serverId)){
		if(serverOnline($serverId)){
			exec("screen -p 0 -S mpcp2_$serverId -X eval \"stuff 'reload'\015\"");
		}
	}
}
function executeCommand($serverId, $command){
	if(screenStat($serverId)){
		if(serverOnline($serverId)){
			// exec("screen -x $serverId -p 0 -X stuff \"`printf \"$command\r\"`\";");
			exec('screen -p 0 -S mpcp2_' . escapeshellcmd($serverId) . ' -X eval \'stuff "' . escapeshellcmd($command) . '"\015\'');
		}
	}
}
function createBackup($serverId){
	$date = date("j-n-Y_G:i");
	if(! file_exists("/var/mpcp2/backups/$serverId")){
		exec("mkdir /var/mpcp2/backups/$serverId");
	}
	exec("cd /var/mpcp2/servers/$serverId && zip $date * && mv $date.zip /var/mpcp2/backups/$serverId/");
}
function restoreBackup($serverId, $backupName){
	if(file_exists("/var/mpcp2/backups/$serverId/$backupName")){
		createBackup($serverId);
		exec("rm -rf /var/mpcp2/servers/$serverId/* && mv /var/mpcp2/backups/$serverId/$backupName /var/mpcp2/servers/$serverId/ && cd /var/mpcp2/servers/$serverId && unzip $backupName && rm -f $backupName");
	}
}
function deleteBackup($serverId, $backupName){
	if(file_exists("/var/mpcp2/backups/$serverId/$backupName")){
		exec("rm -f /var/mpcp2/servers/$serverId/$backupName");
	}
}

?>
