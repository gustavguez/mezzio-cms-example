<?php

namespace Gustavguez\MezzioCms\Handler\Core;

use Psr\Http\Message\ServerRequestInterface;
use Gustavguez\MezzioCms\Domain\Api\Response\ApiResponseEntity;
use Gustavguez\MezzioCms\Domain\Core\Service\NewsContentService;

class NewsContentHandler extends ContentHandler
{

    public function __construct(NewsContentService $service) {
        //Call parent construct
        parent::__construct($service);
	}
	
}
