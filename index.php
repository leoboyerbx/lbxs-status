<?php
use Lib\Class\ServerEntity;
use Windwalker\Renderer\PhpRenderer;

require_once 'includes.php';

/** @var ServerEntity[] $servers */
$servers = getServers(true);

if (LBX_SERVER_ID === '0'){
    include './pages/allServers.php';
    exit();
} else {
    include './pages/singleServer.php';
    exit();
}
