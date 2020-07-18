<?php

namespace Gustavguez\MezzioCms\Handler\Core;

use Psr\Http\Message\ServerRequestInterface;
use Gustavguez\MezzioCms\Domain\Api\Common\BaseHandler;
use Gustavguez\MezzioCms\Domain\Api\Response\ApiResponseEntity;
use Gustavguez\MezzioCms\Domain\Core\Service\NewsContentService;

class ContentCmsHandler extends BaseHandler
{

    public function get(ServerRequestInterface $request): ApiResponseEntity
    {   
		$id = $request->getAttribute('id');
		
        return new ApiResponseEntity(
			empty($id) ? $this->service->getCollection() : $this->service->getEntity($id)
		);
    }
}
