<?php
function pdo_connect() {  //php data objet
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'db_formulaire';
    
    try{
        return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME, $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exeption) {
        exit('Problème de connexion à la base de données');
    }
}

function create($nom, $prenom, $email, $tel, $sexe, $sujet, $mess) {
    try{
        $pdo = pdo_connect();
        $sql = "INSERT INTO `contact` (`id`, `nom`, `prenom`, `email`, `tel`, `sexe`, `sujet` , `mess`) VALUES (NULL, '$nom', '$prenom', '$email', '$tel', '$sexe', '$sujet', '$mess');";
        $pdo->exec($sql);
    } catch (PDOException $a) {
        echo $sql . $a->getMessage();
    }
}

?>