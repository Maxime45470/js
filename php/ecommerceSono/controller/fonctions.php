<?php
function pdo_connect(){ // se connecte a la bdd  // pdo = Php Data Object
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'db_sono';

    try{
        return new PDO('mysql:host='.$DATABASE_HOST. ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } 
    catch(PDOException $exception){
        exit('failed to connect bdd');
    }
}
function verifConnect(){ // On véfifie que l'utilisateur existe

    if (isset($_POST['submit']) && $_POST['submit'] == 'Connection'){ // on vérifie que le formulaire a bien été envoyé
        pdo_connect(); // on se connect a la bdd
        $req = $bdd->query("SELECT * FROM users WHERE username ='".$_POST['username']."' AND password ='".$_POST['password']."'"); // on parcours la bdd
        $data = $req->fetch(); // Résultat de la requete
        if($data[0] == 1) { // si une ligne existe c'est que l'utilisateur est un membre
            session_start(); // on creer une session
            $_SESSION['unsername'] = $_POST['username'];
            header('location:espaceMembre.php'); // on le redirige vers la page de l'espace membre
            exit;
        }
        elseif($data[0] == 0){ // si il n'y a pas de ligne, c'est que l'utilisateur n'est pas inscrit
            echo 'login ou mot de passe non reconnu !';
            echo '</br><a href\"index.php">Revenir à l\'accueil</a>';
            exit;

        }
        else{ // Sinon il existe un pb dans la bdd
            echo 'le nom d\'utilisateur ou le mot de passe existe déja';
            echo '</br><a href\"index.php">Revenir à l\'accueil</a>';
            exit;
        }
    }
    else{ // Erreur de saisie
        echo 'Erreur de saisie!</br>Au moin un des champs est vide !';
        echo '</br><a href\"index.php">Revenir à l\'accueil</a>';
        exit;
    }
}

?>