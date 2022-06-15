<?php

$message = array();

require_once('connect.php');


if(!empty($_GET['pseudo']) && ($_GET['score'] != 0))
{
    // On se connecte à la BDD
    $pdo = pdo_connect();
    // On prépare notre requête sql
    $sql = 'INSERT INTO `casse_brique` SET 
                            pseudo = "'.strip_tags($_GET['pseudo']).'",
                            score = "'.strip_tags($_GET['score']).'"';
    // On exécute la requête
    if($pdo->exec($sql))
    {
        // On affiche un message succès

        $message['success'] = 'Score enregistré avec succès';
    }
    // Si il y a une erreur avec la BDD
    else
    {
        $message['error'] = "Erreur lors de l'insertion dans la BDD";
    }
}
// Si un des champs n'est pas vide
else
{
    if(empty($_GET['pseudo'])) $message['error'] = 'Veuillez renseigner votre pseudo';
}
// On retour les messages au format JSON (à traiter ensuite avec le JS)
echo json_encode($message);

?>