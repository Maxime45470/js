<h2>Gestion catégories</h2>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>URL</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            /* On écrit notre requête qui va sélectionner l'ensemble 
            des actualités donc l'état est différent de supprimé */
            $req = 'SELECT * FROM `categorie` ORDER BY ID DESC';
            // On execute la requête
            $categories = $pdo->query($req);
            // On compte le nombre de lignes que retourne la requête
            $nb_cat = $actus->rowCount();
            // Si on a 1 ligne ou plus on affiche le(s) résultat(s)
            if($nb_cat >= 1)
            {
                $cat = $categories->fetchAll();
                foreach($cat as $categorie)
                {
                    echo '<tr>';
                    echo '<td>'.$categorie['nom'].'</td>';
                    echo '<td>'.$categorie['url'].'</td>';
                    echo '<td>';
                    echo '<a href="index.php?c=form-actus&id='.$categorie['ID'].'">Modifier</a>';
                    echo '<a href="action.php?uc=del-actu&id='.$categorie['ID'].'">Supprimer</a>';
                    echo '</tr>';
                }

            }
            else
            {
                echo '<div class="error">Aucune catégorie</div>';
            }
            
            ?>
        </tbody>
    </table>
    <a href="index.php?c=form-categorie">Ajouter une catégorie</a>