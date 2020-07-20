<?php

declare(strict_types=1);

namespace Gustavguez\MezzioCms\Domain\Render\Service\Factory;

use Psr\Container\ContainerInterface;
use Gustavguez\MezzioCms\Domain\Render\Service\RendererNewsContentService;
use Gustavguez\MezzioCms\Domain\Core\Service\NewsContentService;

class RendererNewsContentServiceFactory
{
    public function __invoke(ContainerInterface $container) : RendererNewsContentService
    {
		$newsContentService = $container->get(NewsContentService::class);

        return new RendererNewsContentService($newsContentService);
    }
}
