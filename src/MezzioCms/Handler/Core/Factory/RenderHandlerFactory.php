<?php

namespace Gustavguez\MezzioCms\Handler\Core\Factory;

use Interop\Container\ContainerInterface;
use Gustavguez\MezzioCms\Handler\Core\RenderHandler;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RenderHandlerFactory {

    public function __invoke(ContainerInterface $container): RequestHandlerInterface {
		$template = $container->get(TemplateRendererInterface::class);
        return new RenderHandler($template);
    }

}
