<?php
// On vérifie que l'utilisateur a bien des cookies et une session
if(empty($_COOKIE['id']) && empty($_COOKIE['password']) && empty($_SESSION['connect']))
{
    // Si c'est pas le cas on redirige l'utilisateur vers la page login
    header('location:login.php');
    exit;
}
?>
<!DOCTYPE HTML>
<html lang="fr">

<head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="back.css">
    <title><?php echo $titre_page; ?></title>
</head>

<body>
    <header>
        
        <div id="profil" class="d-flex">


            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <img id="logo" src="/img/yourLogo.webp" alt="">
                <button class="nav-link active" id="v-pills-accueil-tab" data-bs-toggle="pill"
                    data-bs-target="#v-pills-accueil" type="button" role="tab" aria-controls="v-pills-accueil"
                    aria-selected="true">Accueil</button>
                <button class="nav-link" id="v-pills-actualites-tab" data-bs-toggle="pill"
                    data-bs-target="#v-pills-actualites" type="button" role="tab" aria-controls="v-pills-actualites"
                    aria-selected="false">Actualitées</button>
                <button class="nav-link" id="v-pills-categorie-tab" data-bs-toggle="pill"
                    data-bs-target="#v-pills-categorie" type="button" role="tab" aria-controls="v-pills-categorie"
                    aria-selected="false">Catégorie</button>
                <button class="nav-link" id="v-pills-page-tab" data-bs-toggle="pill" data-bs-target="#v-pills-page"
                    type="button" role="tab" aria-controls="v-pills-page" aria-selected="false">Page</button>
                <button class="nav-link" id="v-pills-utilisateur-tab" data-bs-toggle="pill"
                    data-bs-target="#v-pills-utilisateur" type="button" role="tab" aria-controls="v-pills-utilisateur"
                    aria-selected="false">Utilisateurs</button>

            </div>
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-accueil" role="tabpanel"
                    aria-labelledby="v-pills-accueil-tab" tabindex="0">
                    <h1>Accueil</h1>
                </div>
                <div class="tab-pane fade" id="v-pills-actualites" role="tabpanel"
                    aria-labelledby="v-pills-actualites-tab" tabindex="0">





                    <h1>Actualitées</h1>


                </div>
                <div class="tab-pane fade" id="v-pills-categorie" role="tabpanel"
                    aria-labelledby="v-pills-categorie-tab" tabindex="0">
                    <h1>Catégorie</h1>
                </div>
                <div class="tab-pane fade" id="v-pills-page" role="tabpanel" aria-labelledby="v-pills-page-tab"
                    tabindex="0">
                    <h1>Page</h1>
                </div>
                <div class="tab-pane fade" id="v-pills-utilisateur" role="tabpanel"
                    aria-labelledby="v-pills-utilisateur-tab" tabindex="">
                    <h1>Utilisateurs</h1>
                </div>

            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split"
                    id="dropdownMenuReference" data-bs-toggle="dropdown" aria-expanded="false"
                    data-bs-reference="parent">
                    <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <img id="imgPrf" src="/img/profil.webp" alt="profil">
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                    <li><a class="dropdown-item" href="#">Messagerie</a></li>
                    <li><a class="dropdown-item" href="#">Add project</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="/logout.php">Se déconnecter</a></li>
                </ul>
            </div>
        </div>




    </header>