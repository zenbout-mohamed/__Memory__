<?php

class Scoreboard {
    private array $scores = [];

    public function addScore(string $player, int $score): void {
        $this->scores[] = ['player' => $player, 'score' => $score];
        usort($this->scores, fn($a, $b) => $a['score'] <=> $b['score']);
        $this->scores = array_slice($this->scores, 0, 10);
    }

    public function getTopScores(int $limit = 10): array {
        return array_slice($this->scores, 0, $limit);
    }
}
?>
