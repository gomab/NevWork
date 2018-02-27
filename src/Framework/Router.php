<?php
/**
 * Created by PhpStorm.
 * User: gomab
 * Date: 2/27/18
 * Time: 5:40 PM
 */

namespace Framework;


use Framework\Router\Route;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Register and match routes
 *
 * Class Router
 * @package Framework
 */

class Router
{
    /**
     * @param string $path  Url
     * @param callable $callable Fonction a appelé
     * @param string $name Route
     */
    public function get(string $path, callable $callable, string $name)
    {

    }

    /**
     * @param ServerRequestInterface $request
     * @return Route|null
     */
    public function match(ServerRequestInterface $request): ?Route
    {

    }
}