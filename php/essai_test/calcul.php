<?php
include_once('functions.php');
$result = calculer($_POST['nombre1'],$_POST['nombre2'],$_POST['operation']);
if($result)
{
    echo $result;

} else echo 'Une erreur est survenue';
?>