<?php
namespace Lib;

class ServerConfig {
    public string $serverName;
    public function __construct(\stdClass $configArray) {
        $this->serverName = $configArray->serverName;
    }
}
