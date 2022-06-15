<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
require_once('functions.php');
$pdo = pdo_connect();
if($_SESSION['connect'])
{
    header('location:index.php');
    exit;
}
else if(!empty($_COOKIE['id']) && !empty($_COOKIE['password']))
{
    $sql = $pdo->prepare('SELECT ID FROM `admin` WHERE ID = "'.$_COOKIE['id'].'" AND mdp = "'.$_COOKIE['password'].'"');
    $sql->execute();
    if($sql->rowCount() == 1)
    {
        header('location:index.php');
        exit;
    }
}

?>
<html>
    <head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Connection</title>
    </head>
    <body>
        <h1>Se connecter</h1>
        <form name="connection" method="post" action="action.php?e=connection">
            <p>
                <label for="email">Email</label>
                <input type="email" name="email" <?php if($_SESSION['email']){ echo 'value="'.strip_tags($_SESSION['email']).'"';} ?>/>
            </p>
            <p>
                <label for="password">Mot de passe</label>
                <input type="password" name="password" <?php if($_COOKIE['passwd_clair']){ echo 'value="'.$_COOKIE['passwd_clair'].'"';} ?>/>
               
            </p>    
            <button type="submit" name="submit">Se connecter</button>
        </form>
    </body>
</html>