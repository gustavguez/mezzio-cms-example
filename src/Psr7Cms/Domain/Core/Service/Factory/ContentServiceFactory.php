<?php

declare(strict_types=1);

namespace Gustavguez\Psr7Cms\Domain\Core\Service\Factory;

use Psr\Container\ContainerInterface;
use Gustavguez\Psr7Cms\Domain\Core\Entity\ContentEntity;
use Gustavguez\Psr7Cms\Domain\Core\Service\ContentService;

class ContentServiceFactory
{
    public function __invoke(ContainerInterface $container) : ContentService
    {
        $em = $container->get('doctrine.entity_manager.orm_default');
        return new ContentService($em, ContentEntity::class);
    }
}
