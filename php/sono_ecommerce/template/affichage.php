<?php
// On importe notre fichier functions.php qui contient la connection à la BDD
require_once('fonction.php');
// On appelle notre function pdo_connect() pour effectuer la connexion à la BDD
$pdo = pdo_connect();

// On prépare notre requête sql
$sql = "SELECT * FROM sono ORDER BY id DESC <7";
$result = $mysqli->query($sql);
$mysqli->close(); 


?>