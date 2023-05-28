<?php

require "vendor/autoload.php";
session_start();
define('STORAGE_IMG_PATH', __DIR__ . "/uploads/img");
define('VIEW_PATH', __DIR__ . "/View");
$route = new classes\Router();

$route
        ->Get("/", [classes\Home::class, 'index'])
        ->Get("/about", [classes\About::class, 'index'])
        ->Get("/about/create", [classes\About::class, 'getter'])
        ->Post("/about/create", [classes\About::class, 'poster'])
        ->Get("/lahcen", [classes\About::class, 'lahcen'])
        ->Post("/upload", [classes\Home::class, 'upload'])
        ->Get("/page", [classes\Page::class, 'index']);

echo $route->Run($_SERVER["REQUEST_URI"], strtolower($_SERVER["REQUEST_METHOD"]));
