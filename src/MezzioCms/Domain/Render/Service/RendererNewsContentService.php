<?php

declare(strict_types=1);

namespace Gustavguez\MezzioCms\Domain\Render\Service;

use Gustavguez\MezzioCms\Domain\Core\Service\NewsContentService;
use Gustavguez\MezzioCms\Domain\Render\Entity\RenderBlockEntity;

class RendererNewsContentService
{
	protected $newsContentService;

	public function __construct(NewsContentService $newsContentService) {
		$this->newsContentService = $newsContentService;
	}

	public function render(array $params): ?array {
		$data = [];

		try {
			$data = $this->newsContentService->getCollection($params);
		} catch (\Exception $e) {
			//Return exception
			$data = [
				$e->getMessage()
			];
		}
		
		return $data;
	}
}
