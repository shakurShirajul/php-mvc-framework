<?php


// require __DIR__ . 'config/config.php';

const MODELS = 'App/Models/';
const CONTROLLER  = 'App/Controllers';
const CORE = 'Core/';
const APP = 'App/';
require CORE . 'Helper/function.php';
require CORE . "autoloader.php";

$response = new Response();



$response->setHeader("Access-Control-Allow-Origin: *");

$response->setHeader("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
$response->setHeader("Access-Control-Allow-Headers: Content-Type, Authorization");
$response->setHeader("Content-Type: application/json; charset=UTF-8");


use Controllers\UserControllers;
use Router\Router;

$router = new Router($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);


$router->get("/", [UserControllers::class, "users"]);
$router->get("/user", [UserControllers::class, "user"]);




$router->route();

$response->render();
