<?php
function calculer($nombre1,$nombre2,$operateur)
{
    
    if(!empty($nombre1) && !empty($nombre2) && !empty($operateur))
    {
        if((is_int($nombre1) || $nombre1 > 0) && (is_int($nombre2) || $nombre2 > 0))
        {
            switch($operateur)
            {
                case 'addition':
                    $resultat = $nombre1+$nombre2;
                break;
                case 'soustraction':
                    $resultat = $nombre1-$nombre2;
                break;
                case 'multiplication':
                    $resultat = $nombre1*$nombre2;
                break;
                case 'division':
                    $resultat = $nombre1/$nombre2;
                break;
                default:
                    $resultat = 'aucun';
                break;
            }
            return $resultat;
            exit;
        }
    }
    return false;
}
function mot_de_passe()
{
    $ch = 'azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN1234567890';
    $ch = str_split($ch);
    $lg = rand(10,16);
    $mdp='';
    for($i=0;$i<=$lg;$i++)
    {
        $c = rand(0,count($ch)-1);
        $mdp.= $ch[$c];
    }
    return $mdp;
}
function renomme_image($name)
{
    $str = array('&','é','"','(','§','è','!','ç','à','@',')','°','#','^','¨','$','*','€','ù','%','`','£',' ');
    $nom = str_replace($str,'',$name);
    $date = date('d-m-Y-h-i-s');
    return $date.$nom;
}
function pdo_connect(){
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'via_orleans';

    try{
        return new PDO('mysql:host='.$DATABASE_HOST. ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch(PDOException $exception) {
        exit('failed to connect bdd');
    }
}
function etat_actu($etat)
{
    switch($etat)
    {
        case '1':
            return 'Brouillon';
        break;
        case '2':
            return 'En ligne';
        break;
        case '3':
            return 'Supprimé';
        break;
    }
}
function dateFr($date)
{
    $date = explode('-',$date);
    return $date[2].'/'.$date[1].'/'.$date[0];
}


function verifConnect()
{
    global $pdo;
        if(!empty($_COOKIE['id'])&& !empty($_COOKIE['password']))
    {
        // On effectue une requête SQL avec l'id et le password du cookie
        $req = $pdo->prepare('SELECT * FROM `admin` WHERE ID = "'.strip_tags($_COOKIE['id']).'" AND mdp = "'.strip_tags($_COOKIE['password']).'"');
        $req->execute(); // MODIFIER
        // On verifie que la requête nous retourne une ligne avec la méthode Rowcount();
        if($req->rowCount() == 1)// MODIFIER
        {
            // On met en objet notre user
            $user = $req->fetch(PDO::FETCH_OBJ); // MODIFIER
            // On relance notre session et nos cookies
            $_SESSION['connect'] = $user->ID;
            setcookie('id',$user->ID,(time()+86400));
            setcookie('password',$user->mdp,(time()+86400));
            return true;
        }
        else
        {
            // Si l'utilisateur n'a pas été trouvé on détruit la session et on le renvoie vers la page login
            $_SESSION['connect'] = '';
            return false;
        }
    }
    else
    {
        // Si on a pas de cookie on redirige l'utilisateur vers la page login
        $_SESSION['connect'] = '';
        return false; 
    }
}

function uploadFichier($fichier,$extensions=array('.jpg','.JPG','.png','.PNG','.pdf','.PDF'),$dest='upload/')
{
    $extension = strrchr($fichier['name'],'.');
        /*$fichier = pathinfo($_FILES['photo']['name']);
        echo $fichier['extension'];*/
        
        if(in_array($extension,$extensions))
        {
            $nom_image = renomme_image($fichier['name']);
            if(move_uploaded_file($fichier['tmp_name'],$dest.$nom_image))
            {
                return $dest.$nom_image;
            }
            else
            {
                return false;
            }
        }
    else {
        return false;
    }
}

function genererUrl($titre)
{
    $array1 = array('@','é','è','ê','ë','à','â','î','ï','ô','ù','û','ç','€','&',' ','(',')');
    $array2 = array('a','e','e','e','e','a','a','i','i','o','u','u','c','e','d','','','','');
    return dtr_replace($array1,$array2,$titre);
}


?>=