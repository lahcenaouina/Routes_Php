<?php

require "vendor/autoload.php";

$route = new classes\Router();

$route
        ->Get("/",[classes\Home::class , 'index'])
        ->Get("/about",[classes\About::class , 'index'])
        ->Get("/about/create",[classes\About::class , 'getter'])
        ->Post("/about/create",[classes\About::class , 'poster'])
        ->Post("/lahcen",[classes\About::class , 'lahcen']);
        
        echo "<pre>POST";
        var_dump($_POST) ;
        echo "</pre>";
        echo "<pre>GET";
        var_dump($_GET);
        echo "</pre>";
echo $route->Run($_SERVER["REQUEST_URI"] , strtolower($_SERVER["REQUEST_METHOD"]));

