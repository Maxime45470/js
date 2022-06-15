<?php
ini_set('display_errors',false);
session_start();
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
                $extension = strchr($_FILES['photo']['name'],'.');
               
                $ext = array('.jpg','.JPG','.png','.PNG');
                if(in_array($extension,$ext))
                {
                    $nom_image = rename_image($_FILES['photo']['name']);
                    move_uploaded_file($_FILES['photo']['tmp_name'],$nom_image);

                }
                else 
                {
                    // on redirigige vers le form
                    header('location:inscription.php?ERR=1');
                    exit;
                }
                if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
                {
                    $mot_de_passe = mot_de_passe();
                    $methode1 = md5(sha1($mot_de_passe));
                    $methode2 = password_hash($mot_de_passe,PASSWORD_BCRYPT);
                    $file = strip_tags($_POST['nom'].'-'.$_POST['prenom']).'csv';
                    $sql = 'INSERT INTO `admin` SET nom = "'.strip_tags($_POST['nom']).'",
                                                    prenom = "'.strip_tags($_POST['prenom']).'", 
                                                    email = "'.strip_tags($_POST['email']).'", 
                                                    telephone = "'.strip_tags($_POST['telephone']).'",
                                                    photo = "'.$nom_image.'",
                                                    mot_de_passe = "'.$methode1.'",
                                                    date_inscription = CURDATE()';
                    $pdo->exec($sql);
                    setcookie('password_clair', $mot_de_passe,(time()+86400));
                    setcookie('nom', strip_tags($_POST['nom']),(time()+86400));
                   // mail($_POST['email'], 'Accès Admin', $mot_de_passe); 
                    $fp = fopen($file,'x');
                    //if($_SERVER['HTTP_HOST'] == 'localhost')
                    $donnees = array(
                        array('Nom','Prenom','Email','Telephone','Mot de passe','URL de la photo'),
                        array(strip_tags($_POST['nom']),strip_tags($_POST['prenom']),strip_tags($_POST['email']),$mot_de_passe,strip_tags($_POST['telephone']),$nom_image),
                    );
                    foreach($donnees as $ligne)
                    {
                        fputcsv($fp,$ligne);
                    }
                    fclose($fp);
                    $_SESSION['email'] = strip_tags($_POST['email']);
                    setcookie('passwrd',$mot_de_passe,(time()+86400));
                    header('location:login.php');
                    exit;

                }
                else
                {
                    header('location.inscription.php?ERR=2');
                    exit;
                }

            }
            else
            { 
            header('location.inscription.php?ERR=3');
            exit;
            }
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
            $req = $pdo->prepare('SELECT * FROM `admin` WHERE email = "'.strip_tags($_POST['email']).'"AND mot_de_passe = "'.md5(sha1($_POST['password'])).'" LIMIT 1');
           
            $req->execute();
            $resultat = $req->fetch(PDO::FETCH_OBJ);
            if($resultat)
            {
                setcookie('id', $resultat->ID,(time()+31536000));
                setcookie('password', $resultat->mot_de_passe, (time()+31536000));
                $_SESSION['connect'] = $resultat->ID;
                header('location:index.php');
                exit;
            }
            else{
                header('location:login.php?MSG=1');
                exit;      
            }

        }
        else{
            header('location:login.php?MSG=1');
        }
    break;
}

?>