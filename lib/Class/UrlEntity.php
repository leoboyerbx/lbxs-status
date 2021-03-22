<?php

namespace Lib\Class;

class UrlEntity {
    public string $url;
    public string $fullUrl;
    public bool $isUp = false;
    public int $httpCode;

    public function __construct(string $url) {
        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://')) {
            $this->fullUrl = $url;
            $arrayUrl = explode('//', $url);
            array_shift($arrayUrl);
            $this->url = implode('//', $arrayUrl);
        } else {
            $this->url = $url;
            $this->fullUrl = 'https://' . $url;
        }
        $this->testUrl();
    }

    public static function createMultiple(array $items): array {
        $result = [];
        foreach($items as $item) {
            $result[] = new self($item);
        }
        return $result;
    }

    public function __toString(): string {
        return $this->url;
    }

    public function testUrl() {
        $timeout = 10;
        $ch = curl_init();
        curl_setopt ( $ch, CURLOPT_URL, $this->fullUrl );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt ( $ch, CURLOPT_TIMEOUT, $timeout );
        $http_respond = curl_exec($ch);
        $http_respond = trim( strip_tags( $http_respond ) );
        $http_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
        curl_close( $ch );
        if ( ( $http_code == "200" ) || ( $http_code == "302" ) ) {
            $this->isUp = true;
        } else {
            $this->httpCode = $http_code;
        }
    }
}
