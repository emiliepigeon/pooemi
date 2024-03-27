<?php

namespace Framework\Middleware;

use Psr\Http\Message\ServerRequestInterface;

class TrainingSlashMiddlleware
{
    public function __invoke(ServerRequestInterface $request, callable $next)
    {
        $uri = $request->getUri()->getPath(); //récupère l'uri
        if (!empty($uri) && $uri[-1] === '/') //si l'uri n'est pas vide et que le dernier caractère est un 
        {
            return (new \GuzzleHttp\Psr7\Response()) //retourne une réponse vide
            ->withStatus(301) //redirection permanente
            ->withHeader('Location', substr($uri, 0, -1)) //redirige vers l'uri sans le dernier caractère
            ;
        }
        return $next($request); //sinon on passe au middleware suivant
    }

}