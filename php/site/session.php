<?php
session_start();
$_SESSION['formation'] = 'développeur web & web mobile';
setcookie('formation','développeur web',(time()+86400));
$_COOKIE['formation'];

?>