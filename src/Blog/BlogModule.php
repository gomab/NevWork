<?php
/**
 * Created by PhpStorm.
 * User: gomab
 * Date: 2/28/18
 * Time: 12:40 AM
 */

namespace App\Blog;

use Framework\Router;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BlogModule{

    public function __construct(Router $router)
    {
        //Create Route

        $router->get('/blog', [$this, 'index'], 'blog.index');
        $router->get('/blog/{slug:[a-z\-]+}', [$this, 'show'], 'blog.show');
    }

    public function index(Request $request): string {
        return '<h1>Bienvenue sur le blog</h1>';
    }

    public function show(Request $request): string {
        return '<h1>Bienvenue sur l\'article ' .$request->getAttribute('slug'). '</h1>';
    }
}