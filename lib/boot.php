<?php

define('LBX_ALL_UP', 0);
define('LBX_SOME_DOWN', 1);
define('LBX_ALL_DOWN', 2);


$config = getServerConfig();

define('LBX_SERVER_ID', $config->serverId);
define('LBX_DEBUG', $config->debug);
