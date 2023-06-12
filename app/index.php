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
require_once './controllers/DishController.php';
require_once './controllers/OrderController.php';

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

$app->group('/dishes', function (RouteCollectorProxy $group) {
  $group->get('[/]', \DishController::class . ':TraerTodos');
  $group->get('/{dish_id}', \DishController::class . ':TraerUno');
  $group->post('[/]', \DishController::class . ':CargarUno');
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

$app->run();
