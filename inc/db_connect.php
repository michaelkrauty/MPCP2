<?php
/**
 *
 * ##########################
 * # Database Controller	#
 * ##########################
 * 
 * #######################################################
 * Contents
 * 
 * 
 * 1) PHP Error Reporting
 * 
 * 
 * 2) Includes
 * 
 * 
 * 3) Create User
 * 
 * createUser($username, $email, $key, $password)
 * String "ERROR:USER_EXISTS",
 * String "SUCCESS"
 * 
 * 
 * 4) Get User
 * 
 * getUser($email/$id)
 * String "ERROR:USER_DOES_NOT_EXIST",
 * Array ("id", "email", "username", "password", "date_registered")
 * 
 * 
 * 5) Get User Servers
 * 
 * getUserServers($id)
 * String "ERROR:USER_HAS_NO_SERVERS",
 * Array ("id", "owner", "host", port", "memory", "jar", "suspended", "name")
 * 
 * 6) Edit User
 * 
 * editUser($email, $username, $password)
 * String "ERROR:USER_DOES_NOT_EXIST",
 * String "SUCCESS"
 * 
 * 
 * 7) Create Server
 * 
 * createServer($owner, $host, $port, $memory, $jar)
 * String "ERROR:USER_DOES_NOT_EXIST",
 * String "SUCCESS"
 * 
 * 
 * 8) Get Server
 * 
 * getServer($id)
 * String "ERROR:SERVER_DOES_NOT_EXIST
 * Array ("id", "owner", "host", "port", "memory", "jar", "suspended", "name")
 * 
 * 
 * 9) Edit Server
 * 
 * editServer($id, $owner, $host, $port, $memory, $jar, $suspended, $name)
 * String "ERROR:SERVER_DOES_NOT_EXIST
 * String "SUCCESS"
 * 
 * 
 * 10) Create Jar
 * 
 * createJar($mod, $version, $build, $location, $startup_args)
 * String "ERROR:JAR_ALREADY_EXISTS"
 * String "SUCCESS"
 * 
 * 
 * 11) Get Jar
 * 
 * getJar($location/$id)
 * String "ERROR:INCORRECT_INPUT"
 * String "ERROR:JAR_DOES_NOT_EXIST"
 * Array ("id", "mod", "version", "build", "location", "startup_args")
 * 
 * 
 * 12) Edit Jar
 * 
 * editJar($id, $mod, $version, $build, $location, $startup_args)
 * String "ERROR:JAR_DOES_NOT_EXIST"
 * String "SUCCESS"
 * 
 * 
 * #######################################################
 * 
 * ##################################
 * # @ Copyright (c) MPCP2			#
 * # @ Version 1.0					#
 * # @ Author - Michael Krautkramer	#
 * ##################################
*/

// 1) PHP Error Reporting
ini_set('display_errors', 'On');
error_reporting(E_ALL);


// 2) Includes
include_once "config.php";

// 3) Create User
function createUser($email, $username, $password){
	date_default_timezone_set("America/Los_Angeles");
	$date = date("m-j-o G:i");
	$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
	$stmt = $mysqli->prepare("SELECT * FROM `users` WHERE `username`=? LIMIT 1");
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$stmt->store_result();
	if($stmt->num_rows == 1){
		return "ERROR:USER_EXISTS";
	}
	$stmt->bind_result($db_id, $db_username, $db_email, $db_password, $db_date);
	$stmt->fetch();
	
	$stmt = $mysqli->prepare("INSERT INTO `users`(`ID`, `email`, `username`, `password`, `date_registered`) VALUES (0,?,?,?,?)");
	$stmt->bind_param("ssss", $email, $username, $password, $date);
	$stmt->execute();
	//user created
	return "SUCCESS";
}

// 4) Get User
function getUser($in){
	if(!is_string($in) && !is_int($in)){
		return "ERROR:INCORRECT_INPUT";
	}
	$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
	if(is_string($in)){
		$stmt = $mysqli->prepare("SELECT * FROM `users` WHERE `email`=? LIMIT 1");
		$stmt->bind_param("s", $in);
	}
	if(is_int($in)){
		$stmt = $mysqli->prepare("SELECT * FROM `users` WHERE `id`=? LIMIT 1");
		$stmt->bind_param("i", $in);	
	}
	$stmt->execute();
	$stmt->store_result();
	if($stmt->num_rows != 1){
		return "ERROR:USER_DOES_NOT_EXIST";
	}
	
	$stmt->bind_result($db_id, $db_email, $db_username, $db_password, $db_date_registered);
	$stmt->fetch();
	$result["id"] = $db_id;
	$result["email"] = $db_email;
	$result["username"] = $db_username;
	$result["password"] = $db_password;
	$result["date_registered"] = $db_date_registered;
	return $result;
}

// 5) Get User Servers
function getUserServers($id){
	$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
	$stmt = $mysqli->prepare("SELECT * FROM `servers` WHERE `owner`=?");
	$stmt->bind_param("s", $id);
	$stmt->execute();
	$stmt->store_result();
	if($stmt->num_rows < 1){
		return "ERROR:USER_HAS_NO_SERVERS";
	}
	$stmt->bind_result($db_id, $db_owner, $db_host, $db_port, $db_memory, $db_jar, $db_suspended, $db_name);
	for($i = 0; $i < $stmt->num_rows; $i++){
		$stmt->fetch();
		$result[$i]["id"] = $db_id;
		$result[$i]["owner"] = $db_owner;
		$result[$i]["host"] = $db_host;
		$result[$i]["port"] = $db_port;
		$result[$i]["memory"] = $db_memory;
		$result[$i]["jar"] = $db_jar;
		$result[$i]["suspended"] = $db_suspended;
		$result[$i]["name"] = $db_name;
	}
	return $result;
	
}

// 6) Edit User
function editUser($email, $username, $password){
	$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
	$stmt = $mysqli->prepare("SELECT * FROM `users` WHERE `email`=? LIMIT 1");
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($db_id, $db_username, $db_email, $db_password);
	$stmt->fetch();
	if($stmt->num_rows != 1){
		return "ERROR:USER_DOES_NOT_EXIST";
	}

	$stmt = $mysqli->prepare("UPDATE `users` SET `email`=?, `username`=?, `password`=? WHERE username=?");
	$stmt->bind_param("ssss", $email, $username, $password, $username);
	$stmt->execute();
	return "SUCCESS";
}

// 7) Create Server
function createServer($owner, $host, $port, $memory, $jar){
	$getUser = getUser($owner);
	if($getUser != "ERROR:USER_DOES_NOT_EXIST"){
		$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
		$stmt = $mysqli->prepare("INSERT INTO `servers`(`id`, `owner`, `host`, `port`, `memory`, `jar`, `suspended`) VALUES (0,?,?,?,?,?,0)");
		$stmt->bind_param("isiis", $owner, $host, $port, $memory, $jar);
		$stmt->execute();
		return "SUCCESS";
	}else{
		return $getUser;
	}
}

// 8) Get Server
function getServer($id){
	$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
	$stmt = $mysqli->prepare("SELECT * FROM `servers` WHERE `id`=? LIMIT 1");
	$stmt->bind_param("s", $id);
	$stmt->execute();
	$stmt->store_result();
	if($stmt->num_rows != 1){
		return "ERROR:SERVER_DOES_NOT_EXIST";
	}

	$stmt->bind_result($id, $ownerid, $host, $port, $memory, $jarid, $suspended, $name);
	$stmt->fetch();
	$result["id"] = $id;
	$result["ownerid"] = $ownerid;
	$result["host"] = $host;
	$result["port"] = $port;
	$result["memory"] = $memory;
	$result["jarid"] = $jarid;
	$result["suspended"] = $suspended;
	$result["name"] = $name;
	return $result;
}

// 9) Edit Server
function editServer($id, $owner, $host, $port, $memory, $jar, $suspended, $name){
	$getServer = getServer($id);
	if($getServer == "ERROR:SERVER_DOES_NOT_EXIST"){
		return $getServer($id);
	}
	$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
	$stmt = $mysqli->prepare("UPDATE `servers` SET `id`=?,`owner`=?,`host`=?,`port`=?,`memory`=?,`jar`=?,`suspended`=?, `name`=? WHERE `id`=?");
	$stmt->bind_param("iisiisii", $id, $owner, $host, $port, $memory, $jar, $suspended, $name, $id);
	$stmt->execute();
	$stmt->store_result();
	return "SUCCESS";
}

// 10) Create Jar
function createJar($name, $mod, $version, $build, $location, $startup_args){
	$getJar = getJar($location);
	if(is_array($getJar)){
		return "ERROR:JAR_ALREADY_EXISTS";
	}
	$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
	$stmt = $mysqli->prepare("INSERT INTO `jars`(`id`, `name`, `mod`, `version`, `build`, `location`, `startup_args`) VALUES (0,?,?,?,?,?,?)");
	$stmt->bind_param("ssssss", $name, $mod, $version, $build, $location, $startup_args);
	$stmt->execute();
	return "SUCCESS";
}

// 11) Get Jar
function getJar($in){
	$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
	if(!(is_int($in) || is_string($in))){
		return "ERROR:INCORRECT_INPUT";
	}
	if(is_int($in)){
		$stmt = $mysqli->prepare("SELECT * FROM `jars` WHERE `id`=? LIMIT 1");
		$stmt->bind_param("i", $in);
	}
	if(is_string($in)){
		$stmt = $mysqli->prepare("SELECT * FROM `jars` WHERE `location`=? LIMIT 1");
		$stmt->bind_param("s", $in);
	}
	$stmt->execute();
	$stmt->store_result();
	if($stmt->num_rows != 1){
		return "ERROR:JAR_DOES_NOT_EXIST";
	}

	$stmt->bind_result($db_id, $db_name, $db_mod, $db_version, $db_build, $db_location, $db_startup_args);
	$stmt->fetch();
	$result["id"] = $db_id;
	$result["name"] = $db_name;
	$result["mod"] = $db_mod;
	$result["version"] = $db_version;
	$result["build"] = $db_build;
	$result["location"] = $db_location;
	$result["startup_args"] = $db_startup_args;
	return $result;
}

// 12) Edit Jar
function editJar($id, $name, $mod, $version, $build, $location, $startup_args){
	$getJar = getJar($id);
	if($getJar == "ERROR:JAR_DOES_NOT_EXIST"){
		return $getJar;
	}
	$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
	$stmt = $mysqli->prepare("UPDATE `jars` SET `id`=?,`name`=?,mod`=?,`version`=?,`build`=?,`location`=?,`startup_args`=? WHERE `id`=?");
	$stmt->bind_param("issssssi", $id, $name, $mod, $version, $build, $location, $startup_args, $id);
	$stmt->execute();
	$stmt->store_result();
	return "SUCCESS";
}

?>