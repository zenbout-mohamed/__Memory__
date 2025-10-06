<?php
 
 class Scoreboard{
    private array $scores = [];

    public function addScores(string $player, int $score): void {
        $this->scores[] = ['player' => $player, 'score' => $score];

    }

    public function getTopScores(int $limit = 10): array {
        usort($this->score);
    }
 }
 
 
 
 ?>