<?php

declare(strict_types=1);

namespace Gustavguez\MezzioCms\Domain\Oauth\Service\Factory;

use Psr\Container\ContainerInterface;
use Gustavguez\MezzioCms\Domain\Oauth\Service\UserService;

class UserServiceFactory
{
    public function __invoke(ContainerInterface $container) : UserService
    {
        $em = $container->get('doctrine.entity_manager.orm_default');
        return new UserService($em);
    }
}
