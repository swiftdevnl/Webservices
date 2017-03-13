<?php

// TODO: Bij een eventuele foutsituatie, beter en consistenter inpakken voor de client.

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

$id = intval($data["id"]);
$naam = $data["naam"];
$plaats = $data["plaats"];

if (!$id) {
	die("Query error: invalid id");
	}

$st = $db->prepare("update klanten set naam=?, plaats=? where id=?");

if ($db->errno){
	die("Query statement error: ".$db->error);
	}

$st->bind_param("ssi", $naam, $plaats, $id);
$ok = $st->execute();

if ($db->errno){
	die("Query execute error: ".$db->error);
	}

// Geef resultaat terug aan de client.
$res = array("ok"=>$ok);
header("Content-Type: application/json");
echo(json_encode($res));
