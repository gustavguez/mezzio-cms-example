<?php

namespace Gustavguez\MezzioCms\Domain\Core\Service\Factory;

use Interop\Container\ContainerInterface;
use Gustavguez\MezzioCms\Domain\Core\Service\MultimediaService;

class MultimediaServiceFactory {

    public function __invoke(ContainerInterface $container) {
        $config = $container->get('config');
		$em = $container->get('doctrine.entity_manager.orm_default');

        return new MultimediaService($em, $config['mezzio-cms']);
    }

}
