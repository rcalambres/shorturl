<?php

namespace ShortUrls\Infrastructure\ShortUrls\Persistence;

use ShortUrls\Domain\ShortUrl\ShortUrl;
use ShortUrls\Domain\ShortUrl\ShortUrlRepository;

class ApiShortUrlRepository implements ShortUrlRepository
{
    const SERVICE_URL = 'https://tinyurl.com/api-create.php?url=';

    public function generate(string $url): ShortUrl
    {
        $shortUrl = $this->getShortUrl($url);

        return ShortUrl::create($url, $shortUrl);
    }

    private function getShortUrl($url): string
    {
        $shortUrl = '';

        $apiUri = static::SERVICE_URL . $url;

        try{
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $apiUri);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );    # required for https urls

            $content = curl_exec( $ch );
            curl_close ( $ch );
            
            $shortUrl = $content;
        }catch(\Throwable $t){
            $shortUrl = '';
        } 

        return $shortUrl;
    }
}
