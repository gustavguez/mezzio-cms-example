<?php

namespace Gustavguez\MezzioCms\Domain\Core\Service;

use Gustavguez\MezzioCms\Domain\Core\Entity\EventContentEntity;
use Gustavguez\MezzioCms\Domain\Core\Service\ContentService;

class EventContentService extends ContentService {

    protected $class = EventContentEntity::class;
	protected $multimediaFolder = 'events';
	
	public function parseContentBeforePersist($content, $payload){
		$content->setDate(isset($payload['date']) ? $payload['date'] : null);
	}

}
