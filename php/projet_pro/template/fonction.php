<?php



function pdo_connect(){
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'db_sono';

    try{
        return new PDO('mysql:host='.$DATABASE_HOST. ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch(PDOException $exception) {
        exit('failed to connect bdd');
    }
}




function cookie(){
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
}



?>