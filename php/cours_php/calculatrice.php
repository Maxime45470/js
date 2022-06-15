<?php
//ini_set('display_errors',true);
if(isset($_POST['calculer']))
{
    if(!empty($_POST['nombre1']) && !empty($_POST['nombre2']) && !empty($_POST['operation']))
    {
        $nombre1 = (int) $_POST['nombre1'];
        $nombre2 = intval($_POST['nombre2']);
        if((!is_int($nombre1) || $nombre1 == 0) && (!is_int($nombre2) || $nombre2 == 0))
        {
            //echo 'veuillez entrer des chiffres !!!';
            header('location:index.php?MSG=erreur');
            exit;
        }
        // Condition avec if, elseif 
        if($_POST['operation'] == 'addition')
        {
            echo 'addition';
        }
        else if($_POST['operation'] == 'soustraction')
        {
            echo 'soustraction';
        }
        else if($_POST['operation'] == 'multiplication')
        {
            echo 'multiplication';
        }
        else if($_POST['operation'] == 'division')
        {
            echo 'division';
        } 
        // Fin condition if elseif
        // Début Switch
        switch($_POST['operation'])
        {
            case 'addition':
                $resultat = $nombre1+$nombre2; 
            break;
            case 'soustraction':
                $resultat = $nombre1-$nombre2;
            break;
            case 'multiplication':
                $resultat = $nombre1*$nombre2;
            break;
            case 'division':
                $resultat = $nombre1/$nombre2;
            break;
        }
        // Fin Switch
        echo $resultat;
    }
    else
    {
        if(empty($_POST['nombre1']))
        {
            header('location:index.php?MSG=nombre1');
            exit;
        }
        else if(empty($_POST['nombre2']))
        {
            header('location:index.php?MSG=nombre2');
            exit;
        }
        else if(empty($_POST['operation']))
        {
            header('location:index.php?MSG=operation');
            exit;
        }
    }
}
?>
<html>
    <head>
        <title>Ma calculatrice</title>
    </head>
    <body>
        <h1>Faire un calcul</h1>
        <?php
        if(!empty($_GET['MSG']))
        {
            echo '<div style="background:green;padding:10px;">';
            switch($_GET['MSG'])
            {
                case 'erreur':
                    echo 'Veuillez indiquer des chiffres';
                break;
                case 'nombre1':
                    echo 'Veuillez renseigner le nombre 1';
                break;
                case 'nombre2':
                    echo 'Veuillez renseigner le nombre 2';
                break;
                case 'operation':
                    echo 'Veuillez renseigner le signe opérateur';
                break;
            }
            echo '</div>';
        }
        ?>
        <form name="calculatrice" method="post" action="calcul.php">
            <label for="nombre1">Nombre 1</label>
            <input type="text" name="nombre1" />
            <label for="nombre2">Nombre 2</label>
            <input type="text" name="nombre2" />
            <label for="operation">Opération</label>
            <input type="radio" name="operation" value="addition">+<br />
            <input type="radio" name="operation" value="soustraction">-<br />
            <input type="radio" name="operation" value="multiplication">*<br />
            <input type="radio" name="operation" value="division">/<br />
            <button type="submit" name="calculer">Calculer</button>
        </form>
    </body>
</html>