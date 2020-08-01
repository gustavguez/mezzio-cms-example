<?php

namespace Gustavguez\MezzioCms\Handler\Core\Factory;

use Interop\Container\ContainerInterface;
use Gustavguez\MezzioCms\Domain\Core\Service\SectionContentService;
use Gustavguez\MezzioCms\Domain\Oauth\Service\UserService;
use Gustavguez\MezzioCms\Handler\Core\SectionContentHandler;
use Psr\Http\Server\RequestHandlerInterface;

class SectionContentHandlerFactory {

    public function __invoke(ContainerInterface $container): RequestHandlerInterface{
		
		$sectionService = $container->get(SectionContentService::class);
		$userService = $container->get(UserService::class);

        return new SectionContentHandler($sectionService, $userService);
    }

}
