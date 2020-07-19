<?php

namespace Gustavguez\MezzioCms\Handler\Core;

use Psr\Http\Message\ServerRequestInterface;
use Mezzio\Authentication\UserInterface;
use Gustavguez\MezzioCms\Domain\Api\Common\BaseHandler;
use Gustavguez\MezzioCms\Domain\Api\Response\ApiResponseEntity;
use Gustavguez\MezzioCms\Domain\Oauth\Service\UserService;
use Gustavguez\MezzioCms\Domain\Core\Service\ContentService;

class ContentHandler extends BaseHandler
{
	protected $userService;

	public function __construct(ContentService $service, UserService $userService) {
        //Call parent construct
		parent::__construct($service);
		
		//Custom dependencies
		$this->userService = $userService;
	}

    public function get(ServerRequestInterface $request): ApiResponseEntity
    {   
		$id = $request->getAttribute('id');
		$queryParams = $request->getQueryParams();
		$response = [];

		if(!empty($id)){
			$response = $this->service->getEntity($id);
		} else if(isset($queryParams['query'])) {
			$response = $this->service->searchContent($queryParams["query"]);
		} else {
			$response = $this->service->getCollection();
		}
		
        return new ApiResponseEntity($response);
	}
	
	public function post(ServerRequestInterface $request): ApiResponseEntity
    {
		$id = $request->getAttribute('id');
		$data = $request->getParsedBody();
		$uploadFiles = $request->getUploadedFiles();
        $loggedUser = $this->userService->getCurrentLoggedUser(
            $request->getAttribute(UserInterface::class)
		);
		$response = [];

		if(empty($id)) {
			$response = $this->service->addContent($data, $uploadFiles, $loggedUser);
		} else {
			$response = $this->service->updateContent($id, $data, $uploadFiles);
		}
        return new ApiResponseEntity($response);
	}

	public function delete(ServerRequestInterface $request): ApiResponseEntity
    {
		$id = $request->getAttribute('id');
        return new ApiResponseEntity(
			$this->service->deleteContent($id)
		);
	}
	
}
