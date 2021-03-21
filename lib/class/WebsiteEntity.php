<?php

namespace Lib\Class;

class WebsiteEntity {
    public string $name;
    public array $urls;

    public function __construct(\stdClass $config) {
        $this->name = $config->name;
        $this->urls = UrlEntity::createMultiple($config->urls);
    }

    public function status() {
        if ($this->numberOfUrls() === $this->numberOfUrlsUp()) {
            return LBX_ALL_UP;
        } else if ($this->numberOfUrls() === $this->numberOfUrlsDown()) {
            return LBX_ALL_DOWN;
        } else {
            return LBX_SOME_DOWN;
        }
    }

    public function numberOfUrls () {
        return count($this->urls);
    }

    public function numberOfUrlsUp () {
        return count(array_filter($this->urls, function (UrlEntity $url) {
            return $url->isUp;
        }));
    }

    public function numberOfUrlsDown () {
        return $this->numberOfUrls() - $this->numberOfUrlsUp();
    }

    public static function createMultiple(array $items): array {
        $result = [];
        foreach($items as $item) {
            $result[] = new self($item);
        }
        return $result;
    }
}
