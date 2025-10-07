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
        <h1 class ="text-3xl font-bold text-indigo-600 mb-8">Plateau de Jeu</h1>

        <article class ="flex flex-wrap justify-center gap-4 mb-10">
            <?php foreach ($cards as $card) : ?>
                <div class ="w-20 h-24 bg-indigo-500 text-white rounded-lg shadow-lg flex items-center justify-center text-2xl cursor-pointer hover:scale-105 hover:bg-indigo-600 transition">
                    ?
                </div>
            <?php endforeach; ?>  
        </article>

        <h2 class ="text-2xl font-semibold text-gray-800 mb-4"> Classement : </h2> 
        <article class ="bg-gray-50 p-4 rounded-lg shadow-inner flex flex-col items-center gap-2">
            <?php foreach ($scoreboard->getTopScores() as $entry): ?>
                <p class ="text-gray-700"><?= $entry['player'] ?> : <span class ="font-bold text-indigo-600"><?= $entry['score'] ?></span> coups</p>
            <?php endforeach ;?>
        </article>
    </section>
</body>
</html>
