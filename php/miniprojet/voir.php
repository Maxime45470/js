<?php

require_once('model.php');
$pdo =pdo_connect();
$sql = $pdo->prepare('SELECT * FROM categorie');
$sql->execute();
$categories = $sql->fetchAll(\PDO::FETCH_ASSOC);
?>


<?php 
/*foreach($categories as $categorie) :?>
<?=$categorie['url']."<br>"?>
<?=$categorie['nom']."<br>"?>
<?=$categorie['id']."<br>"?>
<?php endforeach ?>
*/
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

<table>
   
    <tbody>
        <tr>
            <td>url</td>
            <td>nom</td>
            <td>id</td>
        </tr>
        <?php foreach($categories as $categorie) :?>

            <tr>
                <td><?=$categorie['url']?></td>
                <td><?=$categorie['nom']?></td>
                <td><?=$categorie['id']?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>


    
</body>
</html>

