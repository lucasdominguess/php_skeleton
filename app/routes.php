<?php

declare(strict_types=1);

use App\Application\Actions\sender\HandleSenderAction;
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
use App\Application\Actions\User\controlers\EditarAction;
use App\Application\Actions\User\controlers\ListarAction;
use App\Application\Actions\User\controlers\ExcluirAction;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\Application\Actions\User\controlers\CadastrarAction;
use App\Application\Actions\User\controlers\SairSessaoAction;
use App\Application\Middleware\ValidatePostMiddleware;

return function (App $app) {
    // $app->options('/{routes:.*}', function (Request $request, Response $response) {
    //     // CORS Pre-Flight OPTIONS Request Handler
    //     return $response;
    // });

    // // $app->get('/', function (Request $request, Response $response) {
    // //     $response->getBody()->write('Hello world!');
    // //     return $response;
    // // });

    // $app->group('/users', function (Group $group) {
    //     $group->get('', ListUsersAction::class);
    //     $group->get('/{id}', ViewUserAction::class);
       
    // });
    

    
    $app->get('/', function ($request, $response, $args) {
        $view = Twig::fromRequest($request);
        return $view->render($response, 'index.php', [
          
        ]);
    })->setName('login');
    $app->get('/sender', HandleSenderAction::class);

    // $app->get('/logar', function ($request, $response,$args) {
    //     //  echo json_encode('chegou no app da rota');
    //     $view = Twig::fromRequest($request);
    //     return $view->render($response, 'registrar.php', [
          
    //     ]);
    // });
   
        $app->post('/logar',LogarAction::class)->add(ValidatePostMiddleware::class); //efetuar login 

        $app->post('/sair',SairSessaoAction::class); //sair da sessao
        $app->get('/listar',ListarAction::class); //listar dados para tabela
    
        $app->post('/cadastrar',CadastrarAction::class); //cadastrar
        // ->add(new UsuarioMiddleware());

        $app->get('/editar',EditarAction::class);
        $app->post('/excluir',ExcluirAction::class);

        $app->get('/acessoadm', function ($request, $response, $args) {
        $view = Twig::fromRequest($request);
        return $view->render($response, 'home.php', [
          
        ]);
        })->setName('acessoadm');

        $app->get('/acessouser', function ($request, $response, $args) {
        $view = Twig::fromRequest($request);
        return $view->render($response, 'home.user.html', [
          
        ]);
        })->setName('acessouser');

        $app->get('/invalidtoken', function ($request, $response, $args) {
        $view = Twig::fromRequest($request);
        return $view->render($response, '404.html', [
          
        ]);
    })->setName('tokenInvalido');

   
    $app->group('/admin',function(Group $group){ 
        $group->get('/acessoadm', function ($request, $response, $args) {
            $view = Twig::fromRequest($request);
            return $view->render($response, 'home.php', [
              
            ]);
            })->setName('acessoadm');
    });
    $app->group('/user',function(Group $group){ 
        $group->get('/acessouser', function ($request, $response, $args) {
            $view = Twig::fromRequest($request);
            return $view->render($response, 'home_users.html', [
              
            ]);
            })->setName('acessouser');
    });


 

};
