<?php
/**
 * Created by PhpStorm.
 * User: gomab
 * Date: 2/27/18
 * Time: 2:29 PM
 */

namespace Framework;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class App{

    public function run(ServerRequestInterface $request): ResponseInterface{
        //Comprendre l'objet Request & Response

        //Recuperation url
        $uri = $request->getUri()->getPath();

        if(!empty($uri) && $uri[-1] == "/"){
            return (new Response())
                ->withStatus(301)
                ->withHeader('Location', substr($uri, 0, -1));

        }

        if($uri === '/home'){
            return new Response(200, [], '<h1>Welcome to my web site</h1>');
        }

        return new Response(404, [], '<h1>Error 404</h1>');

        //$response = new Response();
        //$response->getBody()->write('HI');
        //return $response;
    }
}