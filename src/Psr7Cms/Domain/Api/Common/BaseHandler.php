<?php

declare(strict_types=1);

namespace Gustavguez\Psr7Cms\Domain\Api\Common;

use Gustavguez\Psr7Cms\Domain\Api\Common\BaseService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;
use Exception;

class BaseHandler implements RequestHandlerInterface
{
    
    protected $service;

    public function __construct(BaseService $service)
    {
        $this->service = $service;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        try{
            //Get request method
            $method = strtolower($request->getMethod());

            //Check empty response
            if (!method_exists($this, $method)) {
                throw new Exception('Method not implemented', 405);
            }

            //Return Json
            return new JsonResponse($this->$method($request));
        }catch(Exception $e){
            //Return error
            return new JsonResponse([
                'message' => $e->getMessage()
            ], $e->getCode() ? $e->getCode() : 400);
        }
    }
}
