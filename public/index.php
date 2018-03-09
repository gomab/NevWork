<?php
/**
 * Created by PhpStorm.
 * User: gomab
 * Date: 2/27/18
 * Time: 2:19 PM
 */

use App\Blog\BlogModule;
use App\Framework\Renderer;

//Chargemement autoload composer
require '../vendor/autoload.php';

$renderer = new \App\Framework\Renderer();
$renderer->addPath(dirname(__DIR__) . '/views');


//Initialisation App()

$app = new \Framework\App([
    BlogModule::class
], [
    'renderer' => $renderer
]);

$response = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());

\Http\Response\send($response);
