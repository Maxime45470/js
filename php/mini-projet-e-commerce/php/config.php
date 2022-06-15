<?php


    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'db_sono_video';

    $users ="admin";

    $base= mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS);
    mysqli_select_db($base, $DATABASE_NAME);

    ?>