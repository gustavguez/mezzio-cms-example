<?php

declare(strict_types=1);

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Mezzio\Authentication\OAuth2;
use Psr\Container\ContainerInterface;

/**
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Handler\HomePageHandler::class, 'home');
 * $app->post('/album', App\Handler\AlbumCreateHandler::class, 'album.create');
 * $app->put('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.put');
 * $app->patch('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.patch');
 * $app->delete('/album/:id', App\Handler\AlbumDeleteHandler::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class, ['GET', 'POST', ...], 'contact');
 *
 * Or handling all request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class)->setName('contact');
 *
 * or:
 *
 * $app->route(
 *     '/contact',
 *     App\Handler\ContactHandler::class,
 *     Mezzio\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 */
return static function (Application $app, MiddlewareFactory $factory, ContainerInterface $container) : void {
	$app->get('/', Gustavguez\MezzioCms\Handler\Core\RenderHandler::class, 'home');
	$app->get('/noticias/{title}-{id}', Gustavguez\MezzioCms\Handler\Core\RenderHandler::class, 'news');
	
	//MEZZIO-CMS ROUTES
	//$app->get('/', Gustavguez\MezzioCms\Handler\Core\RenderHandler::class, 'home');
	$app->post('/oauth', OAuth2\TokenEndpointHandler::class);
	$app->route('/oauth/me', [
			Mezzio\Authentication\AuthenticationMiddleware::class,
			Gustavguez\MezzioCms\Handler\Oauth\MeHandler::class
		], ['GET']
	);
	$app->route('/cms/news[/{id}]', [
			Mezzio\Authentication\AuthenticationMiddleware::class,
			Gustavguez\MezzioCms\Handler\Core\NewsContentHandler::class
		], ['GET', 'POST', 'DELETE']
	);
	$app->route('/cms/news-categories', [
			Mezzio\Authentication\AuthenticationMiddleware::class,
			Gustavguez\MezzioCms\Handler\Core\NewsContentCategoryHandler::class
		], ['GET']
	);
	$app->route('/cms/sections[/{id}]', [
		Mezzio\Authentication\AuthenticationMiddleware::class,
		Gustavguez\MezzioCms\Handler\Core\SectionContentHandler::class
		], ['GET', 'POST', 'DELETE']
	);
	$app->route('/cms/recipes[/{id}]', [
		Mezzio\Authentication\AuthenticationMiddleware::class,
		Gustavguez\MezzioCms\Handler\Core\RecipeContentHandler::class
		], ['GET', 'POST', 'DELETE']
	);
	$app->route('/cms/events[/{id}]', [
		Mezzio\Authentication\AuthenticationMiddleware::class,
		Gustavguez\MezzioCms\Handler\Core\RecipeContentHandler::class
		], ['GET', 'POST', 'DELETE']
	);
};
