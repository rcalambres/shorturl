<?php
namespace ShortUrls\Infrastructure\Base;

use ShortUrls\Application\Base\Interfaces\ApplicationService;
use ShortUrls\Application\Base\Interfaces\AuthenticationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class ShortUrlsController extends AbstractController
{

    public function __construct(
        protected AuthenticationService $authServices,
        protected ApplicationService $shortUrlServices,
    )
    {
    }

    public function __invoke(Request $request){
        if (!$this->authServices->auth($this->getBearer($request))){
            throw new \Exception("Auth failure");
        }
    }

    protected function getUrlParam(Request $request) : string
    {
        $contentParams = [];
        $url = '';

        if($request->getContent()){
            $contentParams = json_decode($request->getContent(), true);
            $url = $contentParams['url'] ?? '';
        }

        if ('' === $url){
            throw new \Exception("Bad Request");
        }

        return $url;
    }


    protected function response(array $data, array $params, ?int $total): JsonResponse
    {
        $status = (int)$total > 0 ? Response::HTTP_OK : Response::HTTP_NOT_FOUND;
        
        return $this->json(
            [
                'data' => $data,
                'params' => $params,
                'total' => $total,
                'status' => $status
            ],
            $status
        );
    }

    protected function getBearer(Request $request): string|null
    {
        $bearer = $request->headers->get('Authorization') ?? null;
        $bearer =  $bearer === null ? $bearer : str_replace('Bearer ', '', $bearer);

        return $bearer;
    }


}
