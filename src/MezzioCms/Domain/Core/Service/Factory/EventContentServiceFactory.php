<?php

namespace Gustavguez\MezzioCms\Domain\Core\Service\Factory;

use Gustavguez\MezzioCms\Domain\Core\Service\EventContentService;
use Interop\Container\ContainerInterface;
use Gustavguez\MezzioCms\Domain\Core\Service\MultimediaService;

class EventContentServiceFactory {

    public function __invoke(ContainerInterface $container) {
		$em = $container->get('doctrine.entity_manager.orm_default');
        $multimediaService = $container->get(MultimediaService::class);
		
        return new EventContentService($em, $multimediaService);
    }

}
