<?php
ini_set('display_errors',false);
// On ouvre  la session
session_start();
// On importe notre fichier functions.php qui contient la connection à la BDD
require_once('functions.php');
// On appelle notre function pdo_connect() pour effectuer la connexion à la BDD
$pdo = pdo_connect();
// On va vérifier l'existence des cookies ID et password 
if(!verifConnect())
{
    header('location:login.php');
    exit;
}
// Affichage de notre page
// On affiche notre header
require_once('header.php');
// On fait un switch pour charger les différentes pages
switch($_GET['c'])
{
    // Pour afficher la liste des actualités
    case 'gestion-actus':
        require_once('gestion-actus.php');
    break;
    // Formulaire d'ajout/edition des actualités
    case 'form-actus':
        require_once('form-actus.php');
    break;
    // Gestion des catégories
    case 'gestion-categories':
        require_once('gestion-categories.php');
    break;
    // Formulaire d'ajout/modification des catégories
    case 'form-categories':
        require_once('form-categories.php');
    break;
    // Gestion des pages
    case 'gestion-pages':
        require_once('gestion-pages.php');
    break;
    // Formulaire ajout/modification page
    case 'form-pages':
        require_once('form-pages.php');
    break;
    // Gestion des utilisateurs
    case 'gestion-users':
        require_once('gestion-users.php');
    break;
    // Formulaire ajout/modification des utilisateurs
    case 'form-users':
        require_once('form-users.php');
    break;
    // Gestion des paragraphes
    case 'gestion-paras':
        // On vérifie que l'ID de la page est bien passé en GET
        if(!empty($_GET['pid']))
            require_once('gestion-paras.php');
        else
        {
            // Sinon on redirige l'utilisateur vers la liste des pages
            header('location:index.php?c=gestion-pages');
            exit;
        }
    break;
    // Formulaire d'ajout/modification des paragraphes
    case 'form-paras':
        // On vérifie que l'ID de la page est bien passé en GET
        if(!empty($_GET['pid']))
            require_once('form-paras.php');
        else
        {
            // Sinon on redirige l'utilisateur vers  la liste des pages
            header('location:index.php?c=gestion-pages');
            exit;
        }
    break;
    // Page par défaut du backoffice
    default:
        header('location:404.php');
    break;
}

// On affiche notre footer
require_once('footer.php');
?>