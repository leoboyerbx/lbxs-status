<?php
namespace Lib\Class;

class ServerEntity {
    public string $serverName;
    public string $id;
    public bool $isCurrent;

    public array $sites;

    public function __construct(\stdClass $config) {
        $this->serverName = $config->serverName;
        $this->id = $config->serverId;
        $this->isCurrent = $this->id === LBX_SERVER_ID;

        $this->sites = WebsiteEntity::createMultiple($config->sites);
    }

    public function allStatus() {
        return array_map(function (WebsiteEntity $website) {

        }, $this->sites);
    }

    public static function createMultiple(array $items): array {
        $result = [];
        foreach($items as $item) {
            $result[] = new self($item);
        }
        return $result;
    }
}
