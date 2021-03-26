<?php

use Lib\Class\ServerEntity;
use Windwalker\Renderer\PhpRenderer;

/**
 * @var $servers ServerEntity
 */
$renderer = new PhpRenderer(APP_ROOT . '/partials', []);

$globalStatus = ServerEntity::globalStatus($servers);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LBXS Network</title>

    <link rel="stylesheet" href="https://use.typekit.net/mkm0xzt.css">
    <link rel="stylesheet" href="css/tailwind.css">

    <link rel="icon" href="img/icon-<?php echo colorFromStatus($globalStatus) ?>.png">
</head>
<body>
<article class="container mx-auto px-4 md:px-10 font-display">
    <header>
        <section class="font-light text-gray-400 py-2 border-b border-gray-200 flex flex-col md:flex-row justify-between align-center">
            <p>
                LBXS servers network status
            </p>
            <div class="flex items-center">
                        <span
                            class="rounded-full w-2 h-2 bg-<?php echo colorFromStatus($globalStatus) ?>-500"
                        ></span>
                <p class=" ml-2 text-<?php echo colorFromStatus($globalStatus) ?>-500">
                    <?php echo sentenceFromStatus($globalStatus, 'servers') ?>
                </p>
            </div>
        </section>
        <section class="py-10 flex border-b border-gray-200">
            <article class="mx-10">
                <h1 class="text-4xl font-bold text-center text-gray-700 w-auto md:text-6xl">LBXS Servers network</h1>
                <div class="flex my-4 items-center">
                        <span
                            class="rounded-full w-3 h-3 bg-<?php echo colorFromStatus($globalStatus) ?>-500"
                        ></span>
                    <p class=" ml-2 text-<?php echo colorFromStatus($globalStatus) ?>-500 text-xl">
                        <?php echo sentenceFromStatus($globalStatus, 'servers') ?>
                    </p>
                </div>
            </article>
        </section>
    </header>
    <main>
        <section class="border-b border-gray-200 mb-4">
            <?php foreach ($servers as $server): ?>
                <a href="<?php echo $server->serverPage ?>" class="flex items-center text-gray-800 text-lg hover:underline pt-4 px-2">
                    <img src="img/icon-<?php echo colorFromStatus($server->status) ?>.png" alt="Server status icon" class="w-8 mr-2">
                    <span><?php echo $server->serverName ?></span>
                    <span class="text-gray-300 ml-2 text-md">(<?php echo $server->serverPage ?>)</span>
                </a>
                <p class="text-<?php echo colorFromStatus($server->status) ?>-500 px-2 pt-1 pb-4">
                    <?php echo $server->numberOfUpWebsites() ?>/<?php echo $server->numberOfWebsites() ?> website<?php echo $server->numberOfWebsites() > 1 ? 's' : '' ?> running.
                </p>
            <?php endforeach; ?>
        </section>
    </main>
</article>
</body>
</html>

