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

    public function getBestScore(): ?int {
        return !empty($this->scores) ? min($this->scores) : null;
    }

    public function getScores(): ?array {
        return $this->scores;
    }
    public function getName(): string {
        return $this->name;
    }
}


?>