<?php
ini_set('display_errors',false);
session_start();
require_once('functions.php');
$pdo = pdo_connect();
if($_SESSION['connect'])
{
    header('location:index.php');
    exit;
}
else if (!empty($_COOKIE['id']) && empty($_COOKIE['password']))
{
    $sql = $pdo->prepare('SELECT id FROM `admin` WHERE id = "'.($_COOKIE['id']).'"AND mot_de_passe = "'.($_COOKIE['password']).'"');
    $sql->execute();
    if($sql->rowCount() == 1)
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
    <title>Connexion</title>
</head>
<body>
    <h1 class="insc">Connexion</h1>
    <div class="formulaire2">
    <form method="post" action="action.php?e=connection">
        <p>
            <label for="email">Email</label>
            <input type="email" name="email" <?php if($_SESSION['email']) echo 'value="'.strip_tags($_SESSION['email']).'"';?>/>
        </p>
        <p>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" <?php if($_COOKIE['password_clair']) echo 'value="'.$_COOKIE['password_clair'].'"';?>/>
            <?php
           // echo $_COOKIE['passwrd'];
            ?>
        </p>
        <button type="submit" name="submit">Connection</button>
    </form>
    </div>

</body>
</html>