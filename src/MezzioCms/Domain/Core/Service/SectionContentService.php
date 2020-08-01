<?php

namespace Gustavguez\MezzioCms\Domain\Core\Service;

use Gustavguez\MezzioCms\Domain\Core\Entity\SectionContentEntity;
use Gustavguez\MezzioCms\Domain\Core\Service\ContentService;

class SectionContentService extends ContentService {

    protected $class = SectionContentEntity::class;
	protected $multimediaFolder = 'sections';
	
	public function parseContentBeforePersist($content, $payload){
		//Check parent
		if(isset($payload['parent']) && !empty($payload['parent'])){
			$content->setParent(
				$this->entityManager->getReference(SectionContentEntity::class, $payload['parent'])
			);
		}
	}

}
