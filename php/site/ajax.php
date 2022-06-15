<?php
// Fichier AJAX Devise
// On initialise le tableau des messages
$message = array();
// Fonction de connection à la BDD
function pdo_connect(){
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'via_orleans';

    try{
        return new PDO('mysql:host='.$DATABASE_HOST. ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch(PDOException $exception) {
        exit('failed to connect bdd');
    }
}
// On vérifie que les champs sont pas vide
if(!empty($_GET['taux1']) && !empty($_GET['taux2']) && !empty($_GET['montant1']) && !empty($_GET['montant2']))
{
    // On se connecte à la BDD
    $pdo = pdo_connect();
    // On prépare notre requête sql
    $sql = 'INSERT INTO `devise` SET 
                            taux1 = "'.strip_tags($_POST['taux1']).'",
                            taux2 = "'.strip_tags($_POST['taux2']).'",
                            montant1 = "'.strip_tags($_POST['montant1']).'",
                            montant2 = "'.strip_tags($_POST['montant2']).'",
                            date = CURDATE()';
    // On exécute la requête
    if($pdo->exec($sql))
    {
        // On affiche un message succès
        $message['success'] = 'Devise enregistré avec succès';
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
    if(empty($_POST['taux1'])) $message['error'] = 'Veuillez renseigner la première devise';
    else if(empty($_POST['taux2'])) $message['error'] = 'Veuillez renseigner la deuxième devise';
    else if(empty($_POST['montant1'])) $message['error'] = 'Veuillez renseigner le montant';
    else if(empty($_POST['montant2'])) $message['error'] = 'Erreur lors de la conversion';
}
// On retour les messages au format JSON (à traiter ensuite avec le JS)
echo json_encode($message);

?>