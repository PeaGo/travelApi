<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/users', function(Request $req, Response $res){
    return $res->withJson(['name'=>'Peago', 'age'=>'20']);
});


