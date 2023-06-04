<?php

namespace classes\Controller;

use classes\View;

class booksController {
        public function index() {
                return View::view('books' , [])->render(false);
        }
}