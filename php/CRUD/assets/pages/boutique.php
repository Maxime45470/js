<?php
session_start();
require_once('../models/db.php');
$sql = pdo_connect();

if(isset($_SESSION['isAdmin'])) {
    $request = $sql->prepare('SELECT * FROM membre');
    $request->execute();
    $membres = $request->fetchAll(PDO::FETCH_ASSOC);


} else {
    header('Location:connexion.php');
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
    <table>
        <thead>
            <th>username</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>img</th>
            <?php
            if($_SESSION['isAdmin'] == 1) {   // si l'utilisateur est admin on affiche le bouton de suppression 
                ?>
                <th scope="col-md">Actions</th>
                <?php
            }
            ?>


        </thead>

        <?php
        foreach($membres as $membre) {
            ?>
            <tr>
                <td><?= $membre['username'] ?></td>
                <td><?= $membre['l_name'] ?></td>
                <td><?= $membre['f_name'] ?></td>
                <td><img src="<?= $membre['img'] ?>" width="40px" alt="logo"></td>
                
            </tr>
            <?php
        }
            ?>
    </table>
</body>
</html>