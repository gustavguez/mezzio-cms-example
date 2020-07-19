<?php

namespace Gustavguez\MezzioCms\Handler\Core\Factory;

use Interop\Container\ContainerInterface;
use Mezzio\Router\RouterInterface;
use Mezzio\Template\TemplateRendererInterface;
use Gustavguez\MezzioCms\Handler\Core\NewsContentHandler;
use Gustavguez\MezzioCms\Domain\Core\Service\NewsContentService;
use Gustavguez\MezzioCms\Domain\Oauth\Service\UserService;
use Psr\Http\Server\RequestHandlerInterface;

class NewsContentHandlerFactory {

    public function __invoke(ContainerInterface $container): RequestHandlerInterface{
		
		$newsService = $container->get(NewsContentService::class);
		$userService = $container->get(UserService::class);

        return new NewsContentHandler($newsService, $userService);
    }

}
