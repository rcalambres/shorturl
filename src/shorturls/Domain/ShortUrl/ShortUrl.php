<?php

namespace ShortUrls\Domain\ShortUrl;
use ShortUrls\Domain\Base\BaseDomain;

class ShortUrl extends BaseDomain
{
    private function __construct(
        protected string $url
        , protected string $shortUrl
    )
    {

    }

    public static function create(
        string $url
        , string $shortUrl
    )
    {
        return new static(
            $url
            , $shortUrl
        );
    }

    public function getShortUrl(): string
    {
        return $this->shortUrl;
    }

}