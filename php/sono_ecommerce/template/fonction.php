<?php



function pdo_connect(){
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'db_sono';

    try{
        return new PDO('mysql:host='.$DATABASE_HOST. ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch(PDOException $exception) {
        exit('failed to connect bdd');
    }
}



?>