<?php

declare(strict_types=1);

namespace Gustavguez\MezzioCms\Domain\Render\Service\Factory;

use Psr\Container\ContainerInterface;
use Gustavguez\MezzioCms\Domain\Core\Service\SectionContentService;
use Gustavguez\MezzioCms\Domain\Render\Service\RendererSectionContentService;

class RendererSectionContentServiceFactory
{
    public function __invoke(ContainerInterface $container) : RendererSectionContentService
    {
		$sectionContentService = $container->get(SectionContentService::class);

        return new RendererSectionContentService($sectionContentService);
    }
}
