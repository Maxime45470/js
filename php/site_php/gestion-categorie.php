<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>URL</th>
        </tr>
    </thead>
    <tbody>
        <?php
        /* On écrit notre requête qui va sélectionner l'ensemble */
        $req = 'SELECT `nom`, `url` FROM `categories` WHERE 1';
        // On execute la requête
        $cat = $pdo->query($req);
        // On compte le nombre de lignes que retourne la requête
        $nb_cat = $cat->rowCount();
        // Si on a 1 ligne ou plus on affiche le(s) résultat(s)
        if($nb_cat >= 1)
        {
            $categories = $cat->fetchAll();
            foreach($categories as $categorie)
            {
                echo '<tr>';
                echo '<td>'.$categorie['nom'].'</td>';
                echo '<td>'.$categorie['url'].'</td>';
                echo '<td>';
                echo '<a href="index.php?c=form-categorie&id='.$categorie['ID'].'">Modifier</a>';
                echo '<a href="action.php?uc=del-categorie&id='.$categorie['ID'].'">Supprimer</a>';
                echo '</tr>';
            }

        }
        else
        {
            echo '<div class="error">Aucune Categorie</div>';
        }
        
        ?>
    </tbody>
</table>

