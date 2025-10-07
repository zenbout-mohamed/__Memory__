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

echo "<h1>Plateau de Jeu</h1>";

foreach ($cards as $card) {
    echo "<span> ? </span>";
}

echo "<h2>Classement :</h2>";
foreach ($scoreboard->getTopScores() as $entry) {
    echo $entry['player'] . " : " . $entry['score'] . " coups<br>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeux-Memory</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class ="bg-gradient-to-br from-blue-100 to-indigo-200 min-h-screen flex flex-col items-center justify-center">
    <section class ="bg-white p-8 rounded-2xl shadow-xl w-full max-w-3xl text-center">
        <h1 class ="text-3xl font-bold text-indigo-600 mb-8"></h1>


    </section>
</body>
</html>
