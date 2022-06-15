<?php require_once('../templates/header.tpl.php')?>
<link rel="stylesheet" href="../assets/css/login.css">



<h1>Se connecter</h1>
    <form name="connection" method="post" action="action.php?e=connection">
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" />
             
        </div>

        <div>
            <label for="password">Mot de passe</label>
            <input type="text" name="password" />
           
            
        </div>    
        <button type="submit" name="submit">Se connecter</button>
        <?php require_once('../templates/footer.tpl.php')?>