<?php

namespace ShortUrls\Application\ShortUrl\Create;

use ShortUrls\Application\Base\AbstractApplicationService;
use ShortUrls\Application\Base\Interfaces\ApplicationRequest;
use ShortUrls\Application\Base\Interfaces\ApplicationResponse;
use ShortUrls\Domain\ShortUrl\ShortUrlRepository;

class ShortUrlService extends AbstractApplicationService
{
    public function __construct(
        private ShortUrlRepository $shortUrlRepository
    )
    {
        
    }

    /**
     * @param ShortUrlRequest $request
     */
    public function execute(ApplicationRequest $request) : ApplicationResponse
    {
        $shortUrl = $this->shortUrlRepository->generate($request->getUrl());
        
        return new ShortUrlResponse($shortUrl);
    }
}