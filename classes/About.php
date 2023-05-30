<?php

namespace classes;

class About {
     public function index(){

         return View::view('About' ,['title'=>'About PAGE' , 'time' => time()])->render(false);
     }
     
} 