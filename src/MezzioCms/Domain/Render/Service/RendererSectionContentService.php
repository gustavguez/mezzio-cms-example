<?php

declare(strict_types=1);

namespace Gustavguez\MezzioCms\Domain\Render\Service;

use Gustavguez\MezzioCms\Domain\Core\Service\SectionContentService;

class RendererSectionContentService
{
	protected $sectionContentService;

	public function __construct(SectionContentService $sectionContentService) {
		$this->sectionContentService = $sectionContentService;
	}

	public function render(array $params) {
		$data = [];

		try {

			//Check id in params
			if(isset($params['id'])) {
				$data = $this->sectionContentService->getEntity($params['id']);
			} else {
				//Default published 1
				$params['published'] = 1;
				
				//Normal fetch
				$data = $this->sectionContentService->getCollection($params);
			}
		} catch (\Exception $e) {
			//Return exception
			$data = $e->getMessage();
		}
		
		return $data;
	}
}
