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
    ->Get("/", [classes\Home::class , 'index'])
    ->Get("/post", [classes\Views\PostView::class , 'Addcoment'])
    ->Get("/comments", [classes\Views\PostView::class , 'GetCommentsbyid'])
    ->Get("/books", [classes\Controller\booksController::class , 'index'])
    ->Get("/chatroom", [classes\Controller\ChatController::class , 'index'])
    ->Get("/login", [classes\Views\UserView::class, 'login'])
    ->Post("/login", [classes\Views\UserView::class, 'LogUser'])
    ->Get("/logout", [classes\Views\UserView::class, 'logout'])
    ->Get("/signup", [classes\Views\UserView::class, 'Signup'])
    ->Post("/signup", [classes\Views\UserView::class, 'CreateAcounth']);


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

