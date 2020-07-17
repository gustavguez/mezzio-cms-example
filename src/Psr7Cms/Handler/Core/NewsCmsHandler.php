<?php

namespace Gustavguez\Psr7Cms\Handler\Core;

use Psr\Http\Message\ServerRequestInterface;
use Gustavguez\Psr7Cms\Domain\Api\Common\BaseHandler;
use Gustavguez\Psr7Cms\Domain\Api\Response\ApiResponseEntity;
use Gustavguez\Psr7Cms\Domain\Core\Service\NewsContentService;

class NewsCmsHandler extends BaseHandler
{

    public function __construct(NewsContentService $service) {
        //Call parent construct
        parent::__construct($service);
    }

    public function get(ServerRequestInterface $request): ApiResponseEntity
    {   
        return new ApiResponseEntity([]);
    }
}
