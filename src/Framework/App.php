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

class App
{
    /**
     * List of modules
     * @var array
     */
    private $modules = [];

    /**
     * Router
     * @var Router
     */
    private $router;


    /**
     * App constructor.
     * @param array $modules Liste des modules à charger
     */
    public function __construct(array $modules = [], array $dependencies = [])
    {
        $this->router = new Router();
        if (array_key_exists('renderer', $dependencies)) {
            $dependencies['renderer']->addGlobal('router', $this->router);
        }

        //Initialiser chacun des modules
        foreach ($modules as $module) {
            //Passage de la variable d'instance aux diffferents modules
            $this->modules[] = new $module($this->router, $dependencies['renderer']);
        }
    }


    public function run(ServerRequestInterface $request): ResponseInterface
    {
        //Comprendre l'objet Request & Response

        //Recuperation url
        $uri = $request->getUri()->getPath();

        if (!empty($uri) && $uri[-1] == "/") {
            return (new Response())
                ->withStatus(301)
                ->withHeader('Location', substr($uri, 0, -1));
        }

        //Obtenir la route qui correspond à la requete
        $route = $this->router->match($request);

        if (is_null($route)) {
            return new Response(404, [], '<h1>Error 404</h1>');
        }

        $params = $route->getParams();
        $request = array_reduce(array_keys($params), function ($request, $key) use ($params) {
            return $request->withAttribute($key, $params[$key]);
        }, $request);

        //$request->withAttribute();

        $response = call_user_func_array($route->getCallback(), [$request]);

        if (is_string($response)) {
            return new Response(200, [], $response);
        } elseif ($response instanceof ResponseInterface) {
            return $response;
        } else {
            throw new \Exception('The response is not a string or an instance of ResponseInterface');
        }


        /**
        if ($uri === '/home') {
            return new Response(200, [], '<h1>Welcome to my web site</h1>');
        }

        return new Response(404, [], '<h1>Error 404</h1>');
         *
         * */

        //$response = new Response();
        //$response->getBody()->write('HI');
        //return $response;
    }
}
