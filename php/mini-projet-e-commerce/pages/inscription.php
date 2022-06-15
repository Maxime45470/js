<?php require_once('../templates/header.tpl.php')?>
<link rel="stylesheet" href="../assets/css/sono_portable.css">


<form name="inscription" method="post" enctype="multipart/form-data" action="action.php?e=inscription">
    <div>
        <label for="nom">Nom: </label>
        <input type="text" name="nom" <?php if($formulaire['nom']){echo 'value="'.$formulaire['nom'].'"';}?>/>
    </div>
    <div>
        <label for="prenom">Prénom: </label>
        <input type="text" name="prenom"  <?php if($formulaire['prenom']){echo 'value="'.$formulaire['prenom'].'"';}?>/>
    </div>
    <div>
        <label for="email">Email: </label>
        <input type="email" name="email" <?php if($formulaire['email']){echo 'value="'.$formulaire['email'].'"';}?>/>
    </div>
    
    
    <button type="submit" name="submit">Inscription</button>
</form>


<?php require_once('../templates/header.tpl.php')?>