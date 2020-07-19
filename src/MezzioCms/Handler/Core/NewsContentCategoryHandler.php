<?php

namespace Gustavguez\MezzioCms\Handler\Core;

use Gustavguez\MezzioCms\Domain\Api\Common\BaseHandler;
use Gustavguez\MezzioCms\Domain\Api\Response\ApiResponseEntity;
use Psr\Http\Message\ServerRequestInterface;

class NewsContentCategoryHandler extends BaseHandler
{
	public function get(ServerRequestInterface $request): ApiResponseEntity
    {   
        return new ApiResponseEntity($this->service->getCollection());
	}
}
