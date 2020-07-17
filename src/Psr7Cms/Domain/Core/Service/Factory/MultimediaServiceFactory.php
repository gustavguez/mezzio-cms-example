<?php

namespace Gustavguez\Psr7Cms\Domain\Core\Service\Factory;

use Interop\Container\ContainerInterface;
use Gustavguez\Psr7Cms\Domain\Core\Service\MultimediaService;

class MultimediaServiceFactory {

    public function __invoke(ContainerInterface $container) {
        $config = $container->get('config');
		$em = $container->get('doctrine.entity_manager.orm_default');

        return new MultimediaService($em, $config['psr7-cms']);
    }

}
