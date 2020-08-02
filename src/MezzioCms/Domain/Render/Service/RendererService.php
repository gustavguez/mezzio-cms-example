<?php

declare(strict_types=1);

namespace Gustavguez\MezzioCms\Domain\Render\Service;

use Gustavguez\MezzioCms\Domain\Render\Entity\RenderBlockEntity;
use Gustavguez\MezzioCms\Domain\Render\Entity\RenderBlockParamEntity;
use Gustavguez\MezzioCms\Domain\Render\Entity\RendererTypesEnum;
use Gustavguez\MezzioCms\Domain\Render\Service\RendererNewsContentService;
use JsonSerializable;

class RendererService
{

	//Renderers
	protected $rendererNewsContentService;
	protected $rendererSectionContentService;
	protected $rendererRecipeContentService;

	public function __construct(
		RendererNewsContentService $rendererNewsContentService,
		RendererSectionContentService $rendererSectionContentService,
		RendererRecipeContentService $rendererRecipeContentService) {

		$this->rendererNewsContentService = $rendererNewsContentService;
		$this->rendererSectionContentService = $rendererSectionContentService;
		$this->rendererRecipeContentService = $rendererRecipeContentService;
	}

	public function render($renderBlocks, array $routeParams, array $queryParams): array {
		$data = [];

		//Check blocks
		if(is_array($renderBlocks) && count($renderBlocks)){
			foreach ($renderBlocks as $key => $renderBlock) {
				//Check instanceof first
				if($renderBlock instanceof RenderBlockEntity){
					$data[$renderBlock->getKey()] = $this->renderRenderBlock($renderBlock, $routeParams, $queryParams);
				}
			}
		}
		return $data;
	}

	private function renderRenderBlock(RenderBlockEntity $renderBlock, array $routeParams, array $queryParams): ?array {
		$data = [];
		$output = [];
		$renderer = $renderBlock->getRenderer();

		//Process params
		$params =  $this->processParams( $renderBlock->getParams(), $routeParams, $queryParams );

		//Switch render
		switch ($renderer) {
			case RendererTypesEnum::NEWS_CONTENT:
				$output = $this->rendererNewsContentService->render($params);
				break;
			case RendererTypesEnum::SECTIONS_CONTENT:
				$output = $this->rendererSectionContentService->render($params);
				break;
			case RendererTypesEnum::RECIPES_CONTENT:
				$output = $this->rendererRecipeContentService->render($params);
				break;
		}

		//Iterate and render as json
		if(is_array($output) && count($output)){
			foreach ($output as $key => $value) {
				//Render each item as json
				if($value instanceof JsonSerializable) {
					$data[] = $value->jsonSerialize();
				}
			}
		} else if($output instanceof JsonSerializable) {
			//Render primary level as json
			$data = $output->jsonSerialize();
		}
		return $data;
	}

	private function processParams(array $renderBlockParams, array $routeParams, array $queryParams): array {
		$params = [];

		if(is_array($renderBlockParams) && count($renderBlockParams)){
			foreach ($renderBlockParams as $blockParam) {
				$value = $blockParam->getValue();

				if($blockParam->isTemplateValue()) {
					$value = $this->renderTemplateValue($blockParam, $routeParams, $queryParams);
				} 
				
				$params[$blockParam->getKey()] = $value;
			}
		}

		return $params;
	}

	private function renderTemplateValue(RenderBlockParamEntity $blockParam, array $routeParams, array $queryParams): string {
		$value = '';
		$neededKey = $blockParam->getTemplateName();

		if(is_array($queryParams) && count($queryParams)){
			foreach ($queryParams as $qpKey => $qpValue) {
				if($neededKey === $qpKey) {
					$value = $qpValue;
				}
			}
		}

		if(is_array($routeParams) && count($routeParams)){
			foreach ($routeParams as $rpKey => $rpValue) {
				if($neededKey === $rpKey) {
					$value = $rpValue;
				}
			}
		}
		return $value;
	}
}
