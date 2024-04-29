<?php

declare(strict_types=1);

use Slim\App;
use Slim\Views\Twig;
use App\Application\Actions\User;
use App\Application\Actions\User\controlers;
use App\Application\Middleware\AdminMiddleware;
use App\Application\Actions\User\ViewUserAction;
use App\Application\Actions\User\ListUsersAction;

use App\Application\Middleware\UsuarioMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use App\Application\Actions\sender\HandleSenderAction;
use App\Application\Actions\User\controlers\Registrar;
use App\Application\Middleware\ValidatePostMiddleware;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Application\Actions\User\controlers\LogarAction;
use App\Application\Actions\User\controlers\EditarAction;
use App\Application\Actions\User\controlers\ListarAction;
use App\Application\Actions\User\controlers\ExcluirAction;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\Application\Actions\User\controlers\CadastrarAction;
use App\Application\Actions\User\controlers\SairSessaoAction;
use App\Application\Actions\User\controlers\ExibiradminsAction;

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
        
      
    // $app->get('/log', function ($request, $response, $args) {
    //     $view = Twig::fromRequest($request);
    //     return $view->render($response, 'logs.php', [
          
    //     ]);
    // });
   
        $app->post('/logar',LogarAction::class)->add(ValidatePostMiddleware::class); //efetuar login 
        $app->post('/sair',SairSessaoAction::class); //sair da sessao
        $app->get('/listar',ListarAction::class); //listar dados para tabela
        $app->post('/cadastrar',CadastrarAction::class); //cadastrar


        $app->get('/invalidtoken', function ($request, $response, $args) {
        $view = Twig::fromRequest($request);
        return $view->render($response, '404.html', [
          
        ]);
    })->setName('tokenInvalido');

   // Rotas Admins 
    $app->group('/admin',function(Group $group){ 
        $group->get('/acessoadm', function ($request, $response, $args) {
            $view = Twig::fromRequest($request);
            return $view->render($response, 'home.html', [
              
            ]);
            })->setName('acessoadm');
        
        $group->get('/editar',EditarAction::class);
        $group->post('/excluir',ExcluirAction::class);
        $group->get('/exibir_admins',ListarAction::class);
        $group->get('/exibiradmins', function ($request, $response, $args) {
            $view = Twig::fromRequest($request);
            return $view->render($response,'exibiradmins.html', [
              
            ]);
            });
        $group->get('/tentativas_acesso',ListarAction::class);   
        $group->get('/tentativasacesso', function ($request, $response, $args) {
            $view = Twig::fromRequest($request);
            return $view->render($response,'tentativas_acesso.html', [
              
            ]);
        });


    })->add(new AdminMiddleware());


    // rotas Usuarios
    $app->group('/user',function(Group $group){ 
        $group->get('/acessouser', function ($request, $response, $args) {
            $view = Twig::fromRequest($request);
            return $view->render($response, 'home_users.html', [
              
            ]);
            })->setName('acessouser');
    });


 

};
