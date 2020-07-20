<?php

namespace Gustavguez\MezzioCms\Handler\Core\Factory;

use Interop\Container\ContainerInterface;
use Gustavguez\MezzioCms\Domain\Render\Service\RenderService;
use Gustavguez\MezzioCms\Handler\Core\RenderHandler;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RenderHandlerFactory {

    public function __invoke(ContainerInterface $container): RequestHandlerInterface {
		$template = $container->get(TemplateRendererInterface::class);
		$render = $container->get(RenderService::class);
        return new RenderHandler($template, $render);
    }

}
