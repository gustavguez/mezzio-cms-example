<?php

declare(strict_types=1);

namespace Gustavguez\MezzioCms\Handler\Oauth;

use Gustavguez\MezzioCms\Domain\Api\Common\BaseHandler;
use Gustavguez\MezzioCms\Domain\Api\Common\BaseService;
use Psr\Http\Message\ServerRequestInterface;
use Gustavguez\MezzioCms\Domain\Api\Response\ApiResponseEntity;
use Mezzio\Authentication\UserInterface;

class MeHandler extends BaseHandler
{

    public function get(ServerRequestInterface $request): ApiResponseEntity
    {   
        //Get current session
        $session = $request->getAttribute(UserInterface::class);

        return new ApiResponseEntity([
            'me' => $this->service->getCurrentLoggedUser($session)
        ]);
    }
}
