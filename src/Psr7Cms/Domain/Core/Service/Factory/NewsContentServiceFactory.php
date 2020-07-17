<?php

namespace Gustavguez\Psr7Cms\Domain\Core\Service\Factory;

use Interop\Container\ContainerInterface;
use Gustavguez\Psr7Cms\Domain\Core\Service\NewsContentService;
use Gustavguez\Psr7Cms\Domain\Core\Service\MultimediaService;

class NewsContentServiceFactory {

    public function __invoke(ContainerInterface $container) {
		$em = $container->get('doctrine.entity_manager.orm_default');
        $multimediaService = $container->get(MultimediaService::class);
		
        return new NewsContentService($em, $multimediaService);
    }

}
