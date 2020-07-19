<?php

namespace Gustavguez\MezzioCms\Domain\Core\Service\Factory;

use Interop\Container\ContainerInterface;
use Gustavguez\MezzioCms\Domain\Core\Service\NewsContentCategoryService;

class NewsContentCategoryServiceFactory {

    public function __invoke(ContainerInterface $container) {
		$em = $container->get('doctrine.entity_manager.orm_default');

        return new NewsContentCategoryService($em);
    }

}
