<?php

namespace App;

class Questions {
    //contient les questions décodées dans un tableau associatif
    private array $_questionsList;
    //charge les questions dans $_questionsList
    public function __construct()
    {
        $this->_questionsList = json_decode(file_get_contents(__DIR__ . '/questions.json'), true);
    }
    //retourne la question en fonction de l'index
    public function getQuestion(int $index) : string
    {

        return $this->_questionsList[$index]['question'];

    }
    //retourne la réponse en fonction de l'index
    public function getAnswer(int $index) : string
    {

        return $this->_questionsList[$index]['answer'];
    }
    //retourne la longueur du quizz, methode statique
    public static function quizzLength() : int
    {
        return count(json_decode(file_get_contents(__DIR__ . '/questions.json'), true));
    }
}