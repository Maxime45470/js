<?php
session_start();
require_once '../models/db.php';
$sql = pdo_connect();
    if(isset($SESSION['isAdmin'])) {
        if(isset($_POST['submit']) && !empty($_POST['username']) && !empty($_POST['password'])&& !empty($_POST['f_name']) && !empty($_POST['l_name']) && !empty($_POST['img'])) {
            $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $request = $sql->prepare("INSERT INTO membre VALUES (NULL, :username, :password, :f_name, :l_name, :admin, :img)");
            $request = execute([
                'username' => $_POST['username'],
                'password' => $hash,
                'f_name' => $_POST['f_name'],
                'l_name' => $_POST['l_name'],
                'admin' => (int)isset($_POST['admin']),
                'img' => $_POST['img'],
            ]);
            header('Location:connexion.php');
        }
    } else {
        header('Location:index.php');
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>

    <title>Document</title>
</head>

<body>

    <div class="container">
        <div class="title">Inscription</div>
        <div class="content">
            <form methode="POST">
                <div class="user-box">
                    <div class="input-box">
                        <span class="detail">User</span>
                        <input type="text" placeholder="Entrer votre username" name="username">
                    </div>
                    <div class="input-box">
                        <span class="detail">mot de passe </span>
                        <input type="password" placeholder="Entrer votre mdp" name="password">
                    </div>
                    <div class="input-box">
                        <span class="detail">Prénom</span>
                        <input type="text" placeholder="Entrer votre prenom" name="f_name">
                    </div>
                    <div class="input-box">
                        <span class="detail">Nom</span>
                        <input type="text" placeholder="Entrer votre nom" name="l_name">
                    </div>
                    <div class="input-box">
                        <span class="detail">img</span>
                        <input type="text" placeholder="Entrer votre url" name="img">
                    </div>
                    <div class="input-box">
                        <span class="detail">admin</span>
                        <input type="checkbox" value="1" id="dot-1" name="admin">
                    </div>

                    <div class="button">
                        <input type="submit" value="go" name="submit">

                    </div>
                </div>
            </form>
        </div>
    </div>

</body>

</html>