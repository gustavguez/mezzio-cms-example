<?php 
declare(strict_types=1);

namespace  Gustavguez\Psr7Cms\Middleware;
 
use Tuupola\Middleware\CorsMiddleware;
 
class CorsMiddlewareFactory
{
    public function __invoke($container)
    {
        return new CorsMiddleware([
            "origin" => ["*"],
            "methods" => ["GET", "POST", "PUT", "PATCH", "DELETE"],
            "headers.allow" => ["Content-Type", "Accept", "Authorization"],
            "headers.expose" => [],
            "credentials" => false,
            "cache" => 0,
        ]);
    }
}