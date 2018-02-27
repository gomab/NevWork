<?php
/**
 * Created by PhpStorm.
 * User: gomab
 * Date: 2/27/18
 * Time: 2:19 PM
 */
//Chargemement autoload composer
require '../vendor/autoload.php';

//Initialisation App()

$app = new \Framework\App();

$response = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());

\Http\Response\send($response);
