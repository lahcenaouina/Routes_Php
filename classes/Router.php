<?php 

namespace classes;

class Router {
        
        private array $routes ;
        public function Register(string $route  , callable|array $action) {
                $this->routes[$route] = $action;

                return $this;
        }
        public function routes_availbles() {
                var_dump($this->routes);
        }
        public function Run(string $request_uri) {
                $route = explode('?' , $request_uri)[0];
                $action = $this->routes[$route] ?? null ;
                if (!$action) {
                        throw new \Exception("PAGE NOT FOUND");
                }
                if (is_callable($action)){
                        return call_user_func($action);
                };

                if (is_array($action) ){
                        
                        [$class , $methode] = $action;

                        if (class_exists($class)){

                                $class = new $class();

                                if (method_exists($class ,$methode)){
                                        return \call_user_func_array([$class,$methode] ,[]);
                                }
                        };
                }
        }
}