<?php
use Lib\Class\ServerEntity;
use Windwalker\Renderer\PhpRenderer;

require_once './includes.php';

/** @var ServerEntity[] $servers */
$servers = getServers(true);

include './pages/allServers.php';
exit();
