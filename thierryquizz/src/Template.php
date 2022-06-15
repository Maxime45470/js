<?php

namespace App;

class Template {
    //set a affiche l'input à la place de [HOLE]
    public static function parse(string $string) : string {
        return str_replace('[HOLE]','<input class="input w-full max-w-xs text-xl" type="text" placeholder="réponse..." name="answer" />',$string);
    }
    public static function displayBox($_answer, $answer, $next) : string {
        if ($_answer == $answer) {
        return '
        <div class="alert alert-success shadow-lg">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>Bonne réponse!</span>
                <a href="?index='. $next . '" class="btn btn-success">Question suivante</a>
            </div>
        </div>
        ';
        }else {
            return '';
        }
    }
}