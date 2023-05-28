<?php

declare(strict_types=1);

namespace classes;

class View
{

        public function __construct(
                protected string $view,
                protected array $params = []
        ) {
        }




        public static function view(string $view, $params): static
        {
                return new static($view, $params);
        }
        public function render(bool $WithLayouts = false)
        {
                $viewpath = VIEW_PATH . '/' . $this->view . '.php';

                        // store params into variables
                        foreach ($this->params as $key => $value ) {
                                $$key = $value ;
                        }
                if ($WithLayouts) {
                        if (!file_exists($viewpath)) {
                                throw new \ErrorException("PAGE NOT FOUND");
                        }


                

                        ob_start();
                        //navbar
                        include(VIEW_PATH.'/Navbar.php');
                        //content
                        include $viewpath;
                        return (string) ob_get_clean();
                } else {



                        ob_start();
                        //navbar
                        include(VIEW_PATH.'/Navbar.php');
                        //content
                        include(__DIR__ . DIRECTORY_SEPARATOR . "..\View\\" . $this->view . ".php");
                        $content = (string) ob_get_clean();


                        
                        include(VIEW_PATH.'/template.php');

                        
                }
        }


  
        
        // $this->(name)
        public function __get($name) {
                return $this->params[$name];
        }
}
