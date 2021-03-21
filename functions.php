<?php

use \Lib\ServerConfig;

function getServerConfig($file = './serverConfig.json'): ServerConfig {
    try {
        $configJson = file_get_contents($file);
        $configObject = json_decode($configJson);
        return new ServerConfig($configObject);
    } catch (Error $e) {
        echo "error reading config file.";
        echo $e->getMessage();
        exit();
    }
}
