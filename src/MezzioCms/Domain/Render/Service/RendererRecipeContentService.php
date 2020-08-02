<?php

declare(strict_types=1);

namespace Gustavguez\MezzioCms\Domain\Render\Service;

use Gustavguez\MezzioCms\Domain\Core\Service\RecipeContentService;

class RendererRecipeContentService
{
	protected $recipeContentService;

	public function __construct(RecipeContentService $recipeContentService) {
		$this->recipeContentService = $recipeContentService;
	}

	public function render(array $params) {
		$data = [];

		try {

			//Check id in params
			if(isset($params['id'])) {
				$data = $this->recipeContentService->getEntity($params['id']);
			} else {
				//Normal fetch
				$data = $this->recipeContentService->getCollection($params);
			}
		} catch (\Exception $e) {
			//Return exception
			$data = $e->getMessage();
		}
		
		return $data;
	}
}
