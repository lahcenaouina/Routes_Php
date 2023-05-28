<?php

namespace classes;

class Page extends UserController
{
    public function index()
    {
        return View::view('login' , ['lahcen' , "aouina"])->render(false);
    }
}