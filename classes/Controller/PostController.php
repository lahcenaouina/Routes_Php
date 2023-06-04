<?php

namespace classes\Controller;
use classes\Models\Post;

class PostController extends Post {
        public function __construct(public $id ,public $text ,public $time) {
                $this->id = $id ; 
                $this->text = $text ; 
                $this->time = $time ; 
        }

        public function add() {
                if (strlen($this->id)<0) {
                        header('Location: /pagenotfound');
                        exit;
                }
                if (strlen($this->text)<14) {
                        header('Location: /?Error=Post should be more than 15 caractere');
                        exit;
                }
                $this->AddPost($this->id , $this->text ,$this->time);
        }
        protected function GetPosts() {
                //condistion
                //
                return $this->GetAllPosts();
        }

}