<?php

namespace Gustavguez\MezzioCms\Handler\Core\Factory;

use Gustavguez\MezzioCms\Domain\Core\Service\EventContentService;
use Interop\Container\ContainerInterface;
use Gustavguez\MezzioCms\Domain\Oauth\Service\UserService;
use Gustavguez\MezzioCms\Handler\Core\EventContentHandler;
use Psr\Http\Server\RequestHandlerInterface;

class EventContentHandlerFactory {

    public function __invoke(ContainerInterface $container): RequestHandlerInterface{
		
		$eventService = $container->get(EventContentService::class);
		$userService = $container->get(UserService::class);

        return new EventContentHandler($eventService, $userService);
    }

}
