<?php

namespace Gustavguez\MezzioCms\Handler\Core;

use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Mezzio\Template\TemplateRendererInterface;
use Mezzio\Router\RouteResult;

class RenderHandler implements RequestHandlerInterface
{

	/** @var TemplateRendererInterface */
    private $template;

    public function __construct(TemplateRendererInterface $template) {
        $this->template = $template;
	}
	
	public function handle(ServerRequestInterface $request) : ResponseInterface
    {
		$data = [];

		//Get route name to detect template to render and process
		$result = $request->getAttribute(RouteResult::class);
		$templateName = $result->getMatchedRouteName();

		//Run render service to compile data

		return new HtmlResponse($this->template->render('app::' . $templateName, $data));
	}
}
