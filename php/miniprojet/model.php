<?php
function pdo_connect() {  //php data objet
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'db_php_olivet';
    
    try{
        return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME, $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exeption) {
        exit('Problème de connexion à la base de données');
    }
}

function create($nom, $prenom, $email, $tel, $photo, $password, $date) {
    try{
        $pdo = pdo_connect();
        $sql = "INSERT INTO `admin` (`id`, `nom`, `prenom`, `email`, `telephone`, `photo`, `mot_de_passe` , `date_inscription`) VALUES (NULL, '$nom', '$prenom', '$email', '$tel', '$photo', '$password', '$date');";
        $pdo->exec($sql);
    } catch (PDOException $a) {
        echo $sql . $a->getMessage();
    }
}

?>