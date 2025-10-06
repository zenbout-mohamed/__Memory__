<?php
require_once "card.php";


class Game {
    private $arrayCards = [];


    public function __construct(int $pairs){
        if ($pairs < 3 || $pairs > 12) {
           throw new Exception("Le nombre pair doit etre en 3 et 12");

           $fruits = ["Pomme ","Banane","Raisin","Pastèque","Cerise","Ananas","Kiwi","Abricot","Noix de Coco","Citron","Mangue","Fraise"];

           shuffle($fruits);
           $chosen = array_slice($fruits, 0, $pairs);
           
        }
    }
}


?>