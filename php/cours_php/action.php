<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
ini_set('display_errors',false);
require_once('functions.php');
$pdo = pdo_connect();
switch($_GET['e'])
{
    case 'inscription':

        if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['telephone']))
        {
            $_SESSION['formulaire'] = serialize($_POST);
            if(is_uploaded_file($_FILES['photo']['tmp_name']))
            {
                // on upload la photo avec la fonction. 
                $nom_image = uploadFichier($_FILES['photo']);
                if(!$nom_image)
                {
                    // On redirige vers le formulaire d'inscription
                    header('location:inscription.php?ERR=1');
                    exit;
                }
                if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
                {
                    $mot_de_passe = mot_de_passe();
                    $methode1 = md5(sha1($mot_de_passe));
                    //$methode2 = password_hash($mot_de_passe,PASSWORD_BCRYPT);
                    $file = strip_tags($_POST['nom'].'-'.$_POST['prenom']).'.csv';
                    $sql = 'INSERT INTO `admin` SET nom = "'.strip_tags($_POST['nom']).'", 
                                                    prenom = "'.strip_tags($_POST['prenom']).'",
                                                    email = "'.strip_tags($_POST['email']).'",
                                                    telephone = "'.strip_tags($_POST['telephone']).'",
                                                    photo = "'.$nom_image.'",
                                                    mdp = "'.$methode1.'",
                                                    Date_inscription = CURDATE()';
                    $pdo->exec($sql);  
                    // Code pour enregistrer le mot de passe en clair (uniquement en préprod !!!!)
                    //if($_SERVER['HTTP_HOST'] == 'localhost')
                    //mail($_POST['email'],'Accès Admin',$mot_de_passe);                              
                    setcookie('passwd_clair',$mot_de_passe,(time()+3600));

                    $fp = fopen($file,'x');

                    $donnees = array(
                        array('Nom','Prénom','Email','Mot de passe','Téléphone','URL de la photo'),
                        array(strip_tags($_POST['nom']),strip_tags($_POST['prenom']),strip_tags($_POST['email']),$methode2,strip_tags($_POST['telephone']),$nom_image)
                    ); 
                    foreach($donnees as $ligne)
                    {
                        fputcsv($fp,$ligne);
                    }  
                    fclose($fp);
                    $_SESSION['email'] = strip_tags($_POST['email']);
                    setcookie('passwd',$methode1,(time()+86400));
                    header('location:login.php');
                    exit;

                }
                else
                {
                    header('location:inscription.php?ERR=2');
                    exit;
                }
            }
            else
            {
                header('location:inscription.php?ERR=3');
                exit;
            }
        }
        else
        {
            if(empty($_POST['nom']))
                $err = 4;
            else if(empty($_POST['prenom']))
                $err = 5;
            else if(empty($_POST['email']))
                $err = 6;
            else if(empty($_POST['telephone']))
                $err = 7;
            
            header('location:inscription.php?ERR='.$err);
            exit;
        }

    break;

    case 'connection':
        
        if(!empty($_POST['email']) && !empty($_POST['password'])) 
        {
            $req = $pdo->prepare('SELECT * FROM `admin` WHERE email = "'.strip_tags($_POST['email']).'" AND mdp = "'.md5(sha1($_POST['password'])).'" ORDER BY ID DESC LIMIT 1');
            echo 'SELECT * FROM `admin` WHERE email = "'.strip_tags($_POST['email']).'" AND mdp = "'.md5(sha1($_POST['password'])).'" ORDER BY ID DESC LIMIT 1';
            $req->execute();
            $resultat = $req->fetch(PDO::FETCH_OBJ);
            if($resultat)
            {
                setcookie('id',$resultat->ID,(time()+31536000));
                setcookie('password',$resultat->mdp,(time()+31536000));
                $_SESSION['connect'] = $resultat->ID;
                header('location:index.php');
                exit;
            }
            else{
                header('location:login.php?MSG=1');
                exit;
            }
        }

    break;


}
if(verifConnect())
{ 
    switch($_GET['uc'])
    {
        case 'ajout-actu':

            if(!empty($_POST['titre']) && !empty($_POST['contenu']) && is_uploaded_file($_FILES['image']['tmp_name']))
            {
                $nom_fichier = uploadFichier($_FILES['image']);
                if($nom_fichier)
                {
                    $req = 'INSERT INTO `actualites` SET
                        titre = "'.strip_tags($_POST['titre']).'",
                        contenu = "'.strip_tags($_POST['contenu']).'",
                        image = "'.$nom_fichier.'",
                        etat = "'.intval($_POST['etat']).'",
                        date_ajout = CURDATE(),
                        date_modification = CURDATE()';
                    if($pdo->exec($req))
                    {
                        header('location:index.php?c=gestion-actus&MSG=1');
                        exit;
                    }
                    else
                    {
                        $_SESSION['form-actus'] = serialize($_POST);
                        header('location:index.php?c=form-actus&ERR=1');
                        exit;
                    }
                }
                else{
                    $_SESSION['form-actus'] = serialize($_POST);
                    header('location:index.php?c=form-actus&ERR=2');
                    exit;
                }
            }
            else
            {
                $_SESSION['form-actus'] = serialize($_POST);
                if(empty($_POST['titre'])) $err = 3;
                else if(empty($_POST['contenu'])) $err = 4;
                header('location:index.php?c=form-actus&ERR=' .$err);
                exit;
            }

        break;

        case 'edit-actu':

            if(!empty($_POST['id-actu']))
            {
                $actu = $pdo->prepare('SELECT * FROM `actualites` WHERE ID = "'.intval($_POST['id-actu']).'" AND etat != 3');
                $actu->execute();
                if($actu->rowCount() == 1)
                {
                    if(!empty($_POST['titre']) && !empty($_POST['contenu']))
                    {
                        $req = 'UPDATE `actualites` SET
                                titre = "'.strip_tags($_POST['titre']).'",
                                contenu = "'.strip_tags($post['contenu']).'",
                                etat = "'.intval($_POST['etat']).'",
                                dote_modification = CURDATE()
                                WHERE ID = "'.intval($_POST['id-actu']).'"';
                        if(!$pdo->exec($req))
                        {
                            header('location:index.php?c=form-actus&id='.intval($_POST['id-actu']).'&ERR=3');
                            exit;
                        }
                        if(is_uploaded_file($_FILES['image']['tmp_name']))
                        {
                            $new_img = uploadFichier($_FILES['image']);
                            if($new_img)
                            {
                                if($_POST['image_garde'] == 1)
                                {
                                    $actualite = $actu->fetchObject();
                                    unlink($actualite->image);
                                }
                                $req2 = 'UPDATE `actualites` SET
                                            image = "'.$new_img.'",
                                            date_modification = CUREDATE()
                                            WHERE ID = "'.intval($_POST['id-actu']).'"';
                                if(!$pdo->exec($req2))
                                {
                                    header('location:index.php?c=form-actus&id='.intval($_POST['id-actu']).'&ERR=4');
                                    exit;
                                }
                                else
                                {
                                    header('location:index.php?c=form-actus&id='.intval($_POST['id-actu']).'&ERR=5');
                                    exit;
                                }
                            }
                        }
                        else 
                        {
                            //si l'un des champs est vide
                            if(empty($_POST['titre'])) $err = 5;
                            else if(empty($_POST['contenu'])) $err = 6; 
                        }
                        header('location:index.php?c=form-actus&id='.intval($_POST['id-actu']).'&ERR='.$err);
                        exit;
                    }
                }
                else
                {
                    header('location:index.php?c=gestion-actus&ERR=2');
                    exit;
                }
            }
            else
            {
                //si on a pas sélectionné d'actualité
                header('location:index.php?c=gestion-actus&ERR=2');
                exit;
            }
            

        break;

        case 'del-actu':

            if(!empty($_GET['id']))
            {
                $req = 'UPDATE `actualites` SET
                            etat = 3,
                            date_modification = CURDATE()
                            WHERE ID = "'.intval($_GET['id']).'"';
                if($pdo->exec($req))
                {
                    header('location:index.php?c=gestion-actus&MSG=2');
                    exit;
                }
                else
                {
                    header('location:index.php?c=gestion-actus&ERR=7');
                    exit;
                }

            }
            else
            {
                header('location:index.php?c=gestion-actus&ERR=8');
                exit;
            }

        break;

        case 'ajout-categorie':
            if(!empty($_POST['nom']) && !empty($_POST['url']))
            {
                $req = 'INSERT INTO `categorie` SET nom = "'.strip_tags($_POST['nom']).'", url = "'.strip_tags($_POST['url']).'"';
                if($pdo->exec($req))
                {
                    header('location:index.php?c=gestion-categories&MSG=1');
                }
                else
                {
                    $_SESSION['form-categorie'] = serialize($_POST);
                    header('location:index.php?c=form-categories&ERR=1');
                }
            }
            else
            {
                $_SESSION['form-categorie'] = serialize($_POST);
                header('location:index.php?c=form-categories&ERR=2');
            }
        break;

        case 'edit-categorie':
            
            if(!empty($_POST['id-cat']))
            {
                $cat = $pdo->prepare('SELECT ID FROM `categorie` WHERE ID = "'.intval($_POST['id-cat']).'"');
                $cat->execute();
                if($cat->rowCount() == 1)
                {
                    if(!empty($_POST['nom']) && !empty($_POST['url']))
                    {
                        $req = 'UPDATE `categorie` SET
                                    nom = "'.strip_tags($_POST['nom']).'",
                                    url = "'.strip_tags($_POST['url']).'"
                                    WHERE ID = "'.intval($POST['id-cat']).'"';
                        if($pdo->exec($req))
                        {
                            header('location:index.php?c=gestion-categories&MSG=2');
                            exit;
                        }
                        else
                        {
                            $_SESSION['form-categorie'] = serialize($_POST);
                            header('location:index.php?c=form-categories&id='.intval($_POST['id-cat']).'&ERR=1');
                            exit;
                        }
                    }
                    else
                    {
                        $_SESSION['form-categorie'] = serialize($_POST);
                        header('location:index.php?c=form-categories&ERR=3');
                        exit;
                    }

                }
                
            }
            header('location:index.php?c=gestion-categories&ERR=2');
            exit;


        break;

        case 'del-cat':

        break;

    }
}
?>