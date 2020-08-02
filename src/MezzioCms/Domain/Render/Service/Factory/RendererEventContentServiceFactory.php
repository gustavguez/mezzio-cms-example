<?php

declare(strict_types=1);

namespace Gustavguez\MezzioCms\Domain\Render\Service\Factory;

use Gustavguez\MezzioCms\Domain\Core\Service\EventContentService;
use Psr\Container\ContainerInterface;
use Gustavguez\MezzioCms\Domain\Render\Service\RendererEventContentService;

class RendererEventContentServiceFactory
{
    public function __invoke(ContainerInterface $container) : RendererEventContentService
    {
		$eventContentService = $container->get(EventContentService::class);

        return new RendererEventContentService($eventContentService);
    }
}
