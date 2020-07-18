<?php

declare(strict_types=1);

namespace Gustavguez\MezzioCms\Handler\Oauth\Factory;

use Gustavguez\MezzioCms\Domain\Oauth\Service\UserService;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Gustavguez\MezzioCms\Handler\Oauth\MeHandler;

class MeHandlerFactory
{
    public function __invoke(ContainerInterface $container) : RequestHandlerInterface
    {
        $userService = $container->get(UserService::class);

        return new MeHandler(
            $userService
        );
    }
}
