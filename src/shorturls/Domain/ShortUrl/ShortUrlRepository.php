<?php

namespace ShortUrls\Domain\ShortUrl;

interface ShortUrlRepository 
{
    public function generate(string $url): ShortUrl;
}