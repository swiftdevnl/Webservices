<?php

// klanten.php

// Laat errors en warnings zien, als die optreden
error_reporting(E_ALL);
ini_set("display_errors",1);

// Maak verbinding met de database
require_once("config.php");
$db=new mysqli($dbserver, $dbuser, $dbpwd, $dbname);
if ($db->connect_errno){
    die("Error: ".$db->connect_error);
    }

// Lees alle gegevens uit de klanten tabel in een recordset
$rs=$db->query("select * from klanten");
if ($db->errno){
    die("Query error: ".$db->error);
    }

// Lees de recordset in in een array    
$data = array();
while ($row = $rs->fetch_assoc()) {
    $data[] = $row;  
    }

if ($db->errno){
    die("Recordset error: ".$db->error);
    }

// Vertel de aanroeper dat we een JSON pakket teruggeven als response
header("Content-Type: application/json");

// Return de klantendata, geencodeerd als JSON
echo(json_encode($data));
