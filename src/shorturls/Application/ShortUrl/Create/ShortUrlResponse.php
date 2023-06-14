<?php

namespace ShortUrls\Application\ShortUrl\Create;

use ShortUrls\Application\Base\Interfaces\ApplicationResponse;
use ShortUrls\Domain\ShortUrl\ShortUrl;

class ShortUrlResponse implements ApplicationResponse
{
    public function __construct(
        private ShortUrl $shortUrl
    )
    {
    }

    public function getShortUrl(): string
    {
        return $this->shortUrl->getShortUrl();
    }

    public function getResult(): array
    {
        return ['url' => $this->getShortUrl()];
    }
}