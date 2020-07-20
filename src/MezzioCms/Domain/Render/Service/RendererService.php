<?php

declare(strict_types=1);

namespace Gustavguez\MezzioCms\Domain\Render\Service;

use Gustavguez\MezzioCms\Domain\Render\Entity\RenderBlockEntity;
use Gustavguez\MezzioCms\Domain\Render\Entity\RendererTypesEnum;
use Gustavguez\MezzioCms\Domain\Render\Service\RendererNewsContentService;
use JsonSerializable;

class RendererService
{

	//Renderers
	protected $rendererNewsContentService;

	public function __construct(RendererNewsContentService $rendererNewsContentService) {
		$this->rendererNewsContentService = $rendererNewsContentService;
	}

	public function render($renderBlocks): array {
		$data = [];

		//Check blocks
		if(is_array($renderBlocks) && count($renderBlocks)){
			foreach ($renderBlocks as $key => $renderBlock) {
				//Check instanceof first
				if($renderBlock instanceof RenderBlockEntity){
					$data[$renderBlock->getKey()] = $this->renderRenderBlock($renderBlock);
				}
			}
		}
		return $data;
	}

	private function renderRenderBlock(RenderBlockEntity $renderBlock): ?array {
		$data = [];
		$output = [];
		$params =  $renderBlock->getParams();
		$renderer = $renderBlock->getRenderer();

		//Switch render
		switch ($renderer) {
			case RendererTypesEnum::NEWS_CONTENT:
				$output = $this->rendererNewsContentService->render($params);
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
}
