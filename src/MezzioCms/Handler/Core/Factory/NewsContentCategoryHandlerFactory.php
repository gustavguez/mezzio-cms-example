<?php

namespace Gustavguez\MezzioCms\Handler\Core\Factory;

use Interop\Container\ContainerInterface;
use Mezzio\Router\RouterInterface;
use Mezzio\Template\TemplateRendererInterface;
use Gustavguez\MezzioCms\Handler\Core\NewsContentCategoryHandler;
use Gustavguez\MezzioCms\Domain\Core\Service\NewsContentCategoryService;
use Psr\Http\Server\RequestHandlerInterface;

class NewsContentCategoryHandlerFactory {

    public function __invoke(ContainerInterface $container): RequestHandlerInterface{
		
		$newsService = $container->get(NewsContentCategoryService::class);

        return new NewsContentCategoryHandler($newsService);
    }

}
