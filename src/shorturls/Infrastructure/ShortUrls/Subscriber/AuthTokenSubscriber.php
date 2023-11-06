<?php
namespace ShortUrls\Infrastructure\ShortUrls\Subscriber;

use ShortUrls\Application\Base\Interfaces\AuthenticationService;
use ShortUrls\Domain\Stack\Exceptions\AuthException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class AuthTokenSubscriber implements EventSubscriberInterface
{
    public function __construct(
        protected AuthenticationService $authServices,
    ) {
    }

    public function onKernelController(ControllerEvent $event): void
    {

        $request = $event->getRequest();
        if (!$this->authServices->auth($this->getBearer($request))){
            throw new AuthException("Auth failure");
        }

    }

    public function onKernelException(ExceptionEvent $event): void
    {

        $exception = $event->getThrowable();

        if ($exception instanceof AuthException){
            $response = new JsonResponse(
                ["error" => $exception->getMessage()], Response::HTTP_UNAUTHORIZED
            );

            $event->setResponse($response);
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }

    protected function getBearer(Request $request): string|null
    {
        $bearer = $request->headers->get('Authorization') ?? null;
        $bearer =  $bearer === null ? $bearer : str_replace('Bearer ', '', $bearer);

        return $bearer;
    }
}
