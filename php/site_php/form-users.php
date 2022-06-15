<?php
//ini_set('display_errors',false);


    $action = 'ajout-users';






?>
<form action="action.php?uc=<?php echo $action;  ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" class="form-control">
    </div>
    <div class="form-group">
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" id="prenom" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" >
    </div>
    <div class="form-group">
        <label for="telephone">Téléphone</label>
        <input type="text" name="tel" id="telephone" class="form-control" >
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" name="mdp" id="password" class="form-control" >
    </div>
    
    <div class="form-group">
        <label for="photo">Photo</label>
        <input type="file" name="photo" id="photo" class="form-control">
    </div>
    <div class="form-group">
    <button class="btnEnvoi" type="submit" name="submit">Enregistrer</button>
    </div>
</form>