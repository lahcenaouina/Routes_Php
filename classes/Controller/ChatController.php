<?php

namespace classes\Controller;

use classes\View;

class ChatController {
        public function index() {
                return View::view('Chat' , [])->render(false);
        }
}