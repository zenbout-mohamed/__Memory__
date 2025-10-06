<?php
require_once "card.php";

class Game {
    private array $arrayCards = [];

    public function __construct(int $pairs) {
        if ($pairs < 3 || $pairs > 12) {
            throw new Exception("Le nombre de paires doit être entre 3 et 12");
        }

        $fruits = [
            "Pomme", "Banane", "Raisin", "Pastèque", "Cerise", "Ananas",
            "Kiwi", "Abricot", "Noix de Coco", "Citron", "Mangue", "Fraise"
        ];

        shuffle($fruits);
        $chosen = array_slice($fruits, 0, $pairs);

        foreach ($chosen as $fruit) {
            $this->arrayCards[] = new Card($fruit);
            $this->arrayCards[] = new Card($fruit);
        }

        shuffle($this->arrayCards);
    }

    public function getCards(): array {
        return $this->arrayCards;
    }
}
?>
