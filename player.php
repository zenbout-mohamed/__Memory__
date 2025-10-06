<?php

class Player {
    private string $name;
    private array $scores = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addScore(int $score): void {
        $this->scores[] = $score;
    }

    public

}


?>