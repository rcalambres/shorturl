<?php

namespace ShortUrls\Tests\ShortUrl;
use PHPUnit\Framework\TestCase;
use ShortUrls\Application\ShortUrl\Create\ShortUrlRequest;
use ShortUrls\Application\ShortUrl\Create\ShortUrlResponse;
use ShortUrls\Application\ShortUrl\Create\ShortUrlService;
use ShortUrls\Domain\ShortUrl\ShortUrl;
use ShortUrls\Domain\ShortUrl\ShortUrlRepository;

class CreateShortUrlTest extends TestCase
{
    public function testCreateShortUrl(): void
    {
        $url = static::generateRandomUrl(12);
        $commandShortUrl = new ShortUrlRequest($url);
        
        $shortUrlRepository = \Mockery::mock(ShortUrlRepository::class);
        $shortUrlRepository->allows(['generate' => ShortUrl::create($url, static::generateRandomUrl(4))]);

        $shortUrlService = new ShortUrlService($shortUrlRepository);
        $shortUrlResponse = $shortUrlService->execute($commandShortUrl);

        $this->assertIsArray($shortUrlResponse->getResult());
        $this->assertArrayHasKey("url", $shortUrlResponse->getResult());

    }

    private static function generateRandomUrl($URLlength = 8): string
    {
        $url = '';
        $protocols = ['http', 'https'];
        $charray = array_merge(range('a','z'), range('0','9'));
        $domains = ['.es', '.com', '.org', '.net'];

        $max = count($protocols) -1;
        $url .= $protocols[mt_rand(0, $max)] . "://";
        
        $max = count($charray) - 1;
        for ($i = 0; $i < $URLlength; $i++) {
            $randomChar = mt_rand(0, $max);
            $url .= $charray[$randomChar];
        }

        $max = count($domains) -1;
        $url .= $domains[mt_rand(0, $max)];
        return $url;
    }
}
