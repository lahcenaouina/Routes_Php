<?php

declare(strict_types = 1);

namespace Test\Unit;

use classes\About;
use classes\App;
use classes\Router;
use PHPUnit\Framework\TestCase;
use PHPUnit\Metadata\Test;

class RouterTest extends TestCase {
        /** @test */
        public function it_registers_a_route(): void {
                $router = new Router();


                $router->Register('get' , '/about' , ['Users','index']);

                $expected = [
                        'get' => [ 
                                "/about" => ['Users','index']
                        ]
                ];
                $this->assertEquals($expected , $router->routes_availbles());
        }
        
}       