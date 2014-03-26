<?php

class minecraft{
	
	function __construct($serverId){
		$this->server["id"] = $serverId;
		$this->test = "test";
	}
	
	
}
	function screenStat($serverId){
		return exec('screen -list | grep mpcp2_'.$serverId.' | cut -f1 -d\'.\' | sed \'s/\W//g\'');
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
		if(!file_exists("/var/mpcp2/servers/$serverId")){
			exec("mkdir /var/mpcp2/servers/$serverId");
		}
		if(screenStat($serverId) == ""){
			if(!serverOnline($serverId)){
				exec("cd /var/mpcp2/servers/$serverId && screen -dmS mpcp2_$serverId java -Xmx$memory\M -jar $jar nogui --host $host --port $port");
			}
		}
		return screenStat($serverId);
	}
	
	function stopServer($serverId){
		exec("screen -p 0 -S mpcp2_$serverId -X eval \"stuff 'stop'\015\"");
	}
	
	function restartServer($serverId, $memory, $jar, $host, $port){
		stopServer($serverId);
		while(screenStat($serverId) != ""){
			sleep(0);
		}
		startServer($serverId, $memory, $jar, $host, $port);
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
				//exec("screen -x $serverId -p 0 -X stuff \"`printf \"$command\r\"`\";");
				exec('screen -p 0 -S mpcp2_'.escapeshellcmd($serverId).' -X eval \'stuff "'.escapeshellcmd($command).'"\015\'');
			}
		}
	}

	function createBackup($serverId){
		$date = date("j-n-Y_G:i");
		if(!file_exists("/var/mpcp/backups/$serverId")){
			exec("mkdir /var/mpcp/backups/$serverId");
		}
		exec("cd /var/mpcp/servers/$serverId && zip $date * && mv $date.zip /var/mpcp/backups/$serverId/");
	}

	function restoreBackup($serverId, $backupName){
		if(file_exists("/var/mpcp/backups/$serverId/$backupName")){
			createBackup($serverId);
			exec("rm -rf /var/mpcp/servers/$serverId/* && mv /var/mpcp/backups/$serverId/$backupName /var/mpcp/servers/$serverId/ && cd /var/mpcp/servers/$serverId && unzip $backupName && rm -f $backupName");
		}
	}
	
	function deleteBackup($serverId, $backupName){
		if(file_exists("/var/mpcp/backups/$serverId/$backupName")){
			exec("rm -f /var/mpcp/servers/$serverId/$backupName");
		}
	}
	
	
?>
