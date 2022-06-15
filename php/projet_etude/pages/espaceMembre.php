<?php
include('../template/headerEspaceMembre.php');
session_start();
?>

<main>
    <h1>Bienvenue <?php echo htmlentities(trim($_SESSION['username'])); ?></h1>
</main>

<?php
include('../template/footerEspaceMembre.php');
?>