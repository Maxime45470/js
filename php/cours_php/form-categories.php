<?php
ini_set('display_errors',false);

// On vérifie si on est en édition
if(isset($_GET['id']) && !empty($_GET['id']))
{
    $req = 'SELECT * FROM `categorie` WHERE ID = "'.intval($_GET['id']).'"';
    $cat = $pdo->query($req);
    if($cat->rowCount() == 1)
    {
        $categorie = $cat->fetch(PDO::FETCH_OBJ);
        $action = 'edit-categorie';
        $nom_cat = $categorie->nom;
        $url_actu = $categorie->url;
    }
    else
    {
        header('location:index.php?c=gestion-categories');
        exit;
    }
}
// Si jamais on est en mode ajout
else
{
    $categorie = null;
    $action = 'ajout-categorie';
    // on verifie si on a des donnees en session 
    if($_SESSION['form-categories'])
    {
        // on recupere les infos dans les sessions 
        $form_categorie = unserialize($_SESSION['form-categories']);
        $nom_cat = $form_actus['nom'];
        $url_cat = $form_actus['url'];
    }
}
?>
<form method="POST" action="action.php?uc=<?php echo $action;  ?>" enctype="multipart/form-data">
    <div class="form-input">
        <label for="titre">Nom</label>
        <input type="text" name="titre" value="<?php if($nom_cat) echo $nom_cat; ?>" />
    </div>
    <div class="form-input">
        <label for="url">Url</label>
        <input type="text" name="url" value="<?php if($url_cat) echo $url_cat; ?>" />
    </div>
   
    <input type="hidden" name="id-cat" value="<?php if($categorie->ID) echo $categorie->ID; ?>" />
    <button type="submit" name="submit">Enregistrer</button>
</form>