<?php

namespace ShortUrls\Application\ShortUrl\Create;

use ShortUrls\Application\Base\Interfaces\ApplicationRequest;

class ShortUrlRequest implements ApplicationRequest
{

    public function __construct(
        private string $url
    )
    {
        if (false === filter_var($url, FILTER_VALIDATE_URL)){
            throw new \Exception("Url not valid");
        }
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}