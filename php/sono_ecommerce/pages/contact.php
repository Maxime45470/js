<?php
include('../template\header_contact.php');
?>



<main class="contact">
        <h1>Contact</h1>
        <form action="submit">
            <div class="form-group">
                <label for="exampleFormControlInput1"></label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Votre nom">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1"></label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Votre prenom">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1"></label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Votre email">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1"></label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Votre message ici"></textarea>
            </div>
            <button id="submit" type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </main>


<?php

include('../template/footer.php');

?>
