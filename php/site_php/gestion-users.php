<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Date d'inscription</th>
        </tr>
    </thead>
    <tbody>
        <?php
            /* On écrit notre requête qui va sélectionner l'ensemble 
            des actualités donc l'état est différent de supprimé */
            $req = 'SELECT `nom`, `prenom`, `email`, `telephone` FROM `admin` WHERE 1';
            // On execute la requête
            $users = $pdo->query($req);
            // On compte le nombre de lignes que retourne la requête
            $nb_users = $users->rowCount();
            // Si on a 1 ligne ou plus on affiche le(s) résultat(s)
            if($nb_users >= 1)
            {
                $utilisateurs = $users->fetchAll();
                foreach($utilisateurs as $utilisateur)
                {
                    echo '<tr>';
                    echo '<td>'.$utilisateur['nom'].'</td>';
                    echo '<td>'.$utilisateur['prenom'].'</td>';
                    echo '<td>'.$utilisateur['email'].'</td>';
                    echo '<td>'.$utilisateur['telephone'].'</td>';
                    echo '<td>';
                    echo '<a href="index.php?c=form-utilisateur&id='.$utilisateur['ID'].'">Modifier</a>';
                    echo '<a href="action.php?uc=del-utilisateur&id='.$utilisateur['ID'].'">Supprimer</a>';
                    echo '</tr>';
                }

            }
            else
            {
                echo '<div class="error">Aucun Utilisateur</div>';
            }
            
            ?>
</table>
<a class="btnAjout" href="index.php?c=form-users.php">Ajouter un utilisateur</a>