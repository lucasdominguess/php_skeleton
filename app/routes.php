<?php

declare(strict_types=1);

use Slim\App;
use Slim\Views\Twig;
use App\Application\Actions\User\ViewUserAction;
use App\Application\Actions\User\ListUsersAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\Application\Actions\User;
use App\Application\Actions\User\controlers;
use App\Application\Actions\User\controlers\Registrar;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    // $app->get('/', function (Request $request, Response $response) {
    //     $response->getBody()->write('Hello world!');
    //     return $response;
    // });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
       
    });
    

    
    $app->get('/', function ($request, $response, $args) {
        $view = Twig::fromRequest($request);
        return $view->render($response, 'index.php', [
          
        ]);
    })->setName('login');

    // $app->get('/logar', function ($request, $response,$args) {
    //     //  echo json_encode('chegou no app da rota');
    //     $view = Twig::fromRequest($request);
    //     return $view->render($response, 'registrar.php', [
          
    //     ]);
    // });

    $app->post('/logar',Registrar::class);

    $app->get('/registrar', function ($request, $response, $args) {
        $view = Twig::fromRequest($request);
        return $view->render($response, 'registrar.php', [
          
        ]);
    })->setName('registro');




    // $app->get('/hello/{name}', function (Request $request, Response $response, $args) {
    //     $name = $args['name'];
    //     $response->getBody()->write("ola, $name");
    //     return $response;
    // })->setName('paghello');

    // $app->get('/home', function (Request $request, Response $response, $args) {
    //     $name = $args['name'];
    //     $response->getBody()->write("ola, $name");
    //     return $response;
    // });


    // $app->get('/home', function ($request, $response, $args) {
    //     $view = Twig::fromRequest($request);
    //     return $view->render($response, 'index.html', [
          
    //     ]);
    // })

};
