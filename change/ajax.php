<?php
// Fichier AJAX Devise
// On initialise le tableau des messages
$message = array();
// Fonction de connection à la BDD
function pdo_connect(){
    $DATABASE_HOST = 'change';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'db_php_olivet';

    try{
        return new PDO('mysql:host='.$DATABASE_HOST. ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch(PDOException $exception) {
        exit('failed to connect bdd');
    }
}
// On vérifie que les champs sont pas vide
if(!empty($_GET['sel1']) && !empty($_GET['sel2']) && !empty($_GET['montant']) && !empty($_GET['resultat2']))
{
    // On se connecte à la BDD
    $pdo = pdo_connect();
    // On prépare notre requête sql
    $sql = 'INSERT INTO `devise` SET 
                            Devise_entree = "'.strip_tags($_GET['sel1']).'",
                            Devise_sortie = "'.strip_tags($_GET['sel2']).'",
                            Montant_entree = "'.strip_tags($_GET['montant']).'",
                            Montant_sortie = "'.strip_tags($_GET['resultat2']).'",
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
    if(empty($_GET['sel1'])) $message['error'] = 'Veuillez renseigner la première devise';
    else if(empty($_GET['sel2'])) $message['error'] = 'Veuillez renseigner la deuxième devise';
    else if(empty($_GET['montant'])) $message['error'] = 'Veuillez renseigner le montant';
    else if(empty($_GET['resultat2'])) $message['error'] = 'Erreur lors de la conversion';
}
// On retour les messages au format JSON (à traiter ensuite avec le JS)
echo json_encode($message);

?>