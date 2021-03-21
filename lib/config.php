<?php
namespace Lib;

class ServerConfig {
    public string $serverName;
    public function __construct(Array $configArray) {
        $this->serverName = $configArray['serverName'];
    }
}
