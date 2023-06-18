<?php
// Error Handling
error_reporting(-1);
ini_set('display_errors', 1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Slim\Routing\RouteContext;

require __DIR__ . '/../vendor/autoload.php';

require_once './db/DataAccess.php';
// require_once './middlewares/Logger.php';

require_once './controllers/UserController.php';
require_once './controllers/ProductController.php';
require_once './controllers/OrderController.php';
require_once './controllers/DateTimeController.php';

// Load ENV
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// Instantiate App
$app = AppFactory::create();

// Add error middleware
$app->addErrorMiddleware(true, true, true);

// Add parse body
$app->addBodyParsingMiddleware();

// Routes
$app->group('/users', function (RouteCollectorProxy $group) {
  $group->get('[/]', \UserController::class . ':TraerTodos');
  $group->get('/{user}', \UserController::class . ':TraerUno');
  $group->post('[/]', \UserController::class . ':CargarUno');
});

$app->group('/products', function (RouteCollectorProxy $group) {
  $group->get('[/]', \ProductController::class . ':TraerTodos');
  $group->get('/{dish_id}', \ProductController::class . ':TraerUno');
  $group->post('[/]', \ProductController::class . ':CargarUno');
});

$app->group('/orders', function (RouteCollectorProxy $group) {
  $group->get('[/]', \OrderController::class . ':TraerTodos');
  $group->get('/{order_id}', \OrderController::class . ':TraerUno');
  $group->post('[/]', \OrderController::class . ':CargarUno');
});

$app->get('[/]', function (Request $request, Response $response) {
  $payload = json_encode(array("mensaje" => "Slim Framework 4 PHP"));

  $response->getBody()->write($payload);
  return $response->withHeader('Content-Type', 'application/json');
});

// Pruebas
$app->get('/tests', function (Request $request, Response $response){
  // String to time
  $phpdate = DateTimeController::MySQLToDateTime( '2023-06-18 11:11:11' );
  $waitinTime = DateTimeController::getPreparationDateTime(30);
  // $remaininTime = DateTimeController::getRemainingMinutes('2023-06-18 16:20:11');
  $remaininTime = DateTimeController::getRemainingMinutes(DateTimeController::DateTimeToMySQL($waitinTime));


  $array = array(
    // '1'=>$phpdate,
    // '2'=>DateTimeController::getNowAsMySQL(),
    // '3'=>DateTimeController::DateTimeToMySQL($phpdate),
    '4'=>$waitinTime,
    '5'=>$remaininTime
    // '3'=>DateTimeController::DateTimeToMySQL("Hola")
  );
  $payload = json_encode($array);

  $response->getBody()->write($payload);
  return $response;
});

$app->run();
