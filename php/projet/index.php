<?php
ini_set('display_errors',false);
session_start();
require_once('functions.php');
$pdo = pdo_connect();

if(($_SESSION['connect']) && (!empty($_COOKIE['id']) && !empty($_COOKIE['password'])))
{    
   
    $sql = $pdo->prepare('SELECT id FROM `admin` WHERE ID = "'.$_COOKIE['id'].'"AND mot_de_passe = "'.$_COOKIE['password'].'"');
    $sql->execute();
    $result = $sql->fetch(PDO::FETCH_OBJ);
  
        if($sql->rowCount() == 0)
        {
            header('location:login.php?MSG=1');
            exit;
        }
        else
        {
            header('location:index.php');
            exit;
        }
} 



    
   




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

<h1 class="insc">Bonjour</h1>

        
    
</body>
</html>