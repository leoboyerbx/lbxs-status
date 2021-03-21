<?php

use Lib\Class\ServerEntity;

require_once 'includes.php';

/** @var ServerEntity[] $servers */
$servers = getServers(true);
$currentServer = $servers[0];

$globalStatus = ServerEntity::globalStatus($servers);

function colorFromStatus ($status) {
    if ($status === LBX_ALL_UP) {
        return 'green';
    } else if ($status === LBX_SOME_DOWN) {
        return 'yellow';
    }
    return 'red';
}
function sentenceFromStatus ($status, $entity = 'websites') {
    if ($status === LBX_ALL_UP) {
        return "All $entity are up.";
    } else if ($status === LBX_SOME_DOWN) {
        return "Some $entity are down.";
    }
    return "All $entity are down.";
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $currentServer->serverName ?> - LBXS Network</title>

    <link rel="stylesheet" href="https://use.typekit.net/mkm0xzt.css">
    <link rel="stylesheet" href="css/tailwind.css">
</head>
<body>
    <article class="container mx-auto px-4 font-display">
        <header>
            <section class="font-light text-gray-400 py-2 border-b border-gray-200 flex justify-between align-center">
                <p>
                    LBXS servers network status
                </p>
                <div class="flex items-center">
                        <span
                                class="rounded-full w-3 h-3 bg-<?php echo colorFromStatus($currentServer->status) ?>-500"
                        ></span>
                    <p class=" ml-2 text-<?php echo colorFromStatus($globalStatus) ?>-500">
                        <?php echo sentenceFromStatus($globalStatus, 'servers') ?>
                    </p>
                </div>
            </section>
            <section class="py-10 flex border-b border-gray-200">
                <article>
                    <h1 class="text-8xl font-bold text-center text-gray-700 w-auto"><?php echo $currentServer->serverName ?></h1>
                    <div class="flex my-4 items-center">
                        <span
                                class="rounded-full w-5 h-5 bg-<?php echo colorFromStatus($currentServer->status) ?>-500"
                        ></span>
                        <p class=" ml-2 text-<?php echo colorFromStatus($currentServer->status) ?>-500 text-xl">
                            <?php echo sentenceFromStatus($currentServer->status) ?>
                        </p>
                    </div>
                </article>
            </section>
        </header>
        <main>
            <section>

            </section>
        </main>
    </article>
</body>
</html>
