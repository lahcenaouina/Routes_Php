<?php

require "vendor/autoload.php";

$route = new classes\Router();

$route
        ->Register("/",[classes\Home::class , 'index'])
        ->Register("/about",[classes\About::class , 'index'])
        ->Register("/about/create",[classes\About::class , 'create'])
        ->Register("/lahcen/fine",[classes\About::class , 'lahcen']);
echo $route->Run($_SERVER["REQUEST_URI"]);