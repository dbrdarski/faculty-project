<?php

namespace Core\Middleware;

use \Core\Options\OptionManager;

class CsrfMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        OptionManager::setOption('csfr', [
            'tokenNameKey' => $this->container->csrf->getTokenNameKey(),
            'tokenName' => $this->container->csrf->getTokenName(),
            'tokenValueKey' => $this->container->csrf->getTokenValueKey(),
            'tokenValue' => $this->container->csrf->getTokenValue()
        ]);

        $response = $next($request, $response);
        return $response;
    }
}