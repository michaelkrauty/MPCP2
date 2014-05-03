<?php
function screenOnline(){
	return strpos(shell_exec("screen -list mc/"), "firstpvp");
}
function executeCommand($command){
	if(screenOnline()){
		shell_exec("screen -x mc/firstpvp -p 0 -X stuff \"`printf \"$command\r\"`\";");
	}
}

if(isset($_GET["PERMISSION:essentials.top"])){
	$perm[0] = "essentials.top";
}
if(isset($_GET["PERMISSION:essentials.back"])){
	$perm[0] = "essentials.back";
}
if(isset($_GET["PERMISSION:essentials.back.ondeath"])){
	$perm[0] = "essentials.back.ondeath";
}
if(isset($_GET["PERMISSION:essentials.sethome.multiple"])){
	$perm[0] = "essentials.sethome.multiple";
}
if(isset($_GET["PERMISSION:horses.set.user"])){
	$perm[0] = "horses.set.user";
}
if(isset($_GET["PERMISSION:essentials.ptime"])){
	$perm[0] = "essentials.ptime";
}
if(isset($_GET["PERMISSION:essentials.repair"])){
	$perm[0] = "essentials.repair";
}
if(isset($_GET["PERMISSION:essentials.repair.enchanted"])){
	$perm[0] = "essentials.repair.enchanted";
}
if(isset($_GET["PERMISSION:essentials.repair.all"])){
	$perm[0] = "essentials.repair.all";
}
if(isset($_GET["PERMISSION:essentials.feed"])){
	$perm[0] = "essentials.feed";
}
if(isset($_GET["PERMISSION:essentials.hat"])){
	$perm[0] = "essentials.hat";
}
if(isset($_GET["PERMISSION:essentials.workbench"])){
	$perm[0] = "essentials.workbench";
}
if(isset($_GET["PERMISSION:essentials.firework"])){
	$perm[0] = "essentials.firework";
}
if(isset($_GET["PERMISSION:essentials.worth"])){
	$perm[0] = "essentials.worth";
}
if(isset($_GET["PERMISSION:essentials.sell"])){
	$perm[0] = "essentials.sell";
}
if(isset($_GET["PERMISSION:essentials.balancetop"])){
	$perm[0] = "essentials.balancetop";
}
if(isset($_GET["PERMISSION:essentials.depth"])){
	$perm[0] = "essentials.depth";
}
if(isset($_GET["PERMISSION:essentials.getpos"])){
	$perm[0] = "essentials.getpos";
}
if(isset($_GET["PERMISSION:essentials.compass"])){
	$perm[0] = "essentials.compass";
}
if(isset($_GET["PERMISSION:essentials.msg.color,essentials.chat.color"])){
	$perm[0] = "essentials.msg.color";
	$perm[1] = "essentials.chat.color";
}
if(isset($_GET["PERMISSION:essentials.afk"])){
	$perm[0] = "essentials.afk";
}
if(isset($_GET["PERMISSION:essentials.motd"])){
	$perm[0] = "essentials.motd";
}
if(isset($_GET["PERMISSION:essentials.me"])){
	$perm[0] = "essentials.me";
}
if(isset($_GET["PERMISSION:essentials.mail.send"])){
	$perm[0] = "essentials.mail.send";
}
if(isset($_GET["PERMISSION:essentials.nick"])){
	$perm[0] = "essentials.nick";
}
if(isset($_GET["PERMISSION:essentials.nick.color"])){
	$perm[0] = "essentials.nick.color";
}
if(isset($_GET["PERMISSION:essentials.seen,essentials.seen.banreason"])){
	$perm[0] = "essentials.seen";
	$perm[1] = "essentials.seen.banreason";
}
if(isset($_GET["PERMISSION:essentials.clearinventory"])){
	$perm[0] = "essentials.clearinventory";
}
if(isset($_GET["PERMISSION:essentials.ping"])){
	$perm[0] = "essentials.ping";
}
if(isset($_GET["PERMISSION:essentials.keepxp"])){
	$perm[0] = "essentials.keepxp";
}
if(isset($_GET["PERMISSION:essentials.signs.color"])){
	$perm[0] = "essentials.signs.color";
}
if(isset($_GET["PERMISSION:essentials.signs.magic"])){
	$perm[0] = "essentials.signs.magic";
}
if(isset($_GET["PERMISSION:essentials.signs.format"])){
	$perm[0] = "essentials.signs.format";
}
if(isset($_GET["PERMISSION:stats.signs.place,stats.signs.destroy"])){
	$perm[0] = "stats.signs.place";
	$perm[1] = "stats.signs.destroy";
}
if(isset($_GET["PERMISSION:auction.start"])){
	$perm[0] = "auction.start";
}
if(isset($_GET["PERMISSION:whatisit.use"])){
	$perm[0] = "whatisit.use";
}
if(isset($_GET["PERMISSION:automessage.stopdefault"])){
	$perm[0] = "-automessage.receive.default";
}

if(isset($perm[0])){
	executeCommand("sudo " . $_SESSION["username"] . " buyperms buy " . $_SESSION["username"] . " " . $perm[0]);
}
if(isset($perm[1])){
	executeCommand("sudo " . $_SESSION["username"] . " buyperms buy " . $_SESSION["username"] . " " . $perm[1]);
}
?>