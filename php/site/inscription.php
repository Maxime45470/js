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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="back.css">
    <title>login</title>
</head>

<body class="fond">
    
    <body>
        <section class="login">
            <ul class="nav nav-tabs justify-content-end" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                        type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Register</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                        type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Login</button>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                    tabindex="0">
                    <h1>Inscription</h1>
                    <form name="inscription" enctype="multipart/form-data" method="post"
                        action="action.php?e=inscription">
                        <p>
                            <label for="nom"></label>
                            <input placeholder="Nom" type="text" name="nom" <?php if($formulaire['nom']){ echo 'value="'
                                .$formulaire['nom'].'"'; } ?> />
                        </p>
                        <p>
                            <label for="prenom"></label>
                            <input placeholder="Prenom" type="text" name="prenom" <?php if($formulaire['prenom']){ echo 'value="'
                                .$formulaire['prenom'].'"';} ?> />
                        </p>
                        <p>
                            <label for="email"></label>
                            <input placeholder="Email" type="email" name="email" <?php if($formulaire['email']) { echo 'value="'
                                .$formulaire['email'].'"';} ?> />
                        </p>
                        <p>
                            <label for="telephone"></label>
                            <input placeholder="Tel" type="tel" name="telephone" <?php if($formulaire['telephone']) { echo 'value="'
                                .$formulaire['telephone'].'"';} ?> />
                        </p>
                        <p>
                            <label for="photo">Photo de profil</label>
                            <input type="file" name="photo" />
                        </p>
                        <button class="submit" type="submit" name="submit">Inscription</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                    tabindex="0">
                    <div class="espace">
                        <h1>Se connecter</h1>
                        <form name="connection" method="post" action="action.php?e=connection">
                            <p>
                                <label for="email"></label>
                                <input type="email" placeholder="Email" name="email" <?php if($_SESSION['email']){ echo 'value="'
                                .strip_tags($_SESSION['email']).'"';} ?> />
                            </p>
                            <p>
                                <label for="password"></label>
                                <input placeholder="Mot de passe" type="password" name="password" <?php if($_COOKIE['passwd_clair']){ echo 'value="'
                                .$_COOKIE['passwd_clair'].'"';} ?> />

                            </p>
                            <button class="submit" type="submit" name="submit">Se connecter</button>
                        </form>
                    </div>
                </div>

            </div>
        </section>



</body>

</html>