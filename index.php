<?php
require_once "game.php";
require_once "player.php";
require_once "scoreboard.php";


$game = new Game(4);
$cards = $game->getCards();


$player = new Player("Paul Pitch");
$scoreboard = new Scoreboard();

$player->addScore(30);
$scoreboard->addScore($player->getName(), 30);


echo "<h1>Plateau de Jeu</h1>";?>