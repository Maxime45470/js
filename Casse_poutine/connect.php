<?php
/*
function pdo_connect(){
    $DATABASE_HOST = 'localhost';
    $DATABASE_NAME = 'jedsfxve_db_score';
    $DATABASE_USER = 'jedsfxve_maxime';
    $DATABASE_PASS = 'Jean-maxadmin1988';

    try{
        return new PDO('mysql:host='.$DATABASE_HOST. ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch(PDOException $exception) {
        exit('failed to connect bdd');
    }
}

?>

*/

function pdo_connect(){
    $DATABASE_HOST = 'casse';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'db_score';

    try{
        return new PDO('mysql:host='.$DATABASE_HOST. ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch(PDOException $exception) {
        exit('failed to connect bdd');
    }
}

?>