<?php 

namespace classes;

class Router {
        
        private array $routes ;
        public function Register(string $methode, string $route  , callable|array $action) {
                $this->routes[$methode][$route] = $action;

                return $this;
        }
        public function Get(string $route  , callable|array $action) {
                $this->Register('get' , $route , $action);
                return $this;
        }

        
        public function Post(string $route  , callable|array $action) {
                $this->Register('post' , $route , $action);
                return $this;
        }



        public function routes_availbles() : array {
                return $this->routes ;
        }
        public function Run(string $request_uri , string $methode) {
                $route = explode('?' , $request_uri)[0];
                $action = $this->routes[$methode][$route] ?? null ;
                if (!$action) {
                        return (new View('pagenotfound'))->render();
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