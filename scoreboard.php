<?php
 
 class Scoreboard{
    private array $scores = [];

    public function addScores(string $player, int $score): void {
        $this->scores[] = ['player' => $player, 'score' => $score];

    }

    public function getTopScores(int $limit = 10): array {
        usort($this->scores, fn($a, $b) => $a['score'] <=> $b['score']);
        return array_slice($this->scores, 0, $limit);
    }
 }
 
 
 
 ?>