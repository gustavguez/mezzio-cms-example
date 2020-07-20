<?php

declare(strict_types=1);

namespace Gustavguez\MezzioCms\Domain\Render\Service;

use Gustavguez\MezzioCms\Domain\Render\Entity\RenderBlockEntity;
use Gustavguez\MezzioCms\Domain\Render\Service\RendererService;

class RenderService
{
	//Constants
	const CONFIG_TEMPLATES_KEY = "render_templates_path";
	const RENDER_BLOCKS_KEY = "blocks";
	const SHARED_TEMPATE_NAME = "shared.template.json";

	//Models
	protected $config;
	protected $renderer;

	public function __construct($config, RendererService $renderer) {
		$this->config = $config;
		$this->renderer = $renderer;
	}

	public function process(string $templateName): array {
		//Load Shared templates
		$sharedRenderBlocks = $this->getRenderBlocks(self::SHARED_TEMPATE_NAME);

		//Render
		$data = $this->renderer->render($sharedRenderBlocks);
		return $data;
	}

	private function getRenderBlocks($templateName): array {
		$renderBlocks = [];
		$fullPath = $this->getFullTemplatePath($templateName);

		//Check file exist
		if(file_exists($fullPath)) {
			try {
				//Get file content
				$templateContent = file_get_contents($fullPath);
	
				//Get decoded content
				$templateDecoded = json_decode($templateContent, true);

				//Get blocks decoded
				$blocksJson = isset($templateDecoded[self::RENDER_BLOCKS_KEY]) ? $templateDecoded[self::RENDER_BLOCKS_KEY] : [];

				//Last check and iterate it
				if(is_array($blocksJson)) {
					foreach ($blocksJson as $key => $blockJSON) {
						$renderBlocks[] = new RenderBlockEntity($blockJSON);
					}
				}
			} catch (Exception $exc) {
				//Do nothing
			}
		}

		return $renderBlocks;
	}

	private function getFullTemplatePath($templateName): string {
		return $this->config[self::CONFIG_TEMPLATES_KEY] . $templateName;
	}
    
}
