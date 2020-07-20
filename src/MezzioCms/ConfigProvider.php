<?php

declare(strict_types=1);

namespace Gustavguez\MezzioCms;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [
                
            ],
            'factories'  => [
				//Middlewares
				\Tuupola\Middleware\CorsMiddleware::class => Middleware\CorsMiddlewareFactory::class, 
				
                //Handlers
                Handler\Oauth\MeHandler::class => Handler\Oauth\Factory\MeHandlerFactory::class,
                Handler\Core\RenderHandler::class => Handler\Core\Factory\RenderHandlerFactory::class,
                Handler\Core\NewsContentHandler::class => Handler\Core\Factory\NewsContentHandlerFactory::class,
                Handler\Core\NewsContentCategoryHandler::class => Handler\Core\Factory\NewsContentCategoryHandlerFactory::class,

                //Services
				Domain\Oauth\Service\UserService::class => Domain\Oauth\Service\Factory\UserServiceFactory::class,
				Domain\Core\Service\NewsContentService::class => Domain\Core\Service\Factory\NewsContentServiceFactory::class,
				Domain\Core\Service\NewsContentCategoryService::class => Domain\Core\Service\Factory\NewsContentCategoryServiceFactory::class,
				Domain\Core\Service\MultimediaService::class => Domain\Core\Service\Factory\MultimediaServiceFactory::class,
				Domain\Render\Service\RenderService::class => Domain\Render\Service\Factory\RenderServiceFactory::class,
				Domain\Render\Service\RendererNewsContentService::class => Domain\Render\Service\Factory\RendererNewsContentServiceFactory::class,
				Domain\Render\Service\RendererService::class => Domain\Render\Service\Factory\RendererServiceFactory::class
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                'app'    => ['templates/app'],
                'error'  => ['templates/error'],
                'layout' => ['templates/layout'],
            ],
        ];
    }
}
