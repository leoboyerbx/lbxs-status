<?php
require_once 'includes.php';

$servers = getServers(true);
$currentServer = $servers[0];

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
            <section class="font-light text-gray-400 py-2 border-b border-gray-200">LBXS servers network</section>
            <section class="py-10 flex justify-center">
                <article>
                    <h1 class="text-8xl font-bold text-center text-gray-700 w-auto"><?php echo $currentServer->serverName ?></h1>
                </article>
            </section>
        </header>
    </article>
</body>
</html>
