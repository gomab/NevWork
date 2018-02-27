<?php
/**
 * Created by PhpStorm.
 * User: gomab
 * Date: 2/27/18
 * Time: 2:52 PM
 */

namespace Framework;

use Framework\App;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;


class AppTest extends TestCase {
    public function testRedirectTrailingSlash(){
        $app = new App();
        $request = new ServerRequest('GET','/demoslash/');

        $response = $app->run($request);
        $this->assertContains('/demoslash', $response->getHeader('Location'));
        $this->assertEquals(301, $response->getStatusCode());
    }

    public function testHome(){
        $app = new App();
        $request = new ServerRequest('GET', '/home');
        $response = $app->run($request);
        $this->assertContains('<h1>Welcome to my web site</h1>', (string)$response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testError404(){
        $app = new App();
        $request = new ServerRequest('GET', '/aze');
        $response = $app->run($request);
        $this->assertContains('<h1>Error 404</h1>', (string)$response->getBody());
        $this->assertEquals(404, $response->getStatusCode());
    }
}