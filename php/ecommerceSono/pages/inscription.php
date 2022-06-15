<?php
require_once('../controller/fonctions.php');
include('../template/headerInscription.php');
?>

<div class="content">
            <div class="nav">
            <div class="navLogo">
                    <div class="navLogoImg"><a href="../index.php"> <img src="../assets/logo/logoAA.png" alt="logo"></a></div>
                    <div class="navLogoTitre"> AA Sonorisation </div>
                </div>
                <div class="navLogin"><a href="connexion.php">Connection</a></div>
                <div class="navRegister"><a href="#">Inscription</a></div>
            </div>
            <div class="login">
                <div class="titre">
                    <h2 class="para1">Inscivez vous</h2>
                    <h2 class="para2">Ici !</h2>
                </div>
                <div class="formulaire">
                    <form action="" method="post">
                        <div class="registerFormulaire">
                            <div class="col1">
                                <div class="inputUsername">
                                    <i class="pe-7s-user"></i>
                                    <input type="text" name="username" placeholder="Choisir un nom d'utilisateur">
                                </div>
                                <div class="inputEmail">
                                    <i class="pe-7s-lock"></i>
                                    <input type="text" name="password" placeholder="entrer un mot de passe">
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="submit" value="Inscription" class="registerFormBtn formBtn">S'inscrire<i class="pe-7s-angle-right"></i></button>
                    </form>
                </div>
               
            </div>
        </div>

<?php
if (isset($_POST['submit']) && $_POST['submit'] == 'Inscription'){ // on vérifie que le formulaire a bien été envoyé
    if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])){ // on vérifie que les champs ne sont pas vides
        $pdo = pdo_connect(); // on se connect a la bdd
        $sql = $pdo->prepare("SELECT * FROM users WHERE username ='".$_POST['username']."'"); // on parcours la bdd
        $sql->execute(); // Résultat de la requete
        if($sql->rowCount() == 0) { // si aucune ligne existe, on peux inscrire le nouveau membre
            $sql = $pdo->prepare("INSERT INTO users (username, password) VALUES('".$_POST['username']."', '".$_POST['password']."')");
            $sql->execute(array('username'=>$_POST['username'], 'password'=>$_POST['password']));
            echo 'inscription réussi !';
            header('location:connexion.php');
        }
        else{ // Sinon on n'inscrit pas ce login
            echo "echec de l'inscription !</br> Un membre possede déjà ce login !";
            exit;
        }
    }
    else{ // au moin un des champ est vide
        echo "echec de l'inscription !</br> Au moins un des champs est vide !";
        exit;
    }
}
?>

