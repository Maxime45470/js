<?php
require_once('model.php');
$pdo =pdo_connect();

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

<form method="post">
        <input type="text" name="nom" placeholder="Nom">
        <input type="text" name="prenom" placeholder="Prenom">
        <input type="text" name="email" placeholder="Email">
        <input type="number" name="tel" placeholder="Téléphone">
        <input type="text" name="photo" placeholder="Url Photo">
        <input type="password" name="password" placeholder="Password">
        <input type="date" name="date" placeholder="date">

        <button name='valid' type='submit'>GO</button>
    </form>

</body>
</html>


<?php

if(isset($_POST['valid'])){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $photo = $_POST['photo'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $date = $_POST['date'];
    echo "<script type='text/javascript'>document.location.replace('voir2.php');</script>";
    die(create($nom, $prenom, $email, $tel, $photo, $password, $date));
   
}

?>
