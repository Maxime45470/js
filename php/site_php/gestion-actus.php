<table>
    <thead>
        <tr>
            <th>Titre</th>
            <th>Etat</th>
            <th>Date d'ajout</th>
            <th>Date de dernière modification</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            /* On écrit notre requête qui va sélectionner l'ensemble 
            des actualités donc l'état est différent de supprimé */
            $req = 'SELECT * FROM `actualites` WHERE etat < 3 ORDER BY ID DESC';
            // On execute la requête
            $actus = $pdo->query($req);
            // On compte le nombre de lignes que retourne la requête
            $nb_actu = $actus->rowCount();
            // Si on a 1 ligne ou plus on affiche le(s) résultat(s)
            if($nb_actu >= 1)
            {
                $actualites = $actus->fetchAll();
                foreach($actualites as $actualite)
                {
                    echo '<tr>';
                    echo '<td>'.$actualite['titre'].'</td>';
                    echo '<td>'.etat_actu($actualite['etat']).'</td>';
                    echo '<td>'.dateFr($actualite['date_ajout']).'<td>';
                    echo '<td>'.dateFr($actualite['date_modification']).'</td>';
                    echo '<td>';
                    echo '<a href="index.php?c=form-actus&id='.$actualite['ID'].'">Modifier</a>';
                    echo '<a href="action.php?uc=del-actu&id='.$actualite['ID'].'">Supprimer</a>';
                    echo '</tr>';
                }

            }
            else
            {
                echo '<div class="error">Aucune Actualité</div>';
            }
            
            ?>
    </tbody>
</table>

<a class="btnAjout" href="index.php?c=form-actus">Ajouter une actualité</a>