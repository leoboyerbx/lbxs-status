<?php
namespace Lib\Class;

class ServerEntity {
    public string $serverName;
    public string $id;
    public bool $isCurrent;
    public int $status;

    public array $sites;

    public function __construct(\stdClass $config) {
        $this->serverName = $config->serverName;
        $this->id = $config->serverId;
        $this->isCurrent = $this->id === LBX_SERVER_ID;

        $this->sites = WebsiteEntity::createMultiple($config->sites);
        $this->status = self::getStatus($this->websitesStatusArray());
    }


    public function websitesStatusArray(): array {
        return array_map(function (WebsiteEntity $website) {
            return $website->status();
        }, $this->sites);
    }

    public static function createMultiple(array $items): array {
        $result = [];
        foreach($items as $item) {
            $result[] = new self($item);
        }
        return $result;
    }

    public static function globalStatus($servers) {
        return self::getStatus(array_map(function (self $server) {
            return $server->status;
        }, $servers));
    }

    public static function getStatus($statusArray): int {
        $worstStatus = max($statusArray);
        if ($worstStatus < LBX_ALL_DOWN) {
            return $worstStatus;
        }
        if (in_array(LBX_ALL_UP, $statusArray) || in_array(LBX_SOME_DOWN, $statusArray)) {
            return LBX_SOME_DOWN;
        }
        return LBX_ALL_DOWN;
    }
}
