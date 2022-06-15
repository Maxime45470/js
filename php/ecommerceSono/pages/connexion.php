<?php
require_once('../controller/fonctions.php');
include('../template/headerConnexion.php');
?>

<div class="content">
            <div class="nav">
                <div class="navLogo">
                    <div class="navLogoImg"><a href="../index.php"> <img src="../assets/logo/logoAA.png" alt="logo"></a></div>
                    <div class="navLogoTitre"> AA Sonorisation </div>
                </div>
                <div class="navLogin"><a href="#">Connexion</a></div>
                <div class="navRegister"><a href="inscription.php">Inscription</a></div>
            </div>
            <div class="login">
                <div class="titre">
                    <h2 class="para1">Espace de</h2>
                    <h2 class="para2">Connexion!</h2>
                </div>
                <div class="formulaire">
                     <form action="" method="post">
                    <div class="inputUsername">
                        <i class="pe-7s-user"></i>
                        <input name="username" type="text" placeholder="Nom d'utilisateur">
                    </div>
                    <div class="inputPassword">
                        <i class="pe-7s-lock"></i>
                        <input name="password" type="text" placeholder="Mot de passe">
                    </div>
                    <button type="submit" name="submit" value="Connexion" class="formBtn">Se connecter<i class="pe-7s-angle-right"></i></button>

                </form>
                </div>
            </div>
        </div>
<?php
if (isset($_POST['submit']) && $_POST['submit'] == 'Connexion'){ // on vérifie que le formulaire a bien été envoyé
    if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])){ // on vérifie que les champs ne sont pas vides
        $pdo = pdo_connect(); // on se connect a la bdd
        $sql = $pdo->prepare("SELECT * FROM users WHERE username ='".$_POST['username']."' AND password ='".$_POST['password']."'"); // on parcours la bdd
        $sql->execute(); // Résultat de la requete
        if($sql->rowCount() == 1) { // si une ligne existe c'est que l'utilisateur est un membre
            session_start(); // on creer une session
            $_SESSION['username'] = $_POST['username'];
            header('location:espaceMembre.php'); // on le redirige vers la page de l'espace membre
            exit;
        }
        elseif($sql->rowCount() == 0){ // si il n'y a pas de ligne, c'est que l'utilisateur n'est pas inscrit
                echo "login ou mot de passe non reconnu !</br>";
                echo "<a href\"index.php\">Revenir à l'accueil</a>";
            exit;
        }
        else{ // Sinon il existe un pb dans la bdd
            echo "login ou mot de passe non reconnu !</br>";
            echo "<a href\"index.php\">Revenir à l'accueil</a>";
            exit;
        }
    }
    else{ // Erreur de saisie
        echo "login ou mot de passe non reconnu !</br>";
        echo "<a href\"index.php\">Revenir à l'accueil</a>";
        exit;
    }
}
?>