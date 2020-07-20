<?php

declare(strict_types=1);

namespace Gustavguez\MezzioCms\Domain\Render\Service\Factory;

use Psr\Container\ContainerInterface;
use Gustavguez\MezzioCms\Domain\Render\Service\RendererService;
use Gustavguez\MezzioCms\Domain\Render\Service\RendererNewsContentService;

class RendererServiceFactory
{
    public function __invoke(ContainerInterface $container) : RendererService
    {
		$rendererNewsContent = $container->get(RendererNewsContentService::class);
		
        return new RendererService(
			$rendererNewsContent
		);
    }
}
