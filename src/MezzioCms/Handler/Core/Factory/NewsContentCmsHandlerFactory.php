<?php

namespace Gustavguez\MezzioCms\Handler\Core\Factory;

use Interop\Container\ContainerInterface;
use Mezzio\Router\RouterInterface;
use Mezzio\Template\TemplateRendererInterface;
use Gustavguez\MezzioCms\Handler\Core\NewsContentCmsHandler;
use Gustavguez\MezzioCms\Domain\Core\Service\NewsContentService;
use Psr\Http\Server\RequestHandlerInterface;

class NewsContentCmsHandlerFactory {

    public function __invoke(ContainerInterface $container): RequestHandlerInterface{
		
        $ncs = $container->get(NewsContentService::class);

        return new NewsContentCmsHandler($ncs);
    }

}
