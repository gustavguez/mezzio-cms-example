<?php

declare(strict_types=1);

namespace Gustavguez\MezzioCms\Domain\Render\Service\Factory;

use Gustavguez\MezzioCms\Domain\Core\Service\RecipeContentService;
use Psr\Container\ContainerInterface;
use Gustavguez\MezzioCms\Domain\Render\Service\RendererRecipeContentService;

class RendererRecipeContentServiceFactory
{
    public function __invoke(ContainerInterface $container) : RendererRecipeContentService
    {
		$recipeContentService = $container->get(RecipeContentService::class);

        return new RendererRecipeContentService($recipeContentService);
    }
}
