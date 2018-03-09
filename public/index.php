<?php
/**
 * Created by PhpStorm.
 * User: gomab
 * Date: 2/27/18
 * Time: 2:19 PM
 */

use App\Blog\BlogModule;

//Chargemement autoload composer
require '../vendor/autoload.php';

//Initialisation App()

$app = new \Framework\App([
    BlogModule::class
]);

$response = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());

\Http\Response\send($response);
