<?php

declare(strict_types=1);

namespace Gustavguez\MezzioCms\Domain\Api\Common;

use Gustavguez\MezzioCms\Domain\Api\Common\BaseService;
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
	/*
	//Init data array
	$data[$this->key] = [];

	//Get user session
	$user = $this->userService->loadSesion();
	$method = $request->getMethod();
	$queryParams = $request->getQueryParams();

	//User check
	if (empty($user) || empty($user['userName'])) {
		//Redirect admin
		return new RedirectResponse($this->router->generateUri('admin'));
	} else {
		//Set username
		$data['userName'] = $user['userName'];
	}

	//Data process
	if ($method === 'DELETE') {
		$this->contentService->deleteContent($queryParams['id']);
	} else if ($method === 'POST') {
		$uploadFiles = $request->getUploadedFiles();
		$payload = $request->getParsedBody();

		if ((int) $payload['id'] > 0) { //Update
			$this->contentService->updateContent($payload, $uploadFiles);
		} else { //Add
			$this->contentService->addContent($payload, $uploadFiles, $user['id']);
		}
	}

	//Search contents
	$contents = $this->contentService->fetchAll(array(), array('id' => 'DESC'));

	if (!empty($contents)) {
		foreach ($contents as $content) {
			if ($content instanceof JsonSerializable) {
				$data[$this->key][] = $content->jsonSerialize();
			}
		}
	}*/
}
