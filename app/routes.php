<?php

declare(strict_types=1);

use Slim\App;
use Slim\Views\Twig;
use App\Application\Actions\User;
use App\Application\Actions\User\controlers;
use App\Application\Actions\User\ViewUserAction;
use App\Application\Actions\User\ListUsersAction;

use App\Application\Middleware\UsuarioMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use App\Application\Actions\User\controlers\Registrar;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Application\Actions\User\controlers\LogarAction;
use App\Application\Actions\User\controlers\ListarAction;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\Application\Actions\User\controlers\CadastrarAction;
use App\Application\Actions\User\controlers\SairSessaoAction;

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
   
        $app->post('/logar',LogarAction::class);

        $app->post('/sair',SairSessaoAction::class);
        $app->get('/listar',ListarAction::class);
    
        $app->post('/cadastrar',CadastrarAction::class);
        // ->add(new UsuarioMiddleware());

    $app->get('/registrar', function ($request, $response, $args) {
        $view = Twig::fromRequest($request);
        return $view->render($response, 'registrar.php', [
          
        ]);
    })->setName('registro');

    // $app->post('/',Registrar::class);



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
