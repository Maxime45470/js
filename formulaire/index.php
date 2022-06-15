<?php
require_once('model.php');
$pdo =pdo_connect();

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="/jquery-ui-1.13.1/jquery-ui.css">

    <title>Formulaire javascript</title>

</head>

<body>
    <form method="POST" action="model.php" name="contact" id="contact">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="error" id="error"></div>
                    <div class="form-input">
                        <label for="nom">Nom</label>
                        <input type="text" class="input" name="nom" id="nom" placeholder="Nom" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-input">
                        <label for="prenom">Prénom</label>
                        <input type="text" class="input" name="prenom" id="prenom" placeholder="Prénom" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-input">
                        <label for="email">Email</label>
                        <input type="email" class="input" name="email" id="email" placeholder="Email" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-input">
                        <label for="tel">Téléphone</label>
                        <input type="tel" class="input" name="tel" id="tel" placeholder="Téléphone" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-input">
                        <label for="sujet">Sujet</label>
                        <input type="text" name="sujet" class="input" id="sujet" placeholder="Sujet" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-input">
                        <label for="sexe">Sexe</label>
                        <select name="sexe" class="input" id="sexe" onchange="">
                            <option value="">Choisir</option>
                            <option value="Femme">Femme</option>
                            <option value="Homme">Homme</option>
                            <option value="Autre">Autres</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-textarea">
                        <label for="message"></label>
                        <textarea name="message" id="mess" required="required" maxlength="50" onclick=""
                            onblur="">Votre message ici</textarea>
                        <div id="counter"><span>0</span> caractères (50 max)</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-input">
                        <button type="submit" onclick="" name="submit" id="submit">Envoyer</button>
                        <button type="reset" name="reset" id="reset">Effacer</button>
                    </div>
                </div>
            </div>

        </div>

        </div>
    </form>
</body>
<div class="container">
    <div class="row">
        <div class="col-10">
            <table cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Sexe</th>
                        <th>Sujet</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                <tbody id="tableau">

                </tbody>
                </thead>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript"></script>
<script type="text/javascript" src="jquery-3.6.0.js"></script>
<script src="http://cdn.jsdelivr.net/jquery.validation/1.14.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="formulaire.js"></script>
</body>

</html>

<?php

if(isset($_POST['submit'])){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $sexe = $_POST['sexe'];
    $sujet = $_POST['sujet'];
    $mess = $_POST['message'];
  ///  echo "<script type='text/javascript'>document.location.replace('merci.html');</script>";
    die(create($nom, $prenom, $email, $tel, $sexe, $sujet, $mess));
   
}

?>
