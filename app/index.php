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

// Middlewares
require_once './middlewares/AuthorizationMW.php';

require_once './controllers/UserController.php';
require_once './controllers/LoginController.php';
require_once './controllers/ProductController.php';
require_once './controllers/OrderController.php';
require_once './controllers/BillController.php';
require_once './controllers/TableController.php';
require_once './controllers/DateTimeController.php';
require_once './controllers/FileController.php';

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

// Login
$app->post('/login', \LoginController::class . ':ValidateLogin');

// Users
$app->group('/users', function (RouteCollectorProxy $group) {
  $group->get('[/]', \UserController::class . ':TraerTodos');
  $group->get('/{user}', \UserController::class . ':TraerUno');
  $group->post('[/]', \UserController::class . ':CargarUno');
  $group->post('/login', \LoginController::class . ':ValidateLogin');
})
  ->add(\AuthorizationMW::class . ':ValidateAdmin')
  ->add(\AuthorizationMW::class . ':ValidateToken');

// Products
$app->group('/products', function (RouteCollectorProxy $group) {
  $group->get('[/]', \ProductController::class . ':TraerTodos');
  $group->get('/{id_product}', \ProductController::class . ':TraerUno');
  $group->post('[/]', \ProductController::class . ':CargarUno')
    ->add(\AuthorizationMW::class . ':ValidateAdmin');
})
  ->add(\AuthorizationMW::class . ':ValidateWaiter')
  ->add(\AuthorizationMW::class . ':ValidateToken');

//Orders
$app->group('/orders', function (RouteCollectorProxy $group) {
  $group->get('[/]', \OrderController::class . ':TraerTodos');
  $group->get('/{id_order}', \OrderController::class . ':TraerUno');
  $group->post('[/]', \OrderController::class . ':CargarUno')
    ->add(\AuthorizationMW::class . ':ValidateWaiter');
  $group->put('/receive', \OrderController::class . ':RecibirOrden');
    // ->add(\AuthorizationMW::class . ':ValidateKitchen');
  $group->put('/deliver', \OrderController::class . ':EntregarOrden');
    // ->add(\AuthorizationMW::class . ':ValidateKitchen');
})
  ->add(\AuthorizationMW::class . ':ValidateToken');

//Bills
$app->group('/bills', function (RouteCollectorProxy $group) {
  $group->get('[/]', \BillController::class . ':TraerTodos');
  $group->get('/{id_bill}', \BillController::class . ':TraerUno');
  $group->post('[/]', \BillController::class . ':CargarUno');
})
->add(\AuthorizationMW::class . ':ValidateWaiter')
  ->add(\AuthorizationMW::class . ':ValidateToken');

//Tables
$app->group('/tables', function (RouteCollectorProxy $group) {
  $group->get('[/]', \TableController::class . ':TraerTodos');
  $group->get('/{id_table}', \TableController::class . ':TraerUno');
  $group->post('[/]', \TableController::class . ':CargarUno');
})
  ->add(\AuthorizationMW::class . ':ValidateToken');

$app->get('[/]', function (Request $request, Response $response) {
  $payload = json_encode(array("mensaje" => "Slim Framework 4 PHP"));

  $response->getBody()->write($payload);
  return $response->withHeader('Content-Type', 'application/json');
});

// Remaining Time
$app->get('/remaining_time', \OrderController::class . ':ObtenerTiempoRestante');

// Write & Load From Csv
$app->group('/csv', function (RouteCollectorProxy $group) {
  $group->get('[/]', \FileController::class . ':WriteToCsv');
  $group->post('[/]', \FileController::class . ':LoadFromCsv');
});

$app->run();
