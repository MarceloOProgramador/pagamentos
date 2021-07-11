<?php declare(strict_types = 1);

header('Content-type:application/json;charset=utf-8');

require __DIR__ . '/vendor/autoload.php';
 
use CoffeeCode\Router\Router;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router($_SERVER["APP_URL"]);

/*NAMESPACE USERS */
$router->namespace("App\Controllers");

$router->group(null);
$router->post("/transaction", "UserController:sendTo");

$router->dispatch();
