<?php
session_start(); 
require_once "game.php";
require_once "player.php";
require_once "scoreboard.php";


if (!isset($_SESSION['cards'])) {
    $game = new Game(4); 
    $_SESSION['cards'] = array_map(fn($c) => $c->getValue(), $game->getCards());
    $_SESSION['found'] = [];
    $_SESSION['flipped'] = [];
}


if (isset($_GET['flip'])) {
    $index = (int)$_GET['flip'];

    if (!in_array($index, $_SESSION['found']) && !in_array($index, $_SESSION['flipped'])) {
        $_SESSION['flipped'][] = $index;
    }

    if (count($_SESSION['flipped']) === 2) {
        $i1 = $_SESSION['flipped'][0];
        $i2 = $_SESSION['flipped'][1];

        if ($_SESSION['cards'][$i1] === $_SESSION['cards'][$i2]) {
            $_SESSION['found'][] = $i1;
            $_SESSION['found'][] = $i2;
        }

        
        $_SESSION['flipped'] = [];
    }
}

if (isset($_GET['reset'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}
$player = new Player("Paul Pitch");
$scoreboard = new Scoreboard();
$player->addScore(30);
$scoreboard->addScore($player->getName(), 30);


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeu Memory</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 to-indigo-200 min-h-screen flex flex-col items-center justify-center">

    <section class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-3xl text-center">
        <h1 class="text-3xl font-bold text-indigo-600 mb-8">Plateau de Jeu</h1>

        <article class="flex flex-wrap justify-center gap-4 mb-10">
            <?php foreach ($_SESSION['cards'] as $index => $value) : ?>
                <?php if (in_array($index, $_SESSION['found'])): ?>
                    <div class="w-20 h-24 bg-green-400 text-white rounded-lg shadow-lg flex items-center justify-center text-xl font-bold">
                        <?= htmlspecialchars($value) ?>
                    </div>
                <?php elseif (in_array($index, $_SESSION['flipped'])): ?>
                    <div class="w-20 h-24 bg-yellow-400 text-white rounded-lg shadow-lg flex items-center justify-center text-xl font-bold">
                        <?= htmlspecialchars($value) ?>
                    </div>
                <?php else: ?>
                    <a href="?flip=<?= $index ?>"
                       class="w-20 h-24 bg-indigo-500 text-white rounded-lg shadow-lg flex items-center justify-center text-2xl cursor-pointer hover:scale-105 hover:bg-indigo-600 transition">
                        ?
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </article>

        <div class="mb-6">
            <a href="?reset=1" class="text-sm text-indigo-600 underline hover:text-indigo-800">Nouvelle partie</a>
        </div>

        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Classement :</h2>
        <article class="bg-gray-50 p-4 rounded-lg shadow-inner flex flex-col items-center gap-2">
            <?php foreach ($scoreboard->getTopScores() as $entry): ?>
                <p class="text-gray-700"><?= htmlspecialchars($entry['player']) ?> :
                    <span class="font-bold text-indigo-600"><?= htmlspecialchars($entry['score']) ?></span> coups</p>
            <?php endforeach; ?>
        </article>
    </section>

</body>
</html>
