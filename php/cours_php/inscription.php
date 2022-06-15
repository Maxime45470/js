<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
ini_set('display_errors',false);
if(!empty($_SESSION['formulaire']))
{
    $formulaire = unserialize($_SESSION['formulaire']);
    /*echo '<pre>';
    print_r($formulaire);
    echo '</pre>';
    echo $_SESSION['formulaire'];*/
}
?>

<html>
    <head>
        <title>Inscription</title>
</head>
<body>
    <h1>Inscription</h1>
    <form name="inscription" enctype="multipart/form-data" method="post" action="action.php?e=inscription">
    <p>
        <label for="nom">Nom :</label>
        <input type="text" name="nom" <?php if($formulaire['nom']){ echo 'value="'.$formulaire['nom'].'"'; } ?> />
    </p>
    <p>
        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" <?php if($formulaire['prenom']){ echo 'value="'.$formulaire['prenom'].'"';} ?>/>
    </p>
    <p>
        <label for="email">Email :</label>
        <input type="email" name="email" <?php if($formulaire['email']) { echo 'value="'.$formulaire['email'].'"';} ?>/>
    </p>
    <p>
        <label for="telephone">Téléphone</label>
        <input type="tel" name="telephone" <?php if($formulaire['telephone']) { echo 'value="'.$formulaire['telephone'].'"';} ?> />
    </p>
    <p>
        <label for="photo">Photo de profil</label>
        <input type="file" name="photo" />
    </p>
    <button type="submit" name="submit">Inscription</button>
    </form>
</body>
</html>