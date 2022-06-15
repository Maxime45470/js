<?php

include('../template\header_eclairage.php');

require_once('../template\fonction.php');

$pdo =pdo_connect();
$sql = $pdo->prepare('SELECT * FROM objet ORDER BY id DESC LIMIT 7');
$sql->execute();
$results = $sql->fetchAll(\PDO::FETCH_ASSOC);

?>



   


<main>
    <h1>Accessoire</h1>

<?php
foreach ($results as $result) {
    ?>
    <div class="aligner">
    <div class="row row-cols-1 row-cols-md-3 g-4 d-flex">
        <div class="col">
            <div class="card h-100">
                <img src="<?=$result['image']?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?=$result['nom']?></h5>
                    <p class="card-text"><?=$result['prix']?></p>
                </div>
                
            </div>
        </div>
    </div>
    
    <?php
}
?>
</div>
</main>

        <!--
        <div class="col">
            <div class="card h-100">
                <img src="<?=$result['image']?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?=$result['nom']?></h5>
                    <p class="card-text"><?=$result['prix']?></p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <img src="<?=$result['image']?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?=$result['nom']?></h5>
                    <p class="card-text"><?=$result['prix']?></p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <img src="<?=$result['image']?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?=$result['nom']?></h5>
                    <p class="card-text"><?=$result['prix']?></p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <img src="<?=$result['image']?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?=$result['nom']?></h5>
                    <p class="card-text"><?=$result['prix']?></p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <img src="<?=$result['image']?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?=$result['nom']?></h5>
                    <p class="card-text"><?=$result['prix']?></p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                </div>
            </div>
        </div>
        -->
    </div>
</main>


<?php
       
           ?>

<?php


include('../template/footer.php');

?>