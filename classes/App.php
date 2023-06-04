<?php

namespace classes;
use PDO ; 
use Exception;

class App
{
        private static DBH $db ;

        public function __construct(protected Router $router , protected array $request , protected array $config)
        {
                static::$db = new DBH($config);

        }   
        public function run()
        {
                try {
                        echo $this->router->Run(
                                $this->request['uri'],
                                $this->request['method']
                        );

                }catch(Exception $e) {
                        http_response_code(404); 
                        echo View::view('pagenotfound.php', [])->render(false);
                }
        }
        
        public static  function connect() : DBH{
                return static::$db;
        }
}
