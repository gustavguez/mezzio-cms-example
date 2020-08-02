<?php

declare(strict_types=1);

namespace Gustavguez\MezzioCms\Domain\Render\Service\Factory;

use Gustavguez\MezzioCms\Domain\Render\Service\RendererEventContentService;
use Psr\Container\ContainerInterface;
use Gustavguez\MezzioCms\Domain\Render\Service\RendererService;
use Gustavguez\MezzioCms\Domain\Render\Service\RendererNewsContentService;
use Gustavguez\MezzioCms\Domain\Render\Service\RendererRecipeContentService;
use Gustavguez\MezzioCms\Domain\Render\Service\RendererSectionContentService;

class RendererServiceFactory
{
    public function __invoke(ContainerInterface $container) : RendererService
    {
		$rendererNewsContent = $container->get(RendererNewsContentService::class);
		$rendererSectionContentService = $container->get(RendererSectionContentService::class);
		$rendererRecipeContentService = $container->get(RendererRecipeContentService::class);
		$rendererEventContentService = $container->get(RendererEventContentService::class);

        return new RendererService(
			$rendererNewsContent,
			$rendererSectionContentService,
			$rendererRecipeContentService,
			$rendererEventContentService
		);
    }
}
