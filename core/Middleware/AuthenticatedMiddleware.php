<?php

namespace Core\Middleware;

use \Core\Containers\Environment;

class AuthenticatedMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        if(!$this->container->auth->signed()){
            return $response->withRedirect('/signin');
        }

        $response = $next($request, $response);
        return $response;
    }
}