<?php
$rawJson = file_get_contents("questions.json");
$listeQuestions = json_decode($rawJson);
//var_dump($listeQuestions);
/*
foreach($listeQuestions->questions as $question)
{
    var_dump($question);
    echo "question:".$question->question."<br>";
    $codeATrou = $question->code;
    $codeATrou = str_replace("[HOLE]","<input type=text maxlength=".strlen($question->reponse)." size=".strlen($question->reponse)." >",$codeATrou);
    echo "code:".$codeATrou."<br>";
}*/




function afficherQuestion($question)
{
    //var_dump($question);
    echo "question:".$question->question."<br>";
    $codeATrou = $question->code;
    $codeATrou = str_replace("[HOLE]","<input type=text maxlength=".strlen($question->reponse)." size=".strlen($question->reponse)." >",$codeATrou);
    echo "code:".$codeATrou."<br>";   
}

$numQuestion = isset($_GET['num'])?$_GET['num']:0;

afficherQuestion($listeQuestions->questions[$numQuestion]);
?>