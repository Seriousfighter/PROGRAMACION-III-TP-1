<?php

declare(strict_types=1);


use GuzzleHttp\Psr7\ServerRequest;
use HttpSoft\Emitter\SapiEmitter;
use League\Route\Router;
use Framework\Template\PlatesRenderer;
use Framework\Template\RendererInterface;
use GuzzleHttp\Psr7\HttpFactory;
use Framework\Controller\ErrorController;
use League\Route\Http\Exception\MethodNotAllowedException;
use League\Route\Http\Exception\NotFoundException;
use League\Route\Strategy\ApplicationStrategy;
use Psr\Http\Message\ResponseFactoryInterface;


define("BASE_PATH", dirname(__DIR__));

require_once BASE_PATH . '/vendor/autoload.php';
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->safeLoad();


ini_set("display_errors", "1");

$request = ServerRequest::fromGlobals();

$builder = new DI\ContainerBuilder;

$builder->addDefinitions([ ResponseFactoryInterface::class => DI\create(HttpFactory::class),
                           RendererInterface::class => DI\create(PlatesRenderer::class) ]);

$builder->useAttributes(true);                           
$container = $builder->build();                           


$router = new Router();

$strategy = new ApplicationStrategy;

$strategy->setContainer($container);

$router->setStrategy($strategy);


bootEloquent();


include BASE_PATH . '/src/Routes/web.php';
include BASE_PATH . '/src/Routes/api.php';
//diferentes formas de hacer lo mismo, se pueden usar controladores o funciones anonimas, lo importante es que devuelvan una respuesta
/*$router->get('/', [HomeController::class, 'index']);

$router->get('/back', function () {


    $stream = Utils::streamFor('back');

    $response = new Response;

    $response->withBody($stream);

    $response = $response->withBody($stream);

    return $response;
                    
});

$router->get('/ingredients',[IngredientsController::class, 'index']);
$router->get('/ingredients/{id:number}',[IngredientsController::class, 'show']);
$router->get('/ingredients/create',[IngredientsController::class, 'create']);
$router->post('/ingredients',[IngredientsController::class, 'store']);
  */  


try {
    $response = $router->dispatch($request);
} catch (NotFoundException) {
    $response = $container->get(ErrorController::class)->notFound();
} catch (MethodNotAllowedException) {
    $response = $container->get(ErrorController::class)->methodNotAllowed();
} catch (Throwable) {
    $response = $container->get(ErrorController::class)->serverError();
}

$emitter = new SapiEmitter();

$emitter->emit($response);

