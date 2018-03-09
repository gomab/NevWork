<?php
/**
 * Created by PhpStorm.
 * User: gomab
 * Date: 2/28/18
 * Time: 12:40 AM
 */

namespace App\Blog;

use App\Framework\Renderer;
use Framework\Router;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BlogModule
{

    private $renderer;

    public function __construct(Router $router, Renderer $renderer)
    {
        //Create Render
        $this->renderer = $renderer;
        $this->renderer->addPath('blog', __DIR__  . '/views');

        //Create Route
        $router->get('/blog', [$this, 'index'], 'blog.index');
        $router->get('/blog/{slug:[a-z\-0-9]+}', [$this, 'show'], 'blog.show');
    }

    public function index(Request $request): string
    {
        return $this->renderer->render('@blog/index');
    }

    public function show(Request $request): string
    {
        return $this->renderer->render('@blog/show', [
            'slug' => $request->getAttribute('slug')
        ]);
    }
}
