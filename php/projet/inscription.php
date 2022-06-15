<?php
session_start();
ini_set('display_errors',false);
if(!empty($_SESSION['formulaire']))
{
    $formulaire = unserialize($_SESSION['formulaire']);
   /* echo '<pre>';
    print_r($formulaire);
    echo '</pre>';
    echo $_SESSION['formulaire'];*/
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>inscription</title>
</head>
<body>
    <h1 class="insc">Formulaire d'inscription</h1>

<div class="formulaire">
    <form name="inscription" enctype="multipart/form-data" method="post" action="action.php?e=inscription">
        <div class="name">
            <p>
                <label for="nom">Nom :</label>
                <input type="text" name="nom" <?php if($formulaire['nom']) echo 'value="'.$formulaire['nom'].'"';?>/>
            </p>        
            <p>
                <label for="prenom">Prenom :</label>
                <input type="text" name="prenom" <?php if($formulaire['prenom']) echo 'value="'.$formulaire['prenom'].'"';?>/>
            </p>
        </div> 
        <div class="name">
            <p>
                <label for="nom">Email :</label>
                <input type="email" name="email" <?php if($formulaire['email']) echo 'value="'.$formulaire['email'].'"';?>/>
            </p>
            <p>
                <label for="telephone">Téléphone :</label>
                <input type="tel" name="telephone" <?php if($formulaire['telephone']) echo 'value="'.$formulaire['telephone'].'"';?>/>
            </p>
        </div>
        <div class="photo">
            <p>
                <label for="photo">Photo de profil</label>
                <input class="fichier" type="file" name="photo"/>
            </p>
        </div>
            <button type="submit" name="submit">Inscription</button>
    </form>
</div>
</body>
</html>