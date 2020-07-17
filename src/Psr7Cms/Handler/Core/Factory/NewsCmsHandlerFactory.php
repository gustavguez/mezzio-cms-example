<?php

namespace Gustavguez\Psr7Cms\Handler\Core\Factory;

use Interop\Container\ContainerInterface;
use Mezzio\Router\RouterInterface;
use Mezzio\Template\TemplateRendererInterface;
use Gustavguez\Psr7Cms\Handler\Core\NewsCmsHandler;
use Gustavguez\Psr7Cms\Domain\Core\Service\NewsContentService;
use Psr\Http\Server\RequestHandlerInterface;

class NewsCmsHandlerFactory {

    public function __invoke(ContainerInterface $container): RequestHandlerInterface{
		
        $ncs = $container->get(NewsContentService::class);

        return new NewsCmsHandler($ncs);
    }

}
