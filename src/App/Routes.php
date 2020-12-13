<?php

declare(strict_types=1);


use App\Handler\GetDesenvolvedorHandler;
use App\Handler\GetDesenvolvedorById;
use App\Handler\SaveDesenvolvedorHandler;
use App\Handler\UpdateDesenvolvedorHandler;
use App\Handler\DeleteDesenvolvedorHandler;
use Slim\Routing\RouteCollectorProxy;

$app->group('/developers', function (RouteCollectorProxy $group) {  
    $group->get('[/]', GetDesenvolvedorHandler::class);
    $group->get('/{id}',GetDesenvolvedorById::class);  
    $group->post('[/]', SaveDesenvolvedorHandler::class);
    $group->put('/{id}', UpdateDesenvolvedorHandler::class);
    $group->delete('/{id}', DeleteDesenvolvedorHandler::class);
});

