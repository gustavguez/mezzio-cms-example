<?php

declare(strict_types=1);

namespace Gustavguez\MezzioCms\Domain\Core\Service\Factory;

use Psr\Container\ContainerInterface;
use Gustavguez\MezzioCms\Domain\Core\Entity\ContentEntity;
use Gustavguez\MezzioCms\Domain\Core\Service\ContentService;

class ContentServiceFactory
{
    public function __invoke(ContainerInterface $container) : ContentService
    {
        $em = $container->get('doctrine.entity_manager.orm_default');
        return new ContentService($em, ContentEntity::class);
    }
}
