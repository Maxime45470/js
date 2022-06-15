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
        <input type="text" name="nom" placeholder="nom">
        <input type="text" name="url" placeholder="url">
        <button name='valid' type='submit'>GO</button>
    </form>
    
</body>
</html>

<?php

if(isset($_POST['valid'])){
    $nom = $_POST['nom'];
    $url = $_POST['url'];
  
    die(create($nom, $url));
}
?>
