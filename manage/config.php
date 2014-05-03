<?php
echo "<div class=\"well\">";
if(file_exists("/var/mpcp2/servers/" . $_SESSION["server"]["id"] . "/server.properties")){
	$file = "/var/mpcp2/servers/" . $_SESSION["server"]["id"] . "/server.properties";
	$lines = file($file);
	foreach($lines as &$line){
		if(substr($line, 0, 18) == "generator-settings"){
			$conf["generator-settings"] = substr($line, 19);
		}
		if(substr($line, 0, 10) == "level-name"){
			$conf["level-name"] = substr($line, 11);
		}
		if(substr($line, 0, 10) == "level-seed"){
			$conf["level-seed"] = substr($line, 11);
		}
		if(substr($line, 0, 16) == "max-build-height"){
			$conf["max-build-height"] = substr($line, 17);
		}
		if(substr($line, 0, 13) == "resource-pack"){
			$conf["resource-pack"] = substr($line, 14);
		}
		if(substr($line, 0, 19) == "player-idle-timeout"){
			$conf["player-idle-timeout"] = substr($line, 20);
		}
		if(substr($line, 0, 11) == "max-players"){
			$conf["max-players"] = substr($line, 12);
		}
		if(substr($line, 0, 4) == "motd"){
			$conf["motd"] = substr($line, 5);
		}
	}
	echo "
			<form action='POST'>
			<br>generator-settings: <input type='text' name='generator-settings' placeholder='" . $conf["generator-settings"] . "' />
				<br>op-permission-level: <select>
				<option value=1>1</option>
				<option value=2>2</option>
				<option value=3>3</option>
				<option value=4>4</option>
				</select>
				
				
				<br>level-name: <input type='text' name='level-name' placeholder='" . $conf["level-name"] . "' />
				
				
				<br>enable-query: <select>
				<option value='true'>true</option>
				<option value='false'>false</option>
				</select>
				
				
				<br>allow-flight: <select>
				<option value='true'>true</option>
				<option value='false'>false</option>
				</select>
				
				
				<br>announce-player-achievements: <select>
				<option value='true'>true</option>
				<option value='false'>false</option>
				</select>
				
				
				<br>level-type: <select>
				<option value=1>NORMAL</option>
				<option value=2>NETHER</option>
				<option value=2>FLAT</option>
				</select>
				
				
				<br>enable-rcon: <select>
				<option value='true'>true</option>
				<option value='false'>false</option>
				</select>
				
				
				<br>level-seed: <input type='text' name='level-seed' placeholder='" . $conf["level-seed"] . "' />
				
				
				<br>force-gamemode: <select>
				<option value='true'>true</option>
				<option value='false'>false</option>
				</select>
				
				
				<br>max-build-height: <input type='text' name='max-build-height' placeholder='" . $conf["max-build-height"] . "' />
				
				
				<br>spawn-npcs: <select>
				<option value='true'>true</option>
				<option value='false'>false</option>
				</select>
				
				
				<br>white-list: <select>
				<option value='true'>true</option>
				<option value='false'>false</option>
				</select>
				
				
				<br>spawn-animals: <select>
				<option value='true'>true</option>
				<option value='false'>false</option>
				</select>
				
				
				<br>hardcore: <select>
				<option value='true'>true</option>
				<option value='false'>false</option>
				</select>
				
				
				<br>snooper-enabled: <select>
				<option value='true'>true</option>
				<option value='false'>false</option>
				</select>
				
				
				<br>online-mode: <select>
				<option value='true'>true</option>
				<option value='false'>false</option>
				</select>
				
				
				<br>resource-pack: <input type='text' name='resource-pack' placeholder='" . $conf["resource-pack"] . "' />
				
				
				<br>pvp: <select>
				<option value='true'>true</option>
				<option value='false'>false</option>
				</select>
				
				
				<br>difficulty: <select>
				<option value=0>Peaceful</option>
				<option value=1>Easy</option>
				<option value=2>Medium</option>
				<option value=3>Hard</option>
				</select>
				
				
				<br>enable-command-block: <select>
				<option value='true'>true</option>
				<option value='false'>false</option>
				</select>
				
				
				<br>gamemode: <select>
				<option value=0>Survival</option>
				<option value=1>Creative</option>
				<option value=2>Adventure</option>
				</select>
				
				
				<br>player-idle-timeout: <input type='text' name='player-idle-timeout' placeholder='" . $conf["player-idle-timeout"] . "' />
				
				
				<br>max-players: <input type='text' name='max-players' placeholder='" . $conf["max-players"] . "' />
				
				
				<br>spawn-monsters: <select>
				<option value='true'>true</option>
				<option value='false'>false</option>
				</select>
				
				
				<br>generate-structures: <select>
				<option value='true'>true</option>
				<option value='false'>false</option>
				</select>
				
				
				<br>view-distance: <select>
				<option value=1>1</option>
				<option value=2>2</option>
				<option value=3>3</option>
				<option value=4>4</option>
				<option value=5>5</option>
				<option value=6>6</option>
				<option value=7>7</option>
				<option value=8>8</option>
				<option value=9>9</option>
				<option value=10>10</option>
				<option value=11>11</option>
				<option value=12>12</option>
				<option value=13>13</option>
				<option value=14>14</option>
				<option value=15>15</option>
				</select>
				
				
				<br>motd: <input type='text' name='motd' placeholder='" . $conf["motd"] . "' />
				
				<br><br>
				<input type='button' class='btn btn-lg btn-primary' value='Submit Changes' />
			</form>
			";
}else{
	// new server.properties
}

echo "</div>";
?>
									