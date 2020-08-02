<?php

declare(strict_types=1);

namespace Gustavguez\MezzioCms\Domain\Render\Service;

use Gustavguez\MezzioCms\Domain\Core\Service\EventContentService;

class RendererEventContentService
{
	protected $eventContentService;

	public function __construct(EventContentService $eventContentService) {
		$this->eventContentService = $eventContentService;
	}

	public function render(array $params) {
		$data = [];

		try {

			//Check id in params
			if(isset($params['id'])) {
				$data = $this->eventContentService->getEntity($params['id']);
			} else {
				//Normal fetch
				$data = $this->eventContentService->getCollection($params);
			}
		} catch (\Exception $e) {
			//Return exception
			$data = $e->getMessage();
		}
		
		return $data;
	}
}
