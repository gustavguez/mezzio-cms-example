<?php

namespace Gustavguez\MezzioCms\Handler\Core;

use Gustavguez\MezzioCms\Domain\Render\Service\RenderService;
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
	
	/** @var RenderService */
    private $render;

    public function __construct(TemplateRendererInterface $template, RenderService $render) {
        $this->template = $template;
        $this->render = $render;
	}
	
	public function handle(ServerRequestInterface $request) : ResponseInterface
    {
		//Get route name to detect template to render and process
		$result = $request->getAttribute(RouteResult::class);
		$templateName = $result->getMatchedRouteName();

		//Run render service to compile data
		$data = $this->render->process($templateName);

		var_dump($data);die;

		return new HtmlResponse($this->template->render('app::' . $templateName, $data));
	}
}
