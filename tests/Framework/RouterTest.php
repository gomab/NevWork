<?php

namespace Tests\Framework;

use Framework\Router;
use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Psr7\ServerRequest;


class RouterTest extends TestCase
{

    /**
     * @var Router
     */
    private $router;

    public function setUp()
    {
        $this->router = new Router();
    }

    public function testGetMethod()
    {
        //Creation d'une fausse requete qui contient /blog
        $request = new ServerRequest('GET', '/blog');

        //Creation d'une nouvelle url au niveau du router. Execution de la fonction detection apres la dection de
        // /blog. 'blog' => nom url

        $this->router->get('/blog', function () {
            return 'hello';
        }, 'blog');

        //Verification si la methode match l'une des url entrée
        $route = $this->router->match($request);

        //SI ca match ca envera un objet getName pour obtenir de la route qui a matché
        $this->assertEquals('blog', $route->getName());

        //getcallback pour obtenir le fonction qui a été appelé
        $this->assertEquals('hello', call_user_func_array($route->getcallback(), [$request]));
    }


    /**
     * SI l'url n'exite pas
     */
    public function testGetMethodIfUrlDoesNotExists()
    {
        //Creation d'une fausse requete qui contient /blog
        $request = new ServerRequest('GET', '/blog');

        //Creation d'une nouvelle url au niveau du router. Execution de la fonction detection apres la dection de
        // /blog. 'blog' => nom url

        $this->router->get('/blogaze', function () {
            return 'hello';
        }, 'blog');

        //Verification si la methode match l'une des url entrée
        $route = $this->router->match($request);

        //SI ca match ca envera un objet getName pour obtenir de la route qui a matché
        $this->assertEquals(null, $route);


    }

    /**
     * Url avec slug et id
     */
    public function testGetMethodWithParameters()
    {
        //Creation d'une fausse requete qui contient /blog
        $request = new ServerRequest('GET', '/blog/mon-slug-8');

        //Creation d'une nouvelle url au niveau du router. Execution de la fonction detection apres la dection de
        // /blog. 'blog' => nom url

        $this->router->get('/blog', function () {
            return 'azeaze';
        }, 'posts');
        $this->router->get('/blog/{slug:[a-z0-9\-]+}-{id:\d+}', function () {
            return 'hello';
        }, 'post.show');

        //Verification si la methode match l'une des url entrée
        $route = $this->router->match($request);

        //SI ca match ca envera un objet getName pour obtenir de la route qui a matché
        $this->assertEquals('post.show', $route->getName());

        //getcallback pour obtenir le fonction qui a été appelé
        $this->assertEquals('hello', call_user_func_array($route->getcallback(), [$request]));
        $this->assertEquals(['slug' => 'mon-slug', 'id' => '8'], $route->getParams());

        //Test Invalid Url
        $route = $this->router->match(new ServerRequest('GET', '/blog/mon_slug-8'));
        $this->assertEquals(null, $route);
    }

    /**
     * Test Generate Url
     */
    public function testGenerateUri()
    {
        $this->router->get('/blog', function () {
            return 'azeaze';
        }, 'posts');
        $this->router->get('/blog/{slug:[a-z0-9\-]+}-{id:\d+}', function () {
            return 'hello';
        }, 'post.show');

        //Generate url
        $uri = $this->router->generateUri('post.show', ['slug' => 'mon-article', 'id' => 18]);
        $this->assertEquals('/blog/mon-article-18', $uri);
    }
}
