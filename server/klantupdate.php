<?php

error_reporting(E_ALL);
ini_set("display_errors",1);

require_once("config.php");
$db = new mysqli($dbserver, $dbuser, $dbpwd, $dbname);
if ($db->connect_errno){
    die("Error: ".$db->connect_error);
	}

// Haal de door de client aangeleverde gegevens uit de body van het request.
$inputjson = file_get_contents("php://input");
$data = json_decode($inputjson, TRUE);

// TODO: geparameteriseerde query gebruiken om SQL injectie te voorkomen, en ivm. de enkele quote.

$id = $data["id"];
$naam = $data["naam"];
$plaats = $data["plaats"];
$sql = "update klanten  set naam='$naam', plaats='$plaats'  where id=$id";
$ok = $db->query($sql);

// TODO: Bij een eventuele foutsituatie, beter en consistenter inpakken voor de client.
if ($db->errno){
	die("Query error: ".$db->error);
	}

// Geef resultaat terug aan de client.
$res = array("ok"=>$ok);
header("Content-Type: application/json");
echo(json_encode($res));
