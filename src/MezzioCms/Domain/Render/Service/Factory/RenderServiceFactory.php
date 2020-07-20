<?php

declare(strict_types=1);

namespace Gustavguez\MezzioCms\Domain\Render\Service\Factory;

use Psr\Container\ContainerInterface;
use Gustavguez\MezzioCms\Domain\Render\Service\RenderService;
use Gustavguez\MezzioCms\Domain\Render\Service\RendererService;

class RenderServiceFactory
{
    public function __invoke(ContainerInterface $container) : RenderService
    {
		$config = $container->get('config');
		$renderer = $container->get(RendererService::class);

        return new RenderService(
			isset($config['mezzio-cms']) ? $config['mezzio-cms'] : [],
			$renderer
		);
    }
}
