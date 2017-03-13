<?php

// klantenzoek.php

// Nagenoeg identiek aan klanten.php (zie comments aldaar), met het verschil
// dat deze webservice een parameter 'zoek' accepteert.
//
// Als de zoekparameter leeg is, of ontbreekt, return dan informatie van alle klanten.
//
// Als de zoekparameter wel gegeven is, return dan het klant-id, naam en plaats van de klanten
// wiens naam het zoekwoord bevat.

error_reporting(E_ALL);
ini_set("display_errors",1);

require_once("config.php");
$db = new mysqli($dbserver, $dbuser, $dbpwd, $dbname);
if ($db->connect_errno){
    die("Database connectie error: ".$db->connect_error);
	}
	
if (empty($_GET["zoek"])) {
    $rs = $db->query("select id, naam, plaats from klanten order by naam");
	}
else {
    $zoek = "%".$_GET["zoek"]."%";
	$st = $db->prepare("select id, naam, plaats from klanten where naam like ? order by naam");
	$st->bind_param("s", $zoek);
    $st->execute();
	$rs = $st->get_result();
	}

if ($db->errno){
    die("Query error: ".$db->error);
	}

$data = array();
while ($row = $rs->fetch_assoc()) {
    $data[] = $row;  
	}

if ($db->errno){
    die("Recordset error: ".$db->error);
	}

header("Content-Type: application/json");
echo(json_encode($data));
