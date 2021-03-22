<?php
use Lib\Class\ServerEntity;
use Windwalker\Renderer\PhpRenderer;

require_once 'includes.php';

$renderer = new PhpRenderer(__DIR__ . '/partials', []);

/** @var ServerEntity[] $servers */
$servers = getServers(true);
$globalStatus = ServerEntity::globalStatus($servers);

$currentServer = array_shift($servers);


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
                    <h1 class="text-6xl font-bold text-center text-gray-700 w-auto md:text-8xl"><?php echo $currentServer->serverName ?></h1>
                    <div class="flex my-4 items-center">
                        <span
                                class="rounded-full w-3 h-3 bg-<?php echo colorFromStatus($currentServer->status) ?>-500"
                        ></span>
                        <p class=" ml-2 text-<?php echo colorFromStatus($currentServer->status) ?>-500 text-xl">
                            <?php echo sentenceFromStatus($currentServer->status) ?>
                        </p>
                    </div>
                </article>
            </section>
        </header>
        <main>
            <article class="border-b border-gray-200 mb-4">
                <header class="py-3">
                    <h3 class="text-2xl text-gray-600 px-4 mb-4">
                        Websites of <strong><?php echo $currentServer->serverName ?></strong> server
                    </h3>
                </header>
                <section>
                    <?php foreach ($currentServer->sites as $site): ?>
                    <?php echo $renderer->render('website', compact('site')) ?>
                    <?php endforeach; ?>
                </section>
            </article>
            <section>
                <h2 class="text-2xl text-gray-600 px-4 my-4 font-bold">Other servers from LBXS Network</h2>
                <?php foreach ($servers as $server): ?>
                    <article class="border-b border-gray-200 mb-4">
                        <header class="py-3">
                            <h3 class="text-xl text-gray-600 px-4 mb-2">
                                Websites of <strong><?php echo $server->serverName ?></strong> server
                            </h3>
                            <a
                                    href="<?php echo $server->serverPage ?>"
                                    class="font-light mb-4 px-4 text-blue-400 hover:underline"
                            >
                                Switch to this server
                            </a>
                        </header>
                        <section>
                            <?php foreach ($server->sites as $site): ?>
                                <?php echo $renderer->render('website', compact('site')) ?>
                            <?php endforeach; ?>
                        </section>
                    </article>
                <?php endforeach; ?>
            </section>
        </main>
    </article>
</body>
</html>
