<?php

require "vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use classes\App;

session_start();
define('STORAGE_IMG_PATH', __DIR__ . "/uploads/img");
define('VIEW_PATH', __DIR__ . "/View");
$router = new classes\Router();

$router
        ->Get("/", [classes\Home::class, 'index'])
        ->Get("/about", [classes\About::class, 'index'])
        ->Get("/page", [classes\Page::class, 'index']);


(new App(
        $router,
        [
                'uri' => $_SERVER["REQUEST_URI"],
                'method' => strtolower($_SERVER["REQUEST_METHOD"]),

        ],
        [
                'driver' => $_ENV["DB_DRIVER"],
                'username' => $_ENV["DB_USERNAME"],
                'password' => $_ENV["DB_PASSWORD"],
                'host' => $_ENV["DB_HOSTNAME"],
                'database' => $_ENV["DB_NAME"]
        ]

))->run();

