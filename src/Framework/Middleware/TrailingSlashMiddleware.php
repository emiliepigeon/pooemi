<?php
namespace Framework\Middleware;

use Psr\Http\Message\ServerRequestInterface;

class TrailingSlashMiddleware {

    public function __invoke(ServerRequestInterface $request, callable $next)
    {
        $uri = $request->getUri()->getPath();
        if (!empty($uri) && $uri[-1] === "/") {
            return (new \GuzzleHttp\Psr7\Response())
                ->withStatus(301)
                ->withHeader('Location', substr($uri, 0, -1));
        }
        return $next($request);
    }

}