<?php

use Slim\Http\Request;
use Slim\Http\Response;


require __DIR__ . '/../vendor/autoload.php';
define('APP_PATH', __DIR__);

//  $illuminateContainer = new Container();
$config = array();
$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;
$app = new Slim\App(["settings" => $config]);

$container = $app->getContainer();


$container['logger'] = function($c) {
	$logger = new \Monolog\Logger('my_logger');
	$file_handler = new \Monolog\Handler\StreamHandler("/logs/rest.log");
	$logger->pushHandler($file_handler);
	return $logger;
};

//middleware
$app->add(function (Request $request, $response, $next) {
	$route = $request->getUri()->getPath();
	$response = $next($request, $response);
	
	return $response->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, token')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});




$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello world! - from PeaGo");
    return $response;
});
foreach (glob(APP_PATH.'/routes/*.php') as $filename)
{
	require $filename;
}

$app->run();