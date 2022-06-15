<?php
function calculer($nombre1,$nombre2,$operateur)
{
    if(!empty($nombre1) && !empty($nombre2) && !empty($operateur))
    {
        if((is_int($nombre1) || $nombre1 > 0) && (is_int($nombre2) || $nombre1 > 0))
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
                    $resultat = null;
                break;
            }
            return $resultat;
            exit;
        }
    }
    return false;
}

function connexion()
{
    global $_COOKIE;
    
}


function mot_de_passe()
{
    $ch = '123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN';
    $ch = str_split($ch);
    $lg = rand(10,16);
    $mdp ='';
    for($i=0;$i<=$lg;$i++)
    {
        $c = rand(0,count($ch)-1);
        $mdp.= $ch[$c];
    }
    return $mdp;
}

function rename_image($name)
{
    $str = array('&','é','"','é','è','à','ç','=');
    $nom = str_replace($str,'',$name);
    $date = date('d-m-Y-h-i-s');
    return $date.$nom;
}


function pdo_connect() {  //php data objet
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'db_php_olivet';
    
    try{
        return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME, $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exeption) {
        exit('Problème de connexion à la base de données');
    }
}

?>