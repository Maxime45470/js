<?php
session_start();
require_once('../models/db.php');
$sql = pdo_connect();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <div class="box">
        <form method="POST">
            <span>Go</span>
            <div>
                <input type="text" name="username" placeholder="Username" require>
            </div>

            <div>
                <input type="password" name="password" placeholder="Password" require>
            </div>

            <button type="submit" name="submit">GO GO GO</button>
        </form>

    </div>

</body>

</html>

<?php


$message = "mdp ou user incorrect";     // message d'erreur 

if(isset($_POST['submit']) && !empty($_POST['username']) && !empty($_POST['password'])){
    $username = $_POST['username'];
    $request = $sql->prepare('SELECT * FROM membre WHERE username=:utilisateur');
    $request->execute(["utilisateur" => $username]);
    $utilisateur = $request->fetch(PDO::FETCH_ASSOC);
  
  if($utilisateur && password_verify($_POST["password"], $utilisateur['password'])){
      $_SESSION['username'] = $username;
      $_SESSION['isAdmin'] = $utilisateur['admin'] ;
      header('Location:./ss.php');
  
    }else{
      echo '<div id = "message">'.($message).'<div>';
    }
  }
?>