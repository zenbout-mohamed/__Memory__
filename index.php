<?php
session_start();

require_once "game.php";
require_once "player.php";
require_once "scoreboard.php";


if (isset($_GET['reset'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

if (!isset($_SESSION['cards'])) {
    $game = new Game(4); 
    $_SESSION['cards'] = array_map(fn($c) => $c->getValue(), $game->getCards());
    $_SESSION['found'] = [];
    $_SESSION['flipped'] = [];
    $_SESSION['turns'] = 0;
}

if (isset($_GET['flip'])) {
    $index = (int)$_GET['flip'];

    if (
        !in_array($index, $_SESSION['found']) &&
        !in_array($index, $_SESSION['flipped'])
    ) {
        $_SESSION['flipped'][] = $index;
    }

    if (count($_SESSION['flipped']) === 2) {
        $_SESSION['turns']++;
        [$i1, $i2] = $_SESSION['flipped'];

        if ($_SESSION['cards'][$i1] === $_SESSION['cards'][$i2]) {
            $_SESSION['found'][] = $i1;
            $_SESSION['found'][] = $i2;
        }

        $_SESSION['flipped'] = [];
    }
}

if (!isset($_SESSION['turns'])) {
    $_SESSION['turns'] = 0;
}

$player = new Player("Paul Pitch");
$scoreboard = new Scoreboard();

$turns = isset($_SESSION['turns']) ? (int)$_SESSION['turns'] : 0;
$scoreboard->addScore($player->getName(), $turns);
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeu Memory - PHP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-blue-100 to-indigo-200 min-h-screen flex flex-col items-center justify-center">

    <section class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-3xl text-center">
        <h1 class="text-3xl font-bold text-indigo-600 mb-8"> Jeu Memory</h1>

        <article class="flex flex-wrap justify-center gap-4 mb-10">
            <?php foreach ($_SESSION['cards'] as $i => $value): ?>
                <?php
                    $isFound = in_array($i, $_SESSION['found']);
                    $isFlipped = in_array($i, $_SESSION['flipped']);
                    $cardColor = $isFound ? 'bg-green-500' : ($isFlipped ? 'bg-yellow-400' : 'bg-indigo-500 hover:bg-indigo-600');
                ?>
                <a href="?flip=<?= $i ?>"
                   class="w-20 h-24 flex items-center justify-center text-2xl font-bold text-white rounded-xl shadow-lg transition transform hover:scale-105 <?= $cardColor ?>">
                    <?= ($isFound || $isFlipped) ? htmlspecialchars($value) : "?" ?>
                </a>
            <?php endforeach; ?>
        </article>
        <p class="text-lg text-gray-700 mb-4">
            Nombre de tours : <span class="font-semibold text-indigo-600"><?= $_SESSION['turns'] ?></span>
        </p>

        <a href="?reset=1" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
             Nouvelle partie
        </a>
        <h2 class="text-2xl font-semibold text-gray-800 mt-8 mb-4">Classement :</h2>
        <article class="bg-gray-50 p-4 rounded-lg shadow-inner flex flex-col items-center gap-2">
            <?php foreach ($scoreboard->getTopScores() as $entry): ?>
                <p class="text-gray-700">
                    <?= htmlspecialchars($entry['player']) ?> :
                    <span class="font-bold text-indigo-600"><?= $entry['score'] ?></span> tours
                </p>
            <?php endforeach; ?>
        </article>
    </section>

</body>
</html>
