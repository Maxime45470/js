<?php
//l'autoload permet de charger automatiquement les classes en fonction de l'arborescnce des dossiers dans /src
//l'autoload est generé automatiquement par composer
//composer est un gestionnaire de package similaire a npm
require_once 'vendor/autoload.php';

//démarre le session
//la class Score utilise une variable de session
session_start();

//imports des classes
use App\Questions as Questions;
use App\Template as Template;
use App\Score as Score;

//instanciation de la classe Questions dans la variable $questions
$q = new Questions();

//parametres
$index = intval($_GET['index'] ?? 0);
//$index correspond au numero de la question
//intval transforme GET[index] de chaine de caractère a  entier
$answer = $_GET['answer'] ?? '';
//$answer correspond à la réponse de l'utilisateur
$next = $index + 1;
//$next correspond au numero de la question suivante

//si l'index de la question est superieur à la longueur du quizz
//affiche la bravo.html et quitte le script
if ($index >= Questions::quizzLength()) {
    include __DIR__.'/bravo.html';
    exit();
}
//récupère la question en fonction de l'index
$_question = $q->getQuestion($index);
//récupère la réponse en fonction de l'index
$_answer = $q->getAnswer($index);

//récupere le score depuis la methode statique getScore() de la class Score
$score = Score::getScore();


//la partie PHP/HTML est plutot dégeu, mais bon sans moteur de template ni front-end, pas le choix

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.14.3/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Q&A</title>
</head>
<body class="p-4">
    <?php
    //si $answer et $_answer sont pareil, affiche le message de bonne réponse
    echo Template::displayBox($_answer, $answer, $next);
    ?>
    <form action="/" method="get" class="text-xl">
    <?php
    //affiche la question avec input a la place de HOLE
    echo Template::parse($q->getQuestion($index));
    ?>

    <input style="display:none" name="index" value="<?php echo $index?>" />
    <!--
        manière de faire un submit probablement pas valide, mais il y a une incompatibilté avec la librairie d'UI (tailwiind+daisyui)
    -->
    <div type="submit">
        <button class="btn btn-primary" >répondre</button>
    </div>
    </form>
    <div class="text-3xl">Score</div>
    <div class="font-bold text-6xl"><?php echo $score ?></div>
  
</div>
</body>
</html>