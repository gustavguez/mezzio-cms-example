<?php

namespace Gustavguez\MezzioCms\Handler\Core\Factory;

use Gustavguez\MezzioCms\Domain\Core\Service\RecipeContentService;
use Interop\Container\ContainerInterface;
use Gustavguez\MezzioCms\Domain\Oauth\Service\UserService;
use Gustavguez\MezzioCms\Handler\Core\RecipeContentHandler;
use Psr\Http\Server\RequestHandlerInterface;

class RecipeContentHandlerFactory {

    public function __invoke(ContainerInterface $container): RequestHandlerInterface{
		
		$recipeService = $container->get(RecipeContentService::class);
		$userService = $container->get(UserService::class);

        return new RecipeContentHandler($recipeService, $userService);
    }

}
