<?php

function pdo_connect(){ // se connecte a la bdd  // pdo = Php Data Object
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'db_crud';

    try{
        return new PDO('mysql:host='.$DATABASE_HOST. ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } 
    catch(PDOException $exception){
        exit('failed to connect bdd');
    }
} 





?>