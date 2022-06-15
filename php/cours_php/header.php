<?php
// On vérifie que l'utilisateur a bien des cookies et une session
if(empty($_COOKIE['id']) && empty($_COOKIE['password']) && empty($_SESSION['connect']))
{
    // Si c'est pas le cas on redirige l'utilisateur vers la page login
    header('location:login.php');
    exit;
}
?>
<!DOCTYPE HTML>
<html  lang="fr">
    <head>
    <meta charset="utf-8">
    <title><?php echo $titre_page; ?></title>
    </head>
    <body>
        <header>
            <div class="titre">Backend</div>
            <div class="navigation">
                <nav>
                    <ul>
                        <li>
                            <a  href="index.php">Accueil</a>
                        </li>
                        <li>
                            <a  href="index.php?c=gestion-actus">Actualités</a>
                        </li>
                        <li>
                            <a href="index.php?c=gestion-categories">Catégories</a>
                        </li>
                        <li>
                            <a href="index.php?c=gestion-pages">Pages</a>
                        </li>
                        <li>
                            <a href="index.php?c=gestion-users">Utilisateurs</a>
                        </li>
                        <li>
                            <a href="index.php?c=deconnexion">Se déconnecter</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
