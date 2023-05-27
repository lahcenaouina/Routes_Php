<?php
require "vendor/autoload.php";
// Including the autoload file from the vendor directory, which allows loading classes automatically.

// Declare a new Router object
$route = new classes\Router();

// Examples of defining routes for different HTTP methods (GET, POST)
$route
    ->Get("/", [classes\Home::class, 'index']) // Define a GET route for the root URL
    ->Get("/about", [classes\About::class, 'index']) // Define a GET route for the "/about" URL
    ->Get("/about/create", [classes\About::class, 'getter']) // Define a GET route for the "/about/create" URL
    ->Post("/about/create", [classes\About::class, 'poster']) // Define a POST route for the "/about/create" URL
    ->Post("/Contact", function() {  // Define a POST route for the "/Contact" URL with an anonymous function
        return "CONTACT";
    })
    ->Post("/lahcen", [classes\About::class, 'lahcen']); // Define a POST route for the "/lahcen" URL

// Run the router and echo the result of the matched route
echo $route->Run($_SERVER["REQUEST_URI"], strtolower($_SERVER["REQUEST_METHOD"]));

// Display the contents of the $_POST superglobal array
echo "<pre>POST";
var_dump($_POST);
echo "</pre>";

// Display the contents of the $_GET superglobal array
echo "<pre>GET";
var_dump($_GET);
echo "</pre>";



