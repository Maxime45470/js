<?php

namespace App;


class Score {
    public static function getScore() : int {
        return $_SESSION['score'] ?? $_SESSION['score'] = 0;
    }
    public static function inscrementScore() : void {
        $_SESSION['score']++;
    }
    public static function resetScore() : void {
        $_SESSION['score'] = 0;
    }

}