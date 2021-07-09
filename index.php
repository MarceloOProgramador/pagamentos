<?php declare(strict_types = 1);

require __DIR__ . '/vendor/autoload.php';
 
use CoffeeCode\Router\Router;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router($_SERVER["APP_URL"]);

/* NAMESPACE USERS */
$router->namespace("App/Controllers");

$router->group(null);
$router->get("/usuarios", "UserController:index");

$router->dispatch();
