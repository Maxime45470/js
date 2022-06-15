<?php
session_start();
require_once('..\template\fonction.php');
$sql = pdo_connect();


if(isset($_POST['submit'])) {
$request = $sql->prepare("INSERT INTO objet VALUES (NULL, :nom, :reference, :prix, :image)");
$request->execute(array(
    'nom' => $_POST['nom'],
    'reference' => $_POST['reference'],
    'prix' => $_POST['prix'],
    'image' => $_POST['image']
));
}


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
    <form method="POST">
        <span>Nom</span>
        <input type="text" name="nom" id="nom">
        <span>référence</span>
        <input type="text" name="reference" id="reference">
        <span>Prix</span>
        <input type="text" name="prix" id="prix">
        <span>Image</span>
        <input type="text" name="image" id="img">

        <button type="submit" name="submit">Envoyer</button>
    </form>
</body>

</html>