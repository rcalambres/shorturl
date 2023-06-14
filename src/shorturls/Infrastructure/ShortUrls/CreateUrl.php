<?php
namespace ShortUrls\Infrastructure\ShortUrls;

use ShortUrls\Application\ShortUrl\Create\ShortUrlRequest;
use ShortUrls\Infrastructure\Base\ShortUrlsController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CreateUrl extends ShortUrlsController
{
    public function __invoke(Request $request) : JsonResponse
    {
        try{
            parent::__invoke($request); // parent auth
        }catch(\Exception $e){
            return new JsonResponse(["error" => $e->getMessage()], 401);
        }

        try{
            $command = new ShortUrlRequest($this->getUrlParam($request));
            $response = $this->shortUrlServices->execute($command);
        }catch(\Exception $e){
            return new JsonResponse(["error" => $e->getMessage()], 400); // Bad request
        }
        

        return new JsonResponse($response->getResult(), 200);
    }

}
